<?php
declare(strict_types=1);
namespace LanguageTools;

/*
   See:

   https://stackoverflow.com/questions/64608440/custom-iterator-with-a-callback
   https://stackoverflow.com/questions/37551726/how-to-handle-nested-recursive-iterator-dynamics-objects-in-php

 */

class PonsIterator implements \Iterator {

   private \ArrayObject $hits;

   private \ArrayIterator $iter; // $hits ArrayObject iterator--not really used.
 
   private int $index; // artifical sort of index to micmic arrya index?

   private \ArrayIterator $roms_iter; // <-- this is the sort of inner iterator? But its value change

   public function __construct(array $hits)
   {
      $this->hits = new \ArrayObject($hits);

      $this->iter = $this->hits->getIterator();

      $roms_obj = new \ArrayObject($this->iter->current()->roms);
       
      $this->roms_iter = $roms_obj->getIterator();

      $this->index = 0;
   }   

    public function key() : int
    {
       return $this->index; 
    }

   public function rewind()
   {
      $this->roms_iter->rewind();
       
      $this->index = 0;
   } 

   public function next()
   {
      $this->roms_iter->next();
            
      if ($this->roms_iter->valid() === false) {

          $this->iter->next();

          if ($this->iter->valid()) { 

               $arr_obj = new \ArrayObject($this->iter->current()->roms);

               $this->roms_iter = $arr_obj->getIterator();
          }
      } 

      if ($this->roms_iter->valid()) ++$this->index;
   }

   public function valid() : bool
   {   
       if ($this->roms_iter->valid()) 
           return true;

       else if ($this->iter->valid()) 
           return true;

       else return false; 
   }
 
   private function noun_details(string $word) : array
   {       
      // sample:  <span class="genus"><acronym title="feminine">
      static $query = "//span[@class='genus']/acronym/@title";
      // static $query = "//span[@class='genus']/acronym/text()";

      $iter = $this->dict->lookup($word, "de", "en");

      foreach ($iter as $r) {
            
            if ($r->pos !== "noun") continue;
           
            else {
           
               $hwd_full = $r->headword_full;
               break;
            }
        }

        $frag = $this->dom->createDocumentFragment(); 
 
        $frag->appendXML("<p>$hwd_full</p>");
 
        $child = $this->body->appendChild($frag);
 
        $list = $this->xpath->query($query);
               
        $result = ($list !== false && $list->count() == 1) ? $list->item(0)->textContent : '';        
        
        $this->body->removeChild($child);
        
        if ($result == 'f')
             $article = 'die';
        else if ($result == 'n') 
             $article = 'das';
        else $article = 'der';
            
        return array('article' => $article, 'plural' => '');
    }
   public function current() : \stdClass 
   {
      $current = $this->roms_iter->current();
       /*
         Move the PondDictionary::get_results() code here with some changes:
             
         We return only results for a single 'rom':

               ->type            of dicitonary entry: "entry" or "
               ->headword     
               ->full_headword
               ->pos             part of speech  
               ->definitions     definitions array
       */  
      $result = new \stdClass;
      
      // type of dictionary entyr. Most often "entry". If not, then the result is a translation.
      $result->pos = $curret->pos;
      
      /*
         The [Pons documentation ](doc/pons-api.pdf) explains that each separate rom (Roamn numeral) correspondss to a part of speech:

           "For each part of speech there is one rom (roman numeral). For example "cut" may be a
            noun, adjective, interjection, transitive or intransitive verb and has the roms I to V."

          Each rom in turn has an array of arab's. Each arab stands for a specific meaning of the $rom->headword.

          Each arab contains a 'header' string and an array, 'translations', of \stdClass'es. For, say, the input word 'Abschied', the 1st
          rom's first arab:

            echo $element->roms[0]->arabs[0]->header;
          
          is
              `1. Abschied <span class="sense">(Trennung)</span>`
          
          header can contain more spans with more information. The transations array holds \stdClasses with two strings: source and target.
          target is the English translation of the source. It can contain the 'sense', 'gramatical_constructions` 'headword' or an 'example'.
          This information is in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.

          These span classes are undocumented, however!
       */
      
      $result->headword = $current->headword; 
      
      /* rom->headword_full Contains text with <span class='...'> that give:
       * 1. the part-of-speech, which is also in rom->wordclass
       * 2. the gender, if a noun.
       */
      $result->headword_full = $current->headword_full; 
      
      if (isset($current->wordclass))  {// not sure why this isn't always set.
          
          $result->pos = $current->wordclass;    // Part-of-speech
      }
      
      $definitions = array();

      if (count($current->arabs) == 0) {

          $result->definitions = $definitions;

          return $result;
      } 
      
      foreach ($current->arabs as $arab) {
           
          if (count($arab->translations) == 0) // Sometimes there aren't definitions but something else.
              continue;
                  
           foreach($arab->translations as $translation) 
      
                $definitions[] = $translation;//strip_tags($translation->target);
           
           $result->definitions = $definitions;
       }

       return $result; 
   }
}

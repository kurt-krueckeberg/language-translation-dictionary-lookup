<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranTranslator extends RestApi implements TranslateInterface, DictionaryInterface {

   /*
    The Systranr 'option' query paramter can occur more than once. But I'm not sure how to specify this for Guzzle:
    I guess that would mean $thi->query['option'] = ['aaa', 'bbb', ... ];?
    */
   
   public function __construct(ConfigFile $c)
   {
      parent::__construct($c, ClassID::Systran); 
   }

   public function getTranslationLanguages() : array
   {
      static $trans_languages = array('method' => "GET", 'route' => "translation/supportedLanguages");

      $contents = $this->request($trans_languages['method'], $trans_languages['route']);
             
      return json_decode($contents, true);
   } 

   final public function getDictionaryLanguages() : array
   {
      static $dict_languages = array('method' => "GET", 'route' => "resources/dictionary/supportedLanguages");

      $contents = $this->request($dict_languages['method'], $dict_languages['route']);
             
      return json_decode($contents, true);    
   } 

   /*
    *  NOTE: Systran requires the language codes to be lowercase.
    *  If the language is not utf-8, the default, then you must speciy the encoding using the 'options' parameter.
    */
   final public function translate(string $text, string $dest, $src="") : string 
   {
       static $trans = array('method' => "POST", 'route' => "translation/text/translate");

       $query = array();
       
       if ($src !== '') 
           $query['source'] = strtolower($src);
       
       $query['target'] = strtolower($dest);
       
       $query['input'] = $text;
       
       $contents = $this->request($trans['method'], $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

       return urldecode($obj->outputs[0]->output);
   }

   final public function lookup(string $word, string $src, string $dest) : LookupIterator
   {      
      static $lookup = array('method' => "GET", 'route' => "resources/dictionary/lookup");

      $query = array();
      
      if ($src !== '') 
          $query['source'] = strtolower($src);
      
      $query['target'] = strtolower($dest);
      
      $query['input'] = $word;

      $contents = $this->request($lookup['method'], $lookup['route'], ['query' => $query]);
             
      $stdClass = json_decode($contents); // convert JSON string to \stdClass
       
       /*
        *   * To pretty print the matches:
        * 
        echo "The " . count($stdClass->outputs[0]->output->matches) . " matches returned:\n";
        
   
        echo json_encode($stdClass->outputs[0]->output->matches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE |JSON_UNESCAPED_SLASHES); 
 
        echo "\n";
        */
    
       if (empty($stdClass->outputs[0]->output->matches)) {
           
           $std = new \stdClass;
           
           $std->word = $word;

           return new LookupIterator(array($std), SystranTranslator::get_no_definition(...));
               
       } else    
           return new LookupIterator($stdClass->outputs[0]->output->matches, SystranTranslator::get_result(...));
    }
    
    protected function get_no_definition(\stdClass $cur): LookupResult
    {    
        $definitions = array();
    
        $definitions[0]['definition'] = 'no definition'; 
  
        $definitions[0]['expressions'] = array();
        
        return new LookupResult($cur->word, 'unknown', $definitions);
    }
    /*
     * returns LookupResult
     *  word
     *  pos
     *  defintions, an array of tow elements; 'definition' and 'expressions' 
     */
    protected function get_result(\stdClass $cur): LookupResult
    {   
        $info = $this->get_source_info($cur);
        
        $definitions = array();
        
        foreach($cur->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; 
  
           $definitions[$index]['expressions'] = $target->expressions;
        }
        
        return new LookupResult($info['word'], $info['pos'], $definitions);
    }

   /*
     * Examines $match->source
     * 
     * "source": {
            "inflection": "(pl:Frauen)",
            "info": "f",
            "lemma": "Frau",
            "phonetic": "",
            "pos": "noun",
            "term": "Frau"
        }
     * 
     * and returns array with:
     * 'word' => the word as it will b displayed, with plrual, if noun; with conjugation, if verb.
     * 'pos' => the part of speech.
     * 
     */
    
    private function get_source_info(\stdClass $match) : array
    {        
        if ($match->source->pos == 'noun') {
                     
            if ($match->source->info == 'm')
                $gender = 'der';
            else if ($match->source->info == 'n')
                $gender = 'das';
            else  
                $gender = 'die';
                       
            $word = $gender . ' ' . $match->source->lemma;
            
            if (strlen($match->source->inflection) !== 0) 
                
                 $word .= ' ' . $match->source->inflection;

            else 
                $word .= " (no plural)";
                        
                   
        } else if ($match->source->pos == "verb") 
            
            $word = $match->source->lemma . ' ' . $match->source->inflection;
                
        return array('word' => $word, 'pos' => $match->source->pos);
   }   
  
}

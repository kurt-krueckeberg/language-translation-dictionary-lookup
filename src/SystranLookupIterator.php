<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranLookupIterator extends LookupIterator { 
 
    public function __construct(array $results)
    {
       parent::__construct($results);
    }
    
    /*
     * returns LookupResult
     *  word
     *  pos
     *  defintions, an array of tow elements; 'definition' and 'expressions' 
     */
    protected function get_result(mixed $cur): LookupResult
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
        $word = $match->source->lemma;
        
        if ($match->source->pos == 'noun') 
            
            if (strlen($match->source->inflection) !== 0) 
                
                 $word .= ' ' . $match->source->inflection;

            else 
                $word .= " (no plural)";
                   
        else if ($match->source->pos == "verb") 
            
            $word .= ' ' . $match->source->inflection;
                
        return array('word' => $word, 'pos' => $match->source->pos);
   }   
}

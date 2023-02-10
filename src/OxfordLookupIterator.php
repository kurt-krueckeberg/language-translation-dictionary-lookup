<?php
declare(strict_types=1);
namespace LanguageTools;

class OxfordLookupIterator extends LookupIterator {

    public function __construct(array $matches, bool $prefix_verbs = false)
    {
       parent::__construct($matches);
    }
 
    private function get_result(mixed $cur): LookupResult
    {   
        $info = $this->get_source_info($cur);
        
        $definitions = array();
        
        foreach($cur->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; 
  
           $definitions[$index]['expressions'] = $target->expressions;
        }
        
        return new LookupResult($info['word'], $info['pos'], $definitions);
    }
}
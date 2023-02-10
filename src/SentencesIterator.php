<?php
declare(strict_types=1);
namespace LanguageTools;

class SentencesIterator extends ResultsIterator {
 
    public function __construct(array $results, callable $func)
    {
       parent::__construct($results);
    }
    
   public function current() : string
   {
       return parent::current();;
   }
}
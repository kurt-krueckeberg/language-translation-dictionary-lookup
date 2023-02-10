<?php
declare(strict_types=1);
namespace LanguageTools;

class LookupIterator extends ResultsIterator { 
 
    private array $results;
 
    public function __construct(array $results, callable $call)
    { 
       parent::__construct($results, $call);
    }
    
    public function current() : LookupResult
    { 
        return parent::current();
    }
}
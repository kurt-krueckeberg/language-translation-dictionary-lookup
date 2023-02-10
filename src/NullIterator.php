<?php
declare(strict_types=1);
namespace LanguageTools;

/*
   See:

   https://stackoverflow.com/questions/64608440/custom-iterator-with-a-callback
   https://stackoverflow.com/questions/37551726/how-to-handle-nested-recursive-iterator-dynamics-objects-in-php

 */

class NullIterator implements \Iterator {

   public function __construct() {}

   public function key() : int
   {
      return 0; 
   }

   public function rewind() {}

   public function next()
   {
   }

   public function valid() : bool
   {   
       return false; 
   }
 
   public function current() : \stdClass 
   {
       return new \stdClass; 
   }
}

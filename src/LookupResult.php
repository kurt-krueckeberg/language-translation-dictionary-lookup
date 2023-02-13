<?php
declare(strict_types=1);
namespace LanguageTools;


class  LookupResult {
   
   public function __construct(public readonly string $word, public readonly string $pos, public readonly array $definitions) 
   {
       
   }

   public function defns_toString() : string 
   {
   }
  
   public function __toString() : string 
   {
     echo $this->word . ' ' . 'part of speech: ' . $this->pos . "\nDefinitions:\n". $this->defns_toString();
   }        
}

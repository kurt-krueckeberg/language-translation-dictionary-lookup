<?php
declare(strict_types=1);
namespace LanguageTools;


class  LookupResult {
   
   public function __construct(public readonly string $word, public readonly string $pos, public readonly array $definitions) 
   {
       
   }

    private function get_definitions() : string
   {       
      $str = '';

      foreach ($this->definitions as $defn) {

        $str = '- ' . $defn["definition"] . "\n";

        if (count($defn['expressions']) == 0) continue;
              
         $exps = "Expressions:\n"; 
         
         foreach ($defn['expressions'] as $expression) 

            $exps .= $expression->source .  ' ' . $expression->target;

         $str. $exps;
      }
      return $str;
    }
  
   public function __toString() : string 
   {
     return "Word: " . $this->word . "\n" . "Part of speech: " . $this->pos . "\nDefinitions:\n". $this->get_definitions();
   }        
}

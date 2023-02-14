<?php
declare(strict_types=1);
namespace LanguageTools;


class  LookupResult {
   
   public function __construct(public readonly string $word, public readonly string $pos, public readonly array $definitions) 
   {
       
   }

   private function get_definitions() : string 
   {
      foreach($definitions as $result)  {

          $defns = $this->add_defn($result->definitions);
          
      }
           
   }

   private function add_defn(array $definitions) : string
   {       
      $str = '';

      foreach ($definitions as $defn) {

        $str = $defn["definition"]\n";

        if (count($defn['expressions']) == 0) continue;
              
         $exps = "Expressions:\n"; 
         
         foreach ($defn['expressions'] as $expression) 

            $exps .= $expression->source .  ' ' . $expression->target);

         $str. $exps;
      }
      return $str;
    }
  
   public function __toString() : string 
   dds{
     echo $this->word . ' ' . 'part of speech: ' . $this->pos . "\nDefinitions:\n". $this->get_definitiond();
   }        
}

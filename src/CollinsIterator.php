<?php
declare(strict_types=1);
namespace LanguageTools;

class CollinsIterator implements \Iterator {
    
   private \SimpleXMLElement$xml;
      
   private string $pos;
      
   static private string $pos_query = '//span[contains(@class, "pos")]';  
   
   
   /*
    * Part of Speech:
    * hom->gramGrp->pos 
    *  
    * 
    * Definitions:
    *  hom->sense->cit[] is an array to iterated.
    *  
    *   definitions: hom->sense->cit[0]->quote - a definition
    *   Examles and phrases accompany definitions. There are tons and tons of these phrases, really too many.
    * 
    * 
    */

    private function get_pos() 
   {
      $list = $this->xpath->query(self::$pos_query);
                
      $this->pos = $list->item(0)->textContent;
      return;
   }

   public function __construct(string $xml)
   {      
       $this->xml = $xml = simplexml_load_string($xml);       
       print_r($this->xml);
       $d = 10;
   }   

    public function key() : int
    {
       return $this->index; 
    }

   public function rewind()
   {
      $this->index = 0;
   } 

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

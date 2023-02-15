<?php
declare(strict_types=1);
namespace LanguageTools;

// See: https://developer.oxforddictionaries.com/documentation
class OxfordDictionary extends RestApi implements DictionaryInterface, SentenceFetcher {

   static array   $lookup   = array('method' => 'GET', 'route' => "dictionary");

   
   public function __construct(ConfigFile $c)
   {
      parent::__construct($c, Provider::Oxford);
   }


   final public function getDictionaryLanguages() : array 
   {
      static $languages = array('method' => 'GET', 'route' => "dictionaries");

      $contents = $this->request(self::$languages['method'], self::$languages['route']);
             
      $arr = json_decode($contents, true);
    
      return $arr;
   } 

   public function lookup(string $word, string $src, string $dest) : \Iterator
   {
       static $route = "";

       //++$contents = $this->request('GET', $route, ['query' => ????[ 'q' => $word, 'in'=> strtolower($src), 'language' => strtolower($dest), 'l' =>   strtolower($src . $dest)]  ]); 
       
       if (empty($contents)) {
           
             echo "Response contenst for $word is empty.\n";
             return array(); 
       }

       $obj = json_decode($contents)[0];
             
       if (is_null($obj) || count($obj->hits) == 0) 
             return NullIterator();

       return new OxfordLookupIterator($obj->hits);
   }
}

## Overview

PHP REST client classes and interfaces for several REST language translation and dictionary services APIs. The base class for all these classes is:

-  `RestApi`

    The base class for all dictionary and translation classes. 

The client classes are:

- `SystranTranslator`

   implements `TranslateInterface` and `DictionaryInterface` for the [Systran Pro API](https://www.systran.net/en/translation-api/).
   
- `AzureTranslator`

   implements `TranslateInterface` and `DictionaryInterface` for the Microsoft 
   [Azure Translator service](https://azure.microsoft.com/en-us/products/cognitive-services/translator/).

- `DeeplTranslate`
  
  implements `TranslateInterface` for the [DEEPL translation service ](https://www.deepl.com/docs-api)
  
 - `PonsDictionary` 
   implements the `DictionaryInterface` for the free [Pons dictionary API](https://en.pons.com/p/online-dictionary/developers/api).
  
 - `CollinsGermanDictionary` 
   implements the `DictionaryInterface` for the free [Collins dictionary API](https://www.collinsdictionary.com/us/collins-api#:~:text=The%20Collins%20Dictionary%20API%20gives,%2C%20audio%20pronunciations%2C%20and%20more.), which requires an approval to obtain.

- `LeipzipSentenceFetcher`

   Implements `SentenceFetchInerface` whose 'fetch_sample` method returns example sentences

## Code Internals

### All Interfaces and Classes

The UML of all the [Dictionary and Translation](/assets/images/dict-trans-classes.png) diagram (click to enlarge) related classes and interfaces:

![UML Dictionary and Translation Classes and Interface Diagram](/assets/images/dict-trans-classes.png)

The dictionary and translation classes and interfaces in UML are:

```plantuml
interface TranslateInterface {
   public function translate(string $str, string $dest_lang, string $src_lang="") : string;
   public function getTranslationLanguages() : array;
}

interface DictionaryInterface {
   public function lookup(string $str, string $src_lang, string $dest_lang) : \Iterator
   public function getDictionaryLanguages() : array
}

interface SentenceFetchInterface  { 
   fetch(string word, int count=3) : ResultsIterator;
}

class ResultsIterator extends \ArrayIterator {
   public function __construct(array $results, callable $func)
   public function current() : mixed
}

class RestApi {
   public  __construct(string $bas private $headers = array()
   protected function request(string $method, string $route, array $options = array()) : string
}

class LeipzigSentenceFetcher extends RestApi implements SentenceFetchInterface {
  
   public function __construct(Config $c)  
   public function fetch(string $word, int $count=3) : ResultsIterator  
}

class  LookupResult {
   public function __construct(public readonly string $word, public readonly string $pos, public readonly array $definitions) 
}

class LookupIterator extends ResultsIterator { 
    public function __construct(array $results, callable $call)
    public function current() : LookupResult
}

class SystranTranslator extends RestApi implements TranslateInterface, DictionaryInterface {
   public function __construct(ConfigFile $c)
   public function getTranslationLanguages() : array
   final public function getDictionaryLanguages() : array
   final public function lookup(string $word, string $src, string $dest) : LookupIterator
   final public function translate(string $text, string $dest, $src="") : string
}
```

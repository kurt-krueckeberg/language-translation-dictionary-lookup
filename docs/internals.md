## Overview

PHP REST client classes and interfaces for several REST language translation and dictionary services APIs. The base class for all these classes is:

-  `RestBase`

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

   Implements 'SentenceFetchInerface` whose 'fetch_sample` method Returns example sentences

## Code Internals

### Translaton and Dictionary Interfaces and Classes

The UML [Dictionary and Translation classes and Interfaces](/assets/images/dict-trans-classes.png) diagram (click to enlarge).

![UML Dictionary and Translation Classes and Interface Diagram](/assets/images/dict-trans-classes.png)

The dictionary and translation classes and interfaces in UML are:

```plantuml
interface TranslateInterface {

   public function translate(string $str, string $dest_lang, string $src_lang="") : string;
   public function getTranslationLanguages() : array;
}

interface DictionaryInterface {
   
   public function lookup(string $str, string $src_lang, string $dest_lang) : \Iterator; 
   public function getDictionaryLanguages() : array; 
}

class RestBase {

   public  __construct(string $base_uri, array $headers); 
  
   private $headers = array(); 
}

class DeeplTranslator extends RestBase implements TranslateInterface {
   
   public function __construct(ClassID id)
   
   public function getLanguages() : string

   public function getSourceLanguages() : array

   public function getTargetLanguages() : array
   
   public function getTranslationLanguages() : array

   public function translate(string text, string dest_lang, source_lang="") : string 
}

class SystranTranslator extends RestBase implements DictionaryInterface, TranslateInterface {

   public function __construct(ClassID id)
   
   public function getTranslationLanguages() : array

   public function getDictionaryLanguages() : array 
    
   public function translate(string text, string dest_lang, source_lang="") : string 
   
   public function lookup(string $word, string $src_lang, string $dest_lang) : LookupIterator
}
```

### Example Sentences Retrieval Interface and Class

The UML [Example Sentences Interfaces and Classes](/assets/images/sentence-fetcher.png) diagram.

![UML of Examples Sentence Retrieval Class and Interface Diagram](/assets/images/sentence-fetcher.png)

The example sentences retrieval interfaces and classes in UML are:

```plantuml
interface SentenceFetchInterface  { 

   fetch(string word, int count=3) : ResultsIterator;
}

class LeipzigSentenceFetcher extends ResbBase implements SentenceFetchInterface {

   __construct( UniLeipzigConfig c = new LeipzigConfig() )
   
   fetch(string word, int count=3) :  ResultsIterator
}
```

### ResultsIterator Class

The UML diagram of the [ResultsIterator class](/assets/images/results-iterator.png).

![UML of ResultIterator](/assets/images/results-iterator.png)

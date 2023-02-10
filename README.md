# PHP Translation and Dictionary REST API Classes

REST API Classes for:

- Systran Pro Translation and Dictionary Lookup
- Deepl Translator Class
- Leipzig Sentence Corpus

This is a collection of PHP client classes and interfaces that implement the REST APIs of a number of REST APIs:

- `SystranTranslator`

   Implements `TranslateInterface` and `DictionaryInterface`. Its `DiciontaryIntrface::lookup` method  often returns example phrases.

-  `RestBase`

    The base class for all dictionary qnd translation classes. 

- `LeipzipSentenceFetcher`

   Implements 'SentenceFetchInerface` whose 'fetch` method Returns example sentences

- `DEEPL` [Transaltor translation API](https://www.deepl.com/docs-api)

## Implementation

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

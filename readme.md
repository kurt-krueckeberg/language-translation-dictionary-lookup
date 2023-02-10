# PHP Translation and Dictionary REST API Classes

This is a collection of PHP client classes and interfaces that implement the REST APIs of a number of REST APIs:

- University of Leipzig Natural Language Processing Group's [REST API of the Leipzig Corpora Collection / Projekt Deutscher Wortschatz](http://api.corpora.uni-leipzig.de/ws/swagger-ui.html)

- Microsot's [Azure Translator REST API]() that provides a Translation and Dictionary Lookup REST API

- DEEPL [Transaltor translation API](https://www.deepl.com/docs-api)

- [Systran Translation and Dictionary Lookup REST API](https://docs.systran.net/translateAPI/en/)

- [Collins Dictionary REST API](https://www.collinsdictionary.com/collins-api)

- PONS [Dictionary REST API](https://en.pons.com/p/online-dictionary/developers/api)


## Classes

### Translation and Dictionary lookup 

- `AzureTranslator`

   Implements `TranslateInterface` and `DictionaryInterface` and also contains the `examples(string $word, ResultsIterator $definitions)` method that return example phrases (for each given definition)

- `SystranTranslator`

   Implements `TranslateInterface` and `DictionaryInterface`. Its `DiciontaryIntrface::lookup` method  often returns example phrases.

-  `RestBase`

    The base class for qll dictionqry qnd translation classes. 

- `LeipzipSentenceFetcher`

   Implements 'SentenceFetchInerface` whose 'fetch` method Returns example sentences

## PHP 8.1 Comments

This code requires PHP 8.1 because it uses:

- enumerations (that implement interfaces).

- function methods paramters that take Intersction Types of `DiciontaryInterface|TranslateInterface`

- First-class callable syntax

## Installion

After cloning the repository:

```bash
$ composer update 
$ composer dump-autoload
````

## Usage

For usage see [main.php](main.php) 

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

class AzureTranslator extends RestBase implements DictionaryInterface, TranslateInterface {
   
    public function __construct(ClassID id)
   
    public function getTranslationLanguages() : array

    public function getDictionaryLanguages() : array 
    
    public function translate(string text, string dest_lang, source_lang="") : string 
   
   public function  lookup(string word, string src_lang, string dest_lang) : LookupIterator

   public function examples(string word, array translations) : ResultsIterator
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

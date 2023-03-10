# PHP Translation and Dictionary REST API Classes

This repository contains PHP classes that support:

- Translation and dictionary lookup.
- The Leipzig University Department of Numerical Linguistics **German Sentence Corpus** [REST API](http://api.corpora.uni-leipzig.de/ws/swagger-ui.html#/).

## Leipzig German Sentence Corpus Sample Sentences Class

[LeipzigSentenceFetcher](src/LeipzigSentenceFetcher.php) implements the [SentenceFetchInterface](src/SentenceFetchInterface.php).

## Translation Classes

The classes that implement the [TranslateInterface](src/TranslateInterface.php):

- [AzureTranslator](src/AzureTranslator.php) implements Microsoft's [Azure Translator API](https://learn.microsoft.com/en-us/azure/cognitive-services/translator/translator-text-apis?tabs=csharp)
- [DeeplTranslator](src/DeeplTranslator.php) implemenent's the [DEEPL translate API](https://www.deepl.com/en/docs-api/)
- [SystranTranslator](src/SystranTranslator.php) implements the [Systran Pro translate API](https://docs.systran.net/translateAPI/en/)

## Dictionary Lookup Classes

The classes that implement the [DictionaryInterface](src/DictionaryInterface.php):

- [PonsDictionary](src/PonsDictionary.php)
- [CollinsGermanDictionary](src/CollinsGermanDictionary.php)
- [OxfordDictionary](src/OxfordDictionary.php)
- [AzureTranslator](src/AzureTranslator.php)
- [SystranTranslator](src/SystranTranslator.php)

The [PonsDictionary](src/PonsDictionary.php) and [CollinsGermanDictionary](src/CollinsGermanDictionary.php) `Lookup($word)` methods return **HTML** (or optionally
**XML** in the case of PonsDictionary) that is specific to the the PONS and Collins Dictionary websites, respectively. The format of this HTML and the many CSS
classes it uses is undocumented. It is custom, site-specific HTML.

Since both the HTML tags and the many CSS they use are undocumented, you must implement a custom solution to extract the dictionary definitions (and any associated
sample expressions) from the HTML. The `PonsIterator`and `CollinsIterator` classes attempt to do this using `XPath` queries to extract the definitions and any
associated sample expressions from the HTML.

## Text and HTML Output Examples

The `BuildHtml` class in `src/BuildHtml.php`, along with the `.css` files (in the `css` directory that is uses, creates attractive **HTML** output. To use it, follow
the example in [html-example.php](html-example.php).

To create text output, follow the example code in [cli-example.php](cli-example.php).

## Further Detailed Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

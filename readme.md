# PHP Translation and Dictionary REST API Classes

This repository contains PHP classes that support:

- Translation and dictionary lookup.
- The Leipzig University Department of Numerical Linguistics **German Sentence Corpus** REST API

## Translation Classes

These classes implement the `TranslateInterface`:

- AzureTranslator implements Microsoft's Azure Translator API
- DeeplTranslator implemenent's the DEEPL translate API
- SystransTranslator implements the Systran Pro translate API

## Dictonary Lookup Classes

These classes implement the `DictionaryInterface`:

- PonsDictionary
- CollinsGermanDictionary
- OxfordDictionary
- AzureTranslator
- SystranTranslator

The `PonsDictionary` and `CollinsGermanDicionary` `Lookup($word)` methods return html (or also XML in the case of PonsDictionary). This is the html used to display
the dictionary look-up results on the PONS and Collins Dictionary websites, respectively.

Both the HTML tags and CSS classes they use are undocumented. Therefore to extract the actual dicionary meanings, you must study the HTML results and create, for example, custom `XPath` queries. The `PonsIterator`and `CollinsIterator` attempt to do this.

# Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

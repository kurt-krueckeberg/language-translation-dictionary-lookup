# PHP Translation and Dictionary REST API Classes

This repository contains PHP classes that support:

- Translation and dictionary lookup.
- The Leipzig University Department of Numerical Linguistics **German Sentence Corpus** REST API

## Translation Classes

These classes implement the `TranlateInterface`:

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

The `PonsDictionary` and `CollinsGermanDicionary` Lookup methods return html (or also XML in the case of PonsDictionary) results that are 
embedded within hmtl used to display the results on the PONS and Collins Dictionary websites, respectively.

Since these HTML results contain many HTML tags that use various CSS classes. Both these HTML tags and CSS classes are undocumented. Therefore to
extract the dicionary meanings, you must study the HTML results and create, for example, custom `XPath` queries. The `PonsIterator`and `CollinsIterator`
attempt to do this.

# Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

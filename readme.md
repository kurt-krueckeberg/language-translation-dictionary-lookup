# PHP Translation and Dictionary REST API Classes

This repository contains PHP classes that support:

- Translation and dictionary lookup.
- The Leipzig University Department of Numerical Linguistics **German Sentence Corpus** REST API

## Translation Classes

The classes that implement the `TranslateInterface`:

- `AzureTranslator` implements Microsoft's Azure Translator API
- `DeeplTranslator` implemenent's the DEEPL translate API
- `SystransTranslator` implements the Systran Pro translate API

## Dictonary Lookup Classes

The classes that implement the `DictionaryInterface`:

- PonsDictionary
- CollinsGermanDictionary
- OxfordDictionary
- AzureTranslator
- SystranTranslator

The `PonsDictionary` and `CollinsGermanDicionary` `Lookup($word)` methods return **HTML** (or optionally **XML** in the case of PonsDictionary) that is specific to the
the PONS and Collins Dictionary websites, respectively. The format of this HTML is undocumented. It is custom, site-specific HTML.

Since both the HTML tags and the many CSS they use are undocumented, you must implement a custom solution to extract the dictionary definitions (and any associated
sample expressions) by, for example, creating custom `XPath` queries that extract the definitions and any associated sample expressions from the HTML . The `PonsIterator`and `CollinsIterator` classes are attempt to do this.

## Text and HTML Output Examples

The `BuildHtml` class in `src/BuildHtml.php`, along with the `.css` files in the `css` directory, will create **HTML** output. See the example of how to use `BuildHtml` in `html-example.php`.
To create text output, see the example code in `cli-example.html`.

## Further Detailed Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

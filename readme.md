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

The `PonsDictionary` and `CollinsGermanDicionary` `Lookup($word)` methods return html (or optionally XML in the case of PonsDictionary) that is site-specific,
undocumented custom HTML used to display the dictionary look-up results on the PONS and Collins Dictionary websites, respectively.

Since both the HTML tags and the many classes used are undocumented, in order to extract the actual dicionary meanings, you must study the HTML results and create,
for example, custom `XPath` queries that return the dictionary definitions, and any associated usage expressions. The `PonsIterator`and `CollinsIterator` attempt
to do this.

## Text and HTML Output Examples

The `BuildHtml` class in `src/BuildHtml.php`, along with the `.css` files in the `css` directory, will create **HTML** output. See the example of how to use `BuildHtml` in `html-example.php`.
To create text output, see the example code in `cli-example.html`.

## Further Detailed Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

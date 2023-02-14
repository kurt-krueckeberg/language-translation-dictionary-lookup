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
the PONS and Collins Dictionary websites, respectively. The format of this HTML and the many CSS classes it uses is undocumented. It is custom, site-specific HTML.

Since both the HTML tags and the many CSS they use are undocumented, you must implement a custom solution to extract the dictionary definitions (and any associated
sample expressions) from the HTML. The `PonsIterator`and `CollinsIterator` classes attempt to do this using `XPath` queries to extract the definitions and any
associated sample expressions from the HTML.

## Text and HTML Output Examples

The `BuildHtml` class in `src/BuildHtml.php`, along with the `.css` files in the `css` directory, creates attractive **HTML** output. To use it, follow the example in
[html-example.php](html-example.php).

To create text output, follow the example code in [cli-example.html](cli-example.html).

## Further Detailed Reference

- [Configuration file format](docs/config.md)
- [Sample Application](docs/app.md)
- [Code Internals](docs/internals.md)

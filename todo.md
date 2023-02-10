Make HtmlBuilder strictly an html output creator that has that sole responsibility. 

CollinsGermanDictionary now implements the DictionaryInterface. Its lookup() method returns CollinsIterator, 
with XML results that are a mess. There are also tons and tons of example phrases,
and these begin with the brief German equivalent.

Either add a 3rd ctor parameter to the current class of type bool to indicate whether prefix verbs should be returned or
derive yet antoher iterator class from the SystranLookupIterator that has such a ctor parameter and implements this behvaior...
or maybe we can easily implement the return-prefix-don't-return-prefix haviors by composing a FilterIterator or more specialized
CallbackFilterIterator, when we need to filter out some results, but in the case of wanting all 
prefix verbs, implement it using ArrayIterator (instead of the current code).

 
Does 'handeln' return results for 'Handeln'? We know the opposite is true. 

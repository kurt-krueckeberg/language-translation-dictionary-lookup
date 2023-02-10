# Pons lookup Results

![Pons results](/assets/images/pons-hits.png)

The [Pons documentation](doc/pons-api.pdf) explains that each separate rom (Roman numeral) correspondss to a part of speech:

> For each part of speech there is one rom (roman numeral). For example "cut" may be a
> noun, adjective, interjection, transitive or intransitive verb and has the roms I to V.

Each rom in turn has an array of arab's. Each arab stands for a specific meaning of the `$rom->headword`.

Each arab contains:

1. `header` string and
2. an array of `translations`, which are `stdClass` 'es. For, example, the word 'Abschied', the 1st
   rom's first arab:

```php
  echo $element->roms[0]->arabs[0]->header;
```

is `Abschied <span class="sense">(Trennung)</span>`
    
The header can contain more spans with more information. The transations arrays of \stdClasses with two members:

* source and
* target

`target` is the English translation of the source. It can contain the 'sense', 'gramatical\_constructions', 'headword' or an 'example'.
This information is in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.

These span classes are undocumented.

 ```php
$result->headword = $current->headword;
```

`$rom->headword_full` contains text with `<span class='...'>` that give:

* 1. the part-of-speech, which is also in rom->wordclass
* 2. the gender, if a noun.

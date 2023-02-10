# Systran PRO - API 

- [Pricing](https://www.systran.net/en/plans-pricing/). See "for Developers API" a bottom of page.
        
        - [Login for Systran Pro: translate.systran.net/user](https://translate.systran.net/user). **note:** Do not sign in at `www.systran.net` (which for reason unknown to md display incorrect and incomplete infomration).
        
        ## Systran API Dcoumentation
        
        - [Documentionat Main Page](https://docs.systran.net/translateAPI/en)
        
        - [Systrans Translation API](https://docs.systran.net/translateAPI/translation)
        
        - [Dictionary lookup](https://docs.systran.net/translateAPI/dictionary)
        
        - [User Console](https://trs.systran.net/user)
        
        ## Dictonary Lookup Results
        
        Below are four examples of return results for the two nouns, **Hund** and **Geschäft**, and the two verbs, **befragen** and **kommmen**.
        
        For verbs that have one or more prefix versions, their results also are also returned. Therefore `lookup('kommen', 'de', 'en')` returns an array of 59 results that
        includes **ankommen*, **aufkommen**, etc, along with **kommen**, which is the 24th result element.
        
        The Systran JSON matche object has these properties:
        
        ```json
        {
          "auto_complete": "boolean",
          "model_name": "string",
          "source": {
            "inflection": "string",
            "info": "string",
            "lemma": "string",
            "phonetic": "string",
            "pos": "string",
            "term": "string"
          },
          "target": {
            "context": "string",
            "domain": "string",
            "entry_id": "string",
            "expressions": [
              {
                "source": "string",
                "target": "string"
              }
            ],
            "invmeanings": [
              "string"
            ],
            "lemma": "string",
            "rank": "string",
            "synonym": "string",
            "variant": "string"
          },
          "other_expressions": [
            {
              "context": "string",
              "source": "string",
              "target": "string"
            }
          ]
        }
        ```
        
        ```php
        lookup('Hund', 'de', 'en');
        ```
        
        JSON results:
        
        ```json
        "matches": [
            {
                "auto_complete": false,
                "model_name": "mono-deen.mod",
                "other_expressions": [
                    {
                        "context": "",
                        "source": "junger Hund",
                        "target": "young pup"
                    }
                ],
                /*  
                  "source" has: the part of speech in "pos".
                   If "pos" is "noun" then:
                          "inflection" is the plural form.
                          "info" is the gender: "m", "f" or "n".
                */
        "source": { 
            "inflection": "(pl:Hunde)",
            "info": "m",      // <-- "info" is the gender: "m" for msaculine.
            "lemma": "Hund",  
            "phonetic": "",
            "pos": "noun",    // <-- "pos" is Part of Speech: noun
            "term": "Hund"
        },
        /*
           There are one or more targets. The "target" onsists of:
              1.) sample expressions in tne "expressions" array and 
              2.) definitions in the "lemma" property.                                                               
        */
                "targets": [ 
                    {        
                "context": "",
                "domain": "",
                "entry_id": 15092,
                "expressions": [ // <-- Sample expressions and their translations
                    {
                        "source": "wilder Hund",
                        "target": "wild dog"
                    },
                    {
                        "source": "streunender Hund",
                        "target": "stray dog"
                    },
                    {
                        "source": "kleiner Hund",
                        "target": "little dog"
                    },
                    {
                        "source": "sprichwörtlicher Hund",
                        "target": "proverbial dog"
                    }
                ],
                "info": "",
                "invmeanings": [
                    ""
                ],
                "lemma": "dog",  // <--definition
                "rank": "100",
                "synonym": "",
                "variant": ""
            }
        ]
}
],

```
The second noun example is `Geschäft` Below are the results for `lookup('Geschäft', 'de', 'en')`:

```json
"matches": [
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "other_expressions": [
            {
                "context": "",
                "source": "laufendes Geschäft",
                "target": "day-to-day management"
            },
            {
                "context": "",
                "source": "außerbilanzmäßiges Geschäft",
                "target": "off-balance-sheet items"
            }
        ],
        "source": {
            "inflection": "(pl:Geschäfte)", // plural
            "info": "n",  <-- gender: neuter
            "lemma": "Geschäft",
            "phonetic": "",
            "pos": "noun",  // <-- part of speech
            "term": "Geschäft"
        },
        "targets": [
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "gutes Geschäft",
                        "target": "good business"
                    },
                    {
                        "source": "grenzüberschreitendes Geschäft",
                        "target": "cross-border business"
                    },
                    {
                        "source": "schmutziges Geschäft",
                        "target": "dirty business"
                    },
                    {
                        "source": "internationales Geschäft",
                        "target": "international business"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Unternehmen",
                    "Wirtschaft",
                    "Betrieb",
                    "Tätigkeit",
                    "Business",
                    "Firma",
                    "Geschäftstätigkeit",
                    "Angelegenheit"
                ],
                "lemma": "business",  // <-- definition
                "rank": "45",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "persönliches Geschäft",
                        "target": "personal transaction"
                    },
                    {
                        "source": "kommerzielles Geschäft",
                        "target": "commercial transaction"
                    },
                    {
                        "source": "bestimmtes Geschäft",
                        "target": "specific transaction"
                    },
                    {
                        "source": "betreffendes Geschäft",
                        "target": "transaction concerned"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Transaktion",
                    "Vorgang",
                    "Umsatz",
                    "Geschäftsvorgang",
                    "Vorhaben"
                ],
                "lemma": "transaction",
                "rank": "23",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "Geschäft an der Ecke",
                        "target": "corner store"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Laden",
                    "Lager",
                    "store",
                    "Kühlhaus",
                    "Lagerhaus"
                ],
                "lemma": "store",
                "rank": "9",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "kleines Geschäft",
                        "target": "small shop"
                    },
                    {
                        "source": "zollfreies Geschäft",
                        "target": "duty-free shop"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Laden",
                    "Shop",
                    "Werkstatt",
                    "Verkaufsstelle",
                    "Atelier"
                ],
                "lemma": "shop",
                "rank": "8",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "geldpolitisches Geschäft",
                        "target": "monetary policy operation"
                    },
                    {
                        "source": "laufende Geschäft",
                        "target": "current operation"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Operation",
                    "Betrieb",
                    "Maßnahme",
                    "Tätigkeit",
                    "Vorgang",
                    "Einsatz",
                    "Aktion",
                    "Vorhaben",
                    "Anwendung"
                ],
                "lemma": "operation",
                "rank": "7",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 12668,
                "expressions": [
                    {
                        "source": "schlechtes Geschäft",
                        "target": "bad deal"
                    },
                    {
                        "source": "besseres Geschäft",
                        "target": "better deal"
                    },
                    {
                        "source": "sehr gutes Geschäft",
                        "target": "very good deal"
                    },
                    {
                        "source": "bestes Geschäft",
                        "target": "best deal"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Deal",
                    "Vereinbarung",
                    "Einigung",
                    "Sache",
                    "Abmachung",
                    "Übereinkunft",
                    "Abschluss",
                    "Transaktion"
                ],
                "lemma": "deal",
                "rank": "6",
                "synonym": "",
                "variant": ""
            }
        ]
    }
]
```

`lookup('Handeln','de', 'en')` will also return results for verb **handeln**:


```json
"matches": [
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "source": {
            "inflection": "",
            "info": "",
            "lemma": "Handeln",
            "phonetic": "",
            "pos": "noun",
            "term": "Handeln"
        },
        "targets": [
            {
                "context": "",
                "domain": "",
                "entry_id": 13951,
                "expressions": [
                    {
                        "source": "Handeln der EU",
                        "target": "action of the eu"
                    },
                    {
                        "source": "Handeln der Kommission",
                        "target": "action of the commission"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "Maßnahme",
                    "Aktion",
                    "Vorgehen",
                    "Tat",
                    "Klage",
                    "Handlung",
                    "Schritt",
                    "Aktivität",
                    "Tätigkeit"
                ],
                "lemma": "action",
                "rank": "100",
                "synonym": "",
                "variant": ""
            }
        ]
    },
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "source": {
            "inflection": "(aushandelt/aushandelte/ausgehandelt)",
            "info": "",
            "lemma": "aushandeln",
            "phonetic": "",
            "pos": "verb",
            "term": "Handeln"
        },
        "targets": [
            {
                "context": "Abkommen, Fischerei_Abkommen, Kompromiss, Vertrag",
                "domain": "",
                "entry_id": 40406,
                "expressions": [
                    {
                        "source": "mit dem rat ausgehandelt",
                        "target": "negotiated with the council"
                    },
                    {
                        "source": "Kompromiss aushandeln",
                        "target": "to negotiate compromises"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "verhandeln",
                    "aus~handeln"
                ],
                "lemma": "to negotiate",
                "rank": "96",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 40406,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "vermitteln",
                    "herbeiführen",
                    "einfädeln"
                ],
                "lemma": "to broker",
                "rank": "2",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 40406,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "ausarbeiten",
                    "erarbeiten",
                    "herausfinden",
                    "trainieren",
                    "herausarbeiten",
                    "funktionieren",
                    "klappen",
                    "draussen arbeiten"
                ],
                "lemma": "to work out",
                "rank": "1",
                "synonym": "",
                "variant": ""
            }
        ]
    },
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "source": {
            "inflection": "",
            "info": "",
            "lemma": "aus~handeln",
            "phonetic": "",
            "pos": "verb",
            "term": "Handeln"
        },
        "targets": [
            {
                "context": "Abkommen",
                "domain": "",
                "entry_id": 40556,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "verhandeln",
                    "aushandeln"
                ],
                "lemma": "to negotiate",
                "rank": "100",
                "synonym": "",
                "variant": ""
            }
        ]
    },
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "other_expressions": [
            {
                "context": "",
                "source": "entschlossen handeln",
                "target": "to take decisive action"
            },
            {
                "context": "",
                "source": "richtig handeln",
                "target": "to do well"
            },
            {
                "context": "",
                "source": "sofort handeln",
                "target": "to take action straight away"
            },
            {
                "context": "",
                "source": "endlich handeln",
                "target": "to finally take action"
            }
        ],
        "source": {
            "inflection": "(handelt/handelte/gehandelt)",
            "info": "",
            "lemma": "handeln",
            "phonetic": "",
            "pos": "verb",
            "term": "Handeln"
        },
        "targets": [
            {
                "context": "",
                "domain": "",
                "entry_id": 44824,
                "expressions": [
                    {
                        "source": "gemeinsam handeln",
                        "target": "to act together"
                    },
                    {
                        "source": "jetzt handeln",
                        "target": "to act now"
                    },
                    {
                        "source": "schnell handeln",
                        "target": "to act quickly"
                    },
                    {
                        "source": "entsprechend handeln",
                        "target": "to act accordingly"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "agieren",
                    "fungieren",
                    "wirken",
                    "auftreten",
                    "reagieren",
                    "vorgehen",
                    "sich verhalten",
                    "dienen"
                ],
                "lemma": "to act",
                "rank": "87",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 44824,
                "expressions": [
                    {
                        "source": "international gehandelt",
                        "target": "traded internationally"
                    },
                    {
                        "source": "weltweit gehandelt",
                        "target": "traded worldwide"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "austauschen",
                    "Handel treiben",
                    "tauschen",
                    "vermarkten",
                    "betreiben Handel"
                ],
                "lemma": "to trade",
                "rank": "4",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 44824,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    ""
                ],
                "lemma": "to take action",
                "rank": "4",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 44824,
                "expressions": [
                    {
                        "source": "unter normalen marktwirtschaftlichen Bedingungen handeln",
                        "target": "to operate under normal market-economy conditions"
                    }
                ],
                "info": "",
                "invmeanings": [
                    "funktionieren",
                    "betreiben",
                    "arbeiten",
                    "operieren",
                    "agieren",
                    "bedienen",
                    "wirken",
                    "fungieren"
                ],
                "lemma": "to operate",
                "rank": "2",
                "synonym": "",
                "variant": ""
            }
        ]
    },
    {
        "auto_complete": false,
        "model_name": "mono-deen.mod",
        "other_expressions": [
            {
                "context": "",
                "source": "um staatliche Beihilfen sich handeln",
                "target": "to constitute state aid"
            }
        ],
        "source": {
            "inflection": "(handelt/handelte/gehandelt)",
            "info": "",
            "lemma": "sich handeln",
            "phonetic": "",
            "pos": "verb",
            "term": "Handeln"
        },
        "targets": [
            {
                "context": "",
                "domain": "",
                "entry_id": 44825,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "sich beziehen",
                    "betreffen",
                    "verbinden",
                    "zusammenhängen",
                    "beziehen",
                    "im Zusammenhang stehen",
                    "sich erstrecken",
                    "se befassen"
                ],
                "lemma": "to relate",
                "rank": "0",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 44825,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "sich belaufen",
                    "betragen",
                    "ausmachen",
                    "hinaus~laufen",
                    "hinauslaufen",
                    "belaufen",
                    "aus~machen"
                ],
                "lemma": "to amount",
                "rank": "0",
                "synonym": "",
                "variant": ""
            },
            {
                "context": "",
                "domain": "",
                "entry_id": 44825,
                "expressions": [],
                "info": "",
                "invmeanings": [
                    "umfassen",
                    "bestehen",
                    "bestehen aus",
                    "sich erstrecken",
                    "zielen"
                ],
                "lemma": "to consist of",
                "rank": "0",
                "synonym": "",
                "variant": ""
            }
        ]
    }
]
```

`lookup('befragen', 'de', 'en')` results:

```json
"matches": [
     {
         "auto_complete": false,
         "model_name": "mono-deen.mod",
         "source": {
             "inflection": "(befragt\/befragte\/befragt)",
             "info": "",
             "lemma": "befragen",
             "phonetic": "",
             "pos": "verb",
             "term": "befragen"
         },
         "targets": [
             {
                 "context": "Bürger",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "konsultieren",
                     "ersuchen",
                     "hören",
                     "angehören",
                     "beraten",
                     "anhören",
                     "sich beraten",
                     "einsehen"
                 ],
                 "lemma": "to consult",
                 "rank": "44",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "Kommission",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "stellen",
                     "in Frage stellen",
                     "hinterfragen",
                     "infrage stellen",
                     "bezweifeln",
                     "anzweifeln",
                     "sich fragen",
                     "anfragen"
                 ],
                 "lemma": "to question",
                 "rank": "24",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "Person",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "interviewen",
                     "Interviews führen"
                 ],
                 "lemma": "to interview",
                 "rank": "15",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "verhören",
                     "vernehmen",
                     "aus~horchen",
                     "aus~fragen",
                     "ab~fragen",
                     "abfragen"
                 ],
                 "lemma": "to interrogate",
                 "rank": "4",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "Bevölkerung",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "überblicken"
                 ],
                 "lemma": "to survey",
                 "rank": "3",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "aus~fragen",
                     "verhören"
                 ],
                 "lemma": "to debrief",
                 "rank": "2",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "Leute",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     "fragen",
                     "bitten",
                     "stellen",
                     "ersuchen",
                     "auffordern",
                     "auf~fordern",
                     "verlangen",
                     "fordern",
                     "sich fragen"
                 ],
                 "lemma": "to ask",
                 "rank": "2",
                 "synonym": "",
                 "variant": ""
             },
             {
                 "context": "",
                 "domain": "",
                 "entry_id": 40849,
                 "expressions": [],
                 "info": "",
                 "invmeanings": [
                     ""
                 ],
                 "lemma": "to poll",
                 "rank": "2",
                 "synonym": "",
                 "variant": ""
             }
         ]
     }
 ]
```

The verb **kommen** has many prefix versions, and their results are returned along with the result for **kommen**. The `matches` array has 59 elements, and the results
for **kommen** are in the 24th element.

```json
"matches": [
   {
       "auto_complete": false,
       "model_name": "mono-deen.mod",
       "other_expressions": [
           {
               "context": "",
               "source": "gut ankommen",
               "target": "to go down very well"
           }
       ],
       "source": {
           "inflection": "(ankommt\/ankam\/angekommen)",
           "info": "",
           "lemma": "ankommen",
           "phonetic": "",
           "pos": "verb",
           "term": "kommen"
       },
       "targets": [
           {
               "context": "",
               "domain": "",
               "entry_id": 39662,
               "expressions": [
                   {
                       "source": "dort ankommen",
                       "target": "to arrive there"
                   },
                   {
                       "source": "am Flughafen ankommen",
                       "target": "to arrive at the airport"
                   },
                   {
                       "source": "hier ankommen",
                       "target": "to arrive here"
                   },
                   {
                       "source": "zu hause ankommen",
                       "target": "to arrive home"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "kommen",
                   "eintreffen",
                   "gelangen",
                   "an~kommen",
                   "ein~treffen"
               ],
               "lemma": "to arrive",
               "rank": "86",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39662,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "zählen",
                   "von Bedeutung sein",
                   "sein von Bedeutung",
                   "an~kommen",
                   "aus~machen",
                   "interessieren",
                   "rollen"
               ],
               "lemma": "to matter",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39662,
               "expressions": [
                   {
                       "source": "am Ziel ankommen",
                       "target": "to get there"
                   }
               ],
               "info": "",
               "invmeanings": [
                   ""
               ],
               "lemma": "to get there",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39662,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   ""
               ],
               "lemma": "to get through",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39662,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   ""
               ],
               "lemma": "to come in",
               "rank": "2",
               "synonym": "",
               "variant": ""
           }
       ]
   },
   {
       "auto_complete": false,
       "model_name": "mono-deen.mod",
       "source": {
           "inflection": "",
           "info": "",
           "lemma": "an~kommen",
           "phonetic": "",
           "pos": "verb",
           "term": "kommen"
       },
       "targets": [
           {
               "context": "",
               "domain": "",
               "entry_id": 39851,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "kommen",
                   "ankommen",
                   "eintreffen",
                   "gelangen",
                   "ein~treffen"
               ],
               "lemma": "to arrive",
               "rank": "58",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39851,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "abhängen",
                   "ab~hängen",
                   "hängen",
                   "beruhen",
                   "anweisen",
                   "verlassen",
                   "sich richten",
                   "voraus~setzen"
               ],
               "lemma": "to depend",
               "rank": "16",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39851,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   ""
               ],
               "lemma": "to get there",
               "rank": "10",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39851,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "zählen",
                   "von Bedeutung sein",
                   "ankommen",
                   "sein von Bedeutung",
                   "aus~machen",
                   "interessieren",
                   "rollen"
               ],
               "lemma": "to matter",
               "rank": "8",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 39851,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   ""
               ],
               "lemma": "to come down",
               "rank": "6",
               "synonym": "",
               "variant": ""
           }
       ]
   },
   // snip...Next element is `kommen` itself.
   {
       "auto_complete": false,
       "model_name": "mono-deen.mod",
       "other_expressions": [
           {
               "context": "",
               "source": "ins Spiel kommen",
               "target": "to come into play"
           },
           {
               "context": "",
               "source": "ums Leben kommen",
               "target": "to lose their lives"
           },
           {
               "context": "",
               "source": "in Kontakt kommen",
               "target": "to come into contact"
           },
           {
               "context": "",
               "source": "zur Abstimmung kommen",
               "target": "to proceed to the vote"
           }
       ],
       "source": {
           "inflection": "(kommt\/kam\/gekommen)",
           "info": "",
           "lemma": "kommen",
           "phonetic": "",
           "pos": "verb",
           "term": "kommen"
       },
       "targets": [
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "kommen aus einem Land",
                       "target": "to come from a country"
                   },
                   {
                       "source": "zu dem Schluss kommen",
                       "target": "to come to the conclusion"
                   },
                   {
                       "source": "nach Hause kommen",
                       "target": "to come home"
                   },
                   {
                       "source": "zusammen kommen",
                       "target": "to come together"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "stammen",
                   "sein",
                   "gelangen",
                   "fallen",
                   "gehen",
                   "entstehen",
                   "nach~hängen"
               ],
               "lemma": "to come",
               "rank": "67",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "dorthin kommen",
                       "target": "to get there"
                   },
                   {
                       "source": "soweit kommen",
                       "target": "to get here"
                   },
                   {
                       "source": "eher dorthin kommen",
                       "target": "to get there sooner"
                   },
                   {
                       "source": "zu ihrem Recht kommen",
                       "target": "to get justice"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "bekommen",
                   "erhalten",
                   "haben",
                   "werden",
                   "bringen",
                   "erreichen",
                   "machen",
                   "gelangen"
               ],
               "lemma": "to get",
               "rank": "10",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "zu einer Einigung kommen",
                       "target": "to reach agreement"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "erreichen",
                   "erzielen",
                   "gelangen",
                   "finden",
                   "treffen",
                   "schließen"
               ],
               "lemma": "to reach",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "bringen",
                   "führen",
                   "stellen",
                   "einbringen",
                   "holen",
                   "mitbringen",
                   "setzen",
                   "sorgen"
               ],
               "lemma": "to bring",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [],
               "info": "",
               "invmeanings": [
                   "ankommen",
                   "eintreffen",
                   "gelangen",
                   "an~kommen",
                   "ein~treffen"
               ],
               "lemma": "to arrive",
               "rank": "3",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "weiter kommen",
                       "target": "to go far"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "gehen",
                   "werden",
                   "fahren",
                   "reisen",
                   "hingehen",
                   "fließen",
                   "laufen",
                   "verschwinden"
               ],
               "lemma": "to go",
               "rank": "2",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "kommen auf Theorien",
                       "target": "to come up with theories"
                   },
                   {
                       "source": "hier rauf kommen",
                       "target": "to come up here"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "finden",
                   "entwickeln",
                   "zu~kommen",
                   "aufwarten",
                   "erfinden",
                   "stoßen",
                   "hochkommen",
                   "auftauchen"
               ],
               "lemma": "to come up",
               "rank": "1",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "zu einem Ergebnis kommen",
                       "target": "to achieve a result"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "erreichen",
                   "erzielen",
                   "verwirklichen",
                   "schaffen",
                   "gelangen",
                   "gelingen",
                   "erfüllen"
               ],
               "lemma": "to achieve",
               "rank": "1",
               "synonym": "",
               "variant": ""
           },
           {
               "context": "",
               "domain": "",
               "entry_id": 46150,
               "expressions": [
                   {
                       "source": "zuerst kommen",
                       "target": "to happen first"
                   }
               ],
               "info": "",
               "invmeanings": [
                   "geschehen",
                   "passieren",
                   "eintreten",
                   "stattfinden",
                   "sich ereignen",
                   "vorkommen",
                   "erfolgen"
               ],
               "lemma": "to happen",
               "rank": "1",
               "synonym": "",
               "variant": ""
           }
       ]
   }
   // snip...remaing elements not shown
   ]
```

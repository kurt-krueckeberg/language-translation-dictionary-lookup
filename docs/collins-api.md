# Collins API

The Collins [API webpage](https://www.collinsdictionary.com/collins-api) has a contact form to request API authorization. Both free and paid use is available.

## Documentation

The PDF documentation seems to have a number of errors in it; for example, the endpoint `https://api.collins.com` does not exist, while `https://api.collinsdictionary.com` does. 
The `get-entry` call returns json or xml: thus the `format`--which can be `xml` or 'html`--query parameter seems to have no use?

API documentation: [API PDF documentation](./collins-api-documentation.pdf).

### API Client Libraries

Collins does provide dlient libraries in [several programming languages](http://dps.api-lib.idm.fr/) including [PHP](http://dps.api-lib.idm.fr/libraries.html#php))

The PHP client library can be [downloaded](http://dps.api-lib.idm.fr/download.html#php). There is a version with sample queries.

### API Demo Site

The [API demo tool](https://api.collinsdictionary.com/apidemo/) allows you to run queries and see JSON results. Chrome is preferred.
 Your API key is required.

## Usage

### Endpoint

`https://api.collins.com/api/v1`

### Authorization

The authorization header is:

- `{accessKey}`: the user access key (a 64 characters text provided for the targetting API)

### Requests

#### Search

There is a `search` route and a `search/first` route. `search/first/` returns these the best matching entry first. 
Results look like these for the word **kommen**:

```json
{
    "resultNumber": 68,
    "results": [
        {
            "entryLabel": "Kommen",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/kommen_2",
            "entryId": "kommen_2"
        },
        {
            "entryLabel": "kommen",
            "entryUrl": "http://api.collinsdictionary.com/api/v1/dictionaries/german-english/entries/kommen_1",
            "entryId": "kommen_1"
        }, 
        {
             "the remainder of the results": "were omitted"
        }
         ],
    "dictionaryCode": "german-english",
    "currentPageIndex": 1,
    "pageNumber": 1
}
```

`search` returns--I guess--all results.


#### get entryID

An `entryId` is needed to get the actual definition. The `entryContent` of the JSON resonse object, can be returned as HTML or XML by specifying
the query format parameter as either HTML or XML:

- `format=html`
- `format=xml`

Note: If **XML** is desired, the format query parameter must be lowercase: `xml` not `XML`..

subsequent queries.

Are the Collins results only available in html?

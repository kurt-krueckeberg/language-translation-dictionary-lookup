## Configuration

Copy `src/config.xml` to the root directory of your application and modify it with your Systran Pro or DEEPL API key(s).

Tne .xml file looks like this:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<providers>
    <provider name="leipzig" >
           <headers></headers>
           <endpoint>http://api.corpora.uni-leipzig.de/ws</endpoint> <!-- https?? -->
   </provider>
       <provider name="deepl" >
           <endpoint>https://api-free.deepl.com/v2</endpoint>
           <headers>
               <header key="Authorization">DeepL-Auth-Key add-your-key-here</header>
           </headers>
    </provider>
    <provider name="systran" >
           <endpoint>https://api-translate.systran.net</endpoint>
           <headers>
               <header key="Authorization">Key add-your-key-here</header>
           </headers>
    </provider>
</providers>
```

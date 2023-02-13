## Configuration

Copy `src/sample-config.xml` to the root directory of your application as `config.xml` and modify it with your API key(s).

Tne format of the XML file is shown below. Modify `add-your-key-here` with your actual API key(s).

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
    <provider name="collins" abbrev ="c">
           <endpoint>https://api.collinsdictionary.com</endpoint>
           <headers>
               <header key="accessKey">add-your-key-here</header>
           </headers>
   </provider>
   <provider name='pons'>
       <!-- use the sample-config.xml as a guide to add the endpoint and your header(s) with your key(s) -->
    </provider> 
</providers>
```

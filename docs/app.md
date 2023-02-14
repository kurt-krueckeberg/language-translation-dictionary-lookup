## Sample Application

```php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{SystranTranslator, LeipzigSentenceFetcher, FileReader, ConfigFile};

include 'vendor/autoload.php';

if ($argc != 2) {

  echo "Enter the vocabulary words input file.\n";
  return;

} else if (! file_exists($argv[1]))  {

  echo "Input file does not exist.\n";
  return;
}

try {
    
    $fwords = $argv[1];
 
    $file = new FileReader($fwords);

    $c = new ConfigFile('config.xml');
    
    $sys = new SystranTranslator($c);
    
    $leipzig = new LeipzigSentenceFetcher($c);
  
    foreach ($file as $line) {
       
      $word = trim($line);
        
      $iter = $sys->lookup($word, 'de', 'en');
      
      if ($iter->valid() === false)  echo "No definitions found for $word\n";

      else
          foreach($iter as $val) 
             
             echo (string) $val . "\n";

      $iter = $leipzig->fetch_samples($word, 5);

      if ($iter->valid() === false) continue;

      foreach($iter as $de) {

        echo $de . "\n";

        echo "Translation: " . $sys->translate($de, 'en', 'de') . "\n";

      }
      echo "--------\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  }
```

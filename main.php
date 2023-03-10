#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{SystranTranslator, LeipzigSentenceFetcher, FileReader, BuildHtml, ConfigFile, ProviderID};

include 'vendor/autoload.php';


if ($argc != 3) {

  echo "Enter the vocabulary words input file, followed by html file name (without .html).\n";
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
    
    $leipzig = new LeipzigSentenceFetcher($c, ProviderID::Leipzig_de);

    $html = new BuildHtml($argv[2], "de", "en");
  
    foreach ($file as $word) {
       
        $iter = $sys->lookup($word, 'de', 'en');
      
        $cnt = $html->add_definitions($iter); 

        echo ($cnt === 0 ? "No definitions " : "Defintions ") . "found for $word.\n";   
                    
        echo $word . "\n";
           
        $iter = $leipzig->fetch_samples($word, 5);
           
        $cnt = $html->add_samples($iter, $sys); 
          
        echo   "Added $cnt samples sentences for $word.\n";
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 

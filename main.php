#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{SystranTranslator, LeipzigSentenceFetcher, FileReader, BuildHtml, ConfigFile};

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
    
    $html = new BuildHtml($argv[2], "de", "en");

    $c = new ConfigFile('config.xml');
    
    $sys = new SystranTranslator($c);
    
    $leipzig = new LeipzigSentenceFetcher($c);
  
    foreach ($file as $line) {
       
        $word = trim($line);
        
        $iter = $sys->lookup($word, 'de', 'en');
      
        if ($iter->valid() === false) 

	   echo "No definitions found for $word./n";

	else

            foreach($iter as $val) print_r($val);

        $iter = $leipzig->fetch_samples($word, 5);

        foreach($iter as $de) {

        }
           
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  }

<?php

declare(strict_types=1);

namespace LanguageTools;

use LanguageTools\{ClassID,
DictionaryInterface,
TranslateInterface,
SentenceFetchInterface,
CollinsGermanDictionary,
PonsDictionary,
PonsNounFetcher,
CollinsNounFetcher};

use \SplFileObject as File; 

class BuildHtml {

     private File  $out;

static private string $out_start = <<<html_eos
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
   <head>
      <title>German Vocab</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" media="screen" href="css/vocab.css"> 
      <link rel="stylesheet" type="text/css" media="print" href="css/print-vocab.css"> 
   </head>
<body>
html_eos;

static private string $out_end = <<<html_end
    </body>
</html>
html_end;

    public function __construct(string $ofname, string $src, string $dest)
    { 
       $this->b_saved = false;
       
       $this->src = $src;
       
       $this->dest = $dest;

       $this->out = new File($ofname . ".html", "w"); 

       $this->out->fwrite(self::$out_start);
   }

   public function add_definitions(\Iterator $iter) : int
   {
      static $sec_start =  "<section class='definitions'>\n";
      static $dl_start = "  <dl class='hwd'>\n";

      static $fmt = "  <dt>\n   <ul>\n    <li>%s</li>\n    <li class='pos'>%s</li>\n   </ul>\n  </dt>\n";    

      $sec = $sec_start;
 
      foreach($iter as $result)  {

          $dl = $dl_start;

          $dl .= sprintf($fmt, $result->word, strtoupper($result->pos));

          $defns = $this->add_defn($result->definitions);
              
          $dl .= $defns . " </dl>\n";

          $sec .= $dl;
      }
             
      $sec .= "</section>\n";
      
      $this->out->fwrite($sec);
 
      return count($iter); 
   }
  
   private function add_defn(array $definitions) : string
   {       
      $dds = '';
      static $defn_fmt =  "  <dd>%s</dd>\n";
      static $exp_fmt =  "    <dt>%s</dt>\n    <dd>%s</dd>\n";

      foreach ($definitions as $defn) {

         $dds .= sprintf($defn_fmt, $defn["definition"]);

         if (count($defn['expressions']) == 0) continue;
              
         // We have exprrssion to adda. We use a nested <dl> for the expressions.
         $exps = "  <dd class='expressions'>\n   <dl>\n"; 
         
         foreach ($defn['expressions'] as $expression) 

                $exps .= sprintf($exp_fmt, $expression->source, $expression->target);

         $exps .= "  </dl>\n  </dd>\n";
         
         $dds .=  $exps ;              
      }

      return $dds;
    }
 
    // to do: make sure the array has both 1.) sample and 2.) its translation.
     //-- public function add_samples(SentencesIterator $iter, TranslateInterface $trans) : int 
     public function add_samples(ResultsIterator $iter, TranslateInterface $trans) : int 
    {
       static $sec_samples = "<section class='samples'>";

       $str = $sec_samples;

       if (count($iter) === 0)

           $str .= "<p><span class'bold'>" . trim($word) . "<span> has no sample sentsences.</p>";

       else 

           foreach ($iter as $s) {
              
              $str .= "<p>" . $s . "</p><p>" . $trans->translate($s, 'de', 'en') . "</p>\n";
           }

       $str .= "</section>\n";

       $this->out->fwrite($this->tidy($str));

       return count($iter);
   } 

   private function tidy(string $out)
   { 
     static $tidy_config = array(
                     'clean' => true, 
                     'output-xhtml' => true, 
                     'show-body-only' => true,
                     'wrap' => 0,
                     'indent' => true
                     ); 
                     
      $tidy = tidy_parse_string($out, $tidy_config, 'UTF8');

      $tidy->cleanRepair();

      return (string) $tidy;  
   }
  

    public function __destruct()
    {
       $this->save();        
    } 

    public function save()
    {
       if (!$this->b_saved) {

            $this->out->fwrite(self::$out_end);
            $this->b_saved = true;
        } 
    }
    
}

<?php
declare(strict_types=1);
namespace LanguageTools;

enum ProviderID implements ProviderInterface {

   case  Leipzig;
   case  Systran;
   case  Azure;
   case  Ibm;
   case  Deepl;
   case  Collins;
   case  Pons;
   case  iTranslate;
   
   public function get_provider() : string
   {
       return match($this) { // Returns implementation class's abbreviation used in 'config.xml'
           ClassID::Leipzig_de  => "leipzig_de",
           ClassID::Leipzig_es  => "leipzig_es", 
           ClassID::Systran  => "systran",
           ClassID::Azure    => "azure",
           ClassID::Ibm      => "ibm",
           ClassID::Deepl    => "deepl",
           ClassID::Collins  => "collins",
           ClassID::Pons     => "pons",
           ClassID::iTranslate  => "itranslate"
       };
   }
}

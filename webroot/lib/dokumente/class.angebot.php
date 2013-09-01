<?php


class AngebotPDF extends Briefpapier {
  public $doctype;
  
  function AngebotPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="angebot";
    $this->doctypeOrig="Angebot";
    parent::Briefpapier(&$this->app);
  } 


  function GetAngebot($id)
  {
      $adresse = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");
      $this->setRecipientDB($adresse);


      // OfferNo, customerId, OfferDate

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM angebot WHERE id='$id' LIMIT 1");
      $anfrage= $this->app->DB->Select("SELECT anfrage FROM angebot WHERE id='$id' LIMIT 1");
      $vertrieb= $this->app->DB->Select("SELECT vertrieb FROM angebot WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM angebot WHERE id='$id' LIMIT 1");
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM angebot WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
      $freitext = $this->app->DB->Select("SELECT freitext FROM angebot WHERE id='$id' LIMIT 1");

      $this->doctypeOrig="Angebot $belegnr";

      if($angebot=="") $angebot = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Anfrage"=>$anfrage,"Ihre Kunden-Nr."=>$kundennummer,"Bestelldatum"=>$datum,"Vertrieb"=>$vertrieb));

      $this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nhiermit wir bieten Ihnen wir an:", 
	  "footer"=>"$freitext\n\nDieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig."));
      
      $artikel = $this->app->DB->SelectArr("SELECT * FROM angebot_position WHERE angebot='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM angebot_position WHERE angebot='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	if(!$this->app->erp->AngebotMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 
	$this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],'tax'=>$value[umsatzsteuer],'itemno'=>$value[nummer],
	  "name"=>$value[bezeichnung]));
      }
      $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE angebot='$id'");

      $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE angebot='$id' AND umsatzsteuer='normal'")/100 * 19;
      $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE angebot='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
      
      if($this->app->erp->AngebotMitUmsatzeuer($id))
      {
	$this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));

      /* Dateiname */
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM angebot WHERE id='$id' LIMIT 1");
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
      $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
      $tmp_name = str_replace('.','',$tmp_name);

      $this->filename = $datum."_AN".$belegnr."_".$tmp_name.".pdf";
      $this->setBarcode($id);
  }


}
?>

<?php


class BestellungPDF extends Briefpapier {
  public $doctype;
  
  function BestellungPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="bestellung";
    $this->doctypeOrig="Bestellung";
    parent::Briefpapier(&$this->app);
  } 


  function GetBestellung($id)
  {
      $adresse = $this->app->DB->Select("SELECT adresse FROM bestellung WHERE id='$id' LIMIT 1");
      $this->setRecipientDB($adresse);


      // OfferNo, customerId, OfferDate

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM bestellung WHERE id='$id' LIMIT 1");
      $angebot = $this->app->DB->Select("SELECT angebot FROM bestellung WHERE id='$id' LIMIT 1");
      $einkaeufer = $this->app->DB->Select("SELECT einkaeufer FROM bestellung WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM bestellung WHERE id='$id' LIMIT 1");
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM bestellung WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$id' LIMIT 1");
      $freitext = $this->app->DB->Select("SELECT freitext FROM bestellung WHERE id='$id' LIMIT 1");

      $this->doctypeOrig="Bestellung $belegnr";

      if($angebot=="") $angebot = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Angebot-Nr."=>$angebot,"Unsere Kunden-Nr."=>$kundennummer,"Bestelldatum"=>$datum,"Einkäufer"=>$einkaeufer));

      if($bestellbestaetigung)
      {
	$this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nwir bestellen hiermit:", 
	  "footer"=>"Die Bestellung ist erst nach Eingang einer Auftragsbestätigung Ihrerseits an die embedded projects GmbH gültig. Wird die Bestellung bis zum xx.xx.xxxx nicht bestätigt verfällt diese.\n\n		  $freitext"));
      } else 
      {
	$this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nwir bestellen hiermit:", 
	  "footer"=>"Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.\n\n$freitext"));
      }
      $artikel = $this->app->DB->SelectArr("SELECT * FROM bestellung_position WHERE bestellung='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM bestellung_position WHERE bestellung='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	if(!$this->app->erp->BestellungMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 
	$this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],'tax'=>$value[umsatzsteuer],'itemno'=>$value[bestellnummer],
	  "name"=>$value[bezeichnunglieferant],'desc'=>"Lieferdatum ".$this->app->String->Convert($value[lieferdatum],"%1-%2-%3","%3.%2.%1")));
      }
      $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id'");

      $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id' AND umsatzsteuer='normal'")/100 * 19;
      $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
      
      if($this->app->erp->BestellungMitUmsatzeuer($id))
      {
	$this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));

      /* Dateiname */
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM bestellung WHERE id='$id' LIMIT 1");
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$id' LIMIT 1");
      $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
      $tmp_name = str_replace('.','',$tmp_name);

      $this->filename = $datum."_BE".$belegnr."_".$tmp_name.".pdf";
      $this->setBarcode($id);
  }


}
?>

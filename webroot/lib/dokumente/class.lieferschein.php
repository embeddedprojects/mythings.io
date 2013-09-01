<?php


class LieferscheinPDF extends Briefpapier {
  public $doctype;
  
  function LieferscheinPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="lieferschein";
    $this->doctypeOrig="Lieferschein";
    parent::Briefpapier(&$this->app);
  } 


  function GetLieferschein($id)
  {
      $adresse = $this->app->DB->Select("SELECT adresse FROM lieferschein WHERE id='$id' LIMIT 1");
      $this->setRecipientDB($adresse);


      // OfferNo, customerId, OfferDate

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM lieferschein WHERE id='$id' LIMIT 1");
      $auftrag = $this->app->DB->Select("SELECT auftrag FROM lieferschein WHERE id='$id' LIMIT 1");
      $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM lieferschein WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM lieferschein WHERE id='$id' LIMIT 1");
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM lieferschein WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
      $freitext = $this->app->DB->Select("SELECT freitext FROM lieferschein WHERE id='$id' LIMIT 1");

      $this->doctype="deliveryreceipt";
      $this->doctypeOrig="Lieferschein $belegnr";

      if($lieferschein=="") $lieferschein = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Auftrag"=>$auftrag,"Ihre Kunden-Nr."=>$kundennummer,"Versand"=>$datum,"Versand"=>$bearbeiter));

      $this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nwir liefern Ihnen:", 
	  "footer"=>"$freitext"));
      
      $artikel = $this->app->DB->SelectArr("SELECT * FROM lieferschein_position WHERE lieferschein='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM lieferschein_position WHERE lieferschein='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	$this->addItem(array('amount'=>$value[menge],'itemno'=>$value[bestellnummer],
	  "name"=>$value[bezeichnunglieferant]));
	//$this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],'tax'=>$value[umsatzsteuer],'itemno'=>$value[bestellnummer],
	//  "name"=>$value[bezeichnunglieferant]));
      }
      

      /* Dateiname */
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM lieferschein WHERE id='$id' LIMIT 1");
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
      $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
      $tmp_name = str_replace('.','',$tmp_name);

      $this->filename = $datum."_LS".$belegnr."_".$tmp_name.".pdf";
      $this->setBarcode($id);
  }


}
?>

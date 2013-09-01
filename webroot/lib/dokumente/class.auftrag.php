<?php


class AuftragPDF extends Briefpapier {
  public $doctype;
  
  function AuftragPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="auftrag";
    $this->doctypeOrig="Auftrag";
    parent::Briefpapier(&$this->app);
  } 


  function GetAuftrag($id)
  {
      $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
      $this->setRecipientDB($adresse);


      // OfferNo, customerId, OfferDate

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM auftrag WHERE id='$id' LIMIT 1");
      $anfrage= $this->app->DB->Select("SELECT angebot FROM auftrag WHERE id='$id' LIMIT 1");
      $vertrieb= $this->app->DB->Select("SELECT vertrieb FROM auftrag WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM auftrag WHERE id='$id' LIMIT 1");
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM auftrag WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
      $freitext = $this->app->DB->Select("SELECT freitext FROM auftrag WHERE id='$id' LIMIT 1");

      $this->doctypeOrig="Auftragsbestätigung $belegnr";

      if($auftrag=="") $auftrag = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Angebot"=>$anfrage,"Ihre Kunden-Nr."=>$kundennummer,"Auftragsdatum"=>$datum,"Vertrieb"=>$vertrieb));

      $this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nvielen Dank für Ihren Auftrag.", 
	  "footer"=>"$freitext\n\nDieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig."));
      
      $artikel = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM auftrag_position WHERE auftrag='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	if(!$this->app->erp->AuftragMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 
	$this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],'tax'=>$value[umsatzsteuer],'itemno'=>$value[nummer],
	  "name"=>$value[bezeichnung]));
      }
      $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id'");

      $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id' AND umsatzsteuer='normal'")/100 * 19;
      $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
      
      if($this->app->erp->AuftragMitUmsatzeuer($id))
      {
	$this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));

      /* Dateiname */
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM auftrag WHERE id='$id' LIMIT 1");
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
      $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
      $tmp_name = str_replace('.','',$tmp_name);

      $this->filename = $datum."_AB".$belegnr."_".$tmp_name.".pdf";
      $this->setBarcode($id);
  }


}
?>

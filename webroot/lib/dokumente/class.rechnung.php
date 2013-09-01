<?php


class RechnungPDF extends Briefpapier {
  public $doctype;
  
  function RechnungPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="rechnung";
    $this->doctypeOrig="Rechnung";
    parent::Briefpapier(&$this->app);
  } 


  function GetRechnung($id)
  {
      $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
      $this->setRecipientDB($adresse);

      // OfferNo, customerId, OfferDate

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM rechnung WHERE id='$id' LIMIT 1");
      $aauftrag= $this->app->DB->Select("SELECT auftrag FROM rechnung WHERE id='$id' LIMIT 1");
      $buchhaltung= $this->app->DB->Select("SELECT buchhaltung FROM rechnung WHERE id='$id' LIMIT 1");
      $lieferschein = $this->app->DB->Select("SELECT lieferschein FROM rechnung WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM rechnung WHERE id='$id' LIMIT 1");
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
      $freitext = $this->app->DB->Select("SELECT freitext FROM rechnung WHERE id='$id' LIMIT 1");
      $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$id' LIMIT 1");
      $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");
      $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM rechnung WHERE id='$id' LIMIT 1");


      $zahlungdatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltage DAY),'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");

      if($zahlungsweise=="Rechnung"&&$zahlungsstatus!="bezahlt")
      {
	$zahlungsweisetext = "Rechnung zahlbar innerhalb $zahlungszieltage Tagen bis zum $zahlungdatum.";
	if($zahlungszielskonto!=0)
	  $zahlungsweisetext .=" (Skonto $zahlungszielskonto % innerhalb $zahlungszieltageskonto Tagen)";	
      } elseif($zahlungsweise=="Bar")
      {
	$zahlungsweisetext = "Rechnung: Barzahlung";
      } elseif($zahlungsweise=="Nachnahme")
      {
	$zahlungsweisetext = "Rechnung: Bezahlung per Nachnahme";
      } else {
	if($zahlungsstatus!="bezahlt")
	  $zahlungsweisetext = "Die Rechnung muss per Vorkasse bezahl werden. Zahlungsweise: $zahlungsweise";
	else
	  $zahlungsweisetext = "Die Rechnung wurde per Vorkasse ($zahlungsweise) bezahlt";
      }
      

      $this->doctypeOrig="Rechnung $belegnr";

      if($rechnung=="") $rechnung = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Auftrag"=>$auftrag,"Datum"=>$datum,"Ihre Kunden-Nr."=>$kundennummer,"Lieferschein"=>$lieferschein,"Buchhaltung"=>$buchhaltung));

      $this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nanbei Ihre Rechnung.", 
	  "footer"=>"$freitext".$zahlungsweisetext."\n\nDieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig."));
      
      $artikel = $this->app->DB->SelectArr("SELECT * FROM rechnung_position WHERE rechnung='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM rechnung_position WHERE rechnung='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	if(!$this->app->erp->RechnungMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 
	$this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],'tax'=>$value[umsatzsteuer],'itemno'=>$value[nummer],
	  "name"=>$value[bezeichnung]));
      }
      $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id'");

      $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id' AND umsatzsteuer='normal'")/100 * 19;
      $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
      
      if($this->app->erp->RechnungMitUmsatzeuer($id))
      {
	$this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));

      /* Dateiname */
      $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM rechnung WHERE id='$id' LIMIT 1");
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
      $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
      $tmp_name = str_replace('.','',$tmp_name);

      $this->filename = $datum."_RE".$belegnr."_".$tmp_name.".pdf";
      $this->setBarcode($id);
  }


}
?>

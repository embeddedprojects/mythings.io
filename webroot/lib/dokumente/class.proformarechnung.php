<?php


class ProformaRechnungPDF extends Briefpapier {
  public $doctype;
  
  function ProformaRechnungPDF($app)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="rechnung";
    $this->doctypeOrig="Rechnung";
    parent::Briefpapier(&$this->app);
  } 


  function GetProformaRechnung($data)
  {
    $this->recipient['enterprise'] = $data[name];

    $this->recipient['address1']     = $data[strasse];
    $this->recipient['areacode']     = $data[plz];
    $this->recipient['city']         = $data[ort];
    $this->recipient['kundentyp']    = $data[adresse];

    if($this->recipient['city']!="")
      $this->recipient['country']      = $data[land];

      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM rechnung WHERE id='$id' LIMIT 1");
      $auftrag= "Online-Shop";
      $buchhaltung= $this->app->DB->Select("SELECT buchhaltung FROM rechnung WHERE id='$id' LIMIT 1");
      $lieferschein = $this->app->DB->Select("SELECT lieferschein FROM rechnung WHERE id='$id' LIMIT 1");
      $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM rechnung WHERE id='$id' LIMIT 1");
      $datum = date('d.m.Y');
      $belegnr = $data[onlinebestellnummer];
      $freitext = $this->app->DB->Select("SELECT freitext FROM rechnung WHERE id='$id' LIMIT 1");
      $zahlungsweise = $data[zahlungsweise];
      $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");
      $zahlungszieltage = 14;


      $zahlungdatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltage DAY),'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");

      if($zahlungsweise=="rechnung")
      {
	$zahlungsweisetext = "Rechnung zahlbar innerhalb $zahlungszieltage Tage nach Erhalt der Rechnung.";
      } elseif($zahlungsweise=="bar")
      {
	$zahlungsweisetext = "Die Ware wird in Bar bei Abholung bezahlt.";
      } elseif($zahlungsweise=="kreditkarte")
      {
	$zahlungsweisetext = "Die Ware wird per Kreditkarte bezahlt.";
      } 
      elseif($zahlungsweise=="nachnahme")
      {
	$zahlungsweisetext = "Nachnahme: Beachten Sie das die Post zum Betrag nochmals 2.00 EUR bei Übergabe des Paketes berechnet.";
      } 
      elseif($zahlungsweise=="paypal")
      {
	$zahlungsweisetext = "Die Ware wird per Paypal bezahlt.";
      } 
      else {
	  $zahlungsweisetext = "Die Rechnung muss per Vorkasse bezahlt werden.\n\nBankverbindung:\nembedded projects GmbH, Konto 020746400, Deutsche Bank, BLZ 72070001\nIBAN DE75720700010020746400, BIC/SWIFT DEUTDEMM720, Deutsche Bank";
      }
      

      $this->doctypeOrig="Proforma-Rechnung $belegnr";

      if($rechnung=="") $rechnung = "-";
      if($kundennummer=="") $kundennummer= "-";

      $this->setCorrDetails(array("Auftrag"=>$auftrag,"Datum"=>$datum,"Ihre Kunden-Nr."=>$kundennummer));

      $this->setTextDetails(array(
	  "body"=>"Sehr geehrte Damen und Herren,\n\nanbei Ihre Proforma-Rechnung.", 
	  "footer"=>"$freitext".$zahlungsweisetext."\n\nDieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig."));
      
      $artikel = $data[articlelist];//$this->app->DB->SelectArr("SELECT * FROM rechnung_position WHERE rechnung='$id' ORDER By sort");

      //$waehrung = $this->app->DB->Select("SELECT waehrung FROM rechnung_position WHERE rechnung='$id' LIMIT 1");
      foreach($artikel as $key=>$value)
      {
	//if(!$this->app->erp->RechnungMitUmsatzeuer($id)) $value[tax] = ""; 
	if($value[taxtype]==$value[tax])
	{
	  $this->addItem(array('currency'=>'EUR','amount'=>$value[quantity],'price'=>$value[price],'tax'=>$value[tax],'itemno'=>$value[articleid],
	    "name"=>$value[title]));
	  $mitsteuer++;
	}
	else
	{
	  $this->addItem(array('currency'=>'EUR','amount'=>$value[quantity],'price'=>$value[price]/(100+$value[taxtype])*100,'tax'=>$value[tax],'itemno'=>$value[articleid],
	    "name"=>$value[title]));
	  $summeNetto += ($value[price]/(100+$value[taxtype])*100)*$value[quantity];
	}

      }
      $summe = CartGetTotalSumNetto($data[articlelist]);

      $summeV = CartGetTotalSumTax($data[articlelist]);
      $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
      
      //if($this->app->erp->RechnungMitUmsatzeuer($id))
      if($mitsteuer > 0)
      {
	$this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
      {
	$this->setTotals(array("totalArticles"=>$summeNetto,"total"=>$summeNetto));
      }

      /* Dateiname */
      //$datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM rechnung WHERE id='$id' LIMIT 1");
      $datum = date('Ydm');
      $belegnr= $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");

      $this->filename = $datum."_PR.pdf";
      $this->setBarcode($id);
  }


}
?>

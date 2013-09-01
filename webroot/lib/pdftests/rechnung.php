<?php

error_reporting(E_ALL ^ E_NOTICE);

//include("class.db.php");
include("../class.briefpapier.php");

	 /*BENE
    $this->bestellung = $db->SelectArr("
    SELECT shop_bestellungen.*,
    DATE_FORMAT(shop_bestellungen.datum,'%d.%m.%Y') as datum,
    DATE_FORMAT(shop_bestellungen.versendetam,'%d.%m.%Y') as versendetam,
    shop_versandart.name as versandart,
    shop_versandart.preis as versandpreis,
    shop_versandart.tax as versandtax,
    shop_zahlungsweise.name as zahlungsweise,
    shop_zahlungsweise.rechnungstext as zahlungsweisetext,
    shop_zahlungsweise.preis as zahlungsweisepreis,
    shop_zahlungsweise.tax as zahlungsweisetax
    FROM shop_bestellungen,shop_versandart,shop_zahlungsweise
    WHERE shop_versandart.id = shop_bestellungen.versandart 
    AND shop_zahlungsweise.id = shop_bestellungen.zahlungsmethode 
    AND shop_bestellungen.id= '".$id."' LIMIT 1"
    ); 
    $this->bestellung = $this->bestellung[0]; 

		$this->bestellung[lastschrift_kontonummer] = substr_replace($this->bestellung[lastschrift_kontonummer], 'xxx', -3, 3);
		$this->bestellung[zahlungsweisetext] = str_replace('%kundenkonto%',$this->bestellung[lastschrift_kontonummer],$this->bestellung[zahlungsweisetext]);
		$this->bestellung[zahlungsweisetext] = str_replace('%kundenbank%',$this->bestellung[lastschrift_bank],$this->bestellung[zahlungsweisetext]);
		$this->bestellung[zahlungsweisetext] = str_replace('%kundenblz%',$this->bestellung[lastschrift_blz],$this->bestellung[zahlungsweisetext]);
*/
		
		
		// $myRechnung = new PDFDocument("Rechnung");
		$myRechnung = new Briefpapier("Bestellung");

		
    //$myRechnung->setSender(array("Embedded Projects","Benedikt","Sauter","Holzbachstr. 4","86150","Augsburg"));

    $myRechnung->setDocumentDetails(
				"sender", 
				array("enterprise"=>"Embedded Projects","firstname"=>"Benedikt","familyname"=>"Sauter","address1"=>"Holzbachstr. 4","address2"=>"EG","areacode"=>"86150","city"=>"Augsburg", "country"=>"Germany", "phone1"=>"+(49) 821 279599-0", "fax"=>"+(49) 821 279599-20", "email"=>"info@embedded-projects.net", "web"=>"www.embedded-projects.net", "taxnr"=>"109/125/52073", "ustid"=>"DE263136143", "hreg"=>"Augsburg, HRB 23930")
		);

		$myRechnung->setRecipient(array("DrakeData","Ralph","Voigt","Theodor-Heuss-Platz 8","86150","Augsburg"));
		
    $myRechnung->setCorrDetails(array("Rechnungs-Nr."=>"12345","Kunden-Nr."=>"1001","Bestellung vom"=>"30.10.2009","Rechnungs-/Lieferdatum"=>"02.11.2009"));
		$myRechnung->setTextDetails(array("footer"=>"Wir danken für Ihren Auftrag"));
		
		/*
		totalArticles 	- Summe aller Artikelpreise
		modeOfDispatch 	- Versandart
		priceOfDispatch	- Versandkosten
		modeOfPayment		- Zahlungsweise
		priceOfPayment	- Kosten der Zahlungsweise
		total 					= totalArticles + priceOfDispatch + priceOfPayment
		totalTaxV			- Summe voller Steuersatz
		totalTaxR			- Summe reduzierter Steuersatz
		*/
		$myRechnung->setTotals(array("totalArticles"=>"24.88","modeOfDispatch"=>"DHL","priceOfDispatch"=>"4.80","modeOfPayment"=>"Überweisung","priceOfPayment"=>"0.00","total"=>"29.68","totalTaxV"=>"4.73","totalTaxR"=>"0.00"));
		
    //$myRechnung->SetSender($db->SelectArr("SELECT * FROM shop_stammdaten LIMIT 1"));

    //$myRechnung->addItem($db->SelectArr("SELECT shop_bestellungen_artikel.*  FROM shop_bestellungen_artikel WHERE bestellungen_id= '".$id."'")); 
    $myRechnung->addItem(array('amount'=>'1','itemno'=>'TGZ723591-123','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem Geschmack"));
    $myRechnung->addItem(array('amount'=>'1','itemno'=>'TGZ723591-123','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myRechnung->addItem(array('amount'=>'1','itemno'=>'TGZ723591-123','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myRechnung->addItem(array('amount'=>'1','itemno'=>'TGZ723591-123','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myRechnung->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myRechnung->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myRechnung->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myRechnung->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
		
		$myRechnung->setLogo("logo_briefkopf.jpg");
		$myRechnung->setBarcode("test12345");
		$myRechnung->displayDocument();


/*
$brief = new PDFDocument("Bestellung");

// alles als klassenvariablen abbilden mit default werten aus app->fuelle
// fuer jeden wert eine Zugrifffunktion

$brief->BestellNr("12345");
$brief->BestellDatum("24.12.2009");
$brief->ComNr("1234");
$brief->Kundennummer("1234");
$brief->Absender($adresse);


// als "Body der Rechnung" kann man verschiedene Funktionen aufrufen

$brief->Standardbrief("Betreff der Briefs","text in html mit <br> und einfachen html");

oder wenn es eine Rechnung werden soll
$brief->Rechnung("nummer"); // entsprechend des typs muss der EAN Code codiert werden, rechnungsnummer, lieferschein ...
$brief->RechnungAddArtikel("artikel nr", "name", "langetext", "preis", "menge", "tax", "rabatt","lieferung datum", "lieferscheinnummer");
$brief->RechnungEULieferung("BG12919292");
$brief->RechnungExport("BG12919292");
$brief->RechnungZahlungsziel("30 Tage netto");
$brief->RechnungSkonto("2%","14 tage");



$brief->Angebot("nummer")
....



$brief->Lieferschein("nummer");


*/
?>


<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.briefpapier.php");
	
		$myCreditNote = new Briefpapier("Gutschrift");

    $myCreditNote->setDocumentDetails(
				"sender", 
				array("enterprise"=>"Embedded Projects","firstname"=>"Benedikt","familyname"=>"Sauter","address1"=>"Holzbachstr. 4","address2"=>"EG","areacode"=>"86150","city"=>"Augsburg", "country"=>"Germany", "phone1"=>"+(49) 821 279599-0", "fax"=>"+(49) 821 279599-20", "email"=>"info@embedded-projects.net", "web"=>"www.embedded-projects.net", "taxnr"=>"109/125/52073", "ustid"=>"DE263136143")
		);

		$myCreditNote->setRecipient(array("DrakeData","Ralph","Voigt","Theodor-Heuss-Platz 8","86150","Augsburg"));
		
    $myCreditNote->setBoldCorrDetails(array("Gutschrift-Nr."=>"900011","Kunden-Nr."=>"10002","Gutschriftdatum"=>"05.06.2009"));
    $myCreditNote->setCorrDetails(array("Unsere UST-ID"=>"DE263136143", "Unsere Steuernr."=>"103/125/52073"));
		$myCreditNote->setTextDetails(array("body"=>"Sehr geehrter Herr Wilhelm,\n\nSie erhalten hiermit folgendes gutgeschrieben:"));
		
    $myCreditNote->addItem(array('amount'=>'-1','itemno'=>'AT-JTAGICE-ICE01','price'=>242.86,'tax'=>'USTV','name'=>'AVR-Programming Tool JTAG ICE MKII'));
		
		
		$myCreditNote->setLogo("logo_briefkopf.jpg");
		
		$myCreditNote->setTotals(array("totalArticles"=>"-242.86","total"=>"-289.00","totalTaxV"=>"-46.14"));
		
		$myCreditNote->displayDocument();

?>


<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.briefpapier.php");
	
		$myConfirmation = new Briefpapier("Auftragsbestätigung");

    $myConfirmation->setDocumentDetails(
				"sender", 
				array("enterprise"=>"Embedded Projects","firstname"=>"Benedikt","familyname"=>"Sauter","address1"=>"Holzbachstr. 4","address2"=>"EG","areacode"=>"86150","city"=>"Augsburg", "country"=>"Germany", "phone1"=>"+(49) 821 279599-0", "fax"=>"+(49) 821 279599-20", "email"=>"info@embedded-projects.net", "web"=>"www.embedded-projects.net", "taxnr"=>"109/125/52073", "ustid"=>"DE263136143")
		);

		$myConfirmation->setRecipient(array("DrakeData","Ralph","Voigt","Theodor-Heuss-Platz 8","86150","Augsburg"));
		
		// ConfirmationNo, customerId, ConfirmationDate
    $myConfirmation->setBoldCorrDetails(array("Auftragsbest-Nr."=>"4711","Kunden-Nr."=>"10373","Datum"=>"22.03.2009"));
    $myConfirmation->setCorrDetails(array("Unsere UST-ID"=>"DE263136143", "Ihre UST-ID"=>"ATU 62011959"));
		$myConfirmation->setTextDetails(array("body"=>"Sehr geehrte Damen und Herren,\n\nwir bestätigen Ihnen hiermit gemäß Ihrer Bestellung wie folgt:", "footer"=>"Zahlbar innerhalb 30 Tagen bis zum 21.04.2009 ohne Abzüge\nSkonto innerhalb 14 Tage 2%\nZahlweise: Rechnung\nWir danken für Ihren Auftrag und verbleiben mit freundlichen Grüßen."));
		
    $myConfirmation->addItem(array('amount'=>'1','itemno'=>'EP-USBPROG-PROG01','price'=>28.57,'tax'=>'USTV','name'=>'usbprog v3.0', "desc"=>"Adapter vormontiert"));
		
		
		$myConfirmation->setLogo("logo_briefkopf.jpg");
		
		$myConfirmation->setTotals(array("totalArticles"=>"31.89","priceOfDispatch"=>"3.32","total"=>"37.95","totalTaxV"=>"6.06"));
		
		$myConfirmation->displayDocument();

?>


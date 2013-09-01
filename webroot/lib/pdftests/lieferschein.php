<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.briefpapier.php");
	
		$myDeliveryReceipt = new Briefpapier("Lieferschein");

    $myDeliveryReceipt->setDocumentDetails(
				"sender", 
				array("enterprise"=>"Embedded Projects","firstname"=>"Benedikt","familyname"=>"Sauter","address1"=>"Holzbachstr. 4","address2"=>"EG","areacode"=>"86150","city"=>"Augsburg", "country"=>"Germany", "phone1"=>"+(49) 821 279599-0", "fax"=>"+(49) 821 279599-20", "email"=>"info@embedded-projects.net", "web"=>"www.embedded-projects.net", "taxnr"=>"109/125/52073", "ustid"=>"DE263136143")
		);

		$myDeliveryReceipt->setRecipient(array("DrakeData","Ralph","Voigt","Theodor-Heuss-Platz 8","86150","Augsburg"));
		
		// deliveryReceiptNo, customerId, deliveryReceiptDate
    $myDeliveryReceipt->setCorrDetails(array("Lieferschein-Nr."=>"300173","Kunden-Nr."=>"10190","Lieferscheindatum"=>"11.04.2009"));
		$myDeliveryReceipt->setTextDetails(array("body"=>"Sehr geehrter Herr Träger,\n\nwir liefern Ihnen hiermit gemäß Ihrer Bestellung wie folgt:", "footer"=>"Wir danken für Ihren Auftrag und verbleiben mit freundlichen Grüßen."));
		
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem Geschmack"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myDeliveryReceipt->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
		
		$myDeliveryReceipt->setLogo("logo_briefkopf.jpg");
		$myDeliveryReceipt->setBarcode("test12345");
		$myDeliveryReceipt->displayDocument();

?>


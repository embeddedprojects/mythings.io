<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.briefpapier.php");
	
		$myOffer = new Briefpapier("Angebot");

    $myOffer->setDocumentDetails(
				"sender", 
				array("enterprise"=>"Embedded Projects","firstname"=>"Benedikt","familyname"=>"Sauter","address1"=>"Holzbachstr. 4","address2"=>"EG","areacode"=>"86150","city"=>"Augsburg", "country"=>"Germany", "phone1"=>"+(49) 821 279599-0", "fax"=>"+(49) 821 279599-20", "email"=>"info@embedded-projects.net", "web"=>"www.embedded-projects.net", "taxnr"=>"109/125/52073", "ustid"=>"DE263136143")
		);

		$myOffer->setRecipient(array("DrakeData","Ralph","Voigt","Theodor-Heuss-Platz 8","86150","Augsburg"));
		
		// OfferNo, customerId, OfferDate
    $myOffer->setCorrDetails(array("Angebot-Nr."=>"100022","Kunden-Nr."=>"10190","Datum"=>"03.12.2009","Ihre UST-ID"=>"DE123456789"));
		$myOffer->setTextDetails(array("body"=>"Sehr geehrte Damen und Herren,\n\nwir bieten Ihnen hiermit gemäß Ihrer Anfrage wie folgt an:", "footer"=>"Wir hoffen, dass Ihnen unser Angebot zusagt und verbleiben mit freundlichen Grüßen."));
		
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem Geschmack"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Mit Geschmack!"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
    $myOffer->addItem(array('amount'=>'1','price'=>7.0,'tax'=>'USTV','name'=>'Apfel', "desc"=>"Eine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem GeschmackEine Kernfrucht mit süßlich-saurem Geschmack"));
		
		$myOffer->setLogo("logo_briefkopf.jpg");
		
		$myOffer->setTotals(array("totalArticles"=>"24.88","total"=>"24.88"));
		
		$myOffer->displayDocument();

?>


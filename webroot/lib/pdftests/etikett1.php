<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.etikett.php");
		
		$etikett = new Etikett("chargeklein");

		$etikett->setBarcode("123456");
		$etikett->setBarcode2("1234");
		$etikett->setPreBarcodeText("IC");
		$etikett->setPreBarcode2Text("CH");
		$etikett->setSubBarcodeText("100.015   13");
		$etikett->displayDocument();

?>


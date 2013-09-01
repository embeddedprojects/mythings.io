<?php

error_reporting(E_ALL ^ E_NOTICE);

include("../class.etikett.php");
		
		$etikett = new Etikett("chargegross");

		$etikett->setBarcode("test12345test12345");
		$etikett->setSubBarcodeText("IC: 100.015\nValue:  AT32AP7000-CTUT\nVP Art: Stueck\nVPE:    1");

		$etikett->setBarcode2("test12345test12345");
		$etikett->setSubBarcode2Text("CH:  13");

		$etikett->setPostBarcodeText("PCB:\nToler.:\nErstbestand:");

		$etikett->displayDocument();

?>


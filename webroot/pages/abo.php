<?php

class Abo 
{
  function Abo(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","AboList");
    $this->app->ActionHandler("order","AboOrder");
    $this->app->ActionHandler("storno","AboStorno");
    $this->app->ActionHandler("verlosung","AboVerlosung");
    $this->app->DefaultActionHandler("order");

    $this->app->ActionHandlerListen(&$app);
  }

  function AboList()
  {
    $userid = $this->app->User->GetAdresse();  
    $this->app->erp->Hilfebox("hilfeartikelabo");
    
    $verlaengerung = $this->app->Secure->GetPOST("verlaengerung");
    $adresstyp = $this->app->Secure->GetPOST("adresstyp");
    $name = $this->app->Secure->GetPOST("name");
    $strasse = $this->app->Secure->GetPOST("strasse");
    $zusatz = $this->app->Secure->GetPOST("zusatz");
    $plz = $this->app->Secure->GetPOST("plz");
    $ort = $this->app->Secure->GetPOST("ort");
    $auswahl = $this->app->Secure->GetPOST("auswahl");
    $submit = $this->app->Secure->GetPOST("save");
    $saverows = $this->app->Secure->GetPOST("saverows");

    // Prüfe ob aktive Abo's vorhanden
    $abos = $this->app->DB->Select("SELECT COUNT(a.id)
				    FROM journal_abonnements as a
				    Left Join journal_aborechnung as r
				    ON a.rechnung=r.id
				    WHERE a.versanddatum='0000-00-00'
				    AND r.aktiv='1'
				    AND r.adresse = '$userid'");
    // Wenn ja schicke weiter zur Übericht
    if($abos==0)
    {
      header("Location: ./index.php?module=abo&action=order");
      exit;
    }
  /* 
    // Überprüfe ob Storno der aktuellen Rechnung zur Verfügung steht
    $storno_moeglich = $this->app->DB->Select("SELECT jabo.id
					       FROM journal_abonnements AS jabo
					       JOIN journal_aborechnung AS jrec ON jabo.rechnung = jrec.id
					       WHERE jrec.adresse = '$userid'
					       AND jrec.id = (SELECT MAX(id) FROM journal_aborechnung WHERE adresse='$userid')
					       AND versanddatum != '0000-00-00' LIMIT 1");
*/

    // nur solange es noch nicht importiert wurde
    $checkid = $this->app->DB->Select("SELECT id FROM auftraege WHERE sessionid='".session_id()."' LIMIT 1");
    if(is_numeric($checkid)) $storno_moeglich = 1; else $storno_moeglich="";

    //if(!is_numeric($storno_moeglich))
    if($storno_moeglich=="1")
    {
      $this->app->Tpl->Set(STORNO, "<div class=\"info\">Solange die Rechnung nicht verschickt wurde, 
				    haben Sie die Möglichkeit ihre Bestellung r&uuml;ckgängig zu machen.<br>
				    Klicken Sie zum Stornieren 
				    <a href=\"#\" onclick=\"if(!confirm('Wollen Sie Ihr Abonnement wirklich stornieren?')) return false; 
						    else window.location.href='./index.php?module=abo&action=storno';\">
				    hier</a>.</div>");
    }

    // Zeichne die letzten vier Ausgaben
    $lastFourJournals = $this->app->DB->SelectArr("SELECT * FROM journal_archiv ORDER BY erscheinungsdatum LIMIT 4");
    
    for($i=0;$i<count($lastFourJournals);$i++)
    {
      $id = $lastFourJournals[$i][id];
      $jname = $lastFourJournals[$i][name];
      $bildtyp = $lastFourJournals[$i][bildtyp];

      if($i%2==0)
	$vorschau .="<tr>";

      $vorschau .= "<td align=\"center\">
		      <a href=\"./index.php?module=archiv&action=image&id=$id&{$this->getImageExtension($bildtyp)}\" title=\"$jname\" class=\"zoom2\" >
			<img src=\"./index.php?module=archiv&action=thumbnail&id=$id\" border=\"0\" width=\"120\">
		      </a>
		    </td>";
      if($i%2==1)
        $vorschau .="</tr>";	
    }
    $this->app->Tpl->Set(VORSCHAU, $vorschau);


    if($submit!="")
    {
      if($adresstyp=="andere")
      {
	if($name=="")
	  $error .= "Geben Sie bitte einen Namen an.<br>";
    
	if($strasse=="")
          $error .= "Geben Sie bitte eine Stra&szlig;e an.<br>";

	if($ort=="")
          $error .= "Geben Sie bitte einen Ort an.<br>";

	if($plz=="")
          $error .= "Geben Sie bitte eine Postleitzahl an.<br>";
      }

      if($error=="")
      {
	$c_name = $this->app->erp->Encrypt($name);
        $c_strasse = $this->app->erp->Encrypt($strasse);
        $c_zusatz = $this->app->erp->Encrypt($zusatz);
        $c_plz = $this->app->erp->Encrypt($plz);
        $c_ort = $this->app->erp->Encrypt($ort);

	$old = $this->app->DB->Select("SELECT id FROM abonnements WHERE adresse='$userid' LIMIT 1");
	if(is_numeric($old))
	{
	  $this->app->DB->Update("UPDATE abonnements SET verlaengerung='$verlaengerung', adresstyp='$adresstyp', 
							 name='$c_name', strasse='$c_strasse', zusatz='$c_zusatz',
							 plz='$c_plz', ort='$c_ort' WHERE id='$old'");
	}
	else
	  $this->app->DB->Insert("INSERT INTO abonnements (adresse, verlaengerung, adresstyp, name, strasse, zusatz, plz, ort)
				  VALUES ('$userid', '$verlaengerung', '$adresstyp', '$c_name', '$c_strasse', '$c_zusatz', '$c_plz', '$c_ort')");
      }else
	$this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");
    }
  
    if($saverows!="")
    {
      if(!empty($auswahl))
      {
	foreach($auswahl as $key => $value)
	  $this->app->DB->Insert("UPDATE journal_abonnements SET ausgabe='$value' WHERE id='$key'");
      }
    }

    // Fülle Felder
    $abodata = $this->app->DB->SelectArr("SELECT * FROM abonnements WHERE adresse='$userid' LIMIT 1");
    if(!empty($abodata))
    {
      $this->app->Tpl->Set(NAME, $this->app->erp->Decrypt($abodata[0][name]));  
      $this->app->Tpl->Set(STRASSE, $this->app->erp->Decrypt($abodata[0][strasse]));  
      $this->app->Tpl->Set(ZUSATZ, $this->app->erp->Decrypt($abodata[0][zusatz]));  
      $this->app->Tpl->Set(PLZ, $this->app->erp->Decrypt($abodata[0][plz]));  
      $this->app->Tpl->Set(ORT, $this->app->erp->Decrypt($abodata[0][ort]));

      if($abodata[0][verlaengerung]=="auto") $this->app->Tpl->Set(AUTO, "CHECKED");  
      if($abodata[0][verlaengerung]=="email") $this->app->Tpl->Set(EMAIL, "CHECKED");  
      
      if($abodata[0][adresstyp]=="konto") $this->app->Tpl->Set(KONTO, "CHECKED");  
      if($abodata[0][adresstyp]=="andere") $this->app->Tpl->Set(ANDERE, "CHECKED");  
    }else
    {
      $this->app->Tpl->Set(AUTO, "CHECKED");
      $this->app->Tpl->Set(KONTO, "CHECKED");
    }

    // Fülle Tabellen
    $restlAusg = $this->app->DB->SelectArr("SELECT abo.id, abo.ausgabe
					    FROM journal_abonnements as abo, journal_aborechnung as rec
					    WHERE abo.rechnung = rec.id
					    AND abo.versanddatum='0000-00-00'
					    AND rec.adresse = '$userid'
					    AND rec.aktiv = '1'
					    ORDER BY abo.id");

    $erhaltAusg = $this->app->DB->SelectArr("SELECT abo.id, abo.ausgabe, abo.versanddatum
					    FROM journal_abonnements as abo, journal_aborechnung as rec
					    WHERE abo.rechnung = rec.id
                                            AND abo.versanddatum !='0000-00-00'
                                            AND rec.adresse = '$userid'");

    // Zeichne restl. Ausgaben
    if(count($restlAusg)>0)
    {
      for($i=0;$i<count($restlAusg);$i++)
      {
	$info = $this->app->DB->SelectArr("SELECT * FROM ausgaben WHERE id='{$restlAusg[$i][ausgabe]}' LIMIT 1");
        if($i%2) $css = "tr-even"; else $css="tr-odd";

	$out .= "<tr class=\"$css\">
		  <td width=\"100\">".($i+1)."</td>
		  <td width=\"250\">{$info[0][beschreibung]}</td>
		  <td>{$this->app->erp->ConvertDate($info[0][erscheinung])}</td>
		</tr>";
	//<td><select name=\"auswahl[{$restlAusg[$i][id]}]\">[SELECT{$restlAusg[$i][id]}]</select></td>	
	//$this->JournalSelect($restlAusg[$i][id], $restlAusg[$i][ausgabe]);
	//$this->app->Tpl->Set(SAVE, "<input type=\"submit\" name=\"saverows\" value=\"&Auml;nderungen speichern\">");
      }
    }else
      $out = "<td colspan=4>Keine Magazin vorhanden</td>";

      $this->app->Tpl->Set(UEBRIG, $out);

    // Zeichne verschickte Ausgaben
    $out = "";
    if(count($erhaltAusg)>0)
    {
      for($i=0;$i<count($erhaltAusg);$i++)
      {
	$info = $this->app->DB->SelectArr("SELECT * FROM ausgaben WHERE id='{$erhaltAusg[$i][ausgabe]}' LIMIT 1");
        if($i%2) $css = "tr-even"; else $css="tr-odd";
	$out .= "<tr class=\"$css\">
		  <td width=\"100\">".($i+1)."</td>
		  <td width=\"250\">{$info[0][beschreibung]}</td>
		  <td>{$this->app->erp->ConvertDate($erhaltAusg[$i][versanddatum])}</td>
		</tr>";
      }
    }else
      $out = "<td colspan=4>Keine Magazin vorhanden</td>";

    $this->app->Tpl->Set(VERSENDET, $out);



    $this->app->Tpl->Parse(INHALT,"abo.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function AboOrder()
  {
    $userid = $this->app->User->GetAdresse();

    $submit = $this->app->Secure->GetPOST("order");    
    $cancel = $this->app->Secure->GetPOST("cancel");    
    $type = $this->app->Secure->GetPOST("ordertype");    
    $disclaimer = $this->app->Secure->GetPOST("disclaimer");    

    if(is_numeric($userid))
    {
      // Prüfe ob aktive Abo's vorhanden
      $abos = $this->app->DB->Select("SELECT COUNT(a.id)
				      FROM journal_abonnements as a
				      Left Join journal_aborechnung as r
				      ON a.rechnung=r.id
				      WHERE a.versanddatum='0000-00-00'
				      AND r.aktiv='1'
				      AND r.adresse = '$userid'");

      // Wenn ja schicke weiter zur Übersicht
      if($abos>0)
      {
				header("Location: ./index.php?module=abo&action=list");
				exit;
      }

      if($cancel!="")
      {
				header("Location: ./index.php?module=zeitschrift&action=list");
        exit;
      }

      if($submit!="")
      {
				if($type=="nichts")
				{
	  			$this->app->DB->Update("UPDATE kundendaten SET verlosung='0' WHERE id='$userid'");
          $this->app->DB->Update("UPDATE kundendaten SET pdf='0' WHERE id='$userid'");
				}

				if($type=="pdf")
				{
	  			$this->app->DB->Update("UPDATE kundendaten SET verlosung='0' WHERE id='$userid'");
	  			$this->app->DB->Update("UPDATE kundendaten SET pdf='1' WHERE id='$userid'");
	  			$this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Danke f&uuml;r die Bestellung unserer PDF-Ausgabe.</div>");
				}

				if($type=="verlosung")
				{
	  			$this->app->DB->Update("UPDATE kundendaten SET pdf='0' WHERE id='$userid'");
	  			$this->app->DB->Update("UPDATE kundendaten SET verlosung='1' WHERE id='$userid'");
					header("Location: ./index.php?module=abo&action=verlosung");
					exit;
				}

				if($type=="abo")
				{
	  			if($disclaimer!="")
	  			{
	    			$this->app->DB->Update("UPDATE kundendaten SET verlosung='0' WHERE id='$userid'");
	    			$this->app->DB->Update("UPDATE kundendaten SET pdf='0' WHERE id='$userid'");

	    			// Erzeuge Standard-Eintrag
	    			$benutzer = $this->app->DB->Select("SELECT id FROM abonnements WHERE adresse='$userid' LIMIT 1");
	    			if($benutzer=="")
	      			$this->app->DB->Insert("INSERT INTO abonnements (adresse, verlaengerung, adresstyp)
				      												VALUES ('$userid', 'email', 'konto')");

	    			// Erzeuge Rechnung
	    			$this->app->DB->Insert("INSERT INTO journal_aborechnung (adresse, bestellt)
				    												VALUES ('$userid', CURDATE())");
	    			$rechnung = $this->app->DB->GetInsertID();

	    			// Einträge erzeugen
	    			$ausgaben = $this->app->DB->SelectArr("SELECT id FROM ausgaben WHERE id NOT IN (SELECT journal FROM versand_export) 
						   																		 AND erscheinung >= CURDATE() ORDER BY erscheinung ASC LIMIT 4");

	    			for($i=0;$i<count($ausgaben);$i++)
	      			$this->app->DB->Insert("INSERT INTO journal_abonnements (rechnung, ausgabe)
				      												VALUES ('$rechnung', '{$ausgaben[$i][id]}')");

	    			// Fuelle Warenkorb und erzeuge Auftrag
	    			$bestellnr = $this->app->erp->OrderAbo($userid);
						if($bestellnr!="")
	    				$this->app->DB->Insert("UPDATE journal_aborechnung SET bestellnummer='$bestellnr' WHERE id='$rechnung' LIMIT 1");

	    			header("Location: ./index.php?module=abo&action=list");
	    			exit;
	  			}else{
	    			$this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Sie m&uuml;ssen den AGB's zustimmen.</div>");     
	    			$this->app->Tpl->Set(ABOCHECKED, "checked");
	    			$abocheck = 1;
	  			}
				}
      }

      if($abocheck!=1)
      {
				// Setze Radioboxen
				$pdf = $this->app->DB->Select("SELECT pdf FROM kundendaten WHERE id='$userid' LIMIT 1");
				$verlosung = $this->app->DB->Select("SELECT verlosung FROM kundendaten WHERE id='$userid' LIMIT 1");

				if($pdf=="1")
	  			$this->app->Tpl->Set(PDFCHECKED, "CHECKED");

				if($verlosung=="1")
	  			$this->app->Tpl->Set(VERLOSUNGCHECKED, "CHECKED");

				if($pdf==0 && $verlosung==0)
	   			$this->app->Tpl->Set(NICHTSCHECKED, "CHECKED");
      }
    }

    $this->app->Tpl->Parse(INHALT,"abo_order.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function AboStorno()
  {
    $userid = $this->app->User->GetAdresse();

		if(is_numeric($userid))
		{
    	$storno= $this->app->DB->Select("SELECT MAX(id) as id
                                     	 FROM journal_aborechnung 
                                     	 WHERE adresse='$userid'
                                       AND aktiv='1'
                                       LIMIT 1");
    	$this->app->DB->Update("UPDATE journal_aborechnung SET aktiv='0' WHERE id='$storno'");
			$onlinenummer = $this->app->DB->Select("SELECT bestellnummer FROM journal_aborechnung WHERE id='$storno' LIMIT 1");
			
			// Durchsuche Auftraege nach Bestellung
			$auftraege = $this->app->DB->SelectArr("SELECT id, warenkorb FROM auftraege");
			for($i=0;$i<count($auftraege);$i++)
			{
				$data = unserialize(base64_decode($auftraege[$i][warenkorb]));
				if($data[onlinebestellnummer]==$onlinenummer) $deleteNr = $auftraege[$i][id];
			}
			if(is_numeric($deleteNr))
				$this->app->DB->Delete("DELETE FROM auftraege WHERE id='$deleteNr'");
		}
    header("Location: ./index.php?module=abo&action=list");
    break;
  }

	function AboVerlosung()
	{
		$this->app->Tpl->Set(INHALT, "Danke f&uuml;r die Teilnahme an unserer Journal-Verlosung.<br>
																	Klicken Sie <a href=\"./index.php?module=zeitschrift&action=list\">hier</a> um wieder zur &Uuml;bersicht zu gelangen.");
		$this->app->Tpl->Parse(PAGE,"index.tpl");
	}

  function JournalSelect($id, $selected)
  {
    $journal = $this->app->DB->SelectArr("SELECT * FROM ausgaben WHERE CURDATE() <= erscheinung ORDER BY erscheinung");
    for($i=0;$i<count($journal);$i++)
    {
      $out.="<option value=\"{$journal[$i][id]}\"";
      if($selected==$journal[$i][id])
	$out .= " SELECTED ";    
      $out .= ">{$journal[$i][beschreibung]} - {$this->app->erp->ConvertDate($journal[$i][erscheinung])}</option>";
    }
    $this->app->Tpl->Set("SELECT$id", $out);
  }
  
  function getImageExtension($mime)
  {
    switch($mime)
    { 
      case "image/jpeg":
        $ext = ".jpg";
      break;
      case "image/png":
        $ext = ".png";
      break;
      case "image/gif":
        $ext = ".gif";
      break;
    }
    return $ext;
  }
}

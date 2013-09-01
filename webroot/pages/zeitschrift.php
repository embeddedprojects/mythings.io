<?php  
class Zeitschrift
{
  function Zeitschrift(&$app)
  {
    $this->app=&$app;

    // aktivieren wenn geldverbindung Pflicht sein sollte
    $geldverbindung = false;
    $eproo_key = "7aCN5VQKzik2cJRXdCa2j06YFl6nKCXP";

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ZeitschriftList");
    $this->app->ActionHandler("edit","ZeitschriftEdit");
    $this->app->ActionHandler("abo","ZeitschriftAbo");
    $this->app->ActionHandler("listarticle","ZeitschriftListArtikel");
    $this->app->ActionHandler("info","ZeitschriftInfo");
    $this->app->ActionHandler("write","ZeitschriftWrite");
    $this->app->ActionHandler("show","ZeitschriftShow");
    $this->app->ActionHandler("thumbnail","renderThumbnail");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);

  }
  
  function Login()
  {
/*
    if(empty($_SESSION) || !is_numeric($_SESSION[userid]) || $_SESSION[password]=="")
    { 
      header("Location: ./index.php?module=zeitschrift&action=login");
      break;
    }
*/
  }

  function ZeitschriftList()
  {
    $this->Login();
    $this->app->Tpl->Set(INHALT,"");
    $this->app->Tpl->Set(HEADING,"embedded projects GmbH Zeitschrift-Menü");

    $this->Menu();

    $name = $this->app->erp->Decrypt($this->app->DB->Select("SELECT name FROM kundendaten WHERE id='{$_SESSION[userid]}' LIMIT 1"));
    $erscheinung = $this->app->DB->Select("SELECT MIN(erscheinung) FROM ausgaben");
    $redaktionsschluss = $this->app->DB->Select("SELECT SUBDATE('$erscheinung', INTERVAL 28 DAY)");
    $anzeigenschluss = $this->app->DB->Select("SELECT SUBDATE('$erscheinung', INTERVAL 21 DAY)");
 
    $this->app->Tpl->Set(NAME, $name);
    $this->app->Tpl->Set(VEROEFFENTLICHUNG, $this->app->String->Convert($erscheinung,"%1-%2-%3","%3.%2.%1"));
    $this->app->Tpl->Set(REDAKTIONSSCHLUSS, $this->app->String->Convert($redaktionsschluss,"%1-%2-%3","%3.%2.%1"));
    $this->app->Tpl->Set(ANZEIGENSCHLUSS, $this->app->String->Convert($anzeigenschluss,"%1-%2-%3","%3.%2.%1"));

    
    $this->app->Tpl->Parse(INHALT,"zeitschrift_list.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ZeitschriftAbo()
  {
    $this->Login();
  
    $this->app->erp->Hilfebox("hilfeartikelabo");  

    $userid = $_SESSION[userid];
    
    $id = $this->app->Secure->GetGET("id");
    $ausgabe = $this->app->Secure->GetPOST("ausgabe");
    $edit = $this->app->Secure->GetPOST("edit");

  
    if(is_numeric($id))
    {
      // TODO: Überprüfe Datum ob Eintrag bearbeitet werden darf
      if($cancel!="")
      {
	header("Location: ./index.php?module=zeitschrift&action=abo");
	exit;
      }

      if($edit!="")
      { 
	$this->app->DB->Update("UPDATE journal_abonnements SET ausgabe='$ausgabe' WHERE id='$id' AND adresse='$userid'");

        header("Location: ./index.php?module=zeitschrift&action=abo");
        exit;
      }

      $moegl_ausgaben = $this->app->DB->SelectArr("SELECT * FROM ausgaben WHERE CURDATE() < versand");

      // Ausgaben-SELECT füllen
      for($i=0;$i<count($moegl_ausgaben);$i++)
	$out_ausgaben .= "<option value=\"{$moegl_ausgaben[$i][id]}\">{$moegl_ausgaben[$i][beschreibung]} - {$moegl_ausgaben[$i][erscheinung]}</option>";
      $this->app->Tpl->Set(AUSGABEN, $out_ausgaben);

      $this->app->Tpl->Set(AUSWAHL, "<fieldset><legend>Ausgabe bearbeiten</legend>
				    W&auml;hlen Sie eine gew&uuml;nschte Ausgabe aus:&nbsp;<select name=\"ausgabe\">[AUSGABEN]</select>
				    <input type=\"submit\" name=\"cancel\" value=\"Abbrechen\">&nbsp;<input type=\"submit\" name=\"edit\" value=\"&Auml;ndern\">
				    </fieldset>"); 
    }


    $versendet = $this->app->DB->SelectArr("SELECT abo.id, ausg.beschreibung, ausg.versand, abo.ausgabe 
					    FROM ausgaben AS ausg, journal_abonnements AS abo 
					    WHERE 
					    abo.adresse='$userid' AND 
					    abo.ausgabe = ausg.id AND
					    CURDATE() >= ausg.versand");


    $uebrig = $this->app->DB->SelectArr("SELECT abo.id, ausg.beschreibung, ausg.versand, abo.ausgabe 
                                            FROM ausgaben AS ausg, journal_abonnements AS abo 
                                            WHERE 
                                            abo.adresse='$userid' AND 
                                            abo.ausgabe = ausg.id AND
                                            CURDATE() < ausg.versand");

    // restl. Ausgaben
    for($i=0;$i<count($uebrig);$i++)
    {
      $out_uebrig .= "<tr>
			<td>".($i+1)."</td>
			<td>{$uebrig[$i][beschreibung]}</td>
			<td>{$uebrig[$i][versand]}</td>
			<td align=\"right\"><a href=\"./index.php?module=zeitschrift&action=abo&id={$uebrig[$i][id]}\"><img src=\"./themes/default/images/edit.png\" border=\"0\"/></a></td>
		      </tr>";
    }
    $this->app->Tpl->Set(UEBRIG, $out_uebrig);

    // versendete Ausgaben
    for($i=0;$i<count($versendet);$i++)
    {
      $out_versendet .= "<tr>
			    <td>".($i+1)."</td>
			    <td>{$versendet[$i][beschreibung]}</td>
			    <td>{$versendet[$i][versand]}</td>
			 </tr>";
    }
    $this->app->Tpl->Set(VERSENDET, $out_versendet);

    $this->app->Tpl->Parse(INHALT,"zeitschrift_abo.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ZeitschriftListArtikel()
  {
    $this->Login();

    $this->app->erp->Hilfebox("hilfeartikellist");

    $userid = $this->app->User->GetAdresse();

    if(is_numeric($userid))
    {
      $id = $this->app->Secure->GetGET("id");
      $mode = $this->app->Secure->GetGET("mode");

      // DELETE
      if(is_numeric($id) && $mode=="delete")
      {
        $userid = $this->app->DB->Select("SELECT adresse from journal WHERE id='$id'");
	//echo "ID: ".$id."<br>Mode: ".$mode."<br>U-ID: ".$userid."<br>S-ID:".$_SESSION[userid];

	if($userid==$_SESSION[userid])
	{
	  $this->app->DB->Update("UPDATE journal SET aktiv='0' WHERE id='$id'");
	  $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Der Artikel wurde erfolgreich gel&ouml;scht.</div>");
	}else
	  $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Zugriff verweigert!</div>");	
      }

      $data = $this->app->DB->SelectArr("SELECT * FROM journal WHERE adresse='$userid' AND aktiv=1");
      if(count($data)>0)
      {
	for($i=0;$i<count($data);$i++)
	{
	  if($data[$i][aktiv]=="1")
	  {
	    $wunschtermin = $this->app->DB->Select("SELECT erscheinung FROM ausgaben WHERE id='{$data[$i][wunschtermin]}'");
	    if($data[$i][freigegeben]=="1")
	      $freigabe = "freigegeben";
	    else
	      $freigabe = "nicht freigegeben";

       if($i%2) $css = "tr-even"; else $css="tr-odd";

	    $table .="<tr class=\"$css\">
			<td align=\"center\" width=\"50\">{$data[$i][id]}</td>
			<td >{$data[$i][titel]}</td>
			<td>{$data[$i][autor]}</td>
			<td>{$this->app->erp->ConvertDate($wunschtermin)}</td>
			<td>".ucfirst($data[$i][art])."</td>
			<td>$freigabe</td>
			<td align=\"center\">
			  <a href=\"./index.php?module=zeitschrift&action=write&id={$data[$i][id]}&tab=1\">&nbsp;
			  <img src=\"./themes/default/images/edit.png\" border=\"0\"/></a>&nbsp;
			  <a onclick=\"if(!confirm('Wollen Sie den Artikel wirklich l&ouml;schen?')) return false; 
			  else window.location.href='./index.php?module=zeitschrift&action=listarticle&id={$data[$i][id]}&mode=delete';\" href=\"#\">
			  <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a></td></tr>";
	  }
	}
      } else {
	 $table ="<tr><td colspan=\"7\" align=\"center\">Sie haben noch keine Artikel geschrieben. <br>
		  Schreiben Sie doch einen kleinen Artikel &uuml;ber Ihr letztes Projekt, oder ein spannendes Mikrocontrollerthema?. <br>
		  Geben Sie sich einen Ruck :-)</td></tr>";
      }
      $this->app->Tpl->Set(TABLE, $table);

      // Redakteur Tabelle
      $rdata = $this->app->DB->SelectArr("SELECT * FROM journal WHERE redakteur='$userid' AND aktiv='1'");
      
      $rtable = "
		 <h2>Redaktionelle Artikel</h2>
		 <table width=\"100%\" class=\"tableJournal\"><tr class=\"tr-0\"><td width=\"50\">ID</td><td>Titel</td><td>Autor</td><td>Wunschtermin</td><td>Art</td><td>Freigabe</td><td>Aktion</td>";

      for($i=0;$i<count($rdata);$i++)
      {
         if($i%2)$css="tr-even";else $css="tr-odd";
	$wunschtermin = $this->app->DB->Select("SELECT erscheinung FROM ausgaben WHERE id='{$rdata[$i][wunschtermin]}'");
	if($data[$i][freigegeben]=="1")
	  $freigabe = "freigegeben";
        else
          $freigabe = "nicht freigegeben";
	$rtable .="<tr class=\"$css\">
                        <td align=\"center\" >{$rdata[$i][id]}</td>
                        <td>{$rdata[$i][titel]}</td>
                        <td>{$rdata[$i][autor]}</td>
                        <td>{$this->app->erp->ConvertDate($wunschtermin)}</td>
                        <td>".ucfirst($rdata[$i][art])."</td>
                        <td>$freigabe</td>
                        <td align=\"center\"><a href=\"./index.php?module=zeitschrift&action=write&id={$rdata[$i][id]}&tab=1\">&nbsp;
                          <img src=\"./themes/default/images/edit.png\" border=\"0\"/></a></td>";
      }
      $rtable .= "</table>";
      $this->app->Tpl->Set(RTABLE, $rtable);
    }else
      $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Zugriff verweigert!</div>");

    $this->app->Tpl->Parse(INHALT,"zeitschrift_listarticle.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ZeitschriftInfo()
  {
    $this->Login();
    $cancel = $this->app->Secure->GetPOST("infocancel"); 
    $confirm = $this->app->Secure->GetPOST("infoconfirm"); 

    if($cancel!="")
    {
      header("Location: ./index.php?module=zeitschrift&action=listarticle");
      exit;
    }

    if($confirm!="")
    {
      header("Location: ./index.php?module=zeitschrift&action=write&id=new&tab=1");
      exit;
    }
    $this->app->Tpl->Parse(INHALT,"zeitschrift_info.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function Menu()
  {
    $this->app->Tpl->Set(NAVIGATION, $this->app->erp->Navigation(0));

    $this->app->Tpl->Set(UEBERSICHT,CartTinyShow($_SESSION[articlelist]));
    $this->app->Tpl->Parse(WARENKORB, "warenkorb.tpl");

    $this->app->Tpl->Parse(NEUERSCHEINUNGEN, "neuerscheinungen.tpl");


    $this->app->Tpl->Set(SUBHEADING,"");
  }

  function ZeitschriftWrite()
  {
    $this->Login();

    // Modes: generic, text, picture, table, listing, bibliography
    $artid = $this->app->Secure->GetGET("id"); 
    $tab = $this->app->Secure->GetGET("tab");

    $this->app->Tpl->Set(ID,$artid);

    $this->app->Tpl->Set("TAB$tab", "selected");
  
    if(is_numeric($artid))
    {
      $userid = $this->app->DB->Select("SELECT adresse from journal WHERE id='$artid'");
      $redakteur = $this->app->DB->Select("SELECT redakteur from journal WHERE id='$artid'");
      $sperre = $this->app->DB->Select("SELECT gesperrt from journal WHERE id='$artid'");
    }

    if($userid==$_SESSION[userid] || $redakteur==$_SESSION[userid] || $artid=="new")
    { 
      if($tab=="1")
	      $this->ZeitschriftWriteGeneric($artid);
      
      if(is_numeric($artid))
      {
	if($redakteur==$_SESSION[userid] || ($userid==$_SESSION[userid] && $sperre!='1'))
	{
	  switch($tab)
	  {
	  case "2": $this->ZeitschriftWriteText($artid);break;
	  case "3": $this->ZeitschriftWritePicture($artid); break;
	  case "4": $this->ZeitschriftWriteTable($artid); break;
	  case "5": $this->ZeitschriftWriteListing($artid); break;
	  case "6": $this->ZeitschriftWriteBibliography($artid); break;
	  default:;
	  }
	}else
	  $this->app->Tpl->Set(NOTICE, "<font color=\"red\"><b>Der Artikel ist zur Bearbeitung durch den Redakteur gesperrt.</b></font><br><br>");
      }else
	$this->app->Tpl->Set(NOTICE, "<font color=\"red\"><b>Bitte geben Sie erst in den Einstellungen Ihre Eckdaten zum Artikel ein.</b></font><br><br>");
    }else
      $this->app->Tpl->Set(NOTICE, "<div class=\"error\">Zugriff verweigert!</div>");
    $this->app->Tpl->Parse(INHALT,"zeitschrift_write.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ZeitschriftWriteGeneric($id)
  {
    $this->app->Tpl->Parse(INHALT,"");

    $this->app->erp->HilfeBox("hilfeartikelgeneric");

 
    $speichern = $this->app->Secure->GetPOST("savegeneric");    
    $neu = $this->app->Secure->GetPOST("neugeneric");    
    $sperren = $this->app->Secure->GetPOST("sperren");    
    $entsperren = $this->app->Secure->GetPOST("entsperren");    
    $kommentarbutton = $this->app->Secure->GetPOST("kommentarbutton");
    $kommentarfeld = $this->app->Secure->GetPOST("kommentarfeld");
    $nachrichtenbutton = $this->app->Secure->GetPOST("nachrichtenbutton");
    $nachrichtenfeld = $this->app->Secure->GetPOST("nachrichtenfeld");
    $mode = $this->app->Secure->GetGET("mode");    
    $titel  = $this->app->Secure->GetPOST("titel");
    $autor = $this->app->Secure->GetPOST("autor");
    $email = $this->app->Secure->GetPOST("email");
    $wunschtermin = $this->app->Secure->GetPOST("wunschtermin");
    $art = $this->app->Secure->GetPOST("artikelart");
    $keywords = $this->app->Secure->GetPOST("keywords");
    

    // Neuen Artikel anlegen
    if($id=="new")
    { 
      $this->app->Tpl->Set(SPEICHERN, "<input type=\"submit\" name=\"neugeneric\" value=\"Speichern\" />"); 

      if($neu!="")  
        if($titel!="")
        { 
          $this->app->DB->Insert("INSERT INTO journal (adresse, titel, autor, email, wunschtermin, art, keywords, kommentar)
                                  VALUES ({$_SESSION[userid]} , '$titel', '$autor', '$email', '$wunschtermin', '$art', '$keywords', '$kommentarfeld')");
          $insertID = $this->app->DB->GetInsertID();
          header("Location: ./index.php?module=zeitschrift&action=write&id=$insertID&tab=1");
          exit;
        }
        else
          $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Sie m&uuml;ssen einen Titel festlegen um ein neuen Artikel zu erstellen.</div>");
    }


    // Artikelinformationen aktualisieren
    if(is_numeric($id))
    {

      if($speichern!="")
      {
	if($titel!="")
        { 
          $this->app->DB->Update("UPDATE journal SET titel='$titel', autor='$autor', email='$email', wunschtermin='$wunschtermin', art='$art', keywords='$keywords'
                                  WHERE id='$id'");
          header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=1");
          exit;
        }else
          $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Geben Sie bitte einen Titel ein.</div>");
      }

      // Freigeben
      if($mode=="checkout")
      { 
        $this->app->DB->Update("UPDATE journal SET freigegeben='1' WHERE id=$id");
        $this->app->DB->Update("UPDATE journal SET gesperrt='1' WHERE id=$id");
        $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Ihr Artikel wurde weitergeleitet. Sie k&ouml;nnen noch bis zur finalen Sperrung durch den Redakteur &Auml;nderungen vornehmen.</div>");
      } 

      
      if($kommentarbutton!="")
      {
        $this->app->DB->Update("UPDATE journal SET kommentar='$kommentarfeld', kommentarzeit=NOW() WHERE id='$id'");
        $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Ihr Kommentar wurde gespeichert.</div>");
      }

      if($nachrichtenbutton!="")
      {
	$this->app->DB->Update("UPDATE journal SET nachricht='$nachrichtenfeld', nachrichtzeit=NOW() WHERE id='$id'");
        $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Ihre Nachricht wurde gespeichert.Der Autor wird per E-Mail verst&auml;ndigt.</div>");
	$titel = $this->app->DB->Select("SELECT titel FROM journal WHERE id='$id'");
	$email = $this->app->DB->Select("SELECT email FROM journal WHERE id='$id'");
	$name = $this->app->DB->Select("SELECT autor FROM journal WHERE id='$id'");
	$mailtext = 
"Hallo $name,
es liegt eine neue Redakteuren-Mitteilung für Ihren Artikel '$titel' vor.
Um die Nachricht zu lesen, loggen Sie sich bitte in unser Autorensystem ein. ";
	$this->app->erp->MailSend("info@embedded-projects.net", "Embedded-Projects GmbH", $email, $name, "Embedded-Projects Autorensystem", $mailtext);
      }

      // Artikel sperren (Redakteur)
      if($sperren!="")
        $this->app->DB->Update("UPDATE journal SET gesperrt='1' WHERE id='$id'");

      if($entsperren!="")
        $this->app->DB->Update("UPDATE journal SET gesperrt='0' WHERE id='$id'");

      
      // neue Daten einlesen
      $data = $this->app->DB->SelectArr("SELECT * FROM journal WHERE id='$id'");
      $this->app->Tpl->Set(ID, $data[0][id]);
      $this->app->Tpl->Set(TITEL, $data[0][titel]);
      $this->app->Tpl->Set(AUTOR, $data[0][autor]);
      $this->app->Tpl->Set(EMAIL, $data[0][email]);
      $this->app->Tpl->Set(KEYWORDS, $data[0][keywords]);
      $dbTermin=$data[0][wunschtermin];
      $dbArt= $data[0][art];
      $freigabe = $data[0][freigegeben];
      $redakteur = $data[0][redakteur];
      $sperre = $data[0][gesperrt];
      $kommentar = $data[0][kommentar];
      $this->app->Tpl->Set(KOMMENTARZEIT, "Nachricht geschrieben am ".$this->app->String->Convert($data[0][kommentarzeit],"%1-%2-%3","%3.%2.%1")." um ".
					   $this->app->String->Convert($data[0][kommentarzeit],"%1-%2-%3 %4:%5:%6","%4:%5")." Uhr");
      $nachricht = $data[0][nachricht];
      $this->app->Tpl->Set(NACHRICHTZEIT, "Nachricht geschrieben am ".$this->app->String->Convert($data[0][nachrichtzeit],"%1-%2-%3","%3.%2.%1")." um ".
					   $this->app->String->Convert($data[0][nachrichtzeit],"%1-%2-%3 %4:%5:%6","%4:%5")." Uhr");

      // Speichern Button
      if($sperre!='1' || $redakteur==$_SESSION[userid])
      $this->app->Tpl->Set(SPEICHERN, "<input type=\"submit\" name=\"savegeneric\" value=\"Speichern\" />");
      

      // Sperrbutton für den Redakteur
      if($redakteur==$_SESSION[userid])
      {
        if($sperre=='1')
          $this->app->Tpl->Set(SPERRE, "<input type=\"submit\" name=\"entsperren\" value=\"Entsperren\" />");
        else
          $this->app->Tpl->Set(SPERRE, "<input type=\"submit\" name=\"sperren\" value=\"Sperren\" />");
      }


      // Freigeben-Button für User
      if(($freigabe!='1') && ($sperre!='1') && ($redakteur!=$_SESSION[userid]))
      {
        $chbutton = "<input type=\"button\" name=\"freigeben\" value=\"Freigeben\" onclick=\"if(!confirm('Wollen Sie den Artikel zur Abnahme duch den Administrator abschicken? Der Artikel wird dadurch gesperrt und kann nicht weiterbearbeitet werden.')) return false; 
                    else window.location.href='./index.php?module=zeitschrift&action=write&id=[ID]&mode=checkout&tab=1';\"/>";
      }else
        $chbutton = "";
      $this->app->Tpl->Set(CHECKOUTBUTTON, $chbutton);

      // Kommentar- und Nachrichtenfeld
      if($redakteur==$_SESSION[userid])
      {
	$this->app->Tpl->Set(KOMMENTARDISABLED, "readonly");
	$this->app->Tpl->Set(NACHRICHTENSUBMIT,  "<input type=\"submit\" name=\"nachrichtenbutton\" value=\"Senden\" style=\"float:right\"/>");
      }else
      {
	$this->app->Tpl->Set(NACHRICHTENDISABLED, "readonly");
        $this->app->Tpl->Set(KOMMENTARSUBMIT,  "<input type=\"submit\" name=\"kommentarbutton\" value=\"Senden\" style=\"float:right\"/>");
      }

      $this->app->Tpl->Set(KOMMENTARFELD, $kommentar);
      $this->app->Tpl->Set(NACHRICHTENFELD, $nachricht);

    }


    //Wunschtermin-SELECT Feld
    $termine = $this->app->DB->SelectArr("SELECT * FROM ausgaben WHERE CURDATE() <= erscheinung  ORDER by erscheinung");
    for($i=0;$i<count($termine);$i++)
    {
      $terminausgabe .= "<option value=\"{$termine[$i][id]}\"";
      if($termine[$i][id]==$dbTermin)
	$terminausgabe .= " SELECTED";
      $terminausgabe .= ">{$termine[$i][beschreibung]} - {$this->app->erp->ConvertDate($termine[$i][erscheinung])}</option>";
    }
    $this->app->Tpl->Set(WUNSCHTERMIN, $terminausgabe);


    // Artikelart-SELECT Feld
    $arten = array("versuchsbeschreibung", "fachwissen", "projektvorstellung", "sonstiges");
    for($i=0;$i<count($arten);$i++)
    {
      $artenausgabe .= "<option value=\"{$arten[$i]}\"";
      if($arten[$i]==$dbArt) 
	$artenausgabe .= " SELECTED";
      $artenausgabe .= '>'.ucfirst($arten[$i]).'</option>';
    }
    $this->app->Tpl->Set(ARTEN, $artenausgabe);


    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_generic.tpl");
  }

  function ZeitschriftWriteText($id)
  {
    $this->app->erp->HilfeBox("hilfeartikeltext");
    
    $text = $this->app->Secure->POST["textinput"];
    $submit = $this->app->Secure->GetPOST("savetext"); 

    if($submit!="")
    {
      $this->app->DB->Update("UPDATE journal SET text='".base64_encode(stripslashes($text))."' WHERE id='$id'");

      // Super Auto Backup
      // beim artikel schreiben  TODO parallel per AJAX den Text nehmen und an eine action savetext schickenO

      header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=2");  
      exit;
    }

    $artikeltext = $this->app->DB->Select("SELECT text FROM journal WHERE id='$id'");
    $this->app->Tpl->Set(ARTIKELTEXT, base64_decode($artikeltext));


    // Schreibe Bilder-Tags
    $bildtag = $this->app->DB->SelectArr("SELECT tag FROM journal_images WHERE artikel='$id' AND aktiv='1' ORDER BY uploaded");
    $this->app->Tpl->Set(BILDTAG, $this->renderTags($bildtag, '#696565'));

    // Schreibe Tabellen-Tags 
    $tabletag = $this->app->DB->SelectArr("SELECT tag FROM journal_tables WHERE artikel='$id' AND aktiv='1' ORDER BY id");
    $this->app->Tpl->Set(TABLETAG, $this->renderTags($tabletag, '#2554C7'));

    // Schreibe Listing-Tags
    $listingtag = $this->app->DB->SelectArr("SELECT tag FROM journal_listings WHERE artikel='$id' AND aktiv='1' ORDER BY id");
    $this->app->Tpl->Set(LISTINGTAG, $this->renderTags($listingtag, '#347235'));

    // Schreibe Literatur-Tags
    $literaturtag = $this->app->DB->SelectArr("SELECT tag FROM journal_bibliography WHERE artikel='$id' AND aktiv='1' ORDER BY id");
    $this->app->Tpl->Set(LITERATURTAG, $this->renderTags($literaturtag, '#7E2217'));

    // Text
    $artikeltext = $this->app->DB->Select("SELECT text FROM journal WHERE id='$id'");
    $this->app->Tpl->Set(ARTIKELTEXT, base64_decode($artikeltext));

    $this->app->Tpl->Parse(INHALT,"");
    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_text.tpl");
  }

  function renderTags($tagdata,$farbe)
  {
    for($i=0;$i<count($tagdata);$i++)
      $tag_out .= '&nbsp;&nbsp;<a href=# style=color:#282828;text-decoration:none; onclick=insert("'.$tagdata[$i]['tag'].'","'.$farbe.'")>
		   '.$tagdata[$i][tag].'</a><br>';
    return base64_encode($tag_out);
  }

  function ZeitschriftWritePicture($id)
  {
    $this->app->erp->HilfeBox("hilfeartikelpicture");
    
    $senden = $this->app->Secure->GetPOST("picUpload");
    $complete = $this->app->Secure->GetPOST("completed");
    $creator = $this->app->Secure->GetPOST("creator");
    $nachweis = $this->app->Secure->GetPOST("nachweis");
    $bildtext = $this->app->Secure->GetPOST("bildtext");

    if($senden!="")
    {
      if($complete==1)
      {
	$pfad = $_FILES[bilddatei][tmp_name];
	$typ = GetImageSize($pfad); // 1=GIF, 2=JPEG, 3=PNG
	$size = $_FILES[bilddatei][size];
	$filename = $_FILES[bilddatei][name];
	$fileSizeLimit =  83886080; // 10MB, 100MB stehen in der upload_max_size
	
	if(0 < $typ[2] && $typ[2] < 4)
	{
	  if($size<$fileSizeLimit)
	  {
	    switch($typ[2])
	    {
	      case 1:
		$postfix="gif";
	      break;
	      case 2:
		$postfix="jpg";
	      break;
	      case 3:
		$postfix="png";
	      default:
		$postfix="unknown";
	      break;
	    }
	    $name = uniqid("bild_").".".$postfix;

	    
	    $anzahl_bilder = $this->app->DB->Select("SELECT COUNT(id) FROM journal_images WHERE artikel='$id'");
	    if($anzahl_bilder>0)
	    {
	      $last = $this->app->DB->Select("SELECT MAX(id) FROM journal_images WHERE artikel='$id'");

	      $maxTag = $this->app->DB->Select("SELECT tag FROM journal_images WHERE artikel='$id' && id=$last");

	      $anz = preg_match('/[0-9]+/', $maxTag, $matches);
	      if($anz!=0)
		$tagid= $matches[0]+1;
	    }else
	      $tagid=1;

	    $tag = "{Bild$tagid}";

	    // Bild hochladen
	    $filehandle = fopen($pfad,'r');
	    $filedata = base64_encode(fread($filehandle, filesize($pfad)));
	    $dbtype = $typ['mime'];
	    $thumbnail = $this->makeThumbnail($_FILES[bilddatei],180,180);

	    $this->app->DB->Insert("INSERT INTO journal_images (artikel, tag, name, filename, bild, bildtyp, thumbnail, text , creator, nachweis, uploaded)
				    VALUES ('$id', '$tag', '$name', '$filename', '$filedata', '$dbtype', '{$thumbnail[bild]}', '$bildtext', '$creator', '$nachweis', NOW())");
	
	    header("Location: ./index.php?module=zeitschrift&action=write&id=$id&mode=image&pid=&tab=3");
	  }else
	    $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Die Datei darf eine Gr&ouml;&szlig;e von ".($fileSizeLimit/8388608)." MB nicht &uuml;berschreiten.</div>");
	}else
	  $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Die Datei muss vom Typ GIF, JPG oder PNG sein.</div>");
      }
    }    

    if(is_numeric($id))
    {
      $pid = $this->app->Secure->GetGET("pid");
      $mode = $this->app->Secure->GetGET("mode");

      $this->app->Tpl->Set(SELBERCHECKED, "CHECKED");

      if($mode=="delimage" && is_numeric($pid))
      {
	$this->app->DB->Update("UPDATE journal_images SET aktiv='0' WHERE id='$pid' and artikel='$id'");
	header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=3");
	exit;
      }

      if($mode=="image" && is_numeric($pid))
      {
	$picedit = $this->app->Secure->GetPOST("picEdit");
	$piccancel = $this->app->Secure->GetPOST("picCancel");
	
	if($piccancel!="")
	{
	  header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=3"); 
	  exit;
	}

	if($picedit!="")
	{
	 $this->app->DB->Update("UPDATE journal_images SET creator='$creator', nachweis='$nachweis', text='$bildtext' WHERE id='$pid' AND artikel='$id'");
	 header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=3"); 
	 exit;
	}else
	{
	  $image = $this->app->DB->SelectArr("SELECT text, creator, nachweis FROM journal_images WHERE id='$pid' && aktiv='1'");
	  $this->app->Tpl->Set(NACHWEIS, $image[0][nachweis]);
	  $this->app->Tpl->Set(BILDTEXT, $image[0][text]);
	  $this->app->Tpl->Set(THUMBNAIL, "<img src=\"./index.php?module=zeitschrift&action=thumbnail&id=$pid\">");
	  
	  if($image[0][creator]=="selbst erzeugt")
	    $this->app->Tpl->Set(SELBERCHECKED, "CHECKED");
	  else
	    $this->app->Tpl->Set(SELBERCHECKED, "");

	  if($image[0][creator]=="fremd erzeugt")
            $this->app->Tpl->Set(FREMDCHECKED, "CHECKED");
	  else
            $this->app->Tpl->Set(FREMDCHECKED, "");
	    
	  if($image[0][creator]=="mit Erlaubnis")
            $this->app->Tpl->Set(ERLAUBNISCHECKED, "CHECKED");
	  else
            $this->app->Tpl->Set(ERLAUBNISCHECKED, "");
    
	}

	$this->app->Tpl->Set(PICSUBMIT, "<input type=\"submit\" name=\"picCancel\" value=\"Abbrechen\" \>&nbsp;<input type=\"submit\" name=\"picEdit\" value=\"Speichern\"/>");
      }else
      {
	$this->app->Tpl->Set(PICSUBMIT, "<input type=\"submit\" name=\"picUpload\" value=\"Hochladen\"/>");
	$this->app->Tpl->Set(THUMBNAIL, "<table width=\"100%\" height=\"180\" border=\"0\"><tr><td align=\"center\">Bitte Bild hochladen, oder Bild zum Bearbeiten ausw&auml;hlen</td></tr></table>");
      }
      // Tabelle zeichnen
      $images = $this->app->DB->SelectArr("SELECT * FROM journal_images WHERE artikel=$id AND aktiv='1'");

      if(count($images)>0)
      {
	for($i=0;$i<count($images);$i++)
	{
	  if(strlen($images[$i][text])>20) $postfix = " ..."; else $postfix = "";

	  $ausgabe .= "<tr>
			<td align=\"center\">{$images[$i][tag]}</td>
			<td>{$images[$i][filename]}</td>
			<td>".substr($images[$i][text],0,20).$postfix."</td>
			<td>{$this->app->erp->ConvertDateTime($images[$i][uploaded])}</td>
			<td align=\"center\">
			  <a href=\"./index.php?module=zeitschrift&action=write&id={$id}&mode=image&pid={$images[$i][id]}&tab=3\"><img src=\"./themes/default/images/edit.png\" border=\"0\"/></a>
			  <a href=\"#\" onclick=\"if(!confirm('Wollen Sie das Bild wirklich l&ouml;schen?')) return false; 
						  else window.location.href='./index.php?module=zeitschrift&action=write&id={$id}&mode=delimage&pid={$images[$i][id]}&tab=3';\"\">
						  <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a>
			</td>
		       </tr>";
	}
      }else
	$ausgabe = "<tr><td colspan=\"5\">Keine Bilder gefunden.</td></tr>";
      
      $this->app->Tpl->Set(PICTABLE, $ausgabe);      
    }


    $this->app->Tpl->Parse(INHALT,"");
    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_picture.tpl");
  }

  function ZeitschriftWriteTable($id)
  {
    $this->app->erp->HilfeBox("hilfeartikeltable");
    
    $mode = $this->app->Secure->GetGET("mode"); // table, tablecreate, tabledelete
    $tableid = $this->app->Secure->GetGET("tid");

    $create = $this->app->Secure->GetPOST("createTable");
    $cancel = $this->app->Secure->GetPOST("cancelTable");
    $edit = $this->app->Secure->GetPOST("editTable");
    $showtitle = $this->app->Secure->GetPOST("showtabletitle");
    $showtext = $this->app->Secure->GetPOST("showtabletext");
    $showheader = $this->app->Secure->GetPOST("showtableheader");
    $showlink = $this->app->Secure->GetPOST("showtablelink");
    $link = $this->app->Secure->GetPOST("tablelink");
    $title = $this->app->Secure->GetPOST("tabletitle");
    $text = $this->app->Secure->GetPOST("tabletext");
    $rows= $this->app->Secure->GetPOST("rowcount");
    $cols = $this->app->Secure->GetPOST("colcount");
  
    $headerfields = $this->app->Secure->GetPOST("headerfield");
    $textfields = $this->app->Secure->GetPOST("textfield");

    if($cancel!="")
    {
      header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=4");
      exit;
    }


    if($mode=="tablecreate")
    {
      $this->app->Tpl->Set(TABLEAREA, "<br><fieldset><legend>Tabelle bearbeiten</legend>[TABLECREATE]</fieldset>");
      $this->app->Tpl->Set(TABLEMODE, "<input type=\"submit\" name=\"cancelTable\" value=\"Abbrechen\"/>&nbsp;
				       <input type=\"submit\" name=\"editTable\" value=\"Speichern\"/>");
    }else
    {
      $this->app->Tpl->Set(TABLEMODE, "<input type=\"submit\" name=\"createTable\" value=\"Erstellen\"/>"); 
      $this->app->Tpl->Set(TABLEMODETEXT, "Tabelle erstellen");
    }


    if($create!="")
    {
      if(is_numeric($rows) && is_numeric($cols) && $rows>0 && $cols>0 && is_numeric($id))
      {
	$anzahl_tabellen = $this->app->DB->Select("SELECT COUNT(id) FROM journal_tables WHERE artikel='$id'");
        if($anzahl_tabellen>0)
        {
          $last = $this->app->DB->Select("SELECT MAX(id) FROM journal_tables WHERE artikel='$id'");

          $maxTag = $this->app->DB->Select("SELECT tag FROM journal_tables WHERE artikel='$id' && id=$last");

          $anz = preg_match('/[0-9]+/', $maxTag, $matches);
          if($anz!=0)
            $tagid= $matches[0]+1;
        }else
          $tagid=1;
	$tag = "{Tabelle".$tagid."}";
      
	$this->app->DB->Insert("INSERT INTO journal_tables (artikel, tag, titel, text, nachweis, spalten, zeilen, header_aktiv, titel_aktiv, text_aktiv, nachweis_aktiv)
				VALUES('$id', '$tag', '$title', '$text', '$link','$cols', '$rows', '$showheader', '$showtitle', '$showtext', '$showlink')");
	
	$insertID = $this->app->DB->GetInsertID();
	header("Location: ./index.php?module=zeitschrift&action=write&id=$id&mode=tablecreate&tid=$insertID&tab=4");	
      }else
	$this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Sie m&uuml;ssen eine Spalten- und eine Zeilenanzahl eingeben.</div>");
    }

    

    if(is_numeric($id))
    {
      if($mode=="tabledelete" && is_numeric($tableid))
      {
	$this->app->DB->Update("UPDATE journal_tables SET aktiv='0' WHERE artikel='$id' AND id='$tableid'");
	header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=4");
      }
     
      if($mode=="tablecreate" && is_numeric($tableid))
      { 
	$this->app->Tpl->Set(TABLEMODETEXT, "Tabelleneinstellungen editieren");
	// Daten speichern
	if($edit!="" && $mode=="tablecreate")
        {
          $this->app->DB->Update("UPDATE journal_tables SET titel='$title', text='$text', nachweis='$link', spalten='$cols', zeilen='$rows', 
                                  header_aktiv='$showheader', titel_aktiv='$showtitle', text_aktiv='$showtext', nachweis_aktiv='$showlink',
				  header='".serialize($headerfields)."', felder='".serialize($textfields)."'
                                  WHERE artikel='$id' AND id='$tableid'");
	  header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=4");
        }

	// Felder füllen
	$mytable = $this->app->DB->SelectArr("SELECT * FROM journal_tables WHERE artikel='$id' AND id='$tableid'");
        $this->app->Tpl->Set(TABLETITLE,$mytable[0][titel]);
        $this->app->Tpl->Set(TABLETEXT,$mytable[0][text]);
        $this->app->Tpl->Set(TABLELINK,$mytable[0][nachweis]);
        $this->app->Tpl->Set(COLCOUNT,$mytable[0][spalten]);
        $this->app->Tpl->Set(ROWCOUNT,$mytable[0][zeilen]);

        if($mytable[0][titel_aktiv]=="1")
          $this->app->Tpl->Set(TABLETITLECHECKED, "checked=\"true\"");

        if($mytable[0][text_aktiv]=="1")
          $this->app->Tpl->Set(TABLETEXTCHECKED, "checked=\"true\"");

        if($mytable[0][nachweis_aktiv]=="1")
          $this->app->Tpl->Set(TABLELINKCHECKED, "checked=\"true\"");

        if($mytable[0][header_aktiv]=="1")
	  $this->app->Tpl->Set(TABLEHEADERCHECKED, "checked=\"true\"");

	// Tabelle erzeugen
	$out="";
	$rows = $mytable[0][zeilen];
	$cols = $mytable[0][spalten];
	$size = 6;

	// Tabellenkopf
	$out = "<table width=\"50%\" id=\"preview\" align=\"center\">";

	// Überschrift
	if($mytable[0][titel_aktiv]=="1" && $mytable[0][titel]!="")
	  $out .= "<tr><td id=\"previewtitle\" colspan=\"$cols\">{$mytable[0][titel]}</td></tr>";  

	// Header
	if($mytable[0][header_aktiv]=="1")
	{
	  $out .= "<tr id=\"previewheader\">";
	  $myheader = unserialize($mytable[0][header]);
	  for($i=0;$i<$cols;$i++)
	      $out .= "<td><input type=\"text\" name=\"headerfield[$i]\"  size=\"$size\" value=\"{$myheader[$i]}\"/></td>";
	  $out .="</tr>";
	}
	
	//Einträge
	$myfields = unserialize($mytable[0][felder]);
	for($i=0;$i<$rows;$i++)
	{
	  $out .= "<tr class=\"preview\">"; 
	  for($j=0;$j<$cols;$j++)
	    $out .= "<td><input type=\"text\" name=\"textfield[$i][$j]\" size=\"$size\" value=\"{$myfields[$i][$j]}\" /></td>";
	  $out .= "</tr>";
	}

	// Beschreibung
	if($mytable[0][text_aktiv]=="1" && $mytable[0][text]!="")	
	  $out .= "<tr><td id=\"previewtext\" colspan=\"$cols\">{$mytable[0][text]}</td></tr>";
	
	// Nachweis
	if($mytable[0][nachweis_aktiv]=="1" && $mytable[0][nachweis]!="")
	  $out .= "<tr><td id=\"previewlink\" colspan=\"$cols\">{$mytable[0][nachweis]}</td></tr>";

	$out .= "</table";
      
	$this->app->Tpl->Set(TABLECREATE, $out);
      }

      // Tabellenliste füllen
      $table = $this->app->DB->SelectArr("SELECT * FROM journal_tables WHERE artikel='$id' AND aktiv='1'");
      if(count($table)>0)
      {
	for($i=0;$i<count($table);$i++)
	{
	  $liste .="<tr>
		    <td align=\"center\">{$table[$i][tag]}</td>
		    <td>{$table[$i][titel]}</td>
		    <td>{$table[$i][text]}</td>
		    <td>{$table[$i][spalten]}</td>
		    <td>{$table[$i][zeilen]}</td>
		    <td align=\"center\">
		      <a href=\"./index.php?module=zeitschrift&action=write&id={$id}&mode=tablecreate&tid={$table[$i][id]}&tab=4\"><img src=\"./themes/default/images/edit.png\" border=\"0\"/></a>
		      <a href=\"#\" onclick=\"if(!confirm('Wollen Sie die Tabelle wirklich l&ouml;schen?')) return false; 
                                                  else window.location.href='./index.php?module=zeitschrift&action=write&id={$id}&mode=tabledelete&tid={$table[$i][id]}&tab=4';\"\">
                                                  <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a>
		    </td>
		  </tr>";
	}
      }else
	$liste = "<tr><td colspan=\"6\">Keine Tabellen gefunden.</td></tr>";

      $this->app->Tpl->Set(TABLELIST, $liste);
    }
	
    $this->app->Tpl->Parse(INHALT,"");
    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_table.tpl");
  }

  function ZeitschriftWriteListing($id)
  {
    $this->app->erp->HilfeBox("hilfeartikellisting");
    
    $mode = $this->app->Secure->GetGET("mode"); // editlisting
    $listingid = $this->app->Secure->GetGET("lid");

    $save = $this->app->Secure->GetPOST("saveListing");
    $cancel = $this->app->Secure->GetPOST("cancelListing");
    $description_active = $this->app->Secure->GetPOST("descriptionactive");
    $description = $this->app->Secure->GetPOST("description");
    $listingtext = $this->app->Secure->POST["listingtext"];
    
    if(is_numeric($id))
    {
      $this->app->Tpl->Set(ID, $id);
 
      if($mode=="deletelisting" && is_numeric($listingid))
      {
	$this->app->DB->Update("UPDATE journal_listings SET aktiv='0' WHERE artikel='$id' AND id='$listingid'");
        header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=5");
	exit;
      }
      else if($mode=="editlisting" && is_numeric($listingid))
      {
	$this->app->Tpl->Set(LISTINGMODE, "<input type=\"submit\" name=\"cancelListing\" value=\"Abbrechen\" />&nbsp;<input type=\"submit\" name=\"saveListing\" value=\"Speichern\" />");
	$this->app->Tpl->Set(LISTINGMODETEXT, "Listing editieren");

	// Felder füllen
	$mylisting = $this->app->DB->SelectArr("SELECT * FROM journal_listings WHERE artikel='$id' AND id='$listingid'");
	$code = base64_decode($mylisting[0][text]);
	$this->app->Tpl->Set(DESCRIPTION, $mylisting[0][beschreibung]);
	$this->app->Tpl->Set(LISTINGTEXT, $code);
	
	if($mylisting[0][beschreibung_aktiv]=="1")
	  $this->app->Tpl->Set(DESCRIPTIONCHECKED, "checked=true");

	if($cancel!="")
	{
	  header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=5");
	  exit;
	}

	if($save!="")
	{
	  $this->app->DB->Update("UPDATE journal_listings SET beschreibung='$description', beschreibung_aktiv='$description_active', text='".base64_encode(stripslashes($listingtext))."'
				  WHERE artikel='$id' AND id='$listingid'");
	  //header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=5");
	  //exit;
	}
      }else
      {
	$this->app->Tpl->Set(LISTINGMODE, "<input type=\"submit\" name=\"saveListing\" value=\"Speichern\" />");
	$this->app->Tpl->Set(LISTINGMODETEXT, "Listing erstellen");
	if($save!="")
	{
	  $anzahl_listings = $this->app->DB->Select("SELECT COUNT(id) FROM journal_listings WHERE artikel='$id'");
          if($anzahl_listings>0)
          { 
            $last = $this->app->DB->Select("SELECT MAX(id) FROM journal_listings WHERE artikel='$id'");

            $maxTag = $this->app->DB->Select("SELECT tag FROM journal_listings WHERE artikel='$id' && id=$last");

            $anz = preg_match('/[0-9]+/', $maxTag, $matches);
            if($anz!=0)
              $tagid= $matches[0]+1;
          }else
            $tagid=1;

          $tag = "{Listing$tagid}";
	  $this->app->DB->Insert("INSERT INTO journal_listings (artikel, tag, beschreibung, beschreibung_aktiv, text)
				    VALUES ('$id', '$tag', '$description', '$description_active', '".base64_encode(stripslashes($listingtext))."')");
	  header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=5");
	  exit;	
	}
      }
      
      // Tabelle füllen
      $listings = $this->app->DB->SelectArr("SELECT * FROM journal_listings WHERE artikel='$id' AND aktiv='1'");
      $limit=70;
      if(count($listings)>0)
      {
	for($i=0;$i<count($listings);$i++)
	{
	  $raw_text = htmlentities(base64_decode($listings[$i][text]));
	  if(strlen($raw_text)>$limit) 
	    $text = substr($raw_text, 0, 70)." ...";
	  else
	    $text = $raw_text;
	  $out .= "<tr>
		    <td align=\"center\">{$listings[$i][tag]}</td>
		    <td>{$listings[$i][beschreibung]}</td>
		    <td>$text</td>
		    <td align=\"center\">
		      <a href=\"./index.php?module=zeitschrift&action=write&id={$id}&mode=editlisting&lid={$listings[$i][id]}&tab=5\"><img src=\"./themes/default/images/edit.png\" border=\"0\"/></a>
		      <a href=\"#\" onclick=\"if(!confirm('Wollen Sie das Listing wirklich l&ouml;schen?')) return false; 
                                                  else window.location.href='./index.php?module=zeitschrift&action=write&id={$id}&mode=deletelisting&lid={$listings[$i][id]}&tab=5';\"\">
                                                  <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a>

		    </td>
		   </tr>";
	}
      }
	else $out = "<tr><td colspan=\"4\">Keine Listings gefunden.</td></tr>";
    
      $this->app->Tpl->Set(LISTINGTABLE, $out);

    }

    $this->app->Tpl->Parse(INHALT,"");
    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_listing.tpl");
  }

  function ZeitschriftWriteBibliography($id)
  {
    $this->app->erp->HilfeBox("hilfeartikelbibliography");
    
    $mode = $this->app->Secure->GetGET("mode"); // editlisting
    $bibid = $this->app->Secure->GetGET("lid");

    $save = $this->app->Secure->GetPOST("saveBibliography");
    $cancel = $this->app->Secure->GetPOST("cancelBibliography");
    $description_active = $this->app->Secure->GetPOST("bibdescriptionactive");
    $description = $this->app->Secure->GetPOST("bibdescription");
    $biblink = $this->app->Secure->GetPOST("biblink");

    if(is_numeric($id))
    {
      if($mode=="deletebibliography" && is_numeric($bibid))
      {
        $this->app->DB->Update("UPDATE journal_bibliography SET aktiv='0' WHERE artikel='$id' AND id='$bibid'");
        header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=6");
        exit;
      }
      else if($mode=="editbibliography" && is_numeric($bibid))
      {
        $this->app->Tpl->Set(BIBMODE, "<input type=\"submit\" name=\"cancelBibliography\" value=\"Abbrechen\" />&nbsp;<input type=\"submit\" name=\"saveBibliography\" value=\"Speichern\" />");
	$this->app->Tpl->Set(BIBLIOGRAPHYMODETEXT, "Literaturnachweis editieren");


        // Felder füllen
        $mylisting = $this->app->DB->SelectArr("SELECT * FROM journal_bibliography WHERE artikel='$id' AND id='$bibid'");
        $this->app->Tpl->Set(BIBDESCRIPTION, $mylisting[0][beschreibung]);
        $this->app->Tpl->Set(BIBLINK, $mylisting[0][link]);

        if($mylisting[0][beschreibung_aktiv]=="1")
          $this->app->Tpl->Set(BIBDESCRIPTIONCHECKED, "checked=true");

        if($cancel!="")
        {
          header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=6");
          exit;
        }

        if($save!="")
        {
          $this->app->DB->Update("UPDATE journal_bibliography SET beschreibung='$description', beschreibung_aktiv='$description_active', link='$biblink'
                                  WHERE artikel='$id' AND id='$bibid'");

          header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=6");
          exit;
        }
      }else
      {
        $this->app->Tpl->Set(BIBMODE, "<input type=\"submit\" name=\"saveBibliography\" value=\"Speichern\" />");
	$this->app->Tpl->Set(BIBLIOGRAPHYMODETEXT, "Literaturnachweis erstellen");
        if($save!="")
        {
          $anzahl_links = $this->app->DB->Select("SELECT COUNT(id) FROM journal_bibliography WHERE artikel='$id'");
          if($anzahl_links>0)
          {
            $last = $this->app->DB->Select("SELECT MAX(id) FROM journal_bibliography WHERE artikel='$id'");

            $maxTag = $this->app->DB->Select("SELECT tag FROM journal_bibliography WHERE artikel='$id' && id=$last");

            $anz = preg_match('/[0-9]+/', $maxTag, $matches);
            if($anz!=0)
              $tagid= $matches[0]+1;
          }else
            $tagid=1;

          $tag = "{".$tagid."}";

          $this->app->DB->Insert("INSERT INTO journal_bibliography (artikel, tag, beschreibung, beschreibung_aktiv, link)
                                    VALUES ('$id', '$tag', '$description', '$description_active', '$biblink')");
          $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Der Verweis wurden erfolgreich erstellt.</div>");
	  header("Location: ./index.php?module=zeitschrift&action=write&id=$id&tab=6");	
        }
      }

      // Tabelle füllen
      $links = $this->app->DB->SelectArr("SELECT * FROM journal_bibliography WHERE artikel='$id' AND aktiv='1'");
      if(count($links)>0)
      { 
        for($i=0;$i<count($links);$i++)
        {
          $out .= "<tr>
                    <td align=\"center\">{$links[$i][tag]}</td>
                    <td>{$links[$i][beschreibung]}</td>
                    <td>{$links[$i]["link"]}</td>
                    <td align=\"center\">
                      <a href=\"./index.php?module=zeitschrift&action=write&id={$id}&mode=editbibliography&lid={$links[$i][id]}&tab=6\"><img src=\"./themes/default/images/edit.png\" border=\"0\"/></a>
                      <a href=\"#\" onclick=\"if(!confirm('Wollen Sie den Verweis wirklich l&ouml;schen?')) return false; 
                                                  else window.location.href='./index.php?module=zeitschrift&action=write&id={$id}&mode=deletebibliography&lid={$links[$i][id]}&tab=6';\"\">
                                                  <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a>

                    </td>
                   </tr>";
        }
      }
      else $out = "<tr><td colspan=\"4\">Keine Verweise gefunden.</td></tr>";

      $this->app->Tpl->Set(BIBLIOGRAPHYTABLE, $out);
    }

    $this->app->Tpl->Parse(INHALT,"");
    $this->app->Tpl->Parse(GENERIC,"zeitschrift_write_bibliography.tpl");
  }

  
  function ZeitschriftShow() 
  { 
    $this->app->Tpl->Parse(INHALT,"zeitschrift_show.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }
  
  function ZeitschriftEdit() 
  {
    $this->Login();
    
    $this->app->erp->Hilfebox("hilfezeitschriftedit");

    $gesendet = $this->app->Secure->GetPOST("senden");
    $name = $this->app->Secure->GetPOST("name");
    $firmenname = $this->app->Secure->GetPOST("firmenname");
    $strasse = $this->app->Secure->GetPOST("strasse");
    $adresszusatz = $this->app->Secure->GetPOST("adresszusatz");
    $plz = $this->app->Secure->GetPOST("plz");
    $ort = $this->app->Secure->GetPOST("ort");
    $land = $this->app->Secure->GetPOST("land");
    $telefon = $this->app->Secure->GetPOST("telefon");
    $email = $this->app->Secure->GetPOST("email");
    $url = $this->app->Secure->GetPOST("url");
    $pdf = $this->app->Secure->GetPOST("pdf");
    $newsletter = $this->app->Secure->GetPOST("newsletter");
    $zahlungsmittel = $this->app->Secure->GetPOST("zahlungsmittel");
    $kontoinhaber = $this->app->Secure->GetPOST("kontoinhaber");
    $kontonummer = $this->app->Secure->GetPOST("kontonummer");
    $bankleitzahl = $this->app->Secure->GetPOST("bankleitzahl");
    $bank = $this->app->Secure->GetPOST("bank");
    $iban = $this->app->Secure->GetPOST("iban");
    $bic = $this->app->Secure->GetPOST("bic");
    $kreditkartentyp = $this->app->Secure->GetPOST("kreditkartentyp");
    $kreditkartennummer = $this->app->Secure->GetPOST("kreditkartennummer");
    $paypalacc = $this->app->Secure->GetPOST("paypalacc");
    
    $oldpass = $this->app->Secure->GetPOST("oldpass");
    $newpass = $this->app->Secure->GetPOST("newpass");
    $newpass2 = $this->app->Secure->GetPOST("newpass2");
     
    if($gesendet!="")
    {
      $error='';

      if($name=="") $error .= "Geben Sie bitte Ihren Namen an.<br>";
      if($strasse=="") $error .= "Geben Sie bitte Ihre Stra&szlig;e an.<br>";
      if($plz=="") $error .= "Geben Sie bitte Ihre Postleitzahl an.<br>";
      if($ort=="") $error .= "Geben Sie bittei Ihren Ort an.<br>";
      if($land=="") $error .= "W&auml;hlen Sie bitte Ihr Land aus.<br>";
      if($email=="") $error .= "Geben Sie bitte Ihre E-Mail-Adresse an.<br>";
      if($zahlungsmittel=="" && $this->geldverbindung==true) $error .= "Wählen Sie bitte ein Zahlungsmittel aus.<br>";
      if($zahlungsmittel!="" && $this->geldverbindung==true)
      {
	if($zahlungsmittel=="kreditkarte")
	{
	  if($kreditkartentyp=="") $error .= "W&auml;hlen Sie bitte einen Kreditkartentyp aus.<br>";
	  if($kreditkartennummer=="") $error .= "Geben Sie bitte Ihre Kreditkartennummer ein.<br>";
	}
	if($zahlungsmittel=="paypal")
	{
	  if($paypalacc=="") $error .= "Geben Sie bitte Ihre PayPal-Adresse an.<br>";
    	}

	if($zahlungsmittel=="bankeinzug")
	{
	  if($kontoinhaber=="") $error .= "Geben Sie bitte den Kontoinhaber an.<br>";
	  if($kontonummer=="") $error .= "Geben Sie bitte Ihre Kontonummer an.<br>";
	  if($bankleitzahl=="") $error .= "Geben Sie bitte die Bankleitzahl Ihres Geldinstitutes an.<br>";
	}
      }
     
      if($oldpass!="" && $newpass!="" && $newpass2!="")
      {
	$user_id = $this->app->User->GetAdresse();
	$olddbpass = $this->app->DB->Select("SELECT password FROM user WHERE kundendaten='$user_id' LIMIT 1");
	if(md5($oldpass)==$olddbpass)
	{
	  if($newpass==$newpass2)
	  {
	    $email = $this->app->erp->Decrypt($this->app->DB->Select("SELECT email FROM kundendaten WHERE id='$user_id' LIMIT 1"));
	    $this->app->erp->changePassword($email, $newpass, 0);
	    $passtext = "<br>Das Passwort wurde erfolgreich ge&auml;dert.";
	  }else
	    $error .= "Die eingegeben Passw&ouml;rter stimmen nicht &uuml;berein<br>";

	}else
	  $error .= "&Uuml;berpr&uuml;fen Sie das alte Passwort.<br>";

      }
 
      if($pdf=="CHECKED") $pdf=1;
	else $pdf=0;
      
      if($newsletter=="CHECKED") $newsletter=1;
        else $newsletter=0;


      $c_name = $this->app->erp->Encrypt($name);
      $c_adresszusatz = $this->app->erp->Encrypt($adresszusatz);
      $c_strasse = $this->app->erp->Encrypt($strasse);
      $c_plz = $this->app->erp->Encrypt($plz);
      $c_ort = $this->app->erp->Encrypt($ort);
      $c_land = $this->app->erp->Encrypt($land);
      $c_kontoinhaber = $this->app->erp->Encrypt($kontoinhaber);
      $c_kontonummer = $this->app->erp->Encrypt($kontonummer);
      $c_bankleitzahl = $this->app->erp->Encrypt($bankleitzahl);
      $c_bank = $this->app->erp->Encrypt($bank);
      $c_iban = $this->app->erp->Encrypt($iban);
      $c_bic = $this->app->erp->Encrypt($bic);
      $c_paypalacc = $this->app->erp->Encrypt($paypalacc);
      $c_kreditkartentyp = $this->app->erp->Encrypt($kreditkartentyp);
      $c_kreditkartennummer = $this->app->erp->Encrypt($kreditkartennummer);
      $c_zahlungsmittel = $this->app->erp->Encrypt($zahlungsmittel);
      $c_email = $this->app->erp->Encrypt($email);
      $c_telefon = $this->app->erp->Encrypt($telefon);
      $c_firmenname = $this->app->erp->Encrypt($firmenname);
      $c_url = $this->app->erp->Encrypt($url);

      $this->app->DB->Update("UPDATE kundendaten 
			      SET name='$c_name', adresszusatz='$c_adresszusatz', strasse='$c_strasse', plz='$c_plz', ort='$c_ort', land='$c_land', 
			      kontoinhaber='$c_kontoinhaber', konto='$c_kontonummer', blz='$c_bankleitzahl', institut='$c_bank', iban='$c_iban', 
			      bic='$c_bic', paypal='$c_paypalacc', kreditkartetyp='$c_kreditkartentyp', kreditkartennummer='$c_kreditkartennummer', 
			      zahlungsweise='$c_zahlungsmittel', email='$c_email', pdf='$pdf', newsletter='$newsletter', telefon='$c_telefon',
			      firmenname='$c_firmenname',url='$c_url'
			      WHERE id='{$_SESSION['userid']}'");

      
      //verschl. Backup erzeugen
      $backup = array("email"=>$email,"firmenname"=>$firmenname,"telefon"=>$telefon,"homepage"=>$url,"name"=>$name,
                    "strasse"=>$strasse,"adresszusatz"=>$adresszusatz,"plz"=>$plz,"ort"=>$ort, "land"=>$land,
                    "ausgabe"=>$pdf, "newsletter"=>$newsletter,"id"=>$_SESSION[userid],
                    "zahlungsmittel"=>$zahlungsmittel,"kontoinhaber"=>$kontoinhaber,"konto"=>$kontonummer,
                    "blz"=>$bankleitzahl,"institut"=>$bank,"iban"=>$iban,"bic"=>$bic,"kreditkartetyp"=>$kreditkartentyp,
                    "kreditkartennummer"=>$kreditkartennummer,"paypal"=>$paypalacc);

      $eproo_key = "7aCN5VQKzik2cJRXdCa2j06YFl6nKCXP"; 
      $c_backup = $this->app->erp->Encrypt(base64_encode(serialize($backup)), $this->app->erp->EprooKey());
      $this->app->DB->Insert("INSERT INTO backup (sessionid, typ, daten, log) 
                              VALUES ('".session_id()."', 'update','".$c_backup."', NOW())");



      
      if($error=='')
	$this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Die Einstellungen wurden erfolgreich ge&auml;ndert.$passtext</div>");
      else
	$this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");      
    }
    
    if($_SESSION[userid]!="")
    {
      $data = $this->app->DB->SelectArr("SELECT * FROM kundendaten WHERE id='{$_SESSION['userid']}'");

      if($data[0][pdf]=="1")
	$data[0][pdf]="CHECKED";
      else $data[0][pdf]="";

      if($data[0][newsletter]=="1")
        $data[0][newsletter]="CHECKED";
      else $data[0][newsletter]="";

      $this->app->Tpl->Set(NAME, $this->app->erp->Decrypt($data[0][name]));
      $this->app->Tpl->Set(FIRMENNAME, $this->app->erp->Decrypt($data[0][firmenname]));
      $this->app->Tpl->Set(ADRESSZUSATZ, $this->app->erp->Decrypt($data[0][adresszusatz]));
      $this->app->Tpl->Set(STRASSE, $this->app->erp->Decrypt($data[0][strasse]));
      $this->app->Tpl->Set(PLZ, $this->app->erp->Decrypt($data[0][plz]));
      $this->app->Tpl->Set(ORT, $this->app->erp->Decrypt($data[0][ort]));
      $this->app->Tpl->Set(LAND,$this->app->SelectLaenderliste( $this->app->erp->Decrypt($data[0][land])));
      $this->app->Tpl->Set(TELEFON, $this->app->erp->Decrypt($data[0][telefon]));
      $this->app->Tpl->Set(EMAIL, $this->app->erp->Decrypt($data[0][email]));
      $this->app->Tpl->Set(PDFCHECKED, $data[0][pdf]);
      $this->app->Tpl->Set(URL, $this->app->erp->Decrypt($data[0][url]));
      $this->app->Tpl->Set(NEWSLETTERCHECKED, $data[0][newsletter]);
      $this->app->Tpl->Set(KONTOINHABER, $this->app->erp->Decrypt($data[0][kontoinhaber]));
      $this->app->Tpl->Set(KONTONUMMER, $this->app->erp->Decrypt($data[0][konto]));
      $this->app->Tpl->Set(BANKLEITZAHL, $this->app->erp->Decrypt($data[0][blz]));
      $this->app->Tpl->Set(BANK, $this->app->erp->Decrypt($data[0][institut]));
      $this->app->Tpl->Set(IBAN,$this->app->erp->Decrypt($data[0][iban]));
      $this->app->Tpl->Set(BIC, $this->app->erp->Decrypt($data[0][bic]));
      $this->app->Tpl->Set(KREDITKARTENNUMMER,$this->app->erp->Decrypt($data[0][kreditkartennummer]));
      $this->app->Tpl->Set(PAYPALACC, $this->app->erp->Decrypt($data[0][paypal]));

      // Zahlungsweise
      $zweise = $this->app->erp->Decrypt($data[0][zahlungsweise]);
	
      if($zweise=="kreditkarte")
      {
	$this->app->Tpl->Set(KREDITKARTECHECKED, "CHECKED");
        $this->app->Tpl->Set(SELECTED, "2");
      }

      if($zweise=="paypal")
      {
	$this->app->Tpl->Set(PAYPALCHECKED, "CHECKED");
	$this->app->Tpl->Set(SELECTED, "3");
      }

      if($zweise=="bankeinzug")
      {
	$this->app->Tpl->Set(BANKEINZUGCHECKED, "CHECKED");
	$this->app->Tpl->Set(SELECTED, "1");
      }
	
      // Kreditkartentyp
      $ktyp = $this->app->erp->Decrypt($data[0][kreditkartetyp]);

      if($ktyp=="visa")
	$this->app->Tpl->Set(VISACHECKED, "CHECKED");

      if($ktyp=="mastercard")
	$this->app->Tpl->Set(MASTERCARDCHECKED, "CHECKED");
    }

    $this->app->Tpl->Parse(INHALT,"zeitschrift_edit.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function makeThumbnail($file, $maxBreite, $maxHoehe)
  {

    $pfad = $file[tmp_name];
    $info = getimagesize($pfad);
    $typ = $info[2];

    $breite = $info[0];
    $hoehe = $info[1];
    //echo "BREITE: $breite, HOEHE: $hoehe<br>";
    $ratio = $breite / $hoehe;
    //echo "RATIO: $ratio<br>";

    switch($typ)
    {
      case 1:
        $bild = ImageCreateFromGIF($pfad);
      break;
      case 2:
        $bild = ImageCreateFromJPEG($pfad);
      break;
      case 3:
        $bild = ImageCreateFromPNG($pfad);
      default:
        $postfix="unknown";
      break;
    }


    // Bild breiter als hoch > Brenite skalieren
    if($ratio>=1)
    {
      $neuesBild = imagecreatetruecolor($maxBreite, ($maxBreite/$breite) * $hoehe);
      imagecopyresized($neuesBild,$bild,0,0,0,0,$maxBreite, ($maxBreite/$breite) * $hoehe,$breite,$hoehe);
    }

    // Bild hoeher als breit > Hoehe skalieren
    if($ratio<1)
    {
      $neuesBild = imagecreatetruecolor(($maxHoehe/$hoehe) * $breite, $maxHoehe);
      imagecopyresized($neuesBild,$bild,0,0,0,0,($maxHoehe/$hoehe) * $breite,$maxHoehe,$breite,$hoehe);
    }

    ob_start();
    imagejpeg($neuesBild);
    $raw_data = ob_get_contents();
    ob_end_clean();
    return array("bild"=>base64_encode($raw_data), "typ"=>"image/jpeg");
  }

  function renderThumbnail()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $bild = $this->app->DB->Select("SELECT thumbnail FROM journal_images WHERE id='$id'");
      header("Content-type: image/jpeg");
      echo base64_decode($bild);
    }
  }

}




?>

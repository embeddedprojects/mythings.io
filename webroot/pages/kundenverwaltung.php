<?php
  
class Kundenverwaltung
{
  function Kundenverwaltung(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","KundenverwaltungList");
    $this->app->ActionHandler("show","KundenverwaltungShow");
    $this->app->ActionHandler("lock","KundenverwaltungLock");
    $this->app->ActionHandler("unlock","KundenverwaltungUnlock");
    $this->app->ActionHandler("delete","KundenverwaltungDelete");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);

  }

  function KundenverwaltungList()
  {
    $export = $this->app->Secure->GetPOST("kundenexport");
    $submit = $this->app->Secure->GetPOST("searchsubmit");
    $text = $this->app->Secure->GetPOST("searchtext");

    if($export!="")
      $this->KundenExportCSV();


    if($submit!="" && $text!="")
    {
      $names = $this->app->DB->SelectArr("SELECT id, name FROM kundendaten");

      for($i=0;$i<count($names);$i++)
      {
	      $regex = '/'.$text.'/i';
	
	      $encrypted_name = $this->app->erp->Decrypt($names[$i][name]);
	      if(preg_match($regex, $encrypted_name))
	        $result[] = $names[$i][id];
      }
      $this->KundenTable($result);
    }else
      $this->app->Tpl->Set(TABLE, "<tr><td colspan=\"8\">Geben sie bitte eine Namen ein.</td></tr>");

    $this->renderStatistik();
    $this->renderBlacklistTable();

    $this->app->Tpl->Parse(INHALT, "kundenverwaltung.tpl");  
    $this->app->Tpl->Parse(PAGE, "index.tpl");  
  }

  function KundenExportCSV()
  {
    $data = $this->app->DB->SelectArr("SELECT * FROM kundendaten");

    $out = "\"id\";\"type\";\"name\";\"firmenname\";\"adresszusatz\";\"strasse\";\"plz\";\"ort\";\"land\";\"kontoinhaber\";\"konto\";\"blz\";\"institut\";\"bic\";\"iban\";\"paypal\";\"kreditkartetyp\";\"kreditkartennummer\";\"zahlungsweise\";\"email\";\"url\";\"telefon\";\"abotyp\";\"aktiv\";\"verlaengerungstyp\";\"adresstyp\";\"liefername\";\"lieferstrasse\";\"lieferzusatz\";\"lieferplz\";\"lieferort\"\n";

    for($i=0;$i<count($data);$i++)
    {
      $id = $data[$i][id];
      $type = $data[$i][type];
      $name = $this->app->erp->Decrypt($data[$i][name]);
      $firmenname = $this->app->erp->Decrypt($data[$i][firmenname]);
      $adresszusatz = $this->app->erp->Decrypt($data[$i][adresszusatz]);
      $strasse = $this->app->erp->Decrypt($data[$i][strasse]);
      $plz = $this->app->erp->Decrypt($data[$i][plz]);
      $ort = $this->app->erp->Decrypt($data[$i][ort]);
      $land = $this->app->erp->Decrypt($data[$i][land]);
      $kontoinhaber = $this->app->erp->Decrypt($data[$i][kontoinhaber]);
      $konto = $this->app->erp->Decrypt($data[$i][konto]);
      $blz = $this->app->erp->Decrypt($data[$i][blz]);
      $institut = $this->app->erp->Decrypt($data[$i][institut]);
      $bic = $this->app->erp->Decrypt($data[$i][bic]);
      $iban = $this->app->erp->Decrypt($data[$i][iban]);
      $paypal = $this->app->erp->Decrypt($data[$i][paypal]);
      $kreditkartetyp = $this->app->erp->Decrypt($data[$i][kreditkartetyp]);
      $kreditkartennummer = $this->app->erp->Decrypt($data[$i][kreditkartennummer]);
      $zahlungsweise = $this->app->erp->Decrypt($data[$i][zahlungsweise]);
      $email = $this->app->erp->Decrypt($data[$i][email]);
      $url = $this->app->erp->Decrypt($data[$i][url]);
      $telefon = $this->app->erp->Decrypt($data[$i][telefon]);

      // ---- Abotyp ----- //
      $verlosung = $data[$i][verlosung];
      $pdf = $data[$i][pdf];
      $abo_id = $this->app->DB->Select("SELECT MAX(id) FROM journal_aborechnung WHERE  aktiv='1' AND gesperrt='0' AND adresse ='$id' LIMIT 1");

      if($verlosung==1 && $pdf==0 && !is_numeric($abo_id)) $abotyp = "verlosung";
      if($verlosung==0 && $pdf==1 && !is_numeric($abo_id)) $abotyp = "email";
      if($verlosung==0 && $pdf==0 && is_numeric($abo_id)) $abotyp = "printausgabe";
      // ---- Abotyp-Ende ---- //

      // ---- Lieferadresse ---- //
      $lieferdaten = $this->app->DB->SelectArr("SELECT * FROM abonnements WHERE adresse='$id' LIMIT 1");
      $verlaengerungstyp = $lieferdaten[0][verlaengerung];
      $adresstyp = $lieferdaten[0][adresstyp];
      $liefername = $lieferdaten[0][name];
      $lieferstrasse = $lieferdaten[0][strasse];
      $lieferzusatz= $lieferdaten[0][zusatz];
      $lieferplz = $lieferdaten[0][plz];
      $lieferort = $lieferdaten[0][ort];
      // ---- Lieferadresse-Ende ---- //

      $aktiv = $data[$i][aktiv];

      $out .= $this->MakeCol($id).';'.$this->MakeCol($type).';'.$this->MakeCol($name).';'.$this->MakeCol($firmenname).';'.$this->MakeCol($adresszusatz).';'.$this->MakeCol($strasse).';'.$this->MakeCol($plz).';'.$this->MakeCol($ort).';'.$this->MakeCol($land).';'.$this->MakeCol($kontoinhaber).';'.$this->MakeCol($konto).';'.$this->MakeCol($blz).';'.$this->MakeCol($institut).';'.$this->MakeCol($bic).';'.$this->MakeCol($iban).';'.$this->MakeCol($paypal).';'.$this->MakeCol($kreditkartetyp).';'.$this->MakeCol($kreditkartennummer).';'.$this->MakeCol($zahlungsweise).';'.$this->MakeCol($email).';'.$this->MakeCol($url).';'.$this->MakeCol($telefon).';'.$this->MakeCol($abotyp).';'.$this->MakeCol($aktiv).';'.$this->MakeCol($verlaengerungstyp).';'.$this->MakeCol($adresstyp).';'.$this->MakeCol($liefername).';'.$this->MakeCol($lieferstrasse).';'.$this->MakeCol($lieferzusatz).';'.$this->MakeCol($lieferplz).';'.$this->MakeCol($lieferort)."\n";
    }

    $filename = "kundenexport_".date("d-m-Y").".csv";
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ob_start();
    echo $out;
    ob_end_flush();
    exit;

  }

  function MakeCol($col)
  {
    if($col!="")
      return "\"$col\"";
    return "";
  }

  function renderStatistik()
  {
    $kundenanzahl = $this->app->DB->Select("SELECT COUNT(*) FROM kundendaten");
    $inaktiv = $this->app->DB->Select("SELECT COUNT(*) FROM kundendaten WHERE aktiv='0'");
    $aboprint = $this->app->DB->Select("SELECT COUNT(*) FROM journal_aborechnung WHERE aktiv='1' AND gesperrt='0'");
    $aboemail = $this->app->DB->Select("SELECT COUNT(*) FROM kundendaten WHERE pdf='1' AND aktiv='1'");
    $abogesamt = $aboprint + $aboemail;
    $verlosung = $this->app->DB->Select("SELECT COUNT(*) FROM kundendaten WHERE verlosung='1' AND aktiv='1'");

    $this->app->Tpl->Set(KUNDENANZAHL, $kundenanzahl);
    $this->app->Tpl->Set(INAKTIV, $inaktiv);
    $this->app->Tpl->Set(ABOGESAMT, $abogesamt);
    $this->app->Tpl->Set(PRINTAUSGABE, $aboprint);
    $this->app->Tpl->Set(ABOEMAIL, $aboemail);
    $this->app->Tpl->Set(VERLOSUNG, $verlosung);
  }

  function KundenTable($idList)
  {
    if(count($idList)>0)
    {
      for($i=0;$i<count($idList);$i++)
      {
  	    $data = $this->app->DB->SelectArr("SELECT name, firmenname, strasse, plz, ort, email, telefon 
					                                 FROM kundendaten WHERE id='{$idList[$i]}'");

	      $name = $this->app->erp->Decrypt($data[0][name]);	
	      $firmenname = $this->app->erp->Decrypt($data[0][firmenname]);	
	      $strasse = $this->app->erp->Decrypt($data[0][strasse]);	
	      $plz = $this->app->erp->Decrypt($data[0][plz]);	
	      $ort = $this->app->erp->Decrypt($data[0][ort]);	
	      $email = $this->app->erp->Decrypt($data[0][email]);	
	      $emaillink = "<a href=\"mailto:$email\">$email</a>";	
	      $telefon = $this->app->erp->Decrypt($data[0][telefon]);	

        $class = $this->app->erp->GetClass($i);

	      $out .= "<tr class=\"$class\">
		        <td><a href=\"./index.php?module=kundenverwaltung&action=show&id={$idList[$i]}\">$name</a></td>
		        <td>$firmenname</td>
		        <td>$strasse</td>
		        <td>$plz</td>
		        <td>$ort</td>
		        <td>$emaillink</td>
		        <td>$telefon</td>
            <td><a onclick=\"if(!confirm('Wollen Sie den Benutzer mitsamt allen erzeugten Daten l&ouml;schen? (Nur f&uuml;r SPAMBOTS)')) return false; 
                else window.location.href='./index.php?module=kundenverwaltung&action=delete&id={$idList[$i]}';\" href=\"#\">
                <img src=\"./themes/default/images/delete.gif\" border=\"0\"/></a></td>
		      </tr>";
      }
    }else
      $out = "<tr><td colspan=\"8\">Keine Personen gefunden.</td></tr>";
  
    $this->app->Tpl->Set(TABLE, $out);
  }

  function renderBlacklistTable()
  {
    $liste = $this->app->DB->SelectArr("SELECT jabo.id, k.id AS adresse,k.name, k.telefon, k.email, jabo.kommentar FROM journal_aborechnung AS jabo
			                                  JOIN kundendaten AS k
					                              ON k.id=jabo.adresse
					                              WHERE gesperrt='1'");
   
    if(count($liste)>0)
    { 
      for($i=0;$i<count($liste);$i++)
      {
	      $email = $this->app->erp->Decrypt($liste[$i][email]);
	      $emaillink = "<a href=\"mailto:$email\">$email</a>";

	      $out .= "<tr>
		              <td>{$liste[$i][id]}</td>
		              <td><a href=\"./index.php?module=kundenverwaltung&action=show&id={$liste[$i][adresse]}\">
			            ".$this->app->erp->Decrypt($liste[$i][name])."</a></td>
		              <td>".$this->app->erp->Decrypt($liste[$i][telefon])."</td>
		              <td>$emaillink</td>
		              <td>{$liste[$i][kommentar]}</td>
		              <td><a onclick=\"if(!confirm('Wollen Sie das Abonnement wirklich entsperren?')) return false; 
                          else window.location.href='./index.php?module=kundenverwaltung&action=unlock&id={$liste[$i][id]}';\" href=\"#\">
                          Entsperren</a></td>
		              </tr>";
      }
  
    }else
      $out = "<tr><td colspan=\"6\">Keine Eintr&auml;ge vorhanden.</td></tr>";
    
    $this->app->Tpl->Set(BLACKLIST, $out);
  }

  function KundenverwaltungShow()
  {
    $id = $this->app->Secure->GetGET("id");
  
    if(is_numeric($id))
    {
      $data = $this->app->DB->SelectArr("SELECT name, firmenname, strasse, adresszusatz, plz, ort, land, email, telefon, url
                                         FROM kundendaten WHERE id='$id' LIMIT 1");

      $name = $this->app->erp->Decrypt($data[0][name]);
      $firmenname = $this->app->erp->Decrypt($data[0][firmenname]);
      $strasse = $this->app->erp->Decrypt($data[0][strasse]);
      $zusatz = $this->app->erp->Decrypt($data[0][adresszusatz]);
      $plz = $this->app->erp->Decrypt($data[0][plz]);
      $ort = $this->app->erp->Decrypt($data[0][ort]);
      $land = $this->app->erp->Decrypt($data[0][land]);
      $homepage = $this->app->erp->Decrypt($data[0][url]);
      $email = $this->app->erp->Decrypt($data[0][email]);
      $emaillink = "<a href=\"mailto:$email\">$email</a>";
      $telefon = $this->app->erp->Decrypt($data[0][telefon]);

      $this->app->Tpl->Set(PERSONENNAME, $name);
      $this->app->Tpl->Set(FIRMENNAME, $firmenname);
      $this->app->Tpl->Set(STRASSE, $strasse);
      $this->app->Tpl->Set(ZUSATZ, $zusatz);
      $this->app->Tpl->Set(PLZ, $plz);
      $this->app->Tpl->Set(ORT, $ort);
      $this->app->Tpl->Set(LAND, $land);
      $this->app->Tpl->Set(HOMEPAGE, $homepage);
      $this->app->Tpl->Set(TELEFON, $telefon);
      $this->app->Tpl->Set(EMAIL, $email);

      $abo = $this->app->DB->SelectArr("SELECT * FROM abonnements WHERE adresse='$id' LIMIT 1");

      $vname = $this->app->erp->Decrypt($abo[0][name]);
      $vstrasse = $this->app->erp->Decrypt($abo[0][strasse]);
      $vzusatz = $this->app->erp->Decrypt($abo[0][zusatz]);
      $vplz = $this->app->erp->Decrypt($abo[0][plz]);
      $vort = $this->app->erp->Decrypt($abo[0][ort]);

      if($abo[0][verlaengerung]=="email") $verlaengerung = "E-Mail";
      else $verlaengerung = "Automatisch";

      if($abo[0][adresstyp]=="konto") $adresstyp = "Konto-Adresse";
      else $adresstyp = "Versand-Adresse";


      $this->app->Tpl->Set(VTYP , $verlaengerung);      
      $this->app->Tpl->Set(ATYP , $adresstyp);      
      $this->app->Tpl->Set(VNAME , $vname);      
      $this->app->Tpl->Set(VSTRASSE , $vstrasse);      
      $this->app->Tpl->Set(VZUSATZ , $vzusatz);      
      $this->app->Tpl->Set(VPLZ , $vplz);      
      $this->app->Tpl->Set(VORT , $vort);      

      $anzahl = $this->app->DB->Select("SELECT COUNT(jabo.id) AS anz
					FROM journal_aborechnung AS jrec
					JOIN journal_abonnements AS jabo
					ON jrec.id=jabo.rechnung
					WHERE jrec.adresse='$id'
					AND jabo.versanddatum!='0000-00-00'");

      $this->app->Tpl->Set(ANZAHL, $anzahl);

      $this->renderAboTable($id);
    }

    $this->app->Tpl->Parse(INHALT, "kundenverwaltung_show.tpl");
    $this->app->Tpl->Parse(PAGE, "index.tpl");
  }

  function renderAboTable($id)
  {
    $abos = $this->app->DB->SelectArr("SELECT * FROM journal_aborechnung WHERE adresse='$id'");

    $out = "<table width=\"100%\"><tr><td>Abo-ID</td><td>Bestelldatum</td><td>Bezahlt am</td><td>Vor der ersten Ausgabe gek&uuml;ndigt</td>
	    <td>Gesperrt</td><td>Sperrgrund</td><td>Aktion</td></tr>";


    for($i=0;$i<count($abos);$i++)
    {
      $ausgaben = base64_encode($this->renderAusgabenTable($abos[$i][id]));

      if($abos[$i][bezahlt]=="0000-00-00") $bezahlt = "<td style=\"color:red;\">nicht bezahlt</td>";
      else  $bezahlt = "<td style=\"color:green;\">".$this->app->erp->ConvertDate($abos[$i][bezahlt])."</td>";

      if($abos[$i][aktiv]=="1") $aktiv = "<td style=\"color:green;\">nein</td>";
      else $aktiv = "<td style=\"color:red;\">ja</td>";

      if($abos[$i][gesperrt]=="1") $gesperrt = "<td style=\"color:red;\">ja</td>";
      else  $gesperrt = "<td style=\"color:green;\">nein</td>";

      if($abos[$i][gesperrt]=="1") $sperrlink = "<a onclick=\"if(!confirm('Wollen Sie das Abonnement wirklich entsperren?')) return false; 
                          else window.location.href='./index.php?module=kundenverwaltung&action=unlock&id={$abos[$i][id]}';\" href=\"#\">
			  Entsperren</a>";
      else $sperrlink = "<a href=\"#\" onclick=\"inputText('{$abos[$i][id]}')\">Sperren</a>";

      $out .= "<tr>
		            <td>{$abos[$i][id]}</td>
		            <td>".$this->app->erp->ConvertDate($abos[$i][bestellt])."</td>
		            $bezahlt
		            $aktiv
		            $gesperrt
		            <td>{$abos[$i][kommentar]}</td> 
		            <td><a href=\"#\" onclick=\"render('$ausgaben')\">Ausgaben anzeigen</a> | 
		            $sperrlink
	             </tr>";
    }

    $out .= "</table>";
  
    $this->app->Tpl->Set(ABOTABLE, $out);
  }

  function renderAusgabenTable($aboid)
  {
    $ausgaben = $this->app->DB->SelectArr("SELECT ja.ausgabe, ja.versanddatum, au.beschreibung
                                             FROM journal_abonnements AS ja
                                             JOIN ausgaben AS au
                                             ON ja.ausgabe=au.id
                                             WHERE ja.rechnung='$aboid'" );

    $out = "<table><tr><td>Ausgaben-ID</td><td>Beschreibung</td><td>Versanddatum</td></tr>";
  
    for($i=0;$i<count($ausgaben);$i++)
    {
      if($ausgaben[$i][versanddatum]=="0000-00-00") $versendet = "<td>nicht versendet</td>";
      else $versendet = "<td style=\"color:green;\">".$this->app->erp->ConvertDate($ausgaben[$i][versanddatum])."</td>";

      $out .= "<tr>
      		      <td>{$ausgaben[$i][ausgabe]}</td>  
		            <td>{$ausgaben[$i][beschreibung]}</td>  
		            $versendet
	             </tr>"; 
    }
    
    $out .= "</table>";

    return $out;
  }

  function KundenverwaltungLock()
  {
    $id = $this->app->Secure->GetGET("id");
    $grund = base64_decode($this->app->Secure->GetGET("grund"));

    if(is_numeric($id))
    {
      $this->app->DB->Update("UPDATE journal_aborechnung SET gesperrt='1', kommentar='$grund'
			      WHERE id='$id' LIMIT 1");
      header("Location: {$_SERVER[HTTP_REFERER]}");
    }
  }

  function KundenverwaltungUnlock()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    { 
      $this->app->DB->Update("UPDATE journal_aborechnung SET gesperrt='0' WHERE id='$id' LIMIT 1");
      header("Location: {$_SERVER[HTTP_REFERER]}");
      exit;
    }
  }

  function KundenverwaltungDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->erp->DeleteAllUserData($id);
      header("Location: ./index.php?module=kundenverwaltung&action=list");
      exit;
    }
  }


}




?>

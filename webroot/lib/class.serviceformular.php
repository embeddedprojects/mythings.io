<?php

class Serviceformular 
{ 
  public $gesamtsumme;
  public $app;
  
  function Serviceformular(&$app)
  {
    $this->app=&$app;
  }

  function saveSession()
  {
    $_SESSION['name'] = $this->app->Secure->GetPOST("name");
    $_SESSION['abteilung'] = $this->app->Secure->GetPOST("abteilung");
    $_SESSION['unterabteilung'] = $this->app->Secure->GetPOST("unterabteilung");
    $_SESSION['ansprechpartner'] = $this->app->Secure->GetPOST("ansprechpartner");
    $_SESSION['adresszusatz'] = $this->app->Secure->GetPOST("adresszusatz");
    $_SESSION['strasse'] = $this->app->Secure->GetPOST("strasse");
    $_SESSION['plz'] = $this->app->Secure->GetPOST("plz");
    $_SESSION['ort'] = $this->app->Secure->GetPOST("ort");
    $_SESSION['land'] = $this->app->Secure->GetPOST("land");
    $_SESSION['abweichendelieferadresse'] = $this->app->Secure->GetPOST("abweichendelieferadresse");
    $_SESSION['liefername'] = $this->app->Secure->GetPOST("liefername");
    $_SESSION['lieferstrasse'] = $this->app->Secure->GetPOST("lieferstrasse");
    $_SESSION['lieferort'] = $this->app->Secure->GetPOST("lieferort");
    $_SESSION['lieferplz'] = $this->app->Secure->GetPOST("lieferplz");
    $_SESSION['lieferadresszusatz'] = $this->app->Secure->GetPOST("lieferadresszusatz");
    $_SESSION['telefon'] = $this->app->Secure->GetPOST("telefon");
    $_SESSION['telefax'] = $this->app->Secure->GetPOST("telefax");
    $_SESSION['abfax'] = $this->app->Secure->GetPOST("abfax");
    $_SESSION['email'] = $this->app->Secure->GetPOST("email");
    $_SESSION['ustid'] = $this->app->Secure->GetPOST("ustid");
    $_SESSION['bestellnummer'] = $this->app->Secure->GetPOST("bestellnummer");
    $_SESSION['kundennummer'] = $this->app->Secure->GetPOST("kundennummer");
  }

  function loadSession()
  {
    $this->app->Tpl->Set(NAME,$_SESSION['name']);
    $this->app->Tpl->Set(ABTEILUNG,$_SESSION['abteilung']);
    $this->app->Tpl->Set(UNTERABTEILUNG,$_SESSION['unterabteilung']);
    $this->app->Tpl->Set(ANSPRECHPARTNER,$_SESSION['ansprechpartner']);
    $this->app->Tpl->Set(ADRESSZUSATZ,$_SESSION['adresszusatz']);
    $this->app->Tpl->Set(STRASSE,$_SESSION['strasse']);
    $this->app->Tpl->Set(PLZ,$_SESSION['plz']);
    $this->app->Tpl->Set(ORT,$_SESSION['ort']);
    $this->app->Tpl->Set(LAND,$this->app->SelectLaenderliste($_SESSION['land']));                          
    $this->app->Tpl->Set(LIEFERNAME,$_SESSION['liefername']);
    $this->app->Tpl->Set(LIEFERORT,$_SESSION['lieferort']);
    $this->app->Tpl->Set(LIEFERSTRASSE,$_SESSION['lieferstrasse']);
    $this->app->Tpl->Set(LIEFERPLZ,$_SESSION['lieferplz']);
    $this->app->Tpl->Set(LIEFERADRESSZUSATZ,$_SESSION['adresszusatz']);
    $this->app->Tpl->Set(TELEFON,$_SESSION['telefon']);
    $this->app->Tpl->Set(TELEFAX,$_SESSION['telefax']);
    $this->app->Tpl->Set(EMAIL,$_SESSION['email']);
    $this->app->Tpl->Set(USTID,$_SESSION['ustid']);
    $this->app->Tpl->Set(BESTELLNUMMER,$_SESSION['bestellnummer']);
    $this->app->Tpl->Set(KUNDENNUMMER,$_SESSION['kundennummer']);

    if($_SESSION['abweichendelieferadresse']==1)
      $this->app->Tpl->Set(ABWEICHENDELIEFERADRESSE, "CHECKED");
    
    if($_SESSION['abfax']==1)
      $this->app->Tpl->Set(ABFAX,"CHECKED");
  }

  function addArticle()
  {
    $nummer = $this->app->Secure->GetPOST("artikelnr_neu");
    $anzahl = $this->app->Secure->GetPOST("artikelanz_neu");
    if($nummer!="" && $anzahl>0)
    {
      $_SESSION['articlelist'][] = array('articleid'=>$nummer,'quantity'=>$anzahl);
      $this->saveSession();
    }
  }

  function refreshArticleQuantity()
  { 
    $quantity = $this->app->Secure->GetPOST("cart_quantity");
    for($i=0;$i<count($_SESSION[articlelist]);$i++)
      $_SESSION[articlelist][$i][quantity]=$quantity[$i];
  }

  function deleteArticle()
  {
    $delete = $this->app->Secure->GetPOST("remove");
    //unset($_SESSION[articlelist][])
    for($i=0;$i<count($_SESSION[articlelist]);$i++)
    {
      if($delete[$i]=='on')
      {
	unset($_SESSION[articlelist][$i]);
	$_SESSION[articlelist] = array_values($_SESSION[articlelist]);
      }
    }
  }

  function parseArticleList($liste)
  {
    if(count($liste)>0)
    {
      for($i=0;$i<count($liste);$i++)
      {
	// Daten fuer jeden Artikel holen
	$article = $this->app->DB->SelectArr("SELECT artikel, standardbild, name_de, preis, kurztext_de, umsatzsteuer FROM artikel WHERE nummer='{$liste[$i]['articleid']}'");
      
	if($article[0][umsatzsteuer]=="normal")
	  $steuer = 1.19;
	else if($article[0][umsatzsteuer]=="ermaessigt")
	  $steuer = 1.07;
	else
	  $steuer = 1;

	// TODO: Pfad ersetzen

	if(is_file('/home/hammeran/dms/'.$article[0]['standardbild']))
	  $bild = '<img src="./index.php?module=artikel&action=datei&file='.$article[0]['standardbild'].'" border="0" width="120">';
	else
	  $bild = "<p align=\"center\">kein Bild</p>";	
	$rows.='<tr>
		  <td >'.$bild.'</td>
		  <td align="center">'.$liste[$i]['articleid'].'</td>
		  <td width="7%" align="center"><input type="text" name="cart_quantity[]" value="'.$liste[$i]['quantity'].'" size="2" /></td>
		  <td width="100%"><b>'.$article[0]['name_de'].'</b></td>
		  <td>'.number_format($liste[$i]['quantity'] * $article[0]['preis'] * $steuer, 2,',','').'&nbsp;(inkl. MwSt.&nbsp;'.($steuer-1).'%) </td>
		  <td align="center"><input type="checkbox" name="remove['.$i.']"><br>l&ouml;schen</td>
		  <td><input type="submit" name="refresh" value="aktualisieren"></td>
		</tr>';

	//zeile fuer kurztext : <td><b>'.$article[0]['name_de'].'</b>&nbsp;'.$article[0]['kurztext_de'].'</td>

	$summe+=$liste[$i]['quantity'] * $article[0]['preis'] * $steuer;
      }
    }else
      $rows = "Keine Artikel in der Liste";

    $this->gesamtsumme = $summe;
    
    $this->app->Tpl->Set(ARTIKELLISTE, $rows);
  }

  function sendServiceDefekt()
  {
    $_SESSION[serviceart]="defekter Artikel";
    $this->sendService();
  }

  function sendServiceRueckgabe()
  {
    $_SESSION[serviceart]="14-Tage Rueckgabe";
    $this->sendService();
  }

  function SendBestellFax()
  {
    $_SESSION[serviceart]="Bestellfax";
    
  }


  function sendService()
  {
    $this->saveSession();
      if($_SESSION['kundennummer']=="" || $_SESSION['telefon']=="" || $_SESSION['email']=="")
        $this->app->Tpl->Set(INFO, "<div class=\"warning\">Die Felder Kundennummer, Telefon und E-Mail m&uuml;ssen ausgef&uuml;llt sein</div>");
      else if(!(count($_SESSION[artikel])>0))
        $this->app->Tpl->Set(INFO, "<div class=\"warning\">Es muss mindestens ein Artikel reklamiert werden</div>");
      else
      {
        //UNSet($_SESSION[artikel]);
        if(!empty($_SESSION))
        {
          $this->app->DB->Insert("INSERT INTO service (id,sessionid,daten,logdatei) VALUES ('','".session_id()."','".base64_encode(serialize($_SESSION))."',NOW())");
          $id = $this->app->DB->GetInsertID();
          $pdf = new ServicePDF($this->app,"Defekte Artikel reklamieren");
          $data = array("name" => $_SESSION['name'],
                    "strasse" => $_SESSION['strasse'],
                    "plz" => $_SESSION['plz'],
                    "ort" => $_SESSION['ort'],
                    "land" => $_SESSION['land'],
                    "kundennummer" => $_SESSION['kundennummer'],
                    "telefon" =>$_SESSION['telefon'],
                    "email" =>$_SESSION['email'],
                    "session" =>$id,
                    "bemerkung" =>$_SESSION['bemerkung'],
                    "articlelist" => $_SESSION[artikel]);
          $pdf->getServicePDF($data);

          $beilage->renderDocument();
          $datum =  date('d.m.Y');
          $pdf->filename = 'embedded_projects_Defekt_'.$datum.'.pdf';
          $pdfPfad =  $beilage->DisplayTMP();
          $text = "Guten Tag,\nSie haben vor Kurzem eine Service-Anfrage an uns gerichtet.                                                                                                          Mit dieser E-Mail bekommen Sie das Dokument welches Sie ihrem Paket in ausgedruckter Form beilegen muessen damit wir dieses bearbeiten koennen.";
          $this->app->erp->MailSend("info@embedded-projects.net", "Embedded-Projects GmbH", $_SESSION['email'], "", "Embedded-Projects Serviceanfrage", $text,array($pdfPfad));
          //$beilage->Output('embedded_projects_Defekt_'.$datum.'.pdf','D');
	}
    }
  }
}


?>

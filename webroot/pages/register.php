<?php

class Register 
{
  function Register(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","RegisterList");
    $this->app->ActionHandler("activate","RegisterActivate");
    $this->app->ActionHandler("forget","RegisterForget");
    $this->app->ActionHandler("captcha","RegisterCaptcha");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);

    $eproo = "sp45j43lv0435kljvs0jlcj";
  }


	function check_email_address($email) {
	  // First, we check that there's one @ symbol, 
	  // and that the lengths are right.
	  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
	    // Email invalid because wrong number of characters 
	    // in one section or wrong number of @ symbols.
	    return false;
	  }
	  // Split it into sections to make life easier
	  $email_array = explode("@", $email);
	  $local_array = explode(".", $email_array[0]);
	  for ($i = 0; $i < sizeof($local_array); $i++) {
	    if
	(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
	↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
	$local_array[$i])) {
	      return false;
	    }
	  }
	  // Check if domain is IP. If not, 
	  // it should be valid domain name
	  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
	    $domain_array = explode(".", $email_array[1]);
	    if (sizeof($domain_array) < 2) {
		return false; // Not enough parts to domain
	    }
	    for ($i = 0; $i < sizeof($domain_array); $i++) {
	      if
	(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
	↪([A-Za-z0-9]+))$",
	$domain_array[$i])) {
		return false;
	      }
	    }
	  }
	  return true;
	}

  function RegisterList() 
  {
    $this->app->Tpl->Set(NAVIGATION, $this->app->erp->Navigation(0));

    // wenn nicht https dann schon

//    $this->app->erp->ForceSSL();

    //session_unset();
    $id = $_SESSION[userid];
    $login = $_SESSION[email];

    if(!is_numeric($id))
    {
      $submit = $this->app->Secure->GetPOST(submit);

      $email = $this->app->Secure->GetPOST(email);
      $passwort = $this->app->Secure->GetPOST(passwort);
      $passwort2 = $this->app->Secure->GetPOST(passwort2);

      $firmenname = $this->app->Secure->GetPOST(firmenname);
      $telefon = $this->app->Secure->GetPOST(telefon);
      $homepage = $this->app->Secure->GetPOST(url);
      $name = $this->app->Secure->GetPOST(name);
      $strasse = $this->app->Secure->GetPOST(strasse);
      $adresszusatz = $this->app->Secure->GetPOST(adresszusatz);
      $plz = $this->app->Secure->GetPOST(plz);
      $ort = $this->app->Secure->GetPOST(ort);
      $land = $this->app->Secure->GetPOST(land);
      $ausgabe = ""; //$this->app->Secure->GetPOST(pdf);
      $journal = "1"; //$this->app->Secure->GetPOST(journal);
      $newsletter = $this->app->Secure->GetPOST(newsletter);
      $captcha = $this->app->Secure->GetPOST(captcha);

      $this->app->Tpl->Set(LAND,$this->app->SelectLaenderliste());

      if($submit!="")
      {
	$_SESSION[tmp] = array('email'=>$email, 'firmenname'=>$firmenname, 'telefon'=>$telefon, 'homepage'=>$homepage, 'name'=>$name, 'strasse'=>$strasse, 
			       'adresszusatz'=>$adresszusatz, 'plz'=>$plz, 'ort'=>$ort, 'land'=>$land, 'ausgabe'=>$ausgabe, 'journal'=>$journal, 
			       'newsletter'=>$newsletter); 
	
	$error = "";

	if($email=='' || !$this->check_email_address($email))
	  $error .= "We need an valid email address from you!<br>";

/*	if($name=='')
	  $error .= "Geben Sie bitte Ihren Namen ein.<br>";

	if($strasse=='')
	  $error .= "Geben Sie bitte Ihre Stra&szlig;e an.<br>";

	if($plz=='')
	  $error .= "Geben Sie bitte Ihre Postleitzahl an.<br>";

	if($land=='')
	  $error .= "W&auml;hlen Sie bitte Ihr Land aus.<br>";

	if($ort=='')
          $error .= "Geben Sie bitte ihren Ort an.<br>";
*/
	if(($passwort=='' || $passwort2=='') || ($passwort!=$passwort2))
	  $error .= "We need a password from you!<br>";

	if($captcha=="" || ($captcha!=$_SESSION[captcha]))
	  $error .= "Please give us the captacha!";

	// Prüfen ob Benutzername (E-Mail) bereits belegt. E-Mail + eproo Anteil
	$c_mail = $this->app->erp->Encrypt($email);
	$belegt = $this->app->DB->Select("SELECT id FROM kundendaten WHERE email='$c_mail' LIMIT 1");

	if($belegt!="")
	  $error .= "The email address is already registered!";

	if($error!="")
	{
	  $this->app->Tpl->Set(MESSAGE, "<div class=\"alert\">  
  <a class=\"close\" data-dismiss=\"alert\">×</a>  
  <strong>Warning:</strong> $error  
</div>");
/*	  $this->app->Tpl->Set(FIRMENNAME ,$_SESSION[tmp][firmenname]);
	  $this->app->Tpl->Set(NAME ,$_SESSION[tmp][name]);
	  $this->app->Tpl->Set(STRASSE ,$_SESSION[tmp][strasse]);
	  $this->app->Tpl->Set(ADRESSZUSATZ ,$_SESSION[tmp][adresszusatz]);
	  $this->app->Tpl->Set(PLZ ,$_SESSION[tmp][plz]);
	  $this->app->Tpl->Set(ORT ,$_SESSION[tmp][ort]);
	  $this->app->Tpl->Set(LAND,$this->app->SelectLaenderliste($_SESSION[tmp][land]));
	  $this->app->Tpl->Set(TELEFON ,$_SESSION[tmp][telefon]);*/
	  $this->app->Tpl->Set(EMAIL ,$_SESSION[tmp][email]);
//	  $this->app->Tpl->Set(URL ,$_SESSION[tmp][homepage]);
/*
	  if($_SESSION[tmp][ausgabe]=='1')
	    $this->app->Tpl->Set(PDFCHECKED , "CHECKED");

	  if($_SESSION[tmp][ausgabe]=='1')
            $this->app->Tpl->Set(JOURNALCHECKED , "CHECKED");
*/
	  if($_SESSION[tmp][newsletter]=='1')
            $this->app->Tpl->Set(NEWSLETTERCHECKED , "CHECKED");

	}
	else
	{
	  // Folge: plain -> ripemd -> aes
	  $md5password = md5($passwort);
	
	  $c_email = $this->app->erp->Encrypt($email);
	  $c_firmenname = $this->app->erp->Encrypt($firmenname);
	  $c_telefon = $this->app->erp->Encrypt($telefon);
	  $c_homepage = $this->app->erp->Encrypt($homepage);
	  $c_name = $this->app->erp->Encrypt($name);
	  $c_strasse = $this->app->erp->Encrypt($strasse);
	  $c_adresszusatz = $this->app->erp->Encrypt($adresszusatz);
	  $c_plz = $this->app->erp->Encrypt($plz);
	  $c_ort = $this->app->erp->Encrypt($ort);
	  $c_land = $this->app->erp->Encrypt($land);

	  $ticket = md5($c_email.$md5password.rand(1,999));

	  // Ticket-E-Mail senden
	  // TODO: mailtext anpassen
  
	  $domain = "http://{$_SERVER[HTTP_HOST]}{$_SERVER[SCRIPT_NAME]}?module=register&action=activate&ticket=$ticket";

	  $mailtext = "Hello,

with a click on $domain your registration is complete.


The Embedded Projects team hopes you enjoy the scan and manage.
";

	  $sent = $this->app->erp->MailSend("info@embedded-projects.net", "embedded projects GmbH", $email, $name, "mythings.io activation mail", $mailtext);

	  // Wurde EMail versendet?
	  if($sent==1)
	  {
	    // Speichern in normale Datenbank
	    $this->app->DB->Insert("INSERT INTO kundendaten (email, firmenname, telefon, url, name, strasse, adresszusatz, 
				    plz, ort, land, pdf, journal, newsletter, ticket)
				    VALUES ('$c_email', '$c_firmenname', '$c_telefon', '$c_homepage', '$c_name', '$c_strasse', 
					    '$c_adresszusatz',  '$c_plz', '$c_ort', '$c_land', '$ausgabe', '$journal', '$newsletter', '$ticket')");


	    $id = $this->app->DB->GetInsertID();

	    $this->app->DB->Insert("INSERT INTO user (username, password, kundendaten, activ, type, logdatei) 
                                    VALUES ('".md5($email)."','$md5password', '$id', 0, 'benutzer', NOW())");

	    /*
	    $this->app->DB->Insert("INSERT INTO user (id,username,password,kundendaten,activ,type,logdatei) 
				    VALUES ('','".md5($email)."',ENCRYPT('$passwort'),'$id',0,'benutzer',NOW())");
	    */
	    

	    // verschl. Backup erzeugen 
	    $_SESSION[tmp][id] = $id;
	    $c_backup = $this->app->erp->Encrypt(base64_encode(serialize($_SESSION[tmp])), $this->app->erp->EprooKey());
	    $this->app->DB->Insert("INSERT INTO backup (sessionid, typ, daten, log) 
				    VALUES ('".session_id()."', 'registrierung','$daten', NOW())");
	  
	    session_unset();
	    header("Location: ./index.php?module=register&action=activate");
	    exit;
	  }else
	  {
	    // EMail wurde nicht versendet
	    $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">We have technical problems. Please try yor registration later again.");
	  }
	}
      }
	$this->app->Tpl->Parse(INHALT,"register.tpl");
    }
    else
    { 
      $this->app->Tpl->Set(INHALT,"You are already registered.");
    }

    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function RegisterActivate()
  {
    $ticket = $this->app->Secure->GetGET("ticket");
    $this->app->Tpl->Set(NAVIGATION, $this->app->erp->Navigation(0));
    
    if($ticket!="")
    {
      $id = $this->app->DB->Select("SELECT id FROM kundendaten WHERE ticket='$ticket' AND aktiv='0'");

      if(is_numeric($id))
      {
	$this->app->DB->Update("UPDATE kundendaten SET aktiv='1' WHERE ticket='$ticket'");
	$this->app->DB->Update("UPDATE user SET activ='1' WHERE kundendaten='$id'");
	$this->app->Tpl->Parse(INHALT,"register_redirect.tpl");
      }      
    }else
    {
      $this->app->Tpl->Parse(INHALT,"register_activate.tpl");
    }

    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function RegisterForget()
  {
    $email = $this->app->Secure->GetPOST("forgetmail");  
    $change = $this->app->Secure->GetGET("change");  
    $submit = $this->app->Secure->GetPOST("forgetsubmit");  

    $userid = $this->app->User->GetAdresse();
   
    if($change!="")
    {
      $this->app->Tpl->Parse(INHALT,"register_forget_done.tpl");
    }else
    {
      if(!is_numeric($userid))
      {
	if($submit!="")
	{
	  if($email!="")
	  {
	    $changed = $this->app->erp->changePassword($email);
	    if($changed==1)
	    {
	      header("Location: ./index.php?module=register&action=forget&change=done");
	      exit; 
	    }else
	      $this->app->Tpl->Set(MESSAGE, "<div class=\"warning\">Sie m&uuml;ssen Ihre E-Mail-Adresse angeben.</div>");
	  }
	}
      }else
      {
	header("Location: ./index.php");
	exit;
      }
      $this->app->Tpl->Parse(INHALT,"register_forget.tpl");
    }
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }



  function RegisterCaptcha()
  {
    // Text erzeugen
    $str = "";
    $length = 0;
    for ($i = 0; $i < 4; $i++) 
      $str .= chr(rand(97, 122));
    $_SESSION['captcha'] = $str;

    // Dimensionen
    $imgX = 80;
    $imgY = 35;
    $image = imagecreatetruecolor($imgX, $imgY);

    // Farben
    $rgb1 = rand(0, 255);
    $rgb2 = rand(0, 255);
    $rgb3 = rand(0, 255); 

    // Bild füllen
    $backgr_col = imagecolorallocate($image, $rgb1, $rgb2, $rgb3);
    $border_col = imagecolorallocate($image, 208,208,208);
    $text_col = imagecolorallocate($image, ($rgb1 - 50), ($rgb2 - 50), ($rgb3 - 50));

    imagefilledrectangle($image, 0, 0, $imgX, $imgY, $backgr_col);
    imagerectangle($image, 0, 0, $imgX-1, $imgY-1, $border_col);

    $font = "./themes/mythings/fonts/VeraSe.ttf";
    $font_size = 15;
    $angleMax = 20;
    $angle = rand(-$angleMax, $angleMax);
    $box = imagettfbbox($font_size, $angle, $font, $_SESSION['captcha']);
    $x = (int)($imgX - $box[4]) / rand(1.8,2.2);
    $y = (int)($imgY - $box[5]) / 2;
    imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, $_SESSION['captcha']);

    // Bild schicken
    header("Content-type: image/png");
    imagepng($image);
    imagedestroy ($image);
  }


}
?>

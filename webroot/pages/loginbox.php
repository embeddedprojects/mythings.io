<?php

class LoginBox 
{
  function LoginBox(&$app)
  {
    $this->app=&$app;
  }

  function LoginBoxList()
  {
    $userid = $this->app->User->GetID();

    if(is_numeric($userid))
      $this->UserIsActive();
    else
      $this->UserIsInactive();
  }

  function UserIsActive()
  {
    // Schreibe Namen
    $name = $this->app->User->GetName();
    $this->app->Tpl->Set(NAME, $name);

    // Zeige Administrationsmenue an
    $type = $this->app->User->GetType();
    if($type=="webmaster" || $type=="admin")
      $this->app->Tpl->Parse(ADMINMENUE, "admin_menue.tpl"); 

    $this->app->Tpl->Parse(LOGINBOX, "loginbox_active.tpl");  
  }

  function UserIsInactive()
  {
    $submit = $this->app->Secure->GetPOST(loginbox_submit);

    if($submit != "")
    {
      $this->app->acl->Login();
      //$this->app->Tpl->Set(LOGINBOXMSG, $error);
    }

    $this->app->Tpl->Parse(LOGINBOX, "loginbox_inactive.tpl");
  }



/*
  function UserIsInactive()
  {
    $email = $this->app->Secure->GetPOST(loginbox_email);
    $password = $this->app->Secure->GetPOST(loginbox_password);
    $submit = $this->app->Secure->GetPOST(loginbox_submit);

    if($submit!="" && $email!="" && $password!="")
    {
      $hash = hash('ripemd128', $password);
      $aes = new AES($hash);
      $c_email = base64_encode($aes->encrypt($email));
      
      $cryptedPass =  $this->app->DB->Select("SELECT passwort FROM kundendaten WHERE email='$c_email'");
      $aktiv = $this->app->DB->Select("SELECT aktiv FROM kundendaten WHERE email='$c_email'");
   
      
      if($cryptedPass==md5($password))
      {
        if($aktiv=="1")
        {
	  $_SESSION['login'] = true;
          $_SESSION['userid'] = $this->app->DB->Select("SELECT id FROM kundendaten WHERE email='$c_email' AND passwort='$cryptedPass'");
          $_SESSION['password'] = hash('ripemd128', $password);

          $kasse = $this->app->Secure->GetPOST("kasse");
          if($kasse=="1")
            header("Location: ./index.php?module=bestellen&action=guest");
          else
          {
            // Wurde beim Registrieren der Abo-Assi aktiviert?
            $abo = $this->app->DB->Select("SELECT journal FROM kundendaten WHERE id='{$_SESSION['userid']}' LIMIT 1");
            if($abo=='1')
            {   
              $this->app->DB->Update("UPDATE kundendaten SET journal='0' WHERE id='{$_SESSION['userid']}'");
              header("Location: ./index.php?module=abo");
              exit;
            }
            header("Location: ./index.php?module=zeitschrift");
            break;
          }
        }else
          $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Sie m&uuml;ssen Ihr Konto zuerst aktivieren.</div>");
      }else
        $this->app->Tpl->Set(LOGINMESSAGE, "<div style=\"color:red;\">Benutzername oder Passwort ist falsch.</div>");
    }

    $this->app->Tpl->Parse(NEWSLETTER, "newsletter.tpl");
    $this->app->Tpl->Parse(LOGINBOX, "loginbox_inactive.tpl");  
  }
*/
}

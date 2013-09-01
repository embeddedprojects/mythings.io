<?php


class Acl 
{
  //var $engine;
  function Acl(&$app)
  {
    $this->app = &$app;
  }

  function CheckTimeOut()
  {
    // check if user is applied
    $sessid =  $this->app->DB->Select("SELECT sessionid FROM useronline,user WHERE
       login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");
    if(session_id() == $sessid)
    {
      // check if time is expired
      $time =  $this->app->DB->Select("SELECT UNIX_TIMESTAMP(time) FROM useronline,user WHERE
       login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

      if((time()-$time) > $this->app->Conf->WFconf[logintimeout])
      {
        //$this->app->WF->ReBuildPageFrame();
        $this->Logout("Ihre Zeit ist abgelaufen, bitte melden Sie sich erneut an.");
        return false;
      }
      else {
        // update time
         $this->app->DB->Update("UPDATE useronline,user SET useronline.time=NOW() WHERE
            login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1'");
        return true;
      }
    }

  }


  function CheckTimeOutANTON()
  {
    // check if user is applied
    $sessid =  $this->app->DB->Select("SELECT sessionid FROM useronline,user WHERE
       login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

    if(session_id() == $sessid)
    {
      // check if time is expired
      $time =  $this->app->DB->Select("SELECT UNIX_TIMESTAMP(time) FROM useronline,user WHERE
       login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

      if((time()-$time) > $this->app->Conf->WFconf[logintimeout])
      {
        //$this->app->WF->ReBuildPageFrame();
        $this->Logout("Ihre Zeit ist abgelaufen, bitte melden Sie sich erneut an.");
        return false;
      }
      else {
        // update time
         $this->app->DB->Update("UPDATE useronline,user SET useronline.time=NOW() WHERE
            login='1' AND sessionid='".session_id()."' AND user.id=useronline.user_id AND user.activ='1'");
        return true;
      }
    }
/*
    // check if user is applied 
    $sessid =  $this->app->DB->Select("SELECT sessionid 
				       FROM useronline, kundendaten 
				       WHERE login='1' 
				       AND sessionid='".session_id()."' 
				       AND kundendaten.id=useronline.user_id 
				       AND kundendaten.aktiv='1' LIMIT 1");
    
    if(session_id() == $sessid)
    { 
      // check if time is expired
      $time =  $this->app->DB->Select("SELECT UNIX_TIMESTAMP(time) 
				       FROM useronline, kundendaten 
				       WHERE login='1' 
				       AND sessionid='".session_id()."' 
				       AND kundendaten.id=useronline.user_id 
				       AND kundendaten.aktiv='1' LIMIT 1");

      if((time()-$time) > $this->app->Conf->WFconf[logintimeout])
      {
	//$this->app->WF->ReBuildPageFrame();
	$this->Logout("Ihre Zeit ist abgelaufen, bitte melden Sie sich erneut an.");
	return false;
      }
      else {
	// update time
	 $this->app->DB->Update("UPDATE useronline, kundendaten 
				 SET useronline.time=NOW() 
				 WHERE login='1' 
				 AND useronline.sessionid='".session_id()."' 
				 AND kundendaten.id=useronline.user_id 
				 AND kundendaten.aktiv='1'");
	return true; 
      }
    }
*/
  }

  function Check($usertype,$module,$action)
  {
    $ret = false;
    $permissions = $this->app->Conf->WFconf[permissions][$usertype][$module];
   
    while (list($key, $val) = @each($permissions)) 
    {
      if($val==$action)
      {
	$ret = true;
	break;
      }
    }
    
    if(!$ret)
      $this->app->Tpl->Parse(PAGE,"permissiondenied.tpl");

    return $ret;
  }

  function Login()
  {
    $username = md5($this->app->Secure->GetPOST("username"));
    $password = md5($this->app->Secure->GetPOST("password"));
    $plainpassword = $this->app->Secure->GetPOST("password");

    // empty checksum
    if($username=="d41d8cd98f00b204e9800998ecf8427e" && $password=="d41d8cd98f00b204e9800998ecf8427e"){
      $this->app->Tpl->Set(LOGINMSG,"Please enter your email and password.");
      $this->app->Tpl->Parse(PAGE,"login.tpl");
    }
    elseif($username=="d41d8cd98f00b204e9800998ecf8427e"||$password=="d41d8cd98f00b204e9800998ecf8427e"){
      $this->app->Tpl->Set(LOGINERRORMSG,"Please enter your username and password");
      $this->app->Tpl->Parse(PAGE,"login.tpl");
    }
    else {
      /* OLD
      $encrypted = $this->app->DB->Select("SELECT password FROM user
        WHERE username='".$username."' AND activ='1' LIMIT 1");

      $password = substr($password, 0, 8);

      if (crypt( $password,  $encrypted ) == $encrypted )
      {
        $user_id = $this->app->DB->Select("SELECT id FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");
      }
      else { $user_id = ""; }
      */
      $user_id = $this->app->DB->Select("SELECT id FROM user 
					 WHERE username='$username' 
					 AND password='$password' 
					 AND activ='1' LIMIT 1");   
    
      if(is_numeric($user_id))
      {
	$userid = $this->app->DB->Select("SELECT kundendaten FROM user WHERE id='$user_id' LIMIT 1");
	$_SESSION['userid'] = $userid;

        $this->app->DB->Insert("INSERT INTO useronline (user_id, sessionid, ip, login, time)
				VALUES ('".$user_id."','".session_id()."','".$_SERVER[REMOTE_ADDR]."','1',NOW())");


	// Wurde beim Registrieren der Abo-Assi aktiviert?
        $abo = $this->app->DB->Select("SELECT journal FROM kundendaten WHERE id='$userid' LIMIT 1");
        if($abo=='1')
        {
	  $this->app->DB->Update("UPDATE kundendaten SET journal='0' WHERE id='$userid'");
          header("Location: ./index.php?module=abo&action=order");
          exit;
        }


        //header("Location: ".$this->app->http."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
	header("Location: ./index.php?module=stock&action=list");
      }
      else
      {
        $this->app->Tpl->Set(LOGINERRORMSG,"Email or password are wrong!");
        $this->app->Tpl->Parse(INHALT,"login.tpl");
      }

    }
  }


  function LoginANTON()
  {
    $username = $this->app->Secure->GetPOST("username");
    $password = $this->app->Secure->GetPOST("password");
    $password = $this->app->Secure->GetPOST("password");
    if($username=="" || $password=="")
    {
      return "Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein.";
    }
    else
    {
    $username = $this->app->Secure->GetPOST("username");
    $password = $this->app->Secure->GetPOST("password");

    if($username=="" && $password==""){
      $this->app->Tpl->Set(LOGINMSG,"Bitte geben Sie Benutzername und Passwort ein.");
      $this->app->Tpl->Parse(PAGE,"login.tpl");
    }
    elseif($username==""||$password==""){
      $this->app->Tpl->Set(LOGINERRORMSG,"Bitte geben Sie einen Benutzername und ein Passwort an.");
      $this->app->Tpl->Parse(PAGE,"login.tpl");
    }
    else {
      $encrypted = $this->app->DB->Select("SELECT password FROM user
        WHERE username='".$username."' AND activ='1' LIMIT 1");

      $password = substr($password, 0, 8);


      if (crypt( $password,  $encrypted ) == $encrypted )
      {
        $user_id = $this->app->DB->Select("SELECT id FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");
      }
      else { $user_id = ""; }

      if(is_numeric($user_id))
      {
	  $userid = $this->app->DB->Select("SELECT kundendaten FROM user WHERE id='$user_id' LIMIT 1");
	  $_SESSION['userid'] = $userid;
	  $_SESSION['password'] = hash('ripemd128', $password);	    


        $this->app->DB->Insert("INSERT INTO useronline (user_id, sessionid, ip, login, time)
          VALUES ('".$user_id."','".session_id()."','".$_SERVER[REMOTE_ADDR]."','1',NOW())");

        header("Location: ".$this->app->http."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
      }
      else
      {
        $this->app->Tpl->Set(LOGINERRORMSG,"Benutzername oder Passwort falsch.");
        $this->app->Tpl->Parse(PAGE,"login.tpl");
      }

    }
    }
  
/*
      $hash = hash('ripemd128', $password);
      $aes = new AES($hash);
      $crypted_name = base64_encode($aes->encrypt($username));

      $crypted_password =  $this->app->DB->Select("SELECT passwort FROM kundendaten WHERE email='$crypted_name'");
      $active = $this->app->DB->Select("SELECT aktiv FROM kundendaten WHERE email='$crypted_name'");   

      // Stimmt das Passwort?
      if($crypted_password==md5($password))
      {
	// Ist das Konto aktiviert?
	if($active==1)
	{
	  $userid = $this->app->DB->Select("SELECT id FROM kundendaten WHERE email='$crypted_name' AND passwort='$crypted_password'");
	  
	  if(is_numeric($userid))
	  {
	    $_SESSION['userid'] = $userid;
	    $_SESSION['password'] = hash('ripemd128', $password);	    

	    $this->app->DB->Insert("INSERT INTO useronline (user_id, sessionid, ip, login, time)
				    VALUES ('$userid','".session_id()."','{$_SERVER[REMOTE_ADDR]}','1',NOW())");

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
            }

	    header("Location: ".$this->app->http."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php?module=zeitschrift");
	    break;
	  }else
	    return "Konnte Benutzer nicht finden.";
	}else
	  return "Sie m&uuml;ssen Ihr Konto zuerst aktivieren.";

      }else
	return "Der Benutzername oder das Passwort ist falsch.";
    }
*/

  }

  function Logout($msg="")
  {
    $username = $this->app->User->GetName();
    $this->app->DB->Update("UPDATE useronline SET login='0' WHERE user_id='".$this->app->User->GetID()."'");
    session_destroy();
    session_start();
    session_regenerate_id(true);
    header("Location: ".$this->app->http."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
    $this->app->Tpl->Set(LOGINMSG,$msg);  
    $this->app->Tpl->Parse(PAGE,"login.tpl");
  }


  function CreateAclDB()
  {

  }

}
?>

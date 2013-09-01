<?php

class Welcome 
{
  function Welcome(&$app)
  {
    $this->app=&$app; 
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("login","WelcomeLogin");
    $this->app->ActionHandler("main","WelcomeMain");
    $this->app->ActionHandler("list","WelcomeList");
    $this->app->ActionHandler("lang","WelcomeLang");
    $this->app->ActionHandler("logout","WelcomeLogout");
  
    $this->app->DefaultActionHandler("list");
    $this->app->ActionHandlerListen(&$app);
  }
 

  function WelcomeLang()
  {
    $lang = $this->app->Secure->GetGET("lang");
    $_SESSION['language'] = $lang;
    header("Location: ".$_SERVER['HTTP_REFERER']."?".session_id());
    exit;
  }
 
  function WelcomeNav(){
    $this->app->Tpl->Set(NAVIGATION, $this->app->erp->Navigation(0));
    //$this->app->Tpl->Parse(MESSAGEBOXLEFT, "messagebox_left.tpl");
    //$this->app->Tpl->Parse(MESSAGEBOXRIGHT,"messagebox_right.tpl");

    $this->BannerGross(); 

    $this->app->Tpl->Set(UEBERSICHT,CartTinyShow($_SESSION[articlelist]));
    $this->app->Tpl->Parse(WARENKORB, "warenkorb.tpl");




    $this->app->Tpl->Parse(FREIBOX, "kostenlos.tpl");
    $this->app->Tpl->Parse(NEUERSCHEINUNGEN, "neuerscheinungen.tpl");
    //$this->app->Tpl->Parse(INHALT, "neuigkeiten.tpl");
  }

  function WelcomeList()
  {
    //$this->WelcomeNav();
    $this->app->Tpl->Parse(PAGE, "welcome_list_de.tpl");
    //$this->app->erp->ContentShow("startseite",INHALT);
  }

  function WelcomeMain()
  {
    //$this->app->Tpl->Set(UEBERSCHRIFT,"Herzlich Willkommen ".$this->app->User->GetDescription()."!");
    //$this->app->Tpl->Set(PAGE,"Sie sind bereits angemeldet");
    //head
    //$this->WelcomeMenu();
  }

  function WelcomeLogin()
  {
//    $this->app->erp->ForceSSL();


    if($this->app->User->GetID()!="")
    {
      //$this->WelcomeMain();
      header("Location: index.php?module=stock&action=list");
      exit;
    }
    else
    {
      $this->app->Tpl->Set(HEADING,"embedded projects GmbH Verwaltung ");
      $this->app->acl->Login();
    }

    //$this->app->Tpl->Parse(INHALT, "login.tpl");
    $this->app->Tpl->Parse(PAGE, "index.tpl");
  }

  function WelcomeLogout()
  {
    $this->app->acl->Logout();
    //$this->app->WF->ReBuildPageFrame();
    //$this->WelcomeMain();
  }



}
?>

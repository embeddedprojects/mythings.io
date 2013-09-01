<?php

class Angebot 
{
  function Angebot(&$app)
  {
    $this->app=&$app; 
     
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("show","AngebotShow");
  
    $this->app->DefaultActionHandler("show");
  
    $this->app->ActionHandlerListen(&$app);
  }
 

  function AngebotShow()
  {
    //$_SESSION['language'] = $lang;
    $this->app->Tpl->Set(HEADING,"embedded projects GmbH Verwaltung ");


    $this->app->Tpl->Set(NAVIGATION, $this->app->erp->Navigation(0));
    //$this->app->Tpl->Parse(MESSAGEBOXLEFT, "messagebox_left.tpl");
    //$this->app->Tpl->Parse(MESSAGEBOXRIGHT,"messagebox_right.tpl");
    //$this->app->Tpl->Parse(FREIBOX, "auchgekauft.tpl");

    $this->app->Tpl->Set(UEBERSICHT,CartTinyShow($_SESSION[articlelist]));
    $this->app->Tpl->Parse(WARENKORB, "warenkorb.tpl");

    $this->app->Tpl->Parse(NEUERSCHEINUNGEN, "neuerscheinungen.tpl");


    $this->app->Tpl->Set(SUBHEADING,"");

    $page = $this->app->Secure->GetGET("page");

    $this->app->Tpl->Parse(INHALT,"angebot.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");

 
  }
 



}
?>

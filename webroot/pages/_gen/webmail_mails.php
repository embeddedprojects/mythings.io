<? 

class GenWebmail_mails { 

  function GenWebmail_mails(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","Webmail_mailsCreate");
    $this->app->ActionHandler("edit","Webmail_mailsEdit");
    $this->app->ActionHandler("copy","Webmail_mailsCopy");
    $this->app->ActionHandler("list","Webmail_mailsList");
    $this->app->ActionHandler("delete","Webmail_mailsDelete");

    $this->app->Tpl->Set(HEADING,"Webmail_mails");    $this->app->ActionHandlerListen(&$app);
  }

  function Webmail_mailsCreate(){
    $this->app->Tpl->Set(HEADING,"Webmail_mails (Anlegen)");
      $this->app->PageBuilder->CreateGen("webmail_mails_create.tpl");
  }

  function Webmail_mailsEdit(){
    $this->app->Tpl->Set(HEADING,"Webmail_mails (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("webmail_mails_edit.tpl");
  }

  function Webmail_mailsCopy(){
    $this->app->Tpl->Set(HEADING,"Webmail_mails (Kopieren)");
      $this->app->PageBuilder->CreateGen("webmail_mails_copy.tpl");
  }

  function Webmail_mailsDelete(){
    $this->app->Tpl->Set(HEADING,"Webmail_mails (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("webmail_mails_delete.tpl");
  }

  function Webmail_mailsList(){
    $this->app->Tpl->Set(HEADING,"Webmail_mails (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("webmail_mails_list.tpl");
  }

} 
?>

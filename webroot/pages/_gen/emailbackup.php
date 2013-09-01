<? 

class GenEmailbackup { 

  function GenEmailbackup(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","EmailbackupCreate");
    $this->app->ActionHandler("edit","EmailbackupEdit");
    $this->app->ActionHandler("copy","EmailbackupCopy");
    $this->app->ActionHandler("list","EmailbackupList");
    $this->app->ActionHandler("delete","EmailbackupDelete");

    $this->app->Tpl->Set(HEADING,"Emailbackup");    $this->app->ActionHandlerListen(&$app);
  }

  function EmailbackupCreate(){
    $this->app->Tpl->Set(HEADING,"Emailbackup (Anlegen)");
      $this->app->PageBuilder->CreateGen("emailbackup_create.tpl");
  }

  function EmailbackupEdit(){
    $this->app->Tpl->Set(HEADING,"Emailbackup (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("emailbackup_edit.tpl");
  }

  function EmailbackupCopy(){
    $this->app->Tpl->Set(HEADING,"Emailbackup (Kopieren)");
      $this->app->PageBuilder->CreateGen("emailbackup_copy.tpl");
  }

  function EmailbackupDelete(){
    $this->app->Tpl->Set(HEADING,"Emailbackup (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("emailbackup_delete.tpl");
  }

  function EmailbackupList(){
    $this->app->Tpl->Set(HEADING,"Emailbackup (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("emailbackup_list.tpl");
  }

} 
?>
<? 

class GenAuftrag { 

  function GenAuftrag(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","AuftragCreate");
    $this->app->ActionHandler("edit","AuftragEdit");
    $this->app->ActionHandler("copy","AuftragCopy");
    $this->app->ActionHandler("list","AuftragList");
    $this->app->ActionHandler("delete","AuftragDelete");

    $this->app->Tpl->Set(HEADING,"Auftrag");    $this->app->ActionHandlerListen(&$app);
  }

  function AuftragCreate(){
    $this->app->Tpl->Set(HEADING,"Auftrag (Anlegen)");
      $this->app->PageBuilder->CreateGen("auftrag_create.tpl");
  }

  function AuftragEdit(){
    $this->app->Tpl->Set(HEADING,"Auftrag (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("auftrag_edit.tpl");
  }

  function AuftragCopy(){
    $this->app->Tpl->Set(HEADING,"Auftrag (Kopieren)");
      $this->app->PageBuilder->CreateGen("auftrag_copy.tpl");
  }

  function AuftragDelete(){
    $this->app->Tpl->Set(HEADING,"Auftrag (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("auftrag_delete.tpl");
  }

  function AuftragList(){
    $this->app->Tpl->Set(HEADING,"Auftrag (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("auftrag_list.tpl");
  }

} 
?>
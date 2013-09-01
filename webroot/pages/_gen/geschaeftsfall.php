<? 

class GenGeschaeftsfall { 

  function GenGeschaeftsfall(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","GeschaeftsfallCreate");
    $this->app->ActionHandler("edit","GeschaeftsfallEdit");
    $this->app->ActionHandler("copy","GeschaeftsfallCopy");
    $this->app->ActionHandler("list","GeschaeftsfallList");
    $this->app->ActionHandler("delete","GeschaeftsfallDelete");

    $this->app->Tpl->Set(HEADING,"Geschaeftsfall");    $this->app->ActionHandlerListen(&$app);
  }

  function GeschaeftsfallCreate(){
    $this->app->Tpl->Set(HEADING,"Geschaeftsfall (Anlegen)");
      $this->app->PageBuilder->CreateGen("geschaeftsfall_create.tpl");
  }

  function GeschaeftsfallEdit(){
    $this->app->Tpl->Set(HEADING,"Geschaeftsfall (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("geschaeftsfall_edit.tpl");
  }

  function GeschaeftsfallCopy(){
    $this->app->Tpl->Set(HEADING,"Geschaeftsfall (Kopieren)");
      $this->app->PageBuilder->CreateGen("geschaeftsfall_copy.tpl");
  }

  function GeschaeftsfallDelete(){
    $this->app->Tpl->Set(HEADING,"Geschaeftsfall (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("geschaeftsfall_delete.tpl");
  }

  function GeschaeftsfallList(){
    $this->app->Tpl->Set(HEADING,"Geschaeftsfall (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("geschaeftsfall_list.tpl");
  }

} 
?>
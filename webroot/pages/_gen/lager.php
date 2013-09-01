<? 

class GenLager { 

  function GenLager(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","LagerCreate");
    $this->app->ActionHandler("edit","LagerEdit");
    $this->app->ActionHandler("copy","LagerCopy");
    $this->app->ActionHandler("list","LagerList");
    $this->app->ActionHandler("delete","LagerDelete");

    $this->app->Tpl->Set(HEADING,"Lager");    $this->app->ActionHandlerListen(&$app);
  }

  function LagerCreate(){
    $this->app->Tpl->Set(HEADING,"Lager (Anlegen)");
      $this->app->PageBuilder->CreateGen("lager_create.tpl");
  }

  function LagerEdit(){
    $this->app->Tpl->Set(HEADING,"Lager (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("lager_edit.tpl");
  }

  function LagerCopy(){
    $this->app->Tpl->Set(HEADING,"Lager (Kopieren)");
      $this->app->PageBuilder->CreateGen("lager_copy.tpl");
  }

  function LagerDelete(){
    $this->app->Tpl->Set(HEADING,"Lager (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("lager_delete.tpl");
  }

  function LagerList(){
    $this->app->Tpl->Set(HEADING,"Lager (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("lager_list.tpl");
  }

} 
?>
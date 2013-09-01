<? 

class GenArtikel { 

  function GenArtikel(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ArtikelCreate");
    $this->app->ActionHandler("edit","ArtikelEdit");
    $this->app->ActionHandler("copy","ArtikelCopy");
    $this->app->ActionHandler("list","ArtikelList");
    $this->app->ActionHandler("delete","ArtikelDelete");

    $this->app->Tpl->Set(HEADING,"Artikel");    $this->app->ActionHandlerListen(&$app);
  }

  function ArtikelCreate(){
    $this->app->Tpl->Set(HEADING,"Artikel (Anlegen)");
      $this->app->PageBuilder->CreateGen("artikel_create.tpl");
  }

  function ArtikelEdit(){
    $this->app->Tpl->Set(HEADING,"Artikel (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("artikel_edit.tpl");
  }

  function ArtikelCopy(){
    $this->app->Tpl->Set(HEADING,"Artikel (Kopieren)");
      $this->app->PageBuilder->CreateGen("artikel_copy.tpl");
  }

  function ArtikelDelete(){
    $this->app->Tpl->Set(HEADING,"Artikel (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("artikel_delete.tpl");
  }

  function ArtikelList(){
    $this->app->Tpl->Set(HEADING,"Artikel (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("artikel_list.tpl");
  }

} 
?>

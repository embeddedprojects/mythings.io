<? 

class GenAufgabe { 

  function GenAufgabe(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","AufgabeCreate");
    $this->app->ActionHandler("edit","AufgabeEdit");
    $this->app->ActionHandler("copy","AufgabeCopy");
    $this->app->ActionHandler("list","AufgabeList");
    $this->app->ActionHandler("delete","AufgabeDelete");

    $this->app->Tpl->Set(HEADING,"Aufgabe");    $this->app->ActionHandlerListen(&$app);
  }

  function AufgabeCreate(){
    $this->app->Tpl->Set(HEADING,"Aufgabe (Anlegen)");
      $this->app->PageBuilder->CreateGen("aufgabe_create.tpl");
  }

  function AufgabeEdit(){
    $this->app->Tpl->Set(HEADING,"Aufgabe (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("aufgabe_edit.tpl");
  }

  function AufgabeCopy(){
    $this->app->Tpl->Set(HEADING,"Aufgabe (Kopieren)");
      $this->app->PageBuilder->CreateGen("aufgabe_copy.tpl");
  }

  function AufgabeDelete(){
    $this->app->Tpl->Set(HEADING,"Aufgabe (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("aufgabe_delete.tpl");
  }

  function AufgabeList(){
    $this->app->Tpl->Set(HEADING,"Aufgabe (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("aufgabe_list.tpl");
  }

} 
?>
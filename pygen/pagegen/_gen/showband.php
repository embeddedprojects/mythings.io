<? 

class Showband { 

  function Showband(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ShowbandCreate");
    $this->app->ActionHandler("edit","ShowbandEdit");
    $this->app->ActionHandler("list","ShowbandList");
    $this->app->ActionHandler("delete","ShowbandDelete");

    $this->app->ActionHandlerListen(&app);
  }

  function ShowbandCreate(){
    $this->app->PageBuilder->Create("showband_create.tpl");
  }

  function ShowbandEdit(){
    $this->app->PageBuilder->Create("showband_edit.tpl");
  }

  function ShowbandDelete(){
    $this->app->PageBuilder->Create("showband_delete.tpl");
  }

  function ShowbandList(){
    $this->app->PageBuilder->Create("showband_list.tpl");
  }

} 
?>
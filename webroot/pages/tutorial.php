<?php

class Tutorial 
{
  function Tutorial(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","TutorialList");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function TutorialList()
  {
    $this->app->Tpl->Parse(PAGE,"tutorial_list.tpl");
  }


}

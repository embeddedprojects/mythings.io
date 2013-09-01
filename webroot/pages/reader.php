<?php

class Reader 
{
  function Reader(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ReaderList");
    $this->app->ActionHandler("screenshot","ReaderScreenshot");
    $this->app->ActionHandler("imprint","ReaderImprint");
    $this->app->ActionHandler("aboutus","ReaderAboutus");
    $this->app->ActionHandler("add","ReaderAdd");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function ReaderList()
  {
    $this->app->Tpl->Parse(PAGE,"reader_list_en.tpl");
  }


  function ReaderScreenshot()
  {
    $this->app->Tpl->Parse(PAGE,"reader_screenshot.tpl");
  }


  function ReaderAboutus()
  {
    $this->app->Tpl->Parse(PAGE,"reader_aboutus.tpl");
  }


  function ReaderImprint()
  {
    $this->app->Tpl->Parse(PAGE,"reader_imprint.tpl");
  }


}

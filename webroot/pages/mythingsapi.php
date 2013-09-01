<?php

class Mythingsapi 
{
  function Mythingsapi(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","MythingsapiList");
    $this->app->ActionHandler("add","MythingsapiAdd");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function MythingsapiList()
  {
  }

  function MythingsapiAdd()
  {
    //$barcode = "1234";
    $barcode = $this->app->Secure->GetGET("barcode");
    $image = $this->app->Secure->GetPOST("image");
    $auth = $this->app->Secure->GetGET("auth");

    $request = "https://www.googleapis.com/shopping/search/v1/public/products?key=AIzaSyAzFtYjp8Ax20hwbK9-g4d0UtqueLo0nAY&country=DE&q=$barcode&alt=json";

    ob_start();
    passthru("curl \"$request\"");
    $content_grabbed=ob_get_contents();
    ob_end_clean();


    $result = json_decode($content_grabbed);
    $description = $result->{'items'}[0]->{'product'}->{'title'};

    $userid = $this->app->DB->Select("SELECT id FROM user WHERE device='$auth' LIMIT 1");
    $description_share = $this->app->DB->Select("SELECT description FROM scans WHERE share='1' AND barcode='$barcode' LIMIT 1");

    if($description=="") $description = $description_share;

    $this->app->DB->Insert("INSERT INTO scans (id,barcode,description,date,direction,image,userid) VALUES ('','$barcode','$description',NOW(),'1','$image','$userid')");
    echo "done";
    exit;
  }

}

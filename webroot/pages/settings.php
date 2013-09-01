<?php

class Settings 
{
  function Settings(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","SettingsList");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function SettingsList()
  {
    $language = $this->app->Secure->GetPOST("language");

    if($device!="" || $language!="")
    {
	$this->app->DB->Update("UPDATE user SET language='$language' WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    }


    $device = $this->app->DB->Select("SELECT device FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    $language = $this->app->DB->Select("SELECT language FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    if($language=="") $language="en";

    $result = $this->app->erp->Languages();

    foreach($result as $key=>$value)
    {
	if($language==$key)
		$this->app->Tpl->Add(LANGUAGE,"<option value=\"$key\" selected>$value</option>");	
	else
		$this->app->Tpl->Add(LANGUAGE,"<option value=\"$key\">$value</option>");	
    }

    $this->app->Tpl->Set(DEVICE,$device);
    

    $this->app->Tpl->Parse(PAGE,"settings_list_en.tpl");
  }


}

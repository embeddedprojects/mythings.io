<?php

class Lists 
{
  function Lists(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ListsList");
    $this->app->ActionHandler("create","ListsCreate");
    $this->app->ActionHandler("delete","ListsDelete");
    $this->app->ActionHandler("edit","ListsEdit");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function ListsList()
  {
    $this->app->Tpl->Parse(MENUBAR,"menubar.tpl");

    $table = new EasyTable($this->app);
    $table->Query("SELECT name,description,id FROM lists WHERE userid='".$this->app->User->GetID()."' ORDER by name");
    $table->Display(TABLELISTS);

    $this->app->Tpl->Set(NUMBEROFLISTS,$this->app->DB->Select("SELECT COUNT(id) FROM lists WHERE userid='".$this->app->User->GetID()."'"));
    $this->app->erp->ParseBack();
    $this->app->Tpl->Parse(PAGE,"lists_list.tpl");
  }

  function ListsCreate()
  {
	$name = $this->app->Secure->GetPOST("name");
        $description = $this->app->Secure->GetPOST("description");
        if($name!="") {
               $this->app->DB->Insert("INSERT INTO lists (id,name,description,userid) VALUES ('','$name','$description','".$this->app->User->GetID()."')");
               //header("Location: index.php?module=stock&action=list");
               header("Location: ".$_SESSION['back']);
               exit;
        }
    $this->app->erp->ParseBack();
    $this->app->Tpl->Parse(PAGE,"lists_create.tpl");
  }


  function ListsEdit()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set(NAMEOLD,$this->app->DB->Select("SELECT name FROM lists WHERE id='$id' AND  userid='".$this->app->User->GetID()."' LIMIT 1"));

    $name = $this->app->Secure->GetPOST("name");
    $description = $this->app->Secure->GetPOST("description");

    if($name!="")
    {
      $this->app->DB->Update("UPDATE lists SET name='$name', description='$description' WHERE id='$id' AND userid='".$this->app->User->GetID()."'");
      header("Location: index.php?module=lists&action=list");
      //header("Location: ".$_SESSION['back']);
      exit;
    } else {
    	$this->app->Tpl->Set(NAME,$this->app->DB->Select("SELECT name FROM lists WHERE id='$id' AND  userid='".$this->app->User->GetID()."' LIMIT 1"));
    	$this->app->Tpl->Set(DESCRIPTION,$this->app->DB->Select("SELECT description FROM lists WHERE id='$id' AND  userid='".$this->app->User->GetID()."' LIMIT 1"));
    }

    $this->app->erp->ParseBack();
    $this->app->Tpl->Parse(PAGE,"lists_edit.tpl");
  }

  function ListsDelete()
  {
    $id = $this->app->Secure->GetGET("id");
  
    $submit = $this->app->Secure->GetPOST("submit");

    if($submit!="") {
       header("Location: index.php?module=stock&action=list");
       exit;
    }

    $this->app->Tpl->Parse(PAGE,"lists_delete.tpl"); 
  }

}

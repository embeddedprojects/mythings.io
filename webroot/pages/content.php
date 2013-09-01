<?php
class Content 
{
  function Content(&$app)
  {
    $this->app=&$app; 
     
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("show","ContentShow");
    $this->app->ActionHandler("edit","ContentEdit");
  
    $this->app->DefaultActionHandler("show");
  
    $this->app->ActionHandlerListen(&$app);
  }
 

  function ContentShow()
  {
    $page = $this->app->Secure->GetGET("page");

  
    $lang = $_SESSION['language'];

    if($lang!="de" || $lang!="en") $lang="de";

    $html = $this->app->DB->Select("SELECT html FROM inhalt WHERE sprache='{$lang}' AND inhalt='$page' LIMIT 1");
    $this->app->Tpl->Set(CONTENT,html_entity_decode($html));
    
    $type = $this->app->User->GetType();
    if($html!="" && ($type=="webmaster" || $type=="admin"))  
    $this->app->Tpl->Set(MESSAGE, "<div class=\"info\">Wollen Sie diese Seite editieren?&nbsp;&nbsp;<input type=\"button\" name=\"editPage\"  
				   value=\"Seite editieren\" 
                                   onclick=\"if(!confirm('Wollen Sie diese Seite wirklich editieren??')) return false; 
                                   else window.location.href='./index.php?module=content&action=edit&page=$page';\"/></div>");
      
    

    $this->app->Tpl->Parse(INHALT, 'content.tpl');
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ContentEdit()
  {
    $page = $this->app->Secure->GetGET("page");
    $inhalt = $this->app->Secure->POST["inhalt"];
    $submit = $this->app->Secure->GetPOST("saveinhalt");
    $cancel = $this->app->Secure->GetPOST("cancel");

    if($page!="")
    {
      $lang = $_SESSION['language'];
      if($lang!="de" || $lang!="en") $lang="de";
      
      // Speichern
      if($submit!="")
      {
	$this->app->DB->Update("UPDATE inhalt 
				SET html='".htmlentities($inhalt)."'
				WHERE sprache='$lang'
				AND inhalt='$page'");
	header("Location: ./index.php?module=content&action=show&page=$page");
	exit;
      }
     
      // Abbrechen
      if($cancel!="")
      {
	header("Location: ./index.php?module=content&action=show&page=$page");
        exit;
      }

      // Textfield fuellen
      $html = $this->app->DB->Select("SELECT html FROM inhalt WHERE sprache='{$lang}' AND inhalt='$page' LIMIT 1");
      $this->app->Tpl->Set(INHALTSTEXT,html_entity_decode($html));

    }

    $this->app->Tpl->Parse(INHALT,"content_edit.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");

  }
 



}
?>

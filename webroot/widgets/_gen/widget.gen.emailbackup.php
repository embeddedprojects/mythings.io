<?php 

class WidgetGenemailbackup
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenemailbackup($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function emailbackupDelete()
  {
    
    $this->form->Execute("emailbackup","delete");

    $this->emailbackupList();
  }

  function Edit()
  {
    $this->form->Edit();
  }

  function Copy()
  {
    $this->form->Copy();
  }

  public function Create()
  {
    $this->form->Create();
  }

  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"SUUUCHEEE");
  }

  public function Summary()
  {
    $this->app->Tpl->Set($this->parsetarget,"grosse Tabelle");
  }

  function Form()
  {
    $this->form = $this->app->FormHandler->CreateNew("emailbackup");
    $this->form->UseTable("emailbackup");
    $this->form->UseTemplate("emailbackup.tpl",$this->parsetarget);

    $field = new HTMLInput("benutzername","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("passwort","password","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("server","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("loeschtage","text","","50");
    $this->form->NewField($field);



  }

}

?>
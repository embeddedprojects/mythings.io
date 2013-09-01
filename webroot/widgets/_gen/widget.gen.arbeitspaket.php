<?php 

class WidgetGenarbeitspaket
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenarbeitspaket($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function arbeitspaketDelete()
  {
    
    $this->form->Execute("arbeitspaket","delete");

    $this->arbeitspaketList();
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
    $this->form = $this->app->FormHandler->CreateNew("arbeitspaket");
    $this->form->UseTable("arbeitspaket");
    $this->form->UseTemplate("arbeitspaket.tpl",$this->parsetarget);

    $field = new HTMLInput("id","hidden","");
    $this->form->NewField($field);

    $field = new HTMLInput("aufgabe","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("zeit_geplant","text","","5");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("kostenstelle","text","");
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",10,50);   
    $this->form->NewField($field);



  }

}

?>
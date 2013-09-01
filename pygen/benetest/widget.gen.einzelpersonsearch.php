<?php 

class WidgetGenEinzelpersonsearch
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenEinzelpersonsearch($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function Delete()
  {
    $this->form->Delete();
  }

  public function Edit()
  {
    $this->form->Edit();
  }

  public function Create()
  {
    $this->form->Create();
  }

  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"SUUUCHEEE");
  }

  public function Table()
  {
    $this->app->Tpl->Set($this->parsetarget,"grosse Tabelle");
  }

  function Form()
  {
    $this->form = $this->app->FormHandler->CreateNew("einzelpersonsearch");
    $this->form->UseTable("einzelpersonsearch");
    $this->form->UseTemplate("einzelpersonsearch.tpl",$this->parsetarget);

    $field = new HTMLInput("input1","text","",0);
    $this->form->NewField($field);

    $field = new HTMLSelect("select2",0);
    $field->AddOption('Rock','rock');
    $this->form->NewField($field);

    $field = new HTMLInput("input3","text","",0);
    $this->form->NewField($field);


  }

}

?>
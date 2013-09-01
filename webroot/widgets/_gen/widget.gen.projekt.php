<?php 

class WidgetGenprojekt
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenprojekt($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function projektDelete()
  {
    
    $this->form->Execute("projekt","delete");

    $this->projektList();
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
    $this->form = $this->app->FormHandler->CreateNew("projekt");
    $this->form->UseTable("projekt");
    $this->form->UseTemplate("projekt.tpl",$this->parsetarget);

    $field = new HTMLInput("name","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("abkuerzung","text","","40");
    $this->form->NewField($field);


    $field = new HTMLSelect("verantwortlicher",0);
    $field->AddOption('Claudia Sauter','Claudia Sauter');
    $field->AddOption('Ines Krueger','Ines Krueger');
    $field->AddOption('Benedikt Sauter','Benedikt Sauter');
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",5,50);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("sonstiges",5,50);   
    $this->form->NewField($field);

    $field = new HTMLCheckbox("aktiv","","","1");
    $this->form->NewField($field);



  }

}

?>
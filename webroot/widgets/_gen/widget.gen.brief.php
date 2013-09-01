<?php 

class WidgetGenbrief
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenbrief($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function briefDelete()
  {
    
    $this->form->Execute("brief","delete");

    $this->briefList();
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
    $this->form = $this->app->FormHandler->CreateNew("brief");
    $this->form->UseTable("brief");
    $this->form->UseTemplate("brief.tpl",$this->parsetarget);

    $field = new HTMLInput("adresse","text","","20");
    $this->form->NewField($field);
    $this->form->AddMandatory("adresse","notempty","Pflichtfeld!",MSGADRESSE);

    $field = new HTMLInput("datum","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("betreff","text","","20");
    $this->form->NewField($field);
    $this->form->AddMandatory("betreff","notempty","Pflichtfeld!",MSGBETREFF);

    $field = new HTMLTextarea("nachricht",20,50);   
    $this->form->NewField($field);
    $this->form->AddMandatory("nachricht","notempty","Pflichtfeld!",MSGNACHRICHT);



  }

}

?>
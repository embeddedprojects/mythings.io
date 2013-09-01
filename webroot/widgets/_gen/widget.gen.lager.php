<?php 

class WidgetGenlager
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenlager($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function lagerDelete()
  {
    
    $this->form->Execute("lager","delete");

    $this->lagerList();
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
    $this->form = $this->app->FormHandler->CreateNew("lager");
    $this->form->UseTable("lager");
    $this->form->UseTemplate("lager.tpl",$this->parsetarget);

    $field = new HTMLInput("bezeichnung","text","","40");
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",5,50);   
    $this->form->NewField($field);



  }

}

?>
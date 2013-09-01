<?php 

class WidgetGenlager_platz
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenlager_platz($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function lager_platzDelete()
  {
    
    $this->form->Execute("lager_platz","delete");

    $this->lager_platzList();
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
    $this->form = $this->app->FormHandler->CreateNew("lager_platz");
    $this->form->UseTable("lager_platz");
    $this->form->UseTemplate("lager_platz.tpl",$this->parsetarget);

    $field = new HTMLInput("kurzbezeichnung","text","","40");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","10");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,40);   
    $this->form->NewField($field);



  }

}

?>
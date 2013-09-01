<?php 

class WidgetGenverkaufspreise
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenverkaufspreise($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function verkaufspreiseDelete()
  {
    
    $this->form->Execute("verkaufspreise","delete");

    $this->verkaufspreiseList();
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
    $this->form = $this->app->FormHandler->CreateNew("verkaufspreise");
    $this->form->UseTable("verkaufspreise");
    $this->form->UseTemplate("verkaufspreise.tpl",$this->parsetarget);

    $field = new HTMLSelect("bezeichnung",0);
    $field->AddOption('Standardpreis','standard');
    $field->AddOption('Kundenpreis','kundenpreis');
    $field->AddOption('Projektpreis','projekt');
    $this->form->NewField($field);

    $field = new HTMLInput("adresse","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("ab_menge","text","","10");
    $this->form->NewField($field);
    $this->form->AddMandatory("ab_menge","notempty","Pflichtfeld!",MSGAB_MENGE);

    $field = new HTMLInput("preis","text","","10");
    $this->form->NewField($field);
    $this->form->AddMandatory("preis","notempty","Pflichfeld!",MSGPREIS);

    $field = new HTMLInput("gueltig_bis","text","","10");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,40);   
    $this->form->NewField($field);



  }

}

?>
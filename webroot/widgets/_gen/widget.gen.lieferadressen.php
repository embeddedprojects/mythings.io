<?php 

class WidgetGenlieferadressen
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenlieferadressen($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function lieferadressenDelete()
  {
    
    $this->form->Execute("lieferadressen","delete");

    $this->lieferadressenList();
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
    $this->form = $this->app->FormHandler->CreateNew("lieferadressen");
    $this->form->UseTable("lieferadressen");
    $this->form->UseTemplate("lieferadressen.tpl",$this->parsetarget);

    $field = new HTMLSelect("typ",0);
    $field->AddOption('Person','person');
    $field->AddOption('Firma','firma');
    $this->form->NewField($field);

    $field = new HTMLInput("name","text","","20");
    $this->form->NewField($field);
    $this->form->AddMandatory("name","notempty","Pflichtfeld!",MSGNAME);

    $field = new HTMLInput("vorname","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("abteilung","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("unterabteilung","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("strasse","text","","20");
    $this->form->NewField($field);
    $this->form->AddMandatory("strasse","notempty","Pflichtfeld!",MSGSTRASSE);

    $field = new HTMLInput("adresszusatz","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("plz","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("ort","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("land","hidden","");
    $this->form->NewField($field);

    $field = new HTMLInput("telefon","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("telefax","text","","20");
    $this->form->NewField($field);



  }

}

?>
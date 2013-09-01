<?php 

class WidgetGenaufgabe
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenaufgabe($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function aufgabeDelete()
  {
    
    $this->form->Execute("aufgabe","delete");

    $this->aufgabeList();
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
    $this->form = $this->app->FormHandler->CreateNew("aufgabe");
    $this->form->UseTable("aufgabe");
    $this->form->UseTemplate("aufgabe.tpl",$this->parsetarget);

    $field = new HTMLInput("aufgabe","text","","50");
    $this->form->NewField($field);
    $this->form->AddMandatory("aufgabe","notempty","Pflichtfeld!",MSGAUFGABE);

    $field = new HTMLInput("adresse","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","10");
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",5,50);   
    $this->form->NewField($field);

    $field = new HTMLSelect("prio",0);
    $field->AddOption('Normal','3');
    $field->AddOption('Sehr hoch','1');
    $field->AddOption('Hoch','2');
    $field->AddOption('Niedrig','4');
    $field->AddOption('Sehr Niedrig','5');
    $this->form->NewField($field);

    $field = new HTMLInput("startdatum","text","","7");
    $this->form->NewField($field);

    $field = new HTMLInput("startzeit","text","","3");
    $this->form->NewField($field);

    $field = new HTMLInput("intervall_tage","text","","15");
    $this->form->NewField($field);

    $field = new HTMLInput("stunden","text","","17");
    $this->form->NewField($field);

    $field = new HTMLInput("abgabe_bis","text","","15");
    $this->form->NewField($field);

    $field = new HTMLSelect("abgeschlossen",0);
    $field->AddOption('Offen','0');
    $field->AddOption('Abgeschlossen','1');
    $this->form->NewField($field);

    $field = new HTMLTextarea("sonstiges",5,50);   
    $this->form->NewField($field);



  }

}

?>
<?php 

class WidgetGenauftrag
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenauftrag($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function auftragDelete()
  {
    
    $this->form->Execute("auftrag","delete");

    $this->auftragList();
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
    $this->form = $this->app->FormHandler->CreateNew("auftrag");
    $this->form->UseTable("auftrag");
    $this->form->UseTemplate("auftrag.tpl",$this->parsetarget);

    $field = new HTMLCheckbox("autoversand","","","1");
    $this->form->NewField($field);

    $field = new HTMLInput("datum","text","","10");
    $this->form->NewField($field);
    $this->form->AddMandatory("datum","datum","Falsches Datumsformat!",MSGDATUM);

    $field = new HTMLCheckbox("abweichendelieferadresse","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("keinporto","","","1");
    $this->form->NewField($field);

    $field = new HTMLSelect("versandart",0);
    $field->AddOption('Versandunternehmen','versandunternehmen');
    $field->AddOption('Selbstabholer','selbstabholer');
    $field->AddOption('Packstation','packstation');
    $field->AddOption('Kein Versand','keinversand');
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","hidden","");
    $this->form->NewField($field);
    $this->form->AddMandatory("projekt","notempty","Bitte w&auml;hlen!",MSGPROJEKT);

    $field = new HTMLSelect("zahlungsweise",0);
    $field->AddOption('Vorkasse','vorkasse');
    $field->AddOption('Rechnung','rechnung');
    $field->AddOption('Bar','bar');
    $field->AddOption('Nachnahme','nachnahme');
    $field->AddOption('Paypal','paypal');
    $field->AddOption('Kreditkarte','kreditkarte');
    $field->AddOption('Scheck','scheck');
    $this->form->NewField($field);

    $field = new HTMLInput("kostenstelle","text","","6");
    $this->form->NewField($field);

    $field = new HTMLInput("kundeadressid","text","","20");
    $this->form->NewField($field);

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

    $field = new HTMLInput("ustid","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("email","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("telefon","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("telefax","text","","20");
    $this->form->NewField($field);



  }

}

?>
<?php 

class WidgetGeneinkaufspreise
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGeneinkaufspreise($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function einkaufspreiseDelete()
  {
    
    $this->form->Execute("einkaufspreise","delete");

    $this->einkaufspreiseList();
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
    $this->form = $this->app->FormHandler->CreateNew("einkaufspreise");
    $this->form->UseTable("einkaufspreise");
    $this->form->UseTemplate("einkaufspreise.tpl",$this->parsetarget);

    $field = new HTMLInput("adresse","text","");
    $this->form->NewField($field);
    $this->form->AddMandatory("adresse","notempty","Pflichtfeld!",MSGADRESSE);

    $field = new HTMLInput("bestellnummer","text","","20");
    $this->form->NewField($field);

    $field = new HTMLInput("bezeichnunglieferant","text","","20");
    $this->form->NewField($field);

    $field = new HTMLSelect("objekt",0);
    $field->AddOption('Standard Bestellung','Standard');
    $field->AddOption('Spezial Projektpreis','Spezial Projektpreis');
    $field->AddOption('Rahmenvetrag','Rahmenvertrag');
    $field->AddOption('Abrufbestellung','Abrufbestellung');
    $this->form->NewField($field);

    $field = new HTMLInput("parameter","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("ab_menge","text","","10");
    $this->form->NewField($field);
    $this->form->AddMandatory("ab_menge","notempty","Pflichfeld!",MSGAB_MENGE);

    $field = new HTMLSelect("vpe",0);
    $field->AddOption('Einzeln','einzeln');
    $field->AddOption('Tray','tray');
    $field->AddOption('Rolle','rolle');
    $field->AddOption('St&uuml;ckgut','st&uuml;ckgut');
    $field->AddOption('Stange','stange');
    $field->AddOption('Palette','palette');
    $this->form->NewField($field);

    $field = new HTMLInput("preis","text","","10");
    $this->form->NewField($field);
    $this->form->AddMandatory("preis","notempty","Pflichfeld!",MSGPREIS);

    $field = new HTMLSelect("waehrung",0);
    $field->AddOption('EUR','EUR');
    $field->AddOption('USD','USD');
    $field->AddOption('CAD','CAD');
    $this->form->NewField($field);

    $field = new HTMLInput("preis_anfrage_vom","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("gueltig_bis","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("lager_lieferant","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("datum_lagerlieferant","text","","10");
    $this->form->NewField($field);

    $field = new HTMLInput("sicherheitslager","text","","10");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,40);   
    $this->form->NewField($field);



  }

}

?>
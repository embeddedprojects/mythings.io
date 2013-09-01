<?php 

class WidgetGenartikel
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenartikel($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function artikelDelete()
  {
    
    $this->form->Execute("artikel","delete");

    $this->artikelList();
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
    $this->form = $this->app->FormHandler->CreateNew("artikel");
    $this->form->UseTable("artikel");
    $this->form->UseTemplate("artikel.tpl",$this->parsetarget);

    $field = new HTMLInput("name_de","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("nummer","text","","40");
    $this->form->NewField($field);

    $field = new HTMLSelect("typ",0);
    $field->AddOption('Produkt','produkt');
    $field->AddOption('Material','material');
    $field->AddOption('Dienstleistung','dienstleistung');
    $field->AddOption('Geb&uuml;hr','gebuehr');
    $this->form->NewField($field);

    $field = new HTMLInput("lieferant","text","","40");
    $this->form->NewField($field);

    $field = new HTMLSelect("warengruppe",0);
    $this->form->NewField($field);

    $field = new HTMLInput("herstellerlink","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("rohsnummer","text","","50");
    $this->form->NewField($field);

    $field = new HTMLInput("name_en","text","","50");
    $this->form->NewField($field);

    $field = new HTMLTextarea("kurztext_de",2,50);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("kurztext_en",2,50);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung_de",5,50);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung_en",5,50);   
    $this->form->NewField($field);



    $field = new HTMLInput("standardlager","text","","30");
    $this->form->NewField($field);


    $field = new HTMLSelect("lieferzeit",0);
    $field->AddOption('1 Woche','7');
    $field->AddOption('2 Wochen','14');
    $field->AddOption('3 Wochen','21');
    $field->AddOption('4 Wochen','28');
    $field->AddOption('6 Wochen','42');
    $field->AddOption('12 Wochen','84');
    $field->AddOption('unbekannt','unbekannt');
    $this->form->NewField($field);

    $field = new HTMLSelect("umsatzsteuer",0);
    $field->AddOption('normal','normal');
    $field->AddOption('erm&auml;&szlig;igt','ermaessigt');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("aktiv","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("shopartikel","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("unishopartikel","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("stueckliste","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("endmontage","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("funktionstest","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("artikelcheckliste","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("lagerartikel","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("chargenverwaltung","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("provisionsartikel","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("provisionsartikel","","","1");
    $this->form->NewField($field);

    $field = new HTMLTextarea("sonstiges",5,50);   
    $this->form->NewField($field);



    $field = new HTMLSelect("seriennummern",0);
    $field->AddOption('Keine Seriennummern','keine');
    $field->AddOption('Eigene Seriennummern erzeugen','eigene');
    $field->AddOption('Produktspezifische Seriennummern nutzen','vomprodukt');
    $this->form->NewField($field);

    $field = new HTMLInput("gewicht","text","","30");
    $this->form->NewField($field);


    $field = new HTMLCheckbox("teilbar","","","1");
    $this->form->NewField($field);

    $field = new HTMLInput("nteile","text","","30");
    $this->form->NewField($field);




    $field = new HTMLInput("gueltigbis","text","","10");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("gesperrt","","","1");
    $this->form->NewField($field);

    $field = new HTMLInput("sperrgrund","text","","40");
    $this->form->NewField($field);



  }

}

?>
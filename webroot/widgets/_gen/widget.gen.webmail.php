<?php 

class WidgetGenwebmail
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenwebmail($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function webmailDelete()
  {
    
    $this->form->Execute("webmail","delete");

    $this->webmailList();
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
    $this->form = $this->app->FormHandler->CreateNew("webmail");
    $this->form->UseTable("webmail");
    $this->form->UseTemplate("webmail.tpl",$this->parsetarget);

    $field = new HTMLInput("adresse","text","");
    $this->form->NewField($field);
    $this->form->AddMandatory("adresse","notempty","Pflichtfeld!",MSGADRESSE);

    $field = new HTMLSelect("status",0);
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("datum","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferdatum","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("freitext","text","");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("bestellbestaetigung","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("freigabe","","","1");
    $this->form->NewField($field);

    $field = new HTMLInput("betreff","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("kundennummer","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferantennummer","text","");
    $this->form->NewField($field);

    $field = new HTMLSelect("versandart",0);
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweise",0);
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltage","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltageskonto","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszielskonto","text","");
    $this->form->NewField($field);



  }

}

?>
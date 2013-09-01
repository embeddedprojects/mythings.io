<?php 

class WidgetGenwebmail_mails
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenwebmail_mails($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function webmail_mailsDelete()
  {
    
    $this->form->Execute("webmail_mails","delete");

    $this->webmail_mailsList();
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
    $this->form = $this->app->FormHandler->CreateNew("webmail_mails");
    $this->form->UseTable("webmail_mails");
    $this->form->UseTemplate("webmail_mails.tpl",$this->parsetarget);

    $field = new HTMLInput("adresse","text","");
    $this->form->NewField($field);
    $this->form->AddMandatory("adresse","notempty","Pflichtfeld!",MSGADRESSE);

    $field = new HTMLSelect("status",0);
    $this->form->NewField($field);

    $field = new HTMLInput("datum","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("subject","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("freitext","text","");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("bestellbestaetigung","","","1");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("freigabe","","","1");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","10");
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
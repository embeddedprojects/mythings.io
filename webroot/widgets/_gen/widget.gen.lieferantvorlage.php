<?php 

class WidgetGenlieferantvorlage
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenlieferantvorlage($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function lieferantvorlageDelete()
  {
    
    $this->form->Execute("lieferantvorlage","delete");

    $this->lieferantvorlageList();
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
    $this->form = $this->app->FormHandler->CreateNew("lieferantvorlage");
    $this->form->UseTable("lieferantvorlage");
    $this->form->UseTemplate("lieferantvorlage.tpl",$this->parsetarget);

    $field = new HTMLInput("kundennummer","text","");
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweise",0);
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltage","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltageskonto","text","");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszielskonto","text","");
    $this->form->NewField($field);

    $field = new HTMLSelect("versandart",0);
    $this->form->NewField($field);



  }

}

?>
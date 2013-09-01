<?php 

class WidgetGenticket
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenticket($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function ticketDelete()
  {
    
    $this->form->Execute("ticket","delete");

    $this->ticketList();
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
    $this->form = $this->app->FormHandler->CreateNew("ticket");
    $this->form->UseTable("ticket");
    $this->form->UseTemplate("ticket.tpl",$this->parsetarget);

    $field = new HTMLInput("test","hidden","");
    $this->form->NewField($field);





  }

}

?>
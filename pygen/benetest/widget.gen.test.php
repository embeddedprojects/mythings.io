<?php 

class WidgetGentest
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGentest($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function testDelete()
  {
    
    $this->app->FormHandler->Execute("test","delete");

    $this->testList();
  }

  function testList()
  {
    $this->??????????;
    $this->?????????;
  }

  function Edit()
  {
    $this->form->Edit();
  }

  public function Create()
  {
    $this->form->Create();
  }

  function form()
  {
    $this->form = $this->app->FormHandler->CreateNew("test");
    $this->form->UseTable("test");
    $this->form->UseTemplate("test.tpl",$this->parsetarget);

    $field = new HTMLInput("INPUT1","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT2","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT3","","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT4","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT5","text","",5);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT6","text","",11);
    $this->app->FormHandler->NewField("test",$field);

    $select = new HTMLSelect("SELECT7",0);
    $select->AddOptions("deutschland");
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT8","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT9","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT10","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT11","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT12","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT13","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT14","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT15","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT16","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT17","button","neuer ansprechpartner",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT18","text","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLTextarea("TEXTAREA19",46,5);   
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT20","button","",0);
    $this->app->FormHandler->NewField("test",$field);

    $field = new HTMLInput("INPUT21","button","abbrechen",0);
    $this->app->FormHandler->NewField("test",$field);

  }

}

?>
<?
include ("_gen/widget.gen.lager.php");

class WidgetLager extends WidgetGenLager
{
  private $app;
  function WidgetLager($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenLager($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
  }

  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT bezeichnung, id FROM lager");
    $table->Display($this->parsetarget);
  }



  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }


}
?>

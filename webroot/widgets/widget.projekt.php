<?
include ("_gen/widget.gen.projekt.php");

class WidgetProjekt extends WidgetGenProjekt 
{
  private $app;
  function WidgetProjekt($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenProjekt($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

  }

  function DatumErsetzen($wert)
  {
    return "neuerwerert";
  }

  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT name, abkuerzung, verantwortlicher,
      id FROM projekt order by name");
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

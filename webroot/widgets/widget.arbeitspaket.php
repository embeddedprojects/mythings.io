<?
include ("_gen/widget.gen.arbeitspaket.php");

class WidgetArbeitspaket extends WidgetGenArbeitspaket 
{
  private $app;
  function WidgetArbeitspaket($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenArbeitspaket($app,$parsetarget);
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
    $table->Query("SELECT typ,name, vorname, ort, telefon, email,
      id FROM arbeitspaket order by name");
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

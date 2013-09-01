<?
include ("_gen/widget.gen.ticket.php");

class WidgetTicket extends WidgetGenTicket 
{
  private $app;
  function WidgetTicket($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenTicket($app,$parsetarget);
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
    $table->Query("SELECT zeit, schluessel, kunde, betreff,
      id FROM ticket order by zeit");
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

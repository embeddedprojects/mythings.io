<?
include ("_gen/widget.gen.stueckliste.php");

class WidgetStueckliste extends WidgetGenStueckliste 
{
  private $app;
  function WidgetStueckliste($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenStueckliste($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $action = $this->app->Secure->GetGET("action");
    if($action!="editstueckliste")
    {
      // liste zuweisen
      $pid = $this->app->Secure->GetGET("id");
      $this->app->Secure->POST["stuecklistevonartikel"]=$pid;
      $field = new HTMLInput("stuecklistevonartikel","hidden",$pid);
      $this->form->NewField($field);

      // sortierung
      $maxsort = $this->app->DB->Select("SELECT MAX(sort) FROM stueckliste WHERE stuecklistevonartikel='$pid' LIMIT 1");
      $this->app->Secure->POST["sort"]=$maxsort+1;
      $field = new HTMLInput("sort","hidden",$maxsort+1);
      $this->form->NewField($field);
    }

    $this->app->YUI->AutoComplete(AUTO,"artikel",array('nummer','name_de','warengruppe'),"nummer");
  }

  function DatumErsetzen($wert)
  {
    return "neuerwerert";
  }

  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM stueckliste order by nummer");
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

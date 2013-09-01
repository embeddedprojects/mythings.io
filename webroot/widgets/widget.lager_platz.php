<?
include ("_gen/widget.gen.lager_platz.php");

class WidgetLager_platz extends WidgetGenLager_platz 
{
  private $app;
  function WidgetLager_platz($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenLager_platz($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    $action = $this->app->Secure->GetGET("action");
    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");

    $this->form->ReplaceFunction("projekt",&$this,"ReplaceProjekt");

    if($action=="platz")
    { 
      // liste zuweisen
      $pid = $this->app->Secure->GetGET("id");
      $this->app->Secure->POST["lager"]=$pid;
      $field = new HTMLInput("lager","hidden",$pid);
      $this->form->NewField($field);
    }
  }
  
  function ReplaceProjekt($db,$value)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(is_numeric($value)) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$value' LIMIT 1");
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT kurzbezeichnung, id FROM lager_platz");
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

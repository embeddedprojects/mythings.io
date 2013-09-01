<?
include ("_gen/widget.gen.adresse.php");

class WidgetAdresse extends WidgetGenAdresse 
{
  private $app;
  function WidgetAdresse($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenAdresse($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    $action = $this->app->Secure->GetGET("action");
      
    if($action=="create")
    {
      // liste zuweisen
      $this->app->Secure->POST["firma"]=$this->app->User->GetFirma();
      $field = new HTMLInput("firma","hidden",$this->app->User->GetFirma());
      $this->form->NewField($field);
    }

    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->form->ReplaceFunction("projekt",&$this,"ReplaceProjekt");
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
    $table->Query("SELECT typ,name, vorname, ort, telefon, email,
      id FROM adresse order by name");
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

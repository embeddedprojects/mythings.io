<?
include ("_gen/widget.gen.verkaufspreise.php");

class WidgetVerkaufspreise extends WidgetGenVerkaufspreise 
{
  private $app;
  function WidgetVerkaufspreise($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenVerkaufspreise($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $action = $this->app->Secure->GetGET("action");

    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->app->YUI->AutoComplete(KUNDEAUTO,"adresse",array('name','vorname'),"name");

    $this->form->ReplaceFunction("projekt",&$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",&$this,"ReplaceKunde");

    $this->form->ReplaceFunction("gueltig_bis",&$this,"ReplaceDatum");

    if($action=="verkauf")
    { 
      // liste zuweisen
      $pid = $this->app->Secure->GetGET("id");
      $this->app->Secure->POST["artikel"]=$pid;
      $field = new HTMLInput("artikel","hidden",$pid);
      $this->form->NewField($field);
    }
   $this->app->Tpl->Set(DATUM_GUELTIGBIS,
        "<input type=\"button\" value=\"Datum\" onclick=\"displayCalendar(document.forms[1].gueltig_bis,'dd.mm.yyyy',this)\">");

    $this->app->Tpl->Set(BRUTTOEINGABE,"Bruttoeingabe: <input type=\"text\" size=\"10\" name=\"brutto\" id=\"brutto\">&nbsp;
      <input type=\"button\" value=\"Umrechnen in Netto (-19%)\" 
      onclick=\"document.forms[1].preis.value=runde(document.forms[1].brutto.value/1.19,4)\">");

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

  function ReplaceKunde($db,$value)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(is_numeric($value)) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE name='$value' LIMIT 1");
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

  function ReplaceDatum($db,$value)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strpos($value,'-') > 0) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1.%2.%3","%3-%2-%1");
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) return $this->app->String->Convert($value,"%1-%2-%3","%3.%2.%1");
      else return $value;
    }
  }


  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM verkaufspreise order by nummer");
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

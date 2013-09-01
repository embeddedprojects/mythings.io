<?
include ("_gen/widget.gen.aufgabe.php");

class WidgetAufgabe extends WidgetGenAufgabe 
{
  private $app;
  function WidgetAufgabe($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenAufgabe($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->app->YUI->AutoComplete(MITARBEITERAUTO,"adresse",array('name','vorname'),"id");

    $this->form->ReplaceFunction("projekt",&$this,"ReplaceProjekt");
    //$this->form->ReplaceFunction("adresse",&$this,"ReplaceMitarbeiter");


    $this->form->ReplaceFunction("abgabe_bis",&$this,"ReplaceDatum");
    $this->form->ReplaceFunction("startdatum",&$this,"ReplaceDatum");
    $this->form->ReplaceFunction("startzeit",&$this,"ReplaceZeit");

    $this->app->Tpl->Set(DATUM_STARTDATUM,
      "<input type=\"button\" value=\"Datum\" onclick=\"displayCalendar(document.forms[2].startdatum,'dd.mm.yyyy',this)\">");

    $this->app->Tpl->Set(DATUM_ABGABEBIS,
      "<input type=\"button\" value=\"Datum\" onclick=\"displayCalendar(document.forms[2].abgabe_bis,'dd.mm.yyyy',this)\">");



  }

  function ReplaceZeit($db,$value)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strlen($value) > 5) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1:%2","%1:%2:00");
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) return $this->app->String->Convert($value,"%1:%2:%3","%1:%2");
      else return $value;
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

  function ReplaceMitarbeiter($db,$value)
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


  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM aufgabe order by nummer");
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

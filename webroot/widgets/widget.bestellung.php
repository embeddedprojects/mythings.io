<?
include ("_gen/widget.gen.bestellung.php");

class WidgetBestellung extends WidgetGenBestellung 
{
  private $app;
  function WidgetBestellung(&$app,$parsetarget)
  {
    $this->app = &$app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenBestellung($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->app->YUI->AutoComplete(LIEFERANTAUTO,"adresse",array('name','vorname'),"name");

    $this->form->ReplaceFunction("datum",&$this,"ReplaceDatum");
    $this->form->ReplaceFunction("lieferdatum",&$this,"ReplaceDatum");
    $this->form->ReplaceFunction("projekt",&$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",&$this,"ReplaceLieferant");
  
    $versandart = $this->app->erp->GetVersandartLieferant();
    $zahlungsweise = $this->app->erp->GetZahlungsweiseLieferant();
    $status = $this->app->erp->GetStatusBestellung();

    //$this->app->erp->GetSelect($versandart,$this->app->
    $field = new HTMLSelect("versandart",0);
    $field->AddOptionsSimpleArray($versandart);
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweise",0);
    $field->AddOptionsSimpleArray($zahlungsweise);
    $this->form->NewField($field);

    $field = new HTMLSelect("status",0);
    $field->AddOptionsSimpleArray($status);
    $this->form->NewField($field);
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

  function ReplaceLieferant($db,$value)
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
    $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%Y') as datum, belegnr as beleg, name, zahlungsweise, id
      FROM bestellung order by datum");
    $table->DisplayNew(PAGE, "<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Bearbeiten</a>
        <a href=\"index.php?module=bestellung&action=pdf&id=%value%\">PDF</a>");
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

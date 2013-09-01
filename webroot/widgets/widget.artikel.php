<?
include ("_gen/widget.gen.artikel.php");

class WidgetArtikel extends WidgetGenArtikel 
{
  private $app;
  function WidgetArtikel($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenArtikel($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $this->app->YUI->AutoComplete(LIEFERANTAUTO,"lieferant",array('name','vorname'),"name");

    $this->form->ReplaceFunction("lieferant",&$this,"ReplaceLieferant");
    $this->form->ReplaceFunction("gueltigbis",&$this,"ReplaceDatum");

    $warengruppe = $this->app->erp->GetArtikelWarengruppe();
    $field = new HTMLSelect("warengruppe",0);
    $field->AddOptionsSimpleArray($warengruppe);
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


  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM artikel order by nummer");
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

<?
include ("_gen/widget.gen.bestellung_position.php");

class WidgetBestellung_position extends WidgetGenBestellung_position 
{
  private $app;
  function WidgetBestellung_position($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenBestellung_position($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    $this->app->YUI->AutoComplete(AUTO,"artikel",array('nummer','name_de','warengruppe'),"nummer");
    $this->form->ReplaceFunction("artikel",&$this,"ReplaceArtikel");


    $action = $this->app->Secure->GetGET("action");
    if($action=="positionen")
    { 
      // liste zuweisen
      $pid = $this->app->Secure->GetGET("id");
      $this->app->Secure->POST["bestellung"]=$pid;
      $field = new HTMLInput("bestellung","hidden",$pid);
      $this->form->NewField($field);

      // sortierung
      $maxsort = $this->app->DB->Select("SELECT MAX(sort) FROM bestellung_position WHERE bestellung='$pid' LIMIT 1");
      $this->app->Secure->POST["sort"]=$maxsort+1;
      $field = new HTMLInput("sort","hidden",$maxsort+1);
      $this->form->NewField($field);

      // preis
      // eingabe: artikel, projekt, kunde,stueck,rahmenvertrag????
      //$maxsort = $this->app->DB->Select("SELECT MAX(sort) FROM bestellung_position WHERE bestellung='$pid' LIMIT 1");
      $this->app->Secure->POST["preis"]=8;
      $field = new HTMLInput("preis","hidden",8);
      $this->form->NewField($field);

      // bestellnummer
      //$maxsort = $this->app->DB->Select("SELECT MAX(sort) FROM bestellung_position WHERE bestellung='$pid' LIMIT 1");
      $this->app->Secure->POST["bestellnummer"]=9;
      $field = new HTMLInput("bestellnummer","hidden",9);
      $this->form->NewField($field);



    }

  }


  function ReplaceArtikel($db,$value)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(is_numeric($value)) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$value' LIMIT 1");
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
    $table->Query("SELECT bestellung, id FROM bestellung_position");
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

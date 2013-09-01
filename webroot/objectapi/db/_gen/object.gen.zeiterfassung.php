<?

class ObjGenZeiterfassung
{

  private  $id;
  private  $adresse;
  private  $von;
  private  $bis;
  private  $aufgabe;
  private  $beschreibung;
  private  $arbeitspaket;
  private  $buchungsart;
  private  $kostenstelle;
  private  $projekt;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenZeiterfassung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM zeiterfassung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->von=$result[von];
    $this->bis=$result[bis];
    $this->aufgabe=$result[aufgabe];
    $this->beschreibung=$result[beschreibung];
    $this->arbeitspaket=$result[arbeitspaket];
    $this->buchungsart=$result[buchungsart];
    $this->kostenstelle=$result[kostenstelle];
    $this->projekt=$result[projekt];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO zeiterfassung (id,adresse,von,bis,aufgabe,beschreibung,arbeitspaket,buchungsart,kostenstelle,projekt,logdatei)
      VALUES('','{$this->adresse}','{$this->von}','{$this->bis}','{$this->aufgabe}','{$this->beschreibung}','{$this->arbeitspaket}','{$this->buchungsart}','{$this->kostenstelle}','{$this->projekt}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE zeiterfassung SET
      adresse='{$this->adresse}',
      von='{$this->von}',
      bis='{$this->bis}',
      aufgabe='{$this->aufgabe}',
      beschreibung='{$this->beschreibung}',
      arbeitspaket='{$this->arbeitspaket}',
      buchungsart='{$this->buchungsart}',
      kostenstelle='{$this->kostenstelle}',
      projekt='{$this->projekt}',
      logdatei='{$this->logdatei}'
      WHERE (id='{$this->id}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($id="")
  {
    if(is_numeric($id))
    {
      $this->id=$id;
    }
    else
      return -1;

    $sql = "DELETE FROM zeiterfassung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->von="";
    $this->bis="";
    $this->aufgabe="";
    $this->beschreibung="";
    $this->arbeitspaket="";
    $this->buchungsart="";
    $this->kostenstelle="";
    $this->projekt="";
    $this->logdatei="";
  }

  public function Copy()
  {
    $this->id = "";
    $this->Create();
  }

 /** 
   Mit dieser Funktion kann man einen Datensatz suchen 
   dafuer muss man die Attribute setzen nach denen gesucht werden soll
   dann kriegt man als ergebnis den ersten Datensatz der auf die Suche uebereinstimmt
   zurueck. Mit Next() kann man sich alle weiteren Ergebnisse abholen
   **/ 

  public function Find()
  {
    //TODO Suche mit den werten machen
  }

  public function FindNext()
  {
    //TODO Suche mit den alten werten fortsetzen machen
  }

 /** Funktionen um durch die Tabelle iterieren zu koennen */ 

  public function Next()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

  public function First()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

 /** dank dieser funktionen kann man die tatsaechlichen werte einfach 
  ueberladen (in einem Objekt das mit seiner klasse ueber dieser steht)**/ 

  function SetId($value) { $this->id=$value; }
  function GetId() { return $this->id; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetVon($value) { $this->von=$value; }
  function GetVon() { return $this->von; }
  function SetBis($value) { $this->bis=$value; }
  function GetBis() { return $this->bis; }
  function SetAufgabe($value) { $this->aufgabe=$value; }
  function GetAufgabe() { return $this->aufgabe; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetArbeitspaket($value) { $this->arbeitspaket=$value; }
  function GetArbeitspaket() { return $this->arbeitspaket; }
  function SetBuchungsart($value) { $this->buchungsart=$value; }
  function GetBuchungsart() { return $this->buchungsart; }
  function SetKostenstelle($value) { $this->kostenstelle=$value; }
  function GetKostenstelle() { return $this->kostenstelle; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
<?

class ObjGenArbeitspaket
{

  private  $id;
  private  $adresse;
  private  $aufgabe;
  private  $beschreibung;
  private  $projekt;
  private  $zeit_geplant;
  private  $kostenstelle;
  private  $status;
  private  $abgabe;
  private  $abgenommen;
  private  $abgenommen_von;
  private  $abgenommen_bemerkung;
  private  $initiator;
  private  $art;
  private  $abgabedatum;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenArbeitspaket($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->aufgabe=$result[aufgabe];
    $this->beschreibung=$result[beschreibung];
    $this->projekt=$result[projekt];
    $this->zeit_geplant=$result[zeit_geplant];
    $this->kostenstelle=$result[kostenstelle];
    $this->status=$result[status];
    $this->abgabe=$result[abgabe];
    $this->abgenommen=$result[abgenommen];
    $this->abgenommen_von=$result[abgenommen_von];
    $this->abgenommen_bemerkung=$result[abgenommen_bemerkung];
    $this->initiator=$result[initiator];
    $this->art=$result[art];
    $this->abgabedatum=$result[abgabedatum];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO arbeitspaket (id,adresse,aufgabe,beschreibung,projekt,zeit_geplant,kostenstelle,status,abgabe,abgenommen,abgenommen_von,abgenommen_bemerkung,initiator,art,abgabedatum,logdatei)
      VALUES('','{$this->adresse}','{$this->aufgabe}','{$this->beschreibung}','{$this->projekt}','{$this->zeit_geplant}','{$this->kostenstelle}','{$this->status}','{$this->abgabe}','{$this->abgenommen}','{$this->abgenommen_von}','{$this->abgenommen_bemerkung}','{$this->initiator}','{$this->art}','{$this->abgabedatum}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE arbeitspaket SET
      adresse='{$this->adresse}',
      aufgabe='{$this->aufgabe}',
      beschreibung='{$this->beschreibung}',
      projekt='{$this->projekt}',
      zeit_geplant='{$this->zeit_geplant}',
      kostenstelle='{$this->kostenstelle}',
      status='{$this->status}',
      abgabe='{$this->abgabe}',
      abgenommen='{$this->abgenommen}',
      abgenommen_von='{$this->abgenommen_von}',
      abgenommen_bemerkung='{$this->abgenommen_bemerkung}',
      initiator='{$this->initiator}',
      art='{$this->art}',
      abgabedatum='{$this->abgabedatum}',
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

    $sql = "DELETE FROM arbeitspaket WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->aufgabe="";
    $this->beschreibung="";
    $this->projekt="";
    $this->zeit_geplant="";
    $this->kostenstelle="";
    $this->status="";
    $this->abgabe="";
    $this->abgenommen="";
    $this->abgenommen_von="";
    $this->abgenommen_bemerkung="";
    $this->initiator="";
    $this->art="";
    $this->abgabedatum="";
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
  function SetAufgabe($value) { $this->aufgabe=$value; }
  function GetAufgabe() { return $this->aufgabe; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetZeit_Geplant($value) { $this->zeit_geplant=$value; }
  function GetZeit_Geplant() { return $this->zeit_geplant; }
  function SetKostenstelle($value) { $this->kostenstelle=$value; }
  function GetKostenstelle() { return $this->kostenstelle; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetAbgabe($value) { $this->abgabe=$value; }
  function GetAbgabe() { return $this->abgabe; }
  function SetAbgenommen($value) { $this->abgenommen=$value; }
  function GetAbgenommen() { return $this->abgenommen; }
  function SetAbgenommen_Von($value) { $this->abgenommen_von=$value; }
  function GetAbgenommen_Von() { return $this->abgenommen_von; }
  function SetAbgenommen_Bemerkung($value) { $this->abgenommen_bemerkung=$value; }
  function GetAbgenommen_Bemerkung() { return $this->abgenommen_bemerkung; }
  function SetInitiator($value) { $this->initiator=$value; }
  function GetInitiator() { return $this->initiator; }
  function SetArt($value) { $this->art=$value; }
  function GetArt() { return $this->art; }
  function SetAbgabedatum($value) { $this->abgabedatum=$value; }
  function GetAbgabedatum() { return $this->abgabedatum; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
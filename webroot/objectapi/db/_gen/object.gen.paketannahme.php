<?

class ObjGenPaketannahme
{

  private  $id;
  private  $adresse;
  private  $datum;
  private  $verpackungszustand;
  private  $bemerkung;
  private  $foto;
  private  $gewicht;
  private  $bearbeiter;
  private  $projekt;
  private  $vorlage;
  private  $vorlageid;
  private  $zahlung;
  private  $betrag;
  private  $status;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenPaketannahme($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM paketannahme WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->datum=$result[datum];
    $this->verpackungszustand=$result[verpackungszustand];
    $this->bemerkung=$result[bemerkung];
    $this->foto=$result[foto];
    $this->gewicht=$result[gewicht];
    $this->bearbeiter=$result[bearbeiter];
    $this->projekt=$result[projekt];
    $this->vorlage=$result[vorlage];
    $this->vorlageid=$result[vorlageid];
    $this->zahlung=$result[zahlung];
    $this->betrag=$result[betrag];
    $this->status=$result[status];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO paketannahme (id,adresse,datum,verpackungszustand,bemerkung,foto,gewicht,bearbeiter,projekt,vorlage,vorlageid,zahlung,betrag,status,logdatei)
      VALUES('','{$this->adresse}','{$this->datum}','{$this->verpackungszustand}','{$this->bemerkung}','{$this->foto}','{$this->gewicht}','{$this->bearbeiter}','{$this->projekt}','{$this->vorlage}','{$this->vorlageid}','{$this->zahlung}','{$this->betrag}','{$this->status}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE paketannahme SET
      adresse='{$this->adresse}',
      datum='{$this->datum}',
      verpackungszustand='{$this->verpackungszustand}',
      bemerkung='{$this->bemerkung}',
      foto='{$this->foto}',
      gewicht='{$this->gewicht}',
      bearbeiter='{$this->bearbeiter}',
      projekt='{$this->projekt}',
      vorlage='{$this->vorlage}',
      vorlageid='{$this->vorlageid}',
      zahlung='{$this->zahlung}',
      betrag='{$this->betrag}',
      status='{$this->status}',
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

    $sql = "DELETE FROM paketannahme WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->datum="";
    $this->verpackungszustand="";
    $this->bemerkung="";
    $this->foto="";
    $this->gewicht="";
    $this->bearbeiter="";
    $this->projekt="";
    $this->vorlage="";
    $this->vorlageid="";
    $this->zahlung="";
    $this->betrag="";
    $this->status="";
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
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetVerpackungszustand($value) { $this->verpackungszustand=$value; }
  function GetVerpackungszustand() { return $this->verpackungszustand; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetFoto($value) { $this->foto=$value; }
  function GetFoto() { return $this->foto; }
  function SetGewicht($value) { $this->gewicht=$value; }
  function GetGewicht() { return $this->gewicht; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetVorlage($value) { $this->vorlage=$value; }
  function GetVorlage() { return $this->vorlage; }
  function SetVorlageid($value) { $this->vorlageid=$value; }
  function GetVorlageid() { return $this->vorlageid; }
  function SetZahlung($value) { $this->zahlung=$value; }
  function GetZahlung() { return $this->zahlung; }
  function SetBetrag($value) { $this->betrag=$value; }
  function GetBetrag() { return $this->betrag; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
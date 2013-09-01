<?

class ObjGenAdresse_Kontakhistorie
{

  private  $id;
  private  $adresse_id;
  private  $grund;
  private  $beschreibung;
  private  $mitarbeiter;
  private  $datum;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenAdresse_Kontakhistorie($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM adresse_kontakhistorie WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse_id=$result[adresse_id];
    $this->grund=$result[grund];
    $this->beschreibung=$result[beschreibung];
    $this->mitarbeiter=$result[mitarbeiter];
    $this->datum=$result[datum];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO adresse_kontakhistorie (id,adresse_id,grund,beschreibung,mitarbeiter,datum,logdatei)
      VALUES('','{$this->adresse_id}','{$this->grund}','{$this->beschreibung}','{$this->mitarbeiter}','{$this->datum}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE adresse_kontakhistorie SET
      adresse_id='{$this->adresse_id}',
      grund='{$this->grund}',
      beschreibung='{$this->beschreibung}',
      mitarbeiter='{$this->mitarbeiter}',
      datum='{$this->datum}',
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

    $sql = "DELETE FROM adresse_kontakhistorie WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse_id="";
    $this->grund="";
    $this->beschreibung="";
    $this->mitarbeiter="";
    $this->datum="";
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
  function SetAdresse_Id($value) { $this->adresse_id=$value; }
  function GetAdresse_Id() { return $this->adresse_id; }
  function SetGrund($value) { $this->grund=$value; }
  function GetGrund() { return $this->grund; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetMitarbeiter($value) { $this->mitarbeiter=$value; }
  function GetMitarbeiter() { return $this->mitarbeiter; }
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
<?

class ObjGenEmail
{

  private  $id;
  private  $adresse;
  private  $betreff;
  private  $nachricht;
  private  $datum;
  private  $bearbeiter;
  private  $status;
  private  $richtung;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenEmail($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM email WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->betreff=$result[betreff];
    $this->nachricht=$result[nachricht];
    $this->datum=$result[datum];
    $this->bearbeiter=$result[bearbeiter];
    $this->status=$result[status];
    $this->richtung=$result[richtung];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO email (id,adresse,betreff,nachricht,datum,bearbeiter,status,richtung,logdatei)
      VALUES('','{$this->adresse}','{$this->betreff}','{$this->nachricht}','{$this->datum}','{$this->bearbeiter}','{$this->status}','{$this->richtung}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE email SET
      adresse='{$this->adresse}',
      betreff='{$this->betreff}',
      nachricht='{$this->nachricht}',
      datum='{$this->datum}',
      bearbeiter='{$this->bearbeiter}',
      status='{$this->status}',
      richtung='{$this->richtung}',
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

    $sql = "DELETE FROM email WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->betreff="";
    $this->nachricht="";
    $this->datum="";
    $this->bearbeiter="";
    $this->status="";
    $this->richtung="";
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
  function SetBetreff($value) { $this->betreff=$value; }
  function GetBetreff() { return $this->betreff; }
  function SetNachricht($value) { $this->nachricht=$value; }
  function GetNachricht() { return $this->nachricht; }
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetRichtung($value) { $this->richtung=$value; }
  function GetRichtung() { return $this->richtung; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
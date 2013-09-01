<?

class ObjGenProjekt
{

  private  $id;
  private  $name;
  private  $abkuerzung;
  private  $verantwortlicher;
  private  $beschreibung;
  private  $sonstiges;
  private  $aktiv;
  private  $farbe;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenProjekt($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->name=$result[name];
    $this->abkuerzung=$result[abkuerzung];
    $this->verantwortlicher=$result[verantwortlicher];
    $this->beschreibung=$result[beschreibung];
    $this->sonstiges=$result[sonstiges];
    $this->aktiv=$result[aktiv];
    $this->farbe=$result[farbe];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO projekt (id,name,abkuerzung,verantwortlicher,beschreibung,sonstiges,aktiv,farbe,logdatei)
      VALUES('','{$this->name}','{$this->abkuerzung}','{$this->verantwortlicher}','{$this->beschreibung}','{$this->sonstiges}','{$this->aktiv}','{$this->farbe}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE projekt SET
      name='{$this->name}',
      abkuerzung='{$this->abkuerzung}',
      verantwortlicher='{$this->verantwortlicher}',
      beschreibung='{$this->beschreibung}',
      sonstiges='{$this->sonstiges}',
      aktiv='{$this->aktiv}',
      farbe='{$this->farbe}',
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

    $sql = "DELETE FROM projekt WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->name="";
    $this->abkuerzung="";
    $this->verantwortlicher="";
    $this->beschreibung="";
    $this->sonstiges="";
    $this->aktiv="";
    $this->farbe="";
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
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetAbkuerzung($value) { $this->abkuerzung=$value; }
  function GetAbkuerzung() { return $this->abkuerzung; }
  function SetVerantwortlicher($value) { $this->verantwortlicher=$value; }
  function GetVerantwortlicher() { return $this->verantwortlicher; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetAktiv($value) { $this->aktiv=$value; }
  function GetAktiv() { return $this->aktiv; }
  function SetFarbe($value) { $this->farbe=$value; }
  function GetFarbe() { return $this->farbe; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
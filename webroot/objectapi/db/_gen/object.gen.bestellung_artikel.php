<?

class ObjGenBestellung_Artikel
{

  private  $id;
  private  $bestellung;
  private  $artikel;
  private  $bezeichnunglieferant;
  private  $bestellnummer;
  private  $menge;
  private  $preis;
  private  $position;
  private  $status;
  private  $bemerkung;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenBestellung_Artikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM bestellung_artikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->bestellung=$result[bestellung];
    $this->artikel=$result[artikel];
    $this->bezeichnunglieferant=$result[bezeichnunglieferant];
    $this->bestellnummer=$result[bestellnummer];
    $this->menge=$result[menge];
    $this->preis=$result[preis];
    $this->position=$result[position];
    $this->status=$result[status];
    $this->bemerkung=$result[bemerkung];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO bestellung_artikel (id,bestellung,artikel,bezeichnunglieferant,bestellnummer,menge,preis,position,status,bemerkung,logdatei)
      VALUES('','{$this->bestellung}','{$this->artikel}','{$this->bezeichnunglieferant}','{$this->bestellnummer}','{$this->menge}','{$this->preis}','{$this->position}','{$this->status}','{$this->bemerkung}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE bestellung_artikel SET
      bestellung='{$this->bestellung}',
      artikel='{$this->artikel}',
      bezeichnunglieferant='{$this->bezeichnunglieferant}',
      bestellnummer='{$this->bestellnummer}',
      menge='{$this->menge}',
      preis='{$this->preis}',
      position='{$this->position}',
      status='{$this->status}',
      bemerkung='{$this->bemerkung}',
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

    $sql = "DELETE FROM bestellung_artikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->bestellung="";
    $this->artikel="";
    $this->bezeichnunglieferant="";
    $this->bestellnummer="";
    $this->menge="";
    $this->preis="";
    $this->position="";
    $this->status="";
    $this->bemerkung="";
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
  function SetBestellung($value) { $this->bestellung=$value; }
  function GetBestellung() { return $this->bestellung; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetBezeichnunglieferant($value) { $this->bezeichnunglieferant=$value; }
  function GetBezeichnunglieferant() { return $this->bezeichnunglieferant; }
  function SetBestellnummer($value) { $this->bestellnummer=$value; }
  function GetBestellnummer() { return $this->bestellnummer; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetPosition($value) { $this->position=$value; }
  function GetPosition() { return $this->position; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
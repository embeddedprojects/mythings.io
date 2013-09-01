<?

class ObjGenLager_Bewegung
{

  private  $id;
  private  $lager_platz;
  private  $artikel;
  private  $menge;
  private  $eingang;
  private  $zeit;
  private  $referenz;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenLager_Bewegung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM lager_bewegung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->lager_platz=$result[lager_platz];
    $this->artikel=$result[artikel];
    $this->menge=$result[menge];
    $this->eingang=$result[eingang];
    $this->zeit=$result[zeit];
    $this->referenz=$result[referenz];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,eingang,zeit,referenz,logdatei)
      VALUES('','{$this->lager_platz}','{$this->artikel}','{$this->menge}','{$this->eingang}','{$this->zeit}','{$this->referenz}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE lager_bewegung SET
      lager_platz='{$this->lager_platz}',
      artikel='{$this->artikel}',
      menge='{$this->menge}',
      eingang='{$this->eingang}',
      zeit='{$this->zeit}',
      referenz='{$this->referenz}',
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

    $sql = "DELETE FROM lager_bewegung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->lager_platz="";
    $this->artikel="";
    $this->menge="";
    $this->eingang="";
    $this->zeit="";
    $this->referenz="";
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
  function SetLager_Platz($value) { $this->lager_platz=$value; }
  function GetLager_Platz() { return $this->lager_platz; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetEingang($value) { $this->eingang=$value; }
  function GetEingang() { return $this->eingang; }
  function SetZeit($value) { $this->zeit=$value; }
  function GetZeit() { return $this->zeit; }
  function SetReferenz($value) { $this->referenz=$value; }
  function GetReferenz() { return $this->referenz; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
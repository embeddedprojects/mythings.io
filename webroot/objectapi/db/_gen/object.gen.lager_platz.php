<?

class ObjGenLager_Platz
{

  private  $id;
  private  $lager;
  private  $kurzbezeichnung;
  private  $bemerkung;
  private  $projekt;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenLager_Platz($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM lager_platz WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->lager=$result[lager];
    $this->kurzbezeichnung=$result[kurzbezeichnung];
    $this->bemerkung=$result[bemerkung];
    $this->projekt=$result[projekt];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO lager_platz (id,lager,kurzbezeichnung,bemerkung,projekt,logdatei)
      VALUES('','{$this->lager}','{$this->kurzbezeichnung}','{$this->bemerkung}','{$this->projekt}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE lager_platz SET
      lager='{$this->lager}',
      kurzbezeichnung='{$this->kurzbezeichnung}',
      bemerkung='{$this->bemerkung}',
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

    $sql = "DELETE FROM lager_platz WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->lager="";
    $this->kurzbezeichnung="";
    $this->bemerkung="";
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
  function SetLager($value) { $this->lager=$value; }
  function GetLager() { return $this->lager; }
  function SetKurzbezeichnung($value) { $this->kurzbezeichnung=$value; }
  function GetKurzbezeichnung() { return $this->kurzbezeichnung; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
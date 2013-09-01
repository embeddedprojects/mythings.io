<?

class ObjGenEvent
{

  private  $nlfdevent;
  private  $seventbez;
  private  $seventbeschreibung;
  private  $scolor;
  private  $dtvon;
  private  $dtbis;

  public $app;            //application object 

  public function ObjGenEvent($app)
  {
    $this->app = $app;
  }

  public function Select($nlfdevent)
  {
    if(is_numeric($nlfdevent))
      $result = $this->app->DB->SelectArr("SELECT * FROM event WHERE (nlfdevent = '$nlfdevent')");
    else
      return -1;

$result = $result[0];

    $this->nlfdevent=$result[nlfdevent];
    $this->seventbez=$result[seventbez];
    $this->seventbeschreibung=$result[seventbeschreibung];
    $this->scolor=$result[scolor];
    $this->dtvon=$result[dtvon];
    $this->dtbis=$result[dtbis];
  }

  public function Create()
  {
    $sql = "INSERT INTO event (nlfdevent,seventbez,seventbeschreibung,scolor,dtvon,dtbis)
      VALUES('','{$this->seventbez}','{$this->seventbeschreibung}','{$this->scolor}','{$this->dtvon}','{$this->dtbis}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->nlfdevent))
      return -1;

    $sql = "UPDATE event SET
      seventbez='{$this->seventbez}',
      seventbeschreibung='{$this->seventbeschreibung}',
      scolor='{$this->scolor}',
      dtvon='{$this->dtvon}',
      dtbis='{$this->dtbis}'
      WHERE (nlfdevent='{$this->nlfdevent}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($nlfdevent="")
  {
    if(is_numeric($nlfdevent))
    {
      $this->nlfdevent=$nlfdevent;
    }
    else
      return -1;

    $sql = "DELETE FROM event WHERE (nlfdevent='{$this->nlfdevent}')";
    $this->app->DB->Delete($sql);

    $this->nlfdevent="";
    $this->seventbez="";
    $this->seventbeschreibung="";
    $this->scolor="";
    $this->dtvon="";
    $this->dtbis="";
  }

  public function Copy()
  {
    $this->nlfdevent = "";
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

  function SetNlfdevent($value) { $this->nlfdevent=$value; }
  function GetNlfdevent() { return $this->nlfdevent; }
  function SetSeventbez($value) { $this->seventbez=$value; }
  function GetSeventbez() { return $this->seventbez; }
  function SetSeventbeschreibung($value) { $this->seventbeschreibung=$value; }
  function GetSeventbeschreibung() { return $this->seventbeschreibung; }
  function SetScolor($value) { $this->scolor=$value; }
  function GetScolor() { return $this->scolor; }
  function SetDtvon($value) { $this->dtvon=$value; }
  function GetDtvon() { return $this->dtvon; }
  function SetDtbis($value) { $this->dtbis=$value; }
  function GetDtbis() { return $this->dtbis; }

}

?>
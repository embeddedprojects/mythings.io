<?

class ObjGenshowband
{

  private  $id
  private  $name
  private  $vorname
  private  $plz
  private  $land

  public $app;            //application object 

  public function ObjGenshowband($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM showband WHERE (id = $id)");
    else
      return -1;

    $this->id=$result[id];
    $this->name=$result[name];
    $this->vorname=$result[vorname];
    $this->plz=$result[plz];
    $this->land=$result[land];
  }

  public function Create()
  {
    $sql = "INSERT INTO showband (id,name,vorname,plz,land)
      VALUES('','{$this->name}','{$this->vorname}','{$this->plz}','{$this->land}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($id))
      return -1;

    $sql = "UPDATE showband SET
      name='{$this->name}',
      vorname='{$this->vorname}',
      plz='{$this->plz}',
      land='{$this->land}'
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

    $sql = "DELETE FROM showband WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->name="";
    $this->vorname="";
    $this->plz="";
    $this->land="";
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

  function Setid($value) { $this->id=$value; }
  function Setname($value) { $this->name=$value; }
  function Setvorname($value) { $this->vorname=$value; }
  function Setplz($value) { $this->plz=$value; }
  function Setland($value) { $this->land=$value; }

}

?>
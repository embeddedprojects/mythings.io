<?

class ObjGenEmailbackup
{

  private  $id;
  private  $benutzername;
  private  $passwort;
  private  $server;
  private  $loeschtage;

  public $app;            //application object 

  public function ObjGenEmailbackup($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM emailbackup WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->benutzername=$result[benutzername];
    $this->passwort=$result[passwort];
    $this->server=$result[server];
    $this->loeschtage=$result[loeschtage];
  }

  public function Create()
  {
    $sql = "INSERT INTO emailbackup (id,benutzername,passwort,server,loeschtage)
      VALUES('','{$this->benutzername}','{$this->passwort}','{$this->server}','{$this->loeschtage}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE emailbackup SET
      benutzername='{$this->benutzername}',
      passwort='{$this->passwort}',
      server='{$this->server}',
      loeschtage='{$this->loeschtage}'
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

    $sql = "DELETE FROM emailbackup WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->benutzername="";
    $this->passwort="";
    $this->server="";
    $this->loeschtage="";
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
  function SetBenutzername($value) { $this->benutzername=$value; }
  function GetBenutzername() { return $this->benutzername; }
  function SetPasswort($value) { $this->passwort=$value; }
  function GetPasswort() { return $this->passwort; }
  function SetServer($value) { $this->server=$value; }
  function GetServer() { return $this->server; }
  function SetLoeschtage($value) { $this->loeschtage=$value; }
  function GetLoeschtage() { return $this->loeschtage; }

}

?>
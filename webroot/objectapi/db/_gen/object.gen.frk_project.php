<?

class ObjGenFrk_Project
{

  private  $projectId;
  private  $name;
  private  $description;

  public $app;            //application object 

  public function ObjGenFrk_Project($app)
  {
    $this->app = $app;
  }

  public function Select($projectId)
  {
    if(is_numeric($projectId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_project WHERE (projectId = '$projectId')");
    else
      return -1;

$result = $result[0];

    $this->projectId=$result[projectId];
    $this->name=$result[name];
    $this->description=$result[description];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_project (projectId,name,description)
      VALUES('','{$this->name}','{$this->description}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->projectId))
      return -1;

    $sql = "UPDATE frk_project SET
      name='{$this->name}',
      description='{$this->description}'
      WHERE (projectId='{$this->projectId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($projectId="")
  {
    if(is_numeric($projectId))
    {
      $this->projectId=$projectId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_project WHERE (projectId='{$this->projectId}')";
    $this->app->DB->Delete($sql);

    $this->projectId="";
    $this->name="";
    $this->description="";
  }

  public function Copy()
  {
    $this->projectId = "";
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

  function SetProjectid($value) { $this->projectId=$value; }
  function GetProjectid() { return $this->projectId; }
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetDescription($value) { $this->description=$value; }
  function GetDescription() { return $this->description; }

}

?>
<?

class ObjGenFrk_Projectstatus
{

  private  $projectStatusId;
  private  $projectId;
  private  $statusDate;
  private  $statusKey;
  private  $memberId;

  public $app;            //application object 

  public function ObjGenFrk_Projectstatus($app)
  {
    $this->app = $app;
  }

  public function Select($projectStatusId)
  {
    if(is_numeric($projectStatusId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_projectStatus WHERE (projectStatusId = '$projectStatusId')");
    else
      return -1;

$result = $result[0];

    $this->projectStatusId=$result[projectStatusId];
    $this->projectId=$result[projectId];
    $this->statusDate=$result[statusDate];
    $this->statusKey=$result[statusKey];
    $this->memberId=$result[memberId];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_projectStatus (projectStatusId,projectId,statusDate,statusKey,memberId)
      VALUES('','{$this->projectId}','{$this->statusDate}','{$this->statusKey}','{$this->memberId}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->projectStatusId))
      return -1;

    $sql = "UPDATE frk_projectStatus SET
      projectId='{$this->projectId}',
      statusDate='{$this->statusDate}',
      statusKey='{$this->statusKey}',
      memberId='{$this->memberId}'
      WHERE (projectStatusId='{$this->projectStatusId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($projectStatusId="")
  {
    if(is_numeric($projectStatusId))
    {
      $this->projectStatusId=$projectStatusId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_projectStatus WHERE (projectStatusId='{$this->projectStatusId}')";
    $this->app->DB->Delete($sql);

    $this->projectStatusId="";
    $this->projectId="";
    $this->statusDate="";
    $this->statusKey="";
    $this->memberId="";
  }

  public function Copy()
  {
    $this->projectStatusId = "";
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

  function SetProjectstatusid($value) { $this->projectStatusId=$value; }
  function GetProjectstatusid() { return $this->projectStatusId; }
  function SetProjectid($value) { $this->projectId=$value; }
  function GetProjectid() { return $this->projectId; }
  function SetStatusdate($value) { $this->statusDate=$value; }
  function GetStatusdate() { return $this->statusDate; }
  function SetStatuskey($value) { $this->statusKey=$value; }
  function GetStatuskey() { return $this->statusKey; }
  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }

}

?>
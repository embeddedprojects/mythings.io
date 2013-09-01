<?

class ObjGenFrk_Memberproject
{

  private  $memberId;
  private  $projectId;
  private  $position;

  public $app;            //application object 

  public function ObjGenFrk_Memberproject($app)
  {
    $this->app = $app;
  }

  public function Select($memberId, $projectId)
  {
    if(is_numeric($memberId) && is_numeric($projectId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_memberProject WHERE (memberId = '$memberId' and projectId = '$projectId')");
    else
      return -1;

$result = $result[0];

    $this->memberId=$result[memberId];
    $this->projectId=$result[projectId];
    $this->position=$result[position];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_memberProject (memberId,projectId,position)
      VALUES('{$this->memberId}','{$this->projectId}','{$this->position}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->memberId) || !is_numeric($this->projectId))
      return -1;

    $sql = "UPDATE frk_memberProject SET
      position='{$this->position}'
      WHERE (memberId='{$this->memberId}' && projectId='{$this->projectId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($memberId="" ,$projectId="")
  {
    if(is_numeric($memberId) && is_numeric($projectId))
    {
      $this->memberId=$memberId;
      $this->projectId=$projectId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_memberProject WHERE (memberId='{$this->memberId}' && projectId='{$this->projectId}')";
    $this->app->DB->Delete($sql);

    $this->memberId="";
    $this->projectId="";
    $this->position="";
  }

  public function Copy()
  {
    $this->memberId = "";
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

  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }
  function SetProjectid($value) { $this->projectId=$value; }
  function GetProjectid() { return $this->projectId; }
  function SetPosition($value) { $this->position=$value; }
  function GetPosition() { return $this->position; }

}

?>
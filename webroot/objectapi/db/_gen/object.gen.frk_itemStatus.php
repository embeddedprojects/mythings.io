<?

class ObjGenFrk_Itemstatus
{

  private  $itemStatusId;
  private  $itemId;
  private  $statusDate;
  private  $statusKey;
  private  $memberId;

  public $app;            //application object 

  public function ObjGenFrk_Itemstatus($app)
  {
    $this->app = $app;
  }

  public function Select($itemStatusId)
  {
    if(is_numeric($itemStatusId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_itemStatus WHERE (itemStatusId = '$itemStatusId')");
    else
      return -1;

$result = $result[0];

    $this->itemStatusId=$result[itemStatusId];
    $this->itemId=$result[itemId];
    $this->statusDate=$result[statusDate];
    $this->statusKey=$result[statusKey];
    $this->memberId=$result[memberId];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_itemStatus (itemStatusId,itemId,statusDate,statusKey,memberId)
      VALUES('','{$this->itemId}','{$this->statusDate}','{$this->statusKey}','{$this->memberId}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->itemStatusId))
      return -1;

    $sql = "UPDATE frk_itemStatus SET
      itemId='{$this->itemId}',
      statusDate='{$this->statusDate}',
      statusKey='{$this->statusKey}',
      memberId='{$this->memberId}'
      WHERE (itemStatusId='{$this->itemStatusId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($itemStatusId="")
  {
    if(is_numeric($itemStatusId))
    {
      $this->itemStatusId=$itemStatusId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_itemStatus WHERE (itemStatusId='{$this->itemStatusId}')";
    $this->app->DB->Delete($sql);

    $this->itemStatusId="";
    $this->itemId="";
    $this->statusDate="";
    $this->statusKey="";
    $this->memberId="";
  }

  public function Copy()
  {
    $this->itemStatusId = "";
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

  function SetItemstatusid($value) { $this->itemStatusId=$value; }
  function GetItemstatusid() { return $this->itemStatusId; }
  function SetItemid($value) { $this->itemId=$value; }
  function GetItemid() { return $this->itemId; }
  function SetStatusdate($value) { $this->statusDate=$value; }
  function GetStatusdate() { return $this->statusDate; }
  function SetStatuskey($value) { $this->statusKey=$value; }
  function GetStatuskey() { return $this->statusKey; }
  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }

}

?>
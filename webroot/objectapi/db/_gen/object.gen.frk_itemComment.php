<?

class ObjGenFrk_Itemcomment
{

  private  $itemCommentId;
  private  $itemId;
  private  $memberId;
  private  $postDate;
  private  $body;
  private  $lastChangeDate;

  public $app;            //application object 

  public function ObjGenFrk_Itemcomment($app)
  {
    $this->app = $app;
  }

  public function Select($itemCommentId)
  {
    if(is_numeric($itemCommentId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_itemComment WHERE (itemCommentId = '$itemCommentId')");
    else
      return -1;

$result = $result[0];

    $this->itemCommentId=$result[itemCommentId];
    $this->itemId=$result[itemId];
    $this->memberId=$result[memberId];
    $this->postDate=$result[postDate];
    $this->body=$result[body];
    $this->lastChangeDate=$result[lastChangeDate];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_itemComment (itemCommentId,itemId,memberId,postDate,body,lastChangeDate)
      VALUES('','{$this->itemId}','{$this->memberId}','{$this->postDate}','{$this->body}','{$this->lastChangeDate}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->itemCommentId))
      return -1;

    $sql = "UPDATE frk_itemComment SET
      itemId='{$this->itemId}',
      memberId='{$this->memberId}',
      postDate='{$this->postDate}',
      body='{$this->body}',
      lastChangeDate='{$this->lastChangeDate}'
      WHERE (itemCommentId='{$this->itemCommentId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($itemCommentId="")
  {
    if(is_numeric($itemCommentId))
    {
      $this->itemCommentId=$itemCommentId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_itemComment WHERE (itemCommentId='{$this->itemCommentId}')";
    $this->app->DB->Delete($sql);

    $this->itemCommentId="";
    $this->itemId="";
    $this->memberId="";
    $this->postDate="";
    $this->body="";
    $this->lastChangeDate="";
  }

  public function Copy()
  {
    $this->itemCommentId = "";
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

  function SetItemcommentid($value) { $this->itemCommentId=$value; }
  function GetItemcommentid() { return $this->itemCommentId; }
  function SetItemid($value) { $this->itemId=$value; }
  function GetItemid() { return $this->itemId; }
  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }
  function SetPostdate($value) { $this->postDate=$value; }
  function GetPostdate() { return $this->postDate; }
  function SetBody($value) { $this->body=$value; }
  function GetBody() { return $this->body; }
  function SetLastchangedate($value) { $this->lastChangeDate=$value; }
  function GetLastchangedate() { return $this->lastChangeDate; }

}

?>
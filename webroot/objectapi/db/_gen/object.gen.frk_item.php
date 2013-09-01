<?

class ObjGenFrk_Item
{

  private  $itemId;
  private  $projectId;
  private  $itemParentId;
  private  $priority;
  private  $context;
  private  $title;
  private  $description;
  private  $deadlineDate;
  private  $expectedDuration;
  private  $showInCalendar;
  private  $showPrivate;
  private  $memberId;
  private  $authorId;

  public $app;            //application object 

  public function ObjGenFrk_Item($app)
  {
    $this->app = $app;
  }

  public function Select($itemId)
  {
    if(is_numeric($itemId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_item WHERE (itemId = '$itemId')");
    else
      return -1;

$result = $result[0];

    $this->itemId=$result[itemId];
    $this->projectId=$result[projectId];
    $this->itemParentId=$result[itemParentId];
    $this->priority=$result[priority];
    $this->context=$result[context];
    $this->title=$result[title];
    $this->description=$result[description];
    $this->deadlineDate=$result[deadlineDate];
    $this->expectedDuration=$result[expectedDuration];
    $this->showInCalendar=$result[showInCalendar];
    $this->showPrivate=$result[showPrivate];
    $this->memberId=$result[memberId];
    $this->authorId=$result[authorId];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_item (itemId,projectId,itemParentId,priority,context,title,description,deadlineDate,expectedDuration,showInCalendar,showPrivate,memberId,authorId)
      VALUES('','{$this->projectId}','{$this->itemParentId}','{$this->priority}','{$this->context}','{$this->title}','{$this->description}','{$this->deadlineDate}','{$this->expectedDuration}','{$this->showInCalendar}','{$this->showPrivate}','{$this->memberId}','{$this->authorId}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->itemId))
      return -1;

    $sql = "UPDATE frk_item SET
      projectId='{$this->projectId}',
      itemParentId='{$this->itemParentId}',
      priority='{$this->priority}',
      context='{$this->context}',
      title='{$this->title}',
      description='{$this->description}',
      deadlineDate='{$this->deadlineDate}',
      expectedDuration='{$this->expectedDuration}',
      showInCalendar='{$this->showInCalendar}',
      showPrivate='{$this->showPrivate}',
      memberId='{$this->memberId}',
      authorId='{$this->authorId}'
      WHERE (itemId='{$this->itemId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($itemId="")
  {
    if(is_numeric($itemId))
    {
      $this->itemId=$itemId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_item WHERE (itemId='{$this->itemId}')";
    $this->app->DB->Delete($sql);

    $this->itemId="";
    $this->projectId="";
    $this->itemParentId="";
    $this->priority="";
    $this->context="";
    $this->title="";
    $this->description="";
    $this->deadlineDate="";
    $this->expectedDuration="";
    $this->showInCalendar="";
    $this->showPrivate="";
    $this->memberId="";
    $this->authorId="";
  }

  public function Copy()
  {
    $this->itemId = "";
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

  function SetItemid($value) { $this->itemId=$value; }
  function GetItemid() { return $this->itemId; }
  function SetProjectid($value) { $this->projectId=$value; }
  function GetProjectid() { return $this->projectId; }
  function SetItemparentid($value) { $this->itemParentId=$value; }
  function GetItemparentid() { return $this->itemParentId; }
  function SetPriority($value) { $this->priority=$value; }
  function GetPriority() { return $this->priority; }
  function SetContext($value) { $this->context=$value; }
  function GetContext() { return $this->context; }
  function SetTitle($value) { $this->title=$value; }
  function GetTitle() { return $this->title; }
  function SetDescription($value) { $this->description=$value; }
  function GetDescription() { return $this->description; }
  function SetDeadlinedate($value) { $this->deadlineDate=$value; }
  function GetDeadlinedate() { return $this->deadlineDate; }
  function SetExpectedduration($value) { $this->expectedDuration=$value; }
  function GetExpectedduration() { return $this->expectedDuration; }
  function SetShowincalendar($value) { $this->showInCalendar=$value; }
  function GetShowincalendar() { return $this->showInCalendar; }
  function SetShowprivate($value) { $this->showPrivate=$value; }
  function GetShowprivate() { return $this->showPrivate; }
  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }
  function SetAuthorid($value) { $this->authorId=$value; }
  function GetAuthorid() { return $this->authorId; }

}

?>
<?

class ObjGenFrk_Itemfile
{

  private  $itemFileId;
  private  $itemId;
  private  $memberId;
  private  $fileTitle;
  private  $filename;
  private  $filetype;
  private  $filesize;
  private  $postDate;
  private  $lastChangeDate;
  private  $fileTags;

  public $app;            //application object 

  public function ObjGenFrk_Itemfile($app)
  {
    $this->app = $app;
  }

  public function Select($itemFileId)
  {
    if(is_numeric($itemFileId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_itemFile WHERE (itemFileId = '$itemFileId')");
    else
      return -1;

$result = $result[0];

    $this->itemFileId=$result[itemFileId];
    $this->itemId=$result[itemId];
    $this->memberId=$result[memberId];
    $this->fileTitle=$result[fileTitle];
    $this->filename=$result[filename];
    $this->filetype=$result[filetype];
    $this->filesize=$result[filesize];
    $this->postDate=$result[postDate];
    $this->lastChangeDate=$result[lastChangeDate];
    $this->fileTags=$result[fileTags];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_itemFile (itemFileId,itemId,memberId,fileTitle,filename,filetype,filesize,postDate,lastChangeDate,fileTags)
      VALUES('','{$this->itemId}','{$this->memberId}','{$this->fileTitle}','{$this->filename}','{$this->filetype}','{$this->filesize}','{$this->postDate}','{$this->lastChangeDate}','{$this->fileTags}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->itemFileId))
      return -1;

    $sql = "UPDATE frk_itemFile SET
      itemId='{$this->itemId}',
      memberId='{$this->memberId}',
      fileTitle='{$this->fileTitle}',
      filename='{$this->filename}',
      filetype='{$this->filetype}',
      filesize='{$this->filesize}',
      postDate='{$this->postDate}',
      lastChangeDate='{$this->lastChangeDate}',
      fileTags='{$this->fileTags}'
      WHERE (itemFileId='{$this->itemFileId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($itemFileId="")
  {
    if(is_numeric($itemFileId))
    {
      $this->itemFileId=$itemFileId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_itemFile WHERE (itemFileId='{$this->itemFileId}')";
    $this->app->DB->Delete($sql);

    $this->itemFileId="";
    $this->itemId="";
    $this->memberId="";
    $this->fileTitle="";
    $this->filename="";
    $this->filetype="";
    $this->filesize="";
    $this->postDate="";
    $this->lastChangeDate="";
    $this->fileTags="";
  }

  public function Copy()
  {
    $this->itemFileId = "";
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

  function SetItemfileid($value) { $this->itemFileId=$value; }
  function GetItemfileid() { return $this->itemFileId; }
  function SetItemid($value) { $this->itemId=$value; }
  function GetItemid() { return $this->itemId; }
  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }
  function SetFiletitle($value) { $this->fileTitle=$value; }
  function GetFiletitle() { return $this->fileTitle; }
  function SetFilename($value) { $this->filename=$value; }
  function GetFilename() { return $this->filename; }
  function SetFiletype($value) { $this->filetype=$value; }
  function GetFiletype() { return $this->filetype; }
  function SetFilesize($value) { $this->filesize=$value; }
  function GetFilesize() { return $this->filesize; }
  function SetPostdate($value) { $this->postDate=$value; }
  function GetPostdate() { return $this->postDate; }
  function SetLastchangedate($value) { $this->lastChangeDate=$value; }
  function GetLastchangedate() { return $this->lastChangeDate; }
  function SetFiletags($value) { $this->fileTags=$value; }
  function GetFiletags() { return $this->fileTags; }

}

?>
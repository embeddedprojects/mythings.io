<?

class ObjGenUser
{

  private  $id;
  private  $username;
  private  $password;
  private  $description;
  private  $settings;
  private  $parentuser;
  private  $activ;
  private  $type;
  private  $adresse;
  private  $firma;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenUser($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM user WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->username=$result[username];
    $this->password=$result[password];
    $this->description=$result[description];
    $this->settings=$result[settings];
    $this->parentuser=$result[parentuser];
    $this->activ=$result[activ];
    $this->type=$result[type];
    $this->adresse=$result[adresse];
    $this->firma=$result[firma];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO user (id,username,password,description,settings,parentuser,activ,type,adresse,firma,logdatei)
      VALUES('','{$this->username}','{$this->password}','{$this->description}','{$this->settings}','{$this->parentuser}','{$this->activ}','{$this->type}','{$this->adresse}','{$this->firma}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE user SET
      username='{$this->username}',
      password='{$this->password}',
      description='{$this->description}',
      settings='{$this->settings}',
      parentuser='{$this->parentuser}',
      activ='{$this->activ}',
      type='{$this->type}',
      adresse='{$this->adresse}',
      firma='{$this->firma}',
      logdatei='{$this->logdatei}'
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

    $sql = "DELETE FROM user WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->username="";
    $this->password="";
    $this->description="";
    $this->settings="";
    $this->parentuser="";
    $this->activ="";
    $this->type="";
    $this->adresse="";
    $this->firma="";
    $this->logdatei="";
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
  function SetUsername($value) { $this->username=$value; }
  function GetUsername() { return $this->username; }
  function SetPassword($value) { $this->password=$value; }
  function GetPassword() { return $this->password; }
  function SetDescription($value) { $this->description=$value; }
  function GetDescription() { return $this->description; }
  function SetSettings($value) { $this->settings=$value; }
  function GetSettings() { return $this->settings; }
  function SetParentuser($value) { $this->parentuser=$value; }
  function GetParentuser() { return $this->parentuser; }
  function SetActiv($value) { $this->activ=$value; }
  function GetActiv() { return $this->activ; }
  function SetType($value) { $this->type=$value; }
  function GetType() { return $this->type; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
<?

class ObjGenFrk_Country
{

  private  $countryId;
  private  $name;

  public $app;            //application object 

  public function ObjGenFrk_Country($app)
  {
    $this->app = $app;
  }

  public function Select($countryId)
  {
    $result = $this->app->DB->SelectArr("SELECT * FROM frk_country WHERE (countryId = '$countryId')");

$result = $result[0];

    $this->countryId=$result[countryId];
    $this->name=$result[name];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_country (countryId,name)
      VALUES('{$this->countryId}','{$this->name}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    $sql = "UPDATE frk_country SET
      name='{$this->name}'
      WHERE (countryId='{$this->countryId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($countryId="")
  {
    $sql = "DELETE FROM frk_country WHERE (countryId='{$this->countryId}')";
    $this->app->DB->Delete($sql);

    $this->countryId="";
    $this->name="";
  }

  public function Copy()
  {
    $this->countryId = "";
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

  function SetCountryid($value) { $this->countryId=$value; }
  function GetCountryid() { return $this->countryId; }
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }

}

?>
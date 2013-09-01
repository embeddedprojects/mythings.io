<?

class ObjGenAbrechnungen_Bezahlt
{

  private  $person;
  private  $jahr;
  private  $monat;
  private  $nummer;

  public $app;            //application object 

  public function ObjGenAbrechnungen_Bezahlt($app)
  {
    $this->app = $app;
  }

  public function Select($person, $jahr, $monat, $nummer)
  {
    if(is_numeric($person) && is_numeric($jahr))
      $result = $this->app->DB->SelectArr("SELECT * FROM abrechnungen_bezahlt WHERE (person = '$person' and jahr = '$jahr' and monat = '$monat' and nummer = '$nummer')");
    else
      return -1;

$result = $result[0];

    $this->person=$result[person];
    $this->jahr=$result[jahr];
    $this->monat=$result[monat];
    $this->nummer=$result[nummer];
  }

  public function Create()
  {
    $sql = "INSERT INTO abrechnungen_bezahlt (person,jahr,monat,nummer)
      VALUES('{$this->person}','{$this->jahr}','{$this->monat}','{$this->nummer}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->person) || !is_numeric($this->jahr))
      return -1;

    $sql = "UPDATE abrechnungen_bezahlt SET

      WHERE (person='{$this->person}' && jahr='{$this->jahr}' && monat='{$this->monat}' && nummer='{$this->nummer}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($person="" ,$jahr="" ,$monat="" ,$nummer="")
  {
    if(is_numeric($person) && is_numeric($jahr))
    {
      $this->person=$person;
      $this->jahr=$jahr;
    }
    else
      return -1;

    $sql = "DELETE FROM abrechnungen_bezahlt WHERE (person='{$this->person}' && jahr='{$this->jahr}' && monat='{$this->monat}' && nummer='{$this->nummer}')";
    $this->app->DB->Delete($sql);

    $this->person="";
    $this->jahr="";
    $this->monat="";
    $this->nummer="";
  }

  public function Copy()
  {
    $this->person = "";
    $this->jahr = "";
    $this->monat = "";
    $this->nummer = "";
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

  function SetPerson($value) { $this->person=$value; }
  function GetPerson() { return $this->person; }
  function SetJahr($value) { $this->jahr=$value; }
  function GetJahr() { return $this->jahr; }
  function SetMonat($value) { $this->monat=$value; }
  function GetMonat() { return $this->monat; }
  function SetNummer($value) { $this->nummer=$value; }
  function GetNummer() { return $this->nummer; }

}

?>
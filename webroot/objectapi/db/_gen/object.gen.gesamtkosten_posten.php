<?

class ObjGenGesamtkosten_Posten
{

  private  $veranstaltung;
  private  $gruppe;
  private  $art;
  private  $kosten;

  public $app;            //application object 

  public function ObjGenGesamtkosten_Posten($app)
  {
    $this->app = $app;
  }

  public function Select($veranstaltung, $gruppe, $art)
  {
    if(is_numeric($veranstaltung))
      $result = $this->app->DB->SelectArr("SELECT * FROM gesamtkosten_posten WHERE (veranstaltung = '$veranstaltung' and gruppe = '$gruppe' and art = '$art')");
    else
      return -1;

$result = $result[0];

    $this->veranstaltung=$result[veranstaltung];
    $this->gruppe=$result[gruppe];
    $this->art=$result[art];
    $this->kosten=$result[kosten];
  }

  public function Create()
  {
    $sql = "INSERT INTO gesamtkosten_posten (veranstaltung,gruppe,art,kosten)
      VALUES('{$this->veranstaltung}','{$this->gruppe}','{$this->art}','{$this->kosten}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->veranstaltung))
      return -1;

    $sql = "UPDATE gesamtkosten_posten SET
      kosten='{$this->kosten}'
      WHERE (veranstaltung='{$this->veranstaltung}' && gruppe='{$this->gruppe}' && art='{$this->art}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($veranstaltung="" ,$gruppe="" ,$art="")
  {
    if(is_numeric($veranstaltung))
    {
      $this->veranstaltung=$veranstaltung;
    }
    else
      return -1;

    $sql = "DELETE FROM gesamtkosten_posten WHERE (veranstaltung='{$this->veranstaltung}' && gruppe='{$this->gruppe}' && art='{$this->art}')";
    $this->app->DB->Delete($sql);

    $this->veranstaltung="";
    $this->gruppe="";
    $this->art="";
    $this->kosten="";
  }

  public function Copy()
  {
    $this->veranstaltung = "";
    $this->gruppe = "";
    $this->art = "";
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

  function SetVeranstaltung($value) { $this->veranstaltung=$value; }
  function GetVeranstaltung() { return $this->veranstaltung; }
  function SetGruppe($value) { $this->gruppe=$value; }
  function GetGruppe() { return $this->gruppe; }
  function SetArt($value) { $this->art=$value; }
  function GetArt() { return $this->art; }
  function SetKosten($value) { $this->kosten=$value; }
  function GetKosten() { return $this->kosten; }

}

?>
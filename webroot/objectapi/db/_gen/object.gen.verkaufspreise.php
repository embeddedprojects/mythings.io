<?

class ObjGenVerkaufspreise
{

  private  $id;
  private  $artikel;
  private  $bezeichnung;
  private  $kunde;
  private  $projekt;
  private  $preis;
  private  $ab_menge;
  private  $angelegt_am;
  private  $gueltig_bis;
  private  $bemerkung;
  private  $bearbeiter;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenVerkaufspreise($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM verkaufspreise WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->artikel=$result[artikel];
    $this->bezeichnung=$result[bezeichnung];
    $this->kunde=$result[kunde];
    $this->projekt=$result[projekt];
    $this->preis=$result[preis];
    $this->ab_menge=$result[ab_menge];
    $this->angelegt_am=$result[angelegt_am];
    $this->gueltig_bis=$result[gueltig_bis];
    $this->bemerkung=$result[bemerkung];
    $this->bearbeiter=$result[bearbeiter];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO verkaufspreise (id,artikel,bezeichnung,kunde,projekt,preis,ab_menge,angelegt_am,gueltig_bis,bemerkung,bearbeiter,logdatei)
      VALUES('','{$this->artikel}','{$this->bezeichnung}','{$this->kunde}','{$this->projekt}','{$this->preis}','{$this->ab_menge}','{$this->angelegt_am}','{$this->gueltig_bis}','{$this->bemerkung}','{$this->bearbeiter}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE verkaufspreise SET
      artikel='{$this->artikel}',
      bezeichnung='{$this->bezeichnung}',
      kunde='{$this->kunde}',
      projekt='{$this->projekt}',
      preis='{$this->preis}',
      ab_menge='{$this->ab_menge}',
      angelegt_am='{$this->angelegt_am}',
      gueltig_bis='{$this->gueltig_bis}',
      bemerkung='{$this->bemerkung}',
      bearbeiter='{$this->bearbeiter}',
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

    $sql = "DELETE FROM verkaufspreise WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->artikel="";
    $this->bezeichnung="";
    $this->kunde="";
    $this->projekt="";
    $this->preis="";
    $this->ab_menge="";
    $this->angelegt_am="";
    $this->gueltig_bis="";
    $this->bemerkung="";
    $this->bearbeiter="";
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
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetBezeichnung($value) { $this->bezeichnung=$value; }
  function GetBezeichnung() { return $this->bezeichnung; }
  function SetKunde($value) { $this->kunde=$value; }
  function GetKunde() { return $this->kunde; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetAb_Menge($value) { $this->ab_menge=$value; }
  function GetAb_Menge() { return $this->ab_menge; }
  function SetAngelegt_Am($value) { $this->angelegt_am=$value; }
  function GetAngelegt_Am() { return $this->angelegt_am; }
  function SetGueltig_Bis($value) { $this->gueltig_bis=$value; }
  function GetGueltig_Bis() { return $this->gueltig_bis; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
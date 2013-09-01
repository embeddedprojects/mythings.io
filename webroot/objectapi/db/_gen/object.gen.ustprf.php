<?

class ObjGenUstprf
{

  private  $id;
  private  $adresse;
  private  $firmenname;
  private  $ustid;
  private  $land;
  private  $ort;
  private  $plz;
  private  $rechtsform;
  private  $strasse;
  private  $status_online;
  private  $status_brief;
  private  $datum_online;
  private  $datum_brief;
  private  $bearbeiter;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenUstprf($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM ustprf WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->firmenname=$result[firmenname];
    $this->ustid=$result[ustid];
    $this->land=$result[land];
    $this->ort=$result[ort];
    $this->plz=$result[plz];
    $this->rechtsform=$result[rechtsform];
    $this->strasse=$result[strasse];
    $this->status_online=$result[status_online];
    $this->status_brief=$result[status_brief];
    $this->datum_online=$result[datum_online];
    $this->datum_brief=$result[datum_brief];
    $this->bearbeiter=$result[bearbeiter];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO ustprf (id,adresse,firmenname,ustid,land,ort,plz,rechtsform,strasse,status_online,status_brief,datum_online,datum_brief,bearbeiter,logdatei)
      VALUES('','{$this->adresse}','{$this->firmenname}','{$this->ustid}','{$this->land}','{$this->ort}','{$this->plz}','{$this->rechtsform}','{$this->strasse}','{$this->status_online}','{$this->status_brief}','{$this->datum_online}','{$this->datum_brief}','{$this->bearbeiter}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE ustprf SET
      adresse='{$this->adresse}',
      firmenname='{$this->firmenname}',
      ustid='{$this->ustid}',
      land='{$this->land}',
      ort='{$this->ort}',
      plz='{$this->plz}',
      rechtsform='{$this->rechtsform}',
      strasse='{$this->strasse}',
      status_online='{$this->status_online}',
      status_brief='{$this->status_brief}',
      datum_online='{$this->datum_online}',
      datum_brief='{$this->datum_brief}',
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

    $sql = "DELETE FROM ustprf WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->firmenname="";
    $this->ustid="";
    $this->land="";
    $this->ort="";
    $this->plz="";
    $this->rechtsform="";
    $this->strasse="";
    $this->status_online="";
    $this->status_brief="";
    $this->datum_online="";
    $this->datum_brief="";
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
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetFirmenname($value) { $this->firmenname=$value; }
  function GetFirmenname() { return $this->firmenname; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetRechtsform($value) { $this->rechtsform=$value; }
  function GetRechtsform() { return $this->rechtsform; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetStatus_Online($value) { $this->status_online=$value; }
  function GetStatus_Online() { return $this->status_online; }
  function SetStatus_Brief($value) { $this->status_brief=$value; }
  function GetStatus_Brief() { return $this->status_brief; }
  function SetDatum_Online($value) { $this->datum_online=$value; }
  function GetDatum_Online() { return $this->datum_online; }
  function SetDatum_Brief($value) { $this->datum_brief=$value; }
  function GetDatum_Brief() { return $this->datum_brief; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
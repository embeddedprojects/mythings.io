<?

class ObjGenAdresse
{

  private  $id;
  private  $typ;
  private  $marketingsperre;
  private  $sprache;
  private  $name;
  private  $vorname;
  private  $abteilung;
  private  $unterabteilung;
  private  $land;
  private  $strasse;
  private  $ort;
  private  $plz;
  private  $telefon;
  private  $telefax;
  private  $email;
  private  $ustid;
  private  $sonstiges;
  private  $adresszusatz;
  private  $steuer;
  private  $logdatei;
  private  $kundennummer;
  private  $lieferantennummer;
  private  $projekt;
  private  $firma;

  public $app;            //application object 

  public function ObjGenAdresse($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->typ=$result[typ];
    $this->marketingsperre=$result[marketingsperre];
    $this->sprache=$result[sprache];
    $this->name=$result[name];
    $this->vorname=$result[vorname];
    $this->abteilung=$result[abteilung];
    $this->unterabteilung=$result[unterabteilung];
    $this->land=$result[land];
    $this->strasse=$result[strasse];
    $this->ort=$result[ort];
    $this->plz=$result[plz];
    $this->telefon=$result[telefon];
    $this->telefax=$result[telefax];
    $this->email=$result[email];
    $this->ustid=$result[ustid];
    $this->sonstiges=$result[sonstiges];
    $this->adresszusatz=$result[adresszusatz];
    $this->steuer=$result[steuer];
    $this->logdatei=$result[logdatei];
    $this->kundennummer=$result[kundennummer];
    $this->lieferantennummer=$result[lieferantennummer];
    $this->projekt=$result[projekt];
    $this->firma=$result[firma];
  }

  public function Create()
  {
    $sql = "INSERT INTO adresse (id,typ,marketingsperre,sprache,name,vorname,abteilung,unterabteilung,land,strasse,ort,plz,telefon,telefax,email,ustid,sonstiges,adresszusatz,steuer,logdatei,kundennummer,lieferantennummer,projekt,firma)
      VALUES('','{$this->typ}','{$this->marketingsperre}','{$this->sprache}','{$this->name}','{$this->vorname}','{$this->abteilung}','{$this->unterabteilung}','{$this->land}','{$this->strasse}','{$this->ort}','{$this->plz}','{$this->telefon}','{$this->telefax}','{$this->email}','{$this->ustid}','{$this->sonstiges}','{$this->adresszusatz}','{$this->steuer}','{$this->logdatei}','{$this->kundennummer}','{$this->lieferantennummer}','{$this->projekt}','{$this->firma}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE adresse SET
      typ='{$this->typ}',
      marketingsperre='{$this->marketingsperre}',
      sprache='{$this->sprache}',
      name='{$this->name}',
      vorname='{$this->vorname}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      land='{$this->land}',
      strasse='{$this->strasse}',
      ort='{$this->ort}',
      plz='{$this->plz}',
      telefon='{$this->telefon}',
      telefax='{$this->telefax}',
      email='{$this->email}',
      ustid='{$this->ustid}',
      sonstiges='{$this->sonstiges}',
      adresszusatz='{$this->adresszusatz}',
      steuer='{$this->steuer}',
      logdatei='{$this->logdatei}',
      kundennummer='{$this->kundennummer}',
      lieferantennummer='{$this->lieferantennummer}',
      projekt='{$this->projekt}',
      firma='{$this->firma}'
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

    $sql = "DELETE FROM adresse WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->typ="";
    $this->marketingsperre="";
    $this->sprache="";
    $this->name="";
    $this->vorname="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->land="";
    $this->strasse="";
    $this->ort="";
    $this->plz="";
    $this->telefon="";
    $this->telefax="";
    $this->email="";
    $this->ustid="";
    $this->sonstiges="";
    $this->adresszusatz="";
    $this->steuer="";
    $this->logdatei="";
    $this->kundennummer="";
    $this->lieferantennummer="";
    $this->projekt="";
    $this->firma="";
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
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
  function SetMarketingsperre($value) { $this->marketingsperre=$value; }
  function GetMarketingsperre() { return $this->marketingsperre; }
  function SetSprache($value) { $this->sprache=$value; }
  function GetSprache() { return $this->sprache; }
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetVorname($value) { $this->vorname=$value; }
  function GetVorname() { return $this->vorname; }
  function SetAbteilung($value) { $this->abteilung=$value; }
  function GetAbteilung() { return $this->abteilung; }
  function SetUnterabteilung($value) { $this->unterabteilung=$value; }
  function GetUnterabteilung() { return $this->unterabteilung; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetTelefon($value) { $this->telefon=$value; }
  function GetTelefon() { return $this->telefon; }
  function SetTelefax($value) { $this->telefax=$value; }
  function GetTelefax() { return $this->telefax; }
  function SetEmail($value) { $this->email=$value; }
  function GetEmail() { return $this->email; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetAdresszusatz($value) { $this->adresszusatz=$value; }
  function GetAdresszusatz() { return $this->adresszusatz; }
  function SetSteuer($value) { $this->steuer=$value; }
  function GetSteuer() { return $this->steuer; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetKundennummer($value) { $this->kundennummer=$value; }
  function GetKundennummer() { return $this->kundennummer; }
  function SetLieferantennummer($value) { $this->lieferantennummer=$value; }
  function GetLieferantennummer() { return $this->lieferantennummer; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }

}

?>
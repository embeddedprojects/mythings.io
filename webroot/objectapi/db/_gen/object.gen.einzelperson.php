<?

class ObjGenEinzelperson
{

  private  $id;
  private  $vorname;
  private  $nachname;
  private  $strasse;
  private  $plz;
  private  $ort;
  private  $telefon;
  private  $mobiltelefon;
  private  $telefax;
  private  $email;
  private  $funktion;
  private  $extragage;
  private  $gruppe;
  private  $kontonummer;
  private  $institut;
  private  $kontoinhaber;
  private  $bankleitzahl;
  private  $notizen;

  public $app;            //application object 

  public function ObjGenEinzelperson($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM einzelperson WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->vorname=$result[vorname];
    $this->nachname=$result[nachname];
    $this->strasse=$result[strasse];
    $this->plz=$result[plz];
    $this->ort=$result[ort];
    $this->telefon=$result[telefon];
    $this->mobiltelefon=$result[mobiltelefon];
    $this->telefax=$result[telefax];
    $this->email=$result[email];
    $this->funktion=$result[funktion];
    $this->extragage=$result[extragage];
    $this->gruppe=$result[gruppe];
    $this->kontonummer=$result[kontonummer];
    $this->institut=$result[institut];
    $this->kontoinhaber=$result[kontoinhaber];
    $this->bankleitzahl=$result[bankleitzahl];
    $this->notizen=$result[notizen];
  }

  public function Create()
  {
    $sql = "INSERT INTO einzelperson (id,vorname,nachname,strasse,plz,ort,telefon,mobiltelefon,telefax,email,funktion,extragage,gruppe,kontonummer,institut,kontoinhaber,bankleitzahl,notizen)
      VALUES('','{$this->vorname}','{$this->nachname}','{$this->strasse}','{$this->plz}','{$this->ort}','{$this->telefon}','{$this->mobiltelefon}','{$this->telefax}','{$this->email}','{$this->funktion}','{$this->extragage}','{$this->gruppe}','{$this->kontonummer}','{$this->institut}','{$this->kontoinhaber}','{$this->bankleitzahl}','{$this->notizen}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE einzelperson SET
      vorname='{$this->vorname}',
      nachname='{$this->nachname}',
      strasse='{$this->strasse}',
      plz='{$this->plz}',
      ort='{$this->ort}',
      telefon='{$this->telefon}',
      mobiltelefon='{$this->mobiltelefon}',
      telefax='{$this->telefax}',
      email='{$this->email}',
      funktion='{$this->funktion}',
      extragage='{$this->extragage}',
      gruppe='{$this->gruppe}',
      kontonummer='{$this->kontonummer}',
      institut='{$this->institut}',
      kontoinhaber='{$this->kontoinhaber}',
      bankleitzahl='{$this->bankleitzahl}',
      notizen='{$this->notizen}'
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

    $sql = "DELETE FROM einzelperson WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->vorname="";
    $this->nachname="";
    $this->strasse="";
    $this->plz="";
    $this->ort="";
    $this->telefon="";
    $this->mobiltelefon="";
    $this->telefax="";
    $this->email="";
    $this->funktion="";
    $this->extragage="";
    $this->gruppe="";
    $this->kontonummer="";
    $this->institut="";
    $this->kontoinhaber="";
    $this->bankleitzahl="";
    $this->notizen="";
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
  function SetVorname($value) { $this->vorname=$value; }
  function GetVorname() { return $this->vorname; }
  function SetNachname($value) { $this->nachname=$value; }
  function GetNachname() { return $this->nachname; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetTelefon($value) { $this->telefon=$value; }
  function GetTelefon() { return $this->telefon; }
  function SetMobiltelefon($value) { $this->mobiltelefon=$value; }
  function GetMobiltelefon() { return $this->mobiltelefon; }
  function SetTelefax($value) { $this->telefax=$value; }
  function GetTelefax() { return $this->telefax; }
  function SetEmail($value) { $this->email=$value; }
  function GetEmail() { return $this->email; }
  function SetFunktion($value) { $this->funktion=$value; }
  function GetFunktion() { return $this->funktion; }
  function SetExtragage($value) { $this->extragage=$value; }
  function GetExtragage() { return $this->extragage; }
  function SetGruppe($value) { $this->gruppe=$value; }
  function GetGruppe() { return $this->gruppe; }
  function SetKontonummer($value) { $this->kontonummer=$value; }
  function GetKontonummer() { return $this->kontonummer; }
  function SetInstitut($value) { $this->institut=$value; }
  function GetInstitut() { return $this->institut; }
  function SetKontoinhaber($value) { $this->kontoinhaber=$value; }
  function GetKontoinhaber() { return $this->kontoinhaber; }
  function SetBankleitzahl($value) { $this->bankleitzahl=$value; }
  function GetBankleitzahl() { return $this->bankleitzahl; }
  function SetNotizen($value) { $this->notizen=$value; }
  function GetNotizen() { return $this->notizen; }

}

?>
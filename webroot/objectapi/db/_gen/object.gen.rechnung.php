<?

class ObjGenRechnung
{

  private  $id;
  private  $adresse;
  private  $soll;
  private  $ist;
  private  $datum;
  private  $status;
  private  $rechnungsnr;
  private  $rechnung;
  private  $zahlungserinnerung;
  private  $mahnung1;
  private  $mahnung2;
  private  $mahngeb1;
  private  $mahngeb2;
  private  $kundenadresse;
  private  $typ;
  private  $name;
  private  $vorname;
  private  $abteilung;
  private  $unterabteilung;
  private  $land;
  private  $strasse;
  private  $ort;
  private  $plz;
  private  $adresszusatz;
  private  $kundennummer;
  private  $ustid;
  private  $firmaname;
  private  $firmastrasse;
  private  $firmaplz;
  private  $firmaort;
  private  $firmaland;
  private  $firmatelefon;
  private  $firmatelefax;
  private  $firmabank;
  private  $firmakonto;
  private  $firmablz;
  private  $firmaiban;
  private  $firmaswift;
  private  $firmaustid;
  private  $firmazeile1;
  private  $firmazeile2;
  private  $firmazeile3;
  private  $firmazeile4;
  private  $ustprf;
  private  $steuerklasse;
  private  $sprache;
  private  $steuernummerabsender;
  private  $lieferdatum;
  private  $bearbeiter;
  private  $firma;
  private  $lastschrift;

  public $app;            //application object 

  public function ObjGenRechnung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM rechnung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->adresse=$result[adresse];
    $this->soll=$result[soll];
    $this->ist=$result[ist];
    $this->datum=$result[datum];
    $this->status=$result[status];
    $this->rechnungsnr=$result[rechnungsnr];
    $this->rechnung=$result[rechnung];
    $this->zahlungserinnerung=$result[zahlungserinnerung];
    $this->mahnung1=$result[mahnung1];
    $this->mahnung2=$result[mahnung2];
    $this->mahngeb1=$result[mahngeb1];
    $this->mahngeb2=$result[mahngeb2];
    $this->kundenadresse=$result[kundenadresse];
    $this->typ=$result[typ];
    $this->name=$result[name];
    $this->vorname=$result[vorname];
    $this->abteilung=$result[abteilung];
    $this->unterabteilung=$result[unterabteilung];
    $this->land=$result[land];
    $this->strasse=$result[strasse];
    $this->ort=$result[ort];
    $this->plz=$result[plz];
    $this->adresszusatz=$result[adresszusatz];
    $this->kundennummer=$result[kundennummer];
    $this->ustid=$result[ustid];
    $this->firmaname=$result[firmaname];
    $this->firmastrasse=$result[firmastrasse];
    $this->firmaplz=$result[firmaplz];
    $this->firmaort=$result[firmaort];
    $this->firmaland=$result[firmaland];
    $this->firmatelefon=$result[firmatelefon];
    $this->firmatelefax=$result[firmatelefax];
    $this->firmabank=$result[firmabank];
    $this->firmakonto=$result[firmakonto];
    $this->firmablz=$result[firmablz];
    $this->firmaiban=$result[firmaiban];
    $this->firmaswift=$result[firmaswift];
    $this->firmaustid=$result[firmaustid];
    $this->firmazeile1=$result[firmazeile1];
    $this->firmazeile2=$result[firmazeile2];
    $this->firmazeile3=$result[firmazeile3];
    $this->firmazeile4=$result[firmazeile4];
    $this->ustprf=$result[ustprf];
    $this->steuerklasse=$result[steuerklasse];
    $this->sprache=$result[sprache];
    $this->steuernummerabsender=$result[steuernummerabsender];
    $this->lieferdatum=$result[lieferdatum];
    $this->bearbeiter=$result[bearbeiter];
    $this->firma=$result[firma];
    $this->lastschrift=$result[lastschrift];
  }

  public function Create()
  {
    $sql = "INSERT INTO rechnung (id,adresse,soll,ist,datum,status,rechnungsnr,rechnung,zahlungserinnerung,mahnung1,mahnung2,mahngeb1,mahngeb2,kundenadresse,typ,name,vorname,abteilung,unterabteilung,land,strasse,ort,plz,adresszusatz,kundennummer,ustid,firmaname,firmastrasse,firmaplz,firmaort,firmaland,firmatelefon,firmatelefax,firmabank,firmakonto,firmablz,firmaiban,firmaswift,firmaustid,firmazeile1,firmazeile2,firmazeile3,firmazeile4,ustprf,steuerklasse,sprache,steuernummerabsender,lieferdatum,bearbeiter,firma,lastschrift)
      VALUES('','{$this->adresse}','{$this->soll}','{$this->ist}','{$this->datum}','{$this->status}','{$this->rechnungsnr}','{$this->rechnung}','{$this->zahlungserinnerung}','{$this->mahnung1}','{$this->mahnung2}','{$this->mahngeb1}','{$this->mahngeb2}','{$this->kundenadresse}','{$this->typ}','{$this->name}','{$this->vorname}','{$this->abteilung}','{$this->unterabteilung}','{$this->land}','{$this->strasse}','{$this->ort}','{$this->plz}','{$this->adresszusatz}','{$this->kundennummer}','{$this->ustid}','{$this->firmaname}','{$this->firmastrasse}','{$this->firmaplz}','{$this->firmaort}','{$this->firmaland}','{$this->firmatelefon}','{$this->firmatelefax}','{$this->firmabank}','{$this->firmakonto}','{$this->firmablz}','{$this->firmaiban}','{$this->firmaswift}','{$this->firmaustid}','{$this->firmazeile1}','{$this->firmazeile2}','{$this->firmazeile3}','{$this->firmazeile4}','{$this->ustprf}','{$this->steuerklasse}','{$this->sprache}','{$this->steuernummerabsender}','{$this->lieferdatum}','{$this->bearbeiter}','{$this->firma}','{$this->lastschrift}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE rechnung SET
      adresse='{$this->adresse}',
      soll='{$this->soll}',
      ist='{$this->ist}',
      datum='{$this->datum}',
      status='{$this->status}',
      rechnungsnr='{$this->rechnungsnr}',
      rechnung='{$this->rechnung}',
      zahlungserinnerung='{$this->zahlungserinnerung}',
      mahnung1='{$this->mahnung1}',
      mahnung2='{$this->mahnung2}',
      mahngeb1='{$this->mahngeb1}',
      mahngeb2='{$this->mahngeb2}',
      kundenadresse='{$this->kundenadresse}',
      typ='{$this->typ}',
      name='{$this->name}',
      vorname='{$this->vorname}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      land='{$this->land}',
      strasse='{$this->strasse}',
      ort='{$this->ort}',
      plz='{$this->plz}',
      adresszusatz='{$this->adresszusatz}',
      kundennummer='{$this->kundennummer}',
      ustid='{$this->ustid}',
      firmaname='{$this->firmaname}',
      firmastrasse='{$this->firmastrasse}',
      firmaplz='{$this->firmaplz}',
      firmaort='{$this->firmaort}',
      firmaland='{$this->firmaland}',
      firmatelefon='{$this->firmatelefon}',
      firmatelefax='{$this->firmatelefax}',
      firmabank='{$this->firmabank}',
      firmakonto='{$this->firmakonto}',
      firmablz='{$this->firmablz}',
      firmaiban='{$this->firmaiban}',
      firmaswift='{$this->firmaswift}',
      firmaustid='{$this->firmaustid}',
      firmazeile1='{$this->firmazeile1}',
      firmazeile2='{$this->firmazeile2}',
      firmazeile3='{$this->firmazeile3}',
      firmazeile4='{$this->firmazeile4}',
      ustprf='{$this->ustprf}',
      steuerklasse='{$this->steuerklasse}',
      sprache='{$this->sprache}',
      steuernummerabsender='{$this->steuernummerabsender}',
      lieferdatum='{$this->lieferdatum}',
      bearbeiter='{$this->bearbeiter}',
      firma='{$this->firma}',
      lastschrift='{$this->lastschrift}'
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

    $sql = "DELETE FROM rechnung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->adresse="";
    $this->soll="";
    $this->ist="";
    $this->datum="";
    $this->status="";
    $this->rechnungsnr="";
    $this->rechnung="";
    $this->zahlungserinnerung="";
    $this->mahnung1="";
    $this->mahnung2="";
    $this->mahngeb1="";
    $this->mahngeb2="";
    $this->kundenadresse="";
    $this->typ="";
    $this->name="";
    $this->vorname="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->land="";
    $this->strasse="";
    $this->ort="";
    $this->plz="";
    $this->adresszusatz="";
    $this->kundennummer="";
    $this->ustid="";
    $this->firmaname="";
    $this->firmastrasse="";
    $this->firmaplz="";
    $this->firmaort="";
    $this->firmaland="";
    $this->firmatelefon="";
    $this->firmatelefax="";
    $this->firmabank="";
    $this->firmakonto="";
    $this->firmablz="";
    $this->firmaiban="";
    $this->firmaswift="";
    $this->firmaustid="";
    $this->firmazeile1="";
    $this->firmazeile2="";
    $this->firmazeile3="";
    $this->firmazeile4="";
    $this->ustprf="";
    $this->steuerklasse="";
    $this->sprache="";
    $this->steuernummerabsender="";
    $this->lieferdatum="";
    $this->bearbeiter="";
    $this->firma="";
    $this->lastschrift="";
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
  function SetSoll($value) { $this->soll=$value; }
  function GetSoll() { return $this->soll; }
  function SetIst($value) { $this->ist=$value; }
  function GetIst() { return $this->ist; }
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetRechnungsnr($value) { $this->rechnungsnr=$value; }
  function GetRechnungsnr() { return $this->rechnungsnr; }
  function SetRechnung($value) { $this->rechnung=$value; }
  function GetRechnung() { return $this->rechnung; }
  function SetZahlungserinnerung($value) { $this->zahlungserinnerung=$value; }
  function GetZahlungserinnerung() { return $this->zahlungserinnerung; }
  function SetMahnung1($value) { $this->mahnung1=$value; }
  function GetMahnung1() { return $this->mahnung1; }
  function SetMahnung2($value) { $this->mahnung2=$value; }
  function GetMahnung2() { return $this->mahnung2; }
  function SetMahngeb1($value) { $this->mahngeb1=$value; }
  function GetMahngeb1() { return $this->mahngeb1; }
  function SetMahngeb2($value) { $this->mahngeb2=$value; }
  function GetMahngeb2() { return $this->mahngeb2; }
  function SetKundenadresse($value) { $this->kundenadresse=$value; }
  function GetKundenadresse() { return $this->kundenadresse; }
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
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
  function SetAdresszusatz($value) { $this->adresszusatz=$value; }
  function GetAdresszusatz() { return $this->adresszusatz; }
  function SetKundennummer($value) { $this->kundennummer=$value; }
  function GetKundennummer() { return $this->kundennummer; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetFirmaname($value) { $this->firmaname=$value; }
  function GetFirmaname() { return $this->firmaname; }
  function SetFirmastrasse($value) { $this->firmastrasse=$value; }
  function GetFirmastrasse() { return $this->firmastrasse; }
  function SetFirmaplz($value) { $this->firmaplz=$value; }
  function GetFirmaplz() { return $this->firmaplz; }
  function SetFirmaort($value) { $this->firmaort=$value; }
  function GetFirmaort() { return $this->firmaort; }
  function SetFirmaland($value) { $this->firmaland=$value; }
  function GetFirmaland() { return $this->firmaland; }
  function SetFirmatelefon($value) { $this->firmatelefon=$value; }
  function GetFirmatelefon() { return $this->firmatelefon; }
  function SetFirmatelefax($value) { $this->firmatelefax=$value; }
  function GetFirmatelefax() { return $this->firmatelefax; }
  function SetFirmabank($value) { $this->firmabank=$value; }
  function GetFirmabank() { return $this->firmabank; }
  function SetFirmakonto($value) { $this->firmakonto=$value; }
  function GetFirmakonto() { return $this->firmakonto; }
  function SetFirmablz($value) { $this->firmablz=$value; }
  function GetFirmablz() { return $this->firmablz; }
  function SetFirmaiban($value) { $this->firmaiban=$value; }
  function GetFirmaiban() { return $this->firmaiban; }
  function SetFirmaswift($value) { $this->firmaswift=$value; }
  function GetFirmaswift() { return $this->firmaswift; }
  function SetFirmaustid($value) { $this->firmaustid=$value; }
  function GetFirmaustid() { return $this->firmaustid; }
  function SetFirmazeile1($value) { $this->firmazeile1=$value; }
  function GetFirmazeile1() { return $this->firmazeile1; }
  function SetFirmazeile2($value) { $this->firmazeile2=$value; }
  function GetFirmazeile2() { return $this->firmazeile2; }
  function SetFirmazeile3($value) { $this->firmazeile3=$value; }
  function GetFirmazeile3() { return $this->firmazeile3; }
  function SetFirmazeile4($value) { $this->firmazeile4=$value; }
  function GetFirmazeile4() { return $this->firmazeile4; }
  function SetUstprf($value) { $this->ustprf=$value; }
  function GetUstprf() { return $this->ustprf; }
  function SetSteuerklasse($value) { $this->steuerklasse=$value; }
  function GetSteuerklasse() { return $this->steuerklasse; }
  function SetSprache($value) { $this->sprache=$value; }
  function GetSprache() { return $this->sprache; }
  function SetSteuernummerabsender($value) { $this->steuernummerabsender=$value; }
  function GetSteuernummerabsender() { return $this->steuernummerabsender; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetLastschrift($value) { $this->lastschrift=$value; }
  function GetLastschrift() { return $this->lastschrift; }

}

?>
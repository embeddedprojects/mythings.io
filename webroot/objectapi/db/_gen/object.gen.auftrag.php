<?

class ObjGenAuftrag
{

  private  $id;
  private  $neukunde;
  private  $bearbeiter;
  private  $autoversand;
  private  $datum;
  private  $abweichendelieferadresse;
  private  $status;
  private  $versandart;
  private  $projekt;
  private  $kostenstelle;
  private  $zahlungsweise;
  private  $zahlungsdaten;
  private  $kundeadressid;
  private  $typ;
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
  private  $liefertyp;
  private  $liefername;
  private  $liefervorname;
  private  $lieferabteilung;
  private  $lieferunterabteilung;
  private  $lieferland;
  private  $lieferstrasse;
  private  $lieferort;
  private  $lieferplz;
  private  $lieferadresszusatz;
  private  $keinporto;
  private  $logdatei;
  private  $autofreigabe;
  private  $freigabe;
  private  $vollstaendig;
  private  $nachbesserung;

  public $app;            //application object 

  public function ObjGenAuftrag($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->neukunde=$result[neukunde];
    $this->bearbeiter=$result[bearbeiter];
    $this->autoversand=$result[autoversand];
    $this->datum=$result[datum];
    $this->abweichendelieferadresse=$result[abweichendelieferadresse];
    $this->status=$result[status];
    $this->versandart=$result[versandart];
    $this->projekt=$result[projekt];
    $this->kostenstelle=$result[kostenstelle];
    $this->zahlungsweise=$result[zahlungsweise];
    $this->zahlungsdaten=$result[zahlungsdaten];
    $this->kundeadressid=$result[kundeadressid];
    $this->typ=$result[typ];
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
    $this->liefertyp=$result[liefertyp];
    $this->liefername=$result[liefername];
    $this->liefervorname=$result[liefervorname];
    $this->lieferabteilung=$result[lieferabteilung];
    $this->lieferunterabteilung=$result[lieferunterabteilung];
    $this->lieferland=$result[lieferland];
    $this->lieferstrasse=$result[lieferstrasse];
    $this->lieferort=$result[lieferort];
    $this->lieferplz=$result[lieferplz];
    $this->lieferadresszusatz=$result[lieferadresszusatz];
    $this->keinporto=$result[keinporto];
    $this->logdatei=$result[logdatei];
    $this->autofreigabe=$result[autofreigabe];
    $this->freigabe=$result[freigabe];
    $this->vollstaendig=$result[vollstaendig];
    $this->nachbesserung=$result[nachbesserung];
  }

  public function Create()
  {
    $sql = "INSERT INTO auftrag (id,neukunde,bearbeiter,autoversand,datum,abweichendelieferadresse,status,versandart,projekt,kostenstelle,zahlungsweise,zahlungsdaten,kundeadressid,typ,sprache,name,vorname,abteilung,unterabteilung,land,strasse,ort,plz,telefon,telefax,email,ustid,sonstiges,adresszusatz,steuer,liefertyp,liefername,liefervorname,lieferabteilung,lieferunterabteilung,lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,keinporto,logdatei,autofreigabe,freigabe,vollstaendig,nachbesserung)
      VALUES('','{$this->neukunde}','{$this->bearbeiter}','{$this->autoversand}','{$this->datum}','{$this->abweichendelieferadresse}','{$this->status}','{$this->versandart}','{$this->projekt}','{$this->kostenstelle}','{$this->zahlungsweise}','{$this->zahlungsdaten}','{$this->kundeadressid}','{$this->typ}','{$this->sprache}','{$this->name}','{$this->vorname}','{$this->abteilung}','{$this->unterabteilung}','{$this->land}','{$this->strasse}','{$this->ort}','{$this->plz}','{$this->telefon}','{$this->telefax}','{$this->email}','{$this->ustid}','{$this->sonstiges}','{$this->adresszusatz}','{$this->steuer}','{$this->liefertyp}','{$this->liefername}','{$this->liefervorname}','{$this->lieferabteilung}','{$this->lieferunterabteilung}','{$this->lieferland}','{$this->lieferstrasse}','{$this->lieferort}','{$this->lieferplz}','{$this->lieferadresszusatz}','{$this->keinporto}','{$this->logdatei}','{$this->autofreigabe}','{$this->freigabe}','{$this->vollstaendig}','{$this->nachbesserung}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE auftrag SET
      neukunde='{$this->neukunde}',
      bearbeiter='{$this->bearbeiter}',
      autoversand='{$this->autoversand}',
      datum='{$this->datum}',
      abweichendelieferadresse='{$this->abweichendelieferadresse}',
      status='{$this->status}',
      versandart='{$this->versandart}',
      projekt='{$this->projekt}',
      kostenstelle='{$this->kostenstelle}',
      zahlungsweise='{$this->zahlungsweise}',
      zahlungsdaten='{$this->zahlungsdaten}',
      kundeadressid='{$this->kundeadressid}',
      typ='{$this->typ}',
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
      liefertyp='{$this->liefertyp}',
      liefername='{$this->liefername}',
      liefervorname='{$this->liefervorname}',
      lieferabteilung='{$this->lieferabteilung}',
      lieferunterabteilung='{$this->lieferunterabteilung}',
      lieferland='{$this->lieferland}',
      lieferstrasse='{$this->lieferstrasse}',
      lieferort='{$this->lieferort}',
      lieferplz='{$this->lieferplz}',
      lieferadresszusatz='{$this->lieferadresszusatz}',
      keinporto='{$this->keinporto}',
      logdatei='{$this->logdatei}',
      autofreigabe='{$this->autofreigabe}',
      freigabe='{$this->freigabe}',
      vollstaendig='{$this->vollstaendig}',
      nachbesserung='{$this->nachbesserung}'
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

    $sql = "DELETE FROM auftrag WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->neukunde="";
    $this->bearbeiter="";
    $this->autoversand="";
    $this->datum="";
    $this->abweichendelieferadresse="";
    $this->status="";
    $this->versandart="";
    $this->projekt="";
    $this->kostenstelle="";
    $this->zahlungsweise="";
    $this->zahlungsdaten="";
    $this->kundeadressid="";
    $this->typ="";
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
    $this->liefertyp="";
    $this->liefername="";
    $this->liefervorname="";
    $this->lieferabteilung="";
    $this->lieferunterabteilung="";
    $this->lieferland="";
    $this->lieferstrasse="";
    $this->lieferort="";
    $this->lieferplz="";
    $this->lieferadresszusatz="";
    $this->keinporto="";
    $this->logdatei="";
    $this->autofreigabe="";
    $this->freigabe="";
    $this->vollstaendig="";
    $this->nachbesserung="";
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
  function SetNeukunde($value) { $this->neukunde=$value; }
  function GetNeukunde() { return $this->neukunde; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetAutoversand($value) { $this->autoversand=$value; }
  function GetAutoversand() { return $this->autoversand; }
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetAbweichendelieferadresse($value) { $this->abweichendelieferadresse=$value; }
  function GetAbweichendelieferadresse() { return $this->abweichendelieferadresse; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetVersandart($value) { $this->versandart=$value; }
  function GetVersandart() { return $this->versandart; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetKostenstelle($value) { $this->kostenstelle=$value; }
  function GetKostenstelle() { return $this->kostenstelle; }
  function SetZahlungsweise($value) { $this->zahlungsweise=$value; }
  function GetZahlungsweise() { return $this->zahlungsweise; }
  function SetZahlungsdaten($value) { $this->zahlungsdaten=$value; }
  function GetZahlungsdaten() { return $this->zahlungsdaten; }
  function SetKundeadressid($value) { $this->kundeadressid=$value; }
  function GetKundeadressid() { return $this->kundeadressid; }
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
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
  function SetLiefertyp($value) { $this->liefertyp=$value; }
  function GetLiefertyp() { return $this->liefertyp; }
  function SetLiefername($value) { $this->liefername=$value; }
  function GetLiefername() { return $this->liefername; }
  function SetLiefervorname($value) { $this->liefervorname=$value; }
  function GetLiefervorname() { return $this->liefervorname; }
  function SetLieferabteilung($value) { $this->lieferabteilung=$value; }
  function GetLieferabteilung() { return $this->lieferabteilung; }
  function SetLieferunterabteilung($value) { $this->lieferunterabteilung=$value; }
  function GetLieferunterabteilung() { return $this->lieferunterabteilung; }
  function SetLieferland($value) { $this->lieferland=$value; }
  function GetLieferland() { return $this->lieferland; }
  function SetLieferstrasse($value) { $this->lieferstrasse=$value; }
  function GetLieferstrasse() { return $this->lieferstrasse; }
  function SetLieferort($value) { $this->lieferort=$value; }
  function GetLieferort() { return $this->lieferort; }
  function SetLieferplz($value) { $this->lieferplz=$value; }
  function GetLieferplz() { return $this->lieferplz; }
  function SetLieferadresszusatz($value) { $this->lieferadresszusatz=$value; }
  function GetLieferadresszusatz() { return $this->lieferadresszusatz; }
  function SetKeinporto($value) { $this->keinporto=$value; }
  function GetKeinporto() { return $this->keinporto; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetAutofreigabe($value) { $this->autofreigabe=$value; }
  function GetAutofreigabe() { return $this->autofreigabe; }
  function SetFreigabe($value) { $this->freigabe=$value; }
  function GetFreigabe() { return $this->freigabe; }
  function SetVollstaendig($value) { $this->vollstaendig=$value; }
  function GetVollstaendig() { return $this->vollstaendig; }
  function SetNachbesserung($value) { $this->nachbesserung=$value; }
  function GetNachbesserung() { return $this->nachbesserung; }

}

?>
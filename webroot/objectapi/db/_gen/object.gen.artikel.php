<?

class ObjGenArtikel
{

  private  $id;
  private  $typ;
  private  $nummer;
  private  $aktiv;
  private  $warengruppe;
  private  $name_de;
  private  $name_en;
  private  $kurztext_de;
  private  $kurztext_en;
  private  $beschreibung_de;
  private  $beschreibung_en;
  private  $standardbild;
  private  $herstellerlink;
  private  $teilbar;
  private  $nteile;
  private  $seriennummern;
  private  $standardlager;
  private  $lieferzeit;
  private  $sonstiges;
  private  $gewicht;
  private  $endmontage;
  private  $funktionstest;
  private  $artikelcheckliste;
  private  $stueckliste;
  private  $barcode;
  private  $hinzugefuegt;
  private  $pcbdecal;
  private  $lagerartikel;
  private  $chargenverwaltung;
  private  $provisionsartikel;
  private  $gesperrt;
  private  $sperrgrund;
  private  $gueltigbis;
  private  $umsatzsteuer;
  private  $klasse;
  private  $lieferant;
  private  $shopartikel;
  private  $unishopartikel;
  private  $firma;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenArtikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->typ=$result[typ];
    $this->nummer=$result[nummer];
    $this->aktiv=$result[aktiv];
    $this->warengruppe=$result[warengruppe];
    $this->name_de=$result[name_de];
    $this->name_en=$result[name_en];
    $this->kurztext_de=$result[kurztext_de];
    $this->kurztext_en=$result[kurztext_en];
    $this->beschreibung_de=$result[beschreibung_de];
    $this->beschreibung_en=$result[beschreibung_en];
    $this->standardbild=$result[standardbild];
    $this->herstellerlink=$result[herstellerlink];
    $this->teilbar=$result[teilbar];
    $this->nteile=$result[nteile];
    $this->seriennummern=$result[seriennummern];
    $this->standardlager=$result[standardlager];
    $this->lieferzeit=$result[lieferzeit];
    $this->sonstiges=$result[sonstiges];
    $this->gewicht=$result[gewicht];
    $this->endmontage=$result[endmontage];
    $this->funktionstest=$result[funktionstest];
    $this->artikelcheckliste=$result[artikelcheckliste];
    $this->stueckliste=$result[stueckliste];
    $this->barcode=$result[barcode];
    $this->hinzugefuegt=$result[hinzugefuegt];
    $this->pcbdecal=$result[pcbdecal];
    $this->lagerartikel=$result[lagerartikel];
    $this->chargenverwaltung=$result[chargenverwaltung];
    $this->provisionsartikel=$result[provisionsartikel];
    $this->gesperrt=$result[gesperrt];
    $this->sperrgrund=$result[sperrgrund];
    $this->gueltigbis=$result[gueltigbis];
    $this->umsatzsteuer=$result[umsatzsteuer];
    $this->klasse=$result[klasse];
    $this->lieferant=$result[lieferant];
    $this->shopartikel=$result[shopartikel];
    $this->unishopartikel=$result[unishopartikel];
    $this->firma=$result[firma];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO artikel (id,typ,nummer,aktiv,warengruppe,name_de,name_en,kurztext_de,kurztext_en,beschreibung_de,beschreibung_en,standardbild,herstellerlink,teilbar,nteile,seriennummern,standardlager,lieferzeit,sonstiges,gewicht,endmontage,funktionstest,artikelcheckliste,stueckliste,barcode,hinzugefuegt,pcbdecal,lagerartikel,chargenverwaltung,provisionsartikel,gesperrt,sperrgrund,gueltigbis,umsatzsteuer,klasse,lieferant,shopartikel,unishopartikel,firma,logdatei)
      VALUES('','{$this->typ}','{$this->nummer}','{$this->aktiv}','{$this->warengruppe}','{$this->name_de}','{$this->name_en}','{$this->kurztext_de}','{$this->kurztext_en}','{$this->beschreibung_de}','{$this->beschreibung_en}','{$this->standardbild}','{$this->herstellerlink}','{$this->teilbar}','{$this->nteile}','{$this->seriennummern}','{$this->standardlager}','{$this->lieferzeit}','{$this->sonstiges}','{$this->gewicht}','{$this->endmontage}','{$this->funktionstest}','{$this->artikelcheckliste}','{$this->stueckliste}','{$this->barcode}','{$this->hinzugefuegt}','{$this->pcbdecal}','{$this->lagerartikel}','{$this->chargenverwaltung}','{$this->provisionsartikel}','{$this->gesperrt}','{$this->sperrgrund}','{$this->gueltigbis}','{$this->umsatzsteuer}','{$this->klasse}','{$this->lieferant}','{$this->shopartikel}','{$this->unishopartikel}','{$this->firma}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE artikel SET
      typ='{$this->typ}',
      nummer='{$this->nummer}',
      aktiv='{$this->aktiv}',
      warengruppe='{$this->warengruppe}',
      name_de='{$this->name_de}',
      name_en='{$this->name_en}',
      kurztext_de='{$this->kurztext_de}',
      kurztext_en='{$this->kurztext_en}',
      beschreibung_de='{$this->beschreibung_de}',
      beschreibung_en='{$this->beschreibung_en}',
      standardbild='{$this->standardbild}',
      herstellerlink='{$this->herstellerlink}',
      teilbar='{$this->teilbar}',
      nteile='{$this->nteile}',
      seriennummern='{$this->seriennummern}',
      standardlager='{$this->standardlager}',
      lieferzeit='{$this->lieferzeit}',
      sonstiges='{$this->sonstiges}',
      gewicht='{$this->gewicht}',
      endmontage='{$this->endmontage}',
      funktionstest='{$this->funktionstest}',
      artikelcheckliste='{$this->artikelcheckliste}',
      stueckliste='{$this->stueckliste}',
      barcode='{$this->barcode}',
      hinzugefuegt='{$this->hinzugefuegt}',
      pcbdecal='{$this->pcbdecal}',
      lagerartikel='{$this->lagerartikel}',
      chargenverwaltung='{$this->chargenverwaltung}',
      provisionsartikel='{$this->provisionsartikel}',
      gesperrt='{$this->gesperrt}',
      sperrgrund='{$this->sperrgrund}',
      gueltigbis='{$this->gueltigbis}',
      umsatzsteuer='{$this->umsatzsteuer}',
      klasse='{$this->klasse}',
      lieferant='{$this->lieferant}',
      shopartikel='{$this->shopartikel}',
      unishopartikel='{$this->unishopartikel}',
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

    $sql = "DELETE FROM artikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->typ="";
    $this->nummer="";
    $this->aktiv="";
    $this->warengruppe="";
    $this->name_de="";
    $this->name_en="";
    $this->kurztext_de="";
    $this->kurztext_en="";
    $this->beschreibung_de="";
    $this->beschreibung_en="";
    $this->standardbild="";
    $this->herstellerlink="";
    $this->teilbar="";
    $this->nteile="";
    $this->seriennummern="";
    $this->standardlager="";
    $this->lieferzeit="";
    $this->sonstiges="";
    $this->gewicht="";
    $this->endmontage="";
    $this->funktionstest="";
    $this->artikelcheckliste="";
    $this->stueckliste="";
    $this->barcode="";
    $this->hinzugefuegt="";
    $this->pcbdecal="";
    $this->lagerartikel="";
    $this->chargenverwaltung="";
    $this->provisionsartikel="";
    $this->gesperrt="";
    $this->sperrgrund="";
    $this->gueltigbis="";
    $this->umsatzsteuer="";
    $this->klasse="";
    $this->lieferant="";
    $this->shopartikel="";
    $this->unishopartikel="";
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
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
  function SetNummer($value) { $this->nummer=$value; }
  function GetNummer() { return $this->nummer; }
  function SetAktiv($value) { $this->aktiv=$value; }
  function GetAktiv() { return $this->aktiv; }
  function SetWarengruppe($value) { $this->warengruppe=$value; }
  function GetWarengruppe() { return $this->warengruppe; }
  function SetName_De($value) { $this->name_de=$value; }
  function GetName_De() { return $this->name_de; }
  function SetName_En($value) { $this->name_en=$value; }
  function GetName_En() { return $this->name_en; }
  function SetKurztext_De($value) { $this->kurztext_de=$value; }
  function GetKurztext_De() { return $this->kurztext_de; }
  function SetKurztext_En($value) { $this->kurztext_en=$value; }
  function GetKurztext_En() { return $this->kurztext_en; }
  function SetBeschreibung_De($value) { $this->beschreibung_de=$value; }
  function GetBeschreibung_De() { return $this->beschreibung_de; }
  function SetBeschreibung_En($value) { $this->beschreibung_en=$value; }
  function GetBeschreibung_En() { return $this->beschreibung_en; }
  function SetStandardbild($value) { $this->standardbild=$value; }
  function GetStandardbild() { return $this->standardbild; }
  function SetHerstellerlink($value) { $this->herstellerlink=$value; }
  function GetHerstellerlink() { return $this->herstellerlink; }
  function SetTeilbar($value) { $this->teilbar=$value; }
  function GetTeilbar() { return $this->teilbar; }
  function SetNteile($value) { $this->nteile=$value; }
  function GetNteile() { return $this->nteile; }
  function SetSeriennummern($value) { $this->seriennummern=$value; }
  function GetSeriennummern() { return $this->seriennummern; }
  function SetStandardlager($value) { $this->standardlager=$value; }
  function GetStandardlager() { return $this->standardlager; }
  function SetLieferzeit($value) { $this->lieferzeit=$value; }
  function GetLieferzeit() { return $this->lieferzeit; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetGewicht($value) { $this->gewicht=$value; }
  function GetGewicht() { return $this->gewicht; }
  function SetEndmontage($value) { $this->endmontage=$value; }
  function GetEndmontage() { return $this->endmontage; }
  function SetFunktionstest($value) { $this->funktionstest=$value; }
  function GetFunktionstest() { return $this->funktionstest; }
  function SetArtikelcheckliste($value) { $this->artikelcheckliste=$value; }
  function GetArtikelcheckliste() { return $this->artikelcheckliste; }
  function SetStueckliste($value) { $this->stueckliste=$value; }
  function GetStueckliste() { return $this->stueckliste; }
  function SetBarcode($value) { $this->barcode=$value; }
  function GetBarcode() { return $this->barcode; }
  function SetHinzugefuegt($value) { $this->hinzugefuegt=$value; }
  function GetHinzugefuegt() { return $this->hinzugefuegt; }
  function SetPcbdecal($value) { $this->pcbdecal=$value; }
  function GetPcbdecal() { return $this->pcbdecal; }
  function SetLagerartikel($value) { $this->lagerartikel=$value; }
  function GetLagerartikel() { return $this->lagerartikel; }
  function SetChargenverwaltung($value) { $this->chargenverwaltung=$value; }
  function GetChargenverwaltung() { return $this->chargenverwaltung; }
  function SetProvisionsartikel($value) { $this->provisionsartikel=$value; }
  function GetProvisionsartikel() { return $this->provisionsartikel; }
  function SetGesperrt($value) { $this->gesperrt=$value; }
  function GetGesperrt() { return $this->gesperrt; }
  function SetSperrgrund($value) { $this->sperrgrund=$value; }
  function GetSperrgrund() { return $this->sperrgrund; }
  function SetGueltigbis($value) { $this->gueltigbis=$value; }
  function GetGueltigbis() { return $this->gueltigbis; }
  function SetUmsatzsteuer($value) { $this->umsatzsteuer=$value; }
  function GetUmsatzsteuer() { return $this->umsatzsteuer; }
  function SetKlasse($value) { $this->klasse=$value; }
  function GetKlasse() { return $this->klasse; }
  function SetLieferant($value) { $this->lieferant=$value; }
  function GetLieferant() { return $this->lieferant; }
  function SetShopartikel($value) { $this->shopartikel=$value; }
  function GetShopartikel() { return $this->shopartikel; }
  function SetUnishopartikel($value) { $this->unishopartikel=$value; }
  function GetUnishopartikel() { return $this->unishopartikel; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
<?

class ObjGenEinkaufspreise
{

  private  $id;
  private  $artikel;
  private  $adresse;
  private  $objekt;
  private  $parameter;
  private  $preis;
  private  $waehrung;
  private  $ab_menge;
  private  $vpe;
  private  $preis_anfrage_vom;
  private  $gueltig_bis;
  private  $lieferzeit_standard;
  private  $lieferzeit_aktuell;
  private  $lager_lieferant;
  private  $datum_lagerlieferant;
  private  $bestellnummer;
  private  $bezeichnunglieferant;
  private  $sicherheitslager;
  private  $bemerkung;
  private  $bearbeiter;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenEinkaufspreise($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM einkaufspreise WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->artikel=$result[artikel];
    $this->adresse=$result[adresse];
    $this->objekt=$result[objekt];
    $this->parameter=$result[parameter];
    $this->preis=$result[preis];
    $this->waehrung=$result[waehrung];
    $this->ab_menge=$result[ab_menge];
    $this->vpe=$result[vpe];
    $this->preis_anfrage_vom=$result[preis_anfrage_vom];
    $this->gueltig_bis=$result[gueltig_bis];
    $this->lieferzeit_standard=$result[lieferzeit_standard];
    $this->lieferzeit_aktuell=$result[lieferzeit_aktuell];
    $this->lager_lieferant=$result[lager_lieferant];
    $this->datum_lagerlieferant=$result[datum_lagerlieferant];
    $this->bestellnummer=$result[bestellnummer];
    $this->bezeichnunglieferant=$result[bezeichnunglieferant];
    $this->sicherheitslager=$result[sicherheitslager];
    $this->bemerkung=$result[bemerkung];
    $this->bearbeiter=$result[bearbeiter];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO einkaufspreise (id,artikel,adresse,objekt,parameter,preis,waehrung,ab_menge,vpe,preis_anfrage_vom,gueltig_bis,lieferzeit_standard,lieferzeit_aktuell,lager_lieferant,datum_lagerlieferant,bestellnummer,bezeichnunglieferant,sicherheitslager,bemerkung,bearbeiter,logdatei)
      VALUES('','{$this->artikel}','{$this->adresse}','{$this->objekt}','{$this->parameter}','{$this->preis}','{$this->waehrung}','{$this->ab_menge}','{$this->vpe}','{$this->preis_anfrage_vom}','{$this->gueltig_bis}','{$this->lieferzeit_standard}','{$this->lieferzeit_aktuell}','{$this->lager_lieferant}','{$this->datum_lagerlieferant}','{$this->bestellnummer}','{$this->bezeichnunglieferant}','{$this->sicherheitslager}','{$this->bemerkung}','{$this->bearbeiter}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE einkaufspreise SET
      artikel='{$this->artikel}',
      adresse='{$this->adresse}',
      objekt='{$this->objekt}',
      parameter='{$this->parameter}',
      preis='{$this->preis}',
      waehrung='{$this->waehrung}',
      ab_menge='{$this->ab_menge}',
      vpe='{$this->vpe}',
      preis_anfrage_vom='{$this->preis_anfrage_vom}',
      gueltig_bis='{$this->gueltig_bis}',
      lieferzeit_standard='{$this->lieferzeit_standard}',
      lieferzeit_aktuell='{$this->lieferzeit_aktuell}',
      lager_lieferant='{$this->lager_lieferant}',
      datum_lagerlieferant='{$this->datum_lagerlieferant}',
      bestellnummer='{$this->bestellnummer}',
      bezeichnunglieferant='{$this->bezeichnunglieferant}',
      sicherheitslager='{$this->sicherheitslager}',
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

    $sql = "DELETE FROM einkaufspreise WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->artikel="";
    $this->adresse="";
    $this->objekt="";
    $this->parameter="";
    $this->preis="";
    $this->waehrung="";
    $this->ab_menge="";
    $this->vpe="";
    $this->preis_anfrage_vom="";
    $this->gueltig_bis="";
    $this->lieferzeit_standard="";
    $this->lieferzeit_aktuell="";
    $this->lager_lieferant="";
    $this->datum_lagerlieferant="";
    $this->bestellnummer="";
    $this->bezeichnunglieferant="";
    $this->sicherheitslager="";
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
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetObjekt($value) { $this->objekt=$value; }
  function GetObjekt() { return $this->objekt; }
  function SetParameter($value) { $this->parameter=$value; }
  function GetParameter() { return $this->parameter; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetWaehrung($value) { $this->waehrung=$value; }
  function GetWaehrung() { return $this->waehrung; }
  function SetAb_Menge($value) { $this->ab_menge=$value; }
  function GetAb_Menge() { return $this->ab_menge; }
  function SetVpe($value) { $this->vpe=$value; }
  function GetVpe() { return $this->vpe; }
  function SetPreis_Anfrage_Vom($value) { $this->preis_anfrage_vom=$value; }
  function GetPreis_Anfrage_Vom() { return $this->preis_anfrage_vom; }
  function SetGueltig_Bis($value) { $this->gueltig_bis=$value; }
  function GetGueltig_Bis() { return $this->gueltig_bis; }
  function SetLieferzeit_Standard($value) { $this->lieferzeit_standard=$value; }
  function GetLieferzeit_Standard() { return $this->lieferzeit_standard; }
  function SetLieferzeit_Aktuell($value) { $this->lieferzeit_aktuell=$value; }
  function GetLieferzeit_Aktuell() { return $this->lieferzeit_aktuell; }
  function SetLager_Lieferant($value) { $this->lager_lieferant=$value; }
  function GetLager_Lieferant() { return $this->lager_lieferant; }
  function SetDatum_Lagerlieferant($value) { $this->datum_lagerlieferant=$value; }
  function GetDatum_Lagerlieferant() { return $this->datum_lagerlieferant; }
  function SetBestellnummer($value) { $this->bestellnummer=$value; }
  function GetBestellnummer() { return $this->bestellnummer; }
  function SetBezeichnunglieferant($value) { $this->bezeichnunglieferant=$value; }
  function GetBezeichnunglieferant() { return $this->bezeichnunglieferant; }
  function SetSicherheitslager($value) { $this->sicherheitslager=$value; }
  function GetSicherheitslager() { return $this->sicherheitslager; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
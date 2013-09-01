<?

class ObjGenAuftrag_Artikel
{

  private  $id;
  private  $auftrag;
  private  $artikel;
  private  $menge;
  private  $preis;
  private  $rabatt;
  private  $versendet;
  private  $seriennummer;
  private  $endmontage;
  private  $artikelcheckliste;
  private  $funktionstest;
  private  $chargenverwaltung;
  private  $lager;
  private  $position;
  private  $abgerechnet;
  private  $startdatum;
  private  $abgerechnetbis;
  private  $wiederholend;
  private  $zahlzyklus;
  private  $abgrechnetam;
  private  $rechnung;
  private  $kostenstelle;
  private  $adresse;
  private  $status;
  private  $geliefert;
  private  $geliefertam;
  private  $bemerkung;
  private  $logdatei;

  public $app;            //application object 

  public function ObjGenAuftrag_Artikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM auftrag_artikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->auftrag=$result[auftrag];
    $this->artikel=$result[artikel];
    $this->menge=$result[menge];
    $this->preis=$result[preis];
    $this->rabatt=$result[rabatt];
    $this->versendet=$result[versendet];
    $this->seriennummer=$result[seriennummer];
    $this->endmontage=$result[endmontage];
    $this->artikelcheckliste=$result[artikelcheckliste];
    $this->funktionstest=$result[funktionstest];
    $this->chargenverwaltung=$result[chargenverwaltung];
    $this->lager=$result[lager];
    $this->position=$result[position];
    $this->abgerechnet=$result[abgerechnet];
    $this->startdatum=$result[startdatum];
    $this->abgerechnetbis=$result[abgerechnetbis];
    $this->wiederholend=$result[wiederholend];
    $this->zahlzyklus=$result[zahlzyklus];
    $this->abgrechnetam=$result[abgrechnetam];
    $this->rechnung=$result[rechnung];
    $this->kostenstelle=$result[kostenstelle];
    $this->adresse=$result[adresse];
    $this->status=$result[status];
    $this->geliefert=$result[geliefert];
    $this->geliefertam=$result[geliefertam];
    $this->bemerkung=$result[bemerkung];
    $this->logdatei=$result[logdatei];
  }

  public function Create()
  {
    $sql = "INSERT INTO auftrag_artikel (id,auftrag,artikel,menge,preis,rabatt,versendet,seriennummer,endmontage,artikelcheckliste,funktionstest,chargenverwaltung,lager,position,abgerechnet,startdatum,abgerechnetbis,wiederholend,zahlzyklus,abgrechnetam,rechnung,kostenstelle,adresse,status,geliefert,geliefertam,bemerkung,logdatei)
      VALUES('','{$this->auftrag}','{$this->artikel}','{$this->menge}','{$this->preis}','{$this->rabatt}','{$this->versendet}','{$this->seriennummer}','{$this->endmontage}','{$this->artikelcheckliste}','{$this->funktionstest}','{$this->chargenverwaltung}','{$this->lager}','{$this->position}','{$this->abgerechnet}','{$this->startdatum}','{$this->abgerechnetbis}','{$this->wiederholend}','{$this->zahlzyklus}','{$this->abgrechnetam}','{$this->rechnung}','{$this->kostenstelle}','{$this->adresse}','{$this->status}','{$this->geliefert}','{$this->geliefertam}','{$this->bemerkung}','{$this->logdatei}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE auftrag_artikel SET
      auftrag='{$this->auftrag}',
      artikel='{$this->artikel}',
      menge='{$this->menge}',
      preis='{$this->preis}',
      rabatt='{$this->rabatt}',
      versendet='{$this->versendet}',
      seriennummer='{$this->seriennummer}',
      endmontage='{$this->endmontage}',
      artikelcheckliste='{$this->artikelcheckliste}',
      funktionstest='{$this->funktionstest}',
      chargenverwaltung='{$this->chargenverwaltung}',
      lager='{$this->lager}',
      position='{$this->position}',
      abgerechnet='{$this->abgerechnet}',
      startdatum='{$this->startdatum}',
      abgerechnetbis='{$this->abgerechnetbis}',
      wiederholend='{$this->wiederholend}',
      zahlzyklus='{$this->zahlzyklus}',
      abgrechnetam='{$this->abgrechnetam}',
      rechnung='{$this->rechnung}',
      kostenstelle='{$this->kostenstelle}',
      adresse='{$this->adresse}',
      status='{$this->status}',
      geliefert='{$this->geliefert}',
      geliefertam='{$this->geliefertam}',
      bemerkung='{$this->bemerkung}',
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

    $sql = "DELETE FROM auftrag_artikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->auftrag="";
    $this->artikel="";
    $this->menge="";
    $this->preis="";
    $this->rabatt="";
    $this->versendet="";
    $this->seriennummer="";
    $this->endmontage="";
    $this->artikelcheckliste="";
    $this->funktionstest="";
    $this->chargenverwaltung="";
    $this->lager="";
    $this->position="";
    $this->abgerechnet="";
    $this->startdatum="";
    $this->abgerechnetbis="";
    $this->wiederholend="";
    $this->zahlzyklus="";
    $this->abgrechnetam="";
    $this->rechnung="";
    $this->kostenstelle="";
    $this->adresse="";
    $this->status="";
    $this->geliefert="";
    $this->geliefertam="";
    $this->bemerkung="";
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
  function SetAuftrag($value) { $this->auftrag=$value; }
  function GetAuftrag() { return $this->auftrag; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetVersendet($value) { $this->versendet=$value; }
  function GetVersendet() { return $this->versendet; }
  function SetSeriennummer($value) { $this->seriennummer=$value; }
  function GetSeriennummer() { return $this->seriennummer; }
  function SetEndmontage($value) { $this->endmontage=$value; }
  function GetEndmontage() { return $this->endmontage; }
  function SetArtikelcheckliste($value) { $this->artikelcheckliste=$value; }
  function GetArtikelcheckliste() { return $this->artikelcheckliste; }
  function SetFunktionstest($value) { $this->funktionstest=$value; }
  function GetFunktionstest() { return $this->funktionstest; }
  function SetChargenverwaltung($value) { $this->chargenverwaltung=$value; }
  function GetChargenverwaltung() { return $this->chargenverwaltung; }
  function SetLager($value) { $this->lager=$value; }
  function GetLager() { return $this->lager; }
  function SetPosition($value) { $this->position=$value; }
  function GetPosition() { return $this->position; }
  function SetAbgerechnet($value) { $this->abgerechnet=$value; }
  function GetAbgerechnet() { return $this->abgerechnet; }
  function SetStartdatum($value) { $this->startdatum=$value; }
  function GetStartdatum() { return $this->startdatum; }
  function SetAbgerechnetbis($value) { $this->abgerechnetbis=$value; }
  function GetAbgerechnetbis() { return $this->abgerechnetbis; }
  function SetWiederholend($value) { $this->wiederholend=$value; }
  function GetWiederholend() { return $this->wiederholend; }
  function SetZahlzyklus($value) { $this->zahlzyklus=$value; }
  function GetZahlzyklus() { return $this->zahlzyklus; }
  function SetAbgrechnetam($value) { $this->abgrechnetam=$value; }
  function GetAbgrechnetam() { return $this->abgrechnetam; }
  function SetRechnung($value) { $this->rechnung=$value; }
  function GetRechnung() { return $this->rechnung; }
  function SetKostenstelle($value) { $this->kostenstelle=$value; }
  function GetKostenstelle() { return $this->kostenstelle; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetGeliefert($value) { $this->geliefert=$value; }
  function GetGeliefert() { return $this->geliefert; }
  function SetGeliefertam($value) { $this->geliefertam=$value; }
  function GetGeliefertam() { return $this->geliefertam; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }

}

?>
<?

class ObjGenGesamtkosten
{

  private  $id;
  private  $veranstaltung;
  private  $entfernung;
  private  $vk_ist;
  private  $gage_sonderrabat;
  private  $band_gesamt;
  private  $sonstiges_gesamt;
  private  $ausgaben_gesamt;
  private  $saldo;
  private  $notizen;
  private  $busbenzin;
  private  $busversicherung;
  private  $bussteuer;
  private  $zinsen;
  private  $buero;
  private  $instrversicherung;
  private  $werbekosten;
  private  $kskkosten;
  private  $sonst1;
  private  $sonst1checked;
  private  $sonst1kosten;
  private  $sonst2;
  private  $sonst2checked;
  private  $sonst2kosten;

  public $app;            //application object 

  public function ObjGenGesamtkosten($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM gesamtkosten WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->veranstaltung=$result[veranstaltung];
    $this->entfernung=$result[entfernung];
    $this->vk_ist=$result[vk_ist];
    $this->gage_sonderrabat=$result[gage_sonderrabat];
    $this->band_gesamt=$result[band_gesamt];
    $this->sonstiges_gesamt=$result[sonstiges_gesamt];
    $this->ausgaben_gesamt=$result[ausgaben_gesamt];
    $this->saldo=$result[saldo];
    $this->notizen=$result[notizen];
    $this->busbenzin=$result[busbenzin];
    $this->busversicherung=$result[busversicherung];
    $this->bussteuer=$result[bussteuer];
    $this->zinsen=$result[zinsen];
    $this->buero=$result[buero];
    $this->instrversicherung=$result[instrversicherung];
    $this->werbekosten=$result[werbekosten];
    $this->kskkosten=$result[kskkosten];
    $this->sonst1=$result[sonst1];
    $this->sonst1checked=$result[sonst1checked];
    $this->sonst1kosten=$result[sonst1kosten];
    $this->sonst2=$result[sonst2];
    $this->sonst2checked=$result[sonst2checked];
    $this->sonst2kosten=$result[sonst2kosten];
  }

  public function Create()
  {
    $sql = "INSERT INTO gesamtkosten (id,veranstaltung,entfernung,vk_ist,gage_sonderrabat,band_gesamt,sonstiges_gesamt,ausgaben_gesamt,saldo,notizen,busbenzin,busversicherung,bussteuer,zinsen,buero,instrversicherung,werbekosten,kskkosten,sonst1,sonst1checked,sonst1kosten,sonst2,sonst2checked,sonst2kosten)
      VALUES('','{$this->veranstaltung}','{$this->entfernung}','{$this->vk_ist}','{$this->gage_sonderrabat}','{$this->band_gesamt}','{$this->sonstiges_gesamt}','{$this->ausgaben_gesamt}','{$this->saldo}','{$this->notizen}','{$this->busbenzin}','{$this->busversicherung}','{$this->bussteuer}','{$this->zinsen}','{$this->buero}','{$this->instrversicherung}','{$this->werbekosten}','{$this->kskkosten}','{$this->sonst1}','{$this->sonst1checked}','{$this->sonst1kosten}','{$this->sonst2}','{$this->sonst2checked}','{$this->sonst2kosten}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE gesamtkosten SET
      veranstaltung='{$this->veranstaltung}',
      entfernung='{$this->entfernung}',
      vk_ist='{$this->vk_ist}',
      gage_sonderrabat='{$this->gage_sonderrabat}',
      band_gesamt='{$this->band_gesamt}',
      sonstiges_gesamt='{$this->sonstiges_gesamt}',
      ausgaben_gesamt='{$this->ausgaben_gesamt}',
      saldo='{$this->saldo}',
      notizen='{$this->notizen}',
      busbenzin='{$this->busbenzin}',
      busversicherung='{$this->busversicherung}',
      bussteuer='{$this->bussteuer}',
      zinsen='{$this->zinsen}',
      buero='{$this->buero}',
      instrversicherung='{$this->instrversicherung}',
      werbekosten='{$this->werbekosten}',
      kskkosten='{$this->kskkosten}',
      sonst1='{$this->sonst1}',
      sonst1checked='{$this->sonst1checked}',
      sonst1kosten='{$this->sonst1kosten}',
      sonst2='{$this->sonst2}',
      sonst2checked='{$this->sonst2checked}',
      sonst2kosten='{$this->sonst2kosten}'
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

    $sql = "DELETE FROM gesamtkosten WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->veranstaltung="";
    $this->entfernung="";
    $this->vk_ist="";
    $this->gage_sonderrabat="";
    $this->band_gesamt="";
    $this->sonstiges_gesamt="";
    $this->ausgaben_gesamt="";
    $this->saldo="";
    $this->notizen="";
    $this->busbenzin="";
    $this->busversicherung="";
    $this->bussteuer="";
    $this->zinsen="";
    $this->buero="";
    $this->instrversicherung="";
    $this->werbekosten="";
    $this->kskkosten="";
    $this->sonst1="";
    $this->sonst1checked="";
    $this->sonst1kosten="";
    $this->sonst2="";
    $this->sonst2checked="";
    $this->sonst2kosten="";
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
  function SetVeranstaltung($value) { $this->veranstaltung=$value; }
  function GetVeranstaltung() { return $this->veranstaltung; }
  function SetEntfernung($value) { $this->entfernung=$value; }
  function GetEntfernung() { return $this->entfernung; }
  function SetVk_Ist($value) { $this->vk_ist=$value; }
  function GetVk_Ist() { return $this->vk_ist; }
  function SetGage_Sonderrabat($value) { $this->gage_sonderrabat=$value; }
  function GetGage_Sonderrabat() { return $this->gage_sonderrabat; }
  function SetBand_Gesamt($value) { $this->band_gesamt=$value; }
  function GetBand_Gesamt() { return $this->band_gesamt; }
  function SetSonstiges_Gesamt($value) { $this->sonstiges_gesamt=$value; }
  function GetSonstiges_Gesamt() { return $this->sonstiges_gesamt; }
  function SetAusgaben_Gesamt($value) { $this->ausgaben_gesamt=$value; }
  function GetAusgaben_Gesamt() { return $this->ausgaben_gesamt; }
  function SetSaldo($value) { $this->saldo=$value; }
  function GetSaldo() { return $this->saldo; }
  function SetNotizen($value) { $this->notizen=$value; }
  function GetNotizen() { return $this->notizen; }
  function SetBusbenzin($value) { $this->busbenzin=$value; }
  function GetBusbenzin() { return $this->busbenzin; }
  function SetBusversicherung($value) { $this->busversicherung=$value; }
  function GetBusversicherung() { return $this->busversicherung; }
  function SetBussteuer($value) { $this->bussteuer=$value; }
  function GetBussteuer() { return $this->bussteuer; }
  function SetZinsen($value) { $this->zinsen=$value; }
  function GetZinsen() { return $this->zinsen; }
  function SetBuero($value) { $this->buero=$value; }
  function GetBuero() { return $this->buero; }
  function SetInstrversicherung($value) { $this->instrversicherung=$value; }
  function GetInstrversicherung() { return $this->instrversicherung; }
  function SetWerbekosten($value) { $this->werbekosten=$value; }
  function GetWerbekosten() { return $this->werbekosten; }
  function SetKskkosten($value) { $this->kskkosten=$value; }
  function GetKskkosten() { return $this->kskkosten; }
  function SetSonst1($value) { $this->sonst1=$value; }
  function GetSonst1() { return $this->sonst1; }
  function SetSonst1Checked($value) { $this->sonst1checked=$value; }
  function GetSonst1Checked() { return $this->sonst1checked; }
  function SetSonst1Kosten($value) { $this->sonst1kosten=$value; }
  function GetSonst1Kosten() { return $this->sonst1kosten; }
  function SetSonst2($value) { $this->sonst2=$value; }
  function GetSonst2() { return $this->sonst2; }
  function SetSonst2Checked($value) { $this->sonst2checked=$value; }
  function GetSonst2Checked() { return $this->sonst2checked; }
  function SetSonst2Kosten($value) { $this->sonst2kosten=$value; }
  function GetSonst2Kosten() { return $this->sonst2kosten; }

}

?>
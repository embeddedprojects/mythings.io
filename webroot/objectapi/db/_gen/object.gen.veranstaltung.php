<?

class ObjGenVeranstaltung
{

  private  $id;
  private  $datum;
  private  $optioniert_bis;
  private  $aufbau;
  private  $beginn;
  private  $ende;
  private  $einlass;
  private  $funktionscheck;
  private  $va_art;
  private  $hotel;
  private  $hotel_plz;
  private  $hotel_ort;
  private  $hotel_adresse;
  private  $hotel_www;
  private  $hotel_telefon;
  private  $va_thema;
  private  $anlass;
  private  $anruf_am;
  private  $mitarbeiter;
  private  $status;
  private  $spielzeit;
  private  $weitere_halbe_stunde;
  private  $im_internet;
  private  $angebot_versendet;
  private  $angebot_versendet_am;
  private  $angebot_versendet_von;
  private  $angebot_versendet_per;
  private  $vertrag_versendet;
  private  $vertrag_versendet_am;
  private  $vertrag_versendet_von;
  private  $vertrag_versendet_per;
  private  $vertrag_erhalten;
  private  $vertrag_erhalten_am;
  private  $vertrag_erhalten_von;
  private  $vertrag_erhalten_per;
  private  $hotel_gebucht;
  private  $hotel_gebucht_am;
  private  $hotel_gebucht_von;
  private  $hotel_gebucht_per;
  private  $rechnung_gesendet;
  private  $rechnung_gesendet_am;
  private  $rechnung_gesendet_per;
  private  $rechnung_gesendet_von;
  private  $veranstalter_firma;
  private  $veranstalter_anrede;
  private  $veranstalter_vertreten_durch;
  private  $veranstalter_strasse;
  private  $veranstalter_plz;
  private  $veranstalter_ort;
  private  $veranstalter_land;
  private  $veranstalter_telefon;
  private  $veranstalter_mobiltelefon;
  private  $veranstalter_telefax;
  private  $veranstalter_email;
  private  $vaort_auftrittsort;
  private  $vaort_zhs;
  private  $vaort_ansprechpartner;
  private  $vaort_strasse;
  private  $vaort_plz;
  private  $vaort_ort;
  private  $vaort_land;
  private  $vaort_telefon;
  private  $vaort_mobiltelefon;
  private  $vaort_telefax;
  private  $vaort_email;
  private  $angebot_text;
  private  $angebot_text_int;
  private  $vertrag_text;
  private  $notizen_text;
  private  $mwst;
  private  $pause;
  private  $angebot_einleitung;
  private  $ksk_in_rechnung;
  private  $zugabe;
  private  $zugabenzeit;
  private  $screen;
  private  $erstelltam;

  public $app;            //application object 

  public function ObjGenVeranstaltung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM veranstaltung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->datum=$result[datum];
    $this->optioniert_bis=$result[optioniert_bis];
    $this->aufbau=$result[aufbau];
    $this->beginn=$result[beginn];
    $this->ende=$result[ende];
    $this->einlass=$result[einlass];
    $this->funktionscheck=$result[funktionscheck];
    $this->va_art=$result[va_art];
    $this->hotel=$result[hotel];
    $this->hotel_plz=$result[hotel_plz];
    $this->hotel_ort=$result[hotel_ort];
    $this->hotel_adresse=$result[hotel_adresse];
    $this->hotel_www=$result[hotel_www];
    $this->hotel_telefon=$result[hotel_telefon];
    $this->va_thema=$result[va_thema];
    $this->anlass=$result[anlass];
    $this->anruf_am=$result[anruf_am];
    $this->mitarbeiter=$result[mitarbeiter];
    $this->status=$result[status];
    $this->spielzeit=$result[spielzeit];
    $this->weitere_halbe_stunde=$result[weitere_halbe_stunde];
    $this->im_internet=$result[im_internet];
    $this->angebot_versendet=$result[angebot_versendet];
    $this->angebot_versendet_am=$result[angebot_versendet_am];
    $this->angebot_versendet_von=$result[angebot_versendet_von];
    $this->angebot_versendet_per=$result[angebot_versendet_per];
    $this->vertrag_versendet=$result[vertrag_versendet];
    $this->vertrag_versendet_am=$result[vertrag_versendet_am];
    $this->vertrag_versendet_von=$result[vertrag_versendet_von];
    $this->vertrag_versendet_per=$result[vertrag_versendet_per];
    $this->vertrag_erhalten=$result[vertrag_erhalten];
    $this->vertrag_erhalten_am=$result[vertrag_erhalten_am];
    $this->vertrag_erhalten_von=$result[vertrag_erhalten_von];
    $this->vertrag_erhalten_per=$result[vertrag_erhalten_per];
    $this->hotel_gebucht=$result[hotel_gebucht];
    $this->hotel_gebucht_am=$result[hotel_gebucht_am];
    $this->hotel_gebucht_von=$result[hotel_gebucht_von];
    $this->hotel_gebucht_per=$result[hotel_gebucht_per];
    $this->rechnung_gesendet=$result[rechnung_gesendet];
    $this->rechnung_gesendet_am=$result[rechnung_gesendet_am];
    $this->rechnung_gesendet_per=$result[rechnung_gesendet_per];
    $this->rechnung_gesendet_von=$result[rechnung_gesendet_von];
    $this->veranstalter_firma=$result[veranstalter_firma];
    $this->veranstalter_anrede=$result[veranstalter_anrede];
    $this->veranstalter_vertreten_durch=$result[veranstalter_vertreten_durch];
    $this->veranstalter_strasse=$result[veranstalter_strasse];
    $this->veranstalter_plz=$result[veranstalter_plz];
    $this->veranstalter_ort=$result[veranstalter_ort];
    $this->veranstalter_land=$result[veranstalter_land];
    $this->veranstalter_telefon=$result[veranstalter_telefon];
    $this->veranstalter_mobiltelefon=$result[veranstalter_mobiltelefon];
    $this->veranstalter_telefax=$result[veranstalter_telefax];
    $this->veranstalter_email=$result[veranstalter_email];
    $this->vaort_auftrittsort=$result[vaort_auftrittsort];
    $this->vaort_zhs=$result[vaort_zhs];
    $this->vaort_ansprechpartner=$result[vaort_ansprechpartner];
    $this->vaort_strasse=$result[vaort_strasse];
    $this->vaort_plz=$result[vaort_plz];
    $this->vaort_ort=$result[vaort_ort];
    $this->vaort_land=$result[vaort_land];
    $this->vaort_telefon=$result[vaort_telefon];
    $this->vaort_mobiltelefon=$result[vaort_mobiltelefon];
    $this->vaort_telefax=$result[vaort_telefax];
    $this->vaort_email=$result[vaort_email];
    $this->angebot_text=$result[angebot_text];
    $this->angebot_text_int=$result[angebot_text_int];
    $this->vertrag_text=$result[vertrag_text];
    $this->notizen_text=$result[notizen_text];
    $this->mwst=$result[mwst];
    $this->pause=$result[pause];
    $this->angebot_einleitung=$result[angebot_einleitung];
    $this->ksk_in_rechnung=$result[ksk_in_rechnung];
    $this->zugabe=$result[zugabe];
    $this->zugabenzeit=$result[zugabenzeit];
    $this->screen=$result[screen];
    $this->erstelltam=$result[erstelltam];
  }

  public function Create()
  {
    $sql = "INSERT INTO veranstaltung (id,datum,optioniert_bis,aufbau,beginn,ende,einlass,funktionscheck,va_art,hotel,hotel_plz,hotel_ort,hotel_adresse,hotel_www,hotel_telefon,va_thema,anlass,anruf_am,mitarbeiter,status,spielzeit,weitere_halbe_stunde,im_internet,angebot_versendet,angebot_versendet_am,angebot_versendet_von,angebot_versendet_per,vertrag_versendet,vertrag_versendet_am,vertrag_versendet_von,vertrag_versendet_per,vertrag_erhalten,vertrag_erhalten_am,vertrag_erhalten_von,vertrag_erhalten_per,hotel_gebucht,hotel_gebucht_am,hotel_gebucht_von,hotel_gebucht_per,rechnung_gesendet,rechnung_gesendet_am,rechnung_gesendet_per,rechnung_gesendet_von,veranstalter_firma,veranstalter_anrede,veranstalter_vertreten_durch,veranstalter_strasse,veranstalter_plz,veranstalter_ort,veranstalter_land,veranstalter_telefon,veranstalter_mobiltelefon,veranstalter_telefax,veranstalter_email,vaort_auftrittsort,vaort_zhs,vaort_ansprechpartner,vaort_strasse,vaort_plz,vaort_ort,vaort_land,vaort_telefon,vaort_mobiltelefon,vaort_telefax,vaort_email,angebot_text,angebot_text_int,vertrag_text,notizen_text,mwst,pause,angebot_einleitung,ksk_in_rechnung,zugabe,zugabenzeit,screen,erstelltam)
      VALUES('','{$this->datum}','{$this->optioniert_bis}','{$this->aufbau}','{$this->beginn}','{$this->ende}','{$this->einlass}','{$this->funktionscheck}','{$this->va_art}','{$this->hotel}','{$this->hotel_plz}','{$this->hotel_ort}','{$this->hotel_adresse}','{$this->hotel_www}','{$this->hotel_telefon}','{$this->va_thema}','{$this->anlass}','{$this->anruf_am}','{$this->mitarbeiter}','{$this->status}','{$this->spielzeit}','{$this->weitere_halbe_stunde}','{$this->im_internet}','{$this->angebot_versendet}','{$this->angebot_versendet_am}','{$this->angebot_versendet_von}','{$this->angebot_versendet_per}','{$this->vertrag_versendet}','{$this->vertrag_versendet_am}','{$this->vertrag_versendet_von}','{$this->vertrag_versendet_per}','{$this->vertrag_erhalten}','{$this->vertrag_erhalten_am}','{$this->vertrag_erhalten_von}','{$this->vertrag_erhalten_per}','{$this->hotel_gebucht}','{$this->hotel_gebucht_am}','{$this->hotel_gebucht_von}','{$this->hotel_gebucht_per}','{$this->rechnung_gesendet}','{$this->rechnung_gesendet_am}','{$this->rechnung_gesendet_per}','{$this->rechnung_gesendet_von}','{$this->veranstalter_firma}','{$this->veranstalter_anrede}','{$this->veranstalter_vertreten_durch}','{$this->veranstalter_strasse}','{$this->veranstalter_plz}','{$this->veranstalter_ort}','{$this->veranstalter_land}','{$this->veranstalter_telefon}','{$this->veranstalter_mobiltelefon}','{$this->veranstalter_telefax}','{$this->veranstalter_email}','{$this->vaort_auftrittsort}','{$this->vaort_zhs}','{$this->vaort_ansprechpartner}','{$this->vaort_strasse}','{$this->vaort_plz}','{$this->vaort_ort}','{$this->vaort_land}','{$this->vaort_telefon}','{$this->vaort_mobiltelefon}','{$this->vaort_telefax}','{$this->vaort_email}','{$this->angebot_text}','{$this->angebot_text_int}','{$this->vertrag_text}','{$this->notizen_text}','{$this->mwst}','{$this->pause}','{$this->angebot_einleitung}','{$this->ksk_in_rechnung}','{$this->zugabe}','{$this->zugabenzeit}','{$this->screen}','{$this->erstelltam}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE veranstaltung SET
      datum='{$this->datum}',
      optioniert_bis='{$this->optioniert_bis}',
      aufbau='{$this->aufbau}',
      beginn='{$this->beginn}',
      ende='{$this->ende}',
      einlass='{$this->einlass}',
      funktionscheck='{$this->funktionscheck}',
      va_art='{$this->va_art}',
      hotel='{$this->hotel}',
      hotel_plz='{$this->hotel_plz}',
      hotel_ort='{$this->hotel_ort}',
      hotel_adresse='{$this->hotel_adresse}',
      hotel_www='{$this->hotel_www}',
      hotel_telefon='{$this->hotel_telefon}',
      va_thema='{$this->va_thema}',
      anlass='{$this->anlass}',
      anruf_am='{$this->anruf_am}',
      mitarbeiter='{$this->mitarbeiter}',
      status='{$this->status}',
      spielzeit='{$this->spielzeit}',
      weitere_halbe_stunde='{$this->weitere_halbe_stunde}',
      im_internet='{$this->im_internet}',
      angebot_versendet='{$this->angebot_versendet}',
      angebot_versendet_am='{$this->angebot_versendet_am}',
      angebot_versendet_von='{$this->angebot_versendet_von}',
      angebot_versendet_per='{$this->angebot_versendet_per}',
      vertrag_versendet='{$this->vertrag_versendet}',
      vertrag_versendet_am='{$this->vertrag_versendet_am}',
      vertrag_versendet_von='{$this->vertrag_versendet_von}',
      vertrag_versendet_per='{$this->vertrag_versendet_per}',
      vertrag_erhalten='{$this->vertrag_erhalten}',
      vertrag_erhalten_am='{$this->vertrag_erhalten_am}',
      vertrag_erhalten_von='{$this->vertrag_erhalten_von}',
      vertrag_erhalten_per='{$this->vertrag_erhalten_per}',
      hotel_gebucht='{$this->hotel_gebucht}',
      hotel_gebucht_am='{$this->hotel_gebucht_am}',
      hotel_gebucht_von='{$this->hotel_gebucht_von}',
      hotel_gebucht_per='{$this->hotel_gebucht_per}',
      rechnung_gesendet='{$this->rechnung_gesendet}',
      rechnung_gesendet_am='{$this->rechnung_gesendet_am}',
      rechnung_gesendet_per='{$this->rechnung_gesendet_per}',
      rechnung_gesendet_von='{$this->rechnung_gesendet_von}',
      veranstalter_firma='{$this->veranstalter_firma}',
      veranstalter_anrede='{$this->veranstalter_anrede}',
      veranstalter_vertreten_durch='{$this->veranstalter_vertreten_durch}',
      veranstalter_strasse='{$this->veranstalter_strasse}',
      veranstalter_plz='{$this->veranstalter_plz}',
      veranstalter_ort='{$this->veranstalter_ort}',
      veranstalter_land='{$this->veranstalter_land}',
      veranstalter_telefon='{$this->veranstalter_telefon}',
      veranstalter_mobiltelefon='{$this->veranstalter_mobiltelefon}',
      veranstalter_telefax='{$this->veranstalter_telefax}',
      veranstalter_email='{$this->veranstalter_email}',
      vaort_auftrittsort='{$this->vaort_auftrittsort}',
      vaort_zhs='{$this->vaort_zhs}',
      vaort_ansprechpartner='{$this->vaort_ansprechpartner}',
      vaort_strasse='{$this->vaort_strasse}',
      vaort_plz='{$this->vaort_plz}',
      vaort_ort='{$this->vaort_ort}',
      vaort_land='{$this->vaort_land}',
      vaort_telefon='{$this->vaort_telefon}',
      vaort_mobiltelefon='{$this->vaort_mobiltelefon}',
      vaort_telefax='{$this->vaort_telefax}',
      vaort_email='{$this->vaort_email}',
      angebot_text='{$this->angebot_text}',
      angebot_text_int='{$this->angebot_text_int}',
      vertrag_text='{$this->vertrag_text}',
      notizen_text='{$this->notizen_text}',
      mwst='{$this->mwst}',
      pause='{$this->pause}',
      angebot_einleitung='{$this->angebot_einleitung}',
      ksk_in_rechnung='{$this->ksk_in_rechnung}',
      zugabe='{$this->zugabe}',
      zugabenzeit='{$this->zugabenzeit}',
      screen='{$this->screen}',
      erstelltam='{$this->erstelltam}'
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

    $sql = "DELETE FROM veranstaltung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->optioniert_bis="";
    $this->aufbau="";
    $this->beginn="";
    $this->ende="";
    $this->einlass="";
    $this->funktionscheck="";
    $this->va_art="";
    $this->hotel="";
    $this->hotel_plz="";
    $this->hotel_ort="";
    $this->hotel_adresse="";
    $this->hotel_www="";
    $this->hotel_telefon="";
    $this->va_thema="";
    $this->anlass="";
    $this->anruf_am="";
    $this->mitarbeiter="";
    $this->status="";
    $this->spielzeit="";
    $this->weitere_halbe_stunde="";
    $this->im_internet="";
    $this->angebot_versendet="";
    $this->angebot_versendet_am="";
    $this->angebot_versendet_von="";
    $this->angebot_versendet_per="";
    $this->vertrag_versendet="";
    $this->vertrag_versendet_am="";
    $this->vertrag_versendet_von="";
    $this->vertrag_versendet_per="";
    $this->vertrag_erhalten="";
    $this->vertrag_erhalten_am="";
    $this->vertrag_erhalten_von="";
    $this->vertrag_erhalten_per="";
    $this->hotel_gebucht="";
    $this->hotel_gebucht_am="";
    $this->hotel_gebucht_von="";
    $this->hotel_gebucht_per="";
    $this->rechnung_gesendet="";
    $this->rechnung_gesendet_am="";
    $this->rechnung_gesendet_per="";
    $this->rechnung_gesendet_von="";
    $this->veranstalter_firma="";
    $this->veranstalter_anrede="";
    $this->veranstalter_vertreten_durch="";
    $this->veranstalter_strasse="";
    $this->veranstalter_plz="";
    $this->veranstalter_ort="";
    $this->veranstalter_land="";
    $this->veranstalter_telefon="";
    $this->veranstalter_mobiltelefon="";
    $this->veranstalter_telefax="";
    $this->veranstalter_email="";
    $this->vaort_auftrittsort="";
    $this->vaort_zhs="";
    $this->vaort_ansprechpartner="";
    $this->vaort_strasse="";
    $this->vaort_plz="";
    $this->vaort_ort="";
    $this->vaort_land="";
    $this->vaort_telefon="";
    $this->vaort_mobiltelefon="";
    $this->vaort_telefax="";
    $this->vaort_email="";
    $this->angebot_text="";
    $this->angebot_text_int="";
    $this->vertrag_text="";
    $this->notizen_text="";
    $this->mwst="";
    $this->pause="";
    $this->angebot_einleitung="";
    $this->ksk_in_rechnung="";
    $this->zugabe="";
    $this->zugabenzeit="";
    $this->screen="";
    $this->erstelltam="";
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
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetOptioniert_Bis($value) { $this->optioniert_bis=$value; }
  function GetOptioniert_Bis() { return $this->optioniert_bis; }
  function SetAufbau($value) { $this->aufbau=$value; }
  function GetAufbau() { return $this->aufbau; }
  function SetBeginn($value) { $this->beginn=$value; }
  function GetBeginn() { return $this->beginn; }
  function SetEnde($value) { $this->ende=$value; }
  function GetEnde() { return $this->ende; }
  function SetEinlass($value) { $this->einlass=$value; }
  function GetEinlass() { return $this->einlass; }
  function SetFunktionscheck($value) { $this->funktionscheck=$value; }
  function GetFunktionscheck() { return $this->funktionscheck; }
  function SetVa_Art($value) { $this->va_art=$value; }
  function GetVa_Art() { return $this->va_art; }
  function SetHotel($value) { $this->hotel=$value; }
  function GetHotel() { return $this->hotel; }
  function SetHotel_Plz($value) { $this->hotel_plz=$value; }
  function GetHotel_Plz() { return $this->hotel_plz; }
  function SetHotel_Ort($value) { $this->hotel_ort=$value; }
  function GetHotel_Ort() { return $this->hotel_ort; }
  function SetHotel_Adresse($value) { $this->hotel_adresse=$value; }
  function GetHotel_Adresse() { return $this->hotel_adresse; }
  function SetHotel_Www($value) { $this->hotel_www=$value; }
  function GetHotel_Www() { return $this->hotel_www; }
  function SetHotel_Telefon($value) { $this->hotel_telefon=$value; }
  function GetHotel_Telefon() { return $this->hotel_telefon; }
  function SetVa_Thema($value) { $this->va_thema=$value; }
  function GetVa_Thema() { return $this->va_thema; }
  function SetAnlass($value) { $this->anlass=$value; }
  function GetAnlass() { return $this->anlass; }
  function SetAnruf_Am($value) { $this->anruf_am=$value; }
  function GetAnruf_Am() { return $this->anruf_am; }
  function SetMitarbeiter($value) { $this->mitarbeiter=$value; }
  function GetMitarbeiter() { return $this->mitarbeiter; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetSpielzeit($value) { $this->spielzeit=$value; }
  function GetSpielzeit() { return $this->spielzeit; }
  function SetWeitere_Halbe_Stunde($value) { $this->weitere_halbe_stunde=$value; }
  function GetWeitere_Halbe_Stunde() { return $this->weitere_halbe_stunde; }
  function SetIm_Internet($value) { $this->im_internet=$value; }
  function GetIm_Internet() { return $this->im_internet; }
  function SetAngebot_Versendet($value) { $this->angebot_versendet=$value; }
  function GetAngebot_Versendet() { return $this->angebot_versendet; }
  function SetAngebot_Versendet_Am($value) { $this->angebot_versendet_am=$value; }
  function GetAngebot_Versendet_Am() { return $this->angebot_versendet_am; }
  function SetAngebot_Versendet_Von($value) { $this->angebot_versendet_von=$value; }
  function GetAngebot_Versendet_Von() { return $this->angebot_versendet_von; }
  function SetAngebot_Versendet_Per($value) { $this->angebot_versendet_per=$value; }
  function GetAngebot_Versendet_Per() { return $this->angebot_versendet_per; }
  function SetVertrag_Versendet($value) { $this->vertrag_versendet=$value; }
  function GetVertrag_Versendet() { return $this->vertrag_versendet; }
  function SetVertrag_Versendet_Am($value) { $this->vertrag_versendet_am=$value; }
  function GetVertrag_Versendet_Am() { return $this->vertrag_versendet_am; }
  function SetVertrag_Versendet_Von($value) { $this->vertrag_versendet_von=$value; }
  function GetVertrag_Versendet_Von() { return $this->vertrag_versendet_von; }
  function SetVertrag_Versendet_Per($value) { $this->vertrag_versendet_per=$value; }
  function GetVertrag_Versendet_Per() { return $this->vertrag_versendet_per; }
  function SetVertrag_Erhalten($value) { $this->vertrag_erhalten=$value; }
  function GetVertrag_Erhalten() { return $this->vertrag_erhalten; }
  function SetVertrag_Erhalten_Am($value) { $this->vertrag_erhalten_am=$value; }
  function GetVertrag_Erhalten_Am() { return $this->vertrag_erhalten_am; }
  function SetVertrag_Erhalten_Von($value) { $this->vertrag_erhalten_von=$value; }
  function GetVertrag_Erhalten_Von() { return $this->vertrag_erhalten_von; }
  function SetVertrag_Erhalten_Per($value) { $this->vertrag_erhalten_per=$value; }
  function GetVertrag_Erhalten_Per() { return $this->vertrag_erhalten_per; }
  function SetHotel_Gebucht($value) { $this->hotel_gebucht=$value; }
  function GetHotel_Gebucht() { return $this->hotel_gebucht; }
  function SetHotel_Gebucht_Am($value) { $this->hotel_gebucht_am=$value; }
  function GetHotel_Gebucht_Am() { return $this->hotel_gebucht_am; }
  function SetHotel_Gebucht_Von($value) { $this->hotel_gebucht_von=$value; }
  function GetHotel_Gebucht_Von() { return $this->hotel_gebucht_von; }
  function SetHotel_Gebucht_Per($value) { $this->hotel_gebucht_per=$value; }
  function GetHotel_Gebucht_Per() { return $this->hotel_gebucht_per; }
  function SetRechnung_Gesendet($value) { $this->rechnung_gesendet=$value; }
  function GetRechnung_Gesendet() { return $this->rechnung_gesendet; }
  function SetRechnung_Gesendet_Am($value) { $this->rechnung_gesendet_am=$value; }
  function GetRechnung_Gesendet_Am() { return $this->rechnung_gesendet_am; }
  function SetRechnung_Gesendet_Per($value) { $this->rechnung_gesendet_per=$value; }
  function GetRechnung_Gesendet_Per() { return $this->rechnung_gesendet_per; }
  function SetRechnung_Gesendet_Von($value) { $this->rechnung_gesendet_von=$value; }
  function GetRechnung_Gesendet_Von() { return $this->rechnung_gesendet_von; }
  function SetVeranstalter_Firma($value) { $this->veranstalter_firma=$value; }
  function GetVeranstalter_Firma() { return $this->veranstalter_firma; }
  function SetVeranstalter_Anrede($value) { $this->veranstalter_anrede=$value; }
  function GetVeranstalter_Anrede() { return $this->veranstalter_anrede; }
  function SetVeranstalter_Vertreten_Durch($value) { $this->veranstalter_vertreten_durch=$value; }
  function GetVeranstalter_Vertreten_Durch() { return $this->veranstalter_vertreten_durch; }
  function SetVeranstalter_Strasse($value) { $this->veranstalter_strasse=$value; }
  function GetVeranstalter_Strasse() { return $this->veranstalter_strasse; }
  function SetVeranstalter_Plz($value) { $this->veranstalter_plz=$value; }
  function GetVeranstalter_Plz() { return $this->veranstalter_plz; }
  function SetVeranstalter_Ort($value) { $this->veranstalter_ort=$value; }
  function GetVeranstalter_Ort() { return $this->veranstalter_ort; }
  function SetVeranstalter_Land($value) { $this->veranstalter_land=$value; }
  function GetVeranstalter_Land() { return $this->veranstalter_land; }
  function SetVeranstalter_Telefon($value) { $this->veranstalter_telefon=$value; }
  function GetVeranstalter_Telefon() { return $this->veranstalter_telefon; }
  function SetVeranstalter_Mobiltelefon($value) { $this->veranstalter_mobiltelefon=$value; }
  function GetVeranstalter_Mobiltelefon() { return $this->veranstalter_mobiltelefon; }
  function SetVeranstalter_Telefax($value) { $this->veranstalter_telefax=$value; }
  function GetVeranstalter_Telefax() { return $this->veranstalter_telefax; }
  function SetVeranstalter_Email($value) { $this->veranstalter_email=$value; }
  function GetVeranstalter_Email() { return $this->veranstalter_email; }
  function SetVaort_Auftrittsort($value) { $this->vaort_auftrittsort=$value; }
  function GetVaort_Auftrittsort() { return $this->vaort_auftrittsort; }
  function SetVaort_Zhs($value) { $this->vaort_zhs=$value; }
  function GetVaort_Zhs() { return $this->vaort_zhs; }
  function SetVaort_Ansprechpartner($value) { $this->vaort_ansprechpartner=$value; }
  function GetVaort_Ansprechpartner() { return $this->vaort_ansprechpartner; }
  function SetVaort_Strasse($value) { $this->vaort_strasse=$value; }
  function GetVaort_Strasse() { return $this->vaort_strasse; }
  function SetVaort_Plz($value) { $this->vaort_plz=$value; }
  function GetVaort_Plz() { return $this->vaort_plz; }
  function SetVaort_Ort($value) { $this->vaort_ort=$value; }
  function GetVaort_Ort() { return $this->vaort_ort; }
  function SetVaort_Land($value) { $this->vaort_land=$value; }
  function GetVaort_Land() { return $this->vaort_land; }
  function SetVaort_Telefon($value) { $this->vaort_telefon=$value; }
  function GetVaort_Telefon() { return $this->vaort_telefon; }
  function SetVaort_Mobiltelefon($value) { $this->vaort_mobiltelefon=$value; }
  function GetVaort_Mobiltelefon() { return $this->vaort_mobiltelefon; }
  function SetVaort_Telefax($value) { $this->vaort_telefax=$value; }
  function GetVaort_Telefax() { return $this->vaort_telefax; }
  function SetVaort_Email($value) { $this->vaort_email=$value; }
  function GetVaort_Email() { return $this->vaort_email; }
  function SetAngebot_Text($value) { $this->angebot_text=$value; }
  function GetAngebot_Text() { return $this->angebot_text; }
  function SetAngebot_Text_Int($value) { $this->angebot_text_int=$value; }
  function GetAngebot_Text_Int() { return $this->angebot_text_int; }
  function SetVertrag_Text($value) { $this->vertrag_text=$value; }
  function GetVertrag_Text() { return $this->vertrag_text; }
  function SetNotizen_Text($value) { $this->notizen_text=$value; }
  function GetNotizen_Text() { return $this->notizen_text; }
  function SetMwst($value) { $this->mwst=$value; }
  function GetMwst() { return $this->mwst; }
  function SetPause($value) { $this->pause=$value; }
  function GetPause() { return $this->pause; }
  function SetAngebot_Einleitung($value) { $this->angebot_einleitung=$value; }
  function GetAngebot_Einleitung() { return $this->angebot_einleitung; }
  function SetKsk_In_Rechnung($value) { $this->ksk_in_rechnung=$value; }
  function GetKsk_In_Rechnung() { return $this->ksk_in_rechnung; }
  function SetZugabe($value) { $this->zugabe=$value; }
  function GetZugabe() { return $this->zugabe; }
  function SetZugabenzeit($value) { $this->zugabenzeit=$value; }
  function GetZugabenzeit() { return $this->zugabenzeit; }
  function SetScreen($value) { $this->screen=$value; }
  function GetScreen() { return $this->screen; }
  function SetErstelltam($value) { $this->erstelltam=$value; }
  function GetErstelltam() { return $this->erstelltam; }

}

?>
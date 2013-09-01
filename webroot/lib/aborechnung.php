<?


class Artikel{
  var $Data;
  function Artikel($cols) {$this->Data = $cols;}
}


class Aboabrechnung{

function Aboabrechnung($app)
{
  $this->app = $app;
}

function GetRechnungsArray()
{
  //$retArray[adresse]['1101'] = $artikelObject;
  //hole alle kunden vom provider
  $ArrKunden = $this->app->DB->SelectArr("SELECT id FROM adresse WHERE firma=1");
  //wenn min. ein kunde vorhanden ist 
  if(count($ArrKunden)>0){
    foreach($ArrKunden as $kunde){
      if($this->CheckInvoiceForCustomer($kunde[id])){
	//echo $kunde[id];
	$ArrRechnung = $this->RechnungKunde($kunde[id]);
	$summe=0;
	foreach($ArrRechnung as $key){
		$summe = $summe + ($key->Data[menge]*$key->Data[preis]);
	}
	if($summe!=0)$retArray[$kunde[id]] = $this->RechnungKunde($kunde[id]);
	}
    }
  }
  return $retArray;
} 
      
function RechnungKunde($kundeid){      
  global $db,$myAuth;
  $retValue;
  $retArrayRechnung;
  $kunde['adresse']=$kundeid;
      if($this->CheckInvoiceForCustomer($kunde[adresse])){
	$retValue .="<table border=\"1\" width=\"90%\">";
	 $retValue .="<tr><td>Menge</td><td>Einheit</td><td>Artikel Nr</td>  
	  <td>Beschreibung</td><td>Einzelpreis</td>
	  <td>Gesamtpreis</td></tr>";

	//$kundename = $this->app->DB->Select("SELECT firma FROM kunde WHERE adresse='".$kunde[adresse]."' LIMIT 1");
	$kundename = "peter";
	$retValue .="<h2>Kunde ".$kunde[adresse]." $kundename</h2>"; 
	$ersternaechsterMonat = $this->GetNextFirstDay();
	//$ersternaechsterMonat ='2009-09-01';
	
	$sql = "SELECT * FROM auftrag_artikel WHERE abgerechnetbis < '$ersternaechsterMonat' 
                AND adresse='".$kunde[adresse]."' AND status!='inaktiv' ORDER by id";
	$ArrPaket = $this->app->DB->SelectArr($sql);

	foreach($ArrPaket as $paket){
	  //$retValue .= $paket[id]." ".$paket[text]." ".$paket[abgerechnetbis]." ".$paket[zahlzyklus]." ";
	  //********auf zahlzyklus anpassen
	    //wiederholende Zahlungen
	    if($paket[wiederholend]=="0"){
	      //$retValue .= $this->ArtikelBerechnen($paket[id],"once");
	      //$retArrayRechnung[$paket[id]] = ArtikelBerechnen($paket[id],"once");
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],"once");
	    }
	    elseif($this->CheckIfDayIsFirstInMonth($paket[startdatum])&&$paket[abgerechnetbis]=='0000-00-00') {
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$paket[startdatum]);
	    } 
	    elseif($this->CheckIfDayIsFirstInMonth($paket[abgerechnetbis])) {
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$paket[abgerechnetbis]);
	    } 
	    //***1. Fall wenn Artikel noch nie abgerechnet wurde
	    elseif($paket[abgerechnetbis]=='0000-00-00'){
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$paket[startdatum]);
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$this->GetNextFirstDay($paket[startdatum]));
	    }
	    //***2.Fall wenn abgerechnet_bis nicht der letzte eines Monats ist
	    elseif(!$this->CheckIfDayIsLastInMonth($paket[abgerechnetbis])){
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$paket[abgerechnetbis]);
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$this->GetNextFirstDay($paket[abgerechnetbis]));
	    }
	    else {
	    //********* Zahlzyklus
	      $retArrayRechnung[] = $this->ArtikelBerechnen($paket[id],$this->GetNextFirstDay($paket[abgerechnetbis]));
	    }



	}
	$retValue .="</table>";
	
      } 
  return $retArrayRechnung;
  //return $retValue;
}


// gibt artikel zeile fuer rechnung zurueck
function ArtikelBerechnen($id,$vontag){
  //vontag im form YYYY-MM-DD
  //vontag = once ( wiederholend )
  global $db,$myAuth;
  $retValue;
  $retArray;
  //hole artikel datensatz
  if(is_numeric($id)){
    $ArrArtikel = $this->app->DB->SelectArr("SELECT * FROM auftrag_artikel WHERE id='$id' LIMIT 1");
    $ArrArtikel = $ArrArtikel[0];
    $tmp = $this->app->DB->SelectArr("SELECT nummer, name_de FROM artikel WHERE id='{$ArrArtikel[artikel]}' LIMIT 1");
    $ArrArtikel[text] = $tmp[0][name_de];
    $ArrArtikel[nummer] = $tmp[0][nummer];

  }
  if($vontag=="once"){
    //wiederholende zahlung
    if($ArrArtikel[zahlzyklus]=="0")$ArrArtikel[zahlzyklus]="1";
    //$ArrArtikel[netto] = ($ArrArtikel[preis]*$ArrArtikel[menge]);
    $ArrArtikel[menge]= $ArrArtikel[menge]* $ArrArtikel[zahlzyklus];
    $retArray=new Artikel($ArrArtikel);
  } else {
    //wenn $vontag nicht letzter im monat ist nur bis ende des monats berechnen
    if($this->CheckIfDayIsFirstInMonth($vontag)){
      //standard zahl zyklus
      //zahlzyklus *
      $ArrArtikel[zahlzyklus] = $this->AnzahlZahlZyklus($vontag,$ArrArtikel[zahlzyklus]); 
      $ArrArtikel[text] = $ArrArtikel[text]."\nvon $vontag bis ".$this->LetztesZahlZyklusDatum($vontag,$ArrArtikel[zahlzyklus]); 
      $ArrArtikel[abgerechnetbis]=$this->LetztesZahlZyklusDatum($vontag,$ArrArtikel[zahlzyklus]);
      $ArrArtikel[menge]= $ArrArtikel[menge]* $ArrArtikel[zahlzyklus];

      $retArray=new Artikel($ArrArtikel);
      
      if($ArrArtikel[webpaket]==1){
	$ArrArtikel[text].="\n";
	$ArrArtikel[text].="\nFeatures:";	
	$ArrArtikel[text].="\n".$ArrArtikel[webspacelimit]." MB Webspace";	
	$ArrArtikel[text].="\n".$ArrArtikel[traffic_limit]." MB Traffic";	
	$ArrArtikel[text].="\n".$ArrArtikel[emailaccounts]." Emailaccounts";	
	$ArrArtikel[text].="\n".$ArrArtikel[emailforwards]." Weiterleitungen";
	$ArrArtikel[text].="\n";
	
	
	
	$ArrDomains = $this->app->DB->SelectArr("SELECT CONCAT(domain.domain_name,domain_typ.domain_typ) as name FROM domain,domain_typ 
		WHERE bundle_id='$id' AND domain.domain_typid=domain_typ.domain_typid");
     	//$ArrDomains = $ArrDomains[0];
	
	if(count($ArrDomains)!=0){
		$ArrArtikel[text].="\nIhre Domain(s) in diesem Paket:";
		foreach($ArrDomains as $domain){
			$ArrArtikel[text].="\nwww.".$domain[name];
		}
	}
      $retArray=new Artikel($ArrArtikel);

      }

      
    } else {
      //von vontag bis ende des monats
      //korrigieren
      // preis anteilig für tage
      // (preis / anzahl der monate)*day 
      $tmp = $this->DateArray($vontag);
      $ArrArtikel[text] = $ArrArtikel[text]."\nvon $vontag bis ".$this->GetLastDayOfMonth($vontag);
      $ArrArtikel[abgerechnetbis]=$this->GetLastDayOfMonth($vontag);
      $ArrArtikel[zahlzyklus]=1;
      $ArrArtikel[preis]=round(($ArrArtikel[preis]/$this->NumberOfDaysMonth($tmp[month],$tmp[year]))*($this->NumberOfDaysMonth($tmp[month],$tmp[year])-$tmp[day]),2);
      $ArrArtikel[menge]= $ArrArtikel[menge]* $ArrArtikel[zahlzyklus];
      $retArray=new Artikel($ArrArtikel);
    }
  }
  return $retArray;
}


function AnzahlZahlZyklus($vondatum,$zahlzyklus)
{
  //solange virtuelles abgerechnet bis < als GetNextFirstDay(); wobei einmal drüber wird benötigt
  //GetNextFirstDay();
  $vondatum = $this->DateArray($vondatum);
    
  $month = $vondatum[month];
  $year = $vondatum[year];
  $stopfen =0;

  $nextday = $this->DateArray($this->GetNextFirstDay());
  $getnextdaystamp = mktime(0,0,0,$nextday[month],$nextday[day],$nextday[year]); 
  $vonstamp = mktime(0,0,0,$vondatum[month],$vondatum[day],$vondatum[year]);

  $virdate = $this->DateArray($vondatum);
  $virdate[month]+1;
  if($virdate[month]>12){
    $virdate[month]=$virdate[month]-12;
    $virdate[year]++;
  }
  $virtuellabgerechnetbis = $vonstamp + ($this->NumberOfDaysMonth($virdate[month],$virdate[year])*3600*24);

  if($virtuellabgerechnetbis<$getnextdaystamp){
    $checkstamp =$vonstamp;
    do{
      $checkstamp = $checkstamp + ($this->NumberOfDaysMonth($month,$year)*3600*24);
      $stopfen++;
      $month++;
      if($month>12){
	$month = $month-12;
	$year++;
      }
    }while($checkstamp < $getnextdaystamp);
  }
 
  if($zahlzyklus==0)$zahlzyklus=1;
  if($stopfen>1) return ceil($stopfen/$zahlzyklus)*$zahlzyklus;
  else return $zahlzyklus;
}

//ermittelt die Anzahl der Tage vom naechsten Monat
function NumberOfDaysMonth($month,$year)
{
  $tstamp = mktime(0, 0, 0, $month, 0, $year);
  return date("d", $tstamp);
}


// gibt letzes datum im zahlzyklus aus
function LetztesZahlZyklusDatum($date,$zyklus)
{
  $date = $this->DateArray($date);

  $newdate[month] = $date[month]+($zyklus-1);
  $newdate[year] = $date[year];
  if($newdate[month]>12) { 
    $newdate[month]=$newdate[month]-12;
    $newdate[year]++;
  }

  return $this->GetLastDayOfMonth($newdate[year].'-'.$newdate[month].'-15');
}



//pruef ob der Tag der letzte im Monat ist
function CheckIfDayIsFirstInMonth($date)
{
  //date muss im format YYYY-MM-DD sein
  $date = $this->DateArray($date); 
  if($date[day]=="01" || $date[day]=="1") return true;
  
  return false;
}




//pruef ob der Tag der letzte im Monat ist
function CheckIfDayIsLastInMonth($date)
{
  //date muss im format YYYY-MM-DD sein
  $lastday = $this->GetLastDayOfMonth($date);
  $lastday = $this->DateArray($lastday);
  $date = $this->DateArray($date);
  if($lastday[day]==$date[day]) return true;
  return false;
}


//gibt in einem array tag monat und jahr extra zurück
function DateArray($date)
{
  $arr =split('-',$date);
  $retArr['year']=$arr[0];
  $retArr['day']=$arr[2];
  $retArr['month']=$arr[1];
  return $retArr;
}

//gibt den letzten tag eines monats zurück
function GetLastDayOfMonth($date)
{
$date = $this->DateArray($date);
$tstamp = mktime(0, 0, 0, $date[month]+1, 0, $date[year]);
return date("Y-m-d", $tstamp);
}



// prueft ob aktuell Artikel Domains Datenbanken zum abrechnen sind
function CheckInvoiceForCustomer($id)
{
  // ermittle das amerikanische Format fuer den 1. vom naechsten Monat
  $ersternaechsterMonat = $this->GetNextFirstDay();
     //echo "SELECT * FROM auftrag_artikel 
     //   WHERE abgerechnetbis < '$ersternaechsterMonat' AND adresse='$id' AND status!='inaktiv'";

  //pruefe artikel (z.T. aus Aufraegen z.T. wiederholend, wdh)
  $sql = "SELECT COUNT(id) FROM auftrag_artikel 
    WHERE abgerechnetbis < '$ersternaechsterMonat' AND adresse='$id' AND status!='inaktiv'";
  if($this->app->DB->Select($sql)>0) return true;
  //pruefe domains

  //pruefe datenbanken

  return false;
}


//gibt vom aktuellen zeitpunkt den naechsten  tag monat und jahr aus 2005-01-03
//oder ohne parameter den naechsten ersten
function GetNextFirstDay($date="")
{

  if($date==""){
    // aktuellen Monat ermitteln (Format 1...12)
    $month=date("n");
    $year=date("Y");
  } else {
    $date = $this->DateArray($date);
    $month=$date[month];
    $year=$date[year];
  }


  // naechsten Monat ermitteln (Format 1...12)
  if($month==12) {
    $nextmonth=1;
    $nextyear = $year+1;
  }
  else { 
    $nextmonth=$month+1;
    $nextyear=$year;
  }
  if($nextmonth<10)$nextmonth = "0".$nextmonth;
  // falls man mal zu spaet dran ist muss man hier das "heutige" datum eintragen was sein soll
 //return '2006-07-01'; // bsp ich war im juni zu spaet und habs im juli gemacht

 return $nextyear.'-'.$nextmonth.'-01';
}
}
?>

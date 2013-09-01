<?

class erpAPI 
{

  function erpAPI($app)
  {
    $this->app=&$app;
  }

  function ForceSSL()
  {
    if($_SERVER['HTTPS']!="on")
    {
     $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header("Location:$redirect");
     exit;
    }
  }
  
  function GetChoosenList()
  {
 
    $list = $this->app->Secure->GetGET("list"); 
    if($list <= 0) 
      $list = 0; 
    return $list;
  }


  function SelectLists()
  {
	$result = $this->app->DB->SelectArr("SELECT * FROM lists WHERE userid='".$this->app->User->GetID()."' ORDER by name");
	for($i=0;$i<count($result);$i++)
	{
		$tmp .= "<option value=\"".$result[$i]['id']."\">".$result[$i]['name']."</option>";
	}
	return $tmp;
  }

  function ParseMenuLists()
  {
	$result = $this->app->DB->SelectArr("SELECT * FROM lists WHERE userid='".$this->app->User->GetID()."' ORDER by name");
	for($i=0;$i<count($result);$i++)
	{
		$this->app->Tpl->Add(LISTS,"<li><a href=\"index.php?module=stock&action=list&list=".$result[$i]['id']."\">".$result[$i]['name']."</a></li>");
	}

	if(count($result)<=0)
		$this->app->Tpl->Add(LISTS,"<li><a href=\"#\">no lists available</a><li>");
  }

  function ParseBack()
  {
    $module = $this->app->Secure->GetGET("module");
    $action = $this->app->Secure->GetGET("action");
    $plugin = $this->app->Secure->GetGET("plugin");
    $result = $this->app->erp->parse_query($_SERVER['HTTP_REFERER']);
    //if($result['module']!=$module && $result['action']!=$action)


    if($action=="edit" && $plugin=="showinfo")
    $this->app->Tpl->Set(BACK,"index.php?module=stock&action=list");
	else
    $this->app->Tpl->Set(BACK,$_SESSION['back']);

    if($_SESSION['back']!="http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'])
    {
	$_SESSION['lastback']=$_SESSION['back'];
	$_SESSION['back']="http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }

  }


  function parse_query($var)
  {
    /**
     *  Use this function to parse out the query array element from
     *  the output of parse_url().
     */
    $var  = parse_url($var, PHP_URL_QUERY);
    $var  = html_entity_decode($var);
    $var  = explode('&', $var);
    $arr  = array();

    foreach($var as $val)
    {
      $x          = explode('=', $val);
      $arr[$x[0]] = $x[1];
    }
    unset($val, $x, $var);
    return $arr;
  } 

  function Languages()
  {
     $languages = array(
        'ab' => 'Abkhazian',
        'aa' => 'Afar',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'sq' => 'Albanian',
        'am' => 'Amharic',
        'ar' => 'Arabic',
        'an' => 'Aragonese',
        'hy' => 'Armenian',
        'as' => 'Assamese',
        'av' => 'Avaric',
        'ae' => 'Avestan',
        'ay' => 'Aymara',
        'az' => 'Azerbaijani',
        'bm' => 'Bambara',
        'ba' => 'Bashkir',
        'eu' => 'Basque',
        'be' => 'Belarusian',
        'bn' => 'Bengali',
        'bh' => 'Bihari',
        'bi' => 'Bislama',
        'nb' => 'Bokmal',
        'bs' => 'Bosnian',
        'br' => 'Breton',
        'bg' => 'Bulgarian',
        'my' => 'Burmese',
        'ca' => 'Catalan',
        'km' => 'Central Khmer',
        'ch' => 'Chamorro',
        'ce' => 'Chechen',
        'ny' => 'Chewa',
        'zh' => 'Chinese',
        'cu' => 'Church Slavic',
        'cv' => 'Chuvash',
        'kw' => 'Cornish',
        'co' => 'Corsican',
        'cr' => 'Cree',
        'hr' => 'Croatian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'dv' => 'Dhivehi',
        'nl' => 'Dutch',
        'dz' => 'Dzongkha',
        'en' => 'English',
        'eo' => 'Esperanto',
        'et' => 'Estonian',
        'ee' => 'Ewe',
        'fo' => 'Faroese',
        'fj' => 'Fijian',
        'fi' => 'Finnish',
        'fr' => 'French',
        'ff' => 'Fulah',
        'gd' => 'Gaelic',
        'gl' => 'Galician',
        'lg' => 'Ganda',
        'ka' => 'Georgian',
        'de' => 'German',
        'ki' => 'Gikuyu',
        'el' => 'Greek',
        'kl' => 'Greenlandic',
        'gn' => 'Guarani',
        'gu' => 'Gujarati',
        'ht' => 'Haitian',
        'ha' => 'Hausa',
        'he' => 'Hebrew',
        'hz' => 'Herero',
        'hi' => 'Hindi',
        'ho' => 'Hiri Motu',
        'hu' => 'Hungarian',
        'is' => 'Icelandic',
        'io' => 'Ido',
        'ig' => 'Igbo',
        'id' => 'Indonesian',
        'ia' => 'Interlingua',
        'iu' => 'Inuktitut',
        'ik' => 'Inupiaq',
        'ga' => 'Irish',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'jv' => 'Javanese',
        'kn' => 'Kannada',
        'kr' => 'Kanuri',
        'ks' => 'Kashmiri',
        'kk' => 'Kazakh',
        'rw' => 'Kinyarwanda',
        'kv' => 'Komi',
        'kg' => 'Kongo',
        'ko' => 'Korean',
        'ku' => 'Kurdish',
        'kj' => 'Kwanyama',
        'ky' => 'Kyrgyz',
        'lo' => 'Lao',
        'la' => 'Latin',
        'lv' => 'Latvian',
        'lb' => 'Letzeburgesch',
        'li' => 'Limburgan',
        'ln' => 'Lingala',
        'lt' => 'Lithuanian',
        'lu' => 'Luba-Katanga',
        'mk' => 'Macedonian',
        'mg' => 'Malagasy',
        'ms' => 'Malay',
        'ml' => 'Malayalam',
        'mt' => 'Maltese',
        'gv' => 'Manx',
        'mi' => 'Maori',
        'mr' => 'Marathi',
        'mh' => 'Marshallese',
        'ro' => 'Moldavian',
        'mn' => 'Mongolian',
        'na' => 'Nauru',
        'nv' => 'Navajo',
        'ng' => 'Ndonga',
        'ne' => 'Nepali',
        'nd' => 'North Ndebele',
        'se' => 'Northern Sami',
        'no' => 'Norwegian',
        'nn' => 'Norwegian Nynorsk',
        'ie' => 'Occidental',
        'oc' => 'Occitan',
        'oj' => 'Ojibwa',
        'or' => 'Oriya',
        'om' => 'Oromo',
        'os' => 'Ossetian',
        'pi' => 'Pali',
        'fa' => 'Persian',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'pa' => 'Punjabi',
        'ps' => 'Pushto',
        'qu' => 'Quechua',
        'ro' => 'Romanian',
        'rm' => 'Romansh',
        'rn' => 'Rundi',
        'ru' => 'Russian',
        'sm' => 'Samoan',
        'sg' => 'Sango',
        'sa' => 'Sanskrit',
        'sc' => 'Sardinian',
        'sr' => 'Serbian',
        'sn' => 'Shona',
        'ii' => 'Sichuan Yi',
        'sd' => 'Sindhi',
        'si' => 'Sinhalese',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'so' => 'Somali',
        'st' => 'Southern Sotho',
        'nr' => 'South Ndebele',
        'es' => 'Spanish',
        'su' => 'Sundanese',
        'sw' => 'Swahili',
        'ss' => 'Swati',
        'sv' => 'Swedish',
        'tl' => 'Tagalog',
        'ty' => 'Tahitian',
        'tg' => 'Tajik',
        'ta' => 'Tamil',
        'tt' => 'Tatar',
        'te' => 'Telugu',
        'th' => 'Thai',
        'bo' => 'Tibetan',
        'ti' => 'Tigrinya',
        'to' => 'Tonga',
        'ts' => 'Tsonga',
        'tn' => 'Tswana',
        'tr' => 'Turkish',
        'tk' => 'Turkmen',
        'tw' => 'Twi',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'ug' => 'Uyghur',
        'uz' => 'Uzbek',
        've' => 'Venda',
        'vi' => 'Vietnamese',
        'vo' => 'VolapÃ¼k',
        'wa' => 'Walloon',
        'cy' => 'Welsh',
        'fy' => 'Western Frisian',
        'wo' => 'Wolof',
        'xh' => 'Xhosa',
        'yi' => 'Yiddish',
        'yo' => 'Yoruba',
        'za' => 'Zhuang',
        'zu' => 'Zulu');
    return $languages;
  }


  function ParseThing($id)
  {
     $this->app->Tpl->Set(HISTORY,"");
     $this->app->Tpl->Set(INFO,"");
     //call plugin   
     $result = $this->app->DB->SelectArr("SELECT id,share,barcode,dateofpurchase,description,date,borrowafriendname,borrowafrienddate FROM scans WHERE id='$id' AND userid=".$this->app->User->GetID()."");
     $result = $result[0];

     $this->app->Tpl->Set(THINGDESCRIPTION,$result['description']);
     $this->app->Tpl->Set(THINGDATE,$result['date']);
     $this->app->Tpl->Set(THINGID,$result['id']);
     $this->app->Tpl->Set(THINGBARCODE,$result['barcode']);
     if($result['dateofpurchase']!="0000-00-00")
     $this->app->Tpl->Set(DATEOFPURCHASE,$result['dateofpurchase']);
     else $this->app->Tpl->Set(DATEOFPURCHASE,"unkown");


     if($result['borrowafriendname']!="")
	$this->app->Tpl->Add(INFO,'<div class="alert">
    		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong>&nbsp;Borrowed '.$result['borrowafriendname'].' on '.$result['borrowafrienddate'].'.
		    </div>');


     if($result['share'])
     	$this->app->Tpl->Set(THINGSHARE,"checked");


     $result = $this->app->DB->SelectArr("SELECT * FROM history WHERE scanid='$id' AND userid=".$this->app->User->GetID()." ORDER by logtime DESC");
     for($i=0;$i<count($result);$i++)
     {
	$this->app->Tpl->Add(HISTORY,"<li>".$result[$i]['logtime']." ".$result[$i]['logfile']."</li>");
     } 



     $this->app->Tpl->Set(THINGIMAGE,"index.php?module=stock&action=image&id=".$id."\"");
  }


  function GetSupportMail()
  {
    return "sauter@embedded-projects.net";
  }

  function DeleteAllUserData($userid)
  {
    if(is_numeric($userid))
    {
      $this->app->DB->Delete("DELETE FROM abonnements WHERE adresse='$userid'");
      $this->app->DB->Delete("DELETE FROM anzeige WHERE adresse='$userid'");
      $this->app->DB->Delete("DELETE FROM anzeige_sponsoring WHERE adresse='$userid'");
      $this->app->DB->Delete("DELETE FROM anzeige_stellenanzeige WHERE adresse='$userid'");
      $this->app->DB->Delete("DELETE FROM images WHERE adresse='$userid'");

      // flohmarkt_bilder und flohmarkt_artikel
      $floh_artikel = $this->app->DB->SelectArr("SELECT id FROM flohmarkt_artikel WHERE adresse='$userid'");
      for($i=0;$i<count($floh_artikel);$i++)
        $this->app->DB->Delete("DELETE FROM flohmarkt_bilder WHERE artikel='{$floh_artikel[$i][id]}'");
      $this->app->DB->Delete("DELETE FROM flohmarkt_artikel WHERE adresse='$userid'");

      // journal_aborechnung und journal_abonnements
      $jou_rec = $this->app->DB->SelectArr("SELECT id FROM journal_aborechnung WHERE adresse='$userid'");
      for($i=0;$i<count($jou_rec);$i++)
        $this->app->DB->Delete("DELETE FROM journal_abonnements WHERE rechnung='{$jou_rec[$i][id]}'");
      $this->app->DB->Delete("DELETE FROM journal_aborechnung WHERE adresse='$userid'");

      // journal, journal_bibiliography, journal_images, journal_listings, journal_tables
      $journal = $this->app->DB->SelectArr("SELECT id FROM journal WHERE adresse='$userid'");
      for($i=0;$i<count($journal);$i++)
      {
        $this->app->DB->Delete("DELETE FROM journal_bibliography WHERE artikel='{$journal[$i][id]}'");
        $this->app->DB->Delete("DELETE FROM journal_images WHERE artikel='{$journal[$i][id]}'");
        $this->app->DB->Delete("DELETE FROM journal_listings WHERE artikel='{$journal[$i][id]}'");
        $this->app->DB->Delete("DELETE FROM journal_tables WHERE artikel='{$journal[$i][id]}'");
      }
      $this->app->DB->Delete("DELETE FROM journal WHERE adresse='$userid'");
     
      $this->app->DB->Delete("DELETE FROM kundendaten WHERE id='$userid'");
      $this->app->DB->Delete("DELETE FROM postbote WHERE adresse='$userid'");

      // user, useronline
      $this->app->DB->Delete("DELETE FROM user WHERE where kundendaten='$userid'");
      $this->app->DB->Delete("DELETE FROM useronline WHERE user_id='$userid'");
      return 1;
    }
    return 0;
  }



  function ContentShow($page, $parsetarget)
  {
    $lang = $_SESSION['language'];

    if($lang!="de" || $lang!="en") $lang="de";

    $html = $this->app->DB->Select("SELECT html FROM inhalt WHERE sprache='{$lang}' AND inhalt='$page' LIMIT 1");
    $this->app->Tpl->Set(CONTENT,html_entity_decode($html));

    $type = $this->app->User->GetType();
    if($html!="" && ($type=="webmaster" || $type=="admin"))
    $this->app->Tpl->Set(MESSAGE, "<div class=\"info\">Wollen Sie diese Seite editieren?&nbsp;&nbsp;<input type=\"button\" name=\"editPage\"  
				   value=\"Seite editieren\" 
                                   onclick=\"if(!confirm('Wollen Sie diese Seite wirklich editieren??')) return false; 
                                   else window.location.href='./index.php?module=content&action=edit&page=$page';\"/></div>");

    $this->app->Tpl->Parse($parsetarget, 'content.tpl');
    $this->app->Tpl->Parse(PAGE,"index.tpl");

  }

  function OrderAbo($userid="",$verlaengerung=false)
  {
    $abo = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE nummer='700220' LIMIT 1");
	   
		if (count($abo)<1)
			return "";

    // User-ID zwischenspeichern
    $user_id = $_SESSION[userid];
    unset($_SESSION); 

    if($abo[0][umsatzsteuer]=="ermaessigt" || $abo[0][umsatzsteuer]==1)
      $abo[0][umsatzsteuer]=7;

    $myCart=& new Cart($_SESSION[articlelist]);
    $myCart->CartAddArticle($abo[0][name_de],1,$abo[0][preis]*1.07,$abo[0][umsatzsteuer],$abo[0][nummer]);

    $bestellnummer = date('dmHis')."3".rand(1000,9999);
    $_SESSION[gesamtsumme] = number_format(CartGetTotalSumBrutto($_SESSION[articlelist]),2,",",".");
    $_SESSION[onlinebestellnummer] = $bestellnummer;
    $_SESSION[bestelldatum]=date('Y-m-d');
    $_SESSION[bestellart]="online";
		$_SESSION[zahlungsweise]="rechnung";

    // Wenn eine User-ID mitübergeben wird, wird eine Proforma-Rechnung rausgeschickt
    if(is_numeric($userid))
   	{
			if($lang=="")$lang="de";
      if(!$verlaengerung)
				$text = $this->app->DB->Select("SELECT text FROM emailvorlagen WHERE vorlage='bestellung' AND sprache='$lang' LIMIT 1");
      else
				$text = $this->app->DB->Select("SELECT text FROM emailvorlagen WHERE vorlage='aboverlaengerung' AND sprache='$lang' LIMIT 1");      

     	$kundendaten = $this->app->DB->SelectArr("SELECT * FROM kundendaten WHERE id='$userid' LIMIT 1");

     	#### SESSION setzen ####
     	$_SESSION['name'] = $this->app->erp->Decrypt($kundendaten[0][name]); 
     	$_SESSION['strasse'] = $this->app->erp->Decrypt($kundendaten[0][strasse]);
     	$_SESSION['plz'] = $this->app->erp->Decrypt($kundendaten[0][plz]);
     	$_SESSION['ort'] = $this->app->erp->Decrypt($kundendaten[0][ort]);
     	$_SESSION['adresszusatz'] = $this->app->erp->Decrypt($kundendaten[0][adresszusatz]);
     	$_SESSION['email'] = $this->app->erp->Decrypt($kundendaten[0][email]);
     	$_SESSION['emailwdh'] = $this->app->erp->Decrypt($kundendaten[0][email]);
     	$_SESSION['telefon'] = $this->app->erp->Decrypt($kundendaten[0][telefon]);
     	$_SESSION['telefax'] = "";
     	$_SESSION['kundennummer'] = $kundendaten[0][id];
     	$_SESSION['land'] = $this->app->erp->Decrypt($kundendaten[0][land]);

     	#### EMAIL erstellen ####
     	$lieferadresse = $this->app->DB->SelectArr("SELECT * FROM abonnements WHERE adresse='$userid' AND adresstyp='andere' LIMIT 1");
      
     	$email = $this->app->erp->Decrypt($kundendaten[0][email]);
     	$name = $this->app->erp->Decrypt($kundendaten[0][name]);
     	$firmenname = $this->app->erp->Decrypt($kundendaten[0][firmenname]);
     	if($firmename!="" && $name=="") $name=$firmenname;

     	// Proforma-Rechnung erstellen
     	$text = str_replace("[NAME]", $name, $text);
     	$text = str_replace("[BESTELLNUMMER]", $bestellnummer, $text);

     	// Versandadresse
     	if(count($lieferadresse)>0)
     	{
				$lAdr = $this->app->erp->Decrypt($lieferadresse[0][name])."\n";
				$lAdr .= $this->app->erp->Decrypt($lieferadresse[0][strasse])."\n";
				$lAdr .= "DE-".$this->app->erp->Decrypt($lieferadresse[0][plz])." ";
				$lAdr .= $this->app->erp->Decrypt($lieferadresse[0][ort]);
     	}else
				$lAdr = "Sie können jederzeit Ihre Versandadresse im Abonnement-Menü ändern.";
     	$text = str_replace("[LIEFERADRESSE]", $lAdr, $text);

     	// Rechnungadresse
     	$rAdr = $name."\n";
     	$rAdr .= $this->app->erp->Decrypt($kundendaten[0][strasse])."\n";
     	$rAdr .= $this->app->erp->Decrypt($kundendaten[0][land])."-";
     	$rAdr .= $this->app->erp->Decrypt($kundendaten[0][plz])." ";
     	$rAdr .= $this->app->erp->Decrypt($kundendaten[0][ort]);
     	$text = str_replace("[ANSCHRIFT]", $rAdr, $text);

     	// Zahlungsweise
     	$zahlungsweise = ucfirst($this->app->erp->Decrypt($kundendaten[0][zahlungsweise]));
     	if($zahlungsweise=="") $zahlungsweise="Vorkasse";
     	$text = str_replace("[ZAHLUNGSWEISE]", $zahlungsweise, $text); 

     	//if($zahlungsweise=="Vorkasse")
     	if(1)
     	{
				$total = number_format(CartGetTotalSumBrutto($_SESSION[articlelist]),2,",",".");

				$vorkassetext = 'Bitte überweisen Sie den Betrag von '.$total.' EUR in den nächsten 5 Tagen auf unser Konto. 
 
Kontonummer: 020746401
Bankleitzahl: 72070001
Kreditinstitut: Deutsche Bank

Verwendungszweck: '.$bestellnummer.', '.$name.'

Bei Auslandszahlungen bitte darauf achten, dass Gebühren nicht zu unseren Lasten gehen dürfen.

IBAN: DE75720700010020746400
BIC/SWIFT: DEUTDEMM720';
				$text = str_replace("[ZAHLUNGSWEISETEXT]", $vorkassetext, $text);
     	}

     	// Versandart
     	$text = str_replace("[VERSANDART]", "Brief", $text);

     	// Artikel
     	$artikel = str_pad("Nummer",10," ")." ".str_pad("Menge",7,' ')." ".str_pad("Preis",11)." Artikel\n\r";
     	foreach($_SESSION[articlelist] as $value)
     	{
				if($value[taxtype]==$value[tax])
	  			$artikel .= str_pad($value[articleid],10," ")." ".str_pad($value[quantity],7,' ')." ".str_pad(number_format($value[price],2,",","."),7)." EUR ".$value[title]."\n\r";
				else
	  			$artikel .= str_pad($value[articleid],10," ")." ".str_pad($value[quantity],7,' ')." ".str_pad(number_format($value[price]/(100+$value[taxtype])*100,2,",","."),7)." EUR ".$value[title]."\n\r";
     	}
     	$text = str_replace('[ARTIKEL]',$artikel,$text);

     	// Gesamt
     	$text = str_replace('[GESAMT]',number_format(CartGetTotalSumBrutto($_SESSION[articlelist]),2,",",".")." EUR inkl. ".number_format(CartGetTotalSumTax($_SESSION[articlelist]),2,",",".")." MwSt",$text);
     
     	// Versende E-Mail
     	$sent = $this->app->erp->MailSend("info@embedded-projects.net", "embedded projects GmbH", $email, $name, "Ihre Bestellung des Spendenabos", $text);
    }


    // Speichern
    $this->app->DB->Insert("INSERT INTO auftraege (id,sessionid,warenkorb,logdatei) 
                            VALUES ('','".session_id()."','".base64_encode(serialize($_SESSION))."',NOW())");
    $this->app->DB->Delete("DELETE FROM warenkorb WHERE sessionid='".session_id()."'");    

    // SESSION-Daten loeschen
    unset($_SESSION);
    
    // User-ID zurueckschreiben
    $_SESSION[userid] = $user_id;

    return $bestellnummer;
  }

  function FormularKundenAnfrage($parsetarget,$typ)
  {
    $service = new Serviceformular($this->app);
    switch($typ)
    {
      case 'service':
	  $this->app->Tpl->Parse(BESTELLLISTE, "serviceformular_bestellliste.tpl");
	  $this->app->Tpl->Parse(INHALT,"serviceformular.tpl");
	break;
      case 'bestellfax':
	  $service->loadSession();
	  $service->parseArticleList($_SESSION[articlelist]);
	  $this->app->Tpl->Parse(BESTELLLISTE, "serviceformular_bestellliste.tpl");
          $this->app->Tpl->Parse($parsetarget,"serviceformular.tpl"); 
	break;
      case 'rueckgaberecht':

	break;
    }
  }

  function EprooKey()
  {
    //sp45j43lv0435kljvs0jlcj 
    return "7aCN5VQKzik2cJRXdCa2j06YFl6nKCXP";
  }

  function Steuerbefreit($land,$ustid)
  {
    if($land=="DE")
      return false;

    foreach($this->GetUSTEU() as $euland)
    {
      if($land==$euland && $ustid!="")
	return true;
      else if ($land==$euland && $ustid=="")
	return false;
    }

    // alle anderen laender sind export!
    return true;
  }

  function RechnungMitUmsatzeuer($rechnung)
  {
    return true;
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$rechnung' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' LIMIT 1");
    if($land =="DE")
      return true;

   // if($this->CheckLieferantEU($adresse))
    //  return false;

    // wenn lieferant DE dann mit 19% oder 7% einkaufen
    // wenn lieferant in der EU kann man mit 0% bezahlen 

    // wenn lieferant in der welt sowieso keine steuer sondern zoll

    // wenn wir von privat EU kaufen dann muss mit steuer gekauft werden! (SPAETER KANN ES SEIN)
    return false;
  }


  function Preis($id)
  {
    $artikel = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE artikel='$id' LIMIT 1");
    if($artikel[0][umsatzsteuer]=="normal") $artikel[0][preis] = $artikel[0][preis] *1.19; else $artikel[0][preis]= $artikel[0][preis]*1.07;
    $artikel[0][preis] = number_format($artikel[0][preis],2,',','');
    return $artikel[0][preis];
  } 

  function Navigation($id=0)
  {
    //linke Navigationsleiste aufbauen
    $oberpunkte = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin,pluginparameter FROM shopnavigation WHERE parent=$id ORDER BY position");
    $navigation = "";

    foreach($oberpunkte as $punkt){

    if($_SESSION['language']=="en") $bezeichnung = $punkt["bezeichnung_en"]; else $bezeichnung = $punkt["bezeichnung"];
      
      $navigation = $navigation.'<li><a style="font-weight: bold; background-image: url(./themes/default/images/firstnav_background.png); background-repeat:repeat-x;" href="index.php?module=artikel&action='.$punkt["plugin"].'&id='
                      .$punkt["pluginparameter"].'">'.$bezeichnung.'</a></li>';
      $unterpunkte = $this->getNavList($punkt['id']);
      foreach($unterpunkte as $upunkt){
        $navigation = $navigation.'<li><a href="index.php?module=artikel&action='.$upunkt["plugin"].'&id='
                      .$upunkt["pluginparameter"].'">'.$upunkt["bezeichnung"].'</a></li>';
      }
    }
    return $navigation;
  }


  function GetDateiDB($id)
  {
    $last_modified_time = $this->app->DB->Select("SELECT UNIX_TIMESTAMP(logdatei) FROM datei WHERE datei='$id' LIMIT 1");
    $inhalt64 = $this->app->DB->Select("SELECT inhalt FROM datei WHERE datei='$id' LIMIT 1");  
    $etag = md5_file($inhalt64); 

    // Getting headers sent by the client.
    $headers = apache_request_headers(); 

    
    // Checking if the client is validating his cache and if it is current.
    if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == $last_modified_time)) {
        // Client's cache IS current, so we just respond '304 Not Modified'.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified_time).' GMT', true, 304);
    } else {
	$inhalt = base64_decode($inhalt64);
	$length = strlen($inhalt);
        // Image not cached or cache outdated, we respond '200 OK' and output the image.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified_time).' GMT', true, 200);
        header('Content-Length: '.$length);
	$file_name = $etag.".jpg";
	header("Content-Disposition: inline; filename=\"$file_name\";\n\n");
        header('Content-Type: image/jpg');
	echo $inhalt;
    }

    exit; 
  }


  function getNavList($id)
  {
    // Gebe alle Unterpunkte von $id zurueck
    $result = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin, pluginparameter FROM shopnavigation WHERE parent=$id ORDER BY position");
    foreach($result as $row){
      if($_SESSION['language']=="en") $bezeichnung = $row["bezeichnung_en"]; else $bezeichnung = $row["bezeichnung"];
      $unterpunkte[] = array('id'=>$row['id'], 'bezeichnung'=>$bezeichnung, 'plugin'=>$row['plugin'], 'pluginparameter' =>$row['pluginparameter']);
    }
    return $unterpunkte;
  }


  function GetProjektSelectMitarbeiter($adresse)
  {
    // Adresse ist Mitglied von Projekt xx
    // gibt man kein parameter an soll alles zurueck
    // entsprechen weitere parameter filtern die ausgabe
   $arr = $this->app->DB->SelectArr("SELECT adresse FROM bla bla where rolle=mitarbeiter von projekt xxx");
   foreach($arr as $value)
    {
      if($selected==$value) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$value\" $tmp>$value</option>";
    }
    return $ret;


  }

  function GetArtikelPreisvorlageProjekt($kunde,$projekt)
  {

    return 77.21;
  }

  function GetAuftragSteuersatz($auftrag)
  {
    //ermitteln aus Land und UST-ID Prüfung

    return 1.19;
  }

  function GetKreditkarten()
  {

    return array('MasterCard','Visa','American Express');
  }

  function GetKreditkartenSelect($selected)
  {
    foreach($this->GetKreditkarten() as $value)
    {
      if($selected==$value) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$value\" $tmp>$value</option>";
    }
    return $ret;
  }


  function GetKundeSteuersatz($kunde)
  {


  }

  function AddUSTIDPruefungKunde($kunde)
  {
    //gebunden an eine adresse


  }

  function GetVersandkosten($projekt)
  {

    return 3.32;
  }

  function AddArtikelAuftrag($artikel,$auftrag)
  {
    // an letzter stelle artikel einfuegen mit standard preis vom auftrag

  }

  function DelArtikelAuftrag($id)
  {
    //loesche artikel von auftrag und schiebe positionen nach


  }

  function CreateAuftrag($kunde,$projekt)
  {



  }

  function GetAuftragStatus($auftrag)
  {



  }

  function EULand($land)
  {
    if($land=="" || $land=="DE")
      return false;

    foreach($this->GetUSTEU() as $euland)
    { 
      if($land==$euland)
        return true;
    }

    // alle anderen laender sind export!
    return false;
  }



  function GetUSTEU()
  {
    return
    array('BE','IT','RO',
	  'BG','LV','SE',
	  'DK','LT','SK',
	  'DE','LU','SI',
	  'EE','MT','ES',
	  'FI','NL','CZ',
	  'FR','AT','HU',
	  'GR','PL','GB',
	  'IE','PT','CY');
  }


  function CheckUSTFormat($ust)
  {
    $land = substr($ust,0,2);
    $nummer = substr($ust,2);

    switch($land)
    {
      case "BE":
	//zehn, nur Ziffern; (alte neunstellige USt-IdNrn. werden durch Voranstellen der Ziffer Ø ergänzt)
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land."0".$nummer;
	else if(is_numeric($nummer) && strlen($nummer)==10)
	  return $land.$nummer;
	else
	  return 0;
      break;

      case "BG":
	//   neun oder zehn, nur Ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else if(is_numeric($nummer) && strlen($nummer)==10)
	  return $land.$nummer;
	else
	  return 0;
      break;

      case "DK":
	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "DE":
	//neun, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else return 0;
      break;

      case "EE":
 	//neun, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else return 0;
      break;

      case "FI":
 	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "FR":
 	//elf, nur Ziffern bzw. die erste und / oder die zweite Stelle kann ein Buchstabe sein
	if(is_numeric($nummer) && strlen($nummer)==11)
	  return $land.$nummer;
	else if(ctype_digit(substr($nummer,0,1)) &&  is_numeric(substr($nummer,1)) && strlen($nummer)==11)
	  return $land.$nummer;
	else if(ctype_digit(substr($nummer,0,2)) &&  is_numeric(substr($nummer,2)) && strlen($nummer)==11)
	  return $land.$nummer;
	else return 0;
      break;

      case "EL":
 	//neun, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else return 0;
      break;


      case "IE":
 	//acht, die zweite Stelle kann und die letzte Stelle muss ein Buchstabe sein
	if(ctype_digit(substr($nummer,7,1)) &&  is_numeric(substr($nummer,0,7)) && strlen($nummer)==8)
	  return $land.$nummer;
	else if(ctype_digit(substr($nummer,7,1)) && ctype_digit(substr($nummer,1,1)) && is_numeric(substr($nummer,0,7)) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "IT":
 	//elf, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==11)
	  return $land.$nummer;
	else return 0;
      break;


      case "LV":
 	//elf, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==11)
	  return $land.$nummer;
	else return 0;
      break;

      case "LT":
 	//neu oder zwoelf, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else if(is_numeric($nummer) && strlen($nummer)==12)
	  return $land.$nummer;
	else return 0;
      break;

      case "LU":
 	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "MT":
 	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "AT":
 	//neun, nur ziffern die erste Stelle muss U sein
	if(is_numeric(substr($nummer,1,8)) && $nummer[0]=="U" && strlen($nummer)==9)
	  return $land.$nummer;
	else return 0;
      break;


      case "PL":
 	//zehn, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==10)
	  return $land.$nummer;
	else return 0;
      break;

      case "PT":
 	//neun, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else return 0;
      break;


      case "RO":
 	//maximal zehn, nur ziffern, erste stelle !=0
	if(is_numeric($nummer) && strlen($nummer)>=10 && $nummer[0]!=0)
	  return $land.$nummer;
	else return 0;
      break;

      case "SE":
 	//zwölf, nur Ziffern, die beiden letzten Stellen bestehen immer aus der Ziffernkombination „Ø1“
	if(is_numeric($nummer) && strlen($nummer)==12 && $nummer[10] == 0 && $nummer[11]==1)
	  return $land.$nummer;
	else return 0;
      break;


      case "SK":
 	//zehn, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==10)
	  return $land.$nummer;
	else return 0;
      break;

      case "SI":
 	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "ES":
 	//neun, die erste und die letzte Stelle bzw. die erste oder die letzte Stelle kann ein Buchstabe sein
	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else if(is_numeric(substr($nummer,1,7)) && strlen($nummer)==9 && ctype_digit(substr($nummer,0,1)) && ctype_digit(substr($nummer,8,1)) )
	  return $land.$nummer;
	else if(is_numeric(substr($nummer,1,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,0,1)))
	  return $land.$nummer;
	else if(is_numeric(substr($nummer,0,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,8,1)))
	  return $land.$nummer;
	else return 0;
      break;

      case "CZ":
 	//   acht, neun oder zehn, nur Ziffern
	if(is_numeric($nummer) && strlen($nummer)>=8 && strlen($nummer)<=10)
	  return $land.$nummer;
	else return 0;
      break;

      case "HU":
 	//acht, nur ziffern
	if(is_numeric($nummer) && strlen($nummer)==8)
	  return $land.$nummer;
	else return 0;
      break;

      case "GB":
 	//neu oder zwoelf, nur ziffern, für Verwaltungen und Gesundheitswesen: fünf, die ersten zwei Stellen GD oder HA

	if(is_numeric($nummer) && strlen($nummer)==9)
	  return $land.$nummer;
	else if(is_numeric($nummer) && strlen($nummer)==12)
	  return $land.$nummer;
	else if(is_numeric(substr($nummer,2,3)) && $nummer[0]=="G" && $nummer[1]=="D")
	  return $land.$nummer;
	else if(is_numeric(substr($nummer,2,3)) && $nummer[0]=="H" && $nummer[1]=="A")
	  return $land.$nummer;
	else return 0;
      break;


      case "CY":
 	//neun, die letzte Stelle muss ein Buchstaben sein
	if(is_numeric(substr($nummer,0,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,8,1)))
	  return $land.$nummer;
	else return 0;
      break;


    }

  }
  
  function CheckUst($ust1,$ust2, $firmenname, $ort, $strasse, $plz, $druck="nein"){
    $tmp = new USTID();
    //echo $tmp->check("DE263136143","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");
    $status = $tmp->check($ust1, $ust2, $firmenname, $ort, $strasse, $plz, $druck);

    //print_r($tmp->answer);
    if($tmp->answer['Erg_Name'] == 'A')$tmp->answer['Erg_Name'] = '';     
    if($tmp->answer['Erg_Ort'] == 'A')$tmp->answer['Erg_Ort'] = '';     
    if($tmp->answer['Erg_Str'] == 'A')$tmp->answer['Erg_Str'] = '';     
    if($tmp->answer['Erg_PLZ'] == 'A')$tmp->answer['Erg_PLZ'] = '';     
        $erg = array(
	'ERG_NAME' => $tmp->answer['Erg_Name'],
	'ERG_ORT' => $tmp->answer['Erg_Ort'],
	'ERG_STR' => $tmp->answer['Erg_Str'],
	'ERG_PLZ' => $tmp->answer['Erg_PLZ']);

    $error = 0;
    //1 wenn UST-ID. korrekt
    if($status == 1){
      if($tmp->answer['Erg_Name'] == 'B')$error++;
      if($tmp->answer['Erg_Ort'] == 'B')$error++;
      if($tmp->answer['Erg_Str'] == 'B')$error++;
      if($tmp->answer['Erg_PLZ'] == 'B')$error++;

      if($error > 0)
	return $erg;
      else{
        //Brief bestellen 
	$status = $tmp->check($ust1, $ust2, $firmenname, $ort, $strasse, $plz, "ja");	
	return 1;
    }
    }else{
      return 0;
    }
    //echo $tmp->check("DE2631361d3","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");

  }

  function CreateTicket($projekt,$quelle,$kunde,$mailadresse,$betreff,$text,$medium="email")
  {

    $i=rand(300,700); 
    while(1)
    {
      $testschluessel = date('Ymd').sprintf("%04d",$i++);
      $check = $this->app->DB->Select("SELECT schluessel FROM ticket WHERE schluessel='$testschluessel' LIMIT 1");
      if($check=="") break;
    }

    $sql = "INSERT INTO ticket (`id`, `schluessel`, `zeit`, `projekt`, `quelle`, `status`, `kunde`, `mailadresse`, `prio`, `betreff`)
      VALUES (NULL, '$testschluessel', NOW(), '$projekt', '$quelle', 'offen', '$kunde', '$mailadresse', 
      '3','$betreff');";
    $this->app->DB->InsertWithoutLog($sql);
    $id = $this->app->DB->GetInsertID();


    $sql = "INSERT INTO `ticket_nachricht` (`id`, `ticket`, `zeit`,`text`,`betreff`,`medium`,`verfasser`, `mail`) 
     VALUES (NULL, '$testschluessel', NOW(), '$text','$betreff','$medium','$kunde', '$mailadresse');";

    $this->app->DB->InsertWithoutLog($sql);

    return $id;
  }

  function MailSend($from,$from_name,$to,$to_name,$betreff,$text,$files)
  {
    $this->app->mail->From       = $from;
    $this->app->mail->FromName   = utf8_decode($from_name);

    $this->app->mail->Subject    = utf8_decode($betreff);
    $this->app->mail->AddAddress($to, utf8_decode($to_name));

    $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text).$this->Signatur());
    $this->app->mail->AddBCC('sauter@embedded-projects.net');
    $this->app->mail->AddBCC('claudia.sauter@embedded-projects.net');

    for($i=0;$i<count($files);$i++)
      $this->app->mail->AddAttachment($files[$i]);

    if(!$this->app->mail->Send()) {
      $error =  "Mailer Error: " . $this->app->mail->ErrorInfo;
      return 0;
    } else {
      $error = "Message sent!";
      return 1;
    }
  }

  function TicketMail($message,$error)
  {
    $tmp = $this->app->DB->SelectArr("SELECT * FROM ticket_nachricht WHERE id='$message' LIMIT 1"); 

    $email = "sauter@ixbat.de";
    $name = "Benedikt Sauter";

    $this->app->mail->From       = "support@embedded-projects.net";
    $this->app->mail->FromName   = "embedded projects GmbH";

    $this->app->mail->Subject    = $tmp[0]['betreff']." Ticket #".$tmp[0]['ticket'];;
    $this->app->mail->AddAddress($email, $name);

    $this->app->mail->Body = $tmp[0]['textausgang']."\r\n\r\nIhre Mail:\r\n\r\n".$tmp[0]['text'].$this->Signatur();

    if(!$this->app->mail->Send()) {
      $error =  "Mailer Error: " . $this->app->mail->ErrorInfo;
      $this->app->DB->Update("UPDATE ticket_nachricht SET status='beantwortet',versendet='0' WHERE id=".$message);  
      return 0;
    } else {
      $error = "Message sent!";
      $this->app->DB->Update("UPDATE ticket_nachricht SET status='beantwortet',versendet='1' WHERE id=".$message);  
      return 1;
    }
  }

  function Signatur()
  {
    return "
--

embedded projects GmbH
Holzbachstraße 4
D-86152 Augsburg

Tel +49 821 2795990
Fax +49 821 27959920

Name der Gesellschaft: embedded projects GmbH
Sitz der Gesellschaft: Augsburg

Handelsregister: Augsburg, HRB 23930
Geschäftsführung: Benedikt Sauter, Dipl.-Inf.(FH)
USt-IdNr.: DE263136143

AGB: http://www.eproo.net/
";


  }

  function GetQuelleTicket()
  {
    return array('Telefon','Fax','Brief','Selbstabholer');
  }


  function GetPrioTicketSelect($prio)
  {
    $prios = array('5'=>'sehr niedrig','4'=>'niedrig','3'=>'normal','2'=>'wichtig','1'=>'sehr wichtig');

    foreach($prios as $key=>$value)
    {
      if($prio==$key) $selected="selected"; else $selected="";
      $ret .="<option value=\"$key\" $selected>$value</option>";
    }
    return $ret;
  }


  function GetWarteschlangeTicket()
  {
    return array('verwaltung'=>'Verwaltung','technik'=>'Technik','buchhaltung'=>'Buchhaltung');
  }

  function GetWarteschlangeTicketSelect($warteschlange)
  {
    $prios = $this->GetWarteschlangeTicket();

    foreach($prios as $key=>$value)
    {
      if($warteschlange==$key) $selected="selected"; else $selected="";
      $ret .="<option value=\"$key\" $selected>$value</option>";
    }
    return $ret;
  }


  function GetWartezeitTicket($zeit)
  {
    $timestamp = strToTime($zeit, null);
  

    $td = $this->makeDifferenz($timestamp,time());
    return $td['day'][0] . ' ' . $td['day'][1] . ', ' . $td['std'][0] . ' ' . $td['std'][1] . 
    ', ' . $td['min'][0] . ' ' . $td['min'][1];// . ', ' . $td['sec'][0] . ' ' . $td['sec'][1];
  }

  function makeDifferenz($first, $second){
    
    if($first > $second)
        $td['dif'][0] = $first - $second;
    else
        $td['dif'][0] = $second - $first;
    
    $td['sec'][0] = $td['dif'][0] % 60; // 67 = 7

    $td['min'][0] = (($td['dif'][0] - $td['sec'][0]) / 60) % 60; 
    
    $td['std'][0] = (((($td['dif'][0] - $td['sec'][0]) /60)- 
    $td['min'][0]) / 60) % 24;
    
    $td['day'][0] = floor( ((((($td['dif'][0] - $td['sec'][0]) /60)- 
    $td['min'][0]) / 60) / 24) );
    
    $td = $this->makeString($td);
    
    return $td;
    
  }


  function makeString($td){
    
    if ($td['sec'][0] == 1)
        $td['sec'][1] = 'Sekunde';
    else 
        $td['sec'][1] = 'Sekunden';
    
    if ($td['min'][0] == 1)
        $td['min'][1] = 'Minute';
    else 
        $td['min'][1] = 'Minuten';
        
    if ($td['std'][0] == 1)
        $td['std'][1] = 'Stunde';
    else 
        $td['std'][1] = 'Stunden';
        
    if ($td['day'][0] == 1)
        $td['day'][1] = 'Tag';
    else 
        $td['day'][1] = 'Tage';
    
    return $td;
    
  }


  function GetProjektSelect($projekt,$color_selected)
  {

    $sql = "SELECT id,name,farbe FROM projekt order by name";
    $tmp = $this->app->DB->SelectArr($sql);
    for($i=0;$i<count($tmp);$i++)
    {
      if($tmp[$i]['farbe']=="") $tmp[$i]['farbe']="white";
      if($projekt==$tmp[$i]['id']){
	$options = $options."<option value=\"{$tmp[$i]['id']}\" selected 
	  style=\"background-color:{$tmp[$i]['farbe']};\">{$tmp[$i]['name']}</option>";
	$color_selected = $tmp[$i]['farbe'];
      }
      else
        $options = $options."<option value=\"{$tmp[$i]['id']}\" 
	  style=\"background-color:{$tmp[$i]['farbe']};\">{$tmp[$i]['name']}</option>";
    }
    return $options;

  }

  function GetAdressName($id)
  {
    $result = $this->app->DB->SelectArr("SELECT name,vorname FROM adresse WHERE id='$id' LIMIT 1");
    return $result[0][vorname]." ".$result[0][name];
  }

  function GetAdressSubject()
  {
    return array('Kunde','Lieferant','Mitarbeiter','Ansprechpartner');
  }

  function GetAdressPraedikat()
  {
    return array('','von','fuer','ist');
  }

  function GetAdressObjekt()
  {
    return array('','Projekt');
  }

  function GetVersandartLieferant()
  {
    return array('DHL','UPS','Hermes','DPD','GLS','Post','Spedition');
  }

  function GetZahlungsweiseLieferant()
  {
    return array('Rechnung','Vorkasse','Nachnahme','Kreditkarte','Bar');
  }


  function GetArtikelWarengruppe()
  {
    //return array('SMD','THT','EBG','BGP');
    $tmp = array('','Bauteil','Eval-Board','Adapter','Progammer','Ger&auml;t','Kabel','Software','Dienstleistung','Spezifikation');
    sort($tmp);
    return $tmp;
  }

  function GetStatusBestellung()
  {
    return array('offen','freigegeben','bestellt','angemahnt','empfangen');
  }

  function GetSelect($array, $selected)
  {
    foreach($array as $key=>$value)
    {
      if($selected==$key) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$key\" $tmp>$value</option>";
    }
    return $ret;
  }

  function AddRolleZuAdresse($adresse, $subjekt, $praedikat, $objekt, $parameter)
  {
    // Insert ....  
    $sql ="INSERT INTO adresse_rolle (id, adresse, subjekt, praedikat, objekt, parameter)
	    VALUES ('','$adresse','$subjekt','$praedikat','$objekt','$parameter')";
    $this->app->DB->Insert($sql);
    $id =  $this->app->DB->GetInsertID();


    // wenn adresse zum erstenmal die rolle erhält wird kundennummer bzw. lieferantennummer vergeben
    if($subjekt=="Kunde")
    {
      $kundennummer = $this->GetNextKundennummer();
      $this->app->DB->Update("UPDATE adresse SET kundennummer='$kundennummer' WHERE id='$adresse' AND kundennummer='0' LIMIT 1");
    }

    if($subjekt=="Lieferant")
    {
      $lieferantennummer = $this->GetNextLieferantennummer();
      $this->app->DB->Update("UPDATE adresse SET lieferantennummer='$lieferantennummer' WHERE id='$adresse' AND lieferantennummer='0' LIMIT 1");
    }

  }

  function AddArbeitszeit($adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung, $projekt, $paketauswahl)
  {
    $insert = "";
    if($paketauswahl=="manuell"){
      if($projekt=="")
        $projekt=0;
      $insert = 'INSERT INTO zeiterfassung (adresse, von, bis, aufgabe, beschreibung, projekt, buchungsart) VALUES ('.$adr_id.',"'.$vonZeit.'","'.$bisZeit.'","'.$aufgabe.'", "'.$beschreibung.'",'.$projekt.', "manuell")';
    }else{
      $projekt = $this->app->DB->SelectArr("SELECT aufgabe, beschreibung, projekt, kostenstelle FROM arbeitspakete WHERE id = $paketauswahl");
      $myArr = $projekt[0];
      $insert = 'INSERT INTO zeiterfassung (adresse, von, bis, arbeitspaket, aufgabe, beschreibung, projekt, buchungsart) VALUES ('.$adr_id.',"'.$vonZeit.'","'.$bisZeit.'",'.$paketauswahl.' , "'.$myArr["aufgabe"].'", "'.$myArr["beschreibung"].'",'.$myArr["projekt"].', "AP")';
    }
    $this->app->DB->Insert($insert);

      // wenn art=="AP" hole projekt und kostenstelle aus arbeitspaket beschreibung
      // und update zuvor angelegten datensatz
  }


  /**
   * \brief   Anlegen eines Arbeitspakets
   *
   *         Diese Funktion legt ein Arbeitspaket an.
   *
   * \param   aufgabe      Kurzbeschreibung (ein paar Woerter)  
   * \param   beschreibung  Textuelle Beschreibung 
   * \param   projekt      Projekt ID 
   * \param   zeit_geplant  Stundenanzahl Integer Wert
   * \param   kostenstelle  Kostenstelle 
   * \param   initiator            user id des Initiators
   * \param   abgabedatum   Datum fuer Abgabe 
   * \return                Status-Code
   *
   */
  function CreateArbeitspaket($adressse, $aufgabe,$beschreibung,$projekt,$zeit_geplant,$kostenstelle,$initiator,$abgabedatum="")
  {
      if(($abgabe != "") && ($beschreibung != "") && ($projekt != "") && ($zeit_geplant != "") && ($kostenstelle != "") && ($initiator != "")){
       $this->app->DB->Insert('INSERT INTO arbeitspakete                                                                                                                                   (adresse, aufgabe, beschreibung, projekt, zeit_geplant, kostenstelle, initiator, abgabedatum)                                                                VALUES (                                                                                                                                                      '.$adresse.',"'.$aufgabe.'", "'.$beschreibung.'", '.$projekt.', '.$zeit_geplant.','.$kostenstelle.', '.$initiator.',"'.$abgabedatum.'")');
       return 1;
      }else
       return 0;
  }

  function IsAdresseSubjekt($adresse,$subjekt)
  {
    $id = $this->app->DB->Select("SELECT id FROM adresse_rolle WHERE adresse='$adresse' AND subjekt='$subjekt' LIMIT 1");  
    if($id > 0)
      return 1;
    else return 0;
  }

  function AddOffenenVorgang($adresse, $titel, $href, $beschriftung="", $linkremove="")
  {
    $sql = "INSERT INTO offenevorgaenge (id,adresse,titel,href,beschriftung,linkremove) VALUES
	    ('','$adresse','$titel','$href','$beschriftung','$linkremove')";
    $this->app->DB->Insert($sql);
  }


  function RemoveOffenenVorgangID($id)
  {
    $sql = "DELETE FROM offenevorgaenge WHERE id='$id' LIMIT 1";
    $this->app->DB->Delete($sql);
  }


  function GetNextKundennummer()
  {
    $sql = "SELECT MAX(kundennummer) FROM adresse";
    $nummer = $this->app->DB->Select($sql) + 1;
    if($nummer==1)
      $nummer = 10000;
    return $nummer;
  }

  function GetNextLieferantennummer()
  {
    $sql = "SELECT MAX(lieferantennummer) FROM adresse";
    $nummer = $this->app->DB->Select($sql) + 1;
    if($nummer==1)
      $nummer = 70000;
    return $nummer;
  }


  function LoadBestellungStandardwerte($id,$adresse)
  {
    // standard adresse von lieferant       
    $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
    $field = array('name','vorname','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','lieferantennummer');
    foreach($field as $key=>$value)
    {
      $this->app->Secure->POST[$value] = $arr[0][$value];
      $uparr[$value] = $arr[0][$value];
    }
    $this->app->DB->UpdateArr("bestellung",$id,"id",$uparr);
    $uparr="";

    //liefernantenvorlage
    $arr = $this->app->DB->SelectArr("SELECT * FROM lieferantvorlage WHERE adresse='$adresse' LIMIT 1");
    $field = array('kundennummer','zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');
    foreach($field as $key=>$value)
    {
      //$uparr[$value] = $arr[0][$value];
      $this->app->Secure->POST[$value] = $arr[0][$value];
    }
    //$this->app->DB->UpdateArr("bestellung",$id,"id",$uparr);

  }


  function CreateBestellung()
  {
    $belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM bestellung WHERE firma='".$this->app->User->GetFirma()."'");
    if($belegmax==0) $belegmax = 10000;  else $belegmax++;

    $this->app->DB->Insert("INSERT INTO bestellung (id,datum,bearbeiter,firma,belegnr) 
      VALUES ('',NOW(),'".$this->app->User->GetAdresse()."','".$this->app->User->GetFirma()."','$belegmax')");

    return $this->app->DB->GetInsertID();
  }

  function GetUserKalender($adresse)
  {
    return $this->app->DB->SelectArr("SELECT id, name, farbe FROM kalender WHERE id IN (SELECT kalender FROM kalender_user WHERE adresse = $adresse);");
  }
  function GetAllKalender($adresse="")
  {
    return $this->app->DB->SelectArr("SELECT id, name, farbe".($adresse!=""?", IFNULL((SELECT 1 FROM kalender_user WHERE adresse=$adresse AND kalender_user.kalender=kalender.id),0) zugriff":"")." FROM kalender;");
  }
  
  function GetUserKalenderIds($adresse)
  {
    $arr = array();
    foreach ($this->GetUserKalender($adresse) as $value)
      array_push($arr,$value["id"]);
    return $arr;
  }

  function GetAllKalenderIds($adresse="")
  {
    $arr = array();
    foreach ($this->GetAllKalender($adresse) as $value)
      array_push($arr,$value["id"]);
    return $arr;
  }
  
  function GetKalenderSelect($adresse,$selectedKalender=array())
  {
    $arr = $this->GetUserKalender($adresse);
    foreach($arr as $value)
    { 
      $tmp = (in_array($value["id"],$selectedKalender))?" selected=\"selected\"":"";
      $ret .= "<option value=\"".$value["id"]."\"$tmp>".$value["name"]."</option>";
    }
    return $ret;
  }

  function GetKwSelect($selectedKW="")
  {
    foreach(range(1,52) as $kw)
    { 
      $tmp = ($selectedKW==$kw)?" selected=\"selected\"":"";
      $ret .= "<option value=\"$kw\"$tmp>$kw</option>";
    }
    return $ret;
  }

  function GetYearSelect($selectedYear="", $yearsBefore=2, $yearsAfter=10)
  {
    foreach(range(date("Y")-$yearsBefore, date("Y")+$yearsAfter) as $year)
    { 
      $tmp = ($selectedYear==$year)?" selected=\"selected\"":"";
      $ret .= "<option value=\"$year\"$tmp>$year</option>";
    }
    return $ret;
  }


  function CreateDatei($name,$titel,$beschreibung,$nummer,$datei,$ersteller)
  {
    $this->app->DB->Insert("INSERT INTO datei (id,titel,beschreibung,nummer) VALUES
      ('','$titel','$beschreibung','$nummer')");

    $fileid = $this->app->DB->GetInsertID();
    $this->AddDateiVersion($fileid,$ersteller,$name,"Initiale Version",$datei);

    return  $fileid;
  }


  function AddDateiVersion($id,$ersteller,$dateiname, $bemerkung,$datei)
  {
    // ermittle neue Version
    $version = $this->app->DB->Select("SELECT COUNT(id) FROM datei_version WHERE datei='$id'") + 1;

    // speichere werte ab 
    $this->app->DB->Insert("INSERT INTO datei_version (id,datei,ersteller,datum,version,dateiname,bemerkung)
    VALUES ('','$id','$ersteller',NOW(),'$version','$dateiname','$bemerkung')");

    $versionid = $this->app->DB->GetInsertID();
    move_uploaded_file($datei,"/home/eproo/shop/webroot/dms/".$versionid);
  }


  function AddDateiStichwort($id,$subjekt,$objekt,$parameter)
  {
    $this->app->DB->Insert("INSERT INTO datei_stichwoerter (id,datei,subjekt,objekt,parameter)
    VALUES ('','$id','$subjekt','$objekt','$parameter')");
  }

  function Hilfebox($id)
  {
    if($id!="")
    {
      $text = $this->app->DB->Select("SELECT html FROM inhalt WHERE inhalt='$id' LIMIT 1");
      if($text!="")
      {
	$this->app->Tpl->Set(HILFETEXT, html_entity_decode($text));
	$this->app->Tpl->Parse(HILFE, "hilfe.tpl");
      }
    }

  }

  function Decrypt($text)
  {
      $hash = hash('ripemd128', $this->EprooKey());
      $aes = new AES($hash);
      return $aes->decrypt(base64_decode($text));
  }

  function Encrypt($text)
  {
    $hash = hash('ripemd128', $this->EprooKey());
    $aes = new AES($hash);
    return base64_encode($aes->encrypt($text));
  }

  // Convertiert MySQL-Datum YYYY-MM-DD nach DD.MM.YYYY
  function ConvertDate($mysqlDate)
  {
    if($mysqlDate != "")
      return $this->app->String->Convert($mysqlDate,"%1-%2-%3","%3.%2.%1");
  }

  // Convertiert nach MySQL-Datum, DD.MM.YYYY nach YYYY-MM-DD 
  function ConvertToSqlDate($date)
  {
    if($date != "")
      return $this->app->String->Convert($date,"%3.%2.%1","%1-%2-%3");
  }

  function ConvertDateTime($mysqlDateTime)
  {
    if($mysqlDateTime != "")
      return $this->app->String->Convert($mysqlDateTime,"%1-%2-%3 %4:%5:%6","%3.%2.%1 %4:%5 Uhr");

  }

  function Wochenplan($adr_id,$parsetarget){
    $this->app->Tpl->Set(SUBSUBHEADING, "Wochenplan");
    $this->app->Tpl->Set(INHALT,"");

    $anzWochentage = 5;
    $startStunde = 6;
    $endStunde = 22;

    $wochentage = $this->getDates($anzWochentage);

    $inhalt = "";
    for($i=$startStunde;$i<=$endStunde;$i++){ // fuelle Zeilen 06:00 bis 22:00
        $zeile = array();
        $zeileCount = 0;
        foreach($wochentage as $tag){ // hole Daten fuer Uhrzeit $i und Datum $tage
          $result = $this->checkCell($tag, $i, $adr_id);
          if($result[0]['aufgabe'] != "")
	  {
	    if($result[0]['adresse']==0) $color = '#ccc'; else $color='#BCEE68';
	    if($result[0]['prio']==1) $color = 'red';
	    
            $zeile[$zeileCount] = '<div style="background-color: '.$color.'">'.$result[0]['aufgabe'].'</div>';
	  }
          else
            $zeile[$zeileCount] = "&nbsp;";
          $zeileCount++;
        }
        //print_r($zeile);
        $inhalt = $inhalt.$this->makeRow($zeile, $anzWochentage,$i.":00");
    }
    $this->app->Tpl->Set(WOCHENDATUM, $this->makeRow($wochentage, $anzWochentage));
    $this->app->Tpl->Set(INHALT,$inhalt);

    $this->app->Tpl->Parse($parsetarget,"zeiterfassung_wochenplan.tpl");

    $this->app->Tpl->Add($parsetarget,"<table><tr>                                                                                                                                     <td style=\"background-color:#BCEE68\">".$this->app->User->GetName()."</td>
      <td style=\"background-color:red\">Prio: Sehr Hoch (".$this->app->User->GetName().")</td>
      <td style=\"background-color:#ccc\">Allgemein</td></tr></table>");
  }

  function getDates($anzWochentage){
    // hole Datum der Wochentage von Mo bis $anzWochentage
    $montag = $this->app->DB->Select("SELECT DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) day)");
    $week = array();
    for($i=0;$i<$anzWochentage;$i++)
      $week[$i] = $this->app->DB->Select("SELECT DATE_ADD('$montag',INTERVAL $i day)");
  return $week;
  }

  function makeRow($data, $spalten, $erstefrei="frei"){
    // erzeuge eine Zeile in der Tabelle
    // $erstefrei = 1 -> erste Spalte ist leer

    $row = '<tr>';
      if($erstefrei=="frei")
        $row = $row.'<td class="wochenplan">&nbsp;</td>';
      else
        $row = $row.'<td class="wochenplan">'.$erstefrei.'</td>';
      for($i=0;$i<$spalten; $i++)
        $row = $row.'<td class="wochenplan">'.$data[$i].'</td>';
    $row = $row.'</tr>';
  return $row;
  }


  function checkCell($datum, $stunde, $adr_id)
  {
    // ueberprueft ob in der Stunde eine Aufgabe zu erledigen ist
    //echo $datum." ".$stunde."<br>";
    return  $this->app->DB->SelectArr("SELECT aufgabe,adresse,prio
                                    FROM aufgabe
                                    WHERE DATE(startdatum) = '$datum'
                                     AND HOUR(TIME(startzeit)) <= $stunde 
                                     AND HOUR(TIME(startzeit)) + stunden >= $stunde
                                     AND (adresse = $adr_id OR adresse = 0)
                                    OR 
                                     ((DATE_SUB('$datum', INTERVAL MOD(DATEDIFF('$datum',DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day)='$datum'
                                     AND DATE_SUB('$datum', INTERVAL MOD(DATEDIFF('$datum',DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day)
                                         > abgeschlossen_am
                                     AND intervall_tage>0 AND (adresse=$adr_id OR adresse=0))
                                     AND HOUR(TIME(startzeit)) <= $stunde AND HOUR(TIME(startzeit)) + stunden >= $stunde) 
                                    LIMIT 1");
  }

  function checkImage($file,$maxSize=0,$x=0,$y=0)
  {
    // Prueft ein Bild auf Dateigroesse, Hoehe und Breite
    if($file!="")
    {
      if(is_array($file))
        $pfad = $file[tmp_name];
      else $pfad = $file;
    }
    $typ = GetImageSize($pfad);
    $size = $file[size];


    if($maxSize==0)
      $fileSizeLimit =  10485760; // 10MB in BYTE, 100MB stehen in der upload_max_size
    else
      $fileSizeLimit = $maxSize;

    if(0 < $typ[2] && $typ[2] < 4)
      {
        if($size<$fileSizeLimit)
        {
          if($typ[0]>$x && $x!=0)
            $error = "Das Bild ist zu breit.";
          if($typ[1]>$y && $y!=0)
            $error = "Das Bild ist zu hoch.";
        }else
          $error = "Die Datei darf eine Gr&ouml;&szlig;e von ".($fileSizeLimit/8388608)." MB nicht &uuml;berschreiten.";
      }else
        $error = "Die Datei muss vom Typ GIF, JPG oder PNG sein";
    return $error;
  }

  function uploadImageIntoDB($file)
  {
    // Wandelt ein Bild fuer einen LONGBLOB um
    $pfad = $file[tmp_name];
    $typ = GetImageSize($pfad);
    // Bild hochladen
    $filehandle = fopen($pfad,'r');
    $filedata = base64_encode(fread($filehandle, filesize($pfad)));
    $dbtype = $typ['mime'];
    return array("bild"=>$filedata,"typ"=>$dbtype);
  }

  function getImageExtension($mime)
  {
    switch($mime)
    {
      case "image/jpeg":
        $ext = ".jpg";
      break;
      case "image/png":
        $ext = ".png";
      break;
      case "image/gif":
        $ext = ".gif";
      break;
    }
    return $ext;
  }

  function makeThumbnail($bild, $maxBreite=0, $maxHoehe=0)
  {
    $size = getimagesize($bild);
    $breite = $size[0];
    $hoehe = $size[1];

    if($breite > 0 && $hoehe > 0)
    { 
      // Groesse berechnen
      if($maxBreite > 0 && $maxHoehe > 0)
      {
	if($breite >= $hoehe)
	{
	  $neueBreite = $maxBreite;
	  $neueHoehe = ($hoehe * $maxBreite) / $breite;
	}
	else
	{
	  $neueHoehe = $maxHoehe;
	  $neueBreite = ($breite * $maxHoehe) / $hoehe;
	}
      }
      else if($maxBreite > 0)
      {
	$scale = $breite / $hoehe;
	$neueBreite = $maxBreite;
	$neueHoehe = $maxBreite / $scale; 
      }
      else if($maxHoehe > 0)
      {
	$scale = $breite / $hoehe;
	$neueHoehe = $maxHoehe;
	$neueBreite = $neueHoehe * $scale;
      }
      else
      {
	$neueBreite = $breite;
	$neueHoehe = $hoehe;
      }

      // bild umwandeln       
      if($size[2]==1)
      {
	// GIF
	$altesBild = ImageCreateFromGif($bild);
	$neuesBild = ImageCreate($neueBreite, $neueHoehe);
	ImageCopyResized($neuesBild, $altesBild, 0, 0, 0, 0, $neueBreite, $neueHoehe, $breite, $hoehe );
	ob_start();
	ImageGif($neuesBild);
	$raw_data = ob_get_contents();
	ob_end_clean();
	return array("data"=>base64_encode($raw_data), "typ"=>"image/gif");
      }
      else if($size[2]==2)
      {
	// JPG
	$altesBild = ImageCreateFromJpeg($bild);
        $neuesBild = ImageCreateTrueColor($neueBreite, $neueHoehe);
        ImageCopyResized($neuesBild, $altesBild, 0, 0, 0, 0, $neueBreite, $neueHoehe, $breite, $hoehe );
        ob_start();
        ImageJpeg($neuesBild);
        $raw_data = ob_get_contents();
        ob_end_clean();
        return array("data"=>base64_encode($raw_data), "typ"=>"image/jpeg");

      }
      else if($size[2]==3)
      {
	// PNG
	$altesBild = ImageCreateFromPng($bild);
        $neuesBild = ImageCreateTrueColor($neueBreite, $neueHoehe);
        ImageCopyResized($neuesBild, $altesBild, 0, 0, 0, 0, $neueBreite, $neueHoehe, $breite, $hoehe );
        ob_start();
        ImagePng($neuesBild);
        $raw_data = ob_get_contents();
        ob_end_clean();
        return array("data"=>base64_encode($raw_data), "typ"=>"image/png");
      }
    }
  }


  function genRandomString() 
  {
    $length = 6;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $string = "";    

    for ($p=0;$p<$length;$p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
  }

  function getClass($i)
  {
    if($i%2==1) return "tr-odd"; else return "tr-even";
  }

  function changePassword($email, $newPass="", $sendmail=1)
  {
    if($email!="")
    {
      $user_id = $this->app->DB->Select("SELECT id FROM user WHERE username='".md5($email)."' LIMIT 1");   
      if(is_numeric($user_id))
      {
	if($newPass=="")
	  $newPass = $this->genRandomString();	

	
	$kunde = $this->app->DB->Select("SELECT kundendaten FROM user WHERE id='$user_id' LIMIT 1");

	$email = $this->Decrypt($this->app->DB->Select("SELECT email FROM kundendaten WHERE id='$kunde' LIMIT 1"));
	$name = $this->Decrypt($this->app->DB->Select("SELECT name FROM kundendaten WHERE id='$kunde' LIMIT 1"));

 	$mailtext = "Hallo $name, \r\n\r\nIhr Passwort wurde geändert: $newPass\r\n\r\nDas embedded projects Team";

	if($sendmail==1)
	{
	  $sent = $this->app->erp->MailSend("info@embedded-projects.net", "embedded projects GmbH", $email, $name, "Ihr neues Passwort", $mailtext);
	
	  if($sent==1)
	  {	
	    $this->app->DB->Update("UPDATE user SET password='".md5($newPass)."' WHERE username='".md5($email)."' LIMIT 1");
	    return 1;
	  }else
	    return 0;
	}else
	{
	  $this->app->DB->Update("UPDATE user SET password='".md5($newPass)."' WHERE username='".md5($email)."' LIMIT 1");
            return 1;
	}
      }

    }
  }  
}

?>

<?
/* Author: Benedikt Sauter <sauter@sistecs.de> 2007
 *
 * Hier werden alle Plugins, Widgets usw instanziert die
 * fuer die Anwendung benoetigt werden.
 * Diese Klasse ist von class.application.php abgleitet.
 * Das hat den Vorteil, dass man dort bereits einiges starten kann,
 * was man eh in jeder Anwendung braucht.
 * - DB Verbindung
 * - Template Parser
 * - Sicherheitsmodul
 * - String Plugin
 * - usw....
 */
include("../phpwf/class.application.php");

include("widgets/artikeltable.php");
include("widgets/widget.aufgabe.php");
include("widgets/widget.arbeitspaket.php");
include("widgets/widget.verkaufspreise.php");
include("widgets/widget.einkaufspreise.php");
include("widgets/widget.lieferadressen.php");
include("widgets/widget.brief.php");
include("widgets/widget.email.php");
include("widgets/widget.stueckliste.php");
include("widgets/widget.lieferantvorlage.php");
include("widgets/widget.bestellung_position.php");
include("widgets/widget.auftrag_artikel.php");
include("widgets/widget.webmail_mails.php");
include("widgets/widget.lager_platz.php");

include('lib/pdf/fpdf_final.php');
define('FPDF_FONTPATH','lib/pdf/font/');

include("lib/dokumente/class.superfpdf.php");
include("lib/dokumente/class.etikett.php");
include("lib/dokumente/class.briefpapier.php");
include("lib/dokumente/class.bestellfax.php");

include("lib/dokumente/class.brief.php");
include("lib/dokumente/class.bestellung.php");
include("lib/dokumente/class.angebot.php");
include("lib/dokumente/class.auftrag.php");
include("lib/dokumente/class.rechnung.php");
include("lib/dokumente/class.proformarechnung.php");
include("lib/dokumente/class.lieferschein.php");
include("lib/dokumente/class.service.php");


include("lib/class.erpapi.php");
include("lib/class.ustid.php");
include("lib/class.serviceformular.php");
include("plugins/phpmailer/class.phpmailer.php");
include("lib/class.aes.php");


include("lib/onlinebestellung/cart/cart.inc.php");
include("lib/onlinebestellung/cart/cart.class.php");

include("pages/loginbox.php");
include("pages/news.php");
include("pages/bannermanager.php");

class erpooSystem extends Application
{
  public $obj;

  public function __construct($config,$group="") 
  {
    parent::Application($config,$group);

   
    // objekt api laden
    //$this->obj = new ObjConductor(&$this);
    
    // hier kann man standard plugins auch einstellen
    // $this->FormHandler->DefaultErrorClass("spezielleklasse");
    
    // hier koennte man extra plugins laden
    // $this->meinplugin = new MeinPlugin(&$this);

    $this->erp = new erpAPI(&$this);
    $this->mail = new PHPMailer();
    $this->mail->PluginDir="plugins/phpmailer/";
    $this->mail->IsSMTP();
    $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
    $this->mail->SMTPSecure = "";                 // sets the prefix to the servier
    $this->mail->Host       = "mail.embedded-projects.net";      // sets GMAIL as the SMTP server
    $this->mail->Port       = 25;                   // set the SMTP port for the GMAIL server

    $this->mail->Username   = "send@embedded-projects.net";  // GMAIL username
    $this->mail->Password   = "apfelschorle";            // GMAIL password

    // templates laden
    $this->Tpl->ReadTemplatesFromPath("widgets/templates/_gen/");
    $this->Tpl->ReadTemplatesFromPath("widgets/templates/");
    //$this->Tpl->ReadTemplatesFromPath("themes/default/templates/");
    $this->Tpl->ReadTemplatesFromPath("themes/".$config->WFconf[defaulttheme]."/templates/");
    $this->Tpl->ReadTemplatesFromPath("pages/content/_gen/");
    $this->Tpl->ReadTemplatesFromPath("pages/content/");

    $this->Tpl->Set(WEBROOT,"./themes/".$config->WFconf[defaulttheme]);

    $module = $this->Secure->GetGET("module");
    if($module == "")
      $module = "welcome";
    $this->Tpl->Set(ICON,$module);

    //$this->YUI->AutoComplete(SUCHEAUTO,"artikel",array('name_de'),"name_de");
    //$this->YUI->AutoComplete(SUCHEGROSSAUTO,"artikel",array('nummer','name_de'),"name_de");

    $this->Tpl->Set(ANALYTICS,'
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-1088253-4\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    ');
   // wenn angenelde
   if($this->User->GetID() > 0)
   {
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=reader&action=list">Getting started</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=stock&action=list">My Things</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=settings&action=list">Settings</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=welcome&action=logout">Logout</a></li>');
   } else {
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=reader&action=screenshot">Introduction</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=reader&action=list">Getting started</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=register&action=list">Register</a></li>');
      $this->Tpl->Add(SUBNAVIGATION,'<li><a href="index.php?module=welcome&action=login">Login</a></li>');
   }


    if($_SESSION['language']=="en")
      $this->Tpl->Set(AKTUALISIERUNG,"Last update: ".date('d.m.Y'));
    else
      $this->Tpl->Set(AKTUALISIERUNG,"Letzte Aktualisierung: ".date('d.m.Y'));

    // LoginBox laden
    //$login = new LoginBox(&$this);
    //$login->LoginBoxList();


  }

  function calledWhenAuth($type)
  {
    $id = $this->Secure->GetGET("id");
    $module = $this->Secure->GetGET("module");


    // parse user lists for menue
    $this->erp->ParseMenuLists();


    // hier muss man 

/*
    if($this->Secure->GetPOST("projekt")=="")
      $selectid = $this->DB->Select("SELECT projekt FROM `$module` WHERE id='$id' LIMIT 1");
    else
      $selectid = $this->Secure->GetPOST("projekt");

    $options = $this->erp->GetProjektSelect($selectid,&$color_selected); 
    $this->Tpl->Set(EPROO_SELECT_PROJEKT,"<select name=\"projekt\" 
      style=\"background-color:$color_selected;\"
      onChange=\"this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor\">$options</select>");
    //$this->Tpl->Set(EPROO_SELECT_PROJEKT,"<select name=\"projekt\" onChange=\"fillUnterprojekt();\">$options</select>");
    //$this->Tpl->Set(EPROO_SELECT_UNTERPROJEKT,"<select name=\"unterprojekt\"><option>Einkauf Olimex</option></select>");
    $this->Tpl->Set(EPROO_SELECT_UNTERPROJEKT,"<div id=\"selectunterprojekt\">
    <select name=\"unterprojekt\">
    </select>
    </div>");

    if($this->Secure->GetPOST("land")=="")
      $selectid = $this->DB->Select("SELECT land FROM `$module` WHERE id='$id' LIMIT 1");
    else
      $selectid = $this->Secure->GetPOST("land");

    $this->Tpl->Set(EPROO_SELECT_LAND,"<select name=\"land\">".$this->SelectLaenderliste($selectid)."</select>");

    if($this->Secure->GetPOST("lieferland")=="")
      $selectid = $this->DB->Select("SELECT lieferland FROM `$module` WHERE id='$id' LIMIT 1");
    else
      $selectid = $this->Secure->GetPOST("lieferland");

    $this->Tpl->Set(EPROO_SELECT_LIEFERLAND,"<select name=\"lieferland\">".$this->SelectLaenderliste($selectid)."</select>");



    //fenster rechts offene vorgaenge ***
    $this->Tpl->Set(SUBSUBHEADING,"Offene Vorg&auml;nge");
    $arrVorgaenge = $this->DB->SelectArr("SELECT * FROM offenevorgaenge WHERE adresse='{$this->User->GetAdresse()}' ORDER by logdatei DESC");
    $this->Tpl->Set(INHALT,"");
    $this->Tpl->Set(LINK,"<a href=\"index.php?module=welcome&action=vorgang\">Aktuelle Stelle merken</a>");
    if(count($arrVorgaenge) > 0)
    {

      for($i=0;$i<count($arrVorgaenge);$i++)
      {
	$this->Tpl->Add(INHALT,"<b>".ucfirst($arrVorgaenge[$i]['titel']).
	  "</b><br>".$arrVorgaenge[$i]['beschriftung'].
	  "<br><a href=\"index.php?".$arrVorgaenge[$i]['href']."\">Bearbeiten</a>&nbsp;|&nbsp;<a href=\"index.php?module=welcome&action=removevorgang&vorgang={$arrVorgaenge[$i]['id']}\">Erledigt</a>");
	if($i < count($arrVorgaenge)-1)
	  $this->Tpl->Add(INHALT,"<hr>");
      }
    }
    $this->Tpl->Parse(FENSTERRECHTS,"rahmen_klein.tpl");
    $this->Tpl->Set(INHALT,"");
*/
    //ende fenster rechts offene vorgaenge ***
  }


  function SelectLaenderliste($selected="")
  {
    if($selected=="") $selected="DE";

    $laender = array(
    //'Afghanistan'  => 'AF',
    //'&Auml;gypten'  => 'EG',
    //'Albanien'  => 'AL',
    //'Algerien'  => 'DZ',
    //'Andorra'  => 'AD',
    //'Angola'  => 'AO',
    //'Anguilla'  => 'AI',
    //'Antarktis'  => 'AQ',
    //'Antigua und Barbuda'  => 'AG',
    //'&Auml;quatorial Guinea'  => 'GQ',
    //'Argentinien'  => 'AR',
    //'Armenien'  => 'AM',
    //'Aruba'  => 'AW',
    //'Aserbaidschan'  => 'AZ',
    //'&Auml;thiopien'  => 'ET',
    //'Australien'  => 'AU',
    //'Bahamas'  => 'BS',
    //'Bahrain'  => 'BH',
    //'Bangladesh'  => 'BD',
    //'Barbados'  => 'BB',
    'Belgien'  => 'BE',
    //'Belize'  => 'BZ',
    //'Benin'  => 'BJ',
    //'Bermudas'  => 'BM',
    //'Bhutan'  => 'BT',
    //'Birma'  => 'MM',
    //'Bolivien'  => 'BO',
    //'Bosnien-Herzegowina'  => 'BA',
    //'Botswana'  => 'BW',
    //'Bouvet Inseln'  => 'BV',
    //'Brasilien'  => 'BR',
    //'Britisch-Indischer Ozean'  => 'IO',
    //'Brunei'  => 'BN',
    'Bulgarien'  => 'BG',
    //'Burkina Faso'  => 'BF',
    //'Burundi'  => 'BI',
    //'Chile'  => 'CL',
    //'China'  => 'CN',
    //'Christmas Island'  => 'CX',
    //'Cook Inseln'  => 'CK',
    //'Costa Rica'  => 'CR',
    'D&auml;nemark'  => 'DK',
    'Deutschland'  => 'DE',
    //'Djibuti'  => 'DJ',
    //'Dominika'  => 'DM',
    //'Dominikanische Republik'  => 'DO',
    //'Ecuador'  => 'EC',
    //'El Salvador'  => 'SV',
    //'Elfenbeink&uuml;ste'  => 'CI',
    //'Eritrea'  => 'ER',
    'Estland'  => 'EE',
    //'Falkland Inseln'  => 'FK',
    //'F&auml;r&ouml;er Inseln'  => 'FO',
    //'Fidschi'  => 'FJ',
    'Finnland'  => 'FI',
    'Frankreich'  => 'FR',
    //'Franz&ouml;sisch Guyana'  => 'GF',
    //'Franz&ouml;sisch Polynesien'  => 'PF',
    //'Franz&ouml;sisches S&uuml;d-Territorium'  => 'TF',
    //'Gabun'  => 'GA',
    //'Gambia'  => 'GM',
    //'Georgien'  => 'GE',
    //'Ghana'  => 'GH',
    //'Gibraltar'  => 'GI',
    //'Grenada'  => 'GD',
    'Griechenland'  => 'GR',
    //'Gr&ouml;nland'  => 'GL',
    'Großbritannien'  => 'UK',
    'Großbritannien (UK)'  => 'GB',
    //'Guadeloupe'  => 'GP',
    //'Guam'  => 'GU',
    //'Guatemala'  => 'GT',
    //'Guinea'  => 'GN',
    //'Guinea Bissau'  => 'GW',
    //'Guyana'  => 'GY',
    //'Haiti'  => 'HT',
    //'Heard und McDonald Islands'  => 'HM',
    //'Honduras'  => 'HN',
    //'Hong Kong'  => 'HK',
    //'Indien'  => 'IN',
    //'Indonesien'  => 'ID',
    //'Irak'  => 'IQ',
    //'Iran'  => 'IR',
    'Irland'  => 'IE',
    //'Island'  => 'IS',
    //'Israel'  => 'IL',
    'Italien'  => 'IT',
    //'Jamaika'  => 'JM',
    //'Japan'  => 'JP',
    //'Jemen'  => 'YE',
    //'Jordanien'  => 'JO',
    //'Jugoslawien'  => 'YU',
    //'Kaiman Inseln'  => 'KY',
    //'Kambodscha'  => 'KH',
    //'Kamerun'  => 'CM',
    //'Kanada'  => 'CA',
    //'Kap Verde'  => 'CV',
    //'Kasachstan'  => 'KZ',
    //'Kenia'  => 'KE',
    //'Kirgisistan'  => 'KG',
    //'Kiribati'  => 'KI',
    //'Kokosinseln'  => 'CC',
    //'Kolumbien'  => 'CO',
    //'Komoren'  => 'KM',
    //'Kongo'  => 'CG',
    //'Kongo, Demokratische Republik'  => 'CD',
    //'Kroatien'  => 'HR',
    //'Kuba'  => 'CU',
    //'Kuwait'  => 'KW',
    //'Laos'  => 'LA',
    //'Lesotho'  => 'LS',
    'Lettland'  => 'LV',
    //'Libanon'  => 'LB',
    //'Liberia'  => 'LR',
    //'Libyen'  => 'LY',
    'Liechtenstein'  => 'LI',
    'Litauen'  => 'LT',
    'Luxemburg'  => 'LU',
    //'Macao'  => 'MO',
    //'Madagaskar'  => 'MG',
    //'Malawi'  => 'MW',
    //'Malaysia'  => 'MY',
    //'Malediven'  => 'MV',
    //'Mali'  => 'ML',
    'Malta'  => 'MT',
    //'Marianen'  => 'MP',
    //'Marokko'  => 'MA',
    //'Marshall Inseln'  => 'MH',
    //'Martinique'  => 'MQ',
    //'Mauretanien'  => 'MR',
    //'Mauritius'  => 'MU',
    //'Mayotte'  => 'YT',
    //'Mazedonien'  => 'MK',
    //'Mexiko'  => 'MX',
    //'Mikronesien'  => 'FM',
    //'Mocambique'  => 'MZ',
    //'Moldavien'  => 'MD',
    //'Monaco'  => 'MC',
    //'Mongolei'  => 'MN',
    //'Montserrat'  => 'MS',
    //'Namibia'  => 'NA',
    //'Nauru'  => 'NR',
    //'Nepal'  => 'NP',
    //'Neukaledonien'  => 'NC',
    //'Neuseeland'  => 'NZ',
    //'Nicaragua'  => 'NI',
    'Niederlande'  => 'NL',
    //'Niederl&auml;ndische Antillen'  => 'AN',
    //'Niger'  => 'NE',
    //'Nigeria'  => 'NG',
    //'Niue'  => 'NU',
    //'Nord Korea'  => 'KP',
    //'Norfolk Inseln'  => 'NF',
    'Norwegen'  => 'NO',
    //'Oman'  => 'OM',
    '&Ouml;sterreich'  => 'AT',
    //'Pakistan'  => 'PK',
    //'Pal&auml;stina'  => 'PS',
    //'Palau'  => 'PW',
    //'Panama'  => 'PA',
    //'Papua Neuguinea'  => 'PG',
    //'Paraguay'  => 'PY',
    //'Peru'  => 'PE',
    //'Philippinen'  => 'PH',
    //'Pitcairn'  => 'PN',
    'Polen'  => 'PL',
    'Portugal'  => 'PT',
    //'Puerto Rico'  => 'PR',
    //'Qatar'  => 'QA',
    //'Reunion'  => 'RE',
    //'Ruanda'  => 'RW',
    'Rum&auml;nien'  => 'RO',
    //'Ru&szlig;land'  => 'RU',
    //'Saint Lucia'  => 'LC',
    //'Sambia'  => 'ZM',
    //'Samoa'  => 'AS',
    //'Samoa'  => 'WS',
    //'San Marino'  => 'SM',
    //'Sao Tome'  => 'ST',
    //'Saudi Arabien'  => 'SA',
    'Schweden'  => 'SE',
    'Schweiz'  => 'CH',
    //'Senegal'  => 'SN',
    //'Seychellen'  => 'SC',
    //'Sierra Leone'  => 'SL',
    //'Singapur'  => 'SG',
    'Slowakei -slowakische Republik-'  => 'SK',
    'Slowenien'  => 'SI',
    //'Solomon Inseln'  => 'SB',
    //'Somalia'  => 'SO',
    //'South Georgia, South Sandwich Isl.'  => 'GS',
    'Spanien'  => 'ES',
    //'Sri Lanka'  => 'LK',
    //'St. Helena'  => 'SH',
    //'St. Kitts Nevis Anguilla'  => 'KN',
    //'St. Pierre und Miquelon'  => 'PM',
    //'St. Vincent'  => 'VC',
    //'S&uuml;d Korea'  => 'KR',
    //'S&uuml;dafrika'  => 'ZA',
    //'Sudan'  => 'SD',
    //'Surinam'  => 'SR',
    //'Svalbard und Jan Mayen Islands'  => 'SJ',
    //'Swasiland'  => 'SZ',
    //'Syrien'  => 'SY',
    //'Tadschikistan'  => 'TJ',
    //'Taiwan'  => 'TW',
    //'Tansania'  => 'TZ',
    //'Thailand'  => 'TH',
    //'Timor'  => 'TP',
    //'Togo'  => 'TG',
    //'Tokelau'  => 'TK',
    //'Tonga'  => 'TO',
    //'Trinidad Tobago'  => 'TT',
    //'Tschad'  => 'TD',
    'Tschechische Republik'  => 'CZ',
    //'Tunesien'  => 'TN',
    //'T&uuml;rkei'  => 'TR',
    //'Turkmenistan'  => 'TM',
    //'Turks und Kaikos Inseln'  => 'TC',
    //'Tuvalu'  => 'TV',
    //'Uganda'  => 'UG',
    //'Ukraine'  => 'UA',
    'Ungarn'  => 'HU',
    //'Uruguay'  => 'UY',
    //'Usbekistan'  => 'UZ',
    //'Vanuatu'  => 'VU',
    //'Vatikan'  => 'VA',
    //'Venezuela'  => 'VE',
    //'Vereinigte Arabische Emirate'  => 'AE',
    //'Vereinigte Staaten von Amerika'  => 'US',
    //'Vietnam'  => 'VN',
    //'Virgin Island (Brit.)'  => 'VG',
    //'Virgin Island (USA)'  => 'VI',
    //'Wallis et Futuna'  => 'WF',
    //'Wei&szlig;ru&szlig;land'  => 'BY',
    //'Westsahara'  => 'EH',
    //'Zentralafrikanische Republik'  => 'CF',
    //'Zimbabwe'  => 'ZW',
    'Zypern'  => 'CY'
    );

    foreach ($laender as $land => $kuerzel) {
      $options = $options."<option value=\"$kuerzel\"";
        if ($selected == $kuerzel) $options = $options." selected";
	  $options = $options.">$land</option>\n";
    } 
    return $options;
  }
}







?>

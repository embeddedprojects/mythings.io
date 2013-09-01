<?
include ("cart/cart.inc.php");
include ("steps/choose.inc.php");

session_start();

function onlinebestellung($value)
{
  global $db;
  $step=$_POST['step']; 
  if($step=="")
    $step=$_GET['step'];

 
  switch($step)
  {
    case "choose":
      if( CartGetTotalSumBrutto($_SESSION[articlelist]) > 0 )
      {
	$module   = ChooseStudentUni();
	$back	= "";
	$next	= "choose_event";
      } else 
      {
	$module ="<form action=\"\" method=\"post\">Bitte legen Sie erst einen Artikel in den Warenkorb.";
	$next	= "home";
      }
    break;
    case "home":
      header('Location: http://www.eproo-student.de'); 
    break;
    case "choose_event":
      // merke in session neue info
      
      if ($_POST['choose']=="student")
      {
	$_SESSION[choose] = "student";
	$module  = ChooseStudent();
	$next = "student_address";
      }
      elseif ($_POST['choose']=="uni")
      {
	$_SESSION[choose] = "uni";
	$module  = ChooseUni();
      }
      else
	$module ="";

      $back	= "choose";
    break;

    case "student_address":
      $module = ChooseStudentAddress();
      $next = "student_address_event";
    break;

    case "student_address_event":
      $_SESSION['vorname'] = $_POST['vorname'];
      $_SESSION['nachname'] = $_POST['nachname'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['email2'] = $_POST['email2'];
      $_SESSION['telefon'] = $_POST['telefon'];
      $_SESSION['strasse'] = $_POST['strasse'];
      $_SESSION['ort'] = $_POST['ort'];
      $_SESSION['plz'] = $_POST['plz'];
      $_SESSION['zusatz'] = $_POST['zusatz'];
      $_SESSION['matrikelnummer'] = $_POST['matrikelnummer'];

      
      if(!isset($_POST['packstation']) && $_SESSION['packstation']=="1")
      {
	$_SESSION['packstation'] = 0;
	$_SESSION['packstation_checked'] = "";
      }
      else
      $_SESSION['packstation'] = $_POST['packstation'];

      

      $_SESSION['postid'] = $_POST['postid'];
      $_SESSION['packstationummer'] = $_POST['packstationummer'];
      $_SESSION['packstationplz'] = $_POST['packstationplz'];
      $_SESSION['packstationort'] = $_POST['packstationort'];


 
      if(!isset($_POST['newsletter']) && $_SESSION['newsletter']=="1")
      {
	$_SESSION['newsletter'] = 0;
      }
      else {
	$_SESSION['newsletter'] = $_POST['newsletter'];
      }

      if($_SESSION['newsletter'] =="1")
	$_SESSION['newsletter_checked'] = "checked";
      else
	$_SESSION['newsletter_checked'] = "";

 
      if(!isset($_POST['selbstabholer']) && $_SESSION['selbstabholer']=="1")
      {
	$_SESSION['selbstabholer'] = 0;
      }
      else {
	$_SESSION['selbstabholer'] = $_POST['selbstabholer'];
      }

      if($_SESSION['selbstabholer'] =="1")
	$_SESSION['selbstabholer_checked'] = "checked";
      else
	$_SESSION['selbstabholer_checked'] = "";



      if($_POST['vorname']==""){
	$msg['vorname'] = "*";
	$msg['msgvorname'] = "<br>Bitte geben Sie einen Vornamen ein!";
      }

      if($_POST['nachname']=="")
      {
	$msg['nachname'] = "*";
	$msg['msgnachname'] = "<br>Bitte geben Sie einen Nachnamen ein!";
      }
      if($_POST['telefon']=="")
      {
	$msg['telefon'] = "*";
	$msg['msgtelefon'] = "<br>F&uuml;r eventuelle Nachfragen brauchen wir Ihre Nummer!";
      }

      if($_POST['matrikelnummer']=="" || strlen($_POST['matrikelnummer'])<3)
      {
	$msg['matrikelnummer'] = "*";
	$msg['msgmatrikelnummer'] = "<br>Wir brauchen bei Studenten die Matrikelnummer. Sch&uuml;ler von Technikerschulen bitte ebenfalls 
	die eine eindeutige der Person zugewiesenen Nummer von der Schule angeben.";
      }


      if($_SESSION['email']=="")
      {
	$msg['email'] = "*";
	$msg['msgemail'] = "<br>Bitte geben Sie eine E-Mail Adresse ein!";
      }
 
      if($_SESSION['email']=="")
      {
	$msg['email'] = "*";
	$msg['msgemail'] = "<br>Bitte geben Sie eine E-Mail Adresse ein!";
      }
 

      if($_SESSION['email']!=$_SESSION['email2'])
      {
	$msg['email2'] = "*";
	$msg['msgemail2'] = "<br>E-Mail Adressen stimmen nicht &uuml;berein!";
      }
 
      if($_SESSION['strasse']=="")
      {
	$msg['strasse'] = "*";
	$msg['msgstrasse'] = "<br>Bitte geben Sie eine Stra&szlig;e ein!";
      }
 
      if($_SESSION['ort']=="")
      {
	$msg['ort'] = "*";
	$msg['msgort'] = "<br>Bitte geben Sie einen Ort ein!";
      }
 
 
      if($_SESSION['plz']=="")
      {
	$msg['plz'] = "*";
	$msg['msgplz'] = "<br>Bitte geben Sie eine Postleitzahl ein!";
      }
/*
      // falls packstationshaken gesetzt sind dies ebenfalls pflichfelder
      if($_SESSION['packstation']=="1")
      {
	$_SESSION['packstation_checked'] = "checked";
 
	if($_SESSION['postid']=="")
	{
	  $msg['postid'] = "*";
	  $msg['msgpostid'] = "<br>Bitte geben Sie Ihre Post ID Nr. ein!";
	}
	if($_SESSION['packstationummer']=="")
	{
	  $msg['packstationummer'] = "*";
	  $msg['msgpackstationummer'] = "<br>Bitte geben Sie die Packstations Nr. ein!";
	}

	if($_SESSION['packstationplz']=="")
	{
	  $msg['packstationplz'] = "*";
	  $msg['msgpackstationplz'] = "<br>Bitte geben Sie die Postleitzahl der Packstation ein!";
	}

	if($_SESSION['packstationort']=="")
	{
	  $msg['packstationort'] = "*";
	  $msg['msgpackstationort'] = "<br>Bitte geben Sie den Ort der Packstation ein!";
	}
      } 
 */   

      if(count($msg)>0){
	$message = "Bitte alle Pflichtfelder korrekt ausf&uuml;llen!<br><br>";
	$module = ChooseStudentAddress($msg,$message);
	$next = "student_address_event";
      } else 
      {
	$module = ChooseAtmelQuestions(0);
	$next = "atmel_questions_student_event";
      }
	
    break;

    case "atmel_questions_student_event":
      $_SESSION[question] = $_POST[question];	 
      foreach($_POST[question] as $key=>$value)
      {
	if($key==4 && !is_numeric($value))
	  $msg[$key]="<font color=\"red\">Bitte eine korrekte Anzahl angeben!</font>";
	else if($value=="")
	  $msg[$key]="<font color=\"red\">Bitte Feld ausf&uuml;llen!</font>";
      }
      if(count($msg)==0)
      {
	$_SESSION[question] = $_POST[question];
	$module = UploadStudent();
	$next = "ausweis_event";
      }
      else {
	$message = "Bitte alle Felder ausf&uuml;llen!<br><br>";
	$module = ChooseAtmelQuestions(0,$msg,$message);
	$next = "atmel_questions_student_event";
      }
    break;

    case "ausweis_event":
    if(count($_SESSION)>0)
    {

      $_SESSION[transfer] = $_POST[transfer];

      // Datensatz in DB anlegen
      $ipkunde = $_SERVER['REMOTE_ADDR']; 
      $question = implode ('*#*', $_SESSION[question]);
      $sql = 'INSERT INTO 
	   `eproo_bestellungen` 
	  (`id`, `choose`, `vorname`, `nachname`, `email`, `email2`, 
	   `telefon`, `strasse`, `ort`, `plz`, `newsletter`, 
	   `newsletter_checked`, `question`, `transfer`, `status`, 
	   `bemerkung`, `eproobearbeiter`, `ipkunde`, `datum`, 
	   `versendetam`, `zahlungseingang`, `trackingid`, 
	   `ausweischeck`, `ausweischeckok`, `ausweisproblem`, `summe`,`zusatz`, `selbstabholer`, `selbstabholer_checked`,
	   `matrikelnummer`, `perso`, `stud`) 
	   VALUES 
	   (NULL, \''.$_SESSION[choose].'\', 
	   \''.$_SESSION[vorname].'\', 
	   \''.$_SESSION[nachname].'\', 
	   \''.$_SESSION[email].'\', 
	   \''.$_SESSION[email2].'\', 
	   \''.$_SESSION[telefon].'\', 
	   \''.$_SESSION[strasse].'\', 
	   \''.$_SESSION[ort].'\', 
	   \''.$_SESSION[plz].'\', 
	   \''.$_SESSION[newsletter].'\', 
	   \''.$_SESSION[newsletter_checked].'\', 
	   \''.$question.'\', 
	   \''.$_SESSION[transfer].'\', 
	   \'offen\', 
	   \'\', 
	   \'\', 
	   \''.$ipkunde.'\', 
	   NOW(), \'\', \'\', \'\', 
	   \'\', 
	   \'\', 
	   \'\', \''.CartGetTotalSumBrutto($_SESSION[articlelist]).'\',
	   \''.$_SESSION[selbstabholer].'\',
	   \''.$_SESSION[selbstabholer_checked].'\',
	   \''.$_SESSION[zusatz].'\',
	   \''.$_SESSION[matrikelnummer].'\',
	   \'\',
	   \'\');';

      $db->Insert($sql);

      $bestellungen_id =  $db->GetInsertID();

      /* artikel in db legen */
      for($i=0;$i<count($_SESSION[articlelist]);$i++)
      {
	$sql = 'INSERT INTO `eproo_artikel` 
	(`id`, `title`, `quantity`, `price`, `tax`, `versendet`, `bestellungen_id`, `bemerkung`) 
	VALUES 
	(NULL, 
	\''.$_SESSION[articlelist][$i][title].'\', 
	\''.$_SESSION[articlelist][$i][quantity].'\', 
	\''.$_SESSION[articlelist][$i][price].'\', 
	\''.$_SESSION[articlelist][$i][tax].'\', 
	\'\', 
	\''.$bestellungen_id.'\', 
	\'\');'; 
	if($bestellungen_id != 0) $db->Insert($sql);
      }

      $_SESSION[transfer] = $_POST[transfer];
      if($_POST[transfer] == "upload") {
	$tmp = split('\.', $_FILES['studentenausweis']['name']);
	$endung_stud = $tmp[1];
	
	$tmp = split('\.', $_FILES['perso']['name']);
	$endung_perso = $tmp[1];


	$target_path = "/ausweise/";
	$target_path_stud = $target_path . $bestellungen_id . "_stud." . $endung_stud; 
	$target_path_perso = $target_path . $bestellungen_id . "_perso." . $endung_perso; 

	if(!move_uploaded_file($_FILES['studentenausweis']['tmp_name'], $target_path_stud)) {
	  $hinweis_ausweis = "Es gab ein Fehler beim Upload des Studentenausweises!<br>Bitte Senden Sie die Kopie
	  per E-Mail an student@embedded-projects.net";
	}
	if(!move_uploaded_file($_FILES['perso']['tmp_name'], $target_path_perso)) {
	  $hinweis_ausweis = "Es gab ein Fehler beim Upload des Personalausweises!";
	}

	if($hinweis_ausweis==""){
	  $hinweis_ausweis="Upload der Ausweise war erfolgreich!";
	  $sql = 'UPDATE `eproo_bestellungen` SET `perso` = \''.$target_path_perso.'\' WHERE `eproo_bestellungen`.`id` = '.$bestellungen_id.' LIMIT 1;';
	  $db->Update($sql);
	  $sql = 'UPDATE `eproo_bestellungen` SET `stud` = \''.$target_path_stud.'\' WHERE `eproo_bestellungen`.`id` = '.$bestellungen_id.' LIMIT 1;';
	  $db->Update($sql);
	}

      }
      else 
	$hinweis_ausweis = "Bitte senden Sie uns Ihren Ausweis zu, damit die Bestellung fortgesetzt werden kann!";

      // Zum Schluss, löschen der Session.
      session_destroy();

      $module = " <form action=\"\" method=\"post\"><h2>Auftragsbest&auml;tigung</h2>Folgende Bestellung befindet sich jetzt in unserem System:<br><br>";
      $module .= "<table width=\"100%\" style=\"border:1px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">
	<tr><td><b>Menge</b></td><td><b>Artikel</b></td><td align=\"right\"><b>Betrag</b></td></tr>";
      for($i=0;$i<count($_SESSION[articlelist]);$i++)
      {	
	$module .="<tr><td>".$_SESSION[articlelist][$i][quantity]."</td><td>".
	$_SESSION[articlelist][$i][title]."</td><td align=\"right\">".$_SESSION[articlelist][$i][price]." EUR</td></tr>";
      }
      
      if($_SESSION[selbstabholer]==1)
      {
        $module .= "<tr><td></td><td align=\"right\"><b>Gesamt</b></td><td align=\"right\">".number_format(CartGetTotalSumBrutto($_SESSION[articlelist]),2) ." EUR</td></tr>";
      }
      else {
      	$module .= "<tr><td>1</td><td>Versand</td><td align=\"right\">6.95 EUR</td></tr>";
      	$module .= "<tr><td></td><td align=\"right\"><b>Gesamt</b></td><td align=\"right\">".
      	number_format(CartGetTotalSumBrutto($_SESSION[articlelist]) + 6.95,2)." EUR</td></tr>";
      }
      $module .="</table>";
      
      $module .="<table border=\"0\" style=\"border:1px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
      $module .="<tr><td>Bestellnummer:</td><td>".$bestellungen_id."</td></tr>";
      $module .="<tr><td>Vorname:</td><td>".$_SESSION[vorname]."</td></tr>";
      $module .="<tr><td>Nachname:</td><td>".$_SESSION[nachname]."</td></tr>";
      $module .="<tr><td>Strasse:</td><td>".$_SESSION[strasse]."</td></tr>";
      $module .="<tr><td>Ort:</td><td>".$_SESSION[ort]."</td></tr>";
      $module .="<tr><td>PLZ:</td><td>".$_SESSION[plz]."</td></tr>";
      $module .="<tr><td>Zusatz:</td><td>".$_SESSION[zusatz]."</td></tr>";
      $module .="</table>";


      $module .="<br><font color=\"red\"><b>".$hinweis_ausweis."</b></font>";


      $module .="<h4>Was wird als n&auml;chstes passieren?</h4>";
      $module .="<ul><li>&Uuml;berpr&uuml;fung der Ausweise (kann 2-3 Tage dauern)</li>
      <li>Zusenden der Bankverbindung f&uuml;r die Zahlung</li>
      <li>Nach dem Zahlungseingang wird die Ware innerhalb einer Woche versendet</li>
      <li>Versendung einer Trackingnummer per E-Mail um den Status 
      der Bestellung &uuml;berpr&uuml;fen zu k&ouml;nnen</ul>";

      $next = "home";
    }
    else {
      $module ="<form action=\"\" method=\"post\">Bitte starten Sie den Bestellprozess neu!";
      $next = "home";
    }
    break;

    default:
      $module = CartShow($_SESSION[articlelist]);
      $back   = "";
      $next   = "choose";
  }

  $buttons ="
    <table width=\"70%\" align=\"center\" border=\"0\">
      <tr><td>
	 <!-- <input type=\"button\" onclick=\"javascript:history.back();\" value=\"zur&uuml;ck\">-->
      </td>
      <td align=\"right\">
	<input type=\"hidden\" name=\"step\" value=\"$next\">
	<input type=\"submit\" value=\"weiter\">
      </td></tr>
    </table>
    </form>
    ";
 
  return $module.$buttons;
}

?>

<?

  function ChooseStudentUni() 
  {
    if($_SESSION['choose']=="student")
      $checkedstudent = "checked";
    elseif($_SESSION['choose']=="uni")
      $checkeduni = "checked";
    else 
      $checkedstudent = "checked";
    
    $ret ="
      <h2>Auswahl f&uuml;r Bestellprozess</h2><br>
      <form action=\"\" method=\"post\">
      <table>
	<tr><td><input type=\"radio\" name=\"choose\" value=\"student\" $checkedstudent></td><td><b>Ich bin Student</b><br>
	Studenten k&ouml;nnen hier verbilligt Atmel Produkte im Rahmen des <i>Atmel University Programs</i> bestellen. Wie es funktioniert,
	seht Ihr auf den folgenden Seiten.
	<br><br><b>Bitte auch Selbstabholer in Augsburg immer &uuml;ber diesen Weg vorab die Artikel bestellen!</b>
	</td></tr>
	<tr><td><input type=\"radio\" name=\"choose\" value=\"uni\" $checkeduni></td><td><b>Bestellung f&uuml;r Hochschulen</b><br>
	</td></tr>
      </table>
	";
    return $ret;
    
  }
 

  function ChooseStudent()
  {
      $ret = "<form action=\"\" method=\"post\">";
    $ret .= " 
      <h2>&Uuml;bersicht zum Bestellvorgang</h2>  
    <fieldset>
   1. Eingabe Deiner Adresse<br><br>

   2. Fragen Rund um das \"Atmel AVR Hochschulen Program\", die Du beantworten musst.<br><br>

   3. Als n&auml;chstes musst Du uns Deinen Ausweis mit Vorder- und R&uuml;ckseite sowie Deinen aktuellen Studentenausweis zukommen lassen. M&ouml;glich ist dies als direkter Upload.<br><br>

   <b>4. Damit ist Dein Teil der Bestellung zun&auml;chst erledigt</b><br><br>
5. Als Best&auml;tigung f&uuml;r den Eingang der Bestellung erh&auml;ltst du eine E-Mail.<br><br>

   6. Wir pr&uuml;fen nun die Vollst&auml;ndigkeit der angegebenen Daten.<br><br>

   7. Sind die Daten vollst&auml;ndig und korrekt wirst du wieder innerhalb der n&auml;chsten Tagen eine E-Mail mit der Best&auml;tung f&uuml;r die Bestellung erhalten,
   gab es jedoch Unstimmigkeiten bei den Angaben wird die Bestellung storniert (In diesem Fall wird ebenfalls eine E-Mail versendet).<br><br>

   8. Sobald die Waren der Bestellung vollst&auml;ndig im Lager sind, wird eine E-Mail mit den Zahlungsinformationen versendet.
   Wird die Ware nicht innerhalb von 10 Tagen ab dem Erhalt der E-Mail gezahlt wird die Bestellung ebenfalls storniert.<br><br>

   9. Ist die Zahlung bei uns eingegangen, so versenden wir die Ware schnellstm&ouml;glich. Die Versandbest&auml;tigung an Dich erfolgt als E-Mail und Du wirst Deine Bestellung bald erhalten.<br><br>
    
       </fieldset>";
    return $ret;
  }

  function ChooseUni()
  { 
    return "<form action=\"\" method=\"post\"><h2>Bestellung f&uuml;r Hochschulen</h2>
    Bitte laden Sie die beiden PDF-Dateien Atmel Fragebogen und die Bestellliste herunter.
    F&uuml;llen Sie beide Forumulare aus und schicken Sie sie anschlie&szlig;end per Brief oder Fax an:<br><br>
    embedded projects GmbH<br>
    ATMEL Hochschulen Programm<br>
    Holzbachstrasse 4<br>
    86125 Augsburg<br>
    <br><br>
    Fax: 0821/31946-23<br><br>
    <br><ul><li>Download Atmelfragebogen (Download folgt)</li><li>Bestellliste (Download folgt)</li></ul>";
  }

  function ChooseStudentAddress($msg="",$message="") 
  {
    $ret ="
      <form action=\"\" method=\"post\">
      <h2>Rechnungs- und Versandadresse </h2> 
      <br><font color=\"red\">$message</font>
      <fieldset><legend>Pers&ouml;nliche Angaben:</legend>      
      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr><td width=\"40%\">Vorname:</td>
	  <td><input type=\"text\" size=\"20\" name=\"vorname\" value=\"{$_SESSION['vorname']}\"/>&nbsp;<b style=\"color:red;\">{$msg['vorname']}</b>
	  <font color=\"red\">{$msg['msgvorname']}</font></td></tr>

	<tr><td>Nachname:</td>
	  <td><input type=\"text\" size=\"20\" name=\"nachname\" value=\"{$_SESSION['nachname']}\"/>&nbsp;<b style=\"color:red;\">{$msg['nachname']}</b>
	  <font color=\"red\">{$msg['msgnachname']}</font></td></tr>

	<tr><td>E-Mail:</td>
	  <td><input type=\"text\" size=\"20\" name=\"email\" value=\"{$_SESSION['email']}\"/>&nbsp;<b style=\"color:red;\">{$msg['email']}</b>
	  <font color=\"red\">{$msg['msgemail']}</font></td></tr>

	<tr><td>E-Mail (wiederholen):</td>
	  <td><input type=\"text\" size=\"20\" name=\"email2\" value=\"{$_SESSION['email2']}\"/>&nbsp;<b style=\"color:red;\">{$msg['email2']}</b>
	  <font color=\"red\">{$msg['msgemail2']}</font></td></tr>

	<tr><td>Telefon:</td>
	  <td><input type=\"text\" size=\"20\" name=\"telefon\" value=\"{$_SESSION['telefon']}\"/>&nbsp;<b style=\"color:red;\">{$msg['telefon']}</b>
	  <font color=\"red\">{$msg['msgtelefon']}</font></td></tr>

	<tr><td>Matrikelnummer:</td>
	  <td><input type=\"text\" size=\"20\" name=\"matrikelnummer\" value=\"{$_SESSION['matrikelnummer']}\"/>&nbsp;<b style=\"color:red;\">{$msg['matrikelnummer']}</b>
	  <font color=\"red\">{$msg['msgmatrikelnummer']}</font></td></tr>


	<tr></tr>
      </table></fieldset> 
      <br />
      <fieldset> <legend>Adresse:</legend>
      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr><td width=\"40%\">Stra&szlig;e/Nr.:</td>

	 <td><input type=\"text\" size=\"20\" name=\"strasse\" value=\"{$_SESSION['strasse']}\"/>&nbsp;<b style=\"color:red;\">{$msg['strasse']}</b>
	 <font color=\"red\">{$msg['msgstrasse']}</font></td></tr>

	<tr><td>Adresszusatz:</td>
	<td><input type=\"text\" size=\"20\" name=\"zusatz\" value=\"{$_SESSION['zusatz']}\"/>&nbsp;<b style=\"color:red;\">{$msg['zusatz']}</b>
	<font color=\"red\">{$msg['zusatz']}</font></td></tr>

	<tr><td>Postleitzahl:</td>
	<td><input type=\"text\" size=\"20\" name=\"plz\" value=\"{$_SESSION['plz']}\"/>&nbsp;<b style=\"color:red;\">{$msg['plz']}</b>
	<font color=\"red\">{$msg['msgplz']}</font></td></tr>


	<tr><td>Ort:</td>
	<td><input type=\"text\" size=\"20\" name=\"ort\" value=\"{$_SESSION['ort']}\"/>&nbsp;<b style=\"color:red;\">{$msg['ort']}</b>
	<font color=\"red\">{$msg['msgort']}</font></td></tr>

	<tr><td>Land:</td><td>Deutschland</td></tr>

      </table>
      </fieldset>
      <br />
      <!--
      <fieldset><legend>Packstation:</legend>
      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width: 100%;\">
	<tr><td colspan=\"2\"><b> <input type=\"checkbox\" name=\"packstation\" value=\"1\" {$_SESSION['packstation_checked']}/> 
	Bestellung an eine Packstation senden </b>&nbsp;</td></tr>

	<tr><td width=\"40%\">Post ID Nr.:</td>
	<td><input type=\"text\" size=\"20\" name=\"postid\" value=\"{$_SESSION['postid']}\"/>&nbsp;<b style=\"color:red;\">{$msg['postid']}</b>
	<font color=\"red\">{$msg['msgpostid']}</font></td></tr>


	<tr><td>Packstation Nr.:</td>
	<td><input type=\"text\" size=\"20\" name=\"packstationummer\" value=\"{$_SESSION['packstationummer']}\"/>&nbsp;<b style=\"color:red;\">{$msg['packstationummer']}</b>
	<font color=\"red\">{$msg['msgpackstationummer']}</font></td></tr>


	<tr><td>Postleitzahl:</td>
	<td><input type=\"text\" size=\"20\" name=\"packstationplz\" value=\"{$_SESSION['packstationplz']}\"/>&nbsp;<b style=\"color:red;\">{$msg['packstationplz']}</b>
	<font color=\"red\">{$msg['msgpackstationplz']}</font></td></tr>


	<tr><td>Ort:</td>
	<td><input type=\"text\" size=\"20\" name=\"packstationort\" value=\"{$_SESSION['packstationort']}\"/>&nbsp;<b style=\"color:red;\">{$msg['packstationort']}</b>
	<font color=\"red\">{$msg['msgpackstationort']}</font></td></tr>

      </table></fieldset> 
      <br />
      -->
      <fieldset><legend>Selbstabholer:</legend>
      <table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">
	<tr><td><b><input type=\"checkbox\" name=\"selbstabholer\" value=\"1\" {$_SESSION['selbstabholer_checked']}/></b>Ich m&ouml;chte die Ware in Augsburg abholen (Holzbachstrasse 4, 86152 Augsburg). Die Versandkosten von 6.95 EUR entfallen.</td></tr>
      </table>
      </fieldset> 

      <fieldset><legend>Newsletter:</legend>
      <table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">
	<tr><td><b><input type=\"checkbox\" name=\"newsletter\" value=\"1\" {$_SESSION['newsletter_checked']}/></b>Ich m&ouml;chte den<b> Newsletter</b> abonnieren</td></tr>
      </table>
      </fieldset> 

      <fieldset><legend>Ich bin Student oder an der Technikerschule</legend>
      <table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">
	<tr><td><b><input type=\"checkbox\" name=\"ack\" value=\"1\" {$_SESSION['ack']}/></b>Ich bin regul&auml;rer Vollzeitstudent an einer deutschen Hochschule (Kein Gaststudent, kein Fernstudium) oder Sch&uuml;er einer Technikerschule.
	 <font color=\"red\">{$msg['ack']}</font></td></tr>
	</td></tr>
      </table>
      </fieldset> 

      <br><font color=\"red\">$message</font>
	";
    return $ret;


  }
  function ChooseAtmelQuestions($uni,$msg="",$message="") 
  {
    $i=0;
    $ret ="  <form action=\"\" method=\"post\">";
    $ret .= "<h2>Fragen Rund um das &bdquo;Atmel AVR University Program&ldquo;</h2>
      <br><font color=\"red\">$message</font>";
    $ret .="
	<fieldset><legend>Angaben zur Hochschule:</legend>      
	<table cellspacing=\"2\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">

	<tr><td>Name der Hochschule</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
	
	<tr><td>Strasse, PLZ, Stadt der Hochschule </td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>


	<tr><td>Internetadresse der Hochschule (mit http://)</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
	
	<tr><td>Institut/Fakult&auml;t in der man studiert</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
	
	<tr><td>Anzahl der Studenten am Institut (Pflichtfeld!)</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>";

      if($uni==1)
      {
	$ret .="<tr><td>Ansprechpartner</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
		
	<tr><td>T&auml;tigkeit des Ansprechpartners </td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
		
	<tr><td>email des Ansprechpartners</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>";
      }
		
	$ret .="</table>
	</fieldset> 
	
	<br />
	<fieldset><legend>Allgemeines zur Hochschule/zum Institut:</legend>
	<table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">
	<tr><td>Werden an der Hochschule bereits Atmel-Produkte benutzt (soweit bekannt)?</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>

	<tr><td>In welchen Veranstaltungen werden diese genutzt (wenn nichts dann keine hier eintragen)?</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>";

      if($uni==1)
      {
	$ret .="<tr><td>Wieviel Studenten werden den Kurs wahrscheinlich....</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>

	<tr><td>Haben Sie Kenntnis davon....</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>

	<tr><td>Wollen Sie sich....</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>

	<tr><td>Haben Sie&nbsp;zus&auml;tzliche Kommentare oder Angaben f&uuml;r uns?</td></tr>
	<tr><td><input type=\"text\" size=\"50\" name=\"question[]\" value=\"{$_SESSION['question'][$i]}\">
	{$msg[$i++]}</td></tr>
	</table>";
      }
	$ret .="</fieldset>";


    return $ret;
  }

  function UploadStudent()
  {
    $ret  ="<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" >";
    $ret .="<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />";
    $ret .="<h2>Personal- und Studentenausweis zusenden</h2>";
    $ret .="<fieldset><legend>Ausweise: </legend>  
      <table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" style=\"width: 100%;\">
      <tr><td colspan=\"2\">Bitte w&auml;hlen Sie aus, wie Sie uns den Personalausweis 
      (beidseitig) und den Studentenausweis zukommen lassen m&ouml;chten: &nbsp;</td></tr>     
      <tr><td colspan=\"2\">
      <input type=\"radio\" value=\"upload\" name=\"transfer\" checked/>
	<b>UPLOAD: Ich m&ouml;chte die Kopie der Ausweise direkt heraufladen</b>&nbsp;</td></tr>
 
      <tr><td>Studentenausweis</td><td>
      <input type=\"file\" name=\"studentenausweis\"/></td></tr>
      <tr><td>Personalausweis (beidseitig)</td><td>
      <input type=\"file\" name=\"perso\"/></td></tr>
      </td></tr>
      <tr><td></td><td align=\"left\"><b><font color=\"red\">Dateitypen: JPG und PNG<br><br>Alle anderen Dateiformate werden bei der &Uuml;berpr&uuml;fung
      abgewiesen!</font></b><br><br><br></td></tr>
      <tr><td colspan=\"2\" align=\"right\">Der Upload erfolgt automatisch bei klick auf &quot;weiter&quot; <br><br><br></td></tr>
<!--
      <tr><td colspan=\"2\">
      <input type=\"radio\" value=\"fax\" name=\"transfer\"/>
	<b>FAX: Ich m&ouml;chte die Kopie der Ausweise per Fax senden </b>&nbsp;</td></tr>
      <tr><td colspan=\"2\" align=\"center\">0821 31946-24<br><br><br></td>
-->	
<!--
      <tr><td colspan=\"2\">
      <input type=\"radio\" value=\"brief\" name=\"transfer\" />
	<b>BRIEF: Ich m&ouml;chte die Kopie der Ausweise per Brief senden</b>&nbsp;</td></tr>
      <tr><td colspan=\"2\" align=\"center\">Embedded Projects<br>Holzbachstrasse 3<br>86152 Augsburg</td></tr>
-->
      </table></fieldset>";

    return $ret;
  }
?>

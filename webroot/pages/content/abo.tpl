<div style="width:100%;">
    <h1>Abonnement's verwalten</h1>
    <br>
    <center>
      <table border="0">
	<tr>
	  <td><a href="./index.php?module=zeitschrift&action=list"><img src="./themes/default/images/menu_back.png" border="0"></a></td>
	</tr>
      </table>
    </center>
    <br>
In diesem Bereich k&ouml;nnen Sie Ihre Einstellungen zum Spendenabo vornehmen. Sobald Sie dem Abo zugestimmt haben, erhalten Sie eine E-Mail als Best&auml;tigung.
In der E-Mail sind die Zahlungsinformationen beinhaltet. <br><br>

<ul><li>Lieferadresse &auml;ndern</li><li>Abo Verl&auml;ngerung einstellen (automatisch verl&auml;ngern, E-Mail Erinnerung)</li></ul>    
<br><br>
Haben Sie noch Fragen? Schreiben Sie unserem <a href="./index.php?module=anzeige&action=anfrage">Support</a><br><br>
[STORNO]
    <br>[MESSAGE]<br>
    <br>

    <form action="" method="post">
    <div style="float:right;margin-top:10px;">
      <table border="0">
	[VORSCHAU]
      </table>
    </div>
    <div style="width: 65%">
    <fieldset><legend>Aboeinstellungen</legend>
    <table border="0">
      <tr><td colspan="3">Mit dieser Bestellung erhalten Sie ein Abonnement welches &uuml;ber 4 Ausgaben geht.</td></tr>
      <tr><td colspan="3">&nbsp;</td></tr>

      <tr><td colspan="3">Welche Lieferadresse soll benutzt werden?</td></tr>
      <tr><td><input type="radio" name="adresstyp" value="konto" [KONTO]></td><td colspan="2">Lieferadresse wie im pers. Konto</td></tr>
      <tr><td><input type="radio" name="adresstyp" value="andere" [ANDERE]></td><td colspan="2">andere Lieferadresse:</td></tr>
      <tr><td></td><td width="20%">Name:</td><td><input type="text"  class="inputField long" name="name" size="40" value="[NAME]"></td></tr>
      <tr><td></td><td>Stra&szlig;e:</td><td><input type="text" name="strasse" size="40" class="inputField long" value="[STRASSE]"></td></tr>
      <tr><td></td><td>Adresszusatz:</td><td><input type="text" name="zusatz" size="40" class="inputField long" value="[ZUSATZ]"></td></tr>
      <tr><td></td><td>Plz. / Ort:</td><td><input type="text" name="plz" size="8" value="[PLZ]" class="inputField small">&nbsp;&nbsp;<input type="text" class="inputField medium" name="ort" size="28" value="[ORT]"></td></tr>

      <tr><td colspan="3">&nbsp;</td></tr>
      <tr><td colspan="3">Wie soll verl&auml;ngert werden?</td></tr>
      <tr><td><input type="radio" name="verlaengerung" value="auto" [AUTO]></td><td colspan="2">Nach Erhalt der vier Ausgaben soll automatisch verl&auml;ngert werden.</td></tr>
      <tr><td><input type="radio" name="verlaengerung" value="email" [EMAIL]></td><td colspan="2">Nach Erhalt der vier Ausgaben soll eine E-Mail an mich verschickt werden.</td></tr>

      <tr><td colspan="3">&nbsp;</td></tr>
      <tr><td colspan="3" align="right"><input type="submit" name="save" value="Speichern"></td></tr>
    </table>
    </fieldset>  
    </div>
    <br>
    <hr>
    <br> 


  <h2>Magazine in Ihrem Abonnement</h2>
    <table class="tableJournal" width="100%">
      <tr class="tr-0">
	<td>Nummer</td>
	<td>Ausgabe</td>
	<td>Erscheinungsdatum</td>
<!--	<td width="10%">Andere Ausgabe w&auml;hlen</td> -->
      </tr>
      [UEBRIG]	
    </table>
    <div style="float: right;margin-top:3px">[SAVE]</div>
    <br>
    <br>
    <br> 
     <h2>Versendete Ausgaben</h2>
    <table class="tableJournal" width="100%">
      <tr class="tr-0">
        <td>Nummer</td>
        <td>Ausgabe</td>
        <td>Versendet am</td>
      </tr>
      [VERSENDET]
    </table>

    </form>
 
</div>

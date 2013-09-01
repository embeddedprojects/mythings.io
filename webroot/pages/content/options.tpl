<script type="text/javascript" src="./js/kalender/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="./js/kalender/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<div stlye="width:100%;">
  <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Einstellungen</div>
<form name="optionsform" action="" method="POST">
<br>
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
<br>[MESSAGE]<br>
  <fieldset>
  <legend>
    <b style="font-size: 1.4em;">Serverzeit &auml;ndern</b>
  </legend>
  <hr>
  <table>
    <tr><td>Aktuell:</td><td><b>[AKTUELL]</b></td></tr>
    <tr><td>Datum:</td><td><input type="text" name="datum" value="[DATUM]" size="10">
			   <input type="button" value="Datum" onclick="displayCalendar(document.optionsform.datum,'dd.mm.yyyy',this)"></td></tr>
    <tr><td>Uhrzeit:</td><td><select name="hours">[HOURS]</select>&nbsp;<select name="minutes">[MINUTES]</select></td></tr>
    <tr><td>&nbsp;</td><td></td></tr>
    <tr>
      <td colspan="2">
	<input type="submit" name="resettimesubmit" value="Zeit zur&uuml;cksetzen">
	<input type="submit" name="timesubmit" value="Zeit &auml;ndern">
      </td>
    </tr>
  </table>
  </fieldset>
  <br>
  <fieldset>
  <legend>
    <b style="font-size: 1.4em;">Ordner sichern/verschieben</b>
  </legend>
  <table class=\"tableJournal\">
    <tr class="tr-0"><td>Aktuell</td><td>Ordner</td><td></td></tr>
    <tr class="tr-odd"><td>[NOWNEWSLETTER]</td><td>newsletter-Ordner</td><td><input type="submit" name="movenewsletter" value="Verschieben"></td></tr>
    <tr class="tr-even"><td>[NOWDATABASE]</td><td>database-Ordner</td><td><input type="submit" name="movedatabase" value="Verschieben"></td></tr>
  </table>

  </fieldset>
</form>
<br>
</div>

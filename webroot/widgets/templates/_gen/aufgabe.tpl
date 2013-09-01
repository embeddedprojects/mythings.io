
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]


  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Adresse<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="70%">
	    [MESSAGE]
            <tbody>
	      <tr><td>Aufgabe:</td><td>[AUFGABE][MSGAUFGABE]</td></tr>
	      <tr><td>F&uuml;r:</td><td>[MITARBEITERAUTOSTART][ADRESSE][MSGADRESSE][MITARBEITERAUTOEND]</td></tr>
	      <tr><td>Projekt:</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
	      <tr><td>Beschreibung:</td><td>[BESCHREIBUNG][MSGBESCHREIBUNG]</td></tr>
	      <tr><td>Prio</td><td>
		  [PRIO][MSGPRIO]
	      </td></tr>
	</table>
    <br><br>
  <table>
          <tr><td>Startzeit am </td><td>[STARTDATUM][MSGSTARTDATUM][DATUM_STARTDATUM]&nbsp;um&nbsp;
	  [STARTZEIT][MSGSTARTZEIT]&nbsp;Uhr</td>
          <td>&nbsp;</td>
            <td>Intervall:</td><td>[INTERVALL_TAGE][MSGINTERVALL_TAGE] (in Tagen)</td></tr>
	    <tr><td>Dauer:</td><td>[STUNDEN][MSGSTUNDEN](in Stunden)</td><td>&nbsp;</td>
            <td>Abgabe bis:</td><td>[ABGABE_BIS][MSGABGABE_BIS][DATUM_ABGABEBIS]</td></tr>
  </table>

	<table>
	      <tr><td><br><br></td><td></td></tr>
	      <tr><td>Status</td><td>
		[ABGESCHLOSSEN][MSGABGESCHLOSSEN]
	      </td></tr>
	      <tr valign="top"><td>Sonstiges</td><td>[SONSTIGES][MSGSONSTIGES]</td></tr>
            </tbody>
          </table>
        </td>
      </tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>
  
    </tbody>
  </table>

</form>

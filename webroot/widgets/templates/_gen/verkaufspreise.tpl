 
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

 <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Verkaufspreise<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>

<table border="0" width="100%">
            <tbody>
              <tr><td>Bezeichnung</td><td>
              [BEZEICHNUNG][MSGBEZEICHNUNG]
              </td></tr>
	      <tr><td>Kunde</td><td>[KUNDEAUTOSTART][ADRESSE][MSGADRESSE][KUNDEAUTOEND]</td></tr>
	      <tr><td>Projekt</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
              <tr><td colspan="2"><br></td></tr>
	      <tr><td>Ab Menge</td><td>[AB_MENGE][MSGAB_MENGE]</td></tr>
	      <tr valign="top"><td>Preis</td><td>[PREIS][MSGPREIS]&nbsp;[BRUTTOEINGABE]
		<br><br><i>Marge:  15,3 %<br>Gewinn: 4,97 EUR  &nbsp;&nbsp;&nbsp;<a href=""><img border="0" src="./themes/default/images/reload_all_tabs.png"></a></i></td></tr>
              <tr><td colspan="2"><br></td></tr>
	      <tr><td>G&uuml;ltig bis</td><td>[GUELTIG_BIS][MSGGUELTIG_BIS][DATUM_GUELTIGBIS]</td></tr>
	      <tr><td>Bemerkung</td><td>[BEMERKUNG][MSGBEMERKUNG]</td></tr>
              <tr><td colspan="2"><br></td></tr>
</tbody></table>
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

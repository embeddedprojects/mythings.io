
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

<div id="tabview" class="yui-navset">
    <ul class="yui-nav">
        <li class="[AKTIV_TAB1]"><a href="#tab1"><em>Adresse</em></a></li>
        <li class="[AKTIV_TAB2]"><a href="#tab2"><em>Rollen</em></a></li>
    </ul>
    <div class="yui-content">
<div>

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="70%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Adresse<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="100%">
            <tbody>
	      <tr><td>Adressfeld Typ</td><td>[TYP][MSGTYP]</td></tr>
	      <tr><td>Marketingsperre</td><td>[MARKETINGSPERRE][MSGMARKETINGSPERRE]</td></tr>
	      <tr><td>Hauptprojekt</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
	      <tr><td>Sprache</td><td>
		  [SPRACHE][MSGSPRACHE]
	      </td></tr>
	      </table>
<br><br>
  <table>
          <tr><td>Kundennummer:</td><td>[KUNDENNUMMER]</td>
          <td>&nbsp;</td>
            <td>Lieferantennummer:</td><td>[LIEFERANTENNUMMER]</td></tr>
	  <tr><td><br></td><td></td></tr>

          <tr><td>Name/Firma:</td><td>[NAME][MSGNAME]</td>
          <td>&nbsp;</td>
            <td>Vorname:</td><td>[VORNAME][MSGVORNAME]</td></tr>
          <tr><td>Abteilung:</td><td>[ABTEILUNG][MSGABTEILUNG]</td><td>&nbsp;</td>
            <td>Unterabteilung:</td><td>[UNTERABTEILUNG][MSGUNTERABTEILUNG]</td></tr>
          <tr><td>Strasse:</td><td>[STRASSE][MSGSTRASSE]</td>
          <td>&nbsp;</td>
            <td>Adresszusatz:</td><td>[ADRESSZUSATZ][MSGADRESSZUSATZ]</td></tr>
          <tr><td>PLZ:</td><td>[PLZ][MSGPLZ]</td><td>&nbsp;</td>
            <td>Ort:</td><td>[ORT][MSGORT]</td></tr>
          <tr><td>Land:</td><td colspan="3">[EPROO_SELECT_LAND][LAND][MSGLAND]</td>
            </tr>
          <tr><td>USt-ID:</td><td>[USTID][MSGUSTID]</td><td>&nbsp;</td>
            <td>E-Mail:</td><td>[EMAIL][MSGEMAIL]</td></tr>
          <tr><td>Telefon:</td><td>[TELEFON][MSGTELEFON]</td><td>&nbsp;</td>
            <td>Telefax:</td><td>[TELEFAX][MSGTELEFAX]</td></tr>
  </table>

	<table>
	      <tr><td><br><br></td><td></td></tr>
	      <tr><td>Steuer</td><td>
		[STEUER][MSGSTEUER]
	      </td></tr>
	      <tr><td>Sonstiges</td><td>[SONSTIGES][MSGSONSTIGES]</td></tr>
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
</div>
<div>
[ROLLEN]
</div>

</div>
</div>

</form>

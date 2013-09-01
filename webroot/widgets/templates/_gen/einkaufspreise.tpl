 
<form action="" method="post" name="eprooform" >
[FORMHANDLEREVENT]

 <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Einkaufspreise<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>

	     <table border="0" width="100%">
            <tbody>
                      <tr><td>Lieferant</td><td>[LIEFERANTAUTOSTART][ADRESSE][MSGADRESSE][LIEFERANTAUTOEND]</td></tr>
                      <tr><td>Artikelnummer bei Lieferant:</td><td>[BESTELLNUMMER][MSGBESTELLNUMMER]</td></tr>
                      <tr><td>Bezeichnung bei Lieferant:</td><td>[BEZEICHNUNGLIEFERANT][MSGBEZEICHNUNGLIEFERANT]</td></tr>

                      <!--<tr><td>Preis Art</td><td>
                      [OBJEKT][MSGOBJEKT]
                      </td></tr>
                      
		      <tr><td>Zuordnung</td><td>[PARAMETER][MSGPARAMETER]</td></tr>-->

		      <tr><td colspan="2"><br></td></tr>
                      <tr><td>Ab Menge:</td><td>[AB_MENGE][MSGAB_MENGE]</td></tr>
                      <tr><td>Verpackungseinheit VPE:</td><td>
			  [VPE][MSGVPE]</td></tr>
                      <tr><td>Preis (netto):</td><td>
			  [PREIS][MSGPREIS]
			  [BRUTTOEINGABE]
			  </td></tr>
                      <tr><td>W&auml;hrung:</td><td>[WAEHRUNG][MSGWAEHRUNG]
		      </td></tr>
              <tr><td colspan="2"><br></td></tr>
                      <tr><td>Preisanfrage vom:</td><td>[PREIS_ANFRAGE_VOM][MSGPREIS_ANFRAGE_VOM][DATUM_PREISANFRAGE]</td></tr>
                      <tr><td>G&uuml;ltig bis:</td><td>[GUELTIG_BIS][MSGGUELTIG_BIS][DATUM_GUELTIGBIS]</td></tr>
              <tr><td colspan="2"><br></td></tr>
                      <tr><td>Lagerbestand Lieferant</td><td>[LAGER_LIEFERANT][MSGLAGER_LIEFERANT] am [DATUM_LAGERLIEFERANT][MSGDATUM_LAGERLIEFERANT][DATUM_LAGER]</td></tr>
                      <tr><td>Sicherheitslager</td><td>[SICHERHEITSLAGER][MSGSICHERHEITSLAGER]</td></tr>
              <tr><td colspan="2"><br></td></tr>
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

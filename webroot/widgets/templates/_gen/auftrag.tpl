<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]
<!-- gehort zu tabview -->
<div class="yui-navset">
    <ul class="yui-nav">
        <li class="[AKTIV_TAB1]"><a href="index.php?module=auftrag&action=edit&id=[ID]"><em>Auftrag</em></a></li>
        <li class="[AKTIV_TAB2]"><a href="index.php?module=auftrag&action=artikel&id=[ID]"><em>Artikel</em></a></li>
        <li class="[AKTIV_TAB3]"><a href="index.php?module=auftrag&action=zahlung&id=[ID]"><em>Zahlungsinformationen</em></a></li>
        <li class="[AKTIV_TAB4]"><a href="index.php?module=auftrag&action=versand&id=[ID]"><em>Versand</em></a></li>
        <li class="[AKTIV_TAB5]"><a href="index.php?module=auftrag&action=abschicken&id=[ID]"><em>Abschicken</em></a></li>
    </ul>

    <div class="yui-content">
<!-- ende gehort zu tabview -->

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="4" bordercolor="" class="" align="" bgcolor="" height="" valign="">Auftrag<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="100%">
	    <tr><td>Nr.</td><td>[ID]</td><td>&nbsp;</td><td><b>Versand</b></td><td></td></tr>
	    <tr><td>Bearbeiter:</td><td>[BEARBEITER]
	    </td><td>&nbsp;</td><td>Auto-Versand:</td>
	      <td>[AUTOVERSAND][MSGAUTOVERSAND]</td></tr>
	    <tr><td>Datum:</td><td>[DATUM][MSGDATUM]</td>
	      <td>&nbsp;</td><td>Abweichende Lieferadresse:</td>
	      <td>[ABWEICHENDELIEFERADRESSE][MSGABWEICHENDELIEFERADRESSE]</td></tr>
	    <tr><td></td><td></td>
	      <td>&nbsp;</td><td>Porto freie Lieferung:</td>
	      <td>[KEINPORTO][MSGKEINPORTO]</td></tr>

	    <tr><td>Status:</td><td>[STATUS]</a>
	      </td>
	      <td>&nbsp;</td><td>Versandart:</td><td>[VERSANDART][MSGVERSANDART]</td></tr>

	    <tr><td>Projekt:</td><td>[EPROO_SELECT_PROJEKT][PROJEKT][MSGPROJEKT]
	      </td>
	      <td>&nbsp;</td><td>Zahlungsweise:</td><td>
		[ZAHLUNGSWEISE][MSGZAHLUNGSWEISE]</td></tr>
	    <!--<tr><td>Kostenstelle:</td><td>[KOSTENSTELLE][MSGKOSTENSTELLE]&nbsp;(<a href="">Suchen</a>)</td><td>&nbsp;</td><td></td><td></td></tr>-->
          </table>
        </td>
      </tr>
      <!-- Kunde --> 
      <tr>
      <td class="orange2" colspan="4" bordercolor="" classname="orange2" align="" bgcolor="" height="" valign="" 
      width="">Rechnungsadresse (<a href="" onclick="javascript:window.open('index.php?module=adresse&action=suchmaske&typ=auftragrechnung','popup','location=no,menubar=no,toolbar=no,status=no,resizable=yes,scrollbars=yes,width=1000,height=600')">Einf&uuml;gen</a>)<br></td>
      </tr>
      <tr><td colspan="3">
	<table>
	  <tr><td>Kundennummer:</td><td>[KUNDEADRESSID][MSGKUNDEADRESSID]</td>
	    <td>&nbsp;</td><td>Typ:</td><td>[TYP][MSGTYP]</td></tr>
	  <tr><td>Name/Firma:</td><td>[NAME][MSGNAME]</td>
	  <td>&nbsp;</td>
	    <td>Vorname/Ansprechpartner:</td><td>[VORNAME][MSGVORNAME]</td></tr>
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
      </td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="4" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="weiter" value="weiter" />
    <input type="button" value="Abbrechen" /></td>
    </tr>
  
    </tbody>
  </table>
  </form>


<div></div>
<div></div>
<div></div>
<div></div>

 <!-- tab view schließen -->
</div></div>
<!-- ende tab view schließen -->


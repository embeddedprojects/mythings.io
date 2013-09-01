  <form action="./index.php?module=bestellfax&action=main" method="POST">
  <div stlye="width:100%;">
    <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Bestellformular - embedded projects GmbH</div>
    <br><div style="font-size:8pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">
    Holzbachstrasse 4, D-86152 Augsburg, Germany, Telefon: 0821/ 27 95 99 0, Fax: 0821/27 95 99 20<br>
    Sitz der Gesellschaft: Augsburg, Handelsregister: Augsburg, HRB 23930<br>
    Geschäftsführung: Benedikt Sauter, Dipl.-Inf.(FH)<br>
    USt-IdNr.: DE263136143</div>

    <br><br>
    Nachfolgend finden Sie Ihr Bestellformular f&uuml;r die manuelle Bestellung Ihrer Produkte. Unterschreiben Sie die Bestellung, drucken Sie dann diese aus und senden Sie diese <b>per Fax an folgende Nummer: 0821/27 95 99 20</b>
    <br><br>

 <h3>Rechnungsadresse / Bestelldaten</h3>
    <table width="90%" >
    <tr><td width="300" rowspan="25"></td>
    <tr><td width="300"><b>Vollst&auml;ndiger Name / Firma:*</b></td><td></td><td><input type="text" name="name" size="40" value="[NAME]" style="background-color:#BDE5F8;"/>[MSGNAME]</td></tr>
    <tr><td>Abteilung:</td><td></td><td><input type="text" name="abteilung" value="[ABTEILUNG]" size="40"/></td></tr>
    <tr><td>Unterabteilung:</td><td></td><td><input type="text" name="unterabteilung" value="[UNTERABTEILUNG]" size="40"/></td></tr>
    <tr><td>Ansprechpartner:</td><td></td><td><input type="text" name="ansprechpartner" size="40" value="[ANSPRECHPARTNER]"/></td></tr>
    <tr><td>Adresszusatz:</td><td></td><td><input type="text" name="adresszusatz" size="40" value="[ADRESSZUSATZ]"/></td></tr>
    <tr><td><b>Stra&szlig;e / Nr.:*</b></td><td></td><td><input type="text" name="strasse" value="[STRASSE]" size="40" style="background-color:#BDE5F8;"/>[MSGSTRASSE]</td></tr>
    <tr><td><b>PLZ / Ort:<b>*</b></td><td></td><td><input type="text" size="8" name="plz" value="[PLZ]" style="background-color:#BDE5F8;">&nbsp;<input type="text" style="background-color:#BDE5F8;" name="ort" value="[ORT]" size="29"/>[MSGORT]</td></tr>
    <tr><td><b>Land:*</b></td><td></td><td><select name="land">[LAND]</select></td></tr>
    <tr><td><br></td><td></td><td></td></tr>
    <tr><td>Lieferadresse:</td><td></td><td><input type="checkbox" name="abweichendelieferadresse" value="1" [ABWEICHENDELIEFERADRESSE]>Abweichende Lieferadresse&nbsp;</td></tr>
    <tr><td>Vollst&auml;ndiger Name / Firma:*</td><td></td><td><input type="text" name="liefername" size="40" value="[LIEFERNAME]" />[MSGNAME]</td></tr>
    <tr><td>Stra&szlig;e / Nr.:*</td><td></td><td><input type="text" name="lieferstrasse" value="[LIEFERSTRASSE]" size="40" />[MSGSTRASSE]</td></tr>
    <tr><td>PLZ / Ort:*</td><td></td><td><input type="text" size="8" name="lieferplz" value="[LIEFERPLZ]" />&nbsp;<input type="text"  name="lieferort" value="[LIEFERORT]" size="29"/>[MSGORT]</td></tr>
    <tr><td>Telefon:</td><td></td><td><input type="text" name="telefon" value="[TELEFON]" size="40"/></td></tr>
    <tr><td></td><td></td><td>(<i>f&uuml;r m&ouml;gliche R&uuml;ckfragen zur Bestellung</i>)</td></tr>
    <tr><td>Telefax:</td><td></td><td><input type="text" name="telefax" value="[TELEFAX]" size="40"/></td></tr>
<!--   <tr><td></td><td></td><td><input type="checkbox" name="abfax" value="1" [ABFAX]>Bitte Auftragsbest&auml;tigung per Fax senden</td></tr> -->
    <tr><td>E-Mail:</td><td></td><td><input type="text" name="email" value="[EMAIL]" size="40"/>[MSGEMAIL]</td></tr>
    <tr><td>UST-ID / VAT-ID:</td><td></td><td><input type="text" name="ustid" value="[USTID]" size="40"/></td></tr>
    <tr><td>Ihre Bestellnummer:</td><td></td><td><input type="text" name="bestellnummer" value="[BESTELLNUMMER]" size="40"/></td></tr>
    <tr><td>Ihre Kundennummer:</td><td></td><td><input type="text" name="kundennummer" size="40" value="[KUNDENNUMMER]"/></td></tr>
    </table>

    <br><hr noshade><br>
    <div align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr align="center">
	  <td >&nbsp;</td>
	  <td width="1%" >Anzahl</td>

	  <td width="70%" >Artikel</td>
	  <td width="30%" >Summe</td>
	</tr>
	[ARTIKELLISTE]	

      </table>
    </div>

    <br><hr noshade><br>
  <div class="noprint" style="padding-top:0px;" align="right">
      <input class="printbut" type="submit" value="aktualisieren" name="refresh">
      <input class="printbut" type="submit" value="Bestellung drucken" name="drucken">
      <input class="printbut" type="submit" value="Angebot anfordern" name="angebot"><br><br>
    </div>

    <div align="center">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
	  <td style="padding-bottom:10px;">In der Auftragbest&auml;tigung erhalten Sie die Gesamtkosten f&uuml;r die Bestellung inkl. Versand (pauschal pro Bestellung 3,95 EUR). Faxbestellungen werden per Rechnung als Zahlungsmittel versendet.
	</tr>
	      </table>
    </div>
    <br><br><br>

    </div>
      echo $id;
</form>

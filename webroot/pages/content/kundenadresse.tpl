    <h3>Rechnungsadresse / Bestelldaten</h3>
    <table width="90%">
    <tr><td width="300" rowspan="16"></td>
      <td><b>Adresse:*</b></td><td width="10">&nbsp;</td><td><select name="adresse">[ADRESSE]</select></td></tr>
    <tr><td width="300"><b>Vollst&auml;ndiger Name / Firma:*</b></td><td></td><td><input type="text" name="name" size="40" value="[NAME]" style="background-color:#BDE5F8;"/>[MSGNAME]</td></tr>
    <tr><td>Abteilung:</td><td></td><td><input type="text" name="abteilung" value="[ABTEILUNG]" size="40"/></td></tr>
    <tr><td>Unterabteilung:</td><td></td><td><input type="text" name="unterabteilung" value="[UNTERABTEILUNG]" size="40"/></td></tr>
    <tr><td>Ansprechpartner:</td><td></td><td><input type="text" name="ansprechpartner" size="40" value="[ANSPRECHPARTNER]"/></td></tr>
    <tr><td>Adresszusatz:</td><td></td><td><input type="text" name="adresszusatz" size="40"/></td></tr>
    <tr><td><b>Stra&szlig;e / Nr.:*</b></td><td></td><td><input type="text" name="strasse" value="[STRASSE]" size="40" style="background-color:#BDE5F8;"/>[MSGSTRASSE]</td></tr>
    <tr><td><b>PLZ / Ort:<b>*</b></td><td></td><td><input type="text" size="8" name="plz" value="[PLZ]" style="background-color:#BDE5F8;">&nbsp;<input type="text" style="background-color:#BDE5F8;" name="ort" value="[ORT]" size="27"/>[MSGORT]</td></tr>
    <tr><td><b>Land:*</b></td><td></td><td><select name="land">[LAND]</select></td></tr>

<!--    <tr><td><br></td><td></td><td></td></tr>
    <tr><td>Lieferadresse:</td><td></td><td>

      <br><input type="radio" name="lieferung" value="standard" [STANDARD]>Lieferung an Rechnungsadresse(3,95 &euro;)
      <br><input type="radio" name="lieferung" value="abweichendelieferadresse" [ABWEICHENDELIEFERADRESSE]>Abweichende Lieferadresse&nbsp; (3,95 &euro;)
      <br><input type="radio" name="lieferung" value="packstation" [PACKSTATION]>Packstation als Lieferadresse (3,95 &euro;)[MSGPACKSTATION]
      <br><input type="radio" name="lieferung" value="selbstabholer" [SELBSTABHOLER]>Selbstabholer in Augsburg (Es entfallen die Versandkosten)[MSGSELBSTABHOLER]
<br><br>
      </td></tr>
    <tr style="[ZAHLUNGSWEISE_TD]"><td><a name="zahl">[FONT_ZAHLUNGSWEISE_OPEN]Zahlungsweise:[FONT_ZAHLUNGSWEISE_CLOSE]</a></td><td style="background-color: #fff"></td><td style="[ZAHLUNGSWEISE_TD]"><select name="zahlungsweise">[ZAHLUNGSWEISE]</select>[MSGZAHLUNGSWEISE]</td></tr>
-->

    <tr><td><br></td><td></td><td></td></tr>
    <tr><td>Telefon:</td><td></td><td><input type="text" name="telefon" value="[TELEFON]" size="40"/></td></tr>
    <tr><td></td><td></td><td>(<i>f&uuml;r m&ouml;gliche R&uuml;ckfragen zur Bestellung</i>)</td></tr>
    <tr><td>Telefax:</td><td></td><td><input type="text" name="telefax" value="[TELEFAX]" size="40"/></td></tr>
    <!--<tr><td></td><td></td><td><input type="checkbox" name="abfax" value="1" [ABFAX]>Bitte Auftragsbest&auml;tigung per Fax senden</td></tr>-->
    <tr><td><b>E-Mail:*</b></td><td></td><td><input type="text" name="email" style="background-color:#BDE5F8;" value="[EMAIL]" size="40"/>[MSGEMAIL]</td></tr>
    <tr><td><b>E-Mail wdh.:*</b></td><td></td><td><input type="text" name="emailwdh" style="background-color:#BDE5F8;" value="[EMAILWDH]" size="40"/>[MSGEMAILWDH]</td></tr>
    <!--<tr><td>Optionales Bestellpasswort:</td><td></td><td><input type="password" name="passwort" value="[PASSWORT]" size="40"/>[MSGPASSWORT]</td></tr>
    <tr><td>wdh. Optionales Bestellpasswort:</td><td></td><td><input type="password" name="passwortwdh" value="[PASSWORTWDH]" size="40"/></td></tr>
    <tr><td></td><td></td><td>(<i>Ein optionales Bestellpasswort erh&ouml;ht die Sicherheit bei der Bestellung, da so z.B. die Trackingdaten nur von berechtigten Personen gelesen werden d&uuml;rfen.</i>)</td></tr>-->
    <!--<tr><td>UST-ID / VAT-ID:</td><td></td><td><input type="text" name="ustid" value="[USTID]" size="40"/></td></tr>-->

<!--
    <tr><td>Ihre interne Bestellnummer:</td><td></td><td><input type="text" name="bestellnummer" value="[BESTELLNUMMER]" size="40"/></td></tr>
    <tr><td>Ich/wir habe/haben bereits eine Kundennummer:</td><td></td><td><input type="text" name="kundennummer" size="40" value="[KUNDENNUMMER]"/></td></tr>
-->
    <tr><td></td><td></td><td colspan="2" align="right"><br><br><input type="submit" name="abschicken" value="weiter"></td></tr>

    </table>

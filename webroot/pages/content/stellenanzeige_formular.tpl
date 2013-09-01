<script type="text/javascript" src="./js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({  
  mode : "exact",
  theme : "advanced",
  skin: "o2k7",
  elements : "kurzbeschreibung,beschreibung,profil",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,forecolor,backcolor,|,formatselect,fontselect,fontsizeselect",
  theme_advanced_buttons2: "",
  theme_advanced_buttons3: "",
  theme_advanced_buttons4: ""

});

</script>
[MESSAGE2]
<br>
<form method="POST" action="" name="stellenanzeige" enctype="multipart/form-data">
<fieldset><legend>Anzeigentyp</legend>
<table width="53%" border="0">
  <tr>
    <td width="65%"><b>Wo soll das Stellenangebot angezeigt werden?*</b></td>
    <td><input type="checkbox" name="online" value="1" [ONLINECHECKED]/>Online<br>
        <input type="checkbox" name="zeitschrift" value="1" [ZEITSCHRIFTCHECKED]/>Zeitschrift </td>
  </tr>
  <tr>
    <td width="65%">In welcher Ausgabe der Zeitschrift?</td>
    <td><select name="ausgabe" size="1" >[AUSGABE]</select></td>
  </tr>
</table>
</fieldset>

<fieldset><legend>Firmendaten</legend>
  <table width="100%" border="0">
    <tr>
      <td width="20%"><b>Name des Ansprechpartners:*</b></td>
      <td><input type="text" size="40" name="ansprechpartner" value="[ANSPRECHPARTNER]" /></td>
      <td rowspan="10" valign="top" align="center">[BILD]</td>
    </tr>
    <tr>
      <td><b>Telefon des Ansprechpartners:*</b></td>
      <td><input type="text" size="20" name="ansprechpartner_telefon" value="[ANSPRECHPARTNERTELEFON]" /></td>
    </tr>
    <tr><td>&nbsp;</td><td></td></tr>
    <tr>
      <td>Firmenname:</td>
      <td><input type="text" size="40" name="firmenname" value="[FIRMENNAME]" /></td>
    </tr>
    <tr>
      <td>Telefon:</td>
      <td><input type="text" size="20" name="telefon" value="[TELEFON]" /></td>
    </tr>
    <tr>
      <td>Stra&szlig;e:</td>
      <td><input type="text" size="40" name="strasse" value="[STRASSE]" /></td>
    </tr>
    <tr>
      <td>Plz./Ort.:</td>
      <td><input type="text" size="8" name="plz" value="[PLZ]" />&nbsp;&nbsp;<input type="text" size="28" name="ort" value="[ORT]" /></td>
    </tr>
    <tr>
      <td>Land:</td>
      <td><select name="land">[LAND]</select></td>
    </tr>
    <tr>
      <td>URL:</td>
      <td><input type="text" size="40" name="url" value="[URL]" /></td>
    </tr>
    <tr>

    </tr>
      <td>Firmenlogo hochladen:</td>
      <td><input type="hidden" name="joblogocompleted" value="1"><input type="file" name="joblogo" size="30" />
          <br>max. 220x130 pixel, vorzugsweise mit wei&szlig;em/transparentem Hintergrund</td>
    <tr><td>&nbsp;</td><td></td></tr>
  </table>
</fieldset>

<fieldset><legend>Allgemein</legend>
<table width="53%" border="0">
  <tr>
    <td><b>Anzeigentitel*</b></td>
    <td><input type="text" size="40" name="titel" value="[TITEL]" /></td>  
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td>Kurzbeschreibung</td> 
    <td><textarea name="kurzbeschreibung" id="kurzbeschreibung">[KURZBESCHREIBUNG]</textarea></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td>Ausf&uuml;hrliche Beschreibung</td> 
    <td><textarea name="beschreibung" id="beschreibung">[BESCHREIBUNG]</textarea></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td>Anforderungsprofil</td> 
    <td><textarea name="profil" id="profil">[PROFIL]</textarea></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td>Zeitraum</td> 
    <td><input type="text" size="7" name="zeitraum" value="[ZEITRAUM]" /></td>
  </tr>
  <tr>
    <td>Verg&uuml;tung</td> 
    <td><input type="text" size="7" name="verguetung" value="[VERGUETUNG]" /></td>
  </tr>
</table>
</fieldset>

<fieldset><legend>T&auml;tigkeitsbereich</legend>
W&auml;hlen sie bitte einen Bereich f&uuml;r den Sie Personal suchen.<br>
[TAETIGKEIT]
</fieldset>

<fieldset><legend>Jobarten</legend>
Welche Art von Job haben Sie zu vergeben?
[JOBART]
</fieldset>

<fieldset><legend>Sprachkentnisse</legend>
Welche Sprachkentnisse müssen die Bewerber mitbringen?
[SPRACHKENTNISSE]
</fieldset>

<fieldset><legend>Schulabschluss</legend>
Welche Schulabschlüsse müssen die Bewerber haben?
[SCHULABSCHLUSS]
</fieldset>

<fieldset><legend>Bundesländer</legend>
In welchen Bundesländern suchen Sie Bewerber?
[BUNDESLAND]
</fieldset>

<fieldset><legend>Sonstige</legend>
<table width="53%" border="0">
  <tr>
    <td>Ist ein pers. Bewerbungsschreiben erforderlich?</td>
    <td><input type="radio" size="40" name="bewerbung" value="1" [BEWERBUNGJA]/>Ja<input type="radio" size="40" name="bewerbung" value="0" [BEWERBUNGNEIN]/>Nein</td>
  </tr>
  <tr>
    <td>Ist ein F&uuml;hrerschein erforderlich?</td>
    <td><input type="radio" name="fuehrerschein" value="1" [FUEHRERSCHEINJA]/>Ja<input type="radio" name="fuehrerschein" value="0" [FUEHRERSCHEINNEIN]/>Nein</td>
  </tr>
  <tr>
    <td>Ist ein Auto erforderlich?</td>
    <td><input type="radio" name="auto" value="1" [AUTOJA]/>Ja<input type="radio" name="auto" value="0" [AUTONEIN]/>Nein</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr
</table>
</fieldset>
<table width="100%" border="0">
  <tr>
    <td></td>
    <td align="right">[BUTTON]</td>
  </tr>
</table>
</form>

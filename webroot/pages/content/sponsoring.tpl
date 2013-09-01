<div stlye="width:100%;">
  <h1>Firmendatenbank</h1>
  <br>
In der Firmendatenbank findet man Unternehmen aus der Branche. Ist man auf der Suche nach einer Firma mit einer bestimmten Fähigkeit 
oder einer Kernkompetenz kann einfach und bequem diese Datenbank hier durchsucht werden.

Ob dies als Recherche f&uuml;r eine Studienarbeit, Marktanalyse oder als Basis f&uuml;r die Suche nach einem Auftragnehmer
spielt keine Rolle.


  <br><br>
  Wollen Sie auch in unserem Branchenindex aufgef&uuml;hrt sein? Dann <a href="./index.php?module=register&action=list">registrieren</a> Sie sich bei uns und erstellen Ihren pers&ouml;nlichen Eintrag.
  <br>[MESSAGE]<br>
  <form method="post" action="" name="branchenindex">
  <fieldset><legend>Suchkriterien</legend>
  <table width="100%" border="0">
    <tr>
      <td width="25%">Suche nach Namen:</td>
      <td><input type="text" name="name" style="width:80%" value="[NAME]"/></td>
    </tr>
    <tr>
      <td width="25%">Suche in Beschreibung:</td>
      <td><input type="text" name="beschreibung" style="width:80%" value="[BESCHREIBUNG]"/></td>
    </tr>
    <tr>
      <td>Postleitzahl:</td>
      <td><input type="text" name="plz" size="8" value="[PLZ]"/>&nbsp;
	[UMKREIS]
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">[KATEGORIEN]</td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="suchen" value="Suchen" /></td>
    </tr>
  </table>
  </fieldset>

  <fieldset><legend>Ergebnisse</legend>
<!--
  <div style="float:right;">Ergebnisse pro Seite 
    <a href="./index.php?module=sponsoring&anzahl=10">10</a>
    <a href="./index.php?module=sponsoring&anzahl=15">15</a>
    <a href="./index.php?module=sponsoring&anzahl=25">25</a>
  </div>
-->
  [ERGEBNISSE]<br>
  <div style="text-align:center;">[SEITENINDEX]</div>
  </fieldset>

  </form>
</div>

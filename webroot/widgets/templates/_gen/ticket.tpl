<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]


<table border="0" width="100%">
<tr><td><table width="100%"><tr><td>

[MELDUNG]
<br>

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="4" bordercolor="" class="" align="" bgcolor="" height="" valign="">Ticket [SCHLUESSEL]<br></td>
      </tr>
<tr valign="top" colspan="3">
<td>
<table width="100%"><tr valign="top"><td>
<br><br>Betreff:&nbsp;
<i>[BETREFF]</i><br><hr>
<pre>
[TEXT]
</pre>
</td><td>&nbsp;</td><td width="50%">
<fieldset><legend>Kunde / Nachricht</legend>
<table>
<tr><td width="40%">Kunde: </td><td><b>[NAME]</b></td></tr>
<tr><td>Kontakt: </td><td>[EMAIL]</td></tr>
<tr><td>Zeit: </td><td>[ZEIT]</td></tr>
<tr><td>Wartezeit: </td><td><b>[WARTEZEIT]</b></td></tr>
<tr><td>Quelle: </td><td>[QUELLE]</td></tr>
<!-- <tr><td>Status: </td><td>[STATUS]</td></tr> -->
</table>
</fieldset>
[TEST][MSGTEST]


</td></tr>
<tr><td></td><td></td><td>
<fieldset><legend>Informationen</legend>
<table>
<tr><td>Prio: </td><td><b>[PRIO]</b></td></tr>
<tr><td>Warteschlange: </td><td>[WARTESCHLANGE]</td></tr>
<tr><td>Projekt: </td><td>[EPROO_SELECT_PROJEKT]</td></tr>
</table>
</fieldset>

<fieldset><legend>Gerspr&auml;chsverlauf</legend>
[TABLE]
</fieldset>

</td></tr>
</table>

</td>
</tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="4" bordercolor="" classname="orange2" class="orange2">
[LESENSTART]
<input type="button" name="abschicken" onclick="javascript:window.open('index.php?module=ticket&action=antwort&message=[LASTMESSAGE]','popup','location=no,menubar=no,toolbar=no,status=no,resizable=yes,scrollbars=yes,width=1000,height=600')"
    value="letzte Mail beantworten" />
<input type="button" name="abschicken" onclick="javascript:window.open('index.php?module=ticket&action=antwort&message=[MESSAGE]','popup','location=no,menubar=no,toolbar=no,status=no,resizable=yes,scrollbars=yes,width=1000,height=600')"
    value="aktuelle Mail beantworten" />
<input type="submit" name="abschicken"
    value="&Auml;nderung &uuml;bernehmen" /> 
[LESENENDE]
    <input type="submit" name="zurueck" value="Zur&uuml;ck"/></td>
    </tr>
  
    </tbody>
  </table>
  </form>
</td></tr></table></td></tr>
</table>


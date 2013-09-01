<script type="text/javascript">
function popup()
{
  fenster = window.open("./plugins/phpletter/index.php", "Newsletter", "width=900,height=700,status=yes,scrollbars=yes,resizable=yes");
  fenster.focus();
}
</script>

<div stlye="width:100%;">
  <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Newsletter-Export</div>
<form name="newsletterexportform" action="./index.php?module=newsletterexport&action=list" method="POST">
<br>
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
<br>[MESSAGE]<br>

<div class="bluebox">
<b style="font-size: 1.4em;">1. Schritt: E-Mail Adressen Export</b>
<hr>
Adressen exportieren f&uuml;r Bereich:&nbsp;<select name="bereich">[BEREICH]</select>&nbsp;
<input type="submit" name="exportsubmit" value="Exportieren">
</div>
<br>
<div class="bluebox">
<b style="font-size: 1.4em;">2. Schritt: Newsletter schreiben und versenden</b>
<hr>
<a href="#" onclick="popup()" > Weiter zum Newsletter-Skript</a> (Abmelden nicht vergessen)
</div>
<br>
<div class="bluebox">
<b style="font-size: 1.4em;">3. Schritt: Tabellen leeren</b>
<hr>
<a href="./index.php?module=newsletterexport&action=clear">Tabellen leeren</a>
</div>





</form>
<br>
</div>

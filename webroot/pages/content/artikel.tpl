<script type="text/javascript"> 
     var tabView = new YAHOO.widget.TabView('demo'); 
</script> 

<table border="0" width="100%">
<tr><td colspan="4" align="right">
<table border=0 cellpadding=0 cellspacing=0 width="100%"><tr valign="middle"><td><b></b></td><td align="right" width="90%">
<a style="text-decoration:none;cursor: pointer;" onclick="javascript:window.print()"><img border="0" src="./themes/default/images/print.png"></a></td><td>&nbsp;&nbsp;<a style="text-decoration:none;cursor: pointer;" onclick="javascript:window.print()">Drucken</a>&nbsp;&nbsp;
<!--<img src="./themes/default/images/mail.png">&nbsp;Per eMail versenden-->
</td></tr></table>
<hr width="100%" style="border-bottom: 1px solid #ccc;  border-top: 0px; border-left: 0px; border-right: 0px;">
</td></tr>
<tr valign="top"><td colspan="4">
<h1>
[NAME]
</h1>
</td></tr>
<tr valign="top"><td width="77%" colspan="2" height="480">

<div id="demo" class="yui-navset"> 
    <ul class="yui-nav">
        <li class="selected"><a href="#tab1"><em>&Uuml;bersicht</em></a></li>
        [TAB2START]<li><a href="#tab2"><em>Beschreibung</em></a></li>[TAB2END]
        [TAB3START]<li><a href="#tab2"><em>Datenbl&auml;tter/Downloads</em></a></li>[TAB3END]
    </ul>
    <div class="yui-content" style="background-color:#ffffff">

<div style="background-color:#fff">
	<table border="0">
	<tr height="430"><td width="">
	<center>
	[IMAGES]
	<br>
	<br>
	Abbildung ist &auml;hnlich.<br>
	Ausschlaggebend ist die Produktbeschreibung
	</center>
	</td><td valign="top">
	<br>
<table width="100%" cellpadding="0" cellspacing="0"><tr><td>
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr valign="top"><td><b>Hersteller:</b></td><td>[HERSTELLER]</td></tr>
	<tr valign="bottom"><td><b>Bestell-Nr.:</b></td><td>[NUMMER]</td></tr>
	<tr valign="bottom"><td><b>Preis:</b></td><td>[PREIS]</td></tr>
	</table>
</td><td>
	<table border="0"><tr><td>
	<form action="./lib/onlinebestellung/cart/cartaction.php" method="post">
	<input type="hidden" name="cmd" value="add">
	<input type="hidden" name="articleid" value="[NUMMER]">
	<input type="hidden" name="tax" value="[STEUER]">
	<input type="hidden" name="price" value="[PREIS]">
	<input type="hidden" name="title" value="[NAME]">
	Menge:</td><td><input type="text" name="quantity" size="1" value="1"></tD><td>
	<input type="image" src="./themes/default/images/basket_add.png"></td></tr>
	<tr><td>Preis:</td><td colspan="2">[PREIS] EUR</td></tr>
	</table>
</td></tr></table>

	</form>
<br>
	[UEBERSICHT]
	</td></tr>
	</table>
</div>

[TAB2START]<div>[BESCHREIBUNG]</div>[TAB2END]

[TAB3START]<div>[DATENBLAETTER]</div>[TAB3END]

</div>
</div>


</td><td>&nbsp;</td><td>

<br>

<div class="greybox spacer">
<b>Verf&uuml;gbare Menge:</b>
<br><br>
<table border="0">
<tr><td>Im Lager:</td><td><img src="./themes/default/images/circle_[COLOR].png" width="10">&nbsp;</td><td></td></tr>
<tr><td>Preis f&uuml;r:</td><td>1 St&uuml;ck</td><td></td></tr>
<tr><td>Einzelpreis:</td><td colspan="2">[PREIS] EUR</td></tr>
<tr><td><br></td><td></td><td></td></tr>
<tr><td>Kaufen:</td><td nowrap>
<form action="./lib/onlinebestellung/cart/cartaction.php" method="post">
<input type="hidden" name="cmd" value="add">
<input type="hidden" name="articleid" value="[NUMMER]">
<input type="hidden" name="tax" value="[STEUER]">
<input type="hidden" name="price" value="[PREIS]">
<input type="hidden" name="title" value="[NAME]">
<input type="text" name="quantity" size="1" value="1"> 
</td><td><input type="image" src="./themes/default/images/basket_add.png"></td></tr>
</form>
</table>
</div>

<!--
<br>
<div class="greybox spacer">
<b>Passende Artikel:</b>
<br>
<ul>
<li>USB-Kabel</li>
<li>JTAG ICE mkII</li>
<li>Netzteil Universal</li>
</ul>
</div>
-->
[HERSTELLERINFOSTART]
<br>
<div class="greybox spacer">
<b>Artikel aus eigener Produktion:</b>
<br><br>
Dieser Artikel enstanden
gemeinsam mit der Firma In-Circuit GmbH.
Vom Prototyp bis zur Serie <a href="index.php?module=content&action=show&page=in-circuit">mehr...</a>
<br>
<br>
</div>
[HERSTELLERINFOEND]

</td></tr>
</table>
<br><center><p>[AKTUALISIERUNG] | http://www.embedded-projects.net</p></center>

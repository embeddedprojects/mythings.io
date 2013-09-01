<script type="text/javascript" src="./js/base64.js"></script>
<script type="text/javascript">
activ = ''
function render(text)
{
  if(activ=='' || (activ!='' && activ!=text))
  {
    document.getElementById('aboausgaben').innerHTML = '<div class="bluebox"><b style="font-size: 1.4em;">Abo-Ausgaben</b>' +
						       '<hr>'+ base64_decode(text) + '</div>';
    activ = text;
  }else
  {
    document.getElementById('aboausgaben').innerHTML = '';
    activ = '';
  }
}

function inputText(id)
{
  var text = prompt("Geben Sie bitte einen Grund für die Sperre ein.");
  
  if(text!=null)
  {
    if(text!='' && id!="")
    {
      encoded = base64_encode(text);
      var link = './index.php?module=kundenverwaltung&action=lock&id=' + id + '&grund=' + encoded;
      window.location.href=link;
    }else
      alert("Sie haben keinen Sperrgrund angegeben.");
  }
}


</script>

<div stlye="width:100%;">
  <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Kundenverwaltung - [NAME]</div>
<br>
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
<br><br>

<a href="./index.php?module=kundenverwaltung&action=list">Zur&uuml;ck</a>
<div class="bluebox">
  <table width="100%">
    <tr>
      <td width="50%" valign="top">
	<b style="font-size: 1.4em;">Personendetails</b>
	<hr>
	<table width="">
	  <tr><td width="20%">Name:</td><td>[PERSONENNAME]</td></tr>
	  <tr><td>Firmenname:</td><td>[FIRMENNAME]</td></tr>
	  <tr><td>Stra&szlig;e:</td><td>[STRASSE]</td></tr>
	  <tr><td>Adresszusatz:</td><td>[ZUSATZ]</td></tr>
	  <tr><td>Plz:</td><td>[PLZ]</td></tr>
	  <tr><td>Ort:</td><td>[ORT]</td></tr>
	  <tr><td>Land:</td><td>[LAND]</td></tr>
	  <tr><td>Homepage:</td><td>[HOMEPAGE]</td></tr>
	  <tr><td>Telefon:</td><td>[TELEFON]</td></tr>
	  <tr><td>E-Mail Adresse:</td><td>[EMAIL]</td></tr>
	</table>
      </td>
      <td valign="top">
	<b style="font-size: 1.4em;">Abonnement-Details</b>
	<hr>
	<table width="">
	  <tr><td>Verl&auml;ngerungstyp:</td><td>[VTYP]</td></tr>
	  <tr><td>Adresstyp:</td><td>[ATYP]</td></tr>
	  <tr><td>Versand-Name:</td><td>[VNAME]</td></tr>
	  <tr><td>Versand-Stra&szlig;e:</td><td>[VSTRASSE]</td></tr>
	  <tr><td>Versand-Adresszusatz:</td><td>[VZUSATZ]</td></tr>
	  <tr><td>Versand-Plz:</td><td>[VPLZ]</td></tr>
	  <tr><td>Versand-Ort:</td><td>[VORT]</td></tr>
	  <tr><td>&nbsp;</td><td></td></tr>
	  <tr><td>Versendete Ausgaben insgesamt:</td><td><b>[ANZAHL]</b></td></tr>
	</table>
      </td>
    </tr>
  </table>
</div>

<br>
<div class="bluebox">
<b style="font-size: 1.4em;">Abonnements</b>
<hr>
<table width="100%">
[ABOTABLE]
</table>
</div>

<br>
<div id="aboausgaben"></div>




</div>

<div id="simpleForm">
<form action="./index.php?module=newsletter&action=list" method="post" name="newsletter">
<H2>Newsletter:</H2>
<table>
  <tr>
    <td><input type="text" name="newsletteremail" id="newsletteremail" size="16" value="Ihre eMail-Adresse" onclick="this.value=''"></td>
    <td><input type="image" name="newslettersubmit" src="./themes/embeddedprojects/images/btn_los.gif" alt="Absenden" value="Los"></td>
  </tr>
  <tr>
    <td colspan="2">
        <input type="radio" name="action" value="signIn" CHECKED>Eintragen
        <input type="radio" name="action" value="signOut">Austragen
    </td>
  </tr>
</table>
</form>
</div>

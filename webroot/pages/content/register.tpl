<form action="" method="POST" name="registerform">
<div stlye="width:100%;">
<h1>Register</h1>
Create in two steps your account. We need only an valid email address and a password.
<br><br>
<!--    <h2>Connect with Facebook</h2>
     <br><br>
<table width="90%" border="0">
<tr><td width="200">Connect:</td><td><a href="">Start with your Facebook Account</a></td></tr>
</table>
    <br>
    <br>-->
    <h2>Create an Account</h2>
    <br>[MESSAGE]<br>
    Fields marked with an asterisk are mandatory.
    <br>
    <br>
    <table width="90%" border="0">
<!--      <tr><td>Vorname:*</td><td><input type="text" name="firstname" size="40" value="[NAME]" class="inputField long"/></td></tr>
      <tr><td>Nachname:*</td><td><input type="text" name="sirname" size="40" value="[NAME]" class="inputField long"/></td></tr>
      <tr><td>Stra&szlig;e:*</td><td><input type="text" name="strasse" size="40" value="[STRASSE]" class="inputField long"/></td></tr>
      <tr><td>Plz. / Ort:*</td><td><input type="text" name="plz" size="8" value="[PLZ]" class="inputField small" />
                                    &nbsp;<input type="text" name="ort" size="29" value="[ORT]" class="inputField medium"/></td></tr>
      <tr><td>Land:*</td><td><select name="land" class="inputField long"><option value="DE">Deutschland</option></select></td></tr>
      <tr><td>Telefon:</td><td><input type="text" name="telefon" size="40" value="[TELEFON]" class="inputField long" /></td></tr>-->
<!--      <tr><td width="200">Nickname:*</td><td><input type="text" name="nickname" size="40" value="[NAME]" class="inputField long"/></td></tr>-->
      <tr><td>email*:</td><td><input type="text" name="email" size="40" value="[EMAIL]" class="inputField long"></td></tr>
      <!--<tr><td>Webseite:</td><td><input type="text" name="url" size="40" value="[URL]"></td></tr>-->
      <tr><td>Newsletter:</td><td><input type="checkbox" name="newsletter" value="1" [NEWSLETTERCHECKED]/></td></tr>
      <!--<tr><td>elektronische Ausgabe:</td><td><input type="checkbox" name="pdf" value="1" [PDFCHECKED]/></td></tr>
      <tr><td>Journal in Papierform:</td><td><input type="checkbox" name="journal" value="1" [JOURNALCHECKED]/></td></tr>
      <tr><td colspan="2">Sie werden beim ersten Login zu unserem Abo-Bestellassistenten weitergeleitet.</td></tr> -->
      <tr><td>&nbsp;</td><td></td></tr>
      <tr><td>Password:*</td><td><input type="password" name="passwort" size="40" class="inputField long"></td></tr>
      <tr><td>Password acknowledge:*</td><td><input type="password" name="passwort2" size="40" class="inputField long"></td></tr>
      <tr><td>&nbsp;</td><td></td></tr>
      <tr><td>Captcha:</td><td><img src="./index.php?module=register&action=captcha" alt="CAPTCHA image" align="top" />&nbsp;<input type="text" class="inputField small" name="captcha" id="validator" size="4" /></td></tr>
      <tr><td>&nbsp;</td><td></td></tr>
      <tr><td></td><td><input type="submit" name="submit" value="register" class="btnSubmit"/></td></tr>
    </table>
</div>
</form>

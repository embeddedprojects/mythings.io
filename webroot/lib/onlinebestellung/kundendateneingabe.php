<?
session_start();

include_once("customer/customer.inc.php");
$onload="initValidation()";
include("template/header.inc.php");

?>

    <script language="javascript" src="jsval/jsval.js"></script>
    <script language="javascript">
    <!--
        function initValidation()
        {
            var objForm = document.forms["customerform"];
            objForm.err = "Bitte fuellen Sie alle Pflichtfelder aus:\n\n";
	

            
	          objForm.elements["cdata[vorname]"].required = 1;
            objForm.elements["cdata[vorname]"].regexp = /^\w*$/;
            objForm.elements["cdata[vorname]"].realname = 'Vorname';
            
            objForm.elements["cdata[name]"].required = 1;
            objForm.elements["cdata[name]"].regexp = /^\w*$/;
            objForm.elements["cdata[name]"].realname = 'Name';
            
            objForm.elements["cdata[firma]"].required = 0;

            objForm.elements["cdata[adresse]"].required = 1;
            objForm.elements["cdata[adresse]"].realname = 'Adresse';

            objForm.elements["cdata[adresse2]"].required = 0;

            objForm.elements["cdata[plz]"].required = 1;
            objForm.elements["cdata[plz]"].regexp = "JSVAL_RX_ZIP";
            objForm.elements["cdata[plz]"].realname = 'PLZ';

            objForm.elements["cdata[ort]"].required = 1;
            objForm.elements["cdata[ort]"].realname = 'Ort';

            objForm.elements["cdata[tel]"].required = 1;
            objForm.elements["cdata[tel]"].realname = 'Telefon';

            objForm.elements["cdata[email]"].required = 1;
            objForm.elements["cdata[email]"].regexp = "JSVAL_RX_EMAIL";
            objForm.elements["cdata[email]"].realname = 'Email';

            objForm.elements["cdata[blz]"].required = 1;
            objForm.elements["cdata[blz]"].minlength = 8;
            objForm.elements["cdata[blz]"].maxlength = 8;
            objForm.elements["cdata[blz]"].realname = 'BLZ';

            objForm.elements["cdata[kto]"].required = 1;
            objForm.elements["cdata[kto]"].minlength = 3;
            objForm.elements["cdata[kto]"].maxlength = 15;
            objForm.elements["cdata[kto]"].realname = 'Konto';
            
            objForm.elements["cdata[ktoinhaber]"].required = 1;
            objForm.elements["cdata[ktoinhaber]"].realname = 'Kontoinhaber';

            objForm.elements["cdata[bank]"].required = 1;
            objForm.elements["cdata[bank]"].realname = 'Bank';
            


        }
    //-->
    </script>

<p>Bitte geben Sie Ihre persönlichen Daten ein.</p>

<form name="customerform" action="customer/customeraction.php" method="post" onSubmit="return validateCompleteForm(this, 'error');">
  <input type="hidden" name="cmd" value="save">
	<fieldset style="width:600;font-color:#000000;">
	<legend style="color:#000000; font-weight:bold;">Persönliche Daten</legend>
	<table width="100%" cellpadding="2" cellspacing="2">
		<tr><td colspan="5">&nbsp</td></tr>
		<tr>
			<td valign="middle">Vorname</td>
			<td valign="middle"><input type="text" name="cdata[vorname]" size="25" value="<? echo CustomerShowValue('vorname',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Name</td>
			<td valign="middle"><input type="text" name="cdata[name]" size="25" value="<? echo CustomerShowValue('name',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
		</tr>
		
		<tr>
			<td valign="middle">Firma</td>
			<td valign="middle" colspan="4"><input type="text" name="cdata[firma]" size="25" value="<? echo CustomerShowValue('firma',$_SESSION[customerlist]); ?>"></td>
		</tr>
		
		<tr>
			<td valign="middle">Adresse 1</td>
			<td valign="middle"><input type="text" name="cdata[adresse]" size="25" value="<? echo CustomerShowValue('adresse',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Adresse 2</td>
			<td valign="middle"><input type="text" name="cdata[adresse2]" size="25" value="<? echo CustomerShowValue('adresse2',$_SESSION[customerlist]); ?>"> <sup></sup></td>
		</tr>
		
		<tr>
			<td valign="middle">PLZ</td>
			<td valign="middle"><input type="text" name="cdata[plz]" size="25" value="<? echo CustomerShowValue('plz',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Ort</td>
			<td valign="middle"><input type="text" name="cdata[ort]" size="25" value="<? echo CustomerShowValue('ort',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
		</tr>
		
		<tr>
			<td valign="middle">Tel.</td>
			<td valign="middle"><input type="text" name="cdata[tel]" size="25" value="<? echo CustomerShowValue('tel',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Fax</td>
			<td valign="middle"><input type="text" name="cdata[fax]" size="25" value="<? echo CustomerShowValue('fax',$_SESSION[customerlist]); ?>"> </td>
		</tr>
		
		<tr>
			<td valign="middle">E-Mail</td>
			<td valign="middle"><input type="text" name="cdata[email]" size="25" value="<? echo CustomerShowValue('email',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Mobil</td>
			<td valign="middle"><input type="text" name="cdata[mobil]" size="25" value="<? echo CustomerShowValue('mobil',$_SESSION[customerlist]); ?>"></td>
		</tr>		

	</table>
</fieldset>
<p></p>
<p>Bitte geben Sie Ihre Bankverbindung an.</p>
	<fieldset style="width:600;font-color:#000000;"><legend style="color:#000000; font-weight:bold;">Bankverbindung</legend>
	<table width="100%" cellpadding="2" cellspacing="2">
		<tr><td colspan="5">&nbsp</td></tr>
		<tr>
			<td valign="middle">Kontoinhaber</td>
			<td valign="middle"><input type="text" name="cdata[ktoinhaber]" size="25" value="<? echo CustomerShowValue('ktoinhaber',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">Konto</td>
			<td valign="middle"><input type="text" name="cdata[kto]" size="25" value="<? echo CustomerShowValue('kto',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
		</tr>
		
		<tr>
			<td valign="middle">Name der Bank</td>
			<td valign="middle"><input type="text" name="cdata[bank]" size="25" value="<? echo CustomerShowValue('bank',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
			<td valign="middle">&nbsp</td>
			<td valign="middle">BLZ</td>
			<td valign="middle"><input type="text" name="cdata[blz]" size="25" value="<? echo CustomerShowValue('blz',$_SESSION[customerlist]); ?>"> <sup>*</sup></td>
		</tr>
		
		
	</table>
</fieldset>
<p><input type="submit"></p>

</form>

<p>* Pflichtfelder</p>


<hr>
<?
include ("template/footer.inc.php");	
?>

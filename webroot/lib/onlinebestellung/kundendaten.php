<?
session_start();

include ("customer/customer.inc.php");
$onload="initValidation()";
include ("template/header.inc.php");

?>

<table width="500" cellpadding="2" cellspacing="2">
		<tr>
		  <td colspan="2" class="customershowhead">Persönliche Daten</td></tr>
		</tr>
		  
    <tr>
		  <td colspan="2" class="customershowhead"></td></tr>
		</tr>
    		  
			<td valign="middle" class="customershowtitle">Vorname, Name</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('vorname',$_SESSION[customerlist]).'&nbsp;'.CustomerShowValue('name',$_SESSION[customerlist]); ?></td>
									
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Firma</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('firma',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Adresse</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('adresse',$_SESSION[customerlist]).'&nbsp;'.CustomerShowValue('adresse2',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">PLZ, Ort</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('plz',$_SESSION[customerlist]).'&nbsp;'.CustomerShowValue('ort',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Telefon</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('tel',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Fax</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('fax',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">E-Mail</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('email',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Mobil</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('mobil',$_SESSION[customerlist]); ?></td>
		</tr>		
		
    <tr>
		  <td colspan="2" class="customershowhead"></td></tr>
		</tr>		
		
		<tr>
		  <td colspan="2" class="customershowhead">Bankverbindung</td></tr>
		</tr>
		  
    <tr>
		  <td colspan="2" class="customershowhead"></td></tr>
		</tr>
			
		<tr>
			<td valign="middle" class="customershowtitle">Kontoinhaber</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('ktoinhaber',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Konto</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('kto',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">Name der Bank</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('bank',$_SESSION[customerlist]); ?></td>
		</tr>
		
		<tr>
			<td valign="middle" class="customershowtitle">BLZ</td>
			<td valign="middle" class="customershow"><? echo CustomerShowValue('blz',$_SESSION[customerlist]); ?></td>
		</tr>
		
		
	</table>

<?
include ("template/footer.inc.php");	
?>

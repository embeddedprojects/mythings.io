<?php
$rootpath = str_replace('/serienbrief.php','',__FILE__);
define('ROOTPATH',$rootpath);

$includePath = ini_get('include_path');
$includePath.= PATH_SEPARATOR.ROOTPATH.DIRECTORY_SEPARATOR.'lib';
ini_set('include_path', $includePath);
ini_set("max_execution_time", 0); //script unendlich lange ausführen

require_once('fpdi.php');

$mysql_host = 'localhost';
$mysql_database = 'sauter_epjournal';
$mysql_username = 'sauter_epjournal';
$mysql_password = 'XWvXPPENNJqStphD';
$mysql_table = 'requests';

class serienbrief_pdf extends FPDI { 
    var $recipients = array(); 
    var $template = 'vorlage.pdf';
    var $posX = 24;
    var $posY = 51;
    var $font = 'Arial';
    var $fontSize = 10;
    var $lineHeight = 4;
    function addRecipient($vorname,$nachname,$strasse,$plz,$ort,$land){
	$this->recipients[]=array('vorname'=>$vorname,'nachname'=>$nachname,'strasse'=>$strasse,'plz'=>$plz,'ort'=>$ort,'land'=>$land);
    }	 
    function getRecipientLabel($recipientNr){
	$result = $this->recipients[$recipientNr]['vorname']." ".$this->recipients[$recipientNr]['nachname']."\n";
	$result .= $this->recipients[$recipientNr]['strasse']."\n\n";
	$result .= $this->recipients[$recipientNr]['plz']." ".$this->recipients[$recipientNr]['ort']."\n";
	$result .= $this->recipients[$recipientNr]['land'];
	return $result;
    }
    function createSerienbrief() { 
        //$pagecount = $this->setSourceFile($this->template); 
	$pagecount ++;
	for ($recipient=0;$recipient<count($this->recipients);$recipient++){        
		for ($i = 1; $i <= $pagecount; $i++) { 
		  //$tplidx = $this->ImportPage($i); 
		  //$s = $this->getTemplatesize($tplidx); 
		  //$this->AddPage($s['h'] > $s['w'] ? 'P' : 'L'); 
		  $this->AddPage();
		  //$this->useTemplate($tplidx); 
		  if($i==1){
			// now write some text above the imported page
			$this->SetFont('Arial','U',8);
			$y = $this->posY;
			$x = $this->posX;
			$this->SetXY($this->posX, $this->posY-10);
			$this->MultiCell(0, $this->lineHeight,"Benedikt Sauter, Auf dem Kreuz 20, 86152 Augsburg");
			$this->posY = $y;
			$this->posX = $x;
			$this->SetFont($this->font);
			$this->SetFontSize($this->fontSize);
			$this->SetXY($this->posX, $this->posY);
			$this->MultiCell(0, $this->lineHeight, $this->getRecipientLabel($recipient));
		  }
		}
	} 
    } 

}
	//MySQL Abfrage durchführen
	$connection=mysql_connect($mysql_host, $mysql_username, $mysql_password) 
		or die("Verbindungsversuch zur Datenbank fehlgeschlagen");
	mysql_select_db($mysql_database, $connection) 
		or die("Konnte die Datenbank nicht waehlen.");
	//$sql = "SELECT * FROM $mysql_table WHERE printed='checked' AND email LIKE '%stueck%'";
	//$sql = "SELECT * FROM $mysql_table WHERE printed='checked' AND land LIKE '%reich%'";
	//$sql = "SELECT * FROM $mysql_table WHERE printed='checked' AND (land LIKE '%schland%' OR land='' OR land='D' OR land LIKE 'D%')";
	//$sql = "SELECT * FROM $mysql_table WHERE printed='checked' AND land LIKE '%weiz%'";
	//$sql = "SELECT * FROM $mysql_table WHERE printed='checked' AND land LIKE '%nether%'";
	$result = mysql_query($sql) or die(mysql_error());
	mysql_close($connection); 
	 
	$pdf =& new serienbrief_pdf(); 
	$nextRow = mysql_fetch_array($result);
	while ($nextRow){
		$pdf->addRecipient($nextRow['vorname'],$nextRow['nachname'],$nextRow['strasse'],$nextRow['plz'],$nextRow['ort'],$nextRow['land']);
		$nextRow = mysql_fetch_array($result);	
	}
	$pdf->createSerienbrief(); 
	 
	$pdf->Output('ausgabe/serienbrief.pdf', 'F'); 

?>

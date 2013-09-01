<?

include("../conf/main.conf.php");
include("../../phpwf/plugins/class.db.php");
include("../lib/imap.inc.php");
include("../lib/class.erpapi.php");


class app_t {
  var $DB;
  var $user;
}

$app = new app_t();


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);

/*
$test = new IMAP();
$accounts = $db->SelectArr("SELECT * from emailbackup");

for($i=0;$i<count($accounts);$i++)
{
  echo "E-Mail Account Backup: ".$accounts[$i]['benutzername']."\r\n";
  $mailbox = $test->imap_connect($accounts[$i]['server'],"993","INBOX",$accounts[$i]['benutzername'],
    $accounts[$i]['passwort'],3);
  //echo $test->imap_message_count($mailbox);
  $test->imap_import($mailbox,0,$accounts[$i]['loeschtage'],$accounts[$i]['id']);
}
echo "ready!\r\n";
*/


$erp = new erpAPI($app);


$projekt=1;
$quelle="shop@embedded-projects.net";
$kunde="Max Mustermann";
$mailadresse="sauter@ixbat.de";
$betreff="Status der Bestellung A";
$text='
Jetzt reicht es mir endlich
ichbitte um eine Stellungnahme

MfG Benedikt Sauter';

$erp->CreateTicket($projekt,$quelle,$kunde,$mailadresse,$betreff,$text);

$projekt=1;
$quelle="shop@embedded-projects.net";
$kunde="Max Mustermann";
$mailadresse="sauter@ixbat.de";
$betreff="Status der Bestellung B";
$text='
Jetzt reicht es mir endlich
ichbitte um eine Stellungnahme

MfG Benedikt Sauter';

$erp->CreateTicket($projekt,$quelle,$kunde,$mailadresse,$betreff,$text);

$projekt=1;
$quelle="shop@embedded-projects.net";
$kunde="Max Mustermann";
$mailadresse="sauter@ixbat.de";
$betreff="Status der Bestellung C";
$text='
Jetzt reicht es mir endlich
ichbitte um eine Stellungnahme

MfG Benedikt Sauter';


$erp->CreateTicket($projekt,$quelle,$kunde,$mailadresse,$betreff,$text);

$projekt=1;
$quelle="shop@embedded-projects.net";
$kunde="Max Mustermann";
$mailadresse="sauter@ixbat.de";
$betreff="Status der Bestellung D";
$text='
Jetzt reicht es mir endlich
ichbitte um eine Stellungnahme

MfG Benedikt Sauter';


$erp->CreateTicket($projekt,$quelle,$kunde,$mailadresse,$betreff,$text);



?>

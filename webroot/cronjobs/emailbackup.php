<?

include("../conf/main.conf.php");
include("../../phpwf/plugins/class.db.php");
include("../lib/imap.inc.php");

$conf = new Config();

$db = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);


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

?>

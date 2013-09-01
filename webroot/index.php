<?
/* Author: Benedikt Sauter <sauter@sistecs.de> 2007
 *
 * Dies ist sozusagen der Zuendschluessel fuer die Anwendung
 * Man definiert hier mit welcher Konfigurationsdatei
 * was fuer ein Bereich der Anwendung gestartet werden soll
 */

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-Control: no-store, no-cache, must-revalidate");
header("cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified
//error_reporting(E_ALL ^ E_NOTICE);

if ($_GET['ref']) $_SESSION['affiliate_ref'] = $_GET['ref'];
if ($_POST['ref']) $_SESSION['affiliate_ref'] = $_POST['ref'];


if ($_COOKIE['affiliate_ref']) { // Customer comes back and is registered in cookie
    $_SESSION['affiliate_ref'] = $_COOKIE['affiliate_ref'];
} else setcookie('affiliate_ref', $_SESSION['affiliate_ref'], time() + 3600*24*30); // 30 Tage



if($_GET[page_id]!="")
{
 include("index_cms.php");
 exit; 
}



// layer 1 -> mechnik steht bereit
include("eproosystem.php");
include("../conf/main.conf.php");
$config = new Config();
$app = new erpooSystem($config);

// layer 2 -> darfst du ueberhaupt?
include("../phpwf/class.session.php");
$session = new Session();
$session->Check($app);

// layer 3 -> nur noch abspielen
include("../phpwf/class.player.php");
$player = new Player();
$player->Run($session);


?>

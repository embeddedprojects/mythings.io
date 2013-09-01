<?
session_start();

include("customer.class.php");

$myCustomer =& new Customer($_SESSION[customerlist]);

if($_POST[cmd]=="")
{
  if($_GET[cmd]!="")
    $cmd=$_GET[cmd];
}
else {
  $cmd=$_POST[cmd];
}

// **** ab hier kann man weitere cmd ( commands) einfuegen!!

switch ($cmd)
{
  case "save":
    $myCustomer->CustomerSave($_POST[cdata]);
  break;
}

// **** ab hier wieder finger weg


// call desctructor
unset($myCustomer);
header("Location: ".$_SERVER[HTTP_REFERER]);




?>

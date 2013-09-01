<?
session_start();

include("cart.class.php");

$myCart	  =&  new Cart($_SESSION[articlelist]);

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
  case "showfull":
    $myCart->CartShow($_SESSION[articlelist]);
  break;
  case "add":
    $myCart->CartAddArticle($_POST[title],$_POST[quantity],$_POST[price],$_POST[tax],$_POST[articleid]);
  break;
  case "delete":
    $myCart->CartDeleteArticle($_GET[id]);
  break;	
  case "update":
    $myCart->CartUpdateCart($_POST[id],$_POST[quantity],$_POST[del]);
  break;	
  case "cartdelete":
    $myCart->CartDelete();
  break;	
}

// **** ab hier wieder finger weg


// call desctructor
unset($myCart);
header("Location: ".$_SERVER[HTTP_REFERER]);

?>

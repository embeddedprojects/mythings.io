<html>
<head></head>
<style type="text/css">
body,table {font-size:11px;}
</style>
<body>

<?

@session_start();
include ("cart/cart.inc.php");

echo CartTinyShow($_SESSION[articlelist]);

?>
<a href="../../index.php?module=bestellen&action=kasse" target="_parent">Zur Kasse</a>&nbsp;|&nbsp;<a href="../../index.php?module=bestellen&action=warenkorb" target="_parent">Zum Warenkorb</a>
<!--<br><a href="cart/cartaction.php?cmd=cartdelete">Warenkorb leeren</a>-->

<!--

<form action="cart/cartaction.php" method="post">
  <input type="hidden" name="cmd" value="cartdelete">
  <input type="submit" value="Warenkorb l&ouml;schen">
</form>

-->

</body>

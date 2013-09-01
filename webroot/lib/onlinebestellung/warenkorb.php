<?
session_start();

include ("cart/cart.inc.php");
include ("template/header.inc.php");
include ("article/articlelist.php");

//echo ArticleList($Article);

?>

<!--<form action="cart/cartaction.php" method="post">
	<input type="hidden" name="cmd" value="add">
	<input type="text" name="description" value="testartikel">
	<input type="text" name="quantity" value="1">
	<input type="text" name="price" value="116">
	<input type="text" name="tax" value="16">
	<input type="submit" value="abschicken">
</form>-->


<form action="cart/cartaction.php" method="post">
  <input type="hidden" name="cmd" value="cartdelete">
  <input type="submit" value="Warenkorb l&ouml;schen">
</form>


<hr>
<?

echo CartShow($_SESSION[articlelist]);


include ("template/footer.inc.php");	
?>

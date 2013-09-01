<?

function SetTestCookie()
{
  @setcookie ($key, 'test', time() + 3600);
}


function CheckCookie()
{
  $key = "cookietesteproo";
  @setcookie ($key, 'test', time() + 3600);

  if($_COOKIE[$key]=="")
    return 0;
  else {
    return 1;
  }
}  

?>

<?

$Article []=array(
'id'=>'1',
'title'=>'sisMedia!Start',
'description'=>'<ul><li>bis 10 Seiten</li><li>1 * ihr.name.de</li></ol>',
'indomains'=>'1',
'tax'=>'16',
'price'=>'12.99');

$Article []=array(
'id'=>'2',
'title'=>'sisMedia!Go',
'description'=>'<ul><li>bis 30 Seiten</li><li>1 * ihr.name.de</li></ol>',
'indomains'=>'1',
'tax'=>'16',
'price'=>'27.99');

$Article []=array(
'id'=>'3',
'title'=>'sisMedia!Fast',
'description'=>'<ul><li>bis 100 Seiten</li><li>2 * ihr.name.de</li></ol>',
'indomains'=>'2',
'tax'=>'16',
'price'=>'39.99');

  function ArticleList($Article) 
  {

  $ret  = "<table cellpadding=\"10\">";
    
    foreach($Article as $value)
    {
    $ret .= "<form action=\"cart/cartaction.php\" method=\"post\">";
    $ret .= "\n<input type=\"hidden\" name=\"cmd\" value=\"add\">";
    $ret .= "\n<tr>";
    $ret .= "\n<td valign=\"top\"><input type=\"hidden\" name=\"id\" value=\"".$value[id]."\">";
    $ret .= "\n<input type=\"hidden\" name=\"title\" value=\"".$value[title]."\">";
    $ret .= "\n".$value[title]."</td>";
    $ret .= "\n<td valign=\"top\">".$value[description]."</td>";
    $ret .= "\n<input type=\"hidden\" name=\"price\" value=\"".$value[price]."\">";
    $ret .= "\n<input type=\"hidden\" name=\"tax\" value=\"".$value[tax]."\">";
    $ret .= "\n<td valign=\"top\">".$value[price]." &euro;</td>";
    $ret .= "\n<td valign=\"top\"><input type=\"text\" name=\"quantity\" size=\"1\" value=\"1\"></td>";
    $ret .= "\n<td><input type=\"submit\" value=\"kaufen\"></td>";
    $ret .= "\n</tr></form>";
    }
  $ret .= "</table>";
  
  
  return $ret;
  
  }




?>

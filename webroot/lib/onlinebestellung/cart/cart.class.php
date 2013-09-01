<?

class Cart {
  var $CartArr;

  function Cart($CartArr)
  {
    $_SESSION[articlelist]=$CartArr;
    // schaue durch ob orgendwo menge 0
    register_shutdown_function(array(&$this, '_Cart'));
  } 
  
  function _Cart()
  {
    $_SESSION[articlelist]=$_SESSION[articlelist];    
    print_r($_SESSION[articlelist]);
  }

  function CartDelete()
  {
    unset($_SESSION[articlelist]);
  }

  function CartAddArticle($title,$quantity,$price,$tax,$articleid)
  {
    $_SESSION[update]=1;
    $_SESSION[update_quantity]=$quantity;
    $price = str_replace(",",".",$price);

    $Article=array( 'title'=>$title,
		    'quantity'=>$quantity,
		    'price'=>$price,
		    'articleid'=>$articleid,
		    'taxtype'=>$tax,
		    'tax'=>$tax);
    
    // pruefen ob artikel bereits im warenkorb, dann anzahl erhoehen 
//    if(count($_SESSION[articlelist]) > 2)
 //   {
      //return;
 //   }

    for($i=0; $i < count($_SESSION[articlelist]); $i++)
    {
      if($_SESSION[articlelist][$i]['title']==$title)
      {
	      $_SESSION[articlelist][$i]['quantity'] = $_SESSION[articlelist][$i]['quantity']  + $quantity;
	      return ;
      }
    }
    
    if(count($_SESSION[articlelist])>0)
      array_push($_SESSION[articlelist],$Article);
    else 
      $_SESSION[articlelist] = array($Article);
  }

  function CartDeleteArticle($artikelindex) 
  {
//print_r($_SESSION[articlelist]);

    unset($_SESSION[articlelist][$artikelindex]);
    $_SESSION[articlelist]=array_values($_SESSION[articlelist]);

//echo "<br><br>";
//print_r($_SESSION[articlelist]);
    //array_splice($_SESSION[articlelist],$artikelindex,1);
    //$_SESSION[articlelist][$artikelindex][description]="hallo";
    //echo "löschen $artikelindex";
  }
  
  function CartUpdateCart($id,$quantity,$del) 
  {
//print_r($del); echo "1";
//print_r($id); echo "2";
//print_r($_SESSION[articlelist]);


    // erst quatsch weg
    for ($i=0;$i<count($id);$i++)
    {
      if($_SESSION[articlelist][$i]['title']=="")
	$this->CartDeleteArticle($i);
    }


    // erst menge
    for ($i=0;$i<count($id);$i++)
    {
      if(is_numeric($quantity[$i]) && $quantity[$i] >0 )
	$_SESSION[articlelist][$i]['quantity']=$quantity[$i];
    }

    for ($i=0;$i<count($id);$i++)
    {
      //echo $i ." ".$quantity[$i].";".$_SESSION[articlelist][$i][quantity]." ".$_SESSION[articlelist][$i][title]."<br>";
      // loeschen bei menge 0
      if($quantity[$i]<=0 || $del[$i]=="1")
	$this->CartDeleteArticle($i);

    }
    
  }
  


}
?>

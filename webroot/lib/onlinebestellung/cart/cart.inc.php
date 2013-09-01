<?
  //include ("lib/cookie.php");

  function CartShowReadonlySingleFormArticle($ArticleIndex,$title,$quantity,$price,$tax,$taxtype,$orderid) 
  {
    $ret .= "\n\t<tr>";
    $ret .= "\n\t<td>".$title."</td>";
    $ret .= "\n\t<td>".$orderid."</td>";
    $ret .= "\n\t<td>".$quantity."</td>";
    $ret .= "\n\t<td>".$tax." %</td>";
    if($taxtype==$tax)    
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$price)." &euro;</td>";
    else
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$price/(100+$taxtype)*100)." &euro;</td>";

    $totalprice=$quantity*$price;
    if($taxtype==$tax)    
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$totalprice)." &euro;</td>";
    else
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$totalprice/(100+$taxtype)*100)." &euro;</td>";
    $taxarticle=$price-($price/((100+$tax)/100));
    $ret .= "\n\t<td><input type=\"hidden\" name=\"id[]\" value=\"".$ArticleIndex."\">";
    $ret .= "\n\t</tr>";

    return $ret;
    
  }

  function CartShowSingleFormArticle($ArticleIndex,$title,$quantity,$price,$tax,$taxtype,$orderid) 
  {
    $ret .= "\n\t<tr>";
    $ret .= "\n\t<td>".$title."</td>";
    $ret .= "\n\t<td>".$orderid."</td>";
    $ret .= "\n\t<td><input type=\"text\" size=\"1\" style=\"size:20\" name=\"quantity[$ArticleIndex]\" value=\"".$quantity."\"></td>";
    $ret .= "\n\t<td>".$tax." %</td>";

    if($taxtype==$tax)    
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$price)." &euro;</td>";
    else
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$price/(100+$taxtype)*100)." &euro;</td>";

    $totalprice=$quantity*$price;
    if($taxtype==$tax)    
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$totalprice)." &euro;</td>";
    else
      $ret .= "\n\t<td align=\"right\">".sprintf('%01.2f',$totalprice/(100+$taxtype)*100)." &euro;</td>";

    $taxarticle=$price-($price/((100+$tax)/100));
    $ret .= "\n\t<td><input type=\"hidden\" name=\"id[$ArticleIndex]\" value=\"".$ArticleIndex."\">";
    $ret .= "\n\t<input type=\"checkbox\" name=\"del[$ArticleIndex]\" value=\"1\"></td>";
    $ret .= "\n\t</tr>";

    return $ret;
    
  }
  
  function CartTinyShowSingleFormArticle($ArticleIndex,$title,$quantity,$price,$tax) 
  {
    $len = strlen($title);

    $title = substr($title,0,28);

    if($len > strlen($title ))$title = $title." ...";

    $ret .= "\n\t<tr>";
    $ret .= "\n\t<td class=\"minicartarticle\" align=\"right\"><b>".$quantity."&nbsp;x&nbsp;</b></td>";
    $ret .= "\n\t<td class=\"minicartarticle\"><b>".$title."</b></td>";
    $ret .= "\n\t</tr>";

    return $ret;
    
  }  

  function CartGetTotalSumBrutto($CartArr) 
  {
    $summe=0;
    if(count($CartArr)>0)
    {
      foreach($CartArr as $value)
      {
      	if($value[taxtype]==$value[tax])    
	        $totalprice=$value[quantity]*$value[price];
	      else
	        $totalprice=$value[quantity]*$value[price]/(100.00+$value[taxtype])*100.00;

	$summe=$summe+$totalprice;
      }  
    } 
    return $summe;
        
  }
  
   
  function CartGetTotalSumNetto($CartArr) 
  {
    $summe=0;
    if(count($CartArr)>0)
    {
      foreach($CartArr as $value)
      {
	      $summe = $summe + ($value[price]/(100+$value[tax]))*100*$value[quantity];
      }  
    } 
    return $summe;
  }
  

  function CartGetTotalSumTax($CartArr) 
  {
    $summetax=0;
    if(count($CartArr)>0)
    {
      foreach($CartArr as $value)
      {
        //$taxarticle=$value[price]-($value[price]/((100+7$value['taxtype'])/100));
        $taxarticle=$value[price]-($value[price]/((100+7)/100));
	      $taxtotal=$taxarticle*$value[quantity];    
	      $summetax=$summetax+$taxtotal;
      }  
    } 
    return $summetax;
  }
  
   
  function CartShowReadonly ($CartArr) 
  {
    CheckCart();
    $ret .= "<table border=\"0\" cellpadding=\"5\" width=\"100%\">";
    $ret .= "\n\t<tr>";
    $ret .= "\n\t<td><b>Artikel</b></td>";
    $ret .= "\n\t<td><b>Nummer</b></td>";
    $ret .= "\n\t<td><b>Anzahl</b></td>";
    $ret .= "\n\t<td><b>MwSt.</b></td>";
    $ret .= "\n\t<td align=\"right\"><b>Einzelpreis</b></td>";
    $ret .= "\n\t<td align=\"right\"><b>Gesamtpreis</b></td>";
    //$ret .= "<td>Enthaltene MWSt.</td>";
    $ret .= "\n\t</tr>";

    $i=0;
    if(count($CartArr)>0)
    {
      foreach($CartArr as $key=>$value)
      {
	if($value[title])
	{
	  $ret.= CartShowReadonlySingleFormArticle($i,$value[title],$value[quantity],$value[price],$value[tax],$value[taxtype],$value[articleid]);
	  $i=$i+1;
	}
      }
    }
    $ret .= "\n\t<tr><td colspan=\"4\"><strong>Gesamtbetrag (inkl. 19% MwSt.)</strong></td>";
    $ret .= "\n\t<td align=\"right\"><strong>".sprintf('%01.2f',CartGetTotalSumBrutto($CartArr))." 
      &euro;</strong></td><td>&nbsp;</td></tr>";
    $ret .= "\n\t<tr><td colspan=\"3\"></td><td></td>";
    $ret .= "\n\t<td align=\"right\"></td></tr>";
    $ret .= "\n\t</table>";
    $ret .= "\n\t<center><p>Der Gesamtbetrag enth&auml;lt ".sprintf('%01.2f',CartGetTotalSumTax($CartArr))." &euro; 
      gesetzliche MwSt.</p></center>";
    return $ret;
  }



  function CartShow ($CartArr) 
  {
    CheckCart();
    $rand=rand(100,5000);
    $ret .= "<form action=\"./lib/onlinebestellung/cart/cartaction.php?$rand\" method=\"post\"><table border=\"0\" cellpadding=\"10\" width=\"700\">";
    $ret .= "<input type=\"hidden\" name=\"cmd\" value=\"update\">";
    $ret .= "\n\t<tr>";
    $ret .= "\n\t<td><b>Artikel</b></td>";
    $ret .= "\n\t<td><b>Nummer</b></td>";
    $ret .= "\n\t<td><b>Anzahl</b></td>";
    $ret .= "\n\t<td><b>MwSt.</b></td>";
    $ret .= "\n\t<td align=\"right\"><b>Einzelpreis</b></td>";
    $ret .= "\n\t<td align=\"right\"><b>Gesamtpreis</b></td>";
    //$ret .= "<td>Enthaltene MWSt.</td>";
    $ret .= "\n\t<td>L&ouml;schen</td>";
    $ret .= "\n\t</tr>";
    $i=0;
    if(count($CartArr)>0)
    {
      foreach($CartArr as $key => $value)
      {
	if($value[title])
	{
	  $ret.= CartShowSingleFormArticle($i,$value[title],$value[quantity],$value[price],$value[tax],$value[taxtype],$value[articleid]);
	  $i=$i+1;
	}
      }
    }
    $ret .= "\n\t<tr><td colspan=\"4\"><strong>Gesamt</strong></td>";
    $ret .= "\n\t<td align=\"right\"><strong>".sprintf('%01.2f',CartGetTotalSumBrutto($CartArr))."&euro;</strong><br>zzgl. <a href=\"/index.php?module=content&action=show&page=versand\">Versandkosten</a> 
      </td><td>&nbsp;</td></tr>";
    $ret .= "\n\t<tr><td colspan=\"3\"></td><td></td>";
    $ret .= "\n\t<td align=\"right\" nowrap colspan=\"3\"><input type=\"submit\" value=\"Aktualisieren\"><input type=\"button\" onclick=\"window.location.href='index.php?module=bestellen&action=kasse';\" value=\"Zur Kasse\" name=\"kasse\">
      <input type=\"button\" onclick=\"window.location.href='index.php';\" value=\"weiter Einkaufen\" ></td></tr>";
    $ret .= "\n\t</table>";
    $ret .= "\n\t<p>Der Gesamtbetrag enth&auml;lt ".sprintf('%01.2f',CartGetTotalSumTax($CartArr))." &euro; 
      gesetzliche MwSt.</p>";
    $ret .= "\n\t </form>
    ";
    return $ret;
  }
 
  function CartTinyShow($CartArr)
  {

    CheckCart();
    if($_SESSION[update]=="1")
    {
      $n = $_SESSION[update_quantity];
      $update = "<div class=\"warning\">Artikel wurde $n mal in den Warenkorb gelegt!</dvi>";
      $_SESSION[update]="0";
    }
  //  if(CheckCookie()==1)
  //  {
      $ret .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
	    
      $i=0;
      if(count($CartArr)>0)
      {
	foreach($CartArr as $value)
	{
	  if($value[title]) {
	    $ret.= CartTinyShowSingleFormArticle($i,$value[title],$value[quantity],$value[price],$value[tax]);
	    $i=$i+1;
	  }
	}
      } else {
	$ret .= "Es sind noch keine Artikel in Ihrem Warenkorb.";
      }
      $ret .= "</table>";
      $ret .= "<table width=100%><tr><td align=right><br><a href=\"index.php?module=bestellen&action=warenkorb\">Warenkorb bearbeiten</a></td></tr></table><br><hr width=\"100%\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
      $ret .= "\n\t<tr><td align=\"right\" class=\"minicartsum\">";
      $ret .= "<a href=\"index.php?module=bestellen&action=warenkorb\">";
      $ret .= "Gesamt</a>: ";
      $ret .= sprintf('%01.2f',CartGetTotalSumBrutto($CartArr));
      $ret .= "&nbsp;&euro;<br>zzgl. <a href=\"/index.php?module=content&action=show&page=versand\">Versandkosten</a>$update";
      $ret .= "</td></tr>";
      $ret .= "\n\t</table><hr width=\"100%\">";
  /*
    }	    
    else
    {
      $ret = "Ab diesem Punkt müssen Cookies aktiviert sein.";
    }
    */
      return $ret;
  }

  function CheckCart()
  {
/*
    for($i=0; $i < count($_SESSION[articlelist]); $i++)
    {
       if($_SESSION[articlelist][$i]['quantity']==0 || $_SESSION[articlelist][$i]['title']=="")
	{
    unset($_SESSION[articlelist][$i]);
    $_SESSION[articlelist]=array_values($_SESSION[articlelist]);

	}
    }


*/

  }
  

?>

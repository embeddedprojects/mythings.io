<?
  
  
  function CustomerShowValue($key, $CustomerArr) 
  {
    foreach($CustomerArr as $index=>$value)
    {
      if($key==$index)
	return $value;
    } 
    return "";
  }
 
?>

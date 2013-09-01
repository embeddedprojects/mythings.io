<?

/// Interface for communication with a MySQL Database
class DB{

  function DB($dbhost,$dbname,$dbuser,$dbpass)
  {
    mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    //mysql_query("SET NAMES 'utf8'");
    //mysql_query("SET CHARACTER SET 'utf8'");
  }
	
  function free(){
    // Speicher freimachen
    mysql_free_result($this->_result);
  }

  function Select($sql){
    if(mysql_query($sql)){
      $this->results = mysql_query($sql);
      $count = 0;
      $data = array();
      while( $row = mysql_fetch_array($this->results)){
	$data[$count] = $row;
	$count++;
      }
      mysql_free_result($this->results);
    }
    if(count($data) == 1)  $data = $data[0][0];
    if(count($data) < 1) $data="";
    return $data;
  }
 
  function SelectArr($sql){
    //if(mysql_query($sql)){
    if(1){
      $this->results = mysql_query($sql);
      $count = 0;
      $data = array();
      while( $row = mysql_fetch_array($this->results)){
	unset($ArrData); 
	// erstelle datensatz array
	foreach($row as $key=>$value){
	  if(!is_numeric($key))$ArrData[$key]=$value;
	}
	$data[$count] = $ArrData;
        $count++;
      }
      mysql_free_result($this->results);
    }
    return $data;
  }
	
  function Result($sql){ return mysql_result(mysql_query($sql), 0);}

  function GetInsertID(){ return mysql_insert_id();}

  function GetArray($sql){
    $i=0;
    $result = mysql_query($sql);
    while($row = mysql_fetch_assoc($result)) {
      foreach ($row as $key=>$value){
	$tmp[$i][$key]=$value;
      }
      $i++;
    }
    return $tmp;
  }


  function Insert($sql){ return mysql_query($sql); }
  function Update($sql){ return mysql_query($sql); }
  function Delete($sql){ return mysql_query($sql); }

  function Count($sql){
    if(mysql_query($sql)){	
      return mysql_num_rows(mysql_query($sql));
    }
    else {return 0;}
  }

  function CheckTableExistence($table){
    $result = mysql_query("SELECT * FROM $table");
    if (!$result) {
      return false;
      } else { return true; }
  }

 
  function CheckColExistence($table,$col)
  {
    if($this->CheckTableExistence($table)){
      $result = mysql_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	  if($row[Field]==$col)
	    return true;
	}
      }
    }
    return false;
  }



  function GetColArray($table)
  {
    if($this->CheckTableExistence($table)){
      $result = mysql_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	  $ret[]=$row[Field];
	}
	return $ret;
      }
    }
  }


  function GetColAssocArray($table)
  {
    if($this->CheckTableExistence($table)){
      $result = mysql_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	  $ret[$row[Field]]="";
	}
	return $ret;
      }
    }
  }

  function UpdateArr($tablename,$pk,$pkname,$ArrCols)
  {

    if(count($ArrCols)>0){
      foreach($ArrCols as $key=>$value){
	if($key!=$pkname)$this->Query("UPDATE `$tablename` SET `$key`='$value' 
	  WHERE `$pkname`='$pk' LIMIT 1");
      }
    }
  }

  function InsertArr($tablename,$pkname,$ArrCols)
  {
    // save primary than update
    $this->Query("INSERT INTO `$tablename` (id) VALUES ('')");
    
    $pk = $this->GetInsertID();
    $this->UpdateArr($tablename,$pk,$pkname,$ArrCols);
  }

  /// get table content with specified cols 
  function SelectTable($tablename,$cols){
   
    $firstcol = true;
    if(count($cols)==0)
      $selection = '*';
    else 
    {
      foreach($cols as $value)
      {
	if(!$firstcol)
	$selection .= ','; 
	
	$selection .= $value;

	$firstcol=false;
      }
    }
 
    $sql = "SELECT $selection FROM $tablename";
    return $this->SelectArr($sql);
  }
	


  function Query($query){
    return mysql_query($query);
  }

}




















?>

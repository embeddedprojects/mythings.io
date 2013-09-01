<?

/*
* IMAP include file, contains all email importing functions
* STILL EXPERIMENTAL - USE WITH CARE! you've been warned :)
*/

class IMAP {


  function IMAP()
  {
    // supported protocols
    $this->IMAP_IMAP	  = 1;
    $this->IMAP_POP3	  = 2;
    $this->IMAP_IMAP_SSL  = 3;
    $this->IMAP_POP3_SSL  = 4;
  }

  /* decode mime format strings */
  function imap_decode($text)
  {
    $elements=imap_mime_header_decode($text);
    for($i=0;$i<count($elements);$i++) 
      return htmlspecialchars($elements[$i]->text);
  }

  /* get mime type */
  function imap_get_mime_type(&$structure)
  {
    $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
    if($structure->subtype)
      return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;

    return "TEXT/PLAIN";
  }

  /* get part of body by mime type */
  function imap_get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
  {
    if(!$structure)
      $structure = @imap_fetchstructure($stream, $msg_number);
	
    if($structure)
    {
      if($mime_type == $this->imap_get_mime_type($structure))
      { 
	if(!$part_number)
	  $part_number = "1";
			
	$text = imap_fetchbody($stream, $msg_number, $part_number);
		
	if($structure->encoding == 3)
	  return imap_base64($text);
	else if($structure->encoding == 4)
	  return imap_qprint($text);
	else
	  return $text;
      }
	
      if($structure->type == 1) /* multipart */
      {
	while(list($index, $sub_structure) = each($structure->parts))
	{
	  if($part_number)
	    $prefix = $part_number . '.';

	  $data = $this->imap_get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
	  if($data)
	    return $data;
	}
      }
    }
    return false;
  }

  /* connect to server and fetch an $mailbox object */
  function imap_connect($server,$port,$folder,$username,$password,$type)
  {
    //determine protocol type and fix the server connect string
    switch($type)
    {
      case $this->IMAP_IMAP: 	 $server_path = '{'.$server.':'.$port.'}'.$folder; 		break;
      case $this->IMAP_POP3: 	 $server_path = '{'.$server.':'.$port.'/pop3}'.$folder; 	break;
      case $this->IMAP_IMAP_SSL: $server_path = '{'.$server.':'.$port.'/imap/ssl/novalidate-cert}'.$folder; 	break;
      case $this->IMAP_POP3_SSL: $server_path = '{'.$server.':'.$port.'/pop3/ssl}'.$folder; 	break;
      default: 	$server_path = '{'.$server.':'.$port.'}'.$folder; 			break;
    }
    return imap_open($server_path, $username, $password);
  }

  /* return number of messages in current mailbox */
  function imap_message_count($mailbox)
  {
    if ($header = imap_check($mailbox)) 
      return $header->Nmsgs;
    else
      return 0;
  }

  /* close server connection gracefully */
  function imap_disconnect($mailbox)
  {
    return imap_close($mailbox);
  }

  function encodeToUtf8($string) {
     return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
  }
  /* import IMAP messages from mailbox */
  function imap_import($mailbox,$delete_msg=0,$daysold=0,$emailbackup_id=0)
  {
    global $db;
    $num_messages = $this->imap_message_count($mailbox);
	
      for($i=1; $num_messages >= $i; $i++)
      {
	$msg			= imap_header($mailbox,$i);
	$subject 		= $this->encodeToUtf8(mysql_escape_string($this->imap_decode($msg->subject)));
	$from 			= $this->encodeToUtf8($this->imap_decode($msg->fromaddress));
	$action			= $this->encodeToUtf8(mysql_escape_string($this->imap_get_part($mailbox, $i, "TEXT/PLAIN")));
	$action_html		= $this->encodeToUtf8(mysql_escape_string($this->imap_get_part($mailbox, $i, "TEXT/HTML")));
	//$action		= get_part($mbox, $i, "TEXT/HTML");


	//pruefe ob email in datenbank bereits enthalten ist
	$timestamp =  strtotime($msg->MailDate);
	$frommd5		= md5($from.$subject.$timestamp);
	$empfang = date('Y-m-d H:i:s',$timestamp);
	$sql = "SELECT COUNT(id) FROM emailbackup_mails WHERE 
	  checksum='$frommd5' AND empfang='$empfang'";

	if($db->Select($sql)==0)
	{
	  echo "insert $i md5 hash ".$frommd5."\r\n";
	  //pruefe ob anhaene vorhanden sind
	  $attachments = $this->extract_attachments($mailbox,$i);
	  $anhang=0;
	  for($j=0;$j<count($attachments);$j++)
	  {
	    if($attachments[$j]['is_attachment']==1)
	    {
	      $anhang = 1; break;
	    }
	  }


	  //fuege gegenenfalls ein
	  $sql = "INSERT INTO emailbackup_mails (id,emailbackup,subject,sender,action,action_html,empfang,anhang,checksum) 
	    VALUES ('',$emailbackup_id,'$subject','$from','$action','$action_html','$empfang','$anhang','$frommd5')";
	  $db->InsertWithoutLog($sql);

	  //speichere anhang als datei 
	  $id = $db->GetInsertID();

	  if($anhang==1)
	  {
	    mkdir("../../userdata/emailbackup/$id");
	    for($j=0;$j<count($attachments);$j++)
	    {
	      if($attachments[$j]['is_attachment']==1 && $attachments[$j]['filename']!="")
	      {
		$handle = fopen ("../../userdata/emailbackup/$id/".$attachments[$j]['filename'], "wb");
		fwrite($handle, $attachments[$j]['attachment']);
		fclose($handle);
	      }
	    }
	  }
	}	
	//wenn oldday !=0 pruefe ob email geloescht werden soll
	if((time() - $timestamp) > $daysold*60*60*24)
	{
	    echo "delete $i $from $empfang\r\n";
	    imap_delete($mailbox,$i);
	} else {
	    //echo "not delete $i $from $empfang\r\n";
	}


	/*
	echo "<br>";
	echo date('r');
	echo "<br>";
	$timestamp =  strtotime('Sun, 20 Jul 2008 23:34:07 +0200'); 
	$datum = date("d.m.Y - H:i", $timestamp);
	echo $datum;
	*/

	/*Mon, 29 Jun 2009 23:48:57 -0700
	2009-08-14 20:20:24
*/
	//insert ticket
	//**print "from '$from', subject: '".substr($subject,0,50)."', body contains <B>".strlen($action)."</B> characters<br>";


/*Array
(
[0] => Array
(
[is_attachment] => 
[filename] => 
[name] => 
[attachment] => 
)

[1] => Array
(
[is_attachment] => 1
[filename] => 20090622BDR_EAC-BOX_RP001_V100_C.pdf
[name] => 20090622BDR_EAC-BOX_RP001_V100_C.pdf
[attachment] => 'inhalt der datei'
*/

/*
add_ticket($subject,$from,'','NOW()','NOW()',$GLOBALS[STATUS_OPEN],$GLOBALS[SEVERITY_NORMAL],$_SESSION[user_id]);
//$query = "INSERT INTO $GLOBALS[mysql_prefix]ticket (affected,scope,owner,description,problemstart,problemend,status,date,severity) VALUES('$from','',$_SESSION[user_id],'$subject','2002-03-05 18:30:00','2002-03-05 18:30:00',$GLOBALS[STATUS_OPEN],NOW(),$GLOBALS[SEVERITY_NORMAL])";
//mysql_query($query) or do_error("imap_import($delete_msg)::mysql_query()", 'mysql query failed', mysql_error());

//insert action (i.e. the body of the message)
//$action 	= strip_html($action); //fix formatting, custom tags etc.
$ticket_id 	= mysql_insert_id();
		
if ($action) //is $action empty?
{
$query 		= "INSERT INTO $GLOBALS[mysql_prefix]action (description,ticket_id,date,user,action_type) VALUES('$action','$ticket_id',NOW(),$_SESSION[user_id],$GLOBALS[ACTION_COMMENT])";
mysql_query($query) or do_error("imap_import($delete_msg)::mysql_query()", 'mysql query failed', mysql_error());
}
		
if ($action_html)
{
$query 		= "INSERT INTO $GLOBALS[mysql_prefix]action (description,ticket_id,date,user,action_type) VALUES('$action_html','$ticket_id',NOW(),$_SESSION[user_id],$GLOBALS[ACTION_COMMENT])";
mysql_query($query) or do_error("imap_import($delete_msg)::mysql_query()", 'mysql query failed', mysql_error());
}	
		
if ($delete_msg) imap_delete($mailbox,$i);
}
*/	
	
    //get rid of deleted messages if deletetion is on
    // if ($delete_msg) imap_expunge($mailbox);
    }
    print "fetched and inserted $num_messages emails into database\r\n";
  }
  
  function extract_attachments($connection, $message_number) {
   
    $attachments = array();
    $structure = imap_fetchstructure($connection, $message_number);
   
    if(isset($structure->parts) && count($structure->parts)) {
   
        for($i = 0; $i < count($structure->parts); $i++) {
   
            $attachments[$i] = array(
                'is_attachment' => false,
                'filename' => '',
                'name' => '',
                'attachment' => ''
            );
           
            if($structure->parts[$i]->ifdparameters) {
                foreach($structure->parts[$i]->dparameters as $object) {
                    if(strtolower($object->attribute) == 'filename') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['filename'] = $object->value;
                    }
                }
            }
           
            if($structure->parts[$i]->ifparameters) {
                foreach($structure->parts[$i]->parameters as $object) {
                    if(strtolower($object->attribute) == 'name') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                    }
                }
            }
           
            if($attachments[$i]['is_attachment']) {
                $attachments[$i]['attachment'] = imap_fetchbody($connection, $message_number, $i+1);
                if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                }
                elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachments[$i]['attachment'] = 
quoted_printable_decode($attachments[$i]['attachment']);
                }
            }
           
        }
       
    }
   
    return $attachments;
  }

}
?>

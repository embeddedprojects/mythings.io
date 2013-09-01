<?php

class Stock 
{
  function Stock(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","StockList");
    $this->app->ActionHandler("data","StockData");
    $this->app->ActionHandler("archive","StockArchive");
    $this->app->ActionHandler("edit","StockEdit");
    $this->app->ActionHandler("delete","StockDelete");
    $this->app->ActionHandler("image","StockImage");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function StockArchive()
  {


    $this->app->Tpl->Parse(PAGE,"stock_archive.tpl");
  }


  function StockSelect($id)
 {
    return "<select onchange=\"window.location.href='index.php?module=stock&action=edit&id=$id&plugin=' + this.options[this.selectedIndex].value;\">
	<option value=\"\">choose action</option>
	<option value=\"showinfo\">show info</option>
	<option value=\"editdescription\">edit description</option>
	<option value=\"movetolist\">move to list</option>
	<option value=\"delete\">delete</option>
	<option value=\"dateofpurchase\">date of purchase</option>
	<option value=\"borrowafriend\">borrow a friend or get it back</option>
	<option value=\"addnotice\">add notice</option>
	<option value=\"addtag\">add tag</option>
	<option value=\"setautoreminder\">set autoreminder</option>
	<option value=\"addattachment\">add attachment</option>
	<option value=\"addlink\">add link</option>
	<option value=\"defineplace\">define place</option>
	<!--<option value=\"markasempty\">mark as empty</option>
	<option value=\"archiveonly\">archive only</option>
	<option value=\"sellatebay\">sell at ebay</option>
	<option value=\"sellatamazon\">sell at amazon</option>
	<option value=\"shareonfacebook\">share on facebook</option>
	<option value=\"shareontwitter\">share on twitter</option>-->

	</select>";

}

  function StockEdit()
  {
	$id = $this->app->Secure->GetGET("id");
	$plugin = $this->app->Secure->GetGET("plugin");
	$this->app->Tpl->Set(PLUGIN,$plugin);

	$this->app->erp->ParseThing($id);


	$this->app->Tpl->Set(ID,$id);

	switch($plugin)
	{
		case "showinfo":
			$this->app->erp->ParseThing($id);
			$this->app->Tpl->Set(SELECT,$this->StockSelect($id));
			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_info.tpl"); 
		break;

		case "editdescription":
			$description = $this->app->Secure->GetPOST("description");
			$share = $this->app->Secure->GetPOST("share");
			if($description!="") {
				$this->app->DB->Update("UPDATE scans SET description='$description',share='$share' WHERE id='$id' AND userid=".$this->app->User->GetID());
				//header("Location: index.php?module=stock&action=list");
				header("Location: ".$_SESSION['lastback']);
				exit;
			}

			$this->app->erp->ParseThing($id);
			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_editdescription.tpl"); 
		break;

		case "dateofpurchase":
			$dateofpurchase = $this->app->Secure->GetPOST("dateofpurchase");
			$submit = $this->app->Secure->GetPOST("submit");
			if($submit!="") {
				$this->app->DB->Update("UPDATE scans SET dateofpurchase='$dateofpurchase' WHERE id='$id' AND userid='".$this->app->User->GetID()."'");
				header("Location: ".$_SESSION['lastback']);
				exit;
			} else {
				$date = $this->app->DB->Select("SELECT dateofpurchase FROM scans WHERE userid='".$this->app->User->GetID()."' AND id='$id' LIMIT 1");
				if($date=="0000-00-00")$date="";
				$this->app->Tpl->Set(DATEOFPURCHASE,$date);
			}

			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_dateofpurchase.tpl"); 
		break;
		case "borrowafriend":
			$borrowafriendname = $this->app->Secure->GetPOST("borrowafriendname");
			$borrowafrienddate = $this->app->Secure->GetPOST("borrowafrienddate");
			$back = $this->app->Secure->GetGET("back");

			if($back=="true")
			{
				$borrowafriendname = $this->app->DB->Select("SELECT borrowafriendname FROM scans WHERE userid='".$this->app->User->GetID()."' AND id='$id' LIMIT 1");
				$this->app->DB->Update("UPDATE scans SET borrowafriendname='',borrowafrienddate='' WHERE id='$id' AND userid='".$this->app->User->GetID()."'");
				//TODO history
				$this->app->DB->Insert("INSERT INTO history (id,scanid,userid,logfile,logtime) 
					VALUES ('','$id','".$this->app->User->GetID()."','Get back from friend: $borrowafriendname',NOW())");
				header("Location: ".$_SESSION['lastback']);
				exit;
			}

			if($borrowafriendname!=""||$borrowafrienddate!="") {
				//TODO history
				$this->app->DB->Insert("INSERT INTO history (id,scanid,userid,logfile,logtime) 
					VALUES ('','$id','".$this->app->User->GetID()."','Borrow a friend: $borrowafriendname (Start: $borrowafrienddate)',NOW())");
				$this->app->DB->Update("UPDATE scans SET borrowafriendname='$borrowafriendname',borrowafrienddate='$borrowafrienddate' WHERE id='$id' AND userid='".$this->app->User->GetID()."'");
				header("Location: ".$_SESSION['lastback']);
				exit;
			} else {
				$date =$this->app->DB->Select("SELECT borrowafrienddate FROM scans WHERE userid='".$this->app->User->GetID()."' AND id='$id' LIMIT 1");
				if($date=="0000-00-00")$date="";
				$this->app->Tpl->Set(BORROWAFRIENDDATE,$date);
				$this->app->Tpl->Set(BORROWAFRIENDNAME,$this->app->DB->Select("SELECT borrowafriendname FROM scans WHERE userid='".$this->app->User->GetID()."' AND id='$id' LIMIT 1"));
			}

			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_borrowafriend.tpl"); 
		break;



		case "delete":
			$delete = $this->app->Secure->GetGET("delete");

			if($delete=="true")
			{
				$this->app->DB->Delete("DELETE FROM scans  WHERE id='$id' AND userid=".$this->app->User->GetID());
				header("Location: index.php?module=stock&action=list");
				exit;
			}
			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_delete.tpl"); 
		break;
		case "movetolist":
			$newlist  = $this->app->Secure->GetPOST("newlist");
			if($newlist!="")
			{
				$this->app->DB->Update("UPDATE scans SET listid='$newlist' WHERE id='$id' AND userid=".$this->app->User->GetID());
				header("Location: index.php?module=stock&action=list&list=$newlist");
				exit;
			}

		        $oldlist = $this->app->DB->Select("SELECT listid FROM scans WHERE userid='".$this->app->User->GetID()."' AND id='$id' LIMIT 1");
			if($oldlist<=0)
				$this->app->Tpl->Set(OLDLIST,"Incoming scanner queue");
			else
		        	$this->app->Tpl->Set(OLDLIST,$this->app->DB->Select("SELECT name FROM lists WHERE userid='".$this->app->User->GetID()."' AND id='$oldlist' LIMIT 1"));

			$this->app->Tpl->Set(LISTS,$this->app->erp->SelectLists());
			$this->app->Tpl->Parse(PLUGINFORM,"stock_edit_movetolist.tpl"); 
		break;

	}


    	$list = $this->app->DB->Select("SELECT lastlist FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        $this->app->Tpl->Set(STOCKEDITBACK,"index.php?module=stock&action=list&list=$list");
        $this->app->erp->ParseBack();
    	$this->app->Tpl->Parse(PAGE,"stock_edit.tpl");

  }

  function StockData()
  {
    $list = $this->app->erp->GetChoosenList();
    if($_SESSION['start'] > 0)
	exit;

	$date_post = $this->app->Secure->GetPOST("date");
	if($date_post!=""){
        $sql = "SELECT id,barcode,description,date FROM scans WHERE date > '".$date_post."' AND userid=".$this->app->User->GetID()." AND listid='$list' ORDER by date DESC LIMIT 0, 10";
        $resource = mysql_query($sql);
        $current_time = $date_post;
        $item = mysql_fetch_assoc($resource);
        $last_news_time = $item['date'];
	$i=0;
        while ($last_news_time < $current_time) {
		$i++;
		if($i>10)exit;
                usleep(1000); //giving some rest to CPU
                $resource = mysql_query($sql);
                $item = mysql_fetch_assoc($resource);
                $last_news_time = $item['date'];
       }
	}

	if($item['date']=="") exit;

        echo "<li id=\"".$item['date']."\"><table style='border:0px solid black'><tr valign=\"top\"><td>
<a href=\"index.php?module=stock&action=edit&id=".$item['id']."&plugin=showinfo\"><img src=\"index.php?module=stock&action=image&id=".$item['id']."\" width=\"100\" align=\"left\"></a>
</td>
<td width=\"300\"><a href=\"index.php?module=stock&action=edit&id=".$item['id']."&plugin=showinfo\"><b>NEW: ".$item['description']."</b></a><br><i>".$item['date']."</i></td>
<td>".$this->StockSelect($item['id'])."</td>

</tr></table></li>";
exit;

  }

  function StockList()
  {
    $limit = 7;

    $search = $this->app->Secure->GetPOST("search");
    $this->app->Tpl->Set(SEARCH,$search);

    $this->app->erp->ParseBack();

    $list = $this->app->erp->GetChoosenList();

    $this->app->DB->Update("UPDATE user SET lastlist='$list' WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    


    if($list <= 0)
	$this->app->Tpl->Set(CHOOSENLIST,"Incoming scanner queue");  
    else
	$this->app->Tpl->Set(CHOOSENLIST,$this->app->DB->Select("SELECT name FROM lists WHERE id='$list' AND userid='".$this->app->User->GetID()."' LIMIT 1"));

    $count_number_ofthings = $this->app->DB->Select("SELECT COUNT(id) FROM scans WHERE listid='$list' AND userid='".$this->app->User->GetID()."' ");
    if($count_number_ofthings == 1)
	$this->app->Tpl->Add(CHOOSENLIST," ($count_number_ofthings thing)");
    else if($count_number_ofthings > 0)
	$this->app->Tpl->Add(CHOOSENLIST," ($count_number_ofthings things)");
    else
	$this->app->Tpl->Add(CHOOSENLIST," (not things in this list)");

    $this->app->Tpl->Parse(MENUBAR,"menubar.tpl");

    $start = $this->app->Secure->GetGET("start");
    if($start=="") $start = $_SESSION['start'];


    if(!is_numeric($start))
	$start = 0;

    $_SESSION['start'] = $start;

    // page no 
    $pagenumber = round(($start + $limit)/$limit);
    $this->app->Tpl->Set(PAGENUMBER,$pagenumber);

    $pagemax = $this->app->DB->Select("SELECT COUNT(id) 
        FROM scans WHERE  
        userid=".$this->app->User->GetID());


    $pagemax = ceil($pagemax/$limit);
    $this->app->Tpl->Set(PAGEMAX,$pagemax);
    $this->app->Tpl->Set(STARTOLDER,$start + $limit);

   
    //Newer
    if($start >= ($start - $limit) && ($start - $limit) >= 0)
    {
    	$this->app->Tpl->Set(STARTNEWER,$start - $limit);
	$this->app->Tpl->Set(NEWERLINK,"index.php?module=stock&action=list&start=[STARTNEWER]");
    }
    else {
    	$this->app->Tpl->Set(NEWERLINK,"#");
    	$this->app->Tpl->Set(STARTNEWER,0);
    	$this->app->Tpl->Set(NEWERDISABLED,"disabled");
    }
    // older 
    if($pagenumber == $pagemax)
    {
    	$this->app->Tpl->Set(OLDERDISABLED,"disabled");
    	$this->app->Tpl->Set(OLDERLINK,"#");
    } else {
	$this->app->Tpl->Set(OLDERLINK,
		"index.php?module=stock&action=list&start=[STARTOLDER]");
    }

    $scans = $this->app->DB->SelectArr("SELECT id,barcode,description,
	DATE_FORMAT(date,'%d.%m.%Y<br>%H:%i:%s') as date 
	FROM scans WHERE userid=".$this->app->User->GetID()." AND listid='$list' AND description LIKE '%$search%'
	ORDER by date DESC");

	$sql = "SELECT id,barcode,description,date 
		FROM scans WHERE userid=".$this->app->User->GetID()." AND listid='$list' AND description LIKE '%$search%'
		ORDER by date DESC LIMIT $start, $limit";

	$last_time = $this->app->Secure->GetPOST('last_time');
	if($this->app->Secure->GetPOST("last_time")!=""){
		$sql = "SELECT id,barcode,description, date FROM scans 
			WHERE date < '".$last_time."' 
			AND userid=".$this->app->User->GetID()."  AND listid='$list' AND description LIKE '%$search%'
			ORDER by date DESC LIMIT $start, $limit";
	}
	$news = $this->app->DB->SelectArr($sql);

	for($i=0;$i<count($news);$i++)
	{
		$this->app->Tpl->Add(NEWSITEM,
			"<li id=\"".$news[$i]['date']."\" >".
        		"<table style='border:0px solid black'><tr valign=\"top\"><td>".
			"<a href=\"index.php?module=stock&action=edit&id=".$news[$i]['id']."&plugin=showinfo\"><img src=\"index.php?module=stock&action=image&id=".$news[$i]['id']."\" align=\"left\" width=\"100\"></a>".
			"</td>".
			"<td width=\"300\"><a href=\"index.php?module=stock&action=edit&id=".$news[$i]['id']."&plugin=showinfo\">".$news[$i]['description']."</a>".
			"<br><i>".$news[$i]['date']."</i></td>".
			"<td>".$this->StockSelect($news[$i]['id'])."</td>".
			"</tr></table>".
			"</li>");
	}

    $this->app->Tpl->Parse(PAGE,"stock_list_de.tpl");
  }


  function StockImage()
  {
    $id = $this->app->Secure->GetGET("id");
    $scans = $this->app->DB->SelectArr("SELECT image,barcode,
	DATE_FORMAT(date,'%Y%m%d%h%m') as date 
	FROM scans WHERE id='$id' AND 
	userid=".$this->app->User->GetID()." LIMIT 1");
    $rawfile = base64_decode(str_replace(array(',', '-'), 
	array('+', '/'), $scans[0]['image']));
    header("Content-Type: image/jpeg");
    header("Content-Length: " .strlen($rawfile));
    header('Content-Disposition: attachment; filename="'.$scans[0]['date'].'_'.$scans[0]['barcode'].'.jpg"');
    echo $rawfile;
    exit;
  }
  
  function StockDelete()
  {
    $id = $this->app->Secure->GetGET("id");
  
    $submit = $this->app->Secure->GetPOST("submit");

    if($submit!="") {
       header("Location: index.php?module=stock&action=list");
       exit;
    }

    $this->app->Tpl->Parse(PAGE,"stock_delete_en.tpl"); 
  }

}

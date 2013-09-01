<?php

class Image 
{
  function Image(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ImageList");
    $this->app->ActionHandler("edit","ImageEdit");
    $this->app->ActionHandler("delete","ImageDelete");
    $this->app->ActionHandler("show","ImageShow");
    $this->app->ActionHandler("thumbnail","ImageThumbnail");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function ImageList()
  {
    $submit = $this->app->Secure->GetPOST("submit");
    $text = $this->app->Secure->GetPOST("text");
    $image = $this->app->Secure->GetPOST("image");
    $image_complete = $this->app->Secure->GetPOST("imagecomplete");
    $thumbnail = $this->app->Secure->GetPOST("thumbnail");
    $thumbnail_complete = $this->app->Secure->GetPOST("thumbnailcomplete");

    $page = $this->app->Secure->GetGET("page");

    $db_maxFileSize = 16777216;// 16 MB


    if($submit!="")
    {
      // Image pruefen
      if($image_complete==1 && $_FILES[image][size]>0)
      { 
	$image_error = $this->app->erp->checkImage($_FILES[image], $db_maxFileSize);
	if($image_error=="")
	  $image_data = $this->app->erp->uploadImageIntoDB($_FILES[image]);
	else
	  $error .= "Bild: ".$image_error."<br>";
      }else
	$error .= "Geben Sie bitte eine Bild-Datei zum Hochladen an.<br>";
      

      // Thumbnail pruefen
      if($thumbnail_complete==1 && $_FILES[thumbnail][size]>0)
      {
        $thumbnail_error = $this->app->erp->checkImage($_FILES[thumbnail], $db_maxFileSize);
        if($thumbnail_error=="")
          $thumbnail_data = $this->app->erp->uploadImageIntoDB($_FILES[thumbnail]);
	else
	  $error .= "Thumbnail: ".$thumbnail_error."<br>";
      }

      // In Datenbank schreiben
      if($error=="")
      {
	$userid = $this->app->User->GetAdresse();
	$this->app->DB->Insert("INSERT INTO images (adresse, filename, thumbnailname, text, image, imagetype, thumbnail, thumbnailtype, datum, thumbnaildatum)
				VALUES ('$userid', '{$_FILES[image][name]}', '{$_FILES[thumbnail][name]}','$text', '{$image_data[bild]}', '{$image_data[typ]}',
					'{$thumbnail_data[bild]}', '{$thumbnail_data[typ]}', NOW(), NOW())");

	$this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Bild wurde erfolgreich hochgeladen.</div>");
      }else
	$this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");
    }

    if($page=="") $page=1;

    // Zeichne Tabelle
    $this->renderTable($page);

    // Zeichne Index
    $this->renderIndex($page);

    $this->app->Tpl->Parse(INHALT,"image.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ImageEdit()
  {
    $id = $this->app->Secure->GetGET("id");
    $userid = $this->app->User->GetAdresse();
    $page = $this->app->Secure->GetGET("page");

    $submit = $this->app->Secure->GetPOST("submit");
    $cancel = $this->app->Secure->GetPOST("cancel");
    $text = $this->app->Secure->GetPOST("text");
    $image = $this->app->Secure->GetPOST("image");
    $image_complete = $this->app->Secure->GetPOST("imagecomplete");
    $editimage = $this->app->Secure->GetPOST("editimage");
    $thumbnail = $this->app->Secure->GetPOST("thumbnail");
    $thumbnail_complete = $this->app->Secure->GetPOST("thumbnailcomplete");
    $editthumbnail = $this->app->Secure->GetPOST("editthumbnail");

    if($id!="")
    {
      $data = $this->app->DB->SelectArr("SELECT filename, thumbnailname, text, datum, thumbnaildatum 
					 FROM images
					 WHERE id='$id'
					 AND adresse='$userid'");
      if(empty($data) || $cancel!="")
      {
	header("Location: ./index.php?module=image&action=list");
	exit;
      }	
      
      $this->app->Tpl->Set(IMAGE, $data[0][filename]);      
      $this->app->Tpl->Set(THUMBNAIL, $data[0][thumbnailname]);      
      $this->app->Tpl->Set(TEXT, $data[0][text]);      
      $this->app->Tpl->Set(DATUM, $this->app->erp->ConvertDateTime($data[0][datum]));      
      $this->app->Tpl->Set(THUMBNAILDATUM, $this->app->erp->ConvertDateTime($data[0][thumbnaildatum]));      


      if($submit!="")
      {
	$error = "";
	$redirect=0;
	
	if($editimage=="1")
	{
	  if($image_complete==1 && $_FILES[image][size]>0)
	  { 
	    $image_error = $this->app->erp->checkImage($_FILES[image], $db_maxFileSize);
	    if($image_error=="")
	    {
	      $image_data = $this->app->erp->uploadImageIntoDB($_FILES[image]);
	      $this->app->DB->Update("UPDATE images 
				      SET filename='{$_FILES[image][name]}', image='{$image_data[bild]}', imagetype='{$image_data[typ]}',
					  text='$text', datum=NOW()
				      WHERE id='$id' AND adresse='$userid'");
	      $redirect=1;
	    }
	    else
	      $error .= "Bild: $image_error <br>";
	  }else
	    $error .= "Geben Sie bitte eine Bild-Datei zum Hochladen an.<br>";
	}

	if($editthumbnail=="1" && $thumbnail_complete)
	{
	  if($thumbnail_complete==1 && $_FILES[thumbnail][size]>0)
	  {
	    $thumbnail_error = $this->app->erp->checkImage($_FILES[thumbnail], $db_maxFileSize);
	    if($thumbnail_error=="")
	    {
	      $thumbnail_data = $this->app->erp->uploadImageIntoDB($_FILES[thumbnail]);
	      $this->app->DB->Update("UPDATE images 
				      SET thumbnailname='{$_FILES[thumbnail][name]}', thumbnail='{$thumbnail_data[bild]}', thumbnailtype='{$thumbnail_data[typ]}',
					  text='$text', thumbnaildatum=NOW()
				      WHERE id='$id' AND adresse='$userid'");
	      $redirect=1;
	    }
	    else
	      $error .= "Thumbnail: $thumbnail_error <br>";
	  }else
	    $error .= "Geben Sie bitte ein Thumbnail zum Hochladen an.<br>";
	}
  
	if($editimage!="1" && $editthumbnail!="1") $error = "Sie m&uuml;ssen ein Bild oder ein Thumbnail ausw&auml;hlen.<br>";
 
	if($error=="" && $redirect==1)
	{	
	  header("Location: ./index.php?module=image&action=list&page=$page");
	  exit;
	}else
	  $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");
      }
     

    }

    if($page=="") $page=1;

    // Zeichne Tabelle
    $this->renderTable($page);

    // Zeichne Index
    $this->renderIndex($page);


    $this->app->Tpl->Parse(INHALT,"image_edit.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");

  }


  function ImageDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $userid = $this->app->User->GetAdresse();
    if($id!="" && is_numeric($userid))
    {
      //$this->app->DB->Delete("DELETE FROM `images` WHERE id='$id' AND adresse='$userid' LIMIT 1");
      $this->app->DB->Delete("DELETE FROM `images` WHERE id='$id' LIMIT 1");
      header("Location: ./index.php?module=image&action=list");
      exit;
    }
  }


  function renderTable($page=1)
  {
    $userid = $this->app->User->GetAdresse();
    
    if(is_numeric($userid))
    {
      //$images = $this->app->DB->SelectArr("SELECT id,filename,text,datum,imagetype,thumbnailtype FROM images WHERE adresse='$userid' ORDER BY datum");
      $images = $this->app->DB->SelectArr("SELECT id,filename,text,datum,imagetype,thumbnailtype FROM images ORDER BY datum");

      if(count($images)>0)
      {
	$firstEntry = ($page-1) * 10;
	$lastEntry = count($images); //$page * 10;
	
	for($i=$firstEntry;$i<$lastEntry ;$i++)
	{
	  if(is_numeric($images[$i][id]))
	  {
	    $thumbnail="";
	    if($images[$i][thumbnailtype]!="")
	      $thumbnail = "&nbsp;|&nbsp;<a href=\"./index.php?module=image&action=thumbnail&id={$images[$i][id]}\">Thumbnail</a>";

	    $table .= "<tr>
			<td width=\"100\">
			  <a href=\"./index.php?module=image&action=show&id={$images[$i][id]}&".$this->app->erp->getImageExtension($images[$i][imagetype])."\" 
			     title=\"{$images[$i][filename]}\" class=\"zoom2\" ><img src=\"./index.php?module=image&action=show&id={$images[$i][id]}\" border=\"0\" width=\"100\" height=\"100\"></a>
			</td>  
			<td>{$images[$i][filename]}</td>  
			<td>{$images[$i][text]}</td>  
			<td>".$this->app->erp->ConvertDateTime($images[$i][datum])."</td>  
			<td align=\"center\"><a href=\"./index.php?module=image&action=show&id={$images[$i][id]}\">Bild</a>$thumbnail
			<td align=\"center\">
			  <a href=\"./index.php?module=image&action=edit&id={$images[$i][id]}\"><img src=\"./themes/default/images/edit.png\" border=\"0\"></img></a>
 <a href=\"#\" onclick=\"if(!confirm('Wollen Sie das Bild wirklich l&ouml;schen?')) return false; 
        else window.location.href='./index.php?module=image&action=delete&id={$images[$i][id]}'\"><img src=\"./themes/default/images/delete.gif\" border=\"0\"></img></a>
			</td>  
		       </tr>";
	  }
	}
	
	$this->app->Tpl->Set(IMAGETABLE, $table);
      }else
	$this->app->Tpl->Set(IMAGETABLE, "<tr><td colspan=\"5\">Keine Bilder vorhanden</td></tr>");
    }
  }

  function renderIndex($page=1)
  {
    $userid = $this->app->User->GetID();

    if(is_numeric($userid))
    {
      $count = $this->app->DB->Select("SELECT COUNT(id) FROM images WHERE adresse='$userid'");

      $index= "<center>";
      for($i=1;$i<=ceil($count/10);$i++)
      {
	if($page>1 && $i==1)
	  $index .= "<a href=\"./index.php?module=image&action=list&page=".($page-1)."\">&lArr;</a>&nbsp;";	

	$index .= "<a href=\"./index.php?module=image&action=list&page=$i\">";

	// Mache aktuelle Seite fett
	if($i==$page)
	  $index .=  "<b>$i</b>";
	else
	  $index .= $i;
  
	$index .= "</a>&nbsp";

	if($page<ceil($count/10) && $i==ceil($count/10))
          $index .= "<a href=\"./index.php?module=image&action=list&page=".($page+1)."\">&rArr;</a>&nbsp;";

      }
      $index .= "</center>";
      $this->app->Tpl->Set(INDEX, $index);
    }
  }


  function ImageShow()
  { 
    $id = $this->app->Secure->GetGET("id");
 
    if(is_numeric($id))
    {
      $bild = $this->app->DB->SelectArr("SELECT image, imagetype FROM images WHERE id='$id' LIMIT 1");
      header("Content-type: {$bild[0][imagetype]}");
      echo base64_decode($bild[0][image]);
    }
  }

  function ImageThumbnail()
  {
    $id = $this->app->Secure->GetGET("id");

    if(is_numeric($id))
    {
      $bild = $this->app->DB->SelectArr("SELECT thumbnail, thumbnailtype FROM images WHERE id='$id' LIMIT 1");
      header("Content-type: {$bild[0][thumbnailtype]}");
      echo base64_decode($bild[0][thumbnail]);
    }
  }

}

<?php

class Archiv 
{
  function Archiv(&$app)
  {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ArchivList");
    $this->app->ActionHandler("image","ArchivImage");
    $this->app->ActionHandler("thumbnail","ArchivThumbnail");
    $this->app->ActionHandler("pdf","ArchivPdf");
    $this->app->ActionHandler("upload","ArchivUpload");
    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen(&$app);
  }

  function ArchivList()
  {
    $ausgabengesamt = $this->app->DB->SelectArr("SELECT id FROM journal_archiv ORDER BY erscheinungsdatum DESC");

 //   if(is_numeric($this->app->User->GetID()))
 //     $zeigeZaehler = $this->app->User->GetRecht("ausgaben_upload");

    for($i=0; $i<count($ausgabengesamt); $i++)
    {
      $ausgaben = $this->app->DB->SelectArr("SELECT * FROM journal_archiv WHERE id='".$ausgabengesamt[$i][id]."' LIMIT 1");

      $id = $ausgaben[0][id];
      $name = $ausgaben[0][name];
      $beschreibung = base64_decode($ausgaben[0][beschreibung]);
      $count = $ausgaben[0][heruntergeladen];
      $datum = $ausgaben[0][erscheinungsdatum];
      $size = round(($ausgaben[0][size] / 1048576), 2);
      $bildtyp = $ausgaben[0][bildtyp];
      $thumbnailtyp = $ausgaben[0][thumbnailtyp];

      // Zaehler fuer Admins
      //if($zeigeZaehler==1)
      if($this->app->User->GetType()=="admin" || $this->app->User->GetType()=="webmaster")
	      $zaehler = "$count-mal heruntergeladen<br>";
      else $zaehler = "";
      

      $table .= 
      "<tr>
	      <td width=\"150\">
	        <a href=\"./index.php?module=archiv&action=image&id=$id&{$this->app->erp->getImageExtension($bildtyp)}\" title=\"$name\" class=\"zoom2\" >
	        <img src=\"./index.php?module=archiv&action=thumbnail&id=$id\" border=\"0\">
	        </a>
	      </td>
	      <td><b>$name</b><br><br>$beschreibung</td>
	      <td><center><a href=\"./index.php?module=archiv&action=pdf&id=$id\" title=\"$name\" ><img src=\"./themes/default/images/pdf.png\" border=\"0\"></a>
	      <br>$zaehler Gr&ouml;&szlig;e: $size MB</center></td>
       </tr>";

    }
    $this->app->Tpl->Set(TABLE, $table);

 
    $this->app->Tpl->Parse(INHALT,"archiv.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ArchivUpload()
  {
    // Verlaengere Skript-Ausfuehr-Zeit
    set_time_limit(500);
    ini_set('memory_limit', '128M');

    $db_maxfileSize = 16777216;// ca. 16 MB
    
    $name = $this->app->Secure->GetPOST("name");
    $beschreibung = $this->app->Secure->POST["beschreibung"];
    $datum = $this->app->Secure->GetPOST("datum");
    
    $pdf_complete = $this->app->Secure->GetPOST("pdfcomplete");
    $image_complete = $this->app->Secure->GetPOST("imagecomplete");
    $thumbnail_complete = $this->app->Secure->GetPOST("thumbnailcomplete");
    
    $submit = $this->app->Secure->GetPOST("submit");

    if($submit!="")
    {
      set_time_limit(500);

      if($name=="")
	      $error .= "Sie m&uuml;ssen einen Namen eingeben.<br>";

      if($beschreibung=="")
	      $error .= "F&uuml;gen Sie bitte eine (stichpunktartige) Beschreibung hinzu.<br>";

      if($datum=="")
	      $error .= "Geben Sie bitte ein Datum an.<br>";

      // PDF
      if($pdf_complete==1 && $_FILES[pdf][size]>0)
      {
	      if($_FILES[pdf][size] <= $db_maxfileSize)
	      {
	        $pfad = $_FILES[pdf][tmp_name];
	        $filehandle = fopen($pfad,'r');
	        $pdf_data = base64_encode(fread($filehandle, filesize($pfad)));
	      }else
	        $error .= "Die PDF-Datei darf nicht gr&ouml;&szlig;er als ".($db_maxfileSize / 1048576)." MB sein."; 
      }else
	      $error .= "Geben Sie bitte eine PDF-Datei zum Hochladen an.<br>";

      // Image
      if($image_complete==1 && $_FILES[image][size]>0)
      {
	      $image_error = $this->app->erp->checkImage($_FILES[image], $db_maxfileSize);
	      if($image_error=="")
	        $image_data = $this->app->erp->uploadImageIntoDB($_FILES[image]);
        }else
          $error .= "Geben Sie bitte eine Bild-Datei zum Hochladen an.<br>";
    
        // Thumbnail
        if($thumbnail_complete==1 && $_FILES[thumbnail][size]>0)
        {
	        $thumbnail_error = $this->app->erp->checkImage($_FILES[thumbnail], $db_maxfileSize);
          if($thumbnail_error=="")
            $thumbnail_data = $this->app->erp->uploadImageIntoDB($_FILES[thumbnail]);
        }else
          $error .= "Geben Sie bitte eine Thumbnail-Datei zum Hochladen an.<br>";


        // In Datenbank schreiben
        if($error=="")
        {
	        $beschreibung_b64 = base64_encode($beschreibung);
	        $formated_date = $this->app->erp->ConvertToSqlDate($datum); 
	        $this->app->DB->Insert("INSERT INTO journal_archiv (name, beschreibung, filename, pdf, size, bild, bildtyp, thumbnail, 
                                  thumbnailtyp, erscheinungsdatum)
				                          VALUES ('$name', '$beschreibung_b64', '{$_FILES[pdf][name]}', '$pdf_data', '{$_FILES[pdf][size]}', 
                                  '{$image_data[bild]}', '{$image_data[typ]}', '{$thumbnail_data[bild]}', '{$thumbnail_data[typ]}', '$formated_date')");
          unset($_FILES);
	        $this->app->Tpl->Set(MESSAGE, "<div class=\"success\">Ausgabe wurde erfolgreich hochgeladen.</div>");
      }else
	      $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");

    }   
    ini_set('memory_limit', '64M');

    $this->app->Tpl->Parse(INHALT,"archiv_upload.tpl");
    $this->app->Tpl->Parse(PAGE,"index.tpl");
  }

  function ArchivImage()
  { 
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    { 
      $bild = $this->app->DB->SelectArr("SELECT bild, bildtyp FROM journal_archiv WHERE id='$id' LIMIT 1");
      header("Content-type: {$bild[0][bildtyp]}");
      echo base64_decode($bild[0][bild]);
    }
  }

  function ArchivThumbnail()
  { 
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    { 
      $bild = $this->app->DB->SelectArr("SELECT thumbnail, thumbnailtyp FROM journal_archiv WHERE id='$id' LIMIT 1");
      header("Content-type: {$bild[0][bildtyp]}");
      echo base64_decode($bild[0][thumbnail]);
    }
  }
 
  function ArchivPdf()
  { 
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    { 
      $pdf = $this->app->DB->Select("SELECT pdf FROM journal_archiv WHERE id='$id' LIMIT 1");
      $filename = $this->app->DB->Select("SELECT filename FROM journal_archiv WHERE id='$id' LIMIT 1");
      $count = $this->app->DB->Select("SELECT heruntergeladen FROM journal_archiv WHERE id='$id' LIMIT 1");
      $count++;
      $this->app->DB->Update("UPDATE journal_archiv SET heruntergeladen='{$count}' WHERE id='$id'");    
  
      header("Content-type: application/pdf");
      header("Content-disposition: attachment; filename=$filename");
      echo base64_decode($pdf);
    }
  }
 
}

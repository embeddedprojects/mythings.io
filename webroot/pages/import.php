<?php

class Import 
{
  function Import(&$app)
  {
    $this->app=&$app; 
     
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("auth","ImportAuth");
    $this->app->ActionHandler("getlist","ImportGetList");
    $this->app->ActionHandler("sendlist","ImportSendList");
    $this->app->ActionHandler("getfilelist","ImportGetFileList");
    $this->app->ActionHandler("getauftraegeanzahl","ImportGetAuftraegeAnzahl");
    $this->app->ActionHandler("getauftrag","ImportGetAuftrag");
    $this->app->ActionHandler("deletearticle","ImportDeleteArticle");
    $this->app->ActionHandler("sendfile","ImportSendFile");
    $this->app->ActionHandler("deletefile","ImportDeleteFile");
    $this->app->ActionHandler("deleteauftrag","ImportDeleteAuftrag");
    $this->app->ActionHandler("navigation","ImportNavigation");
    $this->app->ActionHandler("artikelgruppen","ImportArtikelgruppen");
    $this->app->ActionHandler("inhalt","ImportInhalt");
    $this->app->ActionHandler("artikelartikelgruppen","ImportArtikelArtikelGruppe");
    $this->app->ActionHandler("addfilesubjekt","ImportAddFileSubjekt");
  
    $this->app->DefaultActionHandler("cmd");

    // token pruefen!!! sonst abbruch
    $this->CatchRemoteAuth();

    $this->app->ActionHandlerListen(&$app);
  }


  function ImportDeleteAuftrag()
  {
    $tmp = $this->CatchRemoteCommand("data");

    // pruefe ob $tmp[datei] vorhanden wenn nicht lege an sonst update [inhalt] und [checksum]
    $auftrag = $tmp[auftrag];

    $this->app->DB->Delete("DELETE FROM auftraege WHERE id='$auftrag' LIMIT 1");

    echo $this->SendResponse("ok");
    exit;
  }


  function ImportDeleteFile()
  {
    $tmp = $this->CatchRemoteCommand("data");

    // pruefe ob $tmp[datei] vorhanden wenn nicht lege an sonst update [inhalt] und [checksum]
    $datei = $tmp[datei];
    $checksum= $tmp[checksum];

    $this->app->DB->Delete("DELETE FROM datei WHERE datei='$datei' LIMIT 1");
    $this->app->DB->Delete("DELETE FROM datei_stichwoerter WHERE datei='$datei'");

    echo $this->SendResponse("ok");
    exit;
  }

  function ImportSendFile()
  {
    $tmp = $this->CatchRemoteCommand("data");

    // pruefe ob $tmp[datei] vorhanden wenn nicht lege an sonst update [inhalt] und [checksum]
    $datei = $tmp[datei];
    $inhalt= $tmp[inhalt];
    $checksum= $tmp[checksum];

    $this->app->DB->Delete("DELETE FROM datei WHERE datei='$datei' LIMIT 1");
    $this->app->DB->Delete("INSERT INTO datei (id,datei,inhalt,checksum,logdatei) VALUES ('','$datei','$inhalt','$checksum',NOW())");

    echo $this->SendResponse("ok");
    exit;
  }


  function ImportAddFileSubjekt()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $artikel = $tmp[artikel];
    $subjekt= $tmp[subjekt];
    $datei= $tmp[datei];
    //loesche alle stichwoerter und lege alle neu an /subjekt /artikel
    $this->app->DB->Delete("DELETE FROM datei_stichwoerter WHERE artikel='$artikel' AND subjekt='$subjekt' AND datei='$datei' LIMIT 1");
    $this->app->DB->Delete("INSERT INTO datei_stichwoerter (artikel,subjekt,datei) VALUES ('$artikel','$subjekt','$datei')");

    echo $this->SendResponse("ok");
    exit;
  }


  // delete an article
  function ImportDeleteArticle()
  {
    $tmp = $this->CatchRemoteCommand("data");

    $this->app->DB->Select("DELETE FROM artikel WHERE artikel='$tmp' LIMIT 1");

    // anzahl erfolgreicher updates
    echo $this->SendResponse($tmp);
    exit;
  }


  // receive all new articles
  function ImportSendList()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $anzahl = 0;
    for($i=0;$i<count($tmp);$i++)
    {
      $artikel = $tmp[$i][artikel];

      if($artikel!="ignore")
      {
	$tmpid = $this->app->DB->Select("SELECT id FROM artikel WHERE artikel='$artikel' LIMIT 1");
	if(!is_numeric($tmpid)) $this->app->DB->Insert("INSERT INTO artikel (id,artikel) VALUES ('','$artikel')");

	foreach($tmp[$i] as $key=>$value)
	{
	  $this->app->DB->Update("UPDATE artikel SET $key='$value' WHERE artikel='$artikel' LIMIT 1");
	}
	$anzahl++;    
      }
    }

    // anzahl erfolgreicher updates
    echo $this->SendResponse($anzahl);
    exit;
  }


  // receive all new articles
  function ImportInhalt()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $anzahl = 0;
    $this->app->DB->Delete("DELETE FROM inhalt");
    for($i=0;$i<count($tmp);$i++)
    {

      $this->app->DB->Insert("INSERT INTO inhalt (id) VALUES ('')");
      $id = $this->app->DB->GetInsertID();

      foreach($tmp[$i] as $key=>$value)
      {
	$this->app->DB->Update("UPDATE inhalt SET $key='$value' WHERE id='$id' LIMIT 1");
      }

      $anzahl++;
    }

    // anzahl erfolgreicher updates
    echo $this->SendResponse($anzahl);
    exit;
  }

  // receive all new articles
  function ImportArtikelgruppen()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $anzahl = 0;
    $this->app->DB->Delete("DELETE FROM artikelgruppen");
    for($i=0;$i<count($tmp);$i++)
    {
      $id = $tmp[$i][id];

      $this->app->DB->Insert("INSERT INTO artikelgruppen (id) VALUES ('$id')");

      foreach($tmp[$i] as $key=>$value)
      {
	$this->app->DB->Update("UPDATE artikelgruppen SET $key='$value' WHERE id='$id' LIMIT 1");
      }

      $anzahl++;
    }

    // anzahl erfolgreicher updates
    echo $this->SendResponse($anzahl);
    exit;
  }

  // receive all new articles
  function ImportNavigation()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $anzahl = 0;
    $this->app->DB->Delete("DELETE FROM shopnavigation");
    for($i=0;$i<count($tmp);$i++)
    {
      $id = $tmp[$i][id];

      $this->app->DB->Insert("INSERT INTO shopnavigation (id) VALUES ('$id')");

      foreach($tmp[$i] as $key=>$value)
      {
	$this->app->DB->Update("UPDATE shopnavigation SET $key='$value' WHERE id='$id' LIMIT 1");
      }

      $anzahl++;
    }

    // anzahl erfolgreicher updates
    echo $this->SendResponse($anzahl);
    exit;
  }

  // receive all new articles
  function ImportArtikelArtikelGruppe()
  {
    $tmp = $this->CatchRemoteCommand("data");
    $anzahl = 0;
    $this->app->DB->Delete("DELETE FROM artikel_artikelgruppe");
    for($i=0;$i<count($tmp);$i++)
    {
      $id = $tmp[$i][id];

      $this->app->DB->Insert("INSERT INTO artikel_artikelgruppe (id) VALUES ('$id')");

      foreach($tmp[$i] as $key=>$value)
      {
	$this->app->DB->Update("UPDATE artikel_artikelgruppe SET $key='$value' WHERE id='$id' LIMIT 1");
      }

      $anzahl++;
    }

    // anzahl erfolgreicher updates
    echo $this->SendResponse($anzahl);
    exit;
  }


  // get checksum list from onlineshop
  function ImportGetAuftraegeAnzahl()
  {
    $tmp = $this->app->DB->Select("SELECT COUNT(id) FROM auftraege");
    echo $this->SendResponse($tmp);
    exit;
  }


  // get checksum list from onlineshop
  function ImportGetAuftrag()
  {
    $tmp = $this->app->DB->SelectArr("SELECT id,sessionid,warenkorb,logdatei FROM auftraege ORDER by logdatei ASC LIMIT 1");
    echo $this->SendResponse($tmp);
    exit;
  }



  

  // get checksum list from onlineshop
  function ImportGetList()
  {
    $tmp = $this->app->DB->SelectArr("SELECT artikel,checksum FROM artikel");
    echo $this->SendResponse($tmp);
    exit;
  }


  // get checksum list from the files 
  function ImportGetFileList()
  {
    $tmp = $this->app->DB->SelectArr("SELECT datei, checksum FROM datei");
    echo $this->SendResponse($tmp);
    exit;
  }
 
  function ImportAuth()
  {
    $checktoken = "12346";
    $result = $this->CatchRemoteCommandAES("token");
    if($result==$checktoken)
      echo $this->SendResponse("success");
    else 
      echo $this->SendResponse("failed");

    exit;
  }

  function CatchRemoteCommandAES($value)
  {
    $tmp = $this->app->Secure->GetPOST($value);

    //$z = "abcdefghijuklmno0123456789012345"; // 256-bit key
    //$z = "1234"; // 256-bit key
    $z = "abcdefghijuklmno0123456789012345"; // 256-bit key
    $aes = new AES($z);
    return unserialize($aes->decrypt(base64_decode($tmp)));
  }


  function CatchRemoteCommand($value)
  {
    $tmp = $this->app->Secure->GetPOST($value);

    return unserialize(base64_decode($tmp));
  }

  function CatchRemoteAuth()
  {
    $checktoken = "12346";
    $result = $this->CatchRemoteCommandAES("token");
    if($result!=$checktoken)
    {
      $this->SendResponse("failed"); 
      exit;
    }
  }


  function SendResponse($value)
  {
    return base64_encode(serialize($value));
  }

  function SendResponseAES($value)
  {
    //$z = "abcdefghijuklmno0123456789012345"; // 256-bit key
    $z = "abcdefghijuklmno0123456789012345"; // 256-bit key
    $aes = new AES($z);
    return base64_encode($aes->encrypt(serialize($value)));
  }



}
?>

<?php


class User 
{

  function User(&$app)
  {
    $this->app = &$app;
  }

  function GetID()
  { 
    return $this->app->DB->Select("SELECT user_id FROM useronline WHERE sessionid='".session_id()."'
      AND ip='".$_SERVER[REMOTE_ADDR]."' AND login='1'");
  }

  function GetType()
  { 
    $type = $this->app->DB->Select("SELECT type FROM user WHERE id='".$this->GetID()."'");

    if($type=="")
      $type = $this->app->Conf->WFconf[defaultgroup];
    return $type;
  }

  function GetAdresse()
  {
    $id = $this->GetID();
    return $this->app->DB->Select("SELECT kundendaten FROM user WHERE id='$id' LIMIT 1");
  }

  function GetName()
  { 
    return $this->GetCryptedData("name");
  }

  function GetFirma()
  { 
    return $this->GetCryptedData("firmenname");
  }

  function GetRecht($right)
  {
    $type = $this->GetType();
    if($type!="" && $right!="")
      return $this->app->DB->Select("SELECT $right FROM gruppenrechte WHERE gruppe='$type' LIMIT 1");
  }

  private function GetCryptedData($col)
  {
    // Moegl. Werte: 
    // name, firmenname, adresszusatz, strasse, plz, ort, land, kontoinhaber, konto, blz, institut,
    // bic, iban, paypal, kreditkartentyp, kreditkartennummer, zahlungsweise, email, url, telefon,
    // ticket

    $id = $this->GetID();
    if(is_numeric($id) && $col!="")
    {

      $adresse = $this->app->DB->Select("SELECT kundendaten FROM user WHERE id='$id' LIMIT 1");
      $crypted_data = $this->app->DB->Select("SELECT $col FROM kundendaten WHERE id='$adresse' LIMIT 1");
      return $this->app->erp->Decrypt($crypted_data);
    }
  }
  


}
?>

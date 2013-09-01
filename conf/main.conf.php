<?
    
//database connection
class Config {
    
  function Config() 
  {
    include("user.inc.php");
    
    // define defaults
    $this->WFconf[defaultpage] = 'welcome';
    $this->WFconf[defaultpageaction] = 'list';
    $this->WFconf[defaulttheme] = 'mythings';
    $this->WFconf[defaultgroup] = 'web';
    
    // allow that cols where dynamically added so structure
    $this->WFconf[autoDBupgrade]=true;
    
    // time how long a user can be connected in seconds
    $this->WFconf[logintimeout] = 28800;
    
    // alle vorhanden Gruppen in diesem System
    $this->WFconf[groups] = array('web','benutzer','redakteur','endredakteur','admin','webmaster');
    
    // gruppen die sich anmelden muessen
    $this->WFconf[havetoauth] = array('benutzer','redakteur','endredakteur','admin','webmaster');
    
    //menu structure
    
    // permissions for webmaster
    $this->WFconf[permissions][webmaster][image] = array('list','show','thumbnail','delete','edit');
    $this->WFconf[permissions][webmaster][register] = array('list','activate','captcha','forget');
    $this->WFconf[permissions][webmaster][welcome] = array('login','main','logout','list');
    $this->WFconf[permissions][webmaster][mythingsapi] = array('list','add');
    $this->WFconf[permissions][webmaster][tutorial] = array('list');
    $this->WFconf[permissions][webmaster][lists] = array('list','edit','create','delete');
 
    // permissions for web
    $this->WFconf[permissions][web][image] = array('show','thumbnail');
    $this->WFconf[permissions][web][welcome] = array('login','main','logout','list');
    $this->WFconf[permissions][web][stock] = array('list','image','delete','edit','data','archive');
    $this->WFconf[permissions][web][mythingsapi] = array('list','add');
    $this->WFconf[permissions][web][reader] = array('list','screenshot','imprint','aboutus');
    $this->WFconf[permissions][web][settings] = array('list');
    $this->WFconf[permissions][web][register] = array('list','activate','captcha','forget');
    $this->WFconf[permissions][web][tutorial] = array('list');

  
    // permissions for web
    $this->WFconf[permissions][benutzer][image] = array('show','thumbnail');
    $this->WFconf[permissions][benutzer][welcome] = array('login','main','logout','list');
    $this->WFconf[permissions][benutzer][stock] = array('list','image','delete','edit','data','archive');
    $this->WFconf[permissions][benutzer][mythingsapi] = array('list','add');
    $this->WFconf[permissions][benutzer][reader] = array('list','screenshot','imprint','aboutus');
    $this->WFconf[permissions][benutzer][settings] = array('list');
    $this->WFconf[permissions][benutzer][register] = array('list','activate','captcha','forget');
    $this->WFconf[permissions][benutzer][tutorial] = array('list');
    $this->WFconf[permissions][benutzer][lists] = array('list','edit','create','delete');

   

    # alt
    /*
    $this->WFconf[permissions][web][welcome] = array('artikel','login','main','logout','lang');
    $this->WFconf[permissions][web][artikel] = array('list','artikel','inhalt','gruppe','datei');
    $this->WFconf[permissions][web][platine] = array('demo');
    $this->WFconf[permissions][web][suche] = array('mask');
    $this->WFconf[permissions][web][bestellfax] = array('show');
    $this->WFconf[permissions][web][angebot] = array('show');
    $this->WFconf[permissions][web][content] = array('show');
    $this->WFconf[permissions][web][export] = array('google');
    $this->WFconf[permissions][web][journal] = array('list');
    $this->WFconf[permissions][web][import] = array('auth','getlist','getfilelist','sendlist','deletearticle','addfilesubjekt','sendfile','navigation','artikelgruppen','artikelartikelgruppen','gast','deletefile','inhalt');
    $this->WFconf[permissions][web][bestellen] = array('warenkorb','kasse','packstation','lieferadresse','zahlweise','abschicken','abschluss','pdf');
    $this->WFconf[permissions][web][zeitschrift] = array('list','login','edit');
    */

  }
}
?>

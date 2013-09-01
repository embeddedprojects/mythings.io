<?php

class Export 
{
  function Export(&$app)
  {
    $this->app=&$app; 
     
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("google","ExportGoogle");
  
    $this->app->DefaultActionHandler("list");
  
    $this->app->ActionHandlerListen(&$app);
  }
 
  //www.google.de/merchants/default
  function ExportGoogle()
  {
header("Content-Type: text/plain");
/*echo '
id  title beschreibung	link  bild_url	preis preisart	währung	versand	zahlungsmethode	menge marke Modelname zustand produktart  standort
33  Rolloleinwand WS Brilliant R-Rollo	Rolloleinwand in schönem weißen Lackgehäuse. Hochwertiger Rollomechanismus mit sanftem Einzugsystem. Abwaschbares Tuch in Gain 1,0, 16:9 maskiert mit sehr guter Planlage. Mit schwarzem Rand und langen Vorlauf zur Deckenmontage. Decken- und Wandmontageset incl.. Das Tuch ist ein SE - Gewebeträger mit sehr guter Planlage.   http://shop.heimkinoraum.de/produkt_33_Rolloleinwand-WS-Brilliant-R-Rollo.html  http://heimkinoraum.de/products/33.jpg  349	unverhandelt  EUR :::0	"Paypal; Bank"	1 WS-Spalluto Rolloleinwand WS Brilliant R-Rollo  neu Leinwände	"Balanstrasse 358; 81549 München; Deutschland"';
*/

echo 'id  title beschreibung	link  bild_url	preis preisart	währung	versand	zahlungsmethode	menge marke Modelname zustand produktart  standort';

  $arr = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE gesperrt=0");

  foreach($arr as $key=>$value)
  {
    $id = $value[id];
    $name_de = $value[name_de];
    $artikel = $value[artikel];
    $standardbild = $value[standardbild];
    $kurztext_de = strip_tags($value[kurztext_de]);
    $preis = number_format($value[preis]*1.19,"2",",","");
    $hesteller = $value[hersteller];
    $warengruppe = $this->app->DB->Select("SELECT ag.bezeichnung FROM artikel_artikelgruppe aag LEFT JOIN artikelgruppen ag ON ag.id=aag.artikelgruppe WHERE aag.artikel='$artikel' LIMIT 1");
    if($standardbild!="")
      echo "$id\t$name_de\t$kurztext_de\thttp://www.embedded-projects.net/index.php?module=artikel&action=artikel&id=$artikel&ref=1\thttp://www.embedded-projects.net/index.php?module=artikel&action=datei&file=$standardbild\t$preis\tunverhandelt\tEUR\t:::0\t\"Paypal; Bank; Kreditkarte,Rechnung,Vorkasse,Nachanhme\"\t1\t$hersteller\t\"\"\tneu\t$warengruppe\t\"Holzbachstraße 4; 86152 Augsburg;Deutschland\"\n";
      //echo utf8_decode("$id\t$name_de\t$preis\n");
  }


    $this->app->BuildNavigation=false;
    exit;
  }
 


}
?>

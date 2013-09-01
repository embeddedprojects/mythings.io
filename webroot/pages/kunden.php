<?

class Kunden {
  var $app;
  
  function Kunden($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","KundenCreate");
    $this->app->ActionHandler("edit","KundenEdit");
    $this->app->ActionHandler("list","KundenList");
    $this->app->ActionHandler("rechnungen","KundenRechnungen");
    $this->app->ActionHandler("archiv","KundenArchiv");
    $this->app->ActionHandler("kontakt","KundenKontakt");
    $this->app->ActionHandler("artikel","KundenArtikel");
    $this->app->ActionHandler("angebotlist","KundenAngebote");
    $this->app->ActionHandler("rechnungenlist","KundenRechnungen");
    $this->app->ActionHandler("auftraglist","KundenAuftraege");

    $this->app->ActionHandlerListen(&$app);

    $this->app = $app;
  }

  function KundenCreate()
  {
    $this->app->Tpl->Add(TABS,
      "<a class=\"tab\" href=\"index.php?module=kunden&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>");
  }

  function KundenMainMenu()
  {
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=list\">Kunden</a>");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=rechnungenlist\">Rechnungen</a>");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=auftraglist\">Auftr&auml;ge</a>");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=angebotlist\">Angebote</a>");
  }

  function KundenList()
  {

    $this->KundenMainMenu();
    $this->app->Tpl->Set(SUBHEADING,"Kunden Suche");
    $this->app->Tpl->Set(INHALT,"kunden suche");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(SUBHEADING,"Kunden");
    $table = new EasyTable($this->app);
    $table->Query("SELECT name, vorname, ort, plz, strasse, email, id FROM adresse  WHERE kunde=1 order by name");
    $table->Display(INHALT);
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }


  function KundenRechnungen()
  {
    $this->KundenMainMenu();
    $this->app->Tpl->Set(HEADING,"Kunden ");

    $this->app->Tpl->Set(SUBHEADING,"Rechnungs Suche");
    $this->app->Tpl->Set(INHALT,"rechnungen suche");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");


    $this->app->Tpl->Set(SUBHEADING,"Rechnungen");
    $this->app->Tpl->Set(INHALT,"edit");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }


  function KundenAuftraege()
  {
    $this->KundenMainMenu();
    $this->app->Tpl->Set(HEADING,"Kunden ");

    $this->app->Tpl->Set(SUBHEADING,"Aufrags Suche");
    $this->app->Tpl->Set(INHALT,"auftrags suche");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(SUBHEADING,"Auftr&auml;ge");
    $this->app->Tpl->Set(INHALT,"auf");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }

  function KundenAngebote()
  {
    $this->KundenMainMenu();
    $this->app->Tpl->Set(HEADING,"Kunden ");

    $this->app->Tpl->Set(SUBHEADING,"Angebots Suche");
    $this->app->Tpl->Set(INHALT,"angebots suche");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");


    $this->app->Tpl->Set(SUBHEADING,"Angebote");
    $this->app->Tpl->Set(INHALT,"an");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }



  
  function KundenMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=edit&id=$id\">Kunde</a>&nbsp;");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=archiv&id=$id\">Archiv</a>&nbsp;");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=artikel&id=$id\">Artikel f&uuml;r Abrechnung</a>&nbsp;");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=kontakt&id=$id\">Kontakthistorie</a>&nbsp;");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=kontakt&id=$id\">USt.-Pr&uuml;fungen</a>&nbsp;");
    //$this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=edit&id=$id\">E-Mail schreiben</a>&nbsp;");
    //$this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=edit&id=$id\">Brief schreiben</a>&nbsp;");
    //$this->app->Tpl->Add(TABS,"<a href=\"index.php?module=kunden&action=kosten&id=$id\">Gesamtkalkulation</a>&nbsp;");
    $this->app->Tpl->Add(TABS,"<a class=\"tab\" href=\"index.php?module=kunden&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>&nbsp;");
  }

  function KundenEdit()
  {
    $this->KundenMenu();
    $this->app->Tpl->Set(HEADING,"Kunde");

    $this->app->Tpl->Set(INHALT,"edit");
    $this->app->Tpl->Set(SUBHEADING,"Kundendaten");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }

  function KundenArchiv()
  {
    $this->KundenMenu();
    $this->app->Tpl->Set(HEADING,"Archiv");

    $this->app->Tpl->Set(INHALT,"auftr");
    $this->app->Tpl->Set(SUBHEADING,"Offene Auftr&auml;ge");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  

    $this->app->Tpl->Set(INHALT,"auftr");
    $this->app->Tpl->Set(SUBHEADING,"Auftr&auml;ge");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  
    $this->app->Tpl->Set(INHALT,"rechnungen");
    $this->app->Tpl->Set(SUBHEADING,"Rechnungen");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

  
    $this->app->Tpl->Set(INHALT,"liefer");
    $this->app->Tpl->Set(SUBHEADING,"Lieferscheine");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(INHALT,"gut");
    $this->app->Tpl->Set(SUBHEADING,"Gutschriften");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
  }


  function KundenArtikel()
  {
    $this->KundenMenu();
    $this->app->Tpl->Set(HEADING,"Artikel");

    $this->app->Tpl->Set(INHALT,"edit");
    $this->app->Tpl->Set(SUBHEADING,"offene Artikel");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(INHALT,"edit");
    $this->app->Tpl->Set(SUBHEADING,"Abo-Artikel");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(INHALT,"edit");
    $this->app->Tpl->Set(SUBHEADING,"Abgerechnete Artikel");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

  }



  function KundenKontakt()
  {
    $this->KundenMenu();
    $this->app->Tpl->Set(HEADING,"Kontakt");

    $this->app->Tpl->Set(SUBHEADING,"offene Tickets");
    $this->app->Tpl->Set(INHALT,"tickets");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");

    $this->app->Tpl->Set(SUBHEADING,"Tickets");
    $this->app->Tpl->Set(INHALT,"tickets");
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");


  }




  function KundenSuchmaske()
  {
    $typ=$this->app->Secure->GetGET("typ");

    $this->app->Tpl->Set(HEADING,"Suchmaske f&uuml;r Kundenn");
    $table = new EasyTable($this->app);
    switch($typ) {
      case "auftragrechnung":
	$table->Query("SELECT typ,name, vorname, ort, plz, strasse, abteilung, unterabteilung, ustid, email, adresszusatz, id as kundeadressid, id FROM kunden order by name");
      break;
      case "auftraglieferschein":
	$table->Query("SELECT typ as liefertyp, name as liefername, vorname as liefervorname, ort as lieferort, plz as lieferplz, strasse as lieferstrasse, abteilung as lieferabteilung, unterabteilung
	as lieferunterabteilung, adresszusatz as lieferadresszusatz, id as lieferadressid  FROM kunden order by name");
      break;
      default:
	$table->Query("SELECT typ,name, vorname, ort, plz, strasse, abteilung, unterabteilung, ustid, email, adresszusatz, id as kundeadressid, id FROM kunden order by name");
    }
 
    $table->DisplayWithDelivery(PAGE);

    $this->app->BuildNavigation=false;


  }



}

?>

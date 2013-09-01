<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

<!-- gehort zu tabview -->
<div id="tabview" class="yui-navset">
    <ul class="yui-nav">
        <li class="[AKTIV_BESCHREIBUNG]"><a href="#tab1"><em>Beschreibung</em></a></li>
        <li class="[AKTIV_OPTIONEN]"><a href="#tab3"><em>Optionen</em></a></li>
        <li class="[AKTIV_EIGENSCHAFTEN]"><a href="#tab2"><em>Eigenschaften</em></a></li>
        <li class="[AKTIV_SPERRE]"><a href="#tab4"><em>Sperre</em></a></li>
    </ul>

    <div class="yui-content">
<!-- ende gehort zu tabview -->

<div>

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Artikelbeschreibung<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>
[MESSAGE]
          <table border="0" width="100%">
            <tbody>
	      <tr><td colspan="2"><br></td></tr>
	      <tr><td>Artikel (DE)</td><td>[NAME_DE][MSGNAME_DE]</td></tr>
	      <tr><td>Artikel Nr.</td><td>[NUMMER][MSGNUMMER]</td></tr>
	      <tr><td>Artikel Typ</td><td>
		[TYP][MSGTYP]
	      </td></tr>
	      <tr><td>Standardlieferant</td><td>[LIEFERANTAUTOSTART][LIEFERANT][MSGLIEFERANT][LIEFERANTAUTOEND]</td></td></tr>
	      <!--<tr><td>Warengruppe</td><td>[WARENGRUPPE][MSGWARENGRUPPE]</td></td></tr>-->
	      <tr><td>Herstellerlink</td><td>[HERSTELLERLINK][MSGHERSTELLERLINK]</td></tr>
	      <tr><td>ROHS Nr.</td><td>[ROHSNUMMER][MSGROHSNUMMER]</td></tr>
	      <tr><td>Artikel (EN)</td><td>[NAME_EN][MSGNAME_EN]</td></tr>
	      <tr><td>Kurztext (DE)</td><td>[KURZTEXT_DE][MSGKURZTEXT_DE]</td></tr>
	      <tr><td>Kurztext (EN)</td><td>[KURZTEXT_EN][MSGKURZTEXT_EN]</td></tr>
	      <tr><td>Beschreibung (DE)</td><td>[BESCHREIBUNG_DE][MSGBESCHREIBUNG_DE]</td></tr>
	      <tr><td>Beschreibung (EN)</td><td>[BESCHREIBUNG_EN][MSGBESCHREIBUNG_EN]</td></tr>
            </tbody>
          </table>
        </td>
      </tr>
     <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>


    </tbody>
  </table>
  
 </div>



<div>

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Artikeloptionen<br></td>
      </tr>
      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="100%">
            <tbody>
	      <tr><td colspan="2"><br></td></tr>
	      <tr><td colspan="2"><b>Lieferung / Lager / Steuersatz</b></td></tr>
	     <tr><td>Standardlager</td><td>[STANDARDLAGER][MSGSTANDARDLAGER]<input type="button" value="Lager"></td><td>
	      <tr><td>Lieferzeit</td><td>
		[LIEFERZEIT][MSGLIEFERZEIT]
	      </td></tr>
	      <tr><td>Umsatzsteuerklasse</td><td>[UMSATZSTEUER][MSGUMSATZSTEUER] </td></tr>
	      <tr><td colspan="2"><br></td></tr>
	      <tr><td colspan="2"><b>Optionen</b></td></tr>
	      <tr><td>Aktiv</td><td>[AKTIV][MSGAKTIV]</td></tr>
	      <tr><td>Shop-Artikel</td><td>[SHOPARTIKEL][MSGSHOPARTIKEL]</td></tr>
	      <tr><td>Unishop-Artikel</td><td>[UNISHOPARTIKEL][MSGUNISHOPARTIKEL]</td></tr>
	      <tr><td>St&uuml;ckliste</td><td>[STUECKLISTE][MSGSTUECKLISTE]</td></tr>
	      <tr><td>Endmontage</td><td>[ENDMONTAGE][MSGENDMONTAGE]
		(Es ist eine Endmontage notwendig.)</td></tr>
	      <tr><td>Funktionstest</td><td>[FUNKTIONSTEST][MSGFUNKTIONSTEST]
		(Es muss ein Funktionstest durchgef&uuml;hrt werden.)</td></tr>
	      <tr><td>Artikelcheckliste</td><td>[ARTIKELCHECKLISTE][MSGARTIKELCHECKLISTE]
		(Es muss eine Artikelcheckliste anlegt werden.)</td></tr>
	      <tr><td>Lagerartikel</td><td>[LAGERARTIKEL][MSGLAGERARTIKEL]</td></tr>
	      <tr><td>Chargenverwaltung</td><td>[CHARGENVERWALTUNG][MSGCHARGENVERWALTUNG]</td></tr>
	      <tr><td>Provisionsartikel</td><td>[PROVISIONSARTIKEL][MSGPROVISIONSARTIKEL]</td></tr>
	      <tr><td>Designfreigabe</td><td>[PROVISIONSARTIKEL][MSGPROVISIONSARTIKEL]</td></tr>
	      <tr><td>Sonstiges</td><td>[SONSTIGES][MSGSONSTIGES]</td></tr>
            </tbody>
          </table>
        </td>
      </tr>
     <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>

    </tbody>
  </table>
  
 </div>
<div>

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Artikeleigenschaften<br></td>
      </tr>

      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="100%">
            <tbody>

	      <tr><td colspan="2"><br></td></tr>
	      <tr><td colspan="2"><b>Seriennummern Verwaltung</b></td></tr>
	      <tr><td>Seriennummern</td><td>
	      [SERIENNUMMERN][MSGSERIENNUMMERN]
	      </td></tr>
	     
	      <tr><td colspan="2"><br><br></td></tr>
	      <tr><td colspan="2"><b>Einheiten</b></td></tr>
	      <tr><td>Gewicht</td><td>[GEWICHT][MSGGEWICHT]<input type="button" value="Waage"></td></tr>
	      <tr><td>Teilbar</td><td>[TEILBAR][MSGTEILBAR]</td><td>
	      <tr><td>In n Teile</td><td>[NTEILE][MSGNTEILE]<input type="button" value="Rechner"></td></tr>
	      <tr><td colspan="2"><br></td></tr>
      </tbody>
          </table>
        </td>
      </tr>

     <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>


    </tbody>
  </table>
 
</div>


<div>
	
  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr classname="orange1" class="orange1" bordercolor="" align="" bgcolor="" height="" valign="">
        <td colspan="3" bordercolor="" class="" align="" bgcolor="" height="" valign="">Artikelsperre<br></td>
      </tr>
      <tr valign="top" colspan="3">
        <td>
          <table border="0" width="100%">
            <tbody>
	      <tr><td colspan="2"><br></td></tr>
	      <tr><td><b>Artikelsperre</b></td><td></td></tr>
	      <tr><td>G&uuml;ltig bis</td><td>[GUELTIGBIS][MSGGUELTIGBIS][KALENDER_GUELTIGBIS]</td></tr>
	      <tr><td>Gesperrt</td><td>[GESPERRT][MSGGESPERRT]</td></tr>
	      <tr><td>Sperrgrund</td><td>[SPERRGRUND][MSGSPERRGRUND]</td></tr>
	      <tr><td colspan="2"><br></td></tr>
            </tbody>
          </table>
        </td>
      </tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>

  
    </tbody>
  </table>
  
 </div>
  
 <!-- tab view schließen -->
</div></div>
<!-- ende tab view schließen -->
  
  </form>
</body></html>

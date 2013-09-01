function getXMLRequester( )
{
    var xmlHttp = false; //Variable initialisieren
            
    try
    {
        // Der Internet Explorer stellt ein ActiveXObjekt zur Verfügung
        if( window.ActiveXObject )
        {
            // Versuche die neueste Version des Objektes zu laden
            for( var i = 5; i; i-- )
            {
                try
                {
                    //Wenn keine neuere geht, das alte Objekt verwenden
                    if( i == 2 )
                    {
                        xmlHttp = new ActiveXObject( "Microsoft.XMLHTTP" );    
                    }
                    // Sonst die neuestmögliche Version verwenden
                    else
                    {
                        
                        xmlHttp = new ActiveXObject( "Msxml2.XMLHTTP." + i + ".0" );
                    }
                    break; //Wenn eine Version geladen wurde, unterbreche Schleife
                }
                catch( excNotLoadable )
                {                        
                    xmlHttp = false;
                }
            }
        }
        // alle anderen Browser
        else if( window.XMLHttpRequest )
        {
            xmlHttp = new XMLHttpRequest();
        }
    }
    // loading of xmlhttp object failed
    catch( excNotLoadable )
    {
        xmlHttp = false;
    }
    return xmlHttp ;
}
// Konstanten
var REQUEST_GET        = 0;
var REQUEST_POST        = 2;
var REQUEST_HEAD    = 1;
var REQUEST_XML        = 3;

function sendRequest( strSource, strData, intType, intID )
{
    // Falls strData nicht gesetzt ist, als Standardwert einen leeren String setzen
    if( !strData )
        strData = '';

    // Falls der Request-Typ nicht gesetzt ist, standardmäßig auf GET setzen
    if( isNaN( intType ) )
        intType = 0;

    // wenn ein vorhergehender Request noch nicht beendet ist, beenden
    if( xmlHttp && xmlHttp.readyState )
    {
        xmlHttp.abort( );
        xmlHttp = false;
    }
        
    // wenn möglich, neues XMLHttpRequest-Objekt erzeugen, sonst abbrechen
    if( !xmlHttp )
    {
        xmlHttp = getXMLRequester( );
        if( !xmlHttp )
            return;
    }
    
    // Falls die zu sendenden Daten mit einem & oder einem ? beginnen, erstes Zeichen abschneiden
    if( intType != 1 && ( strData && strData.substr( 0, 1 ) == '&' || strData.substr( 0, 1 ) == '?' ))
        strData = strData.substring( 1, strData.length );

// Als Rückgabedaten die gesendeten Daten, oder die Zieladresse setzen
    var dataReturn = strData ? strData : strSource;
    
    switch( intType )
    {
        case 1:    //Falls Daten in XML-Form versendet werden, xml davorschreiben
            strData = "xml=" + strData;
        case 2: // falls Daten per POST versendet werden
            // Verbindung öffnen 
            xmlHttp.open( "POST", strSource, true );
            xmlHttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlHttp.setRequestHeader( 'Content-length', strData.length );
            break;
        case 3: // Falls keine Daten versendet werden
            // Verbindung zur Seite aufbauen
            xmlHttp.open( "HEAD", strSource, true );
            strData = null;
            break;
        default: // Falls Daten per GET versendet werden
            //Zieladresse zusammensetzen aus Adresse und Daten
            var strDataFile = strSource + (strData ? '?' + strData : '' );
            // Verbindung aufbauen
            xmlHttp.open( "GET", strDataFile, true );
            strData = null;
    }
    
    // die Funktion processResponse als Event-handler setzen, wenn sich der Verarbeitungszustand der 
    xmlHttp.onreadystatechange = new Function( "", "processResponse(" + intID + ")" ); ;

    // Anfrage an den Server setzen
    xmlHttp.send( strData );    //strData enthält nur dann Daten, wenn die Anfrage über POST passiert

    // gibt die gesendeten Daten oder die Zieladresse zurück
    return dataReturn;
}


function processResponse( intID )
{
    //aktuellen Status prüfen
    switch( xmlHttp.readyState )
    {
        //nicht initialisiert
        case 0:
        // initialisiert
        case 1:
        // abgeschickt
        case 2:
        // ladend
        case 3:
            break;
        // fertig
        case 4:    
            // Http-Status überprüfen
            if( xmlHttp.status == 200 )    // Erfolg
            {
                processData( xmlHttp, intID ); //Daten verarbeiten
            }
            //Fehlerbehandlung
            else
            {
                if( window.handleAJAXError )
                    handleAJAXError( xmlHttp, intID );
                else
                    alert( "ERROR\n HTTP status = " + xmlHttp.status + "\n" + xmlHttp.statusText ) ;
            }
    }
}

// handle response errors
function handleAJAXError( xmlHttp, intID )
{
alert("fehler");
}


function processData( xmlHttp, intID )
{
    // process text data
    updateMenu( xmlHttp.responseText );
}




function updateMenu(str)
{
 //Selectbox mit Namen unterprojekt leeren
 document.eprooform.unterprojekt.length = 0;
 //Antwort vom Server ist eine Kommagetrente Liste
 //Daraus ein Array machen und in elems speichern
 var elems = str.split(",");
 //Aus jedem Element des Arrays eine neue Option machen und an die Box anfügen
 for (var i = 0;i < elems.length; i++)
 {
  neu = new Option(elems[i],elems[i],false,false);
  document.eprooform.unterprojekt.options[document.eprooform.unterprojekt.length] = neu;
 }
  //Neue Select-Box sichtbar machen
  document.getElementById("selectunterprojekt").style.display="block";
}

// globales XMLHttpRequest-Objekt erzeugen
var xmlHttp = getXMLRequester();


//Request aufrufen
function fillUnterprojekt()
{
      strSource = "ajax/select.php";
      strData = "id=" + document.eprooform.projekt.value;
      intType= 0; //GET
      intID = 1;
      sendRequest(strSource,strData,intType,intID);
}


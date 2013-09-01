
<h1>
Erweiterte Suche
</h1>
<p>Geben Sie Ihren Suchtext ein und klicken dann auf "Suchen". <br>Sollten Sie nicht das gew&uuml;nschte 
Produkt finden wenden Sie sich bitte an unsere Techniker unter Tel. 0821 27 95 99 0.</p>
<br><br>
<center>

<table border="0">
<tr><td>Stichwort:</td><td><input type="text" size="30"></td></tr>
<tr><td>Hersteller:</td><td><select><option>Atmel</option><option>Olimex</option></select></td></tr>
<tr><td>Preis ab:</td><td><input type="text" size="10"></td></tr>
<tr><td>Preis bis:</td><td><input type="text" size="10"></td></tr>
<tr><td>Nur lagernde Artikel:</td><td><input type="checkbox"></td></tr>
<tr><td></td><td><input type="submit" value="Suchen"></td></tr>

</table>
</center>


<h1>Ergebnisse f&uuml;r die Suche</h1>

<div class="exampleIntro">
  <p>Die Ergebnisse im folgenden k&ouml;nnen im sortiert und seitenweise durchgebl&auml;ttert werden.
</p>
    <br>
</div>
<center>
<!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

<div id="dynamicdata"></div>

<script type="text/javascript">
YAHOO.example.DynamicData = function() {
    // Column definitions
    var myColumnDefs = [ // sortable:true enables sorting
        {key:"id", label:"ID", sortable:true},
        {key:"name", label:"Name", sortable:true},
        {key:"date", label:"Date", sortable:true, formatter:"date"},
        {key:"price", label:"Price", sortable:true},
        {key:"number", label:"Number", sortable:true}
    ];

    // Custom parser
    var stringToDate = function(sData) {
        var array = sData.split("-");
        return new Date(array[1] + " " + array[0] + ", " + array[2]);
    };
    
    // DataSource instance
    var myDataSource = new YAHOO.util.DataSource("./js/yui/examples/datatable/assets/php/json_proxy.php?");
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
    myDataSource.responseSchema = {
        resultsList: "records",
        fields: [
            {key:"id", parser:"number"},
            {key:"name"},
            {key:"date", parser:stringToDate},
            {key:"price",parser:"number"},
            {key:"number",parser:"number"}
        ],
        metaFields: {
            totalRecords: "totalRecords" // Access to value in the server response
        }
    };
    
    // DataTable configuration
    var myConfigs = {
        initialRequest: "sort=id&dir=asc&startIndex=0&results=25", // Initial request for first page of data
        dynamicData: true, // Enables dynamic server-driven data
        sortedBy : {key:"id", dir:YAHOO.widget.DataTable.CLASS_ASC}, // Sets UI initial sort arrow
        paginator: new YAHOO.widget.Paginator({ rowsPerPage:25 }) // Enables pagination 
    };
    
    // DataTable instance
    var myDataTable = new YAHOO.widget.DataTable("dynamicdata", myColumnDefs, myDataSource, myConfigs);
    // Update totalRecords on the fly with value from server
    myDataTable.handleDataReturnPayload = function(oRequest, oResponse, oPayload) {
        oPayload.totalRecords = oResponse.meta.totalRecords;
        return oPayload;
    }
    
    return {
        ds: myDataSource,
        dt: myDataTable
    };
        
}();
</script>

</center>

<script type="text/javascript" src="./js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({  
  mode : "exact",
  theme : "advanced",
  skin: "o2k7",
  elements : "beschreibung",
  plugins : "tinyautosave",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_buttons1: "tinyautosave,|,bullist,numlist,image,formatselect",
  theme_advanced_buttons2: "",
  theme_advanced_buttons3: "",
  theme_advanced_buttons4: ""
});
</script>

<script type="text/javascript" src="./js/kalender/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="./js/kalender/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<div style="width:100%;">
    <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Neue Ausgabe hochladen</div>
    <br>
    <br>
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

<br>[MESSAGE]<br>

<form action="" method="post" name="uploadform" enctype="multipart/form-data">
<table width="70%" border="0" class="article">
  <tr>
    <td>Ausgabenname:</td>
    <td><input type="text" size="50" name="name" /></td>
  </tr>
  <tr> 
    <td>Beschreibung</td>
    <td><textarea name="beschreibung" style="width:99%;height:200px"></textarea></td>
  </tr>
  <tr> 
    <td>PDF-Datei:</td>
    <td><input type="hidden" name="pdfcomplete" value="1"><input type="file" name="pdf" size="35" /></td>
  </tr>
  <tr> 
    <td>Bild f&uuml;r Gro&szlig;ansicht:<br>(382x539 Pixel)</td>
    <td><input type="hidden" name="imagecomplete" value="1"><input type="file" name="image" size="35" /></td>
  </tr>
  <tr> 
    <td>Thumbnail:<br>(150x211 Pixel)</td>
    <td><input type="hidden" name="thumbnailcomplete" value="1"><input type="file" name="thumbnail" size="35" /></td>
  </tr>
  <tr> 
    <td>Erscheinungsdatum:</td>
    <td><input type="text" size="10" name="datum" id="datum"/> <input type="button" value="Datum" onclick="displayCalendar(document.forms[0].datum,'dd.mm.yyyy',this)"></td>
  </tr>
  <tr> 
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" name="submit" value="Hochladen"></td>
  </tr>   
</table>
</form> 
</div>

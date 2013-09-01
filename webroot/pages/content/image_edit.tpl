<div style="width:100%;">
    <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Bilderupload - Bild &auml;ndern</div>
    <br>
    <br>
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

<br>[MESSAGE]<br>

<form action="" method="post" name="editimageupload" enctype="multipart/form-data">
<table width="60%" border="1" class="article">
  <tr>
    <td><input type="checkbox" name="editimage" value="1"></td> 
    <td>Bild:</td>
    <td><input type="hidden" name="imagecomplete" value="1"><input type="file" name="image" size="40" /><br>Aktuelles Bild: [IMAGE]&nbsp;[DATUM]</td>
  </tr>
  <tr> 
    <td><input type="checkbox" name="editthumbnail" value="1"></td> 
    <td>Thumbnail: (optional)</td>
    <td><input type="hidden" name="thumbnailcomplete" value="1"><input type="file" name="thumbnail" size="40" /><br>Aktuelles Thumbnail: [THUMBNAIL]&nbsp;[THUMBNAILDATUM]</td>
  <tr> 
    <td></td> 
    <td>Text: (optional)</td>
    <td><input type="text" size="40" name="text" value="[TEXT]"></td>
  </tr>
  <tr> 
    <td colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right"><input type="submit" name="cancel" value="Abbrechen">&nbsp; <input type="submit" name="submit" value="Hochladen"></td>
  </tr>   
</table>
</form>
<hr>
<br>
[INDEX]
<br>
<table width="100%" border="1">
<tr>
  <td>Vorschau</td>
  <td>Name</td>
  <td>Text</td>
  <td>Datum</td>
  <td align="center">Links</td>
  <td align="center">Aktion</td>
</tr>
[IMAGETABLE]
</table>
<br>
[INDEX]
</div>

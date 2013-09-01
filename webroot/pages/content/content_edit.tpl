<script type="text/javascript" src="./js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({  
  mode : "exact",
  theme : "advanced",
  skin: "o2k7",
  elements : "inhalt",
  plugins : "tinyautosave",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_buttons1: "tinyautosave,|,bold,|,bullist,numlist,image,link,code,formatselect",
  theme_advanced_buttons2: "",
  theme_advanced_buttons3: "",
  theme_advanced_buttons4: ""

});
</script>

<div stlye="width:100%;">
  <div style="font-size:16pt; font-weight:bold; width: 100%; padding-bottom:10px; border-bottom: 1px solid black; ">Seite editieren</div>
<br>
<form action="" method="Post" name="inhaltform">
  <textarea id="inhalt" name="inhalt" style="width:100%; height:500px;">[INHALTSTEXT]</textarea>
  <br>
  <center><input type="submit" name="cancel" value="Abbrechen" /> <input type="submit" name="saveinhalt" value="Speichern" /></center>
</form>

</div>

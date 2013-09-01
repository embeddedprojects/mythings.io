<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="robots" content= "ALL" />
    <meta name="description" content= "" />
    <meta name="keywords" content= "" />
    <meta name="classification" content= "" />
    <meta name="author" content= "" />
    <meta name="reply-to" content= "" />
    <meta name="copyright" content= "" />

    <title>embedded projects GmbH</title>

    <link href="./themes/default/css/main.css" rel="stylesheet" type="text/css" media="screen">
    
    <!-- implementiere Fancybox -->
    <link rel="stylesheet" href="./js/fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen">
    <script type="text/javascript" src="./js/fancybox/jquery.js"></script>
    <script type="text/javascript" src="./js/fancybox/jquery.fancybox-1.2.6.js"></script> 
      
    <script type="text/javascript">
      // Einzelnes Bild
      $(document).ready(function() { 
	// Einzelnes Bild
	$("a.single_image").fancybox();

	// Gruppe von Bildern
	$("a.group").fancybox({
	  'hideOnContentClick': false
	}); 
      })
    </script>  

    <!-- Browserunterscheidung -->
    <script type="text/javascript">
      if(navigator.appName=="Microsoft Internet Explorer"){
      document.writeln("<link rel='stylesheet' type='text/css' href='./css/iemain.css'>");
    } else {
      document.writeln("<link rel='stylesheet' type='text/css' href='./css/main.css'>");
    }
    </script>
<script type="text/javascript" src="./js/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="./js/build/dragdrop/dragdrop-min.js"></script>

<link type="text/css" rel="stylesheet" href="./js/yui/build/carousel/assets/skins/sam/carousel.css">
<script src="./js/yui/build/utilities/utilities.js"></script>
<script src="./js/yui/build/carousel/carousel-min.js"></script>

<link rel="stylesheet" type="text/css" href="./js/yui/build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="./js/yui/build/datatable/assets/skins/sam/datatable.css" />
<script type="text/javascript" src="./js/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>

<script type="text/javascript" src="./js/yui/build/connection/connection-min.js"></script>
<script type="text/javascript" src="./js/yui/build/json/json-min.js"></script>
<script type="text/javascript" src="./js/yui/build/element/element-min.js"></script>
<script type="text/javascript" src="./js/yui/build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="./js/yui/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="./js/yui/build/datatable/datatable-min.js"></script>
<link rel="stylesheet" type="text/css" href="./js/yui/build/tabview/assets/skins/sam/tabview.css" />

<link rel="stylesheet" type="text/css" href="./js/yui/build/datatable/assets/skins/sam/datatable.css" />
<script type="text/javascript" src="./js/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>

<script type="text/javascript" src="./js/yui/build/tabview/tabview-min.js"></script>

  
  </head>
  <body class="yui-skin-sam">
<center>
  <div id="wrapper" align="left">
    <div id="navTop">
      <ul id="navlist">
        <li><a  href="index.php?page_id=1" target=""  class="firstnav_active" title="">Online-Shop</a></li>
        <li><a  href="index.php?module=platine&action=demo" target=""  class="" title="">Platinen Designer</a></li>
        <li><a  href="index.php?module=platine&action=demo" target=""  class="" title="">EP Journal</a></li>
        <li><a  href="index.php?page_id=5" target=""  class="" title="">Hersteller</a></li>
<!--        <li><a  href="index.php?page_id=6" target=""  class="" title="">Bestellfax</a></li>-->
        <li><a  href="index.php?page_id=7" target=""  class="" title="">Warenkorb</a></li>
        <li><a  href="index.php?page_id=7" target=""  class="" title="">Kasse</a></li>
        <li><a  href="index.php?page_id=7" target=""  class="" title="">Kontakt</a></li>
      </ul>
    </div>
    <div id="navSearch">
      <div id="navSearch1">Herzlich Willkommen!</div>
      <div id="navSearch2">
        Kennen Sie bereits unsere Internetseiten: 
	      <a href="http://shop.embedded-projects.net/" target="_blank" class="breadcrump">Online-Shop</a>&nbsp;|&nbsp;
	      <a href="http://www.eproo-student.de" target="_blank" class="breadcrump">Uni-Shop</a>&nbsp;|&nbsp;
	      <a href="http://www.ep-journal.de/" target="_blank" class="breadcrump">Journal</a>
      </div>
      <div id="navSearch3">
        <form action="index.php?module=suche&action=mask" method="post">
	       Suche:&nbsp;<input name="search" type="text" size="15">
	       <input id="submit" type="submit" value="Suche">
	      </form>
      </div>
    </div>
    
    <div id="header">
      <div class="header">
        <h1>embedded projects GmbH </h1>
      </div>
      <div class="flags">
      <img src="./themes/default/images/de.png">
      <img src="./themes/default/images/en.png">
      </div>
    </div>
      [PAGE] 


    <div id="footer">
        <ul>
	  <li><a href="index.php?page_id=7" style="text-decoration:none">Kontakt</a></li>
	  <li><a href="index.php?page_id=30" style="text-decoration:none">Impressum</a></li>
	  <li>&copy; Copyright 2010 embedded projects GmbH</li>
	</ul>
<br><center><table><tr><td align="center"><p style="color: #999">Bekannt aus:</p></td></tr><tr><td><img src="./themes/default/images/bekannt_banner.jpg"></td></tr></table></center>
    </div> 
  </div> 
</center>
  </body>
  </html>

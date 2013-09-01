
<h2>Getting started with myThings.io</h2>
The idea is, many things has got barcodes. With an easy barcode
scanner, a webcam and  the internet you can easy archive these things.

MyThings.io is an Open-Source Project. That means you can
build your own Reader and integrate this into our application.
<br><br><img src="./themes/mythings/images/scanner_mythings.jpg" align="left" style="padding-right:30px">
<p>To start with myThings.io you need:<br>
<ul style="left:30px;position:relative">
<li>myThings.io Scanner (Hardware)</li>
<li>myThings.io Login (Account)</li>
<li>myThings.io Auth (Security Token)</li>
</ul>
<br>
The Login you can create easily <a href="index.php?module=register&action=list">here</a>. The scanner needs some more work. You can easy build an own scanner with an old webcam, barcode scanner and an embedded linux board like the gnublin or raspberrypi.
</p>
After the scanner is ready you have to combine your account with your scanner. This you can to easily with your private auth code in your web account.

<br>
<br>
<br>
<br>



<h2>Build your own Reader</h2>
The heart of the scanner is an embedded linux board. Every time you scan an barcode an image is created and sent together with the barcode into your myThings account. 
<br><br>
Material list:
<br>
<br>
<ul>
<li>GNUBLIN or RaspberryPi, Elektor Linux Board with 32 MB RAM</li>
<li>Barcode Scanner (<a href="http://www.amazon.de/TaoTronics%C2%AE-TT-BS003-Barcodescanner-automatisch-Lesebreite/dp/B005J2WWWI/ref=sr_1_12?ie=UTF8&qid=1372748143&sr=8-12&keywords=barcode+scanner&gclid=COaHmZzg77gCFYtY3god8wEAHA" target="_blink">link</a>)</li>
<li>Webcam (<a href="http://shop.embedded-projects.net/index.php?module=artikel&action=artikel&id=2060"  target="_blink">link</a>)</li>
<li>WLAN or LAN connection (<a href="shop.embedded-projects.net/index.php?module=artikel&action=artikel&id=2515" target="_blink">link</a>)</li>
<li>USB Hub (<a href="">link</a>)</li>
</ul>
First step you have to mount the hardware together. If this is ready you can start to build an sd card with an mythings.io operating system, or if you an expert you can also setup an own scanner box.
<img src="./themes/mythings/images/scanner_components_small.JPG" style="padding-right:30px">

<h3>Connect all on the desk</h3>
Start with the electronic parts. Put all things together.
<br><br>

<ul>
<li>Connect the barcode scanner, wlan adapter and webcam to the hub</li>
<li>Connect USB RS232 from GNUBLIN first time to you pc (later you can put the cable also into the hub)</li>
<li>Power the USB hub with an power adapter</li>
</ul>

<h3>Create your SD card</h3>
Prepare sd card for the firmware. You can download the image here:

<ul>
<li>GNUBLIN (32 MB RAM)</li>
</ul>

After the download you can move the image with linux:

<pre>dd if=image.bin of=/dev/sdX</pre>

Change the X to your recognized device letter. You can find them with
<pre>dmesg</pre>

In Windows you can use the Tool: <a href="http://sourceforge.net/projects/win32diskimager/" target="_blank">Win32 Disk Imager</a> to put the image on a sd card.

<h3>The case</h3>

After you put the sd card into the board an put the things together, you can start with the case.
We build it with wood. You need two plates for top and bottom and a thicker one (about 2 cm) for
the middle framework. After you saw the wood you can color it.
<br><br>With screws all plates can be combine.<br><br>

<img src="./themes/mythings/images/scanner_open.JPG" style="padding-right:30px">

<h3>Reader</h3>

Put barcode scanner and webcam together. With an scan of the barcode an easy
image is automatically taken. So you can better remember what this thing was.

At the moment out see you thing only from bottom. We try to find a soltution to
take an image from top.
<br>
<br>
<img src="./themes/mythings/images/scanner_webcam.JPG" style="padding-right:30px">

<h3>First test</h3>



<h2>Activate your Scanner</h2>

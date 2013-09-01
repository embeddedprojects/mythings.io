<?


echo "Start Scanner\r\n";

function mybase64_encode($s) {
    return str_replace(array('+', '/'), array(',', '-'), base64_encode($s));
}

while(1)
{
  $barcode =  exec("/root/test");

  if($barcode != "")
  {
    system("fswebcam -r 320x240 -d /dev/video0 -i 0 /tmp/out.jpeg");
    $file = file_get_contents('/tmp/out.jpeg'); 

    $file_base64 = mybase64_encode($file);

    system("curl -d \"image=".$file_base64."\" \"http://www.mythings.io/index.php?module=mythingsapi&action=add&barcode=$barcode\"");


  }

}


?>


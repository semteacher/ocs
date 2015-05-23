<!DOCTYPE html>

<style>
a {color:blue;font-size:12pt;}
body {background:White;}
</style>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OJS-OCS XML Locale Sync</title>
</head>
<body>
<h2>OJS-OCS XML Locale Data Values Sync</h2>
<form action="localesync.php" method="post" enctype="multipart/form-data">
    <div>
    Select source file to sync:
    <input type="file" name="sourcefile" id="sourcefile">
    </div>
    <div>
    Select destination file to sync:
    <input type="file" name="destfile" id="destfile">
    </div>
    <input type="submit" value="Sync Process..." name="submit">
</form>
</body>
</html>

<?php
echo 'ready';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
var_dump($_POST);
var_dump($_FILES);

$xmlsource=simplexml_load_file($_FILES['sourcefile']['tmp_name']) or die("Error: Cannot open source object");
$xmldest=simplexml_load_file($_FILES['destfile']['tmp_name']) or die("Error: Cannot open destination object");
print_r($xmlsource->message[1]['key']);
//print_r($xmlsource->message[1]);
print_r("<br>====================================<br>");
    foreach ($xmlsource->message as $xmlsourceinfo):
        $mkey= (string) $xmlsourceinfo['key'];
        $mtext= (string) $xmlsourceinfo;
        print_r($mkey);
        print_r("<br>");
        print_r($mtext);
        //var_dump($key);
        //var_dump($xmlsourceinfo);
        //echo '<li><div class="key">'$key'</div><div class="text">'$text'</li>n';
        print_r("<br>:::::::::::::::::::::::::::::::::::::<br>"); 
        $myDataObjects = $xmldest->xpath('/locale/message[@key="'.$mkey.'"]');

        if ($myDataObjects!=FALSE) {
                var_dump($myDataObjects);
        $mkeydest= (string) $myDataObjects[0]['key'];
        $mtextdest= (string) $myDataObjects[0];
        print_r($mkeydest);
        print_r("<br>");
        print_r($mtextdest);
        $repmyDataObject = $myDataObjects[0];
        //$repmyDataObject{0}=$mtext;
        $repmyDataObject{0}= $xmlsourceinfo;
        print_r("<br>");
        $mtextdest= (string) $myDataObjects[0];
        print_r($mtextdest);
        }
        print_r("<br>-------------------------------<br>");        
    endforeach;
print_r("<br>=====================================<br>");    
var_dump($xmldest);
  $dom = new DOMDocument('1.0');
  $dom->preserveWhiteSpace = false;
  $dom->formatOutput = true;
  $dom->loadXML($xmldest->asXML());
  echo $dom->save($_FILES['destfile']['name']);
//$xmldest->asXML($_FILES['destfile']['name']);
}
?>
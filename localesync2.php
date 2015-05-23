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
<form action="localesync2.php" method="post" enctype="multipart/form-data">
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
//check is the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    var_dump($_FILES);

   // $xmlsource=simplexml_load_file($_FILES['sourcefile']['tmp_name']) or die("Error: Cannot open source object");
   // $xmldest=simplexml_load_file($_FILES['destfile']['tmp_name']) or die("Error: Cannot open destination object");
    //open source file
    $domsource = new DOMDocument('1.0');
    $domsource->load($_FILES['sourcefile']['tmp_name']);
    //open destination
    $domdest = new DOMDocument('1.0');
    $domdest->load($_FILES['destfile']['tmp_name']);
    //$domsource->childNodes->item(0)->replaceChild() attributes-> getNamedItem()
    //print $domsource->saveXML();
    //get nodelist by tag name
    $sourcenodes = $domsource->getElementsByTagName('message');
    $destnodes = $domdest->getElementsByTagName('message');
    var_dump($destnodes);
    //process nodelist
    foreach ($sourcenodes as $nodecontent) {
        if ($nodecontent->hasAttributes()) {
            $localekeyvalue = $nodecontent->attributes->getNamedItem('key');
            $localekeyval = $nodecontent->getAttribute('key');
            //process just nodes with existed 'key' attribute
            if (!is_null($localekeyval)) {
                var_dump($nodecontent->nodeValue);
                //foreach ($destnodes as $destnodecontent) {
                //    if ($destnodecontent->getAttribute('key') == $localekeyval)
                //    {
                //        var_dump($destnodecontent);
                //        echo "---founded-00-<br>";
                //        $destnodecontent->parentNode->replaceChild($nodecontent, $destnodecontent);
                //    }
                //}
                $i = $destnodes->length - 1;
                while ($i > -1) {
                    $destnodecontent = $destnodes->item($i);
                    if ($destnodecontent->getAttribute('key') == $localekeyval) {
                        echo "---founded-00-<br>";
                        $nodecontent = $domdest->importNode($nodecontent, true);
                        //$newelement = $domdest->createTextNode('Some new node!');
                        //$destnodecontent->parentNode->replaceChild($newelement, $destnodecontent);
                        $destnodecontent->parentNode->replaceChild($nodecontent, $destnodecontent);
                    }

                    $i--;
                }
                    $text = $nodecontent->firstChild->nodeValue;
                //$title = $video->getElementsByTagName('title')->item(0)->nodeValue;
                //$id    = ??
                //$thumb = ??
                var_dump($nodecontent->attributes);
                //print_r($nodecontent->attributes);
                $length = $nodecontent->attributes->length;
                $name = $nodecontent->attributes->item(0)->name;

                echo "nodecontent: attribute `$name`<br>";
                echo "nodecontent: attribute `$localekeyval`<br>";
                echo "nodecontent: attribute length `$length`<br>";
                //for ($i = 0; $i < $length; ++$i) {
                //    $name = $nodecontent->attributes->item($i)->name;
                //    $value = $nodecontent->attributes->item($i)->value;
                //$h1->removeAttribute($name);
                //    echo "nodecontent: attribute `$name`<br>";
                //    echo "nodecontent: attribute `$value`<br>";
                //echo "nodecontent: attribute `$nodecontent->attributes->item($i)->nodeValue`<br>";
                //}
                //print($nodecontent->attributes);
                print_r('<br>1;;;;;;;;;;;;<br>');
                var_dump($nodecontent->firstChild);
                print_r('<br>2;;;;;;;;;;;;<br>');
                var_dump($text);
                print_r('<br>3;;;;;;;;;;;;<br>');
                print_r($text);
                print_r('<br>/////<br>');
            }
        }
    }

    echo $domdest->save($_FILES['destfile']['name']);


//  $dom = new DOMDocument('1.0');
//  $dom->preserveWhiteSpace = false;
//  $dom->formatOutput = true;
//  $dom->loadXML($xmldest->asXML());
//  echo $dom->save($_FILES['destfile']['name']);

//$xmldest->asXML($_FILES['destfile']['name']);
}
?>
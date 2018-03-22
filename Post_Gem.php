<?php
include "WISA-Connection.php";
include "XML_Connection.php";
// /**
$res=$client->GetXMLData($auth,'BI_GEMEENT','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $POST_GEM){
            echo $POST_GEM." - ".$i;
            echo "<br />";
            ++$i;
        }
        echo "<br /><br />";
        $i = 0;
    }
}
// */
/**
$res=$client->GetCSVData($auth,'BI_GEMEENT','',true,';','');
echo $res;
*/

/**
0 id
3 postcode
4 postnummer
5 deelgemeente
6 fusiegemeente
*/
?>
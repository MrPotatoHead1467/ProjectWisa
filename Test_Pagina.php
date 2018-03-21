<?php
include "WISA-Connection.php";
include "XML_Connection.php";
/**
$sql = "SELECT * FROM tbl_landen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_land_naam'];
        echo "<br />";
    }
}
*/

$res=$client->GetXMLData($auth,'BI_NAT','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $School){
            echo $School;
            /**
            if ($i == 0){
                $School_instelling_id = $School;
            }
            elseif ($i == 1){
                $School_naam = $School;
            }
            elseif ($i == 2){
                $School_postcode = $School;
            }
            elseif ($i == 3){
                $School_gemeente = $School;
            }
            ++$i;
            */
        }
        /**
        echo "Instellingsnummer: ".$School_instelling_id."<br />School: ".$School_naam."<br />Postcode: ".$School_postcode."<br />Gemeente: ".$School_gemeente."<br /><br />";
        */
    }
}
echo "test";
?>
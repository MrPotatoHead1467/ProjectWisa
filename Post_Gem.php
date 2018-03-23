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
            if ($i == 0){
                $Post_Id = mysqli_real_escape_string($conn, $POST_GEM);
            }
            elseif ($i == 3){
                $Postcode = mysqli_real_escape_string($conn, $POST_GEM);
            }
            elseif ($i == 4){
                $Postnummer = mysqli_real_escape_string($conn, $POST_GEM);
            }
            elseif ($i == 5){
                $Deelgemeente = mysqli_real_escape_string($conn, $POST_GEM);
            }
            elseif ($i == 6){
                $Fusiegemeente = mysqli_real_escape_string($conn, $POST_GEM);
            }
            elseif ($i == 8){
                $Land_Id = mysqli_real_escape_string($conn, $POST_GEM);
            }
            ++$i;
        }
        $sqlPost_Gem = "INSERT INTO tbl_postcodes";
        echo "Post_Id = ".$Post_Id."<br />";
        echo "Postcode = ".$Postcode."<br />";
        echo "Postnummer = ".$Postnummer."<br />";
        echo "Deelgemeente = ".$Deelgemeente."<br />";
        echo "Fusiegemeente = ".$Fusiegemeente."<br />";
        echo "Land_Id = ".$Land_Id."<br />";
        echo "<br />";

        
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
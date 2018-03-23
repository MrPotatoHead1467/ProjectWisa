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
            /**
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
        */
        }
        /**
        $sqlPost_Gem = "INSERT INTO tbl_postcodes (fld_postcode_nr, fld_woonplaats_naam, fld_postnummer, fld_fusiegemeente, fld_land_id_fk, fld_land_wisa_id_fk, fld_postcode_wisa_id) VALUES
                        ('".$Postcode."', '".$Deelgemeente."', '".$Postnummer."', '".$Fusiegemeente."', '21', '".$Land_Id."', '".$Post_Id."')";
        
        if (mysqli_query($conn, $sqlPost_Gem)){

        }
        else {
            echo "Error: " . $sqlPost_Gem . "<br>" . mysqli_error($conn);
        }
        $i = 0;
        */
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
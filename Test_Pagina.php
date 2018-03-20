<?php
include "WISA-Connection.php";
$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://10.0.5.1:8080/SOAP/WisaAPIService.wsdl');
$res=$client->GetXMLData($auth,'GEMEENTE','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $POST_GEM){
            if (is_numeric($POST_GEM)){
                $postcode = mysqli_real_escape_string($conn, $POST_GEM);
                $sqlPostcode = "INSERT INTO tbl_postcodes(fld_postcode_nr) VALUES ('".$postcode."')";
                if (mysqli_query($conn, $sqlPostcode)){
                    $Postcode_id = mysqli_insert_id($conn);
                }
                else {
                    echo "Error: " . $sqlPostcode . "<br>" . mysqli_error($conn);
                }
                
            }
            else {
                $gemeente = mysqli_real_escape_string($conn, $POST_GEM);
                $sqlGemeente = "UPDATE tbl_postcodes SET fld_woonplaats_naam='".$gemeente."' WHERE fld_postcode_id='".$Postcode_id."'";
                if (mysqli_query($conn, $sqlGemeente)){
                                    
                }
                else {
                    echo "Error: " . $sqlGemeente . "<br>" . mysqli_error($conn);
                }
            }
            
        }
    }
}
?>
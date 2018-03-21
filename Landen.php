<?php
include "WISA-Connection.php";

$sql = "SELECT * FROM tbl_landen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_land_naam'];
        echo "<br />";
    }
}
/**
$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://10.0.5.1:8080/SOAP/WisaAPIService.wsdl');
$res=$client->GetXMLData($auth,'BI_LAND','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Land){
            if ($i % 2 == 0){
                if ($Land == "???" || $Land == "??" || $Land == "?"){
                    $Afkorting = NULL;
                }
                else {
                    $Afkorting = mysqli_real_escape_string($conn, $Land);
                }
            }
            ++$i;
            
        }
        $Land = mysqli_real_escape_string($conn, $Land);
        $sqlLanden = "INSERT INTO tbl_landen (fld_land_naam, fld_land_afkorting) VALUES ('".$Land."', '".$Afkorting."')";
        if (mysqli_query($conn, $sqlLanden)){
            echo $Land." - ".$Afkorting.": Gelukt";
            echo "<br />";
        }
        else {
            echo "Error: " . $sqlLanden . "<br>" . mysqli_error($conn);
        }
    }
}
*/
?>
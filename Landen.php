<?php
include "WISA-Connection.php";

$sql = "SELECT * FROM tbl_landen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_land_naam']." - ".$row['fld_land_wisa_id'];
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
            if ($i == 0){
                $Land_Id = mysqli_real_escape_string($conn, $Land);
            }
            elseif ($i == 3){
                $Land_Naam = mysqli_real_escape_string($conn, $Land);
            }
            elseif ($i == 4){
                $Land_Afkorting = mysqli_real_escape_string($conn, $Land);
                if ($Land_Afkorting == '???' || $Land_Afkorting == '??' || $Land_Afkorting == '??'){
                    $Land_Afkorting = NULL;
                }
            }
            $i++;
        }
        
        $sqlLand = "INSERT INTO tbl_landen (fld_land_naam, fld_land_afkorting, fld_land_wisa_id) VALUES ('".$Land_Naam."', '".$Land_Afkorting."', '".$Land_Id."')";
        if (mysqli_query($conn, $sqlLand)){
            echo "Land_ID = ".$Land_Id."<br />";
            echo "Land_Naam = ".$Land_Naam."<br />";
            echo "Land_Afkorting = ".$Land_Afkorting."<br />";
            echo "!Gelukt!<br /><br />";
        }
        else {
            echo "Error: " . $sqlLand . "<br>" . mysqli_error($conn);
        }
        $i = 0;
    }
}
*/
/**
$res=$client->GetCSVData($auth,'BI_LAND','',true,';','');
echo $res;
*/
?>
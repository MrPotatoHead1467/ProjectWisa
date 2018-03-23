<?php
include "WISA-Connection.php";
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

$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://10.0.5.1:8080/SOAP/WisaAPIService.wsdl');
$res=$client->GetXMLData($auth,'BI_GODS','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Gods){
            echo $Gods."<br />";
            /**
            $sqlGods = "INSERT INTO tbl_godsdiensten (fld_godsdienst_naam) VALUES ('".$Gods."')";
            if (mysqli_query($conn, $sqlGods)){
                echo $Gods.": Gelukt";
                echo "<br />";
            }
            else {
                echo "Error: " . $sqlGods . "<br>" . mysqli_error($conn);
            }
            */
        }

    }
}

?>
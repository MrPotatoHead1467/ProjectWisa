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
echo "13";
$auth=array('Username'=>'API','Password'=>'API');
$client = new SoapClient("http://remote.wisa.be:60581/SOAP?service=LeerlingService");
$res=$client->FindLeerling($auth,'00091936134','Van Beneden','Maarten','19/09/2000');

// $auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
// $client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
// $res=$client->GetXMLData($auth,'BI_LAND','',5,'');

echo $res;
/**
$xml_SMART=simplexml_load_string($res);

$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Gods){
            echo $Gods."<br />";

        }

    }
}
*/
?>
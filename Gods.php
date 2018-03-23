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
// /**
$res=$client->GetXMLData($auth,'BI_GODS','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Gods){
            /**
            if ($i == 0){
                $Gods_Id = mysqli_real_escape_string($conn, $Gods);
            }
            elseif ($i == 5){
                $Code = mysqli_real_escape_string($conn, $Gods);
            }
            elseif ($i == 6){
                $Godsdienst = mysqli_real_escape_string($conn, $Gods);
            }
            elseif ($i == 7){
                $Afkorting = mysqli_real_escape_string($conn, $Gods);
            }
            ++$i;
            */
        }
        echo "Gods_Id = ".$Gods_Id."<br />";
        echo "Code = ".$Code."<br />";
        echo "Godsdienst = ".$Godsdienst."<br />";
        echo "Afkorting = ".$Afkorting."<br />";
        echo "<br />";
        $i = 0;
    }
}
// */
/**
$res=$client->GetCSVData($auth,'BI_GODS','',true,';','');
echo $res;
/**
$explode = explode(";",$res);
foreach ($explode as $exploded){
    echo $exploded."<br />";
}
// */
/**
0 Id
5 Code
6 Gods
7 Afk Gods
*/
?>
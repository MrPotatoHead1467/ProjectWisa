<meta charset="UTF-8">
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
$client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
// /**
$res=$client->GetXMLData($auth,'BI_SCHOOL','',5,'');

//  /**
$xml_SMART=simplexml_load_string($res);

$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
// /**
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Test => $School){
           echo $i." - ".$Test." - ".$School."<br />";
           ++$i;
        }
        echo "<br />";
        $i = 0;
    }
}
// */
 /**
$res=$client->GetCSVData($auth,'BI_SCHOOL','',true,';','');
// echo $res;
// /**
$i = 0;

$explode = explode(";",$res);
foreach ($explode as $exploded){
    echo $exploded."<br />";
    // echo $exploded."<br />";
}
$i=0;
// */
/**

*/
?>
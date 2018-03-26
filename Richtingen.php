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
$res=$client->GetXMLData($auth,'BI_RICHT','',5,'');

// /**
$xml_SMART=simplexml_load_string($res);
if ($xml_SMART === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
}
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
// /**
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Richting){
           echo $i." - ".$Richting;
           ++$i;
        }
        echo "<br />";
        $i = 0;
    }
}
// */
/**
$res=$client->GetCSVData($auth,'BI_RICHT','',true,';','');
// /**
$i = 0;
$explode = explode(";",$res);
foreach ($explode as $exploded){
    if ($exploded == ''){
        
    }
    echo $i."<br />";
    ++$i;
    
    // echo $exploded."<br />";
}
$i=0;
// */
/**

*/
?>
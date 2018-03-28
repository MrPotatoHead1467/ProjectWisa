<?php
session_start();

$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
$params = array( array('Name'=>'LL_ID','Value'=>'3534'));
$res=$client->GetXMLData($auth,'BI_LEERL',$params,5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $Name => $Value){
        echo $Name." - ".$Value."<br />";
    }
}
?>
<?php
$auth=array('Username'=>'API',

              'Password'=>'API',

              'Database'=>'Miniemen');

// $client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
$client = new SoapClient("WisaAPIService.wsdl",array('location'=>'http://remote.wisa.be:60580/SOAP/'));
$params = array(array('LL_ID'=>'3534'));           

$res=$client->GetXMLData($auth,'BI_LEERL',$params,5,'');
// $response = $client->__soapCall("GetXMLData", array($params));

$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Leerling){
           echo $i." - ".$Leerling;
           ++$i;
        }
        echo "<br />";
        $i = 0;
    }
}

?>

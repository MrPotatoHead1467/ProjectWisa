<?php
$auth=array('Username'=>'API',
              'Password'=>'API',
              'Database'=>'Miniemen');

$client = new SoapClient("WisaAPIService.wsdl",array('location'=>'http://10.0.5.1:8080/SOAP/'));

$params = array( array('Werkdatum'=>'wdatum',

                       'Value'=> $wdatum));           

$res=$client->GetXMLData($auth,'GEMEENTE',$params,5,'');

$xml_SMART=simplexml_load_string($res);
echo $xml_SMART;
?>
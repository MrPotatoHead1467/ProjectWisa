<?php
session_start();
include "WISA-Connection.php";
/* Create a class for your webservice structure, in this case: Contact */
class Credentials {
    function Credentials($username, $password) 
    {
        $this->Username = $username;
        $this->Password = $password;
    }
}

/* Initialize webservice with your WSDL */
$client = new SoapClient("http://remote.wisa.be:60581/SOAP?service=LeerlingService");

/* Fill your Contact Object */
$credentials = new Credentials("API", "API");
/* Set your parameters for the request */
$CommunicatieGegevens = array(
    "GSMleerling" => '0479 08 52 49',
    "EmailLeerling" => 'maarten.vanboven@gmail.com',
    "GSMVader" => '0497 26 75 15',
    "EmailVader" => ' joris.vanbeneden@skynet.be',
    "GSMMoeder" => '0471 74 90 79',
    "EmailMoeder" => 'marijs.meul@skynet.be',
    "BankrekeningIBAN" => '',
    "BankrekeningBIC" => '',
    "NoodTelefoon" => '',
    "NoodTelefoonBijID" => 1070,
);
$params = array(
    "LeerlingID" => $_SESSION['LL_ID'],
    "Credentials" => $credentials,
    "CommunicatieGegevens" => $CommunicatieGegevens
);

/* Invoke webservice method with your parameters, in this case: Function1 */
$response = $client->__soapCall("UpdateLeerlingCommunicatie", array($params));

/* Print webservice response */
$array = json_decode(json_encode($response), true);
foreach ($array as $Test){
    echo $Test;
    
}

?>
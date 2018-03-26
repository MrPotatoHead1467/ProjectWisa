<?php
session_start();
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
$params = array(
  "Credentials" => $credentials,
  "INSZNummer" => $_SESSION['EID_Rijksregisternr'],
  "Naam" => $_SESSION['EID_Achternaam'],
  "Voornaam" => $_SESSION['EID_Voornaam'],
  "Geboortedatum" => "2000-09-19",
  "EnkelZoekenOpINSZ" => FALSE
);

/* Invoke webservice method with your parameters, in this case: Function1 */
$response = $client->__soapCall("FindLeerling", array($params));

/* Print webservice response */
var_dump($response);
echo "<br /><br />";
$array = json_decode(json_encode($response), true);
foreach ($array as $Test){
    foreach ($Test as $test2){
        echo $test2;
    }
    
}

?>
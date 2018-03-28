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

$Personalia = array(
    "Naam" => 'Van Beneden',
    "Voornaam" => 'Jasper',
    "EMail" => 'jasper.vanbeneden@gmail.com',
    "GSM" => '0474 24 35 95',
    "OntvangtSMS" => false,
    "OntvangtEmail" => true,
    "Roepnaam" => 'Jasper',
    "AndereVoornamen" => '',
    "GeboortedatumOngekend" => false,
    "Geboortedatum" => '2005-05-19',
    "GeboorteGemeenteID" => '424',
    "NationaliteitID" => '48',
    "Rijksregisternummer" => '05051921959',
    "Geslacht" => 'M',
    "BankrekeningIBAN" => '',
    "BankrekeningBIC" => '',
    "NoodTelefoon" => '',
    "NoodTelefoonBijID" => 1070,
    "NoodTelefoonOntvangtSMS" => '',
    "VerblijfGeldigTot" => '1899-12-30T00:00:00'
);
$Vader = array(
    "Naam" => 'Van Beneden',
    "Voornaam" => 'Joris',
    "EMail" => ' joris.vanbeneden@skynet.be',
    "GSM" => '0497 26 75 15',
    "OntvangtSMS" => false,
    "OntvangtEmail" => true
);
$Moeder = array(
    "Naam" => 'Meul',
    "Voornaam" => 'Marijs',
    "EMail" => 'marijs.meul@skynet.be',
    "GSM" => '0471 74 90 79',
    "OntvangtSMS" => false,
    "OntvangtEmail" => true
);
$Adres = array(
    "Straat" => 'Duivestraat',
    "Nummer" => '23',
    "Bus" => '',
    "GemeenteID" => 426,
    "LandID" => 21,
    "Telefoon" => '016 22 41 06'
);

$LeerlingDetails = array(
    "Personalia" => $Personalia,
    "Vader" => $Vader,
    "Moeder" => $Moeder,
    "Adres" => $Adres,
);

$params = array(
    "Credentials" => $credentials,
    "LeerlingDetails" => $LeerlingDetails
);

/* Invoke webservice method with your parameters, in this case: Function1 */
$response = $client->__soapCall("AddLeerling", array($params));

/* Print webservice response */
$array = json_decode(json_encode($response), true);
foreach ($array as $Test){
    echo $Test;
    
}

?>
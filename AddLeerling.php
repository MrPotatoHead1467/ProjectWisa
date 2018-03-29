<?php
session_start();
include "WISA-Connection.php";
include "API_Connection.php";
$sqlLeerling = 'SELECT * FROM tbl_personen WHERE fld_persoon_id=""';

$Personalia = array(
    "Naam" => 'Van Beneden',
    "Voornaam" => 'Jasper',
    "EMail" => 'jasper.vanbeneden@gmail.com',
    "GSM" => '0474 24 35 95',
    "OntvangtSMS" => NULL,
    "OntvangtEmail" => NULL,
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
    "OntvangtSMS" => NULL,
    "OntvangtEmail" => NULL
);
$Moeder = array(
    "Naam" => 'Meul',
    "Voornaam" => 'Marijs',
    "EMail" => 'marijs.meul@skynet.be',
    "GSM" => '0471 74 90 79',
    "OntvangtSMS" => NULL,
    "OntvangtEmail" => NULL
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
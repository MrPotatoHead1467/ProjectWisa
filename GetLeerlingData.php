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
$params = array(
    "LeerlingID" => 4019,
    "Credentials" => $credentials
);

/* Invoke webservice method with your parameters, in this case: Function1 */
$response = $client->__soapCall("GetLeerlingData", array($params));

/* Print webservice response */
$array = json_decode(json_encode($response), true);
foreach ($array as $Test){
    foreach ($Test as $test2){
        foreach ($test2 as $Name => $Value){
            /**
            if ($Name == 'GemeenteID' || $Name == 'GeboorteGemeenteID'){
                $sql = "SELECT * FROM tbl_postcodes WHERE fld_postcode_wisa_id='".$Value."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Value = $row['fld_woonplaats_naam'];
                    }
                }
            }
            elseif ($Name == 'LandID'){
                $sql = "SELECT * FROM tbl_landen WHERE fld_land_wisa_id='".$Value."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Value = $row['fld_land_naam'];
                    }
                }
            }
            elseif ($Name == 'NationaliteitID'){
                $sql = "SELECT * FROM tbl_nationaliteiten WHERE fld_nation_wisa_id='".$Value."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Value = $row['fld_nation_nation'];
                    }
                }
            }
            */
            echo $Name." - ".$Value."<br />";
        }
    }
    
}

?>
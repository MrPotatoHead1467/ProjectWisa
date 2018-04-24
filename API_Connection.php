<?php

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

?>
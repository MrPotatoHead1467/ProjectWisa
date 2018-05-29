<?php
session_start();
include "WISA-Connection.php";
//include "API_Connection.php";
foreach($_POST as $name => $content) {
   $ArrayNaam = explode('_', $name);
   $Naam = $ArrayNaam[0];
   $Leerling_Id = $ArrayNaam[1];
}

if ($Naam == 'Goed'){
    $sqlLeerling_Persoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$Leerling_Id."'";
    $result = $conn->query($sqlLeerling_Persoon);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $Leerling_Naam = $row['fld_persoon_achternaam'];
            $Leerling_Voornaam = $row['fld_persoon_voornaam'];
            $Leerling_GB_Datum = $row['fld_persoon_gb_datum'];
            $Leerling_Geslacht = $row['fld_persoon_geslacht'];
            $Leerling_GB_Plaats = $row['fld_persoon_gb_plaats'];
            $Leerling_Nationaliteit = $row['fld_persoon_nation_id_fk'];
            $Leerling_Rijksregisternr = $row['fld_persoon_register_nr'];
            if ($Leerling_Rijksregisternr == NULL){
                $Leerling_Rijksregisternr = $row['fld_persoon_bis_nr'];
            }
            
            $sqlLeerling_GB_Plaats = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$Leerling_GB_Plaats."'";
            $result = $conn->query($sqlLeerling_GB_Plaats);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $Leerling_GB_Plaats = $row['fld_postcode_wisa_id'];
                }
            }
            
            $sqlLeerling_Nationaliteit = "SELECT * FROM tbl_nationaliteiten WHERE fld_nation_id='".$Leerling_Nationaliteit."'";
            $result = $conn->query($sqlLeerling_Nationaliteit);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $Leerling_Nationaliteit = $row['fld_nation_wisa_id'];
                }
            }
        }
    }
    $sqlLeerling_Ouders = "SELECT * FROM tbl_personen_linken WHERE fld_child_id_fk='".$Leerling_Id."'";
    $result = $conn->query($sqlLeerling_Ouders);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if ($row['fld_soort_id_fk'] == 1){
                $Moeder_Id = $row['fld_master_id_fk'];
            }
            elseif ($row['fld_soort_id_fk'] == 2){
                $Vader_Id = $row['fld_master_id_fk'];
            }
        }
    }
    
    if (isset($Moeder_Id)){
        $sqlMoeder_Persoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$Moeder_Id."'";
        $result = $conn->query($sqlMoeder_Persoon);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $Moeder_Naam = $row['fld_persoon_achternaam'];
                $Moeder_Voornaam = $row['fld_persoon_voornaam'];
                $Moeder_GB_Datum = $row['fld_persoon_gb_datum'];
                $Moeder_Geslacht = $row['fld_persoon_geslacht'];
            }
        }
        
        $sqlMoeder_Persoon_Gegeven = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$Moeder_Id."' AND fld_soort_id_fk='21'";
        $result = $conn->query($sqlMoeder_Persoon_Gegeven);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if (isset($Moeder_Gegeven_Id)){
                     array_push($Moeder_Gegeven_Id, $row['fld_gegeven_id_fk']);
                }
                else {
                    $Moeder_Gegeven_Id = array($row['fld_gegeven_id_fk']);
                }
            }
        }
        
        if (isset($Moeder_Gegeven_Id)){
            foreach ($Moeder_Gegeven_Id as $Key => $Waarde){
                $sqlMoeder_Gegeven = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$Waarde."'";
                $result = $conn->query($sqlMoeder_Gegeven);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        if ($row['fld_gegeven_soort_id_fk'] == 3){
                            $Moeder_GSM = $row['fld_gegeven_inhoud'];
                        }
                        elseif ($row['fld_gegeven_soort_id_fk'] == 2){
                            $Moeder_Telefoon = $row['fld_gegeven_inhoud'];
                        }
                        elseif ($row['fld_gegeven_soort_id_fk'] == 1){
                            $Moeder_EMail = $row['fld_gegeven_inhoud'];
                        }
                    }
                }
            }
        }
    }
    else{
        $Moeder_Naam = NULL;
        $Moeder_Voornaam = NULL;
        $Moeder_GB_Datum = NULL;
        $Moeder_Geslacht = NULL;
        $Moeder_GSM = NULL;
        $Moeder_Telefoon = NULL;
        $Moeder_EMail = NULL;
    }
    
    if (isset($Vader_Id)){
        $sqlVader_Persoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$Vader_Id."'";
        $result = $conn->query($sqlVader_Persoon);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $Vader_Naam = $row['fld_persoon_achternaam'];
                $Vader_Voornaam = $row['fld_persoon_voornaam'];
                $Vader_GB_Datum = $row['fld_persoon_gb_datum'];
                $Vader_Geslacht = $row['fld_persoon_geslacht'];
            }
        }
        
        $sqlVader_Persoon_Gegeven = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$Vader_Id."' AND fld_soort_id_fk='21'";
        $result = $conn->query($sqlVader_Persoon_Gegeven);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if (isset($Vader_Gegeven_Id)){
                     array_push($Vader_Gegeven_Id, $row['fld_gegeven_id_fk']);
                }
                else {
                    $Vader_Gegeven_Id = array($row['fld_gegeven_id_fk']);
                }
            }
        }
        
        if (isset($Vader_Gegeven_Id)){
            foreach ($Vader_Gegeven_Id as $Key => $Waarde){
                $sqlVader_Gegeven = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$Waarde."'";
                $result = $conn->query($sqlVader_Gegeven);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        if ($row['fld_gegeven_soort_id_fk'] == 3){
                            $Vader_GSM = $row['fld_gegeven_inhoud'];
                        }
                        elseif ($row['fld_gegeven_soort_id_fk'] == 2){
                            $Vader_Telefoon = $row['fld_gegeven_inhoud'];
                        }
                        elseif ($row['fld_gegeven_soort_id_fk'] == 1){
                            $Vader_EMail = $row['fld_gegeven_inhoud'];
                        }
                    }
                }
            }
        }
    }
    else{
        $Vader_Naam = NULL;
        $Vader_Voornaam = NULL;
        $Vader_GB_Datum = NULL;
        $Vader_Geslacht = NULL;
        $Vader_GSM = NULL;
        $Vader_Telefoon = NULL;
        $Vader_EMail = NULL;
    }
    
    $sqlLeerling_Adres_Link = "SELECT * FROM tbl_adressen_linken WHERE fld_persoon_id_fk='".$Leerling_Id."' AND fld_soort_id_fk='11'";
    $result = $conn->query($sqlLeerling_Adres_Link);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $Leerling_Adres_Id = $row['fld_adres_id_fk'];
        }
    }
    
    if (isset($Leerling_Adres_Id)){
        $sqlLeerling_Adres = "SELECT * FROM tbl_adressen WHERE fld_adres_id='".$Leerling_Adres_Id."'";
        $result = $conn->query($sqlLeerling_Adres);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $Leerling_Adres_Straat = $row['fld_adres_straatnaam'];
                $Leerling_Adres_Huisnr = $row['fld_adres_huis_nr'];
                $Leerling_Adres_Bus = $row['fld_adres_bus_nr'];
                $Leerling_Adres_Postcode = $row['fld_adres_postcode_id_fk'];
                $Leerling_Adres_Land = $row['fld_adres_land_id_fk'];
                
                $sqlLeerling_Postcode = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$Leerling_Adres_Postcode."'";
                $result = $conn->query($sqlLeerling_Postcode);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Leerling_Adres_Postcode = $row['fld_postcode_wisa_id'];
                    }
                }
            }
        }
    }
    $sqlLeerling_Persoon_Gegeven = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$Leerling_Id."' AND fld_soort_id_fk='21'";
    $result = $conn->query($sqlLeerling_Persoon_Gegeven);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if (isset($Leerling_Gegeven_Id)){
                 array_push($Leerling_Gegeven_Id, $row['fld_gegeven_id_fk']);
            }
            else {
                $Leerling_Gegeven_Id = array($row['fld_gegeven_id_fk']);
            }
        }
    }
    
    if (isset($Leerling_Gegeven_Id)){
        foreach ($Leerling_Gegeven_Id as $Key => $Waarde){
            $sqlLeerling_Gegeven = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$Waarde."'";
            $result = $conn->query($sqlLeerling_Gegeven);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    if ($row['fld_gegeven_soort_id_fk'] == 3){
                        $Leerling_GSM = $row['fld_gegeven_inhoud'];
                    }
                    elseif ($row['fld_gegeven_soort_id_fk'] == 2){
                        $Leerling_Telefoon = $row['fld_gegeven_inhoud'];
                    }
                    elseif ($row['fld_gegeven_soort_id_fk'] == 1){
                        $Leerling_EMail = $row['fld_gegeven_inhoud'];
                    }
                }
            }
        }
    }
    ///**
    echo "<br />";
    echo "Leerling_Id: ".$Leerling_Id."<br />";
    echo "Leerling_Voornaam: ".$Leerling_Voornaam."<br />";
    echo "Leerling_Naam: ".$Leerling_Naam."<br />";
    echo "Leerling_GB_Datum: ".$Leerling_GB_Datum."<br />";
    echo "Leerling_Geslacht: ".$Leerling_Geslacht."<br />";
    echo "Leerling_GB_Plaats: ".$Leerling_GB_Plaats."<br />";
    echo "Leerling_Nationaliteit: ".$Leerling_Nationaliteit."<br />";
    echo "Leerling_Rijksregisternr: ".$Leerling_Rijksregisternr."<br />";
    echo "GSM: ".$Leerling_GSM."<br />";
    echo "Telefoon: ".$Leerling_Telefoon."<br />";
    echo "Email: ".$Leerling_EMail."<br />";
    echo "<br />";
    echo $Moeder_Id."<br />";
    echo "Moeder_Voornaam: ".$Moeder_Voornaam."<br />";
    echo "Moeder_Naam: ".$Moeder_Naam."<br />";
    echo "Moeder_GB_Datum: ".$Moeder_GB_Datum."<br />";
    echo "Moeder_Geslacht: ".$Moeder_Geslacht."<br />";
    echo "GSM: ".$Moeder_GSM."<br />";
    echo "Telefoon: ".$Moeder_Telefoon."<br />";
    echo "Email: ".$Moeder_EMail."<br />";
    echo "<br />";
    echo $Vader_Id."<br />";
    echo "Vader_Voornaam: ".$Vader_Voornaam."<br />";
    echo "Vader_Naam: ".$Vader_Naam."<br />";
    echo "Vader_GB_Datum: ".$Vader_GB_Datum."<br />";
    echo "Vader_Geslacht: ".$Vader_Geslacht."<br />";
    echo "GSM: ".$Vader_GSM."<br />";
    echo "Telefoon: ".$Vader_Telefoon."<br />";
    echo "Email: ".$Vader_EMail."<br />";
    echo "<br />";
    echo "Adres_Straat: ".$Leerling_Adres_Straat."<br />";
    echo "Adres_Huisnr: ".$Leerling_Adres_Huisnr."<br />";
    echo "Adres_Bus: ".$Leerling_Adres_Bus."<br />";
    echo "Adres_Postcode: ".$Leerling_Adres_Postcode."<br />";
    echo "Adres_Land: ".$Leerling_Adres_Land."<br />";
    // */
    
    // Gegevens van de leerling 
    $Personalia = array(
        "Naam" => $Leerling_Naam, // OK
        "Voornaam" => $Leerling_Voornaam, // OK
        "EMail" => $Leerling_EMail, // OK
        "GSM" => $Leerling_GSM, // OK
        "OntvangtSMS" => NULL, 
        "OntvangtEmail" => NULL, 
        "Roepnaam" => $Leerling_Voornaam, // OK
        "AndereVoornamen" => '', // OK
        "GeboortedatumOngekend" => false,
        "Geboortedatum" => $Leerling_GB_Datum, // OK
        "GeboorteGemeenteID" => $Leerling_GB_Plaats, // OK
        "NationaliteitID" => $Leerling_Nationaliteit, // OK
        "Rijksregisternummer" => $Leerling_Rijksregisternr, // OK
        "Geslacht" => $Leerling_Geslacht, // OK
        "BankrekeningIBAN" => '',
        "BankrekeningBIC" => '',
        "NoodTelefoon" => '',
        "NoodTelefoonBijID" => 1070,
        "NoodTelefoonOntvangtSMS" => '',
        "VerblijfGeldigTot" => '1899-12-30T00:00:00'
    );
    // Gegevens van de vader 
    $Vader = array(
        "Naam" => $Vader_Naam, // OK
        "Voornaam" => $Vader_Voornaam, // OK
        "EMail" => $Vader_EMail, // OK
        "GSM" => $Vader_GSM, // OK
        "OntvangtSMS" => NULL,
        "OntvangtEmail" => NULL
    );
    // Gegevens van de moeder 
    $Moeder = array(
        "Naam" => $Moeder_Naam, // OK
        "Voornaam" => $Moeder_Voornaam, // OK
        "EMail" => $Moeder_EMail, // OK
        "GSM" => $Moeder_GSM, // OK
        "OntvangtSMS" => NULL,
        "OntvangtEmail" => NULL
    );
    // Administratief adres van de leerling 
    $Adres = array(
        "Straat" => $Leerling_Adres_Straat, // OK
        "Nummer" => $Leerling_Adres_Huisnr, // OK
        "Bus" => $Leerling_Adres_Bus, // OK
        "GemeenteID" => $Leerling_Adres_Postcode, // OK
        "LandID" => $Leerling_Adres_Land, // OK
        "Telefoon" => $Leerling_Telefoon // OK
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
    /**
    $response = $client->__soapCall("AddLeerling", array($params));
    
    $array = json_decode(json_encode($response), true);
    foreach ($array as $antwoord){
        if (is_numeric($antwoord)){
            $sql = "UPDATE tbl_inschrijvingen 
                    SET fld_inschrijving_status_id_fk=2 
                    WHERE fld_persoon_id_fk='".$Leerling_Id."'";
            if (mysqli_query($conn, $sql)){
                header('Location: WISA-Formulier.php?goedkeuren');
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        else {
            echo $antwoord;
        }
    }
    */
}
elseif ($Naam == 'Afgewezen'){
    $sql = "UPDATE tbl_inschrijvingen 
            SET fld_inschrijving_status_id_fk=3 
            WHERE fld_persoon_id_fk='".$Leerling_Id."'";
    if (mysqli_query($conn, $sql)){
        header('Location: WISA-Formulier.php?goedkeuren');
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
elseif ($Naam == 'Stand-by'){
    $sql = "UPDATE tbl_inschrijvingen 
            SET fld_inschrijving_status_id_fk=4 
            WHERE fld_persoon_id_fk='".$Leerling_Id."'";
    if (mysqli_query($conn, $sql)){
        header('Location: WISA-Formulier.php?goedkeuren');
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
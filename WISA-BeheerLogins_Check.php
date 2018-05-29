<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Login_Opslaan'])){
    /** Gegevens worden opgehaald */
    $School_Id = 2532;
    $Instelling = "Miniemen";
    $Voornaam = mysqli_real_escape_string($conn, $_POST['Voornaam_G']);
    $Achternaam = mysqli_real_escape_string($conn, $_POST['Achternaam_G']);
    $Naam = $Voornaam." ".$Achternaam;    
    $GB_Datum = mysqli_real_escape_string($conn, $_POST['GB_Datum_G']);    
    $Geslacht = mysqli_real_escape_string($conn, $_POST['Geslacht_G']);
    $Register_nr = mysqli_real_escape_string($conn, $_POST['Register_nr_G']);    
    
    $Gebruikersnaam = mysqli_real_escape_string($conn, $_POST['Gebruikersnaam']);
    $Wachtwoord = mysqli_real_escape_string($conn, $_POST['Wachtwoord']);
    $Beschrijving = mysqli_real_escape_string($conn, $_POST['Beschrijving_G']);
    
    if ($_SESSION['Bestaande_Persoon'] == 0){
        $sqlPersoon = "INSERT INTO tbl_personen(fld_persoon_voornaam, fld_persoon_achternaam, fld_persoon_naam, fld_persoon_gb_datum_onbekend, fld_persoon_gb_datum, fld_persoon_geslacht, fld_persoon_register_nr)
                   VALUES ('".$Voornaam."', '".$Achternaam."', '".$Naam."', '0', '".$GB_Datum."', '".$Geslacht."', '".$Register_nr."')";

    }
    else {            
        $sqlPersoon = "UPDATE tbl_personen SET fld_persoon_voornaam='".$Voornaam."', fld_persoon_achternaam='".$Achternaam."', fld_persoon_naam='".$Naam."', fld_persoon_gb_datum='".$GB_Datum."',
                       fld_persoon_geslacht='".$Geslacht."', fld_persoon_register_nr='".$Register_nr."' 
                       WHERE fld_persoon_id='".$_SESSION['Bestaande_Persoon_Id']."'";
    }
    echo $sqlPersoon;
    ///**
    if (mysqli_query($conn, $sqlPersoon)){
        $Persoon_Id = mysqli_insert_id($conn);
        if ($_SESSION['Bestaande_Persoon'] == 0){
            $sqlGebruiker = "INSERT INTO tbl_gebruikers(fld_school_id_fk, fld_persoon_id_fk, fld_gebruiker_naam, fld_gebruiker_wachtwoord, fld_gebruiker_instelling, fld_gebruiker_soort_id_fk, fld_gebruiker_beschrijving)
                           VALUES ('".$School_Id."', '".$Persoon_Id."', '".$Gebruikersnaam."', '".$Wachtwoord."', '".$Instelling."', '3', '".$Beschrijving."')";
    
        }
        else {            
            $sqlGebruiker = "UPDATE tbl_gebruikers SET fld_gebruiker_naam='".$Gebruikersnaam."', 
                                                       fld_gebruiker_wachtwoord='".$Wachtwoord."', 
                                                       fld_gebruiker_beschrijving='".$Beschrijving."' 
                                                       WHERE fld_persoon_id_fk='".$_SESSION['Bestaande_Persoon_Id']."'";
        }
        
        if (mysqli_query($conn, $sqlGebruiker)){
            $_SESSION['Bestaande_Persoon'] = 0;
            $_SESSION['Bestaande_Persoon_Id'] = '';
            $_SESSION['EID_Voornaam'] = '';
            $_SESSION['EID_Achternaam'] = '';
            $_SESSION['Geslacht'] = '';
            $_SESSION['EID_GB_Datum'] = '';
            $_SESSION['EID_Rijksregisternr'] = '';
            $_SESSION['Geen_Rijksregisternr'] = 0;
            $_SESSION['Gebruikersnaam_G'] = '';
            $_SESSION['Wachtwoord_G'] = '';
            $_SESSION['Beschrijving_G'] = '';
            header("Location: WISA-Formulier.php?logins");
        }
        else {
            echo "Error: " . $sqlGebruiker . "<br>" . mysqli_error($conn);
        }
    }
    else {
        echo "Error: " . $sqlPersoon . "<br>" . mysqli_error($conn);
    }
    //*/
}

if (isset($_POST['Login_Zoeken_btn'])){
    $Login_Zoeken = mysqli_real_escape_string($conn, $_POST['Login_Zoeken']);
    if ($Login_Zoeken == '' || $Login_Zoeken == 'undefined'){
        header("Location: WISA-Formulier.php?logins");
    }
    $sql = "SELECT * FROM tbl_gebruikers WHERE fld_gebruiker_id=".$Login_Zoeken;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $sqlPersoon_Zoeken = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$row['fld_persoon_id_fk'];
            $resultPersoon_Zoeken = mysqli_query($conn, $sqlPersoon_Zoeken);
            if (mysqli_num_rows($resultPersoon_Zoeken) > 0) {
                while($rowPersoon_Zoeken = mysqli_fetch_assoc($resultPersoon_Zoeken)){
                    $_SESSION['Bestaande_Persoon'] = 1;
                    $_SESSION['Bestaande_Persoon_Id'] = $rowPersoon_Zoeken['fld_persoon_id'];
                    $_SESSION['EID_Voornaam'] = $rowPersoon_Zoeken['fld_persoon_voornaam'];
                    $_SESSION['EID_Achternaam'] = $rowPersoon_Zoeken['fld_persoon_achternaam'];
                    $_SESSION['Geslacht'] = $rowPersoon_Zoeken['fld_persoon_geslacht'];
                    $_SESSION['EID_GB_Datum'] = $rowPersoon_Zoeken['fld_persoon_gb_datum'];
                    $_SESSION['EID_Rijksregisternr'] = $rowPersoon_Zoeken['fld_persoon_register_nr'];
                    $_SESSION['Gebruikersnaam_G'] = $row['fld_gebruiker_naam'];
                    $_SESSION['Wachtwoord_G'] = $row['fld_gebruiker_wachtwoord'];
                    $_SESSION['Beschrijving_G'] = $row['fld_gebruiker_beschrijving'];
                    header("Location: WISA-Formulier.php?logins");
                }
            }
        }
    }        
}

if (isset($_POST['Annuleer_G']))
    {
        $_SESSION['Bestaande_Persoon'] = 0;
        $_SESSION['Bestaande_Persoon_Id'] = '';
        $_SESSION['EID_Voornaam'] = '';
        $_SESSION['EID_Achternaam'] = '';
        $_SESSION['Geslacht'] = '';
        $_SESSION['EID_GB_Datum'] = '';
        $_SESSION['GB_Plaats'] = '';
        $_SESSION['EID_Rijksregisternr'] = '';
        $_SESSION['Gebruikersnaam_G'] = '';
        $_SESSION['Wachtwoord_G'] = '';
        $_SESSION['Beschrijving_G'] = '';
        header("Location: WISA-Formulier.php?logins");
    }  
if (isset($_POST['Verwijderen']) && $_SESSION['Bestaande_Persoon_Id'] != ''){
    $sqlPersoon_Verwijderen = "DELETE FROM tbl_personen WHERE fld_persoon_id=".$_SESSION['Bestaande_Persoon_Id'];
    $sqlGebruiker_Verwijderen = "DELETE FROM tbl_gebruikers WHERE fld_persoon_id_fk=".$_SESSION['Bestaande_Persoon_Id'];
    if (mysqli_query($conn, $sqlPersoon_Verwijderen)){
        if (mysqli_query($conn, $sqlGebruiker_Verwijderen)){
            $_SESSION['Bestaande_Persoon'] = 0;
            $_SESSION['Bestaande_Persoon_Id'] = '';
            $_SESSION['EID_Voornaam'] = '';
            $_SESSION['EID_Achternaam'] = '';
            $_SESSION['Geslacht'] = '';
            $_SESSION['EID_GB_Datum'] = '';
            $_SESSION['GB_Plaats'] = '';
            $_SESSION['EID_Rijksregisternr'] = '';
            $_SESSION['Gebruikersnaam_G'] = '';
            $_SESSION['Wachtwoord_G'] = '';
            $_SESSION['Beschrijving_G'] = '';
            header("Location: WISA-Formulier.php?logins");
        }
        else {
            echo "Error: " . $sqlGebruiker_Verwijderen . "<br>" . mysqli_error($conn);
        }
    }
    else {
        echo "Error: " . $sqlPersoon_Verwijderen . "<br>" . mysqli_error($conn);
    }
    
}   
        
?>
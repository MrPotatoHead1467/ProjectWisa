<?php
include "WISA-Connection.php";

if (isset($_POST['Persoon_Opslaan'])){
    if (isset($_POST['Leerling'])){
        $Leerling = 1;
    }
    else {
        $Leerling = 0;
    }
    
    $Voornaam = mysqli_real_escape_string($conn, $_POST['Voornaam']);
    $Achternaam = mysqli_real_escape_string($conn, $_POST['Achternaam']);
    $Naam = $Voornaam." ".$Achternaam;
    $GB_Datum = mysqli_real_escape_string($conn, $_POST['GB_Datum']);
    
    $Geslacht = mysqli_real_escape_string($conn, $_POST['Geslacht']);
    if ($Geslacht == "Kies"){
        header("Location: WISA-Formulier.php");
    }
    
    $Godsdienst = mysqli_real_escape_string($conn, $_POST['Godsdienst']);
    if ($Godsdienst == "Kies"){
        header("Location: WISA-Formulier.php");
    }
    
    $Nation = mysqli_real_escape_string($conn, $_POST['Nationaliteit']);
    if ($Nation == "Kies"){
        header("Location: WISA-Formulier.php");
    }
    
    $GB_Plaats = mysqli_real_escape_string($conn, $_POST['GB_Plaats']);
    
    if (isset($_POST['Geen_Register_nr'])){
        $ID_Nummer = mysqli_real_escape_string($conn, $_POST['Bis_nr']);
        $Register_Bis = "fld_persoon_bis_nr";
    }
    else {
        $ID_Nummer = mysqli_real_escape_string($conn, $_POST['Register_nr']);
        $Register_Bis = "fld_persoon_register_nr";
    }
    
    if (isset($_POST['Overleden'])){
        $Overleden = 1;
    }
    else {
        $Overleden = 0;
    }
    
    $sqlPersoon = "INSERT INTO tbl_personen(fld_persoon_voornaam, fld_persoon_achternaam, fld_persoon_naam, fld_persoon_gb_datum, fld_persoon_geslacht, fld_godsdienst_id_fk,
                   fld_persoon_nation_id_fk, fld_persoon_gb_plaats, ".$Register_Bis.", fld_persoon_leerling, fld_persoon_overleden) VALUES 
                   ('".$Voornaam."', '".$Achternaam."', '".$Naam."', '".$GB_Datum."', '".$Geslacht."', '".$Godsdienst."', '".$Nation."', '".$GB_Plaats."', '".$ID_Nummer."', '".$Leerling."', '".$Overleden."')";
    
    if (mysqli_query($conn, $sqlPersoon)){
        if (isset($_SESSION['EID_Voornaam'])){
            $_SESSION['EID_Voornaam'] = '';
        }
        if (isset($_SESSION['EID_Achternaam'])){
            $_SESSION['EID_Achternaam'] = '';
        }
        if (isset($_SESSION['EID_Rijksregisternr'])){
            $_SESSION['EID_Rijksregisternr'] = '';
        }
        header("Location: WISA-Formulier.php");
    }
    else {
        echo "Error: " . $sqlPersoon . "<br>" . mysqli_error($conn);
    }
}
?>
<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Contact_Opslaan'])){
    $Persoon = mysqli_real_escape_string($conn, $_POST['Persoon']);
    $Straat = mysqli_real_escape_string($conn, $_POST['Straat']);
    $Huisnr = mysqli_real_escape_string($conn, $_POST['Huisnummer']);
    $Woonplaats = mysqli_real_escape_string($conn, $_POST['Woonplaats_Lijst']);
    if ($Woonplaats == 'Niet_BE'){
        $Woonplaats = mysqli_real_escape_string($conn, $_POST['Woonplaats_niet_be_txt']);
    }
    $Bus = mysqli_real_escape_string($conn, $_POST['Bus']);
    if ($Bus == ''){
        $Bus = NULL;
        $fld_Bus = NULL;
    }
    else {
        $Bus = ", '".$Bus."'";
        $fld_Bus = ", fld_adres_bus_nr";
    }
    $sqlAdres = "INSERT INTO tbl_adressen(fld_adres_straatnaam, fld_adres_huis_nr".$fld_Bus.", fld_adres_postcode_id_fk, fld_adres_gemeente_id_fk, fld_adres_land_id_fk)
                   VALUES ('".$Straat."', '".$Huisnrs."'".$Bus.", '"; /** Moet nog af gemaakt worden? */
}

if (isset($_POST['Zoekvak_Zoeken'])){
    $Zoekvak = mysqli_real_escape_string($conn, $_POST['Zoekvak']);
    $_SESSION['Zoekvak'] = "SELECT * FROM tbl_personen WHERE fld_persoon_naam LIKE '%".$Zoekvak."%'";
    header("Location: WISA-Formulier.php");
}

if (isset($_POST["GSM_Opslaan"])) {
    $GSM_Opslaan = mysqli_real_escape_string($conn, $_POST['GSM']);
    if ($GSM_Opslaan !== ''){
        if (isset($_SESSION['Mogelijke_GSM_nrs'])) {
             array_push($_SESSION['Mogelijke_GSM_nrs'],mysqli_real_escape_string($conn, $GSM_Opslaan));
        }
        else {
            $_SESSION['Mogelijke_GSM_nrs'] = array(mysqli_real_escape_string($conn, $GSM_Opslaan));
        }
    }
    header("Location: WISA-Formulier.php");
}

if (isset($_SESSION['Mogelijke_GSM_nrs'])){
    foreach ($_SESSION['Mogelijke_GSM_nrs'] as $Mogelijk_GSM_verwijderen){
        $Mogelijk_GSM_verwijderen_no_dot = str_replace('.', '_', $Mogelijk_GSM_verwijderen);
        if (isset($_POST[$Mogelijk_GSM_verwijderen_no_dot])){
            if (($key = array_search($Mogelijk_GSM_verwijderen, $_SESSION['Mogelijke_GSM_nrs'])) !== false){
                unset($_SESSION['Mogelijke_GSM_nrs'][$key]);
                header ("Location: WISA-Formulier.php");
            }
        }
    }
}

if (isset($_POST["Telefoon_Opslaan"])) {
    $Telefoon_Opslaan = mysqli_real_escape_string($conn, $_POST['Telefoon']);
    if ($Telefoon_Opslaan !== ''){
        if (isset($_SESSION['Mogelijke_Tel_nrs'])) {
             array_push($_SESSION['Mogelijke_Tel_nrs'],mysqli_real_escape_string($conn, $Telefoon_Opslaan));
        }
        else {
            $_SESSION['Mogelijke_Tel_nrs'] = array(mysqli_real_escape_string($conn, $Telefoon_Opslaan));
        }
    }
    header("Location: WISA-Formulier.php");
}

if (isset($_SESSION['Mogelijke_Tel_nrs'])){
    foreach ($_SESSION['Mogelijke_Tel_nrs'] as $Mogelijk_Tel_verwijderen){
        $Mogelijk_Tel_verwijderen = str_replace('.', '_', $Mogelijk_Tel_verwijderen);
        if (isset($_POST[$Mogelijk_Tel_verwijderen])){
            $Mogelijk_Tel_verwijderen = str_replace('_', '.', $Mogelijk_Tel_verwijderen);
            if (($key = array_search($Mogelijk_Tel_verwijderen, $_SESSION['Mogelijke_Tel_nrs'])) !== false){
                unset($_SESSION['Mogelijke_Tel_nrs'][$key]);
                header ("Location: WISA-Formulier.php");
            }
        }
    }
}

if (isset($_POST["Email_Opslaan"])) {
    $Email_Opslaan = mysqli_real_escape_string($conn, $_POST['Email']);
    if ($Email_Opslaan !== ''){
        if (isset($_SESSION['Mogelijke_Emailadressen'])) {
             array_push($_SESSION['Mogelijke_Emailadressen'],mysqli_real_escape_string($conn, $Email_Opslaan));
        }
        else {
            $_SESSION['Mogelijke_Emailadressen'] = array(mysqli_real_escape_string($conn, $Email_Opslaan));
        }
    }
    header("Location: WISA-Formulier.php");
}

if (isset($_SESSION['Mogelijke_Emailadressen'])){
    foreach ($_SESSION['Mogelijke_Emailadressen'] as $Mogelijk_Email_verwijderen){
        $Mogelijk_Email_verwijderen = str_replace('.', '_', $Mogelijk_Email_verwijderen);
        if (isset($_POST[$Mogelijk_Email_verwijderen])){
            $Mogelijk_Email_verwijderen = str_replace('_', '.', $Mogelijk_Email_verwijderen);
            if (($key = array_search($Mogelijk_Email_verwijderen, $_SESSION['Mogelijke_Emailadressen'])) !== false){
                unset($_SESSION['Mogelijke_Emailadressen'][$key]);
                header ("Location: WISA-Formulier.php");
            }
        }
    }
}
?>
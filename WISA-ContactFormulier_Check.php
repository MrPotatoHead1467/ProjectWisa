<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Opslaan'])){
    $Persoon = mysqli_real_escape_string($conn, $_POST['Persoon']);
}

if (isset($_POST['Zoekvak_Zoeken'])){
    $Zoekvak = mysqli_real_escape_string($conn, $_POST['Zoekvak']);
    $_SESSION['Zoekvak'] = "SELECT * FROM tbl_personen WHERE fld_persoon_naam LIKE '%".$Zoekvak."%'";
    header("Location: WISA-Formulier.php");
}

if (isset($_POST['GSM_Opslaan'])){
    $Persoon = mysqli_real_escape_string($conn, $_POST['Persoon']);
    $GSM = mysqli_real_escape_string($conn, $_POST['GSM']);
    $sqlGSM = "INSERT INTO tbl_gegevens(fld_gegeven_inhoud, fld_gegeven_soort_id_fk) VALUES ('".$GSM."', '3')";
    if (mysqli_query($conn, $sqlGSM)){
        
    }
    else {
        echo "Error: " . $sqlGSM . "<br>" . mysqli_error($conn);
    }
}
?>
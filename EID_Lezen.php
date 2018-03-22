<?php
session_start();
include "eid.php";

if (isset($_POST['EID_Lezen'])){
    $card = new IDCard;
    $_SESSION['EID_Voornaam'] = $card->prename;
    $_SESSION['EID_Achternaam'] = $card->name;
    $_SESSION['EID_Rijksregisternr'] = $card->serial;
    $GB_Datum = substr($_SESSION['EID_Rijksregisternr'], 0, 6);
    $Huidig_Jaar = date('Y');
    $Vergelijk_Jaar = (substr($Huidig_Jaar, 2, 2))+1;
    $Begin_Jaar = substr($Huidig_Jaar, 0, 2);
    if ((substr($GB_Datum, 0, 2)) < $Vergelijk_Jaar){
        $GB_Datum = $Begin_Jaar.$GB_Datum;
    }
    else {
        $GB_Datum = ($Begin_Jaar-1).$GB_Datum;
    }
    $date = DateTime::createFromFormat('Ymd', $GB_Datum);
    $GB_Datum = $date->format('Y-m-d');
    $_SESSION['EID_GB_Datum'] = $GB_Datum;
    

}
header("Location: WISA-Formulier.php");
?>
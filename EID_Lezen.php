<?php
session_start();
include "eid.php";

if (isset($_POST['Kaart_Lezen'])){
    $card = new IDCard;
    $_SESSION['EID_Voornaam'] = $card->prename;
    $_SESSION['EID_Achternaam'] = $card->name;
    $_SESSION['EID_Rijksregisternr'] = $card->serial;
    echo $_SESSION['EID_Achternaam'];
    header ("Location: WISA-Formulier.php");
}
else{
    header ("Location: WISA-Formulier.php");
}

?>
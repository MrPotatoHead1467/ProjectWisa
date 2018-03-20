<?php
session_start();
include "eid.php";

foreach ($_SERVER as $Server){
    echo $Server."<br />";
}


if (isset($_POST['EID_Lezen'])){
    $card = new IDCard;
    $_SESSION['EID_Voornaam'] = $card->prename;
    $_SESSION['EID_Achternaam'] = $card->name;
    $_SESSION['EID_Rijksregisternr'] = $card->serial;
    $GB_Datum = $result = substr($_SESSION['EID_Rijksregisternr'], 0, 6);
    echo $_SESSION['EID_Achternaam'];

}
else{

}

?>
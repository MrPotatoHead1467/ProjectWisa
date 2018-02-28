<?php
session_start();
if(isset($_POST["Inschrijving_Opslaan"])) {
    $target_dir = "Uploads/";
    foreach ($_SESSION['Vragen_Id'] as $Vraag_Id){
        if (isset($_FILES[$Vraag_Id."_Bestand"]) and $_FILES[$Vraag_Id."_Bestand"] != ''){
            $Bestand = $_FILES[$Vraag_Id."_Bestand"];
            $Aantal_Bestanden = count($Bestand['name']);
            echo $Aantal_Bestanden;
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                echo $i;
                $Bestand_Locatie = $target_dir . basename($_FILES[$Vraag_Id."_Bestand"]['name'][$i]);
                /** Het bestand wordt geüpload */
                if (move_uploaded_file($_FILES[$Vraag_Id."_Bestand"]["tmp_name"][$i], $Bestand_Locatie)) {
                    echo "Het bestand ". basename($Bestand["name"][$i]). " is geüpload.<br />";
                } 
                else {
                    echo "Sorry, er is een probleem opgestreden bij het uploaden van uw bestand.<br />";
                }
            }
        }
    }
    
    if (isset($_SESSION['Vragen_Id'])){
        foreach ($_SESSION['Vragen_Id'] as $Vragen_Id){
            if (($key = array_search($Vragen_Id, $_SESSION['Vragen_Id'])) !== false){
                unset($_SESSION['Vragen_Id'][$key]);
            }
        }
    }
}
?>
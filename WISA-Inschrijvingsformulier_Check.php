<?php
session_start();
include "WISA-Connection.php";

if(isset($_POST["Inschrijving_Opslaan"])) {
    $Datum = date("Y-m-d_h-i");
    echo $Datum;
    $target_dir = "Uploads/";
    foreach ($_SESSION['Vragen_Id'] as $Vraag_Id){
        if (isset($_FILES[$Vraag_Id."_Bestand"]) and $_FILES[$Vraag_Id."_Bestand"] != ''){
            $Bestand = $_FILES[$Vraag_Id."_Bestand"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Bestand_Naam = $Vraag_Id."_".$Datum;
                $Bestand_Locatie = $target_dir . $Bestand_Naam;
                /** Het bestand wordt geüpload */
                if (move_uploaded_file($_FILES[$Vraag_Id."_Bestand"]["tmp_name"][$i], $Bestand_Locatie)) {
                    echo "Het bestand ". basename($Bestand["name"][$i]). " is geüpload.<br />";
                    $Soort_Bestand = strtolower(pathinfo($Bestand_Locatie,PATHINFO_EXTENSION));
                    
                    $sqlBestanden = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                    if (mysqli_query($conn, $sqlBestanden)){
                        echo "Gelukt";
                    }
                    else {
                        echo "Error: " . $sqlBestanden . "<br>" . mysqli_error($conn);
                    }
 
                }
                else {
                    
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

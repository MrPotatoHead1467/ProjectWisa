<?php
session_start();
include "WISA-Connection.php";

if(isset($_POST["Inschrijving_Opslaan"])) {
    $Datum = date("Y-m-d_h-i");
    $target_dir = "Uploads/";
    $sqlVragen = "SELECT * FROM tbl_vragen";
    $resultVragen = mysqli_query($conn, $sqlVragen);
    if (mysqli_num_rows($resultVragen) > 0) {
        while($rowVragen = mysqli_fetch_assoc($resultVragen)){
            if (isset($_FILES[$rowVragen['fld_vraag_id']."_Bestand"]) and $_FILES[$rowVragen['fld_vraag_id']."_Bestand"] != ''){
                $Bestand = $_FILES[$rowVragen['fld_vraag_id']."_Bestand"];
                $Aantal_Bestanden = count($Bestand['name']);
                for ($i = 0; $i < $Aantal_Bestanden; $i++){
                    $Bestand_Naam = $rowVragen['fld_vraag_id']."_".$Datum;
                    $Bestand_Locatie = $target_dir . $Bestand_Naam;
                    /** Het bestand wordt ge�pload */
                    if (move_uploaded_file($_FILES[$rowVragen['fld_vraag_id']."_Bestand"]["tmp_name"][$i], $Bestand_Locatie)) {
                        echo "Het bestand ". basename($Bestand["name"][$i]). " is ge�pload.<br />";
                        $Soort_Bestand = strtolower(pathinfo($Bestand_Locatie, PATHINFO_EXTENSION));
                        
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
            $Vraag_ID = $rowVragen['fld_vraag_id'];
            $Antwoord = mysqli_real_escape_string($conn, $_POST[$Vraag_ID]);
            echo $Antwoord;
        }
    }
}
?>

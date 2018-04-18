<?php
session_start();
include "WISA-Connection.php";

if(isset($_POST["Inschrijving_Opslaan"])) {
    $Persoon_Id = $_SESSION['Leerling'];
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
            
            if ($rowVragen['fld_antwoord_type_k_tekst'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_k_tekst";
                }
            // lange tekst vraag
            elseif ($rowVragen['fld_antwoord_type_l_tekst'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_l_tekst";
                }
            // num vraag
            elseif ($rowVragen['fld_antwoord_type_num'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_num";
                }
            // datum vraag
            elseif ($rowVragen['fld_antwoord_type_datum'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_datum";
                }
            // j/n vraag
            elseif ($rowVragen['fld_antwoord_type_j/n'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_j/n";
                }
            // foto vraag
            elseif ($rowVragen['fld_antwoord_type_foto'] == 1)
                {
                    $Soort_Antwoord = "fld_antwoord_foto";
                }
            /**
            // doc vraag 
            elseif ($row['fld_antwoord_type_doc'] == 1)
                {
                    
                }  
            * 
             */ 
            // lijst vraag
            elseif ($rowVragen['fld_antwoord_type_lijst'] == 1)
                {   
                    $Soort_Antwoord = "fld_antwoord_lijst_id_fk";
                    $sqlLijst = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_vraag_id_fk='".$Vraag_ID."' AND fld_lijst_item='".$Antwoord."'";
                    $resultLijst = mysqli_query($conn, $sqlLijst);
                    if (mysqli_num_rows($resultLijst) > 0) {
                        while($rowLijst = mysqli_fetch_assoc($resultLijst)){
                            $Antwoord = $rowLijst['fld_lijst_id'];
                        }
                    }
                }
                
            $sqlAntwoorden = "INSERT INTO tbl_antwoorden (fld_persoon_id_fk, fld_vraag_id_fk, ".$Soort_Antwoord.")
                              VALUES ('".$Persoon_Id."', '".$Vraag_ID."', '".$Antwoord."')";
                              
            if (mysqli_query($conn, $sqlAntwoorden)){
                
            }
            else {
                echo "Error: " . $sqlAntwoorden . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

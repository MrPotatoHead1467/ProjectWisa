<?php
session_start();
include "WISA-Connection.php";
$_SESSION['Leerling'] = 13;
if(isset($_POST["Inschrijving_Opslaan"])) {
    $Persoon_Id = $_SESSION['Leerling'];
    $Datum = date("Y-m-d_H-i");
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
            
            if ($rowVragen['fld_antwoord_type_doc'] != 1){
                $Antwoord = mysqli_real_escape_string($conn, $_POST[$Vraag_ID]);
            }
            
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
            // doc vraag 
            elseif ($rowVragen['fld_antwoord_type_doc'] == 1)
                {
                    if (isset($_FILES["Document_".$rowVragen['fld_vraag_id']]) and $_FILES["Document_".$rowVragen['fld_vraag_id']] != ''){
                        $Bestand = $_FILES["Document_".$rowVragen['fld_vraag_id']];
                        
                        $Soort_Bestand = pathinfo($Bestand["name"], PATHINFO_EXTENSION);
                        $Bestand_Basename = pathinfo($Bestand["name"], PATHINFO_FILENAME);
                        $Bestand_Naam = $Bestand_Basename."_".$rowVragen['fld_vraag_id']."_".$Persoon_Id;
                        
                        $Bestand_Locatie = $target_dir . $Bestand_Naam.".".$Soort_Bestand;
                        echo $Bestand_Naam;
                        /** Het bestand wordt ge�pload */
                        
                        if (move_uploaded_file($Bestand["tmp_name"], $Bestand_Locatie)) {
                            echo "Het bestand ". basename($Bestand["name"]). " is geüpload.<br />";
                            
                            echo "Soort_Bestand: ".$Soort_Bestand."<br />";
                            $sqlBestanden = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum)
                                             VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                            
                            if (mysqli_query($conn, $sqlBestanden)){
                                $Doc_Id = mysqli_insert_id($conn);
                                $sqlDoc_link = "INSERT INTO tbl_docs_links (fld_doc_id_fk, fld_persoon_id_fk, fld_vraag_id_fk)
                                                VALUES ('".$Doc_Id."', '".$Persoon_Id."', '".$Vraag_ID."')";
                                if (mysqli_query($conn, $sqlDoc_link)){
                                    $Soort_Antwoord = "fld_antwoord_doc_link_id_fk";
                                    $Antwoord = mysqli_insert_id($conn);
                                }
                                else {
                                    echo "Error: " . $sqlDoc_link . "<br>" . mysqli_error($conn);
                                }
                            }
                            else {
                                echo "Error: " . $sqlBestanden . "<br>" . mysqli_error($conn);
                            }
                            
                        }
                        else {
                            
                        }
                        
                    }
                }  
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
                //header("Location: WISA-Formulier.php?vragen");
                //exit();
            }
            else {
                echo "Error: " . $sqlAntwoorden . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

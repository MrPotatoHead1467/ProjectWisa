<?php
session_start();
include "WISA-Connection.php";
if(isset($_POST["Inschrijving_Opslaan"])) {
    $Persoon_Id = $_SESSION['Leerling'];
    $Datum = date("Y-m-d_H-i");
    $sqlPersoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$Persoon_Id;
    $resultPersoon = mysqli_query($conn, $sqlPersoon);
    if (mysqli_num_rows($resultPersoon) > 0) {
        while($rowPersoon = mysqli_fetch_assoc($resultPersoon)){
            $Persoon_Naam = $rowPersoon['fld_persoon_naam'];
        }
    }
    
    $sqlVragen = "SELECT * FROM tbl_vragen";
    $resultVragen = mysqli_query($conn, $sqlVragen);
    if (mysqli_num_rows($resultVragen) > 0) {
        while($rowVragen = mysqli_fetch_assoc($resultVragen)){
            $Vraag_ID = $rowVragen['fld_vraag_id'];
            $Dir = "Uploads/".$Persoon_Naam."_".$Persoon_Id."/Inschrijving/".$Vraag_ID;
            $target_dir = $Dir."/";
            if (isset($_FILES[$Vraag_ID."_Bestand"])){
                
                $Bestand = $_FILES[$Vraag_ID."_Bestand"];
                $Aantal_Bestanden = count($Bestand['name']);
                for ($i = 0; $i < $Aantal_Bestanden; $i++){
                    if ($Bestand['size'][$i] != 0){
                        if (!file_exists($Dir)) {
                            mkdir($Dir, 0777, true);
                        }
                
                        $Bestand_Basename = pathinfo($Bestand["name"][$i], PATHINFO_FILENAME);
                        $Soort_Bestand = pathinfo($Bestand["name"][$i], PATHINFO_EXTENSION);
                        $Bestand_Naam = $Bestand_Basename."_".$Vraag_ID."_".$Persoon_Id.".".$Soort_Bestand;
                        $Bestand_Locatie = $target_dir.$Bestand_Naam;
                        /** Het bestand wordt geüpload */
                        if (move_uploaded_file($_FILES[$Vraag_ID."_Bestand"]["tmp_name"][$i], $Bestand_Locatie)) {
                            echo "Het bestand ".$Bestand_Basename.".".$Soort_Bestand." is ge�pload.<br />";
                            
                            $sqlBestanden = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) 
                                             VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                            
                            if (mysqli_query($conn, $sqlBestanden)){
                                $Doc_Id = mysqli_insert_id($conn);
                                $sqlDoc_link = "INSERT INTO tbl_docs_links (fld_doc_id_fk, fld_persoon_id_fk, fld_vraag_id_fk)
                                                VALUES ('".$Doc_Id."', '".$Persoon_Id."', '".$Vraag_ID."')";
                                                
                                if (mysqli_query($conn, $sqlDoc_link)){
                                    
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
                            echo "Bestand is niet geüpload.<br />";
                        }
                    }
                }
            }
            
            
            
            if ($rowVragen['fld_antwoord_type_doc'] != 1 && $rowVragen['fld_antwoord_type_foto'] != 1){
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
                    if (isset($_FILES["Foto_".$Vraag_ID]) and $_FILES["Foto_".$Vraag_ID]['size'] != 0){
                        if (!file_exists($Dir)) {
                            mkdir($Dir, 0777, true);
                        }
                        
                        $Foto = $_FILES["Foto_".$Vraag_ID];
                        
                        $Soort_Foto = pathinfo($Foto["name"], PATHINFO_EXTENSION);
                        $Foto_Basename = pathinfo($Foto["name"], PATHINFO_FILENAME);
                        $Foto_Naam = $Foto_Basename."_".$Vraag_ID."_".$Persoon_Id;
                        
                        $Foto_Locatie = $target_dir . $Foto_Naam.".".$Soort_Foto;
                        echo "Foto: ".$Foto_Naam."<br />";
                        
                        if (move_uploaded_file($Foto["tmp_name"], $Foto_Locatie)) {
                            echo "Foto ". basename($Foto["name"]). " is geüpload.<br />";
                            
                            echo "Soort_Foto: ".$Soort_Foto."<br />";
                            $sqlFotos = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum)
                                             VALUES ('".$Foto_Naam."', '".$Soort_Foto."', '".$Foto_Locatie."', '".$Datum."')";
                            
                            if (mysqli_query($conn, $sqlFotos)){
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
                                echo "Error: " . $sqlFotos . "<br>" . mysqli_error($conn);
                            }
                            
                        }
                        else {
                            
                        }
                        
                    }
                }
            // doc vraag 
            elseif ($rowVragen['fld_antwoord_type_doc'] == 1)
                {
                    if (isset($_FILES["Document_".$Vraag_ID]) and $_FILES["Document_".$Vraag_ID]['size'] != 0){
                        if (!file_exists($Dir)) {
                            mkdir($Dir, 0777, true);
                        }
                        
                        $Bestand = $_FILES["Document_".$Vraag_ID];
                        
                        $Soort_Bestand = pathinfo($Bestand["name"], PATHINFO_EXTENSION);
                        $Bestand_Basename = pathinfo($Bestand["name"], PATHINFO_FILENAME);
                        $Bestand_Naam = $Bestand_Basename."_".$Vraag_ID."_".$Persoon_Id;
                        
                        $Bestand_Locatie = $target_dir . $Bestand_Naam.".".$Soort_Bestand;
                        echo "Bestand: ".$Bestand_Naam;
                        
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
                header("Location: WISA-Formulier.php?vragen");
                exit();
            }
            else {
                echo "Error: " . $sqlAntwoorden . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Loopbaan_Opslaan'])){
    $_SESSION['Leerling'] = 25;
    $Persoon_Id = $_SESSION['Leerling'];
    $Datum = date('Y');
    $Schooljaar = $_POST['Schooljaar'];
    $Richting = mysqli_real_escape_string($conn, $_POST['Richting_Zoeken']);
    $Begindatum = $_POST['Begindatum'];
    $Einddatum = $_POST['Einddatum'];
    
    if ($Schooljaar < $Datum){
        $fld_Attest = ",fld_loopbaan_attest";
        $Attest = ", '".$_POST['Attest_Zoeken_in']."'";
        if ($Attest == 'B') {
            $fld_Clausule = ",fld_loopbaan_clausule";
            $Clausule = ", '".mysqli_real_escape_string($conn, $_POST['Clausule'])."'";
        }
        else {
            $fld_Clausule = NULL;
            $Clausule = NULL;
        }
        $School_Id = $_POST['School_Zoeken'];
        
        $sqlLoopbaan = "INSERT INTO tbl_loopbanen (fld_persoon_id_fk, fld_school_id_fk, fld_richting_id_fk, fld_loopbaan_schooljaar, fld_loopbaan_b_datum, fld_loopbaan_e_datum".$fld_Clausule.$fld_Attest.") 
                        VALUES ('".$Persoon_Id."', '".$School_Id."', '".$Richting."', '".$Schooljaar."', '".$Begindatum."', '".$Einddatum."'".$Clausule.$Attest.")";
    }
    else {
        $School_Id = 2532;
        $sqlLoopbaan = "INSERT INTO tbl_loopbanen (fld_persoon_id_fk, fld_school_id_fk, fld_richting_id_fk, fld_loopbaan_schooljaar, fld_loopbaan_b_datum, fld_loopbaan_e_datum) 
                        VALUES ('".$Persoon_Id."', '".$School_Id."', '".$Richting."', '".$Schooljaar."', '".$Begindatum."', '".$Einddatum."')";
    }
    
    if (mysqli_query($conn, $sqlLoopbaan)){
        if (isset($_FILES["Bestand_loopbaan"])){
            $Datum = date("Y-m-d_H-i");
            $sqlPersoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$Persoon_Id;
            $resultPersoon = mysqli_query($conn, $sqlPersoon);
            if (mysqli_num_rows($resultPersoon) > 0) {
                while($rowPersoon = mysqli_fetch_assoc($resultPersoon)){
                    $Persoon_Naam = $rowPersoon['fld_persoon_naam'];
                }
            }
            $Dir = "Uploads/".$Persoon_Naam."_".$Persoon_Id."/Loopbaan";
            $target_dir = $Dir."/";
            if (!file_exists($Dir)) {
                mkdir($Dir, 0777, true);
            }
            $Bestand = $_FILES["Bestand_loopbaan"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Bestand_Basename = pathinfo($Bestand["name"][$i], PATHINFO_FILENAME);
                $Soort_Bestand = pathinfo($Bestand["name"][$i], PATHINFO_EXTENSION);
                $Bestand_Naam = $Bestand_Basename."_Loopbaan_".$Persoon_Id.".".$Soort_Bestand;
                $Bestand_Locatie = $target_dir.$Bestand_Naam;
                echo "Bestand_Locatie: ".$Bestand_Locatie."<br />";
                /** Het bestand wordt geüpload */
                if ($Bestand['size'][$i] != 0){
                    if (move_uploaded_file($Bestand["tmp_name"][$i], $Bestand_Locatie)) {
                        echo "Het bestand ". basename($Bestand["name"][$i]). " is geüpload.<br />";
                        
                        $sqlBestanden = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) 
                                         VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                        if (mysqli_query($conn, $sqlBestanden)){
                            $Doc_Id = mysqli_insert_id($conn);
                            $sqlDoc_link = "INSERT INTO tbl_docs_links (fld_doc_id_fk, fld_persoon_id_fk)
                                            VALUES ('".$Doc_Id."', '".$Persoon_Id."')";
                                            
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
                        echo "Bestand niet geüpload";
                    }
                }
                
            }
        }
        else {
            echo "Geen bestanden<br />";
        }
        header("Location: WISA-Formulier.php?loopbaan");
        exit();
    }
    else {
        echo "Error: " . $sqlLoopbaan . "<br>" . mysqli_error($conn);
    }
    /** KLAS NOG TOE TE VOEGEN !!! */    
}

if (isset($_POST['Volgende']))
        {
            header("Location: WISA-Formulier.php?vragen");
        }

?>
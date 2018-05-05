<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Relatie_opslaan'])){
    if (isset($_SESSION['Leerling'])){
        $Persoon_1 = $_SESSION['Leerling'];
    }
    else {
        $Persoon_1 = mysqli_real_escape_string($conn, $_POST['Leerling_Zoeken']);
        $_SESSION['Leerling'] = $Persoon_1;
    }
    $Datum = date("Y-m-d_H-i");

    $Relatie = mysqli_real_escape_string($conn, $_POST['Relatie_Zoeken']);
    $Persoon_2 = mysqli_real_escape_string($conn, $_POST['Persoon_2_Zoeken']);
    $Beschrijving = mysqli_real_escape_string($conn, $_POST['Relatie_beschrijving']);
    
    $sqlRelatie = "INSERT INTO tbl_personen_linken (fld_master_id_fk, fld_child_id_fk, fld_soort_id_fk, fld_persoon_link_beschrijving)
                   VALUES ('".$Persoon_2."', '".$Persoon_1."', '".$Relatie."', '".$Beschrijving."')";
    
    if (mysqli_query($conn, $sqlRelatie)){
        $Relatie_Id = mysqli_insert_id($conn);
        $sqlPersoon_1 = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$Persoon_1;
        $resultPersoon_1 = mysqli_query($conn, $sqlPersoon_1);
        if (mysqli_num_rows($resultPersoon_1) > 0) {
            while($rowPersoon_1 = mysqli_fetch_assoc($resultPersoon_1)){
                $Persoon_Naam = $rowPersoon_1['fld_persoon_naam'];
            }
        }
        
        $Dir = "Uploads/".$Persoon_Naam."_".$Persoon_1."/Relatie";
        $target_dir = $Dir."/";
        
        if (isset($_FILES["Bestand_relatie"])){
            echo "Dir: ".$Dir."<br />";
            $Bestand = $_FILES["Bestand_relatie"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Bestand_Basename = pathinfo($Bestand["name"][$i], PATHINFO_FILENAME);
                $Soort_Bestand = pathinfo($Bestand["name"][$i], PATHINFO_EXTENSION);
                $Bestand_Naam = $Bestand_Basename."_Relatie_".$Relatie_Id.".".$Soort_Bestand;
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
                                            VALUES ('".$Doc_Id."', '".$Persoon_1."')";
                                            
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
                                
        if (isset($_SESSION['Personen_Relaties'])) {
             $_SESSION['Personen_Relaties'][$Persoon_2] = $Relatie;
        }
        else {
             $_SESSION['Personen_Relaties'] = array($Persoon_2 => $Relatie);
        }
        header ("Location: WISA-Formulier.php?relaties");
           
    }
    else {
        echo "Error: " . $sqlRelatie . "<br>" . mysqli_error($conn);
    }
}


if (isset($_SESSION['Personen_Relaties'])){
    $i=0;
    foreach ($_SESSION['Personen_Relaties'] as $Persoon_Relatie_verwijderen){
        if (isset($_POST[$i])){
            if (($key = array_search($Persoon_Relatie_verwijderen, $_SESSION['Personen_Relaties'])) !== false){
                $Relatie_verwijderen = $_SESSION['Personen_Relaties'][$key];
                $sql = "DELETE FROM tbl_personen_linken WHERE fld_master_id_fk='".$key."' AND fld_child_id_fk='".$_SESSION['Leerling']."' AND fld_soort_id_fk='".$Relatie_verwijderen."'";
                if (mysqli_query($conn, $sql)){
                    unset($_SESSION['Personen_Relaties'][$key]);
                    // echo $key."<br />";
                    // echo $Relatie_verwijderen."<br />";
                    header ("Location: WISA-Formulier.php?relaties");
                }
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }               
            }
        }
        ++$i;
    }
}
?>
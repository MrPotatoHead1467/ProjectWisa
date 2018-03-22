<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Persoon_Opslaan'])){
    $Datum = date("Y-m-d_h-i");
    /** Als de checkbox 'Leerling' aangevinkt is, is het een leerling (1) anders niet (0) */
    if (isset($_POST['Leerling'])){
        $Leerling = 1;
    }
    else {
        $Leerling = 0;
    }
    /** Gegevens worden opgehaald */
    $Voornaam = mysqli_real_escape_string($conn, $_POST['Voornaam']);
    $Achternaam = mysqli_real_escape_string($conn, $_POST['Achternaam']);
    $Naam = $Voornaam." ".$Achternaam;
    $GB_Datum = mysqli_real_escape_string($conn, $_POST['GB_Datum']);    
    $Geslacht = mysqli_real_escape_string($conn, $_POST['Geslacht']);
    if ($Geslacht == "Kies"){
        header("Location: WISA-Formulier.php?errorGeslacht");
    }
    
    $Godsdienst = mysqli_real_escape_string($conn, $_POST['Godsdienst']);
    if ($Godsdienst == '' and $Leerling == 1){
        header("Location: WISA-Formulier.php?errorGodsdienst");
    }
    
    $Nation = mysqli_real_escape_string($conn, $_POST['Nationaliteit']);
    if ($Nation == '' and $Leerling == 1){
        header("Location: WISA-Formulier.php?errorNationaliteit");
    }
    
    $GB_Plaats = mysqli_real_escape_string($conn, $_POST['GB_Plaats']);
    if ($GB_Plaats == '' and $Leerling == 1){
        header("Location: WISA-Formulier.php?errorGeboorteplaats");
    }
    
    if (mysqli_real_escape_string($conn, $_POST['Register_nr']) != ''){
        $ID_Nummer = ", '".mysqli_real_escape_string($conn, $_POST['Register_nr'])."'";
        $Register_Bis = ", fld_persoon_register_nr";
    }
    elseif (isset($_POST['Geen_Register_nr']) and mysqli_real_escape_string($conn, $_POST['Bis_nr'] != '')){
        $ID_Nummer = ", '".mysqli_real_escape_string($conn, $_POST['Bis_nr'])."'";
        $Register_Bis = ", fld_persoon_bis_nr";
    }
    else {
        $ID_Nummer = NULL;
        $Register_Bis = NULL;
    }
    
    if (isset($_POST['Overleden'])){
        $Overleden = 1;
    }
    else {
        $Overleden = 0;
    }
    
    $sqlPersoon = "INSERT INTO tbl_personen(fld_persoon_voornaam, fld_persoon_achternaam, fld_persoon_naam, fld_persoon_gb_datum, fld_persoon_geslacht, fld_godsdienst_id_fk,
                   fld_persoon_nation_id_fk, fld_persoon_gb_plaats".$Register_Bis.", fld_persoon_leerling, fld_persoon_overleden) VALUES 
                   ('".$Voornaam."', '".$Achternaam."', '".$Naam."', '".$GB_Datum."', '".$Geslacht."', '".$Godsdienst."', '".$Nation."', '".$GB_Plaats."'".$ID_Nummer.", '".$Leerling."', '".$Overleden."')";

    if (mysqli_query($conn, $sqlPersoon)){
        $Persoon_Id = mysqli_insert_id($conn);
        if ($Leerling == 1){
            $_SESSION['Leerling'] = $Persoon_Id;
        }
        $target_dir = "Uploads/";
        if (isset($_FILES["Bestand_persoon"]) and $_FILES["Bestand_persoon"] != ''){
            $Bestand = $_FILES["Bestand_persoon"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Soort_Bestand = strtolower(pathinfo($Bestand["name"][$i],PATHINFO_EXTENSION));
                $Bestand_Naam = $Persoon_Id."_".$Datum."_".$i.".".$Soort_Bestand;
                $Bestand_Locatie = $target_dir . $Bestand_Naam;
                if (move_uploaded_file($_FILES["Bestand_persoon"]["tmp_name"][$i], $Bestand_Locatie)) {              
                    $sqlBestanden = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                    if (mysqli_query($conn, $sqlBestanden)){
                        $Bestand_Id = mysqli_insert_id($conn);
                        $sqlPersoonBestand = "INSERT INTO tbl_docs_links(fld_doc_id_fk, fld_persoon_id_fk) VALUES ('".$Bestand_Id."', '".$Persoon_Id."')";
                        if (mysqli_query($conn, $sqlPersoonBestand)){
                            
                        }
                        else {
                            echo "Error: " . $sqlPersoonBestand . "<br>" . mysqli_error($conn);
                        }
                    }
                    else {
                        echo "Error: " . $sqlBestanden . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
        
        if (isset($_FILES["Foto_persoon"]) and $_FILES["Foto_persoon"] != ''){
            $Bestand = $_FILES["Foto_persoon"];
            $Soort_Bestand = strtolower(pathinfo($Bestand["name"],PATHINFO_EXTENSION));
            $Bestand_Naam = $Persoon_Id."_".$Datum."_Foto.".$Soort_Bestand;
            $Bestand_Locatie = $target_dir . $Bestand_Naam;
            if (move_uploaded_file($_FILES["Foto_persoon"]["tmp_name"], $Bestand_Locatie)) {              
                $sqlFoto = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                if (mysqli_query($conn, $sqlFoto)){
                    $Bestand_Id = mysqli_insert_id($conn);
                    $sqlPersoonFoto = "INSERT INTO tbl_docs_links(fld_doc_id_fk, fld_persoon_id_fk) VALUES ('".$Bestand_Id."', '".$Persoon_Id."')";
                    if (mysqli_query($conn, $sqlPersoonFoto)){
                        
                    }
                    else {
                        echo "Error: " . $sqlPersoonFoto . "<br>" . mysqli_error($conn);
                    }
                }
                else {
                    echo "Error: " . $sqlFoto . "<br>" . mysqli_error($conn);
                }
            }
        }
        
        if (isset($_SESSION['EID_Voornaam'])){
            $_SESSION['EID_Voornaam'] = '';
        }
        if (isset($_SESSION['EID_Achternaam'])){
            $_SESSION['EID_Achternaam'] = '';
        }
        if (isset($_SESSION['EID_Rijksregisternr'])){
            $_SESSION['EID_Rijksregisternr'] = '';
        }
        header("Location: WISA-Formulier.php?Gelukt");
    }
    else {
        echo "Error: " . $sqlPersoon . "<br>" . mysqli_error($conn);
    }
}

?>
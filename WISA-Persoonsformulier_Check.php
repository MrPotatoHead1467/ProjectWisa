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
    if (isset($_POST['GB_Datum_Onbekend'])){
        $GB_Datum_Onbekend = 1;
    }
    else {
        $GB_Datum_Onbekend = 0;
    }
    $GB_Datum = mysqli_real_escape_string($conn, $_POST['GB_Datum']);    
    $Geslacht = mysqli_real_escape_string($conn, $_POST['Geslacht']);
    if ($Geslacht == "Kies"){
        header("Location: WISA-Formulier.php?errorGeslacht");
    }
    
    $Godsdienst = mysqli_real_escape_string($conn, $_POST['Godsdienst']);
    if ($Godsdienst == 'undefined' and $Leerling == 1){
        header("Location: WISA-Formulier.php?errorGodsdienst");
    }
    
    $Nation = mysqli_real_escape_string($conn, $_POST['Nationaliteit']);
    if ($Nation == 'undefined' and $Leerling == 1){
        header("Location: WISA-Formulier.php?errorNationaliteit");
    }
    if (isset($_POST['GB_Plaats_Niet_Be'])){
        $GB_Plaats = mysqli_real_escape_string($conn, $_POST['GB_Plaats_Niet_Be_in']);
    }
    else{
        $GB_Plaats = mysqli_real_escape_string($conn, $_POST['GB_Plaats']);
        if ($GB_Plaats == 'undefined' and $Leerling == 1){
            header("Location: WISA-Formulier.php?errorGeboorteplaats");
        }
    }
    
    if (mysqli_real_escape_string($conn, $_POST['Register_nr']) != ''){
        $ID_Nummer = ", '".mysqli_real_escape_string($conn, $_POST['Register_nr'])."'";
        $Register_Bis = ", fld_persoon_register_nr";
    }
    elseif (isset($_POST['Geen_Register_nr']) and mysqli_real_escape_string($conn, $_POST['Bis_nr'] != '')){
        $ID_Nummer = ", '".mysqli_real_escape_string($conn, $_POST['Bis_nr'])."'";
        $Register_Bis = ", fld_persoon_bis_nr";
    }
    /**
     * elseif (!isset()){
        
    }
    */
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
    
    if ($_SESSION['Bestaande_Persoon'] == 0){
        $sqlPersoon = "INSERT INTO tbl_personen(fld_persoon_voornaam, fld_persoon_achternaam, fld_persoon_naam, fld_persoon_gb_datum_onbekend, fld_persoon_gb_datum, fld_persoon_geslacht, fld_godsdienst_id_fk,
                   fld_persoon_nation_id_fk, fld_persoon_gb_plaats".$Register_Bis.", fld_persoon_leerling, fld_persoon_overleden) VALUES 
                   ('".$Voornaam."', '".$Achternaam."', '".$Naam."', '".$GB_Datum_Onbekend."', '".$GB_Datum."', '".$Geslacht."', '".$Godsdienst."', '".$Nation."', '".$GB_Plaats."'".$ID_Nummer.", '".$Leerling."', '".$Overleden."')";

    }
    else {
         if (mysqli_real_escape_string($conn, $_POST['Register_nr']) != '' && !isset($_POST['Geen_Register_nr'])){
            $ID_Nummer = mysqli_real_escape_string($conn, $_POST['Register_nr'])."', ";
            $Register_Bis = "fld_persoon_register_nr='";
            $Rijksregister = true;
            $Bis = false;
         }
        elseif (isset($_POST['Geen_Register_nr']) and mysqli_real_escape_string($conn, $_POST['Bis_nr'] != '')){
            $ID_Nummer = mysqli_real_escape_string($conn, $_POST['Bis_nr'])."', ";
            $Register_Bis = "fld_persoon_bis_nr='";
            $Rijksregister = false;
            $Bis = true;
        }
        else {
            $ID_Nummer = NULL;
            $Register_Bis = NULL;
            $Rijksregister = false;
            $Bis = false;
        }
        $sqlPersoon = "UPDATE tbl_personen SET fld_persoon_voornaam='".$Voornaam."', fld_persoon_achternaam='".$Achternaam."', fld_persoon_naam='".$Naam."', fld_persoon_gb_datum_onbekend='".$GB_Datum_Onbekend."', fld_persoon_gb_datum='".$GB_Datum."',
                       fld_persoon_geslacht='".$Geslacht."', fld_godsdienst_id_fk='".$Godsdienst."', fld_persoon_nation_id_fk='".$Nation."', fld_persoon_gb_plaats='".$GB_Plaats."', ".$Register_Bis.$ID_Nummer."fld_persoon_leerling='".$Leerling."', 
                       fld_persoon_overleden='".$Overleden."' WHERE fld_persoon_id='".$_SESSION['Bestaande_Persoon_Id']."'";
    }
    
    if (mysqli_query($conn, $sqlPersoon)){
        if ($_SESSION['Bestaande_Persoon'] == 0){
            $Persoon_Id = mysqli_insert_id($conn);
        }
        elseif ($_SESSION['Bestaande_Persoon'] == 1){
            $Persoon_Id = $_SESSION['Bestaande_Persoon_Id'];
        }
        else {
            echo "Je hebt iets heel verkeerd gedaan";
        }
        
        $target_dir = 'Uploads/'.$Naam.'_'.$Persoon_Id;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (!file_exists($target_dir.'/Persoon')) {
            mkdir($target_dir.'/Persoon', 0777, true);
        }
        if (!file_exists($target_dir.'/Relatie')) {
            mkdir($target_dir.'/Relatie', 0777, true);
        }
        if (!file_exists($target_dir.'/Contact')) {
            mkdir($target_dir.'/Contact', 0777, true);
        }
        if (!file_exists($target_dir.'/Loopbaan')) {
            mkdir($target_dir.'/Loopbaan', 0777, true);
        }
        if (!file_exists($target_dir.'/Inschrijving')) {
            mkdir($target_dir.'/Inschrijving', 0777, true);
        }
        
        if ($Rijksregister == true){
            $sqlRijksregister = "UPDATE tbl_personen SET fld_persoon_bis_nr=NULL WHERE fld_persoon_id='".$Persoon_Id."'";
            if (mysqli_query($conn, $sqlRijksregister)){
                echo $Persoon_Id;
            }
            else {
                echo "Error: " . $sqlRijksregister . "<br>" . mysqli_error($conn);
            }
        }
        elseif ($Bis == true){
            $sqlBis = "UPDATE tbl_personen SET fld_persoon_register_nr=NULL WHERE fld_persoon_id='".$Persoon_Id."'";
            if (mysqli_query($conn, $sqlBis)){
                echo $Persoon_Id;
            }
            else {
                echo "Error: " . $sqlBis . "<br>" . mysqli_error($conn);
            }
        }
        
        if ($Leerling == 1){
            $_SESSION['Leerling'] = $Persoon_Id;
        }
        $Persoon_dir = $target_dir."/Persoon/";
        
        if (isset($_FILES["Bestand_persoon"])){
            $Bestand = $_FILES["Bestand_persoon"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Bestand_Basename = pathinfo($Bestand["name"][$i], PATHINFO_FILENAME);
                $Soort_Bestand = pathinfo($Bestand["name"][$i], PATHINFO_EXTENSION);
                $Bestand_Naam = $Bestand_Basename."_Persoon_".$Persoon_Id.".".$Soort_Bestand;
                $Bestand_Locatie = $Persoon_dir.$Bestand_Naam;
                /** Het bestand wordt geüpload */
                if ($_FILES["Bestand_persoon"]['size'][$i] != 0){
                    if (move_uploaded_file($_FILES["Bestand_persoon"]["tmp_name"][$i], $Bestand_Locatie)) {
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
        
        if (isset($_FILES["Foto_persoon"]) and $_FILES["Foto_persoon"]['size'] != 0){
            $Bestand = $_FILES["Foto_persoon"];
            $Bestand_Basename = pathinfo($Bestand["name"], PATHINFO_FILENAME);
            $Soort_Bestand = pathinfo($Bestand["name"], PATHINFO_EXTENSION);
            $Bestand_Naam = $Bestand_Basename."_Pasfoto_".$Persoon_Id.".".$Soort_Bestand;
            $Bestand_Locatie = $Persoon_dir . $Bestand_Naam;
            if ($Bestand['size'] != 0){
                if (move_uploaded_file($_FILES["Foto_persoon"]["tmp_name"], $Bestand_Locatie)) {              
                    $sqlFoto = "INSERT INTO tbl_docs(fld_doc_naam, fld_doc_soort, fld_doc_plaats, fld_doc_datum) 
                                VALUES ('".$Bestand_Naam."', '".$Soort_Bestand."', '".$Bestand_Locatie."', '".$Datum."')";
                    
                    if (mysqli_query($conn, $sqlFoto)){
                        $Bestand_Id = mysqli_insert_id($conn);
                        $sqlPersoonFoto = "INSERT INTO tbl_docs_links(fld_doc_id_fk, fld_persoon_id_fk) 
                                           VALUES ('".$Bestand_Id."', '".$Persoon_Id."')";
                        
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
            
        }
        
        $_SESSION['Bestaande_Persoon'] = 0;
        $_SESSION['Bestaande_Persoon_Id'] = '';
        $_SESSION['Is_Leerling'] = 1;
        $_SESSION['EID_Voornaam'] = '';
        $_SESSION['EID_Achternaam'] = '';
        $_SESSION['Geslacht'] = '';
        $_SESSION['EID_GB_Datum'] = '';
        $_SESSION['GB_Plaats'] = '';
        $_SESSION['Nationaliteit'] = '';
        $_SESSION['EID_Rijksregisternr'] = '';
        $_SESSION['Geen_Rijksregisternr'] = 0;
        $_SESSION['Bisnr'] = '';
        $_SESSION['Godsdienst'] = '';
        $_SESSION['Overleden'] = 0;
        header("Location: WISA-Formulier.php?persoon");
        
    }
    else {
        echo "Error: " . $sqlPersoon . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['Persoon_Zoeken_btn'])){
    $Persoon_Zoeken = mysqli_real_escape_string($conn, $_POST['Persoon_Zoeken']);
    if ($Persoon_Zoeken == '' || $Persoon_Zoeken == 'undefined'){
        header("Location: WISA-Formulier.php?persoon");
    }
    $sqlPersoon_Zoeken = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$Persoon_Zoeken."'";
    $result = $conn->query($sqlPersoon_Zoeken);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $_SESSION['Bestaande_Persoon'] = 1;
            $_SESSION['Bestaande_Persoon_Id'] = $row['fld_persoon_id'];
            $_SESSION['Is_Leerling'] = $row['fld_persoon_leerling'];
            $_SESSION['EID_Voornaam'] = $row['fld_persoon_voornaam'];
            $_SESSION['EID_Achternaam'] = $row['fld_persoon_achternaam'];
            $_SESSION['Geslacht'] = $row['fld_persoon_geslacht'];
            $_SESSION['EID_GB_Datum'] = $row['fld_persoon_gb_datum'];
            $_SESSION['GB_Datum_Onbekend'] = $row['fld_persoon_gb_datum_onbekend'];
            $_SESSION['GB_Plaats'] = $row['fld_persoon_gb_plaats'];
            $_SESSION['Nationaliteit'] = $row['fld_persoon_nation_id_fk'];
            $_SESSION['EID_Rijksregisternr'] = $row['fld_persoon_register_nr'];
            if ($_SESSION['EID_Rijksregisternr'] == NULL){
                $_SESSION['Geen_Rijksregisternr'] = 1;
            }
            $_SESSION['Bisnr'] = $row['fld_persoon_bis_nr'];
            $_SESSION['Godsdienst'] = $row['fld_godsdienst_id_fk'];
            $_SESSION['Overleden'] = $row['fld_persoon_overleden'];
            header("Location: WISA-Formulier.php?persoon");
        }
    }
}
if (isset($_POST['Annuleer']))
    {
        $_SESSION['Bestaande_Persoon'] = 0;
        $_SESSION['Bestaande_Persoon_Id'] = '';
        $_SESSION['Is_Leerling'] = 1;
        $_SESSION['EID_Voornaam'] = '';
        $_SESSION['EID_Achternaam'] = '';
        $_SESSION['Geslacht'] = '';
        $_SESSION['GB_Datum_Onbekend'] = 0;
        $_SESSION['EID_GB_Datum'] = '';
        $_SESSION['GB_Plaats'] = '';
        $_SESSION['Nationaliteit'] = '';
        $_SESSION['EID_Rijksregisternr'] = '';
        $_SESSION['Geen_Rijksregisternr'] = 0;
        $_SESSION['Bisnr'] = '';
        $_SESSION['Godsdienst'] = '';
        $_SESSION['Overleden'] = 0;
        header("Location: WISA-Formulier.php?persoon");
    }

if (isset($_POST['Volgende']))
    {
        header("Location: WISA-Formulier.php?relaties");
    }
        
        
?>
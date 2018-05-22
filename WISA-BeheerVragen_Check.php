<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST["Vraag_opslaan"])) {
    /** Als er een minstens 1 bestemming gekozen is, wordt de rest van de code uitgevoerd */
    if (isset($_POST['Bestemming'])){
        /** De verschillende delen van de vraag worden opgehaald */
        $Vraag_vraag = mysqli_real_escape_string($conn, $_POST['Nieuwe_vraag']);
        $Vraag_kernwoord = mysqli_real_escape_string($conn, $_POST['Kernwoord_vraag']);
        $Soort_antwoord = mysqli_real_escape_string($conn, $_POST['Soort_antwoord']);
        $Bestemming_Id = $_POST['Bestemming'];
        $Antwoord_aantal = mysqli_real_escape_string($conn, $_POST['Max_antwoord']);
        $Mogelijke_antwoorden = $_SESSION['Mogelijke_antwoorden'];
        $Bestaande_lijst = $_POST['Bestaande_lijst'];
        
        /** Er wordt gekeken of het antwoord op de vraag verplicht is */
        if (isset($_POST['Verplicht'])){
            $Verplicht = 1;
        }
        else {
            $Verplicht = 0;
        }
        
        if (isset($_POST['Zichtbaar'])){
            $Zichtbaar = 1;
        }
        else {
            $Zichtbaar = 0;
        }
        
        /** Als de bestaande lijst niet gelijk is aan "..." is er een bestaande lijst gekozen en wordt deze klaar gezet om in de databank in te geven. 
            Indien de gepersonaliseerde lijst bestaat wordt deze leeg gemaakt */
        if ($Bestaande_lijst !== "..."){
            $Bestaande_lijst_id_fk = "fld_bestaande_lijst_id_fk,";
            if ($_SESSION["Bestaande_vraag"] == true){
                $Bestaande_lijst_keuze = "='".$Bestaande_lijst."',";
            }
            else {
                $Bestaande_lijst_keuze = "'".$Bestaande_lijst."',";
            }
            
            if (isset($_SESSION['Mogelijke_antwoorden'])){
                foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord){
                    if (($key = array_search($Mogelijk_antwoord, $_SESSION['Mogelijke_antwoorden'])) !== false){
                        unset($_SESSION['Mogelijke_antwoorden'][$key]);
                    }
                }
            }
        }
        else {
            $Bestaande_lijst_id_fk = NULL;
            $Bestaande_lijst_keuze = NULL;
        }
        
        /** De sql code voor de vraag in te geven */
        if ($_SESSION["Bestaande_vraag"] == true){
            $sqlVraagType = "UPDATE tbl_vragen SET fld_antwoord_type_k_tekst=0, fld_antwoord_type_l_tekst=0, fld_antwoord_type_num=0, fld_antwoord_type_datum=0, fld_antwoord_type_jn=0, fld_antwoord_type_foto=0, fld_antwoord_type_lijst=0, fld_antwoord_type_doc=0 
                             WHERE fld_vraag_id=".$_SESSION['Vraag_Id'];
            if (mysqli_query($conn, $sqlVraagType)){
                $sqlVraag = "UPDATE tbl_vragen SET fld_vraag_vraag='".$Vraag_vraag."', fld_vraag_kernwoord='".$Vraag_kernwoord."', ".$Soort_antwoord."='1', ".$Bestaande_lijst_id_fk.$Bestaande_lijst_keuze."fld_antwoord_aantal='".$Antwoord_aantal."', fld_vraag_antwoord_verplicht='".$Verplicht."', fld_vraag_zichtbaar=".$Zichtbaar." 
                             WHERE fld_vraag_id=".$_SESSION['Vraag_Id'];
            }
            else {
                echo "Error: " . $sqlVraagType . "<br>" . mysqli_error($conn);
            } 
        }
        else {
            $sqlVraag = "INSERT INTO tbl_vragen (fld_vraag_vraag, fld_vraag_kernwoord, ".$Soort_antwoord.", ".$Bestaande_lijst_id_fk." fld_antwoord_aantal, fld_vraag_antwoord_verplicht, fld_vraag_zichtbaar) 
                         VALUES ('".$Vraag_vraag."', '".$Vraag_kernwoord."', '1', ".$Bestaande_lijst_keuze." '".$Antwoord_aantal."', '".$Verplicht."', '".$Zichtbaar."')";
        }
        
        if (mysqli_query($conn, $sqlVraag)){
            $Vraag_Id = mysqli_insert_id($conn);
            if ($_SESSION['Bestaande_vraag'] == true){
                $sqlVerwijder_bestemmingen = "DELETE FROM tbl_vragen_bestemmingen WHERE fld_vraag_id_fk=".$_SESSION['Vraag_Id'];
            }
            foreach ($Bestemming_Id as $Bestemming){
                $sqlBestemming = "INSERT INTO tbl_vragen_bestemmingen (fld_vraag_id_fk, fld_bestemming_id_fk) VALUES ('".$Vraag_Id."', '".$Bestemming."')";
                if (mysqli_query($conn, $sqlBestemming)) {
                    
                }
                else {
                    echo "Error: " . $sqlBestemming . "<br>" . mysqli_error($conn);
                }
            }
            if ($Soort_antwoord == "fld_antwoord_type_lijst" and isset($_SESSION['Mogelijke_antwoorden'])) {
                if ($_SESSION['Bestaande_vraag'] == true){
                    foreach ($_SESSION['Toegevoegde_antwoorden'] as $Toegevoegd_antwoord) {
                        $sqlToegevoegdeAntwoorden = "INSERT INTO tbl_antwoorden_lijst(fld_vraag_id_fk, fld_lijst_item) 
                                                     VALUES ('".$_SESSION['Vraag_Id']."','".$Toegevoegd_antwoord."')";
                        if (mysqli_query($conn, $sqlToegevoegdeAntwoorden)) {
                            
                        }
                        else {
                            echo "Error: " . $sqlToegevoegdeAntwoorden . "<br>" . mysqli_error($conn);
                        }
                    }
                }
                else {
                    foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord) {
                        $sqlMogelijkeAntwoorden = "INSERT INTO tbl_antwoorden_lijst(fld_vraag_id_fk, fld_lijst_item) 
                                                   VALUES ('".$Vraag_Id."','".$Mogelijk_antwoord."')";
                        if (mysqli_query($conn, $sqlMogelijkeAntwoorden)) {
                            
                        }
                        else {
                            echo "Error: " . $sqlMogelijkeAntwoorden . "<br>" . mysqli_error($conn);
                        }
                    }
                }
            }
        }
        else {
            echo "Error: " . $sqlVraag . "<br>" . mysqli_error($conn);
        }
        
        $_SESSION['Bestaande_vraag'] = false;
        $_SESSION['Nieuwe_vraag'] = '';
        $_SESSION['Kernwoord_vraag'] = '';
        $_SESSION['Max_antwoord'] = 1;
        $_SESSION['Mogelijke_antwoorden'] = [];
        $_SESSION['Antwoord_type'] = "";
        $_SESSION['Bestemmingen'] = [];
        $_SESSION['Verplicht'] = "";
        $_SESSION['Zichtbaar'] = "";
        $_SESSION['Bestaande_lijst'] = NULL;
        $_SESSION['Toegevoegde_antwoorden'] = [];
        header("Location: WISA-Formulier.php?beheervragen");
    }
    else {
        header("Location: WISA-Formulier.php?beheervragen");
    }
}


if (isset($_POST["Mogelijk_antwoord_toevoegen"])) {
    $Mogelijk_antwoord_toevoegen = mysqli_real_escape_string($conn, $_POST['Mogelijk_antwoord']);
    if ($Mogelijk_antwoord_toevoegen !== ''){
        if ($_SESSION['Bestaande_vraag'] == true){
            if (isset($_SESSION['Toegevoegde_antwoorden'])) {
             array_push($_SESSION['Toegevoegde_antwoorden'],mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
            }
            else {
                $_SESSION['Toegevoegde_antwoorden'] = array(mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
            }
        }
        
        if (isset($_SESSION['Mogelijke_antwoorden'])) {
         array_push($_SESSION['Mogelijke_antwoorden'],mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
        }
        else {
            $_SESSION['Mogelijke_antwoorden'] = array(mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
        }
    }
    // if bestaande vraag == true -> array met toegevoegde antwoorden
    $_SESSION['Nieuwe_vraag'] = mysqli_real_escape_string($conn, $_POST['Nieuwe_vraag']);
    $_SESSION['Kernwoord_vraag'] = mysqli_real_escape_string($conn, $_POST['Kernwoord_vraag']);
    $_SESSION['Max_antwoord'] = mysqli_real_escape_string($conn, $_POST['Max_antwoord']);
    $_SESSION['Antwoord_type'] = mysqli_real_escape_string($conn, $_POST['Soort_antwoord']);
    header("Location: WISA-Formulier.php?beheervragen");
}

if (isset($_SESSION['Mogelijke_antwoorden'])){
    foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord_verwijderen){
        // if bestaande vraag == true -> array met verwijderde antwoorden
        echo "Mogelijk_antwoord_verwijderen = ".$Mogelijk_antwoord_verwijderen;
        $Mogelijk_antwoord_verwijderen_no_space = str_replace(' ', '_', $Mogelijk_antwoord_verwijderen);
        if (isset($_POST[$Mogelijk_antwoord_verwijderen_no_space])){
            if (($key = array_search($Mogelijk_antwoord_verwijderen, $_SESSION['Mogelijke_antwoorden'])) !== false){
                unset($_SESSION['Mogelijke_antwoorden'][$key]);
                header ("Location: WISA-Formulier.php?beheervragen");
            }
        }
    }
}

if (isset($_POST['Vraag_annuleren'])){
    $_SESSION['Bestaande_vraag'] = false;
    $_SESSION['Nieuwe_vraag'] = '';
    $_SESSION['Kernwoord_vraag'] = '';
    $_SESSION['Max_antwoord'] = 1;
    $_SESSION['Mogelijke_antwoorden'] = [];
    $_SESSION['Antwoord_type'] = "";
    $_SESSION['Bestemmingen'] = [];
    $_SESSION['Verplicht'] = "";
    $_SESSION['Zichtbaar'] = "1";
    $_SESSION['Bestaande_lijst'] = NULL;
    $_SESSION['Toegevoegde_antwoorden'] = [];
    header("Location: WISA-Formulier.php?beheervragen");
}

if (isset($_POST['Vraag_Zoeken_btn'])){
    $Vraag_Zoeken = mysqli_real_escape_string($conn, $_POST['Vraag_Zoeken']);
    if ($Vraag_Zoeken == '' || $Vraag_Zoeken == 'undefined'){
        header("Location: WISA-Formulier.php?beheervragen");
    }
    $sql = "SELECT * FROM tbl_vragen WHERE fld_vraag_id=".$Vraag_Zoeken;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['Vraag_Id'] = $row['fld_vraag_id'];
            $_SESSION['Bestaande_vraag'] = true;
            $_SESSION['Nieuwe_vraag'] = $row['fld_vraag_vraag'];
            $_SESSION['Kernwoord_vraag'] = $row['fld_vraag_kernwoord'];
            if ($row['fld_antwoord_type_k_tekst'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_k_tekst";
            }
            else if ($row['fld_antwoord_type_l_tekst'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_l_tekst";
            }
            else if ($row['fld_antwoord_type_num'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_num";
            }
            else if ($row['fld_antwoord_type_datum'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_datum";
            }
            else if ($row['fld_antwoord_type_jn'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_jn";
            }
            else if ($row['fld_antwoord_type_foto'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_foto";
            }
            else if ($row['fld_antwoord_type_lijst'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_lijst";
            }
            else if ($row['fld_antwoord_type_doc'] == 1){
                $_SESSION['Antwoord_type'] = "fld_antwoord_type_doc";
            }
            $_SESSION['Max_antwoord'] = $row["fld_antwoord_aantal"];
            
            $sqlBestemmingen = "SELECT * FROM tbl_vragen_bestemmingen WHERE fld_vraag_id_fk=".$Vraag_Zoeken;
            $resultBestem = mysqli_query($conn, $sqlBestemmingen);
            $_SESSION["Bestemmingen"] = [];
            if (mysqli_num_rows($resultBestem) > 0) {
                while($rowBestem = mysqli_fetch_assoc($resultBestem)){
                    array_push($_SESSION['Bestemmingen'], $rowBestem["fld_bestemming_id_fk"]);
                }
            }
            
            $sqlAntw = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_vraag_id_fk=".$Vraag_Zoeken;
            $resultAntw = mysqli_query($conn, $sqlAntw);
            $_SESSION["Mogelijke_antwoorden"] = [];
            if (mysqli_num_rows($resultBestem) > 0) {
                while($rowAntw = mysqli_fetch_assoc($resultAntw)){
                    array_push($_SESSION['Mogelijke_antwoorden'], $rowAntw["fld_lijst_item"]);
                }
            }
            $_SESSION['Bestaande_lijst'] = $row['fld_bestaande_lijst_id_fk'];
            $_SESSION['Verplicht'] = $row["fld_vraag_antwoord_verplicht"];
            $_SESSION['Zichtbaar'] = $row["fld_vraag_zichtbaar"];
            header("Location: WISA-Formulier.php?beheervragen");
        }
    }        
}
?>
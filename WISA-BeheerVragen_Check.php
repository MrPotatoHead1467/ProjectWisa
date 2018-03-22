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
        
        /** Als de bestaande lijst niet gelijk is aan "..." is er een bestaande lijst gekozen en wordt deze klaar gezet om in de databank in te geven. 
            Indien de gepersonaliseerde lijst bestaat wordt deze leeg gemaakt */
        if ($Bestaande_lijst !== "..."){
            $Bestaande_lijst_id_fk = "fld_bestaande_lijst_id_fk,";
            $Bestaande_lijst_keuze = "'".$Bestaande_lijst."',";
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
        $sqlVraag = "INSERT INTO tbl_vragen (fld_vraag_vraag, fld_vraag_kernwoord, ".$Soort_antwoord.", ".$Bestaande_lijst_id_fk." fld_antwoord_aantal, fld_vraag_antwoord_verplicht) VALUES ('".$Vraag_vraag."', '".$Vraag_kernwoord."', '1', ".$Bestaande_lijst_keuze." '".$Antwoord_aantal."', '".$Verplicht."')";
        if (mysqli_query($conn, $sqlVraag)){
            $Vraag_Id = mysqli_insert_id($conn);
            foreach ($Bestemming_Id as $Bestemming){
                $sqlBestemming = "INSERT INTO tbl_vragen_bestemmingen (fld_vraag_id_fk, fld_bestemming_id_fk) VALUES ('".$Vraag_Id."', '".$Bestemming."')";
                if (mysqli_query($conn, $sqlBestemming)) {
                    
                }
                else {
                    echo "Error: " . $sqlBestemming . "<br>" . mysqli_error($conn);
                }
            }
            if ($Soort_antwoord == "fld_antwoord_type_lijst" and isset($_SESSION['Mogelijke_antwoorden'])) {
                foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord) {
                    $sqlMogelijkeAntwoorden = "INSERT INTO tbl_antwoorden_lijst(fld_vraag_id_fk,fld_lijst_item) VALUES ('".$Vraag_Id."','".$Mogelijk_antwoord."')";
                    if (mysqli_query($conn, $sqlMogelijkeAntwoorden)) {
                        
                    }
                    else {
                        echo "Error: " . $sqlMogelijkeAntwoorden . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
        else {
            echo "Error: " . $sqlVraag . "<br>" . mysqli_error($conn);
        }
        
        $_SESSION['Nieuwe_vraag'] = "";
        $_SESSION['Kernwoord_vraag'] = "";
        $_SESSION['Max_antwoord'] = "1";
        if (isset($_SESSION['Mogelijke_antwoorden'])){
            foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord){
                if (($key = array_search($Mogelijk_antwoord, $_SESSION['Mogelijke_antwoorden'])) !== false){
                    unset($_SESSION['Mogelijke_antwoorden'][$key]);
                }
            }
        }
        header("Location: WISA-Formulier.php");
    }
    else {
        header("Location: WISA-Formulier.php");
    }
}


if (isset($_POST["Mogelijk_antwoord_toevoegen"])) {
    $Mogelijk_antwoord_toevoegen = mysqli_real_escape_string($conn, $_POST['Mogelijk_antwoord']);
    if ($Mogelijk_antwoord_toevoegen !== ''){
        if (isset($_SESSION['Mogelijke_antwoorden'])) {
             array_push($_SESSION['Mogelijke_antwoorden'],mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
        }
        else {
            $_SESSION['Mogelijke_antwoorden'] = array(mysqli_real_escape_string($conn, $Mogelijk_antwoord_toevoegen));
        }
    }
    
    $_SESSION['Nieuwe_vraag'] = mysqli_real_escape_string($conn, $_POST['Nieuwe_vraag']);
    $_SESSION['Kernwoord_vraag'] = mysqli_real_escape_string($conn, $_POST['Kernwoord_vraag']);
    $_SESSION['Max_antwoord'] = mysqli_real_escape_string($conn, $_POST['Max_antwoord']);
    header("Location: WISA-Formulier.php");
}

if (isset($_SESSION['Mogelijke_antwoorden'])){
    foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord_verwijderen){
        echo "Mogelijk_antwoord_verwijderen = ".$Mogelijk_antwoord_verwijderen;
        $Mogelijk_antwoord_verwijderen_no_space = str_replace(' ', '_', $Mogelijk_antwoord_verwijderen);
        if (isset($_POST[$Mogelijk_antwoord_verwijderen_no_space])){
            if (($key = array_search($Mogelijk_antwoord_verwijderen, $_SESSION['Mogelijke_antwoorden'])) !== false){
                unset($_SESSION['Mogelijke_antwoorden'][$key]);
                header ("Location: WISA-Formulier.php");
            }
        }
    }
}

/**
$x = -1;
foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord_verwijderen){
    if (isset($_POST[$x])){
        $Mogelijk_antwoord_wijzigen = array($i => mysqli_real_escape_string($conn, $_POST['Mogelijke_antwoorden['.$i.']']));
        $_SESSION['Mogelijke_antwoorden'] = array_replace($_SESSION['Mogelijke_antwoorden'], $Mogelijk_antwoord_wijzigen);
        header ("Location: WISA-BeheerVragen.php");
    }
    --$x;
    ++$i;
}
*/

if (isset($_POST['Vraag_annuleren'])){
    $_SESSION['Nieuwe_vraag'] = '';
    $_SESSION['Kernwoord_vraag'] = '';
    $_SESSION['Max_antwoord'] = 1;
    if (isset($_SESSION['Mogelijke_antwoorden'])){
        foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord_verwijderen){
            if (($key = array_search($Mogelijk_antwoord_verwijderen, $_SESSION['Mogelijke_antwoorden'])) !== false){
                unset($_SESSION['Mogelijke_antwoorden'][$key]);
            }
        }
    }
    header("Location: WISA-Formulier.php");
}

?>
<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Instellingen_opslaan'])){
    $Plaats_Docs = mysqli_real_escape_string($conn, $_POST['Plaats_Docs']);
    $Printen = mysqli_real_escape_string($conn, $_POST['Printen']);
    $Handtekening = mysqli_real_escape_string($conn, $_POST['Handtekening']);
    $Naam_Doc = mysqli_real_escape_string($conn, $_POST['Naam_Doc']);
    $sql = "SELECT * FROM tbl_instellingen";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sqlInstellingen = "UPDATE tbl_instellingen SET fld_instelling_plaats_docs='".$Plaats_Docs."', fld_instelling_titel_doc='".$Naam_Doc."'";
    }
    else {
        $sqlInstellingen = "INSERT INTO tbl_instellingen (fld_instelling_plaats_docs, fld_instelling_titel_doc)
                            VALUES ('".$Plaats_Docs."', '".$Naam_Doc."')";
    }
    
    if (mysqli_query($conn, $sqlInstellingen)){
        
    }
    header("Location: WISA-Formulier.php?instelling");
}

if (isset($_POST['Voorwaarde_toevoegen'])){
    $Voorwaarde_toevoegen = mysqli_real_escape_string($conn, $_POST['Voorwaarde']);
    if ($Voorwaarde_toevoegen !== ''){
        if ($_SESSION['Bestaande_instellingen'] == true){
            if (isset($_SESSION['Toegevoegde_voorwaarden'])) {
             array_push($_SESSION['Toegevoegde_voorwaarden'],mysqli_real_escape_string($conn, $Voorwaarde_toevoegen));
            }
            else {
                $_SESSION['Toegevoegde_voorwaarden'] = array(mysqli_real_escape_string($conn, $Voorwaarde_toevoegen));
            }
        }
        
        if (isset($_SESSION['Voorwaarden'])) {
            array_push($_SESSION['Voorwaarden'],mysqli_real_escape_string($conn, $Voorwaarde_toevoegen));
        }
        else {
            $_SESSION['Voorwaarden'] = array(mysqli_real_escape_string($conn, $Voorwaarde_toevoegen));
        }
    }
    header("Location: WISA-Formulier.php?instelling");
}

if (isset($_SESSION['Voorwaarden'])){
    foreach ($_SESSION['Voorwaarden'] as $Voorwaarde_verwijderen){
        echo "Voorwaarde_verwijderen = ".$Voorwaarde_verwijderen;
        $Voorwaarde_verwijderen_no_space = str_replace(' ', '_', $Voorwaarde_verwijderen);
        if (isset($_POST[$Voorwaarde_verwijderen_no_space])){
            if (($key = array_search($Voorwaarde_verwijderen, $_SESSION['Voorwaarden'])) !== false){
                unset($_SESSION['Voorwaarden'][$key]);
                header ("Location: WISA-Formulier.php?instelling");
            }
        }
    }
}

?>
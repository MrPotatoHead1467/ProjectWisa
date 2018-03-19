<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Relatie_opslaan'])){
    if (isset($_SESSION['Leerling'])){
        $Persoon_1 = $_SESSION['Leerling'];
    }
    else {
        $Persoon_1 = mysqli_real_escape_string($conn, $_POST['Persoon_1']);
    }
    
    $Relatie = mysqli_real_escape_string($conn, $_POST['Relatie']);
    $Persoon_2 = mysqli_real_escape_string($conn, $_POST['Persoon_2']);
    $Beschrijving = mysqli_real_escape_string($conn, $_POST['Relatie_beschrijving']);
    
    $sqlRelatie = "INSERT INTO tbl_personen_linken (fld_master_id_fk, fld_child_id_fk, fld_soort_id_fk, fld_persoon_link_beschrijving)
                   VALUES ('".$Persoon_2."', '".$Persoon_1."', '".$Relatie."', '".$Beschrijving."')";
    
    if (mysqli_query($conn, $sqlRelatie)){
        if (isset($_SESSION['Filter_1'])){
            unset($_SESSION['Filter_1']);
        }
        if (isset($_SESSION['Filter_2'])){
            unset($_SESSION['Filter_2']);
        }
        
        header("Location: WISA-Formulier.php");
    }
    else {
        echo "Error: " . $sqlRelatie . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['Filter_1_Zoeken'])){
    $Filter_1 = mysqli_real_escape_string($conn, $_POST['Filter_1']);
    $_SESSION['Filter_1'] = "SELECT * FROM tbl_personen WHERE fld_persoon_naam LIKE '%".$Filter_1."%'";
    header("Location: WISA-Formulier.php");
}

if (isset($_POST['Filter_2_Zoeken'])){
    $Filter_2 = mysqli_real_escape_string($conn, $_POST['Filter_2']);
    $_SESSION['Filter_2'] = "SELECT * FROM tbl_personen WHERE fld_persoon_naam LIKE '%".$Filter_2."%'";
    header("Location: WISA-Formulier.php");
}

?>
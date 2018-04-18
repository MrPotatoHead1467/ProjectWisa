<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Loopbaan_Opslaan'])){
    $_SESSION['Leerling'] = 13;
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
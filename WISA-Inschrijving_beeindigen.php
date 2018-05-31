<?php
session_start();
include "WISA-Connection.php";
if (isset($_POST['Inschr_Opslaan'])){
    $Datum = date('Y-m-d');
    $Uur = date('H:i:s');
    $Commentaar = mysqli_real_escape_string($conn, $_POST['Comm_Inschr']);
    if ($Commentaar == ''){
        $Commentaar = NULL;
        $fld_Commentaar = NULL;
    }
    else {
        $fld_Commentaar = "fld_inschrijving_commentaar, ";
        $Commentaar = "'".$Commentaar."', ";
    }
    $sql = "INSERT INTO tbl_inschrijvingen (fld_inschrijving_datum, fld_inschrijving_uur, fld_persoon_id_fk, fld_gebruiker_id_fk, ".$fld_Commentaar."fld_inschrijving_status_id_fk)
            VALUES ('".$Datum."', '".$Uur."', '".$_SESSION['Leerling']."', '".$_SESSION['gebruikerID']."', ".$Commentaar."1)";
    if (mysqli_query($conn, $sql)){       
        header("Location: WISA-InschrijvingPDF.php");
        exit();
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

}

?>
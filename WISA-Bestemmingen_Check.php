<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Bestem_Opslaan'])){
    $Bestemming = mysqli_real_escape_string($conn, $_POST['Bestem']);
    $Beschrijving = mysqli_real_escape_string($conn, $_POST['Beschr_Bestem']);
    if (isset($_SESSION['Bestaande_bestemming']) && $_SESSION['Bestaande_bestemming'] == true){
        $sqlBestemming = "UPDATE tbl_bestemmingen SET fld_bestemming_naam='".$Bestemming."', fld_bestemming_beschrijving='".$Beschrijving."'
                          WHERE fld_bestemming_id=".$_SESSION['Bestemming_Id'];
    }
    else {
        $sqlBestemming = "INSERT INTO tbl_bestemmingen (fld_bestemming_naam, fld_bestemming_beschrijving)
                          VALUES ('".$Bestemming."', '".$Beschrijving."'";
    }
    if (mysqli_query($conn, $sqlBestemming)){
        header("Location: WISA-Formulier.php?bestemmingen");
    }
    else {
        echo "Error: " . $sqlBestemming . "<br>" . mysqli_error($conn);
    }
    $_SESSION['Bestemming_Id'] = "";
    $_SESSION['Bestaande_bestemming'] = false;
    $_SESSION['Bestemming_Naam'] = "";
    $_SESSION['Bestemming_Besch'] = "";
}

if (isset($_POST['Bestem_Zoeken_btn'])){
    $Bestem_Zoeken = mysqli_real_escape_string($conn, $_POST['Bestem_Zoeken']);
    if ($Bestem_Zoeken == '' || $Bestem_Zoeken == 'undefined'){
        header("Location: WISA-Formulier.php?bestemmingen");
    }
    $sql = "SELECT * FROM tbl_bestemmingen WHERE fld_bestemming_id=".$Bestem_Zoeken;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['Bestemming_Id'] = $row['fld_bestemming_id'];
            $_SESSION['Bestaande_bestemming'] = true;
            $_SESSION['Bestemming_Naam'] = $row['fld_bestemming_naam'];
            $_SESSION['Bestemming_Besch'] = $row['fld_bestemming_beschrijving'];
            header("Location: WISA-Formulier.php?bestemmingen");
        }
    }
}
?>
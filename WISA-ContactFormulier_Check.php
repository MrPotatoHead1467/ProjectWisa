<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Contact_Opslaan'])){
    if (isset($_SESSION['Mogelijke_Adressen']))
        {
            foreach ($_SESSION['Mogelijke_Adressen'] as $i => $Mogelijk_Adres)
                {
                    foreach ($Mogelijk_Adres as $Omsch => $Waarde)
                        {
                            if ($Omsch == 'Adres_Straat'){
                                $Adres_Straat = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Huisnr'){
                                $Adres_Huisnr = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Bus'){
                                $Adres_Bus = $Waarde;
                                if ($Adres_Bus != ''){
                                    $Adres_Bus = ", '".$Adres_Bus."'";
                                    $fld_Bus = ", fld_adres_bus_nr";
                                }
                                else{
                                    $Adres_Bus = NULL;
                                    $fld_Bus = NULL;
                                }
                            }
                            elseif ($Omsch == 'Adres_Niet_Be'){
                                $Adres_Niet_Be = $Waarde;
                                if ($Adres_Niet_Be != ''){
                                    $Adres_Niet_Be = ", '".$Adres_Niet_Be."'";
                                }
                            }
                            elseif ($Omsch == 'Adres_Woonplaats'){
                                $Adres_Postcode = $Waarde;
                                if ($Adres_Postcode != ''){
                                    $Adres_Postcode = ", '".$Adres_Postcode."'";
                                }
                                else{
                                    $Adres_Postcode = NULL;
                                    $fld_Postcode = NULL;
                                }
                            }
                            elseif ($Omsch == 'Adres_Land'){
                                $Land = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Soort'){
                                $Adres_Soort = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Besch'){
                                $Adres_Besch = $Waarde;
                                if ($Adres_Besch != ''){
                                    $Adres_Besch = " (".$Adres_Besch.")";
                                }
                            }
                            $sqlAdres = "INSERT INTO tbl_adressen(fld_adres_straatnaam, fld_adres_huis_nr".$fld_Bus.$fld_Postcode.", fld_adres_land_id_fk, fld_adres_niet_be)
                                         VALUES ('".$Straat."', '".$Huisnrs."'".$Bus." '".$Postcode."', '";
                        }
                }
        }
}

if (isset($_POST["GSM_Opslaan"])) {
    $GSM_Opslaan = mysqli_real_escape_string($conn, $_POST['GSM']);
    $GSM_Soort = mysqli_real_escape_string($conn, $_POST['Soort_GSM_Zoeken']);
    $GSM_Besch = mysqli_real_escape_string($conn, $_POST['Besch_GSM']);
    if ($GSM_Opslaan !== ''){
        $GSM_Array = array('GSM_Nr' => $GSM_Opslaan,
                           'GSM_Soort' => $GSM_Soort,
                           'GSM_Besch' => $GSM_Besch);
                           
        if (isset($_SESSION['Mogelijke_GSM_nrs'])) {
             array_push($_SESSION['Mogelijke_GSM_nrs'], $GSM_Array);
        }
        else {
            $_SESSION['Mogelijke_GSM_nrs'] = array($GSM_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
}

if (isset($_SESSION['Mogelijke_GSM_nrs'])){
    $i = 0;
    foreach ($_SESSION['Mogelijke_GSM_nrs'] as $Mogelijk_GSM_verwijderen){
        while ($i <= 50){
            if (isset($_POST['GSM_'.$i])){
                unset($_SESSION['Mogelijke_GSM_nrs'][$i]);
                header ("Location: WISA-Formulier.php?contact");
            }
            ++$i;
        }
    }
}

if (isset($_POST["Telefoon_Opslaan"])) {
    $Tel_Opslaan = mysqli_real_escape_string($conn, $_POST['Telefoon']);
    $Tel_Soort = mysqli_real_escape_string($conn, $_POST['Soort_Tel_Zoeken']);
    $Tel_Besch = mysqli_real_escape_string($conn, $_POST['Besch_Tel']);
    if ($Tel_Opslaan !== ''){
        $Tel_Array = array('Tel_Nr' => $Tel_Opslaan,
                           'Tel_Soort' => $Tel_Soort,
                           'Tel_Besch' => $Tel_Besch);
                           
        if (isset($_SESSION['Mogelijke_Tel_nrs'])) {
             array_push($_SESSION['Mogelijke_Tel_nrs'], $Tel_Array);
        }
        else {
            $_SESSION['Mogelijke_Tel_nrs'] = array($Tel_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
}

if (isset($_SESSION['Mogelijke_Tel_nrs'])){
    $i = 0;
    foreach ($_SESSION['Mogelijke_Tel_nrs'] as $Mogelijk_Tel_verwijderen){
        while ($i <= 50){
            if (isset($_POST['Tel_'.$i])){
                unset($_SESSION['Mogelijke_Tel_nrs'][$i]);
                header ("Location: WISA-Formulier.php?contact");
            }
            ++$i;
        }
    }
}

if (isset($_POST["EMail_Opslaan"])) {
    $EMail_Opslaan = mysqli_real_escape_string($conn, $_POST['EMail']);
    $EMail_Soort = mysqli_real_escape_string($conn, $_POST['Soort_EMail_Zoeken']);
    $EMail_Besch = mysqli_real_escape_string($conn, $_POST['Besch_EMail']);
    if ($EMail_Opslaan !== ''){
        $EMail_Array = array('EMail' => $EMail_Opslaan,
                             'EMail_Soort' => $EMail_Soort,
                             'EMail_Besch' => $EMail_Besch);
                             
        if (isset($_SESSION['Mogelijke_EMail'])) {
             array_push($_SESSION['Mogelijke_EMail'], $EMail_Array);
        }
        else {
            $_SESSION['Mogelijke_EMail'] = array($EMail_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
}

if (isset($_SESSION['Mogelijke_EMail'])){
    $i = 0;
    foreach ($_SESSION['Mogelijke_EMail'] as $Mogelijk_EMail_verwijderen){
        while ($i <= 50){
            if (isset($_POST['EMail_'.$i])){
                unset($_SESSION['Mogelijke_EMail'][$i]);
                header ("Location: WISA-Formulier.php?contact");
            }
            ++$i;
        }
    }
}
if (isset($_POST["Adres_Opslaan"])) {
    $Adres_Straat = mysqli_real_escape_string($conn, $_POST['Straat']);
    $Adres_Huisnr = mysqli_real_escape_string($conn, $_POST['Huisnummer']);
    $Adres_Bus = mysqli_real_escape_string($conn, $_POST['Bus']);
    if (isset($_POST['Niet_Be'])){
        $Niet_Be = true;
        $Adres_Woonplaats = mysqli_real_escape_string($conn, $_POST['Woonplaats_niet_be_in']);
        $Adres_Land = mysqli_real_escape_string($conn, $_POST['Land_Zoeken']);
    }
    else {
        $Niet_Be = false;
        $Adres_Woonplaats = mysqli_real_escape_string($conn, $_POST['Woonplaats']);
        $Adres_Be = mysqli_real_escape_string($conn, $_POST['Land_Be_Hidden']);
        $sqlLand = "SELECT * FROM tbl_landen WHERE fld_land_naam = '".$Adres_Be."'";
        $result = $conn->query($sqlLand);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $Adres_Land = $row['fld_land_id'];
            }
        }
    }
    
    $Adres_Soort = mysqli_real_escape_string($conn, $_POST['Soort_Adres_Zoeken']);
    $Adres_Besch = mysqli_real_escape_string($conn, $_POST['Besch_Adres']);
    if ($Adres_Opslaan !== ''){
        $Adres_Array = array('Adres_Straat' => $Adres_Straat,
                             'Adres_Huisnr' => $Adres_Huisnr,
                             'Adres_Bus' => $Adres_Bus,
                             'Adres_Niet_Be' => $Niet_Be,
                             'Adres_Woonplaats' => $Adres_Woonplaats,
                             'Adres_Land' => $Adres_Land,
                             'Adres_Soort' => $Adres_Soort,
                             'Adres_Besch' => $Adres_Besch);
                             
        if (isset($_SESSION['Mogelijke_Adressen'])) {
             array_push($_SESSION['Mogelijke_Adressen'], $Adres_Array);
        }
        else {
            $_SESSION['Mogelijke_Adressen'] = array($Adres_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
}

if (isset($_SESSION['Mogelijke_Adressen'])){
    $i = 0;
    foreach ($_SESSION['Mogelijke_Adressen'] as $Mogelijk_Adres_verwijderen){
        while ($i <= 50){
            if (isset($_POST['Adres_'.$i])){
                unset($_SESSION['Mogelijke_Adressen'][$i]);
                header ("Location: WISA-Formulier.php?contact");
                
            }
            ++$i;
        }
    }
}
?>
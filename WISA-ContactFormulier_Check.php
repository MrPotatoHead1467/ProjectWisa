<?php
session_start();
include "WISA-Connection.php";

if (isset($_POST['Contact_Opslaan'])){
    if (isset($_SESSION['Contact']) && $_SESSION['Contact'] != '' && $_SESSION['Contact'] != 'undefined'){
        $Persoon_Id = $_SESSION['Contact'];
    }
    else{
        header ("Location: WISA-Formulier.php?contact");
        exit();
    }
    
    if (isset($_SESSION['Mogelijke_Adressen']) && $_SESSION['Mogelijke_Adressen'] != '')
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
                            }
                            elseif ($Omsch == 'Adres_Woonplaats'){
                                $Adres_Postcode = $Waarde;
                                if ($Adres_Niet_Be == false){
                                    if ($Adres_Postcode != ''){
                                    $Adres_Postcode = ", '".$Adres_Postcode."'";
                                    $fld_Postcode = ", fld_adres_postcode_id_fk";
                                    }
                                    else{
                                        $Adres_Postcode = NULL;
                                        $fld_Postcode = NULL;
                                    }
                                }
                                else {
                                    if ($Adres_Postcode != ''){
                                    $Adres_Postcode = ", '".$Adres_Postcode."'";
                                    $fld_Postcode = ", fld_adres_niet_be";
                                    }
                                    else{
                                        $Adres_Postcode = NULL;
                                        $fld_Postcode = NULL;
                                    }
                                }
                                
                            }
                            elseif ($Omsch == 'Adres_Land'){
                                $Adres_Land = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Soort'){
                                $Adres_Soort = $Waarde;
                            }
                            elseif ($Omsch == 'Adres_Besch'){
                                $Adres_Besch = $Waarde;
                                if ($Adres_Besch != ''){
                                    $Adres_Besch = ", '".$Adres_Besch."'";
                                    $fld_Adres_Besch = ", fld_adres_link_beschrijving";
                                }
                                else{
                                    $Adres_Besch = NULL;
                                    $fld_Adres_Besch = NULL;
                                }
                            }
                        }
                        $sqlAdres = "INSERT INTO tbl_adressen(fld_adres_straatnaam, fld_adres_huis_nr".$fld_Bus.$fld_Postcode.", fld_adres_land_id_fk)
                                     VALUES ('".$Adres_Straat."', '".$Adres_Huisnr."'".$Adres_Bus.$Adres_Postcode.", '".$Adres_Land."')";
                                     
                        if (mysqli_query($conn, $sqlAdres)){
                            $Adres_Id = mysqli_insert_id($conn);
                            $sqlAdres_Link = "INSERT INTO tbl_adressen_linken (fld_persoon_id_fk, fld_adres_id_fk, fld_soort_id_fk".$fld_Adres_Besch.") 
                                              VALUES ('".$Persoon_Id."', '".$Adres_Id."', '".$Adres_Soort."'".$Adres_Besch.")";
                            if (mysqli_query($conn, $sqlAdres_Link)){
                                echo "Adres_Gelukt<br />";
                            }
                            else {
                                echo "Error: " . $sqlAdres_Link . "<br>" . mysqli_error($conn);
                            }
                        }
                        else {
                            echo "Error: " . $sqlAdres . "<br>" . mysqli_error($conn);
                        }                        
                }
                $_SESSION['Mogelijke_Adressen'] = '';
        }
        
     if (isset($_SESSION['Mogelijke_GSM_nrs']) && $_SESSION['Mogelijke_GSM_nrs'] != '')
        {
            foreach ($_SESSION['Mogelijke_GSM_nrs'] as $i => $Mogelijk_GSM)
                {
                    foreach ($Mogelijk_GSM as $Omsch => $Waarde)
                        {
                            if ($Omsch == 'GSM_Nr'){
                                $GSM_Nr = $Waarde;
                            }
                            elseif ($Omsch == 'GSM_Soort'){
                                $GSM_Soort = $Waarde;
                            }
                            elseif ($Omsch == 'GSM_Besch'){
                                $GSM_Besch = $Waarde;
                                if ($GSM_Besch != ''){
                                    $GSM_Besch = ", '".$GSM_Besch."'";
                                    $fld_GSM_Besch = ", fld_persoon_gegeven_beschrijving";
                                }
                                else{
                                    $GSM_Besch = NULL;
                                    $fld_GSM_Besch = NULL;
                                }
                            }
                        }
                        $sqlGSM = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk) 
                                   VALUES ('".$GSM_Nr."', '3')";
                                   
                         if (mysqli_query($conn, $sqlGSM)){
                            $GSM_Id = mysqli_insert_id($conn);
                            $sqlGSM_Link = "INSERT INTO tbl_personen_gegevens (fld_persoon_id_fk, fld_gegeven_id_fk, fld_soort_id_fk".$fld_GSM_Besch.") 
                                              VALUES ('".$Persoon_Id."', '".$GSM_Id."', '".$GSM_Soort."'".$GSM_Besch.")";
                            
                            if (mysqli_query($conn, $sqlGSM_Link)){
                                echo "GSM_Gelukt";
                            }
                            else {
                                echo "Error: " . $sqlGSM_Link . "<br>" . mysqli_error($conn);
                            }
                        }
                        else {
                            echo "Error: " . $sqlGSM . "<br>" . mysqli_error($conn);
                        }
                }
        }
        $_SESSION['Mogelijke_GSM_nrs'] = '';
     
     if (isset($_SESSION['Mogelijke_Tel_nrs']) && $_SESSION['Mogelijke_Tel_nrs'] != '')
        {
            foreach ($_SESSION['Mogelijke_Tel_nrs'] as $i => $Mogelijk_Tel)
                {
                    foreach ($Mogelijk_Tel as $Omsch => $Waarde)
                        {
                            if ($Omsch == 'Tel_Nr'){
                                $Tel_Nr = $Waarde;
                            }
                            elseif ($Omsch == 'Tel_Soort'){
                                $Tel_Soort = $Waarde;
                            }
                            elseif ($Omsch == 'Tel_Besch'){
                                $Tel_Besch = $Waarde;
                                if ($Tel_Besch != ''){
                                    $Tel_Besch = ", '".$Tel_Besch."'";
                                    $fld_Tel_Besch = ", fld_persoon_gegeven_beschrijving";
                                }
                                else{
                                    $Tel_Besch = NULL;
                                    $fld_Tel_Besch = NULL;
                                }
                            }
                        }
                        $sqlTel = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk) 
                                   VALUES ('".$Tel_Nr."', '2')";
                                   
                         if (mysqli_query($conn, $sqlTel)){
                            $Tel_Id = mysqli_insert_id($conn);
                            $sqlTel_Link = "INSERT INTO tbl_personen_gegevens (fld_persoon_id_fk, fld_gegeven_id_fk, fld_soort_id_fk".$fld_Tel_Besch.") 
                                              VALUES ('".$Persoon_Id."', '".$Tel_Id."', '".$Tel_Soort."'".$Tel_Besch.")";
                            
                            if (mysqli_query($conn, $sqlTel_Link)){
                                echo "Tel_Gelukt";
                            }
                            else {
                                echo "Error: " . $sqlTel_Link . "<br>" . mysqli_error($conn);
                            }
                        }
                        else {
                            echo "Error: " . $sqlTel . "<br>" . mysqli_error($conn);
                        }
                }
        }
        $_SESSION['Mogelijke_Tel_nrs'] = '';
        
     if (isset($_SESSION['Mogelijke_EMail']) && $_SESSION['Mogelijke_EMail'] != '')
        {
            foreach ($_SESSION['Mogelijke_EMail'] as $i => $Mogelijk_EMail)
                {
                    foreach ($Mogelijk_EMail as $Omsch => $Waarde)
                        {
                            if ($Omsch == 'EMail'){
                                $EMail_Nr = $Waarde;
                            }
                            elseif ($Omsch == 'EMail_Soort'){
                                $EMail_Soort = $Waarde;
                            }
                            elseif ($Omsch == 'EMail_Besch'){
                                $EMail_Besch = $Waarde;
                                if ($EMail_Besch != ''){
                                    $EMail_Besch = ", '".$EMail_Besch."'";
                                    $fld_EMail_Besch = ", fld_persoon_gegeven_beschrijving";
                                }
                                else{
                                    $EMail_Besch = NULL;
                                    $fld_EMail_Besch = NULL;
                                }
                            }
                        }
                        $sqlEMail = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk) 
                                   VALUES ('".$EMail_Nr."', '1')";
                                   
                         if (mysqli_query($conn, $sqlEMail)){
                            $EMail_Id = mysqli_insert_id($conn);
                            $sqlEMail_Link = "INSERT INTO tbl_personen_gegevens (fld_persoon_id_fk, fld_gegeven_id_fk, fld_soort_id_fk".$fld_EMail_Besch.") 
                                              VALUES ('".$Persoon_Id."', '".$EMail_Id."', '".$EMail_Soort."'".$EMail_Besch.")";
                            
                            if (mysqli_query($conn, $sqlEMail_Link)){
                                echo "EMail_Gelukt";
                            }
                            else {
                                echo "Error: " . $sqlEMail_Link . "<br>" . mysqli_error($conn);
                            }
                        }
                        else {
                            echo "Error: " . $sqlEMail . "<br>" . mysqli_error($conn);
                        }
                }
        }
        $_SESSION['Mogelijke_EMail'] = '';
        
        if (isset($_FILES["Bestand_contact"])){
            $sqlInstellingen = "SELECT * FROM tbl_instellingen WHERE fld_school_id_fk=".$_SESSION['schoolID'];
            $resultInstelling = mysqli_query($conn, $sqlInstelling);
            if (mysqli_num_rows($resultInstelling) > 0) {
                while($rowInstelling = mysqli_fetch_assoc($resultInstelling)){
                    $Plaats_Docs = $rowInstelling['fld_instelling_plaats_docs'];
                }
            }
            $Datum = date("Y-m-d_H-i");
            $sqlPersoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$Persoon_Id;
            $resultPersoon = mysqli_query($conn, $sqlPersoon);
            if (mysqli_num_rows($resultPersoon) > 0) {
                while($rowPersoon = mysqli_fetch_assoc($resultPersoon)){
                    $Persoon_Naam = $rowPersoon['fld_persoon_naam'];
                }
            }
            $Dir = "Uploads/".$Persoon_Naam."_".$Persoon_Id."/Contact";
            $target_dir = $Dir."/";
            if (!file_exists($Dir)) {
                mkdir($Dir, 0777, true);
            }
            $Bestand = $_FILES["Bestand_contact"];
            $Aantal_Bestanden = count($Bestand['name']);
            for ($i = 0; $i < $Aantal_Bestanden; $i++){
                $Bestand_Basename = pathinfo($Bestand["name"][$i], PATHINFO_FILENAME);
                $Soort_Bestand = pathinfo($Bestand["name"][$i], PATHINFO_EXTENSION);
                $Bestand_Naam = $Bestand_Basename."_contact_".$Persoon_Id.".".$Soort_Bestand;
                $Bestand_Locatie = $target_dir.$Bestand_Naam;
                echo "Bestand_Locatie: ".$Bestand_Locatie."<br />";
                /** Het bestand wordt geüpload */
                if ($Bestand['size'][$i] != 0){
                    if (move_uploaded_file($Bestand["tmp_name"][$i], $Bestand_Locatie)) {
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
        else {
            echo "Geen bestanden<br />";
        }
        
        header ("Location: WISA-Formulier.php?contact");
        exit();
}

if (isset ($_POST['Contact_Zoeken_btn'])){
    $_SESSION['Contact'] = $_POST['Contact_Zoeken'];
    header ("Location: WISA-Formulier.php?contact");
    exit();
}
if (isset($_POST["GSM_Opslaan"])) {
    $GSM_Opslaan = mysqli_real_escape_string($conn, $_POST['GSM']);
    $GSM_Soort = mysqli_real_escape_string($conn, $_POST['Soort_GSM_Zoeken']);
    $GSM_Besch = mysqli_real_escape_string($conn, $_POST['Besch_GSM']);
    if ($GSM_Opslaan !== ''){
        $GSM_Array = array('GSM_Nr' => $GSM_Opslaan,
                           'GSM_Soort' => $GSM_Soort,
                           'GSM_Besch' => $GSM_Besch);
                           
        if (isset($_SESSION['Mogelijke_GSM_nrs']) && $_SESSION['Mogelijke_GSM_nrs'] != '') {
             array_push($_SESSION['Mogelijke_GSM_nrs'], $GSM_Array);
        }
        else {
            $_SESSION['Mogelijke_GSM_nrs'] = array($GSM_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
    exit();
}

if (isset($_SESSION['Mogelijke_GSM_nrs']) && $_SESSION['Mogelijke_GSM_nrs'] != ''){
    $i = 0;
    foreach ($_SESSION['Mogelijke_GSM_nrs'] as $Mogelijk_GSM_verwijderen){
        while ($i <= 50){
            if (isset($_POST['GSM_'.$i])){
                unset($_SESSION['Mogelijke_GSM_nrs'][$i]);
                header ("Location: WISA-Formulier.php?contact");
                exit();
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
                           
        if (isset($_SESSION['Mogelijke_Tel_nrs']) && $_SESSION['Mogelijke_Tel_nrs'] != '') {
             array_push($_SESSION['Mogelijke_Tel_nrs'], $Tel_Array);
        }
        else {
            $_SESSION['Mogelijke_Tel_nrs'] = array($Tel_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
    exit();
}

if (isset($_SESSION['Mogelijke_Tel_nrs']) && $_SESSION['Mogelijke_Tel_nrs'] != ''){
    $i = 0;
    foreach ($_SESSION['Mogelijke_Tel_nrs'] as $Mogelijk_Tel_verwijderen){
        while ($i <= 50){
            if (isset($_POST['Tel_'.$i])){
                unset($_SESSION['Mogelijke_Tel_nrs'][$i]);
                header ("Location: WISA-Formulier.php?contact");
                exit();
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
                             
        if (isset($_SESSION['Mogelijke_EMail']) && $_SESSION['Mogelijke_EMail'] != '') {
             array_push($_SESSION['Mogelijke_EMail'], $EMail_Array);
        }
        else {
            $_SESSION['Mogelijke_EMail'] = array($EMail_Array);
        }
    }
    header("Location: WISA-Formulier.php?contact");
    exit();
}

if (isset($_SESSION['Mogelijke_EMail']) && $_SESSION['Mogelijke_EMail'] != ''){
    $i = 0;
    foreach ($_SESSION['Mogelijke_EMail'] as $Mogelijk_EMail_verwijderen){
        while ($i <= 50){
            if (isset($_POST['EMail_'.$i])){
                unset($_SESSION['Mogelijke_EMail'][$i]);
                header ("Location: WISA-Formulier.php?contact");
                exit();
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

    $Adres_Array = array('Adres_Straat' => $Adres_Straat,
                         'Adres_Huisnr' => $Adres_Huisnr,
                         'Adres_Bus' => $Adres_Bus,
                         'Adres_Niet_Be' => $Niet_Be,
                         'Adres_Woonplaats' => $Adres_Woonplaats,
                         'Adres_Land' => $Adres_Land,
                         'Adres_Soort' => $Adres_Soort,
                         'Adres_Besch' => $Adres_Besch);
                         
    if (isset($_SESSION['Mogelijke_Adressen']) && $_SESSION['Mogelijke_Adressen'] != '') {
         array_push($_SESSION['Mogelijke_Adressen'], $Adres_Array);
    }
    else {
        $_SESSION['Mogelijke_Adressen'] = array($Adres_Array);
    }
    
    header("Location: WISA-Formulier.php?contact");
    exit();
}

if (isset($_SESSION['Mogelijke_Adressen']) && $_SESSION['Mogelijke_Adressen'] != ''){
    $i = 0;
    foreach ($_SESSION['Mogelijke_Adressen'] as $Mogelijk_Adres_verwijderen){
        while ($i <= 50){
            if (isset($_POST['Adres_'.$i])){
                unset($_SESSION['Mogelijke_Adressen'][$i]);
                header ("Location: WISA-Formulier.php?contact");
                exit();
            }
            ++$i;
        }
    }
}

if (isset($_POST['Volgende'])){
    header("Location: WISA-FormulieR.php?loopbaan");
    exit();
}
?>
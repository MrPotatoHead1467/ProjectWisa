<?php
session_start();

if (isset($_POST['login_form-inloggen']))
    {
        include "WISA-Connection.php";
        
        $instelling = mysqli_real_escape_string($conn, $_POST['login_form-instelling']);
        $gebruiker = mysqli_real_escape_string($conn, $_POST['login_form-gebruiker']);
        $wachtwoord = mysqli_real_escape_string($conn, $_POST['login_form-wachtwoord']);
        
        #ended here...
        
        if (empty($instelling) || empty($gebruiker) || empty($wachtwoord))
            {
                header("Location: WISA-Inloggen.php?login=empty");
                #exit();
                #nood aan mess
            }
        else
            {
                $sql = "SELECT * FROM tbl_gebruikers WHERE fld_gebruiker_naam='".$gebruiker."'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck < 1)
                    {
                        header("Location: WISA-Inloggen.php?login=error");
                        exit();
                        #nood aan mess
                    }
            else 
                {
                    if ($row = mysqli_fetch_assoc($result))
                        {
                            $wachtwoordCheck = $row['fld_gebruiker_wachtwoord'];
                            $instellingCheck = $row['fld_gebruiker_instelling'];
                            if ($wachtwoordCheck == $wachtwoord and $instellingCheck == $instelling)
                                {
                                    $_SESSION['gebruikerID'] = $row['fld_gebruiker_id'];
                                    $_SESSION['gebruiker'] = $row['fld_gebruiker_naam'];
                                    //$_SESSION['inschrijverID'] = $row['fld_persoon_id_fk'];
                                    $_SESSION['instelling'] = $row['fld_gebruiker_instelling'];
                                    $_SESSION['wachtwoord'] = $row['fld_gebruiker_wachtwoord'];
                                    $_SESSION['soort'] = $row['fld_gebruiker_soort_id_fk'];
                                    $_SESSION['schoolID'] = $row['fld_school_id_fk'];
                                    
                                    // zoek in tbl_personen
                                    //$_SESSION['inschrijverNaam'] = $row[fld_persoon_naam];
                                    
                                    // zoek in tbl_scholen
                                    //$_SESSION['schoolNaam'] = $row['fld_school_naam'];
                                    //$_SESSION['schoolTel'] = $row['fld_school_tel'];
                                    //$_SESSION['schoolFax'] = $row['fld_school_fax'];
                                    //$_SESSION['schoolEmail'] = $row['fld_school_email'];
                                    //$_SESSION['schoolLogo'] = $row['fld_school_logo'];
                                    
                                    // zoeken in tbl_adressen
                                    //$_SESSION['schoolStraat'] = $row['fld_adres_straatnaam'];
                                    //$_SESSION['schoolHuisNR'] = $row['fld_adres_huis_nr'];
                                    //$_SESSION['schoolBus'] = $row['fld_adres_bus_nr'];
                                    
                                    // zoeken in tbl_postcodes
                                    //$_SESSION['schoolPostNR'] = $row['fld_postnummer];
                                    //$_SESSION['schoolPlaats'] = $row['fld_woonplaats_naam'];
                           
                                    header("Location: WISA-Formulier.php");
                                    #exit();
                                }
                        }
                    else
                        {
                            header("Location: WISA-Inloggen.php?login=error");
                            exit();
                        }
                }
            }
    }

else 
    {
        //echo("Er is iets verkeerd gegaan");
        header("Location: WISA-Inloggen.php?login=error");
        exit();
        #transit pagina aanmaken..
    }


?>
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
                        #exit();
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
                                    $_SESSION['instelling'] = $row['fld_gebruiker_instelling'];
                                    $_SESSION['wachtwoord'] = $row['fld_gebruiker_wachtwoord'];
                                    $_SESSION['soort'] = $row['fld_gebruiker_soort_id_fk'];
                                    $_SESSION['schoolID'] = $row['fld_school_id_fk'];
                                    $_SESSION['Formulier'] = "";
                           
                                    header("Location: WISA-Formulier.php");
                                    #exit();
                                }
                        }
                    else 
                        {
                            header("Location: WISA-Inloggen.php?login=error");
                            #exit();
                        }
                }
            }
    }

else 
    {
        echo("Er is iets verkeerd gegaan");
        #transit pagina aanmaken..
    }


?>
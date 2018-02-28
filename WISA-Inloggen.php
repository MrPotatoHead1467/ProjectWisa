<?php 
session_start();
include "WISA-Connection.php";
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Inloggen</title>
</head>
<body>

    <?PHP
        include "WISA-Nav.php";
        include "WISA-Header.php";
    ?>
    <?PHP
        if (isset($_SESSION['gebruiker']))
            {
                header("location: WISA-Formulier.php");
            }
        else
            {
                echo '  <div class="login_box">
                            <h3 class="login_box_title">Inloggen</h3>
                            <form action="WISA-Inloggen_Check.php" class="login_form" method="post" >
                                <!-- Instelling -->
                                <div class="login_form-box">
                                <label class="login_form-lbl" for="login_form-instelling">Instelling:</label>
                                <input autofocus="autofocus" class="login_form-in" id="login_form-instelling" name="login_form-instelling" required="True" tabindex="1" type="text"/>
                                </div>
                                <!-- Gebruiker -->
                                <div class="login_form-box">
                                <label class="login_form-lbl" for="login_form-gebruiker">Gebruiker:</label>
                                <input class="login_form-in" id="login_form-gebruiker" name="login_form-gebruiker" required="True" tabindex="2" type="text"/>
                                </div>
                                <!-- Wachtwoord -->
                                <div class="login_form-box">
                                <label class="login_form-lbl" for="login_form-wachtwoord">Wachtwoord:</label>
                                <input class="login_form-in" id="login_form-wachtwoord" name="login_form-wachtwoord" required="True" tabindex="3" type="password"/>
                                </div>
                                <!-- Inlog knop -->
                                <button class="login_form-btn" name="login_form-inloggen" tabindex="-1" type="submit">Inloggen</button>
                            </form>
                        </div>';
            }
        
    ?>

    <?PHP
        include "WISA-Footer.php";
    ?>

</body>
</html>
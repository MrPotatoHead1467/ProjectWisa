<!-- <?php session_start();?> -->
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Basis formulier</title>
</head>

<body>

    <?PHP
    
        if (isset($_SESSION['gebruiker']))
            {
                // code voor het openen van een formulier  echo "<script type='text/javascript'>tab_show_info(event, 'SESSION-DING')</script>";
                if (isset($_SESSION['Formulier']) and $_SESSION['Formulier'] !== '')
                    {
                        echo "<script type='text/javascript'>document.getElementById('".$_SESSION['Formulier']."').style.display = 'block'';";
                            echo "";
                        echo "</script>";
                    }
                else
                    {
                        echo "";
                    }
            }
        else
            {
                header("Location: WISA-Inloggen.php");
            }  
        
        include "WISA-Connection.php";
    ?>
    
    <form action="WISA-BasisFormulier_Check.php" method="post">
        
        <!-- bestand toevoegen -->
        <div class="form_box_1">
            <input class="form_bsd" id="Bestand_basis" name="Bestand_basis[]" multiple type="file"/>
            <label class="form_bsdi" onclick="KlikKnop('Bestand_basis')" title="Document selecteren."></label>
        </div>
        
        
    </form>





</body>
</html>
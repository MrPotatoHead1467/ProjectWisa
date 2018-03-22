<!-- <?php session_start();?> -->
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Bestemmingen</title>
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
        
        <!-- bestemming zoeken -->
        <div class="form_box_1">
            
        </div>
        
        <!-- naam bestemming -->
        <div class="form_box_1">
            
        </div>
        
        <!-- beschrijving bestemming -->
        <div class="form_box_1">
            
        </div>
        
        <!-- gegevens -->
        
    </form>





</body>
</html>
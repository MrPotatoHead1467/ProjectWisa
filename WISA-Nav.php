<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Nav</title>
</head>

<body>
    
    <nav class="nav1">
        <!-- LINK: nieuwe tab blad openen -->
        <a class="nav1-link" href="https://www.wisa.be" target="_blank" title="WISA: wisa.be">WISA</a>
        <!-- LINK: naar handleiding online , EXTRA: andere handleiding voor ADMIN dus andere link & andere geen handleiding bij het inloggen, ZIE STATUS SESSION-->
        <?PHP
            if (isset($_SESSION['gebruiker']))
                {
                    echo'<a class="nav1-link" href="WISA-Help.php" target="_blank" title="HELP: handleiding">HELP</a>';
                }
            else
                {
                    echo'';
                }  
        ?>
        <!-- inloggen/ uitloggen -->
        <?PHP
            if (isset($_SESSION['gebruiker']))
                {
                    echo '  <form action="WISA-Uitloggen.php" method="post">
                                <button class="button_none" name="nav1-link2" type="submit">
                                    <a class="nav1-link" id="nav1-link2" type="submit">LOG UIT</a>
                                </button>
                            </form>';
                }
            /**
            else
                {
                    echo '<a class="nav1-link" href="WISA-Inloggen.php" id="nav1-link2">LOG IN</a>';
                }
            */
        ?>
        
    </nav>
    
    
    

</body>
</html>
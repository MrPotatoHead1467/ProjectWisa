<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Header</title>
</head>

<body>
    
    <!-- als 'niet ingelogd': class="header1" (groter)
         als 'ingelogd': class="header2" (kleiner) -->
    
    <header <?PHP 
                if (isset($_SESSION['gebruiker']))
                    {
                        echo 'class="header2"';
                    }
                    
                else
                    {
                        echo 'class="header1"';
                    }
            ?>>
                   
                    
        <h1 class="header_hfdtitel"><a href="https://www.wisa.be" target="_blank" title="WISA: wisa.be">WISA</a></h1>
        <?PHP
            if (isset($_SESSION['gebruiker']))
                {
                    if ($_SESSION['soort'] == "1")
                        {
                            echo '  <h2 class="header_tsstitel">ADMINISTRATOR WISA</h2>';
                        }
                    elseif  ($_SESSION['soort'] == "2")
                        {
                            echo '  <h2 class="header_tsstitel">ADMINISTRATOR SCHOOL</h2>';
                        }
                    elseif  ($_SESSION['soort'] == "3")
                        {
                            echo '  <h2 class="header_tsstitel">GEBRUIKER SCHOOL</h2>';
                        }
                    else
                        {
                            echo '  <h2 class="header_tsstitel">TESTGEBRUIKER</h2>';
                        }
                }
            else
                {    
                    echo '';
                }
        ?>
    </header>
    

</body>
</html>
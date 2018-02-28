<?php session_start()?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Help</title>
    
</head>

<body>
    
    
    
    <div class="page_fullscreen-grey">
        <div class="page_cover">
            <div class="page_cover-space">
                <button class="page_cover-close" onclick="page_cover_close() "title="Handleiding sluiten">X</button>
                <div class="page_cover-titlebox">
                    <h3 class="page_cover-title">Handleiding</h3>
                    <?PHP
                        if ($_SESSION['soort'] == "1")
                            {
                                echo '  <h4 class="page_cover-title-sub">ADMINISTRATOR WISA</h4>>';
                            }
                        elseif  ($_SESSION['soort'] == "2")
                            {
                                echo '  <h4 class="page_cover-title-sub">ADMINISTRATOR SCHOOL</h4>';
                            }
                        elseif  ($_SESSION['soort'] == "3")
                            {
                                echo '  <h4 class="page_cover-title-sub">GEBRUIKER SCHOOL</h4>';
                            }
                        else
                            {
                                echo '  <h4 class="page_cover-title-sub">TESTGEBRUIKER</h4>';
                            }
                    ?>
                </div>
                 <?PHP
                    if ($_SESSION['soort'] == "1")
                        {
                            echo '  <div class="page_cover-info">';
                                        include "WISA-Handleiding1.php";
                            echo '  </div>';
                        }
                    elseif  ($_SESSION['soort'] == "2")
                        {
                            echo '  <div class="page_cover-info">';
                                        include "WISA-Handleiding2.php";
                            echo '  </div>';
                        }
                    elseif  ($_SESSION['soort'] == "3")
                        {
                            echo '  <div class="page_cover-info">';
                                        include "WISA-Handleiding3.php";
                            echo '  </div>';
                        }
                    else
                        {
                            echo '  <div class="page_cover-info">
                                        <p id="mess">Nog niet beschikbaar.</p>
                                    </div>';
                        }
                ?>
            </div>
        </div>
    </div>
    

</body>
</html>
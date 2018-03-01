<!-- <?php session_start();?> -->
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Formulier</title>
</head>

<body>

    <?PHP
    
        if (isset($_SESSION['gebruiker']))
            {
                echo'';
            }
        else
            {
                header("Location: WISA-Inloggen.php");
            }  
        
        include "WISA-Nav.php";
        include "WISA-Header.php";
    ?>
     
    <div class="tabs">
        <!-- namen voor tabbladen -->
        <?PHP
            if ($_SESSION['soort'] == "1")
                {
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'...'"; echo ')">
                                ...
                            </button>';
                }
            elseif  ($_SESSION['soort'] == "2")
                {
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'nieuwevraag'"; echo ')">
                                Nieuwe vraag
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'goedkeuren'"; echo ')">
                                Inschrijvingen goedkeuren
                            </button>';
                }
            elseif  ($_SESSION['soort'] == "3")
                {
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'persoon'"; echo ')">
                                Persoonsgegevens
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'relaties'"; echo ')">
                                Relaties
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'contact'"; echo ')">
                                Contactgegevens
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'loopbaan'"; echo ')">
                                Loopbanen
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'vragen'"; echo ')">
                                Inschrijving
                            </button>';
                }
            else
                {
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'persoon'"; echo ')">
                                Persoonsgegevens
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'relaties'"; echo ')">
                                Relaties
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'contact'"; echo ')">
                                Contactgegevens
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'loopbaan'"; echo ')">
                                Loopbanen
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'vragen'"; echo ')">
                                Inschrijving
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'nieuwevraag'"; echo ')">
                                Nieuwe vraag
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'goedkeuren'"; echo ')">
                                Inschrijvingen goedkeuren
                            </button>';
                }
        ?>
    </div>
    
    <div class="tabs_info-box">
        <div class="tabs_info-box-space">
            <!-- bericht -->
            <div id="mess" class="tabs_info">
                <p>Klik op een tabblad om te starten.</p>
            </div>
            <!-- formulieren gelinkt aan tabbladen-->
            <div id="..." class="tabs_info">
                <p>...</p>
            </div>
            
            <div id="persoon" class="tabs_info">
                <?PHP
                    include "WISA-Persoonsformulier.php";
                ?>
            </div>
            
            <div id="relaties" class="tabs_info">
                <?PHP
                    include "WISA-RelatiesFormulier.php";
                ?>
            </div>
            
            <div id="contact" class="tabs_info">
                <?PHP
                    include "WISA-ContactFormulier.php";
                ?>
            </div>
            
            <div id="loopbaan" class="tabs_info">
                <?PHP
                    include "WISA-LoopbaanFormulier.php";
                ?>
            </div>
            
            <div id="vragen" class="tabs_info">
                <?PHP
                    include "WISA-Inschrijvingsformulier.php";
                ?>
            </div>
                    
            <div id="nieuwevraag" class="tabs_info">
                <?PHP
                    include "WISA-VragenToevoegen.php";
                ?>
            </div>   
            
            <div id="goedkeuren" class="tabs_info">
                <?PHP
                    include "WISA-InschrijvingenGoedkeuren.php";
                ?>
            </div>
        </div>    
    </div>
    
    <!-- code: website op full screen laten afbeelden -->
    <script>
        //function page_fullscreen()
            //{
                //document.requestFullScreen() OR document.mozRequestFullScreen()
            //}
    </script>
    <!-- code: mess weglaten en -->
    <script>
        function tab_prep()
            {
                document.getElementsByClassName("tabs_info-box-mess").style.display = "none";
                //document.getElementsByClassName("tabs_info-box-space").style.display = "block";
            }
    </script>
    <script>           
        function tab_show_info(evt, form)
            {
                var i, tab_info, tab_links;
                tab_info = document.getElementsByClassName("tabs_info");
                for (i = 0; i < tab_info.length; i++)
                    {
                        tab_info[i].style.display = "none";
                    }
                tab_links = document.getElementsByClassName("tabs_names");
                for (i = 0; i < tab_links.length; i++)
                    {
                        tab_links[i].className = tab_links[i].className.replace("active", "");
                    }
                document.getElementById(form).style.display = "block";
                evt.currentTarget.className += " active";
                
            }
    </script>
  




    <?PHP
        include "WISA-Footer.php";
    ?>

</body>
</html>
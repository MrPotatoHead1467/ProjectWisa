<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Formulier</title>
</head>

<body>

    <?PHP
    
        if (isset($_SESSION['gebruiker']))
            {
                
                // code voor het openen van een formulier  echo "<script type='text/javascript'>tab_show_info(event, 'SESSION-DING')</script>";
                /**
                 * 
                 if (isset($_SESSION['Formulier']) and $_SESSION['Formulier'] != '')
                    {
                        echo "<script type='text/javascript'>";
                            echo "tab_show_info('click', "; echo "'"; echo $_SESSION['Formulier']."')";
                        echo "</script>";
                    }
                else
                    {
                        echo "";
                    }*/
                $Formulier = $_SERVER['QUERY_STRING'];
                $URL = $_SERVER['REQUEST_URI'].$Formulier;
                if ($Formulier == '')
                    {
                        
                    }
                else 
                    {
                        $parameters = "'click', '".$Formulier."'";
                        echo "<script type='text/javascript'>";
                            echo "tab_show_info(".$parameters.")";
                        echo "</script>";
                    }
                
                
            }
        else
            {
                header("Location: WISA-Inloggen.php");
            }  
        
        include "WISA-Nav.php";
        include "WISA-Header.php";
        
        
    ?>
    
    <div class="tabs_names_box_arrows">
        <button class="tabs_names_arrows" id="tabs_names_arrows_vorige" onclick="tabs_prev()" title="Vorige tabblad">
            &#8249;
        </button>
        <button class="tabs_names_arrows" id="tabs_names_arrows_volgende" onclick="tabs_next()" title="Volgende tabblad">
            &#8250;
        </button>
    </div> 
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
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'beheervragen'"; echo ')">
                                Beheer vragen
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'bestemmingen'"; echo ')">
                                Bestemmingen
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'goedkeuren'"; echo ')">
                                Inschrijvingen goedkeuren
                            </button>';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'logins'"; echo ')">
                                Beheer logins
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'instelling'"; echo ')">
                                Instellingen
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
                                Vragen
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
                                Vragen
                            </button>';
                            
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'bestemmingen'"; echo ')">
                                Bestemmingen
                            </button>';     
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'beheervragen'"; echo ')">
                                Beheer vragen
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
                <?PHP
                $Formulier = $_SERVER['QUERY_STRING'];
                $URL = $_SERVER['REQUEST_URI'].$Formulier;
                if ($Formulier == '')
                    {
                        echo "<p>Klik op een tabblad om te starten.</p>";
                    }
                else 
                    {
                        echo "<p>Formulier aan het laden..</p>";
                        echo "<label class='form_load' title='Formulier aan het laden..'></label>";
                    }
                
                ?>
            </div>
            <!-- formulieren gelinkt aan tabbladen-->
            <?PHP
            if ($_SESSION['soort'] == "1")
                {
                    echo '<div id="..." class="tabs_info">
                              <p>...</p>
                          </div>';
                }
            elseif  ($_SESSION['soort'] == "2")
                {
                    echo '<div id="logins" class="tabs_info">';
                            include "WISA-BeheerLogins.php";
                    echo '</div>';
                    
                    echo '<div id="beheervragen" class="tabs_info">';
                            include "WISA-BeheerVragen.php";
                    echo '</div>';
                    
                    echo '<div id="bestemmingen" class="tabs_info">';
                            include "WISA-Bestemmingen.php";
                    echo '</div>';
                    
                    echo '<div id="goedkeuren" class="tabs_info">';
                            include "WISA-InschrijvingenGoedkeuren.php";
                    echo '</div>';
                    
                    echo '<div id="instelling" class="tabs_info">';
                            include "WISA-Instellingen.php";
                    echo '</div>';
                }
            elseif  ($_SESSION['soort'] == "3")
                {
                    echo '<div id="persoon" class="tabs_info">';
                            include "WISA-Persoonsformulier.php";
                    echo '</div>';
                    
                    echo '<div id="relaties" class="tabs_info">';
                            include "WISA-RelatiesFormulier.php";
                    echo '</div>';
                    
                    echo '<div id="contact" class="tabs_info">';
                            include "WISA-ContactFormulier.php";
                    echo '</div>';
                    
                    echo '<div id="loopbaan" class="tabs_info">';
                            include "WISA-LoopbaanFormulier.php";
                    echo '</div>';
                    
                    echo '<div id="vragen" class="tabs_info">';
                            include "WISA-Inschrijvingsformulier.php";
                    echo '</div>';
                }
            else
                {

                }
        ?>
        </div>    
    </div>
    
    <div class="page_fullscreen-grey" id="page_fullscreen-grey">
        <div class="page_cover_mess">
            <div class="page_cover-space">
                <div class="page_cover-titlebox">
                    <h3 class="page_cover-title">Inschrijving afronden</h3>
                </div>
                <div class="page_cover_info">
                    <!--
                    - print
                    - handtekeningen als gevraagd in instellingen (lln, ouder, directie)
                    - voorwaarden geaccepteerd
                    - commentaar toevoegen
                    -->
                    <div class="form_box_1">
                        <label class="form_lbl" for="Voornaam">Bestemming</label><br />
                        
                        <!-- naam -->
                        <div class="form_box_in">
                            <input autofocus="autofocus" class="form_in" id="Naam" maxlength="255" name="Naam" placeholder="Naam" required="True" type="text"/><br />
                            </div>
                        <textarea class="page_cover_area" id="Comm_Inschr" maxlength="511" name="Comm_Inschr" placeholder="Commentaar"></textarea>
                        
                        <!-- beschrijving -->
                        
                    </div>
                    <div class="form_box_btn">
                        <!-- bestemming opslaan-->  
                        <button class="form_btn"  id="Inschr_Opslaan" name="Inschr_Opslaan" title="Aanvraag inschrijving afronden en verzenden." type="submit">Verzenden</button>
                        <!-- bestemming annuleren --> 
                        <button class="form_ccl" id="Annuleer" name="Annuleer" onclick="SluitAfronding()" type="submit">Annuleren</button>
                    </div>
                </div>
                    
            </div>
        </div>
    
    </div>
    
    <!-- code: website op full screen laten afbeelden -->
    <script>
        function SluitAfronding()
            {
                document.getElementById("page_fullscreen-grey").style.display = "none";
            }
    </script>
    <!-- code: mess weglaten en -->
    <script>
        function tab_prep()
            {
                document.getElementsByClassName("tabs_info-box-mess").style.display = "none";
                //document.getElementsByClassName("tabs_info-box-space").style.display = "block";
            }
          
        function tab_show_info(evt, form)
            {
                var i, tab_info, tab_links;
                var inhoud = form     
                
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
                evt.currentTarget.className += " focus";
                //document.getElementsByClassName("tabs_names").setActive();
                //location .assign("http://localhost/ProjectWisa/ProjectWisa/WISA-Formulier.php?" + form);
                //document.documentURI("http://localhost/ProjectWisa/ProjectWisa/WISA-Formulier.php?" + form);
                //window.history.pushState("?" + form, "WISA | " + form, "http://localhost/ProjectWisa/ProjectWisa/WISA-Formulier.php");
                //window.location.href.replace("?" + inhoud;  )
            }
    </script>
  




    <?PHP
        include "WISA-Footer.php";
        
        $Formulier = $_SERVER['QUERY_STRING'];
        $URL = $_SERVER['REQUEST_URI'].$Formulier;
        
        if ($Formulier == '?' or $Formulier == '')
            {
                //echo "Formulier: ".$Formulier;
                echo "";
            }
        else
            {
                $parameters = "'click', '".$Formulier."'";
                echo "Parameters: ".$parameters;
                echo "<script type='text/javascript'>";
                    echo "tab_show_info(".$parameters.")";
                echo "</script>"; 
            }
    ?>

</body>
</html>
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
    
    <!--<div class="tabs_names_box_arrows">
        <button class="tabs_names_arrows" id="tabs_names_arrows_vorige" onclick="tabs_arrow('prev')" title="Vorige tabblad">
            &#8249;
        </button>
        <button class="tabs_names_arrows" id="tabs_names_arrows_volgende" onclick="tabs_arrow('next')" title="Volgende tabblad">
            &#8250;
        </button>
    </div>-->
    <!-- namen voor tabbladen -->
    <?PHP
        if ($_SESSION['soort'] == "1")
            {
                echo '  <div class="tabs">';
                    
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'...'"; echo ')">
                                ...
                            </button>';
                
                echo '  </div>';
                
            }
        elseif  ($_SESSION['soort'] == "2")
            {
                //echo '  <div class="tabs" id="vragentab">';
                echo '  <div class="tabs">';
                
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'beheervragen'"; echo ')">
                                Beheer vragen
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'bestemmingen'"; echo ')">
                                Bestemmingen
                            </button>';
                        
                //echo '  </div>';
                //echo '  <div class="tabs" id="inschrijvingentab">';
                       
                    //echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'goedgekeurd'"; echo ')">
                                //Goedgekeurde inschrijvingen
                            //</button>';
                             
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'goedkeuren'"; echo ')">
                                Inschrijvingen goedkeuren
                            </button>';
                            
                    
                    
                //echo '  </div>';
                //echo '  <div class="tabs" id="infotab">';
                
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'logins'"; echo ')">
                                Beheer logins
                            </button>';
                            
                    echo '  <button class="tabs_names" onclick="tab_show_info(event, '; echo "'instelling'"; echo ')">
                                Instellingen
                            </button>';
                
                echo '  </div>';
                        
            }
        elseif  ($_SESSION['soort'] == "3")
            {
                echo '  <div class="tabs">';
                
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
                            
                echo '  </div>';
            }
        else
            {
            }
    ?>
    
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
    
    <div class="page_fullscreen-grey" id="page_fullscreen-grey" style="display: none;">
        <div class="page_cover_mess">
            <div class="page_cover-space">
                <div class="page_cover-titlebox">
                    <h3 class="page_cover-title">Inschrijving afronden</h3>
                </div>
                <div class="page_cover_info">
                    <form action="WISA-Inschrijving_beeindigen.php" method="post">
                    <!--
                    - print
                    - handtekeningen als gevraagd in instellingen (lln, ouder, directie)
                    - voorwaarden geaccepteerd
                    - commentaar toevoegen
                    -->
                    
                    <?php
	                   // VOORWAARDEN
                        $voorwaardenlijst = array();
                        $sqlVoorwaarden = "SELECT * FROM tbl_inschrijvingen_voorwaarden";
                        $infoVoorwaarden = $conn->query($sqlVoorwaarden);
                        if ($infoVoorwaarden->num_rows > 0)
                            {
                                $a = 0;
                                
                                while($row = $infoVoorwaarden->fetch_assoc())
                                    {
                                        $voorwaardeInhoud = $row["fld_inschrijving_voorwaarde_beschrijving"];
                                        $voorwaardeID = $row["fld_inschrijving_voorwaarde_id"];
                                        $voorwaardeLink = $row["fld_inschrijving_voorwaarde_link"];
                                        
                                        $voorwaarde[$a] = array("INHOUD"=>$voorwaardeInhoud, "LINK"=>$voorwaardeLink, "ID"=>$voorwaardeID);
                                        array_push($voorwaardenlijst, $voorwaarde[$a]);
                                        ++$a;
                                        
                                    }
                                $noMultiArray = array_map('serialize', $voorwaardenlijst);
                                $unique_noMultiArray = array_unique($noMultiArray);
                                $voorwaardenlijst = array_map('unserialize', $unique_noMultiArray); 
                                //print_r($voorwaardenlijst);
                                //echo "<br/>";
                            }
                        echo "<div class='form_box_1'>";
                            echo "<label class='form_lbl_w' for='voorwaarden'>Voorwaarden</label>";
                            echo "<div class='form_box_in' id='voorwaarden'>";
                        foreach ($voorwaardenlijst as $voorwaarde)
                            {
                                echo "<input type='checkbox' id='".$voorwaarde['ID']."'>";
                                echo "<label class='form_lbl_w' for='".$voorwaarde['ID']."'>".$voorwaarde['INHOUD']."</label><br />";
                            
                            }
                            echo "</div>";
                        echo "</div>";
                    ?>
                    
                    
                    <!-- commentaar -->
                    <div class="form_box_1">
                        <label class="form_lbl_w" for="Comm_Inschr">Commentaar</label><br />
                        <textarea class="page_cover_area" id="Comm_Inschr" maxlength="511" name="Comm_Inschr" placeholder="Commentaar"></textarea>
                    </div>
                    
                    <div class="form_box_btn_border">
                    </div>
                    
                    <div class="form_box_btn">
                        <!-- bestemming opslaan-->  
                        <button class="form_btn"  id="Inschr_Opslaan" name="Inschr_Opslaan" title="Aanvraag inschrijving afronden en verzenden." type="submit">Inschrijving verzenden</button>
                        <!-- bestemming annuleren --> 
                        <button class="form_ccl" id="Annuleer" name="Annuleer" onclick="SluitAfronding()" type="submit">Annuleren</button>
                    </div>
                    </form>
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
        
        //function tabs_arrow(way)
            //{
                //if (way == "prev")
                    //{
                        //document.getElementById("tabs_names_arrows_volgende").style.display = "none";
                        //document.getElementById("tabs_names_arrows_vorige").style.display = "block";                        
                    //}
                //else
                    //{
                        //document.getElementById("tabs_names_arrows_vorige").style.display = "none";
                        //document.getElementById("tabs_names_arrows_volgende").style.display = "block";
                    //}
            //}    
        
        function tabs_arrow(way)
            {
                var prev = document.getElementById("tabs_names_arrows_vorige");
                var next = document.getElementById("tabs_names_arrows_volgende");
                
                var vragentab = document.getElementById("vragentab");
                var inschrijvingentab = document.getElementById("inschrijvingentab");
                var infotab = document.getElementById("infotab");
                console.log("1");
                if (way == "prev")
                    {
                        console.log("2");
                        if (inschrijvingentab.style.display == "block")
                            {
                                console.log("3");
                                vragentab.style.display = "block";
                                inschrijvingentab.style.display = "none";
                                infotab.style.display = "none";
                                
                                prev.style.display = "none";
                            }
                        else if (infotab.style.display == "block")
                            {
                                console.log("4");
                                vragentab.style.display = "none";
                                inschrijvingentab.style.display = "block";
                                infotab.style.display = "none";
                                
                                next.style.display = "block";
                            }
                    }
                else if (way == "next")
                    {
                        console.log(document.getElementById("vragentab").style.display);
                        if (vragentab.style.display == "block")
                            {
                                console.log("6");
                                vragentab.style.display = "none";
                                inschrijvingentab.style.display = "block";
                                infotab.style.display = "none";
                                
                                prev.style.display = "block";
                            }
                        else if (inschrijvingentab.style.display == "block")
                            {
                                console.log("7");
                                vragentab.style.display = "none";
                                inschrijvingentab.style.display = "none";
                                infotab.style.display = "block";
                                
                                next.style.display = "none";
                            }
                    }
            }  
            
        function show_einde(){
            document.getElementById("page_fullscreen-grey").style.display = "block";
        }
            
    </script>
  




    <?PHP
        if ($_SESSION['Inschrijving_einde'] == true){
            echo '<script type="text/javascript">show_einde();</script>';
        }
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
                echo "<script type='text/javascript'>";
                    echo "tab_show_info(".$parameters.")";
                echo "</script>"; 
            }
    ?>

</body>
</html>
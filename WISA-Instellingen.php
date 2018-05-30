<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />

	<title>WISA | Instellingen</title>
</head>

<body>
<form action="WISA-Instellingen_Check.php" method="post" enctype="multipart/form-data">
    <?php
        $sql = "SELECT * FROM tbl_instellingen";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['Instelling_Logo'] = $row['fld_instelling_logo'];
                $_SESSION['Instelling_Plaats_docs'] = $row['fld_instelling_plaats_docs'];
                $_SESSION['Instelling_Handtekening_Digitaal'] = $row['fld_instelling_digitaal_handtekening'];
                $_SESSION['Instelling_Titel_Doc'] = $row['fld_instelling_titel_doc'];
            }
        }
    ?>
    <!-- Input voor het selecteren van een logo -->
    <label for="Logo">Logo</label><br />
    <input type="file" name="Logo" id="Logo"/><br />
    
    <!-- Input voor het toevoegen van voorwaarden -->
    <label for="Voorwaarde">Voorwaarden</label>
    <div class="form_box_in">
        <button class='form_pls' type="submit" id="Voorwaarde_toevoegen" name="Voorwaarde_toevoegen" title="Druk op de knop om de voorwaarde toe te voegen.">+</button>
        <input class="form_in" type="text" id="Voorwaarde" name="Voorwaarde" title="Geef een voorwaarde in en druk op de knop."/>
    </div>
    
    <div id="Voorwaarden">
        <!-- Voorwaarden tonen met verwijden knop -->
        <?php
            if (isset($_SESSION['Voorwaarden']))
                {
                    foreach ($_SESSION['Voorwaarden'] as $Voorwaarde)
                        {
                            echo "<div class='form_box_in'>";
                                /** Verwijderknop */
                                echo "<button class='form_mn' type='submit' id='".$Voorwaarde."' name='".$Voorwaarde."' title='Druk op de knop om de voorwaarde te verwijderen.'>x</button>";
                                /** Voorwaarden tonen in tekstvak */
                                echo "<label class='form_lbl' type='text' id='Mogelijke_antwoorden' name='Mogelijke_antwoorden[]' title='De voorwaarde is: ".$Voorwaarde.".'>".$Voorwaarde."</label><br/>";
                            echo '</div>';
                        }   
                }
        ?>
    </div>
    
    <div>
        <input type="checkbox" name="Printen" id="Printen"/>
        <label for="Printen">Printen</label>
    </div>
    
    <div>
        <input type="checkbox" name="Handtekening" id="Handtekening"/>
        <label for="Handtekening">Handtekening</label>
    </div>
    
    <div>
        <label for="Plaats_Doc">Plaats waar documenten worden opgeslagen</label><br />
        <input type="text" name="Plaats_Docs" id="Plaats_Docs"/>
    </div>
    
    <div>
        <label for="Naam_Doc">Naam PDF</label><br />
        <input type="text" name="Naam_Doc" id="Naam_Doc"/>
    </div>
    
    <div class="form_box_btn">
        <!-- Knop om de vraag op te slaan -->
        <button class="form_btn" id="Instellingen_opslaan" name="Instellingen_opslaan" title="Instellingen opslaan." type="submit">Opslaan</button>
        <!-- Knop om te annuleren, alle -->
        <button class="form_ccl" id="Annuleren" name="Annuleren" title="Aanpassingen aan de instellingen verwijderen." type="submit">Annuleren</button>
    </div>
</form>


</body>
</html>
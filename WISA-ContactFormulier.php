<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Contact formulier</title>
</head>

<body>
    <?php
    include "WISA-Connection.php";
    ?>
    
    <!-- bestanden toevoegen D1-->
    <label class="form_bsdi" onclick="KlikKnop('Bestand_contact')" title="Document selecteren."></label>
    
    
    <!-- Persoons gegevens zoeken -->
    <div>
        <form action="WISA-ContactFormulier_Check.php" method="post">
            <div class="form_box_zoek">
                <label class="form_lbl" for="Contact_Zoeken_in">Persoons gegevens zoeken</label><br />
                <button class="form_edit" id="Contact_Zoeken_btn" name="Contact_Zoeken_btn" type="submit">Gegevens invullen</button>
                <div class="form_zoek">
                    <input class="form_in" id="Contact_Zoeken_in" list="Contact_Zoeken_List" name="Contact_Zoeken_in" placeholder="..." />
                    <label class="form_editi" for="Contact_Zoeken_btn" onclick="KlikKnop('Contact_Zoeken_btn')" title="Personns gegevens zoekn."></label>
                </div>
                <datalist class="form_slt" id="Persoon_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_personen";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_persoon_id']."' value='".$row['fld_persoon_naam']." (".$row['fld_persoon_gb_datum'].")'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Persoon_Zoeken" name="Persoon_Zoeken" type="hidden"/>
            </div>
        </form>
    </div>
    
    <form action="WISA-ContactFormulier_Check.php" method="post">
    
        <!-- bestanden toevoegen D2-->
        <input class="form_bsd" id="Bestand_contact" name="Bestand_contact[]" multiple type="file"/>
        
        <!-- adres -->
        <div class="form_box_1">
            <label class="form_lbl" for="Straat">Adres</label><br />
            <!-- straat -->
            <div class="form_box_in">
                <input id="Straat" name="Straat" placeholder="Straatnaam" type="text" />
            </div>
            <!-- huisnummer -->
            <div class="form_box_in">
                <input id="Huisnummer" name="Huisnummer" placeholder="Huisnummer" type="text"/>
            </div>
            <!-- bus -->
            <div class="form_box_in">
                <input id="Bus" name="Bus" placeholder="Bus" type="text"/>
            </div>
            <!-- woonplaats -->
            <select class="form_slt" id="Woonplaats_Lijst" name="Woonplaats_Lijst" onchange="woonplaats_niet_be()">
                <option value="Kies">Postcode en woonplaats</option>
                <option value="Niet_BE">Woonplaats niet in Belgie</option>
                <?php
                    $sql = "SELECT * FROM tbl_postcodes";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option value='".$row['fld_postcode_id']."'>".$row['fld_postcode_nr']." | ".$row['fld_woonplaats_naam']."</option>";
                        }
                    }
                ?>
            </select>
            <!-- woonplaats niet België-->
            <div id="Woonplaats_niet_be">
                <div class="form_box_in">
                    <input id="Woonplaats_niet_be_txt" name="Woonplaats_niet_be_txt" placeholder="Woonplaats (niet in België)" type="text"/>
                </div>
            </div>
            <!-- land -->
            <br />
            <select class="form_slt" id="Land" name="Land">
                <option value="Kies">Land</option>
            </select>
            <!-- beschrijving -->
            <textarea class="form_in1" id="Besch_Woonplaats" name="Besch_Woonplaats" placeholder="Beschrijving woonplaats"></textarea> 
        </div>
        
        <!-- GSM -->
        <div class="form_box_1">
            <label class="form_lbl" for="GSM">GSM</label><br />
            <!-- nummer -->
            <div class="form_box_in">
                <input type="text" id="GSM" name="GSM" placeholder="GSM nummer"/>
            </div>
            <!-- toevoeg knop -->
            <button class='form_pls1' id="GSM_Opslaan" name="GSM_Opslaan" type="submit">+</button>
            <!-- beschrijving GSM nummer -->
            <textarea class="form_in1" id="Besch_GSM" name="Besch_GSM" placeholder="Beschrijving GSM nummer"></textarea>
        </div>
        
        <!-- Bestaande GSM nummers -->
        <div class="form_box_1">
            <div id="Mogelijke_GSM" class="Mogelijke_GSM">
                <?php
                    if (isset($_SESSION['Mogelijke_GSM_nrs']))
                        {
                            foreach ($_SESSION['Mogelijke_GSM_nrs'] as $Mogelijk_GSM_nr)
                                {
                                    echo "<div>";
                                        /** Verwijderknop */
                                        echo "<div class='form_box_in'>";
                                            echo "<button class='form_mn' id='".$Mogelijk_GSM_nr."' name='".$Mogelijk_GSM_nr."' type='submit'>x</button>";
                                            /** Mogelijk gsm nummer tonen in tekstvak */
                                            echo "<label class='form_lbl' id='Mogelijke_GSM_nrs' name='Mogelijke_GSM_nrs[]'>".$Mogelijk_GSM_nr."</label><br />";
                                        echo "</div>";
                                    echo '</div>';
                                }   
                        }
                ?>
            </div>
        </div>
        
        <!-- telefoon -->
        <div class="form_box_1">
            <label class="form_lbl" for="Telefoon">Telefoon</label><br />
            <!-- telefoon nummer -->
            <div class="form_box_in">
                <input id="Telefoon" name="Telefoon" placeholder="Telefoon nummer" type="text"/>
            </div>
            <!-- toevoeg knop -->
            <button class='form_pls1' id="Telefoon_Opslaan" name="Telefoon_Opslaan" type="submit">+</button>
            <!-- beschrijving -->
            <textarea class="form_in1" id="Besch_Tel" name="Besch_Tel" placeholder="Beschrijving telefoon nummer"></textarea>
        </div>
                
        <!-- toegevoegde telefoon nummers -->  
        <div class="form_box_1" id="Mogelijke_Tel">
            <?php
                if (isset($_SESSION['Mogelijke_Tel_nrs']))
                    {
                        foreach ($_SESSION['Mogelijke_Tel_nrs'] as $Mogelijk_Tel_nr)
                            {
                                echo "<div>";
                                    echo "<div class='form_box_in'>";
                                        /** Verwijderknop */
                                        echo "<button class='form_mn' id='".$Mogelijk_Tel_nr."' name='".$Mogelijk_Tel_nr."' type='submit'>x</button>";
                                        /** Mogelijk telefoon nummer tonen in tekstvak */
                                        echo "<label class='form_lbl' id='Mogelijke_Tel_nrs' name='Mogelijke_Tel_nrs[]'>".$Mogelijk_Tel_nr."</label><br />";
                                    echo "</div>";
                                echo '</div>';
                            }   
                    }
            ?>
        </div>
        
        <!-- e-mail -->
        <div class="form_box_1">
            <label class="form_lbl" for="Email">Email</label><br />
            <!-- E-mail adres -->
            <div class="form_box_in">
                <input id="Email" name="Email" placeholder="E-mail adres" type="text"/>
            </div>
            <!-- toevoeg knop -->
            <button class='form_pls1' id="Email_Opslaan" name="Email_Opslaan" type="submit">+</button>
            <!-- Beschrijving E-mail adres -->
            <textarea class="form_in1" id="Besch_GSM" name="Besch_GSM"></textarea>
        </div>
                      
        <!-- bestaande e-mail adressen -->    
        <div class="form_box_1" id="Mogelijke_Email">
            <?php
                if (isset($_SESSION['Mogelijke_Emailadressen']))
                    {
                        foreach ($_SESSION['Mogelijke_Emailadressen'] as $Mogelijk_Emailadres)
                            {
                                echo "<div>";
                                    echo "<div class='form_box_in'>";
                                        /** Verwijderknop */
                                        echo "<button class='form_mn' id='".$Mogelijk_Emailadres."' name='".$Mogelijk_Emailadres."' type='submit'>x</button>";
                                        /** Mogelijk emailadres tonen in tekstvak */
                                        echo "<label class='form_lbl' id='Mogelijke_Emailadressen' name='Mogelijke_Emailadressen[]'>".$Mogelijk_Emailadres."</label><br />";
                                    echo "</div>";
                                echo '</div>';
                            }   
                    }
            ?>
        </div>
        
        
        <div class="form_box_1">
            <!-- Contact opslaan knop -->
            <button class="form_btn" id="Contact_Opslaan" name="Contact_Opslaan" type="submit">Opslaan</button>
            <!-- Volgende knop -->
            <button class="form_ccl" id="Volgende" name="Volgende" title="Volgende formulier: Loopbaan."type="submit">Volgende</button>
        </div>
    </form>

    <script type="text/javascript">
    <!--
            function KlikKnop(knop)
            {
                document.getElementById(knop).click();
            }
    
    	function woonplaats_niet_be() {
                var woonplaats = document.getElementById("Woonplaats_Lijst");
                var selectedValue = woonplaats.options[woonplaats.selectedIndex].value;
                if (woonplaats.value == "Niet_BE") {
                    document.getElementById('Woonplaats_niet_be').style.display = 'block';
                }
                else {
                    document.getElementById('Woonplaats_niet_be').style.display = 'none';
                }
        }
    -->
    </script>

</body>
</html>
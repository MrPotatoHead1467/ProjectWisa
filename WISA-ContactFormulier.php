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
<form action="WISA-ContactFormulier_Check.php" method="post">
    <div>
        <!-- Zoekvak persoon -->
        <label for="Zoekvak">Zoeken</label><br />
        <input type="text" id="Zoekvak" name="Zoekvak"/>
        <button type='submit' id='Zoekvak_Zoeken' name='Zoekvak_Zoeken'>Zoeken</button><br />
    </div>
    
    <div>
        <!-- Persoon -->
        <label for="Persoon">Persoon</label><br />
        <select id="Persoon" name="Persoon">
            <option value="Kies">...</option>
            <?php
                /** Als er iets in het zoekvak is ingevuld, worden alleen de overige namen getoond. Als er niets is ingevuld,
                    worden alle namen getoond */
                if (isset($_SESSION['Zoekvak'])){
                    $sql = $_SESSION['Zoekvak'];
                }
                else {
                    $sql = "SELECT * FROM tbl_personen";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['fld_persoon_id']."'>".$row['fld_persoon_naam']." | ".$row['fld_persoon_gb_datum']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    
    <div>
        <label for="Straat">Straat</label><br />
        <input type="text" id="Straat" name="Straat"/>
    </div>
    
    <div>
        <label for="Huisnummer">Huisnummer</label><br />
        <input type="text" id="Huisnummer" name="Huisnummer"/>
    </div>
    
    <div>
        <label for="Bus">Bus</label><br />
        <input type="text" id="Bus" name="Bus"/>
    </div>
    
    <div>
        <div>
            <label>Woonplaats</label><br />
            <select id="Woonplaats_Lijst" name="Woonplaats_Lijst" onchange="woonplaats_niet_be()">
                <option value="Kies">...</option>
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
        </div>
        
        <div class="Woonplaats_niet_be" id="Woonplaats_niet_be">
            <label for="Woonplaats_niet_be_txt">Geef woonplaats in</label><br />
            <input type="text" id="Woonplaats_niet_be_txt" name="Woonplaats_niet_be_txt"/>
        </div>
    </div>
    
    <div>
        <label for="Land">Land</label>
        <select id="Land" name="Land">
            <option value="Kies">...</option>
        </select>
    </div>
    
    <div>
        <label for="Besch_Woonplaats">Beschrijving woonplaats</label>
        <textarea id="Besch_Woonplaats" name="Besch_Woonplaats"></textarea>
    </div>
    
    <div>
        <!-- Invoervak voor GSM nummer met opslaan knop -->
        <div>
            <div>
                <label for="GSM">GSM</label><br />
                <input type="text" id="GSM" name="GSM"/>
            </div>
            
            <div>
                <label for="Besch_GSM">Beschrijving GSM</label>
                <textarea id="Besch_GSM" name="Besch_GSM"></textarea>
            </div>
            
            <div>
                <button type="submit" id="GSM_Opslaan" name="GSM_Opslaan">Opslaan</button>
            </div>
        </div>

        <div id="Mogelijke_GSM" class="Mogelijke_GSM">
            <?php
                if (isset($_SESSION['Mogelijke_GSM_nrs']))
                    {
                        foreach ($_SESSION['Mogelijke_GSM_nrs'] as $Mogelijk_GSM_nr)
                            {
                                echo "<div>";
                                    /** Verwijderknop */
                                    echo "<button type='submit' id='".$Mogelijk_GSM_nr."' name='".$Mogelijk_GSM_nr."'>x</button>";
                                    /** Mogelijk gsm nummer tonen in tekstvak */
                                    echo "<label id='Mogelijke_GSM_nrs' name='Mogelijke_GSM_nrs[]'>".$Mogelijk_GSM_nr."</label><br />";
                                echo '</div>';
                            }   
                    }
            ?>
        </div>
    </div>
    
    <div>
        <div>
            <div>
                <label for="Telefoon">Telefoon</label><br />
                <input type="text" id="Telefoon" name="Telefoon"/>
            </div>
            
            <div>
                <label for="Besch_Tel">Beschrijving telefoon</label>
                <textarea id="Besch_Tel" name="Besch_Tel"></textarea>
            </div>
            
            <div>
                <button type="submit" id="Telefoon_Opslaan" name="Telefoon_Opslaan">Opslaan</button>
            </div>
        </div>
        
        <div id="Mogelijke_Tel" class="Mogelijke_Tel">
            <?php
                if (isset($_SESSION['Mogelijke_Tel_nrs']))
                    {
                        foreach ($_SESSION['Mogelijke_Tel_nrs'] as $Mogelijk_Tel_nr)
                            {
                                echo "<div>";
                                    /** Verwijderknop */
                                    echo "<button type='submit' id='".$Mogelijk_Tel_nr."' name='".$Mogelijk_Tel_nr."'>x</button>";
                                    /** Mogelijk telefoon nummer tonen in tekstvak */
                                    echo "<label id='Mogelijke_Tel_nrs' name='Mogelijke_Tel_nrs[]'>".$Mogelijk_Tel_nr."</label><br />";
                                echo '</div>';
                            }   
                    }
            ?>
        </div>
    </div>
    
    <div>
        <div>
            <div>
                <label for="Email">Email</label><br />
                <input type="text" id="Email" name="Email"/>
            </div>
            
            <div>
                <label for="Besch_GSM">Beschrijving GSM</label>
                <textarea id="Besch_GSM" name="Besch_GSM"></textarea>
            </div>
            
            <div>
                <button type="submit" id="Email_Opslaan" name="Email_Opslaan">Opslaan</button>
            </div>
        </div>
        
        <div id="Mogelijke_Email" class="Mogelijke_Email">
            <?php
                if (isset($_SESSION['Mogelijke_Emailadressen']))
                    {
                        foreach ($_SESSION['Mogelijke_Emailadressen'] as $Mogelijk_Emailadres)
                            {
                                echo "<div>";
                                    /** Verwijderknop */
                                    echo "<button type='submit' id='".$Mogelijk_Emailadres."' name='".$Mogelijk_Emailadres."'>x</button>";
                                    /** Mogelijk emailadres tonen in tekstvak */
                                    echo "<label id='Mogelijke_Emailadressen' name='Mogelijke_Emailadressen[]'>".$Mogelijk_Emailadres."</label><br />";
                                echo '</div>';
                            }   
                    }
            ?>
        </div>
    </div>
    
    <div>
        <!-- Contact opslaan knop -->
        <button type="submit" id="Contact_Opslaan" name="Contact_Opslaan">Opslaan</button>
        <!-- Volgende knop -->
        <button type="submit" id="Volgende" name="Volgende">Volgende</button>
    </div>
</form>

<script type="text/javascript">
<!--
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
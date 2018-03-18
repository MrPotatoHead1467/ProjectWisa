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
        <label for="Persoon">Persoon</label>
        <select id="Persoon" name="Persoon">
            <option value="Kies">Kies persoon</option>
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
                        echo "<option value='".$row['fld_persoon_id']."'>".$row['fld_persoon_naam']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    
    <div>
        <label for="Straat">Straat</label>
        <input type="text" id="Straat" name="Straat"/>
    </div>
    
    <div>
        <label for="Huisnummer">Huisnummer</label>
        <input type="text" id="Huisnummer" name="Huisnummer"/>
    </div>
    
    <div>
        <label>Woonplaats</label>
        <select id="Woonplaats_Lijst" name="Woonplaats_Lijst" onchange="woonplaats_niet_be()">
            <option value="Kies">Kies woonplaats</option>
            <option value="Niet_BE">Woonplaats niet in Belgie</option>
        </select>
        
        <div class="Woonplaats_niet_be" id="Woonplaats_niet_be">
            <label for="Woonplaats_niet_be_txt">Geef woonplaats in</label>
            <input type="text" name="Woonplaats_niet_be_txt"/>
        </div>
        
    </div>
    
    <div>
        <!-- Invoervak voor GSM nummer met opslaan knop -->
        <label for="GSM">GSM</label>
        <input type="text" id="GSM" name="GSM"/>
        <button type="submit" id="GSM_Opslaan" name="GSM_Opslaan">Opslaan</button>
    </div>
        
    <div>
        <label for="Telefoon">Telefoon</label>
        <input type="text" id="Telefoon" name="Telefoon"/>
        <button></button>
    </div>

    <div>
        <label for="Email">Email</label>
        <input type="text" id="Email" name="Email"/>
        <button></button>
    </div>
    
    <div>
        <button type="submit" id="Opslaan" name="Opslaan">Opslaan</button>
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
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Persoonsformulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
if (isset($_SESSION['EID_Voornaam'])){
    
}
else {
    $_SESSION['EID_Voornaam'] = '';
}
if (isset($_SESSION['EID_Achternaam'])){
    
}
else {
    $_SESSION['EID_Achternaam'] = '';
}
if (isset($_SESSION['EID_Rijksregisternr'])){
    
}
else {
    $_SESSION['EID_Rijksregisternr'] = '';
}
?>
<form action="EID_Lezen.php" method="post">
<button type="submit" name="EID_Lezen">EID lezen</button>
</form>
<form action="WISA-Persoonsformulier_Check.php" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" id="Bestand_persoon" name="Bestand_persoon[]" multiple />
    </div>
    
    <div>
        <label for="Foto_persoon">Pasfoto</label><br />
        <input type="file" id="Foto_persoon" name="Foto_persoon"/>
    </div>
    
    <div>
        <input type="checkbox" name="Leerling" id="Leerling" checked="True" onclick="display_leerling()"/>
        <label for="Leerling">Leerling</label><br />
    </div>
    
    <div>
        <label for="Voornaam">Voornaam</label><br />
        <input type="text" id="Voornaam" name="Voornaam" class="textbox" <?php echo "value='".$_SESSION['EID_Voornaam']."'" ?> required="True"/><br />
    </div>
    
    <div>
        <label for="Achternaam">Achternaam</label><br />
        <input type="text" id="Achternaam" name="Achternaam" <?php echo "value='".$_SESSION['EID_Achternaam']."'" ?> required="True"/><br />
    </div>
    
    <div>
        <label for="Geslacht">Geslacht</label><br />
        <select id="Geslacht" name="Geslacht">
            <option value="Kies">Geslacht</option>
            <option value="M">Man</option>
            <option value="V">Vrouw</option>
        </select>
        <br />
    </div>
    
    <div>
        <label for="GB_Datum">Geboortedatum</label><br />
        <input type="date" id="GB_Datum" name="GB_Datum"/><br />
    </div>
    
    <div id="Leerlingen">
        <div>
            <label for="GB_Plaats">Geboorteplaats</label><br />
            <select id="GB_Plaats" name="GB_Plaats">
                <option value="Werkt">Geboorteplaatsen</option>
            </select>
            <br />
        </div>
        
        <div>
            <label for="Register_nr">Rijksregisternummer</label><br />
            <input type="text" id="Register_nr" name="Register_nr" <?php echo "value='".$_SESSION['EID_Rijksregisternr']."'" ?> /><br />
        </div>
        
        <div>
            <div>
                <input type="checkbox" id="Geen_Register_nr" name="Geen_Register_nr"/>
                <label for="Geen_Register_nr">Geen rijksregisternummer</label><br />
            </div>
            
            <div>
                <label for="Bis_nr">BIS-Nummer</label>
                <input type="text" id="Bis_nr" name="Bis_nr"/>
            </div>
        </div>
        
        <div>
            <label for="Nationaliteit">Nationaliteit</label><br />
            <select id="Nationaliteit" name="Nationaliteit">
                <option value="0">Kies een nationaliteit</option>
                <?php
                    $sql = "SELECT * FROM tbl_nationaliteiten";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option value='".$row['fld_nation_id']."'>".$row['fld_nation_nation']."</option>";
                        }
                    }
                ?>
            </select>
        </div>
        
        <div>
            <label for="Godsdienst">Godsdienst</label>
            <select id="Godsdienst" name="Godsdienst">
                <option value="0">Kies een godsdienst</option>
                <?php
                    $sql = "SELECT * FROM tbl_godsdiensten";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option value='".$row['fld_godsdienst_id']."'>".$row['fld_godsdienst_naam']."</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    
    <div id="Niet_Leerling" class="Niet_Leerling">
        <label for="Overleden">Overleden</label>
        <input type="checkbox" id="Overleden" name="Overleden"/>
    </div>
    
    <div>
        <button id="Persoon_Opslaan" name="Persoon_Opslaan">Persoon opslaan</button>
        <button id="Volgende" name="Volgende">Volgende</button>
    </div>
</form>

<script type="text/javascript">
<!--
	function display_leerling() {
	   if (document.getElementById('Leerling').checked) {
        document.getElementById('Leerlingen').style.display = 'block';
        document.getElementById('Niet_Leerling').style.display = 'none';
	   }
       else {
        document.getElementById('Leerlingen').style.display = 'none';
        document.getElementById('Niet_Leerling').style.display = 'block';
       }
       
	}
-->
</script>

</body>
</html>
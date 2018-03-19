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

if (isset($_SESSION['EID_Voornaam']))
    {
        
    }
else
    {
        $_SESSION['EID_Voornaam'] = '';
    }
    
if (isset($_SESSION['EID_Achternaam']))
    {
        
    }
else 
    {
        $_SESSION['EID_Achternaam'] = '';
    }
    
if (isset($_SESSION['EID_Rijksregisternr']))
    {
        
    }
else 
    {
        $_SESSION['EID_Rijksregisternr'] = '';
    }
?>
<div class="form_box_1">
    <form action="EID_Lezen.php" method="post">
        <!-- Icon nodig ID -->
        <button class="form_eidi" type="submit" name="EID_Lezen">EID lezen</button>
    </form>
</div>

<form action="WISA-Persoonsformulier_Check.php" method="post" enctype="multipart/form-data">
  
    <!-- bestanden toevoegen -->
    <div id="form_box_1">
        <!-- icon nodig bestanden -->
        <input class="form_bsdi" id="Bestand_persoon" name="Bestand_persoon[]" multiple  type="file"/>
    </div>
    
    <!-- pasfoto lln -->
    <div class="form_box_1">
        <label class="form_lbl" for="Foto_persoon">Pasfoto</label><br />
        <input class="form_pici" type="file" id="Foto_persoon" name="Foto_persoon"/>
    </div>
    
    <!-- lln?? -->
    <div class="form_box_1">
        <input type="checkbox" name="Leerling" id="Leerling" checked="True" onclick="display_leerling()"/>
        <label class="form_lbl" for="Leerling">Leerling</label><br />
    </div>
    
    <!-- voornaam -->
    <div class="form_box_1">
        <label class="form_lbl" for="Voornaam">Voornaam</label><br />
        <div class="form_box_in">
            <input class="form_in" id="Voornaam" name="Voornaam" type="text"<?php echo "value='".$_SESSION['EID_Voornaam']."'" ?> required="True"/><br />
        </div>
    </div>
    
    <!-- achternaam -->
    <div class="form_box_1">
        <label class="form_lbl" for="Achternaam">Achternaam</label><br />
        <div class="form_box_in">    
            <input class="form_in" id="Achternaam" name="Achternaam" type="text" <?php echo "value='".$_SESSION['EID_Achternaam']."'" ?> required="True"/><br />
        </div>
    </div>
    
    <!-- geslacht -->
    <div class="form_box_1">
        <label class="form_lbl" for="Geslacht">Geslacht</label><br />
        <select class="form_slt" id="Geslacht" name="Geslacht">
            <option value="...">...</option>
            <option value="M">Manelijkn</option>
            <option value="V">Vrouwelijk</option>
        </select>
        <br />
    </div>
    
    <div class="form_box_1">
        <label class="form_lbl" for="GB_Datum">Geboortedatum</label><br />
        <div class="form_box_in">  
            <input class="form_in" type="date" id="GB_Datum" name="GB_Datum"/><br />
        </div>
    </div>
    
    <div id="Leerlingen">
        
        <!-- geboorteplaats -->
        <div class="form_box_1">
            <label class="form_lbl" for="GB_Plaats">Geboorteplaats</label><br />
            <select class="form_slt" id="GB_Plaats" name="GB_Plaats">
                <option value="Werkt">...</option>
                <!-- lijst geboorteplaatsen nog toevoegen -->
            </select>
            <br />
        </div>
        
        <!-- nationaliteiten -->
        <div class="form_box_1">
            <label class="form_lbl" for="Nationaliteit">Nationaliteit</label><br />
            <select class="form_slt" id="Nationaliteit" name="Nationaliteit">
                <option value="0">...</option>
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
        
        <!-- rijksregisternummer?? -->
        <div class="form_box_1">
            <input type="checkbox" id="Geen_Register_nr" name="Geen_Register_nr"/>
            <label class="form_lbl" for="Geen_Register_nr">Geen rijksregisternummer</label><br />
        </div>
        
        <!-- rijksregisternummer -->
        <div class="form_box_1">
            <label class="form_lbl" for="Register_nr">Rijksregisternummer</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Register_nr" name="Register_nr" type="text" <?php echo "value='".$_SESSION['EID_Rijksregisternr']."'" ?> /><br />
            </div>
        </div>
        
        <!-- bis-nummer -->
        <div class="form_box_1">
            <label class="form_lbl" for="Bis_nr">BIS-Nummer</label>
            <div class="form_box_in ">
                <input class="form_in" id="Bis_nr" name="Bis_nr" type="text"/>
            </div>
        </div>
        
        <!-- godsdiensten -->
        <div class="form_box_1">
            <label class="form_lbl" for="Godsdienst">Godsdienst</label><br/>
            <select class="form_slt" id="Godsdienst" name="Godsdienst">
                <option value="0">...</option>
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
    
    <!-- overleden ?? -->
    <div id="Niet_Leerling" class="Niet_Leerling">
        <div class="form_box_1">
            <input type="checkbox" id="Overleden" name="Overleden"/>
            <label class="form_lbl" for="Overleden">Overleden</label>
        </div>
    </div>
    
    <!-- persoon opslaan knop -->
    <div class="form_box_1">
        <!-- Knop om de vraag op te slaan -->  
        <button class="form_btn"  id="Persoon_Opslaan" name="Persoon_Opslaan">Persoon opslaan</button>
        <!-- Knop om te annuleren, alle -->
        <button class="form_ccl"  id="Volgende" name="Volgende">Volgende</button>
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
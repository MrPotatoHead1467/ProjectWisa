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
$Datum = date("Y-m-d");
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

if (isset($_SESSION['EID_GB_Datum']))
    {
        
    }
else 
    {
        $_SESSION['EID_GB_Datum'] = '';
    }
?>

<div class="form_box_1">
    <form action="EID_Lezen.php" method="post">
        <!-- Icon nodig ID -->
        <button class="form_eidi" type="submit" name="EID_Lezen" title="Identiteitskaart inlezen.">EID lezen</button>
    </form>
</div>

<form action="WISA-Persoonsformulier_Check.php" method="post" enctype="multipart/form-data">
  
    <!-- bestanden toevoegen -->
    <div class="form_box_1">
        <!-- icon nodig bestanden -->
        <input class="form_bsdi" id="Bestand_persoon" name="Bestand_persoon[]" multiple type="file" title="Document selecteren."/>
    </div>
    
    
    <!-- lln?? -->
    <div class="form_box_1">
        <input name="Leerling" id="Leerling" checked="True" onclick="display_leerling()" title="Aanvinken indien u een leerling bent." type="checkbox"/>
        <label class="form_lbl" for="Leerling" title="Aanvinken indien u een leerling bent.">Leerling</label><br />
    </div>
    
    <!-- pasfoto lln -->
    <div class="form_box_1" id="Div_Pasfoto">
        <label class="form_lbl" for="Foto_persoon" title="Pasfoto van de leerling selecteren.">Pasfoto</label><br />
        <input class="form_pici" type="file" id="Foto_persoon" name="Foto_persoon" title="Pasfoto van de leerling selecteren."/>
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
            <option value="M">Mannelijk</option>
            <option value="V">Vrouwelijk</option>
        </select>
        <br />
    </div>
    
    <!-- geboorte datum -->
    <div class="form_box_1">
        <label class="form_lbl" for="GB_Datum">Geboortedatum</label><br />
        <div class="form_box_in">  
            <input class="form_in" type="date" id="GB_Datum" name="GB_Datum" max="<?php echo $Datum; ?>" <?php echo "value='".$_SESSION['EID_GB_Datum']."'"; ?>/><br />
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
            <input type="checkbox" id="Geen_Register_nr" name="Geen_Register_nr" onclick="display_bis()" title="Indien u uw rijksregister niet meeheeft of geen geen heeft aanvinken."/>
            <label class="form_lbl" for="Geen_Register_nr" title="Indien u uw rijksregister niet meeheeft of geen geen heeft aanvinken.">Geen rijksregisternummer</label><br />
        </div>
        
        <!-- rijksregisternummer -->
        <div class="form_box_1" id="Div_Register_nr">
            <label class="form_lbl" for="Register_nr" title="Vb: 99041254023">Rijksregisternummer</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Register_nr" name="Register_nr" placeholder="Zonder spaties of tekens ingeven." title="Vb: 99041254023" type="text" pattern=".{11}" <?php echo "value='".$_SESSION['EID_Rijksregisternr']."'" ?> /><br />
            </div>
        </div>
        
        <!-- bis-nummer -->
        <div class="form_box_1" id="Div_Bis_nr">
            <label class="form_lbl" for="Bis_nr" title="Vb: 99041254023">BIS-Nummer</label>
            <div class="form_box_in ">
                <input class="form_in" id="Bis_nr" name="Bis_nr" placeholder="Zonder spaties of tekens ingeven." title="Vb: 99041254023" type="text" pattern=".{11}"/>
            </div>
        </div>
        
        <!-- godsdiensten -->
        <div class="form_box_1">
            <label class="form_lbl" for="Godsdienst" title="De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.">Godsdienst</label><br/>
            <select class="form_slt" id="Godsdienst" name="Godsdienst" title="De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.">
                <option value="0">...</option>
                <?php
                    $sql = "SELECT * FROM tbl_godsdiensten";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option title='De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.' value='".$row['fld_godsdienst_id']."'>".$row['fld_godsdienst_naam']."</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    
    <!-- overleden ?? -->
    <div id="Niet_Leerling" class="Niet_Leerling">
        <div class="form_box_1">
            <input type="checkbox" id="Overleden" name="Overleden" title="Aanvinken indien de persoon overleden is."/>
            <label class="form_lbl" for="Overleden" title="Aanvinken indien de persoon overleden is.">Overleden</label>
        </div>
    </div>
    
    <!-- persoon opslaan knop -->
    <div class="form_box_1">
        <!-- Knop om de vraag op te slaan -->  
        <button class="form_btn"  id="Persoon_Opslaan" name="Persoon_Opslaan" title="Persoon opslagen en formulier leegmaken voor de volgende persoon.">Persoon opslaan</button>
        <!-- Knop om te annuleren, alle -->
        <button class="form_ccl"  id="Volgende" name="Volgende" title="Volgende formulier: relaties.">Volgende</button>
    </div>
</form>

<script type="text/javascript">
<!--
	function display_leerling() {
	   if (document.getElementById('Leerling').checked) {
        document.getElementById('Leerlingen').style.display = 'block';
        document.getElementById('Niet_Leerling').style.display = 'none';
        document.getElementById('Div_Pasfoto').style.display = 'block';
	   }
       else {
        document.getElementById('Leerlingen').style.display = 'none';
        document.getElementById('Niet_Leerling').style.display = 'block';
        document.getElementById('Div_Pasfoto').style.display = 'none';
       }
	}
    function display_bis() {
	   if (document.getElementById('Geen_Register_nr').checked) {
        document.getElementById('Div_Register_nr').style.display = 'none';
        document.getElementById('Div_Bis_nr').style.display = 'block';
	   }
       else {
        document.getElementById('Div_Register_nr').style.display = 'block';
        document.getElementById('Div_Bis_nr').style.display = 'none';
       }
	}
-->
</script>

</body>
</html>
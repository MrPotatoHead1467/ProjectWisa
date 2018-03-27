<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
	<title>WISA | Persoonsformulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
$Datum = date("Y-m-d");
if (!isset($_SESSION['Bestaande_Persoon']))
    {
        $_SESSION['Bestaande_Persoon'] = 0;
    }
    
if (!isset($_SESSION['EID_Voornaam']))
    {
        $_SESSION['EID_Voornaam'] = '';
    }

if (!isset($_SESSION['EID_Achternaam']))
    {
        $_SESSION['EID_Achternaam'] = '';
    }
    
if (!isset($_SESSION['Geslacht']))
    {
        $_SESSION['Geslacht'] = '';
    }
    
if (!isset($_SESSION['EID_GB_Datum']))
    {
        $_SESSION['EID_GB_Datum'] = '';
    }

if (!isset($_SESSION['GB_Plaats']))
    {
        $_SESSION['GB_Plaats'] = '';
    }
    
if (!isset($_SESSION['EID_Rijksregisternr']))
    {
        $_SESSION['EID_Rijksregisternr'] = '';
    }
    
if (!isset($_SESSION['Geen_Rijksregisternr']))
    {
        $_SESSION['Geen_Rijksregisternr'] = '';
    }
    
if (!isset($_SESSION['Nationaliteit']))
    {
        $_SESSION['Nationaliteit'] = '';
    }
    
if (!isset($_SESSION['Bisnr']))
    {
        $_SESSION['Bisnr'] = '';
    }
    
if (!isset($_SESSION['Godsdienst']))
    {
        $_SESSION['Godsdienst'] = '';
    }

if (!isset($_SESSION['Overleden']))
    {
        $_SESSION['Overleden'] = '';
    }
if (!isset($_SESSION['Is_Leerling']))
    {
        $_SESSION['Is_Leerling'] = '1';
    }
?>

    <!-- Icons -->
    <label class="form_bsdi" onclick="KlikKnop('Bestand_persoon')" title="Document selecteren."></label>
    <label class="form_eidi" onclick="KlikKnop('EID_Lezen')" title="Identiteitskaart inlezen."></label>

    <!-- Bestaand persoon opzoeken -->
    <form action="WISA-Persoonsformulier_Check.php" method="post">
        <div class="form_box_zoek">
            <label class="form_lbl" for="Persoon_Zoeken_in">Persoon zoeken</label><br />
            <button class="form_edit" id="Persoon_Zoeken_btn" name="Persoon_Zoeken_btn" type="submit">Gegevens invullen</button>
            <div class="form_zoek">
                <input class="form_in" id="Persoon_Zoeken_in" list="Persoon_Zoeken_List" name="Persoon_Zoeken_in" placeholder="..." />
                <label class="form_editi" for="Persoon_Zoeken_btn" onclick="KlikKnop('Persoon_Zoeken_btn')" title="Bestaand persoon opzoeken."></label>
            </div>
            <datalist class="form_slt" id="Persoon_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_personen";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_persoon_id']."' value='".$row['fld_persoon_naam']." (".$row['fld_persoon_gb_datum'].") '>";
                        }
                    }
                ?>
            </datalist>
            <input id="Persoon_Zoeken" name="Persoon_Zoeken" type="hidden"/>
        </div>
    </form>
    
    <div class="form_box_zoek_border">
    </div>


<!-- EID inlezen -->
<div class="form_box_1">
    <form action="EID_Lezen.php" method="post">
        <button class="form_eid" id="EID_Lezen" name="EID_Lezen" type="submit">EID lezen</button>
    </form>
</div>

<form action="WISA-Persoonsformulier_Check.php" method="post" enctype="multipart/form-data">
  
    <!-- bestanden toevoegen -->
    <div class="form_box_1">
        <input class="form_bsd" id="Bestand_persoon" name="Bestand_persoon[]" multiple type="file"/>
    </div>
    
    
    <!-- lln?? -->
    <div class="form_box_1">
        <input name="Leerling" id="Leerling" checked="True" onclick="display_leerling()" title="Aanvinken indien u een leerling bent." type="checkbox"/>
        <label class="form_lbl" for="Leerling" title="Aanvinken indien u een leerling bent.">Leerling</label><br />
    </div>
    
    <!-- pasfoto lln -->
    <div class="form_box_1" id="Div_Pasfoto">
        <label class="form_lbl" for="Foto_persoon" title="Pasfoto van de leerling selecteren.">Pasfoto</label><br />
        <div class="form_box_in">
            <input class="form_picp" type="file" id="Foto_persoon" name="Foto_persoon"/>
            <label class="form_picpi" onclick="KlikKnop('Foto_persoon')" title="Pasfoto van de leerling selecteren."></label>
        </div>
    </div>
    
    <!-- naam -->
    <div class="form_box_1">
        <label class="form_lbl" for="Voornaam">Naam</label><br />
        <!-- voornaam -->
        <div class="form_box_in">
            <input class="form_in" id="Voornaam" maxlength="255" name="Voornaam" placeholder="Voornaam" type="text"<?php echo "value='".$_SESSION['EID_Voornaam']."'" ?> required="True"/><br />
        </div>
        <!-- achternaam -->
        <div class="form_box_in">    
            <input class="form_in" id="Achternaam" maxlength="255" name="Achternaam" placeholder="Achternaam" type="text" <?php echo "value='".$_SESSION['EID_Achternaam']."'" ?> required="True"/><br />
        </div>
    </div>
    
    <!-- geslacht -->
    <div class="form_box_1">
        <label class="form_lbl" for="Geslacht">Geslacht</label><br />
        <select class="form_slt" id="Geslacht" name="Geslacht">
            <option value="Kies">...</option>
            <option value="M">Mannelijk</option>
            <option value="V">Vrouwelijk</option>
        </select>
        <br/>
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
            <label class="form_lbl" for="GB_Plaats_in">Geboorteplaats</label><br />
            <label for="GB_Plaats_Niet_Be">Geboorteplaas niet in Belgi&euml;</label>
            <input id="GB_Plaats_Niet_Be" name="GB_Plaats_Niet_Be" onclick="display_gb_plaats()" type="checkbox"/>
            
            <div class="form_zoek" id="GB_Plaats_Wel_Be">
                <input id="GB_Plaats_in" list="GB_Plaats_List" name="GB_Plaats_in" placeholder="..."
            <?php 
            if ($_SESSION['GB_Plaats'] != '') {
                $sql = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$_SESSION['GB_Plaats']."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "value='".$row['fld_postnummer']." | ".$row['fld_woonplaats_naam']."'";
                    }
                }
            } 
            ?>
            />
            </div>
            <datalist class="form_slt" id="GB_Plaats_List">
                <?php
                    $sql = "SELECT * FROM tbl_postcodes";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_postcode_id']."' value='".$row['fld_postnummer']." | ".$row['fld_woonplaats_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="GB_Plaats" name="GB_Plaats" type="hidden" <?php echo 'value="'.$_SESSION["GB_Plaats"].'"'; ?>/>
            
            <div id="GB_Plaats_Niet_Be_Div">
                <input type="text" id="GB_Plaats_Niet_Be_in" name="GB_Plaats_Niet_Be_in"/>
            </div>
        </div>
        
        <!-- nationaliteiten -->
        <div class="form_box_1">
            <label class="form_lbl" for="Nationaliteit_in">Nationaliteit</label><br />
            <div class="form_zoek">
                <input id="Nationaliteit_in" list="Nationaliteit_List" name="Nationaliteit_in" placeholder="..." 
            <?php 
            if ($_SESSION['Nationaliteit'] != '') {
                $sql = "SELECT * FROM tbl_nationaliteiten WHERE fld_nation_id='".$_SESSION['Nationaliteit']."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "value='".$row['fld_nation_nation']."'";
                    }
                }
            } 
            ?>
            />
            </div>
            <datalist class="form_slt" id="Nationaliteit_List" >
                <?php
                    $sql = "SELECT * FROM tbl_nationaliteiten";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_nation_id']."' value='".$row['fld_nation_nation']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Nationaliteit" name="Nationaliteit" type="hidden" <?php echo "value='".$_SESSION['Nationaliteit']."'"; ?>/>
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
                <input class="form_in" id="Bis_nr" name="Bis_nr" placeholder="Zonder spaties of tekens ingeven." title="Vb: 99041254023" type="text" pattern=".{11}" <?php echo "value='".$_SESSION['Bisnr']."'" ?> />
            </div>
        </div>
        
        <!-- godsdiensten -->
        <div class="form_box_1">
            <label class="form_lbl" for="Godsdienst" title="De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.">Godsdienst</label><br/>
            <div class="form_zoek">
                <input id="Godsdienst_in" list="Godsdienst_List" name="Godsdienst_in" placeholder="..." title="De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven."
            <?php 
                if ($_SESSION['Godsdienst'] != '') {
                    $sql = "SELECT * FROM tbl_godsdiensten WHERE fld_godsdienst_id='".$_SESSION['Godsdienst']."'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "value='".$row['fld_godsdienst_naam']."'";
                        }
                    }
                } 
            ?>
            />
            </div>
            <datalist class="form_slt" id="Godsdienst_List" title="De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.">
                <?php
                    $sql = "SELECT * FROM tbl_godsdiensten";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_godsdienst_id']."' title='De godsdienst die u kiest, moet overeenkomen met dat van de instelling waarvoor u zich wenst in te schrijven.' value='".$row['fld_godsdienst_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Godsdienst" name="Godsdienst" type="hidden" <?php echo "value='".$_SESSION['Godsdienst']."'"; ?>/>
        </div>
    </div>
    
    <!-- overleden ?? -->
    <div id="Niet_Leerling" class="Niet_Leerling">
        <div class="form_box_1">
            <input type="checkbox" id="Overleden" name="Overleden" title="Aanvinken indien de persoon overleden is."/>
            <label class="form_lbl" for="Overleden" title="Aanvinken indien de persoon overleden is.">Overleden</label>
        </div>
    </div>
    
    <div class="form_box_btn_border">
    </div>
    
    <!-- persoon opslaan knop -->
    <div class="form_box_btn">
        <!-- Knop om de Persoon op te slaan -->  
        <button class="form_btn"  id="Persoon_Opslaan" name="Persoon_Opslaan" title="Persoon opslagen en formulier leegmaken voor de volgende persoon." type="submit">Persoon opslaan</button>
        <!-- Knop om te annuleren --> 
        <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
        <!-- Volgende formulier -->
        <button class="form_next"  id="Volgende" name="Volgende" title="Volgende formulier: Relaties." type="submit">Volgende</button>
        <label class="form_nexti" onclick="KlikKnop('Volgende')" title="Identiteitskaart inlezen."></label>
    </div>
</form>

<script type="text/javascript">
<!--
    function KlikKnop(knop)
        {
            document.getElementById(knop).click();
        }
    
	function display_leerling() 
        {
            if (document.getElementById('Leerling').checked)
                {
                    document.getElementById('Leerlingen').style.display = 'block';
                    document.getElementById('Niet_Leerling').style.display = 'none';
                    document.getElementById('Div_Pasfoto').style.display = 'block';
                }
            else 
                {
                    document.getElementById('Leerlingen').style.display = 'none';
                    document.getElementById('Niet_Leerling').style.display = 'block';
                    document.getElementById('Div_Pasfoto').style.display = 'none';
                }
	   }
    function display_gb_plaats() 
        {
            if (document.getElementById('GB_Plaats_Niet_Be').checked)
                {
                    document.getElementById('GB_Plaats_Niet_Be_Div').style.display = 'block';
                    document.getElementById('GB_Plaats_Wel_Be').style.display = 'none';

                }
            else 
                {
                    document.getElementById('GB_Plaats_Niet_Be_Div').style.display = 'none';
                    document.getElementById('GB_Plaats_Wel_Be').style.display = 'block';

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
    function leerling() {
        document.getElementById("Leerling").checked = true;
        display_leerling();
    }
    function niet_leerling() {
        document.getElementById("Leerling").checked = false;
        display_leerling();
    }
    
    function geslacht(x) {
        document.getElementById('Geslacht').value = x;
    }
    
    function geen_rijksregisternr(){
        document.getElementById("Geen_Register_nr").checked = true;
        display_bis();
    }
    
    function overleden(){
        document.getElementById("Overleden").checked = true;
    }
    
    $(function() {
      $('#Nationaliteit_in').on('input',function() {
        var opt = $('option[value="'+$(this).val()+'"]');
        document.getElementById("Nationaliteit").value = opt.attr('id');
      });
    });
    $(function() {
      $('#GB_Plaats_in').on('input',function() {
        var opt = $('option[value="'+$(this).val()+'"]');
        document.getElementById("GB_Plaats").value = opt.attr('id');
      });
    });
    $(function() {
      $('#Godsdienst_in').on('input',function() {
        var opt = $('option[value="'+$(this).val()+'"]');
        document.getElementById("Godsdienst").value = opt.attr('id');
      });
    });
    $(function() {
      $('#Persoon_Zoeken_in').on('input',function() {
        var opt = $('option[value="'+$(this).val()+'"]');
        document.getElementById("Persoon_Zoeken").value = opt.attr('id');
      });
    });
-->
</script>

<?php 
if ($_SESSION['Geslacht'] == 'M' || $_SESSION['Geslacht'] == 'V'){
    echo '<script type="text/javascript">geslacht("'.$_SESSION["Geslacht"].'");</script>';
}

if ($_SESSION['Geen_Rijksregisternr'] == 1){
    echo '<script type="text/javascript">geen_rijksregisternr();</script>';
}

if ($_SESSION['Is_Leerling'] == 1){
    echo '<script type="text/javascript">leerling();</script>';
}

elseif ($_SESSION['Is_Leerling'] == 0){
    echo '<script type="text/javascript">niet_leerling();</script>';
}

if ($_SESSION['Overleden'] == 1){
    echo '<script type="text/javascript">overleden();</script>';
}

?>

</body>
</html>
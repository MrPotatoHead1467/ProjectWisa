<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
	<title>WISA | Beheer logins</title>
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

    <!-- Bestaand persoon opzoeken -->
    <form action="WISA-BeheerLogins_Check.php" method="post">
        <div class="form_box_zoek">
            <label class="form_lbl" for="Login_Zoeken_in">Login zoeken</label><br />
            <button class="form_edit" id="Login_Zoeken_btn" name="Login_Zoeken_btn" type="submit">Gegevens invullen</button>
            <div class="form_zoek">
                <input class="form_in" id="Login_Zoeken_in" list="Login_Zoeken_List" name="Login_Zoeken_in" placeholder="..." />
                <label class="form_editi" for="Login_Zoeken_btn" onclick="KlikKnop('Login_Zoeken_btn')" title="Bestaand login opzoeken."></label>
            </div>
            <datalist class="form_slt" id="Login_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_gebruikers";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_gebruiker_id']."' value='Naam gebruiker (naam instelling) '>";
                        }
                    }
                ?>
            </datalist>
            <input id="Login_Zoeken" name="Login_Zoeken" type="hidden"/>
        </div>
    </form>
    
    <div class="form_box_zoek_border">
    </div>

    <form action="WISA-BeheerLogins_Check.php" method="post" enctype="multipart/form-data">
        
        <!-- naam -->
        <div class="form_box_1">
            <label class="form_lbl" for="Voornaam_G">Naam</label><br />
            <!-- voornaam -->
            <div class="form_box_in">
                <input class="form_in" id="Voornaam_G" maxlength="255" name="Voornaam_G" placeholder="Voornaam" type="text" required="True"/><br />
            </div>
            <!-- achternaam -->
            <div class="form_box_in">    
                <input class="form_in" id="Achternaam_G" maxlength="255" name="Achternaam_G" placeholder="Achternaam" type="text" required="True"/><br />
            </div>
        </div>
        
        <!-- geslacht -->
        <div class="form_box_1">
            <label class="form_lbl" for="Geslacht_G">Geslacht</label><br />
            <select class="form_slt" id="Geslacht_G" name="Geslacht_G">
                <option value="Kies">...</option>
                <option value="M">Mannelijk</option>
                <option value="V">Vrouwelijk</option>
            </select>
            <br/>
        </div>
        
        <!-- geboorte datum -->
        <div class="form_box_1">
            <label class="form_lbl" for="GB_Datum_G">Geboortedatum</label><br />
            <div class="form_box_in">  
                <input class="form_in" type="date" id="GB_Datum_G" name="GB_Datum_G" max="<?php echo $Datum; ?>"/><br />
            </div>
        </div>
            
        <!-- rijksregisternummer -->
        <div class="form_box_1">
            <label class="form_lbl" for="Register_nr_G">Rijksregisternummer</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Register_nr_G" name="Register_nr_G" placeholder="Zonder spaties of tekens ingeven." title="Vb: 99041254023" type="text" pattern=".{11}" /><br />
            </div>
        </div>
        
        <div class="form_box_btn_border">
        </div>
        
        <!-- login opslaan knop -->
        <div class="form_box_btn">
            <!-- Knop om de login op te slaan -->  
            <button class="form_btn"  id="Login_Opslaan" name="login_Opslaan" title="Login opslagen en formulier leegmaken voor de volgende persoon." type="submit">Persoon opslaan</button>
            <!-- Knop om te annuleren --> 
            <button class="form_ccl" id="Annuleer_G" name="Annuleer_G" type="submit">Annuleren</button>
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
        document.getElementById('Div_Register_nr_2').style.display = 'none';
        document.getElementById('Div_Bis_nr_2').style.display = 'block';
	   }
       else {
        document.getElementById('Div_Register_nr').style.display = 'block';
        document.getElementById('Div_Bis_nr').style.display = 'none';
        document.getElementById('Div_Register_nr_2').style.display = 'block';
        document.getElementById('Div_Bis_nr_2').style.display = 'none';
       }
	}
    }
    function niet_leerling() {
        document.getElementById("Leerling").checked = false;
        display_leerling();
    }
    
    function geslacht(x) {
        document.getElementById('Geslacht').value = x;
    }

    }
    
    $(function() 
        {
            $('#Login_Zoeken_in').on('input',function() 
                {
                    var opt = $('option[value="'+$(this).val()+'"]');
                    document.getElementById("Login_Zoeken").value = opt.attr('id');
                });
        });
        
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
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
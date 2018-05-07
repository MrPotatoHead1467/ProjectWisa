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
    
if (!isset($_SESSION['EID_Rijksregisternr']))
    {
        $_SESSION['EID_Rijksregisternr'] = '';
    }
    
if (!isset($_SESSION['Gebruikersnaam_G']))
    {
        $_SESSION['Gebruikersnaam_G'] = '';
    }
    
if (!isset($_SESSION['Wachtwoord_G']))
    {
        $_SESSION['Wachtwoord_G'] = '';
    }
    
if (!isset($_SESSION['Beschrijving_G']))
    {
        $_SESSION['Beschrijving_G'] = '';
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
                            $sqlPersoon_Zoeken = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$row['fld_persoon_id_fk'];
                            $resultPersoon_Zoeken = mysqli_query($conn, $sqlPersoon_Zoeken);
                            if (mysqli_num_rows($resultPersoon_Zoeken) > 0) {
                                while($rowPersoon_Zoeken = mysqli_fetch_assoc($resultPersoon_Zoeken)){
                                    echo "<option id='".$row['fld_gebruiker_id']."' value='".$rowPersoon_Zoeken['fld_persoon_naam']." (".$row['fld_gebruiker_naam'].") '>";
                                }
                            }
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
                <input class="form_in" id="Voornaam_G" maxlength="255" name="Voornaam_G" placeholder="Voornaam" type="text" required="True" value="<?php echo $_SESSION['EID_Voornaam']?>"/><br />
            </div>
            <!-- achternaam -->
            <div class="form_box_in">    
                <input class="form_in" id="Achternaam_G" maxlength="255" name="Achternaam_G" placeholder="Achternaam" type="text" required="True" value="<?php echo $_SESSION['EID_Achternaam']?>"/><br />
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
                <input class="form_in" type="date" id="GB_Datum_G" name="GB_Datum_G" max="<?php echo $Datum; ?>" value="<?php echo $_SESSION['EID_GB_Datum']?>"/><br />
            </div>
        </div>
            
        <!-- rijksregisternummer -->
        <div class="form_box_1">
            <label class="form_lbl" for="Register_nr_G">Rijksregisternummer</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Register_nr_G" name="Register_nr_G" placeholder="Zonder spaties of tekens ingeven." title="Vb: 99041254023" type="text" pattern=".{11}" value="<?php echo $_SESSION['EID_Rijksregisternr']?>" /><br />
            </div>
        </div>
        
        <div class="form_box_1">
            <label class="form_lbl" for="Gebruikersnaam">Gebruikersnaam</label>
            <div class="form_box_in ">
                <input class="form_in" id="Gebruikersnaam" name="Gebruikersnaam" type="text" placeholder="Gebruikersnaam" value="<?php echo $_SESSION["Gebruikersnaam_G"]?>"/><br />
            </div>
        </div>
        
        <div class="form_box_1">
            <label class="form_lbl" for="Wachtwoord">Wachtwoord</label>
            <div class="form_box_in ">
                <input class="form_in" id="Wachtwoord" name="Wachtwoord" type="text" placeholder="Wachtwoord" value="<?php echo $_SESSION['Wachtwoord_G']?>"/><br />
            </div>
        </div>
        
        <div class="form_box_1">
            <label class="form_lbl" for="Beschrijving_G">Beschrijving</label>
            <div class="form_box_in ">
                <textarea class="form_in" id="Beschrijving_G" name="Beschrijving_G" placeholder="Beschrijving"><?php echo $_SESSION['Beschrijving_G']?></textarea><br />
            </div>
        </div>
        
        <div class="form_box_btn_border">
        </div>
        
        <!-- login opslaan knop -->
        <div class="form_box_btn">
            <!-- Knop om de login op te slaan -->  
            <button class="form_btn"  id="Login_Opslaan" name="Login_Opslaan" title="Login opslagen en formulier leegmaken voor de volgende persoon." type="submit">Login opslaan</button>
            <!-- Knop om te annuleren --> 
            <button class="form_ccl" id="Annuleer_G" name="Annuleer_G" type="submit">Annuleren</button>
            <!-- Gebruiker verwijderen -->
            <button class="form_next" id="Verwijderen" name="Verwijderen" title="Gebruiker verwijderen" type="submit">Verwijderen</button>
            <label class="form_nexti" onclick="KlikKnop('Verwijderen')" title="Gebruiker verwijderen"></label>
        </div>
    </form>

<script type="text/javascript">
<!--
    function KlikKnop(knop)
        {
            document.getElementById(knop).click();
        }
          
    function geslacht(x) {
        document.getElementById('Geslacht_G').value = x;
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
?>

</body>
</html>
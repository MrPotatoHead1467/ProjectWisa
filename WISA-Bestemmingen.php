<!-- <?php session_start();?> -->
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Bestemmingen</title>
</head>

<body>

    <?PHP
    
        if (isset($_SESSION['gebruiker']))
            {
               echo "";
            }
        else
            {
                header("Location: WISA-Inloggen.php");
            }  
        
        include "WISA-Connection.php";
    ?>
    
    
     <!-- bestemming zoeken -->
    <div>
        <form action="WISA-Bestemmingen_Check.php" method="post">
            <div class="form_box_zoek">
                <label class="form_lbl" for="Bestem_Zoeken_in">Bestemming zoeken</label><br />
                <button class="form_edit" id="Bestem_Zoeken_btn" name="Bestem_Zoeken_btn" type="submit">Gegevens invullen</button>
                <div class="form_zoek">
                    <input class="form_in" id="Bestem_Zoeken_in" list="Bestem_Zoeken_List" name="Bestem_Zoeken_in" placeholder="..." />
                    <label class="form_editi" for="Bestem_Zoeken_btn" onclick="KlikKnop('Bestem_Zoeken_btn')" title="Bestemming voor de gepersonaliseerde vragen zoeken."></label>
                </div>
                <datalist class="form_slt" id="Bestem_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_bestemmingen";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_bestemming_id']."' value='".$row['fld_bestemming_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Persoon_Zoeken" name="Persoon_Zoeken" type="hidden"/>
            </div>
        </form>
    </div>
    
    <div class="form_box_zoek_border">
    </div>
    
    
    <form action="WISA-Bestemmingen_Check.php" method="post"> 
        
        <!-- bestemming -->
        <div class="form_box_1">
            <label class="form_lbl" for="Voornaam">Bestemming</label><br />
            
            <!-- naam -->
            <div class="form_box_in">
                <input autofocus="autofocus" class="form_in" id="Naam" maxlength="255" name="Naam" placeholder="naam" required="True" type="text"/><br />
            </div>
            
            <!-- beschrijving -->
            <textarea class="form_in1" id="Beschr_Bestem" maxlength="511" name="Beschr_Bestem" placeholder="Beschrijving"></textarea>
        </div>
        
        <!-- gegevens -->
        
        <div class="form_box_btn_border">
        </div>
        
        <div class="form_box_btn">
            <!-- bestemming opslaan-->  
            <button class="form_btn"  id="Bestem_Opslaan" name="Bestem_Opslaan" title="Bestemming opslagen en formulier leegmaken voor de volgende bestemming." type="submit">Bestemming opslaan</button>
            <!-- bestemming annuleren --> 
            <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
        </div>
    
    
    </form>
    
    





</body>
</html>
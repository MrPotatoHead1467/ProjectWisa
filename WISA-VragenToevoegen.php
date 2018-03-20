<?php
if (isset($_SESSION['Nieuwe_vraag'])) 
    {}
else 
    {
        $_SESSION['Nieuwe_vraag'] = "";
    }
if (isset($_SESSION['Kernwoord_vraag'])) 
    {}
else 
    {
        $_SESSION['Kernwoord_vraag'] = "";
    }
if (isset($_SESSION['Max_antwoord']))
    {}
else
    {
        $_SESSION['Max_antwoord'] = "1";
    }
    
$_SESSION['Formulier'] = "nieuwevraag"
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Beheer vragen</title>

</head>

<body>
    <?php
        include "WISA-Connection.php";
    ?>
    <!-- Formulier om vragen toe te voegen -->
    <form action="WISA-VraagToevoegen_Check.php" method="post">
    
        <!-- Nieuwe vraag toevoegen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Nieuwe_vraag">Nieuwe vraag:</label><br />
            <textarea autofocus="autofocus" class="form_in1" id="Nieuwe_vraag" name="Nieuwe_vraag" placeholder="Maximum 512 karakters." required="True" class="Nieuwe_vraag"><?php echo $_SESSION['Nieuwe_vraag']?></textarea>
        </div>
        
        <!-- Kernwoord toevoegen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Kernwoord_vraag" title="Dankzij het kernwoord zult u gemakkelijker vragen kunnen opzoeken.">Kernwoord vraag:</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Kernwoord_vraag" name="Kernwoord_vraag" placeholder="Zoekwoord voor vraag." title="Dankzij het kernwoord zult u gemakkelijker vragen kunnen opzoeken."  type="text"<?php echo "value='".$_SESSION['Kernwoord_vraag']."'"?>/>
            </div>
        </div>
        
        <!-- Soort antwoord selecteren, na toevoeging mogelijk antwoord 'Lijst' optie 1 anders 'Lijst' is laaste,
             indien 'Lijst' geselecteerd -> knoppen 'bestaande lijst' en 'gepersonaliseerde lijst' zichtbaar -->        
        <div class="form_box_1">
            <label class="form_lbl" for="Soort_antwoord">Soort antwoord:</label><br />
            <select class="form_slt" id="Soort_antwoord" onchange="lijst()" name="Soort_antwoord">
                <?php if ($_SESSION['Nieuwe_vraag'] != ''){
                    echo '<option value="fld_antwoord_type_lijst">Lijst</option>';}?>
                <option value="fld_antwoord_type_k_tekst">Korte tekst</option>
                <option value="fld_antwoord_type_l_tekst">Lange tekst</option>
                <option value="fld_antwoord_type_num">Numeriek</option>
                <option value="fld_antwoord_type_datum">Datum</option>
                <option value="fld_antwoord_type_j/n">Ja/Nee</option>
                <option value="fld_antwoord_type_foto">Foto</option>
                <?php if ($_SESSION['Nieuwe_vraag'] == ''){
                    echo '<option value="fld_antwoord_type_lijst">Lijst</option>';}?>
            </select>
        </div>
        
        <!-- Knoppen 'Bestaande lijst' en 'Gepersonaliseerde lijst' -->
        <div class="form_box_1">
            <div id="Lijst" class="Lijst">
                <button class="form_btn1" id="Lijst_Button" name="Lijst_Button" onclick="bestaandelijst()" type="button">Bestaande lijst</button>
                <label class="form_newvraag_of"> of </label>
                <button class="form_btn1" id="Lijst_Button" name="Button_Lijst" onclick="gepersonaliseerdelijst()" type="button" >Gepersonaliseerde lijst</button>
            </div>
        </div>
        
        <!-- Gepersonaliseerde lijst -->
        <div class="form_box_1">
            <div id="GepersonaliseerdeLijst" class="GepersonaliseerdeLijst">
                <!-- Mogelijk antwoord toevoegen -->
                <label class="form_lbl" for="Mogelijk_antwoord">Geef een mogelijk antwoord in:</label><br />
                <!-- Tekstvak en knop om mogelijke antwoorden toe te voegen -->
                <div class="form_box_in">
                    <button class='form_pls' type="submit" id="Mogelijk_antwoord_toevoegen" name="Mogelijk_antwoord_toevoegen">+</button>
                    <input class="form_in" type="text" id="Mogelijk_antwoord" name="Mogelijk_antwoord"/>
                </div>
            </div>
            
            
            <div id="Mogelijke_antwoorden" class="Mogelijke_antwoorden">
                <!-- Mogelijke antwoorden tonen met verwijden en aanpas knop -->
                <?php
                    if (isset($_SESSION['Mogelijke_antwoorden']))
                        {
                            foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord)
                                {
                                    echo "<div class='form_box_in'>";
                                        /** Verwijderknop */
                                        echo "<button class='form_mn' type='submit' id='".$Mogelijk_antwoord." 'name='".$Mogelijk_antwoord."'>x</button>";
                                        /** Mogelijk antwoord tonen in tekstvak */
                                        echo "<input class='form_in2' type='text' id='Mogelijke_antwoorden' name='Mogelijke_antwoorden[]' value='".$Mogelijk_antwoord."'/><br />";
                                    echo '</div>';
                                    /** Aanpasknop 
                                    echo "<button  type='submit' id='".$x."' name='".$x."'>Wijziging opslaan</button>";*/
                                }   
                        }
                ?>
            </div>
        </div>
        
        
        <!-- Bestaande lijst selecteren -->
        <div class="form_box_1">
            <div id="BestaandeLijst" class="BestaandeLijst">
                <label class="form_lbl" for="Bestaande_lijst">Kies een bestaande lijst:</label><br />
                <select class="form_slt" id="Bestaande_lijst" name="Bestaande_lijst">
                    <option value="..." id="Geen_Bestaande_Lijst">...</option>
                    <?php
                        $sql = "SELECT * FROM tbl_bestaande_lijsten";
                        $result = $conn->query($sql);
                        /** Bestaande lijsten worden uit databank gehaald en in een lijst gezet */
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<option value='".$row['fld_bestaande_lijst_id']."'>".$row['fld_bestaande_lijst_naam']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
      
      
      
        <div class="form_box_1">
            <!-- Maximaal aantal antwoorden -->
            <div id="Max_aantal_antwoorden" class="Max_antwoord">
                <label class="form_lbl" for="Max_antwoord">Maximaal aantal antwoorden:</label><br />
                <div class="form_box_in ">
                    <input class="form_in" type="text" id="Max_antwoord" name="Max_antwoord" <?php echo "value='".$_SESSION['Max_antwoord']."'"?> /><br />
                </div>
            </div>
        </div>
        
        <!-- Bestemmingen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Bestemming" class="Vragen_Toevoegen_Label">Bestemming antwoord:</label>
            <div class="form_newvraag_lstb" id="Bestemming">
                <?php
                    $sql = "SELECT * FROM tbl_bestemmingen";
                    $result = $conn->query($sql);
                    /** Bestemmingen worden uit de databank gehaald en met checkbox getoond */
                    if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc())
                                {
                                        echo "<input type='checkbox' id='".$row['fld_bestemming_id']."' name='Bestemming[]' value='".$row['fld_bestemming_id']."'/>";
                                        echo "<label class='form_lbl' for='".$row['fld_bestemming_id']."'> ".$row['fld_bestemming_naam']."</label><br />";
                                }
                        }
                ?>
            </div>
        </div>
        
        <!-- Verplicht J/N -->
        <div class="form_box_1">
            <input name="Verplicht" id="Verplicht" type="checkbox" />
            <label class="form_lbl" for="Verplicht">Antwoord verplicht</label>
        </div>
      
      
        <div class="form_box_1">
            <!-- Knop om de vraag op te slaan -->
            <button class="form_btn" type="submit" name="Vraag_opslaan" id="Vraag_opslaan">Vraag opslaan</button>
            <!-- Knop om te annuleren, alle -->
            <button class="form_ccl" type="submit" name="Vraag_annuleren" id="Vraag_annuleren">Annuleren</button>
        </div>
    
    </form>
    
    <script type="text/javascript">
    <!--
        function bestaandelijst() 
            {
                document.getElementById('BestaandeLijst').style.display = 'block';
                document.getElementById('GepersonaliseerdeLijst').style.display = 'none';
                document.getElementById('Max_aantal_antwoorden').style.display = 'block';
                document.getElementById('Mogelijke_antwoorden').style.display = 'none';
            }
        function gepersonaliseerdelijst()
            {
                document.getElementById('BestaandeLijst').style.display = 'none';
                document.getElementById('GepersonaliseerdeLijst').style.display = 'block';
                document.getElementById('Max_aantal_antwoorden').style.display = 'block';
                document.getElementById('Mogelijke_antwoorden').style.display = 'block';
                document.getElementById('Lijst').style.display = 'block';
                document.getElementById('Bestaande_lijst').selectedIndex = 'Geen_Bestaande_Lijst';
            }
        function lijst()
            {
                var soort_antwoord = document.getElementById("Soort_antwoord");
                var selectedValue = soort_antwoord.options[soort_antwoord.selectedIndex].value;
                if (soort_antwoord.value == "fld_antwoord_type_lijst")
                    {
                        document.getElementById('Lijst').style.display = 'block';
                    }
                else 
                    {
                        document.getElementById('Lijst').style.display = 'none';
                        document.getElementById('BestaandeLijst').style.display = 'none';
                        document.getElementById('GepersonaliseerdeLijst').style.display = 'none';
                        document.getElementById('Max_aantal_antwoorden').style.display = 'none';
                        document.getElementById('Mogelijke_antwoorden').style.display = 'none';
                    }
            }   
    -->
    </script>
    
    <?php
        if ($_SESSION['Nieuwe_vraag'] != "")
            {
                echo '<script type="text/javascript">gepersonaliseerdelijst();</script>';
            }
    ?>
</body>
</html>
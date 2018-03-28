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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Beheer vragen</title>

</head>

<body>
    <?php
        include "WISA-Connection.php";
    ?>
    
    <!-- Bestaand persoon opzoeken -->
    <form action="WISA-BeheerVragen_Check.php" method="post">
        <div class="form_box_zoek">
            <label class="form_lbl" for="Vraag_Zoeken_in">Vraag zoeken</label><br />
            <button class="form_edit" id="Vraag_Zoeken_btn" name="Vraag_Zoeken_btn" type="submit">Gegevens invullen</button>
            <div class="form_zoek">
                <input class="form_in" id="Vraag_Zoeken_in" list="Vraag_Zoeken_List" name="Vraag_Zoeken_in" placeholder="..." />
                <label class="form_editi" for="Vraag_Zoeken_btn" onclick="KlikKnop('Vraag_Zoeken_btn')" title="Bestaande vraag opzoeken."></label>
            </div>
            <datalist class="form_slt" id="Vraag_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_vragen";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_vraag_id']."' value='".$row['fld_vraag_vraag']." (".$row['fld_vraag_kernwoord'].") '>";
                        }
                    }
                ?>
            </datalist>
            <input id="Vraag_Zoeken" name="Vraag_Zoeken" type="hidden"/>
        </div>
    </form>
    
    <div class="form_box_zoek_border">
    </div>
    
    
    
    
    <!-- Formulier om vragen toe te voegen -->
    <form action="WISA-BeheerVragen_Check.php" method="post">
    
        <!-- Nieuwe vraag toevoegen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Nieuwe_vraag">Nieuwe vraag:</label><br />
            <textarea autofocus="autofocus" class="form_in1" id="Nieuwe_vraag" name="Nieuwe_vraag" maxlength="511" title="Geef een vraag in van maximum 511 karakters lang." required="True"><?php echo $_SESSION['Nieuwe_vraag']?></textarea>
        </div>
        
        <!-- Kernwoord toevoegen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Kernwoord_vraag" title="Dankzij het kernwoord zult u gemakkelijker vragen kunnen opzoeken.">Kernwoord vraag:</label><br />
            <div class="form_box_in ">
                <input class="form_in" id="Kernwoord_vraag" maxlength="255" name="Kernwoord_vraag" title="Dankzij het kernwoord zult u gemakkelijker vragen kunnen opzoeken. (Het kernwoord mag maximum 255 karakters bevatten.) "  type="text"<?php echo "value='".$_SESSION['Kernwoord_vraag']."'"?>/>
            </div>
        </div>
        
        <!-- Soort antwoord selecteren, na toevoeging mogelijk antwoord 'Lijst' optie 1 anders 'Lijst' is laaste,
             indien 'Lijst' geselecteerd -> knoppen 'bestaande lijst' en 'gepersonaliseerde lijst' zichtbaar -->        
        <div class="form_box_1">
            <label class="form_lbl" for="Soort_antwoord">Soort antwoord:</label><br />
            <select class="form_slt" id="Soort_antwoord" onchange="lijst()" name="Soort_antwoord">
                <?php if ($_SESSION['Nieuwe_vraag'] != '')
                    {
                        echo '<option value="fld_antwoord_type_lijst">Lijst</option>';
                    }
                ?>
                <option value="fld_antwoord_type_k_tekst">Korte tekst</option>
                <option value="fld_antwoord_type_l_tekst">Lange tekst</option>
                <option value="fld_antwoord_type_num">Numeriek</option>
                <option value="fld_antwoord_type_datum">Datum</option>
                <option value="fld_antwoord_type_j/n">Ja/Nee</option>
                <option value="fld_antwoord_type_foto">Foto</option>
                <?php if ($_SESSION['Nieuwe_vraag'] == '')
                    {
                        echo '<option value="fld_antwoord_type_lijst">Lijst</option>';
                    }
                ?>
            </select>
        </div>
        
        <!-- Knoppen 'Bestaande lijst' en 'Gepersonaliseerde lijst' -->
        <div class="form_box_1">
            <div id="Lijst" class="Lijst">
                <button class="form_btn1" id="Lijst_Button" name="Lijst_Button" onclick="bestaandelijst()" title="Kies uit de lijst met bestaande lijsten."type="button">Bestaande lijst</button>
                <label class="form_newvraag_of" title="Kies uit &eacute;&eacute;n van beide opties."> of </label>
                <button class="form_btn1" id="Lijst_Button" name="Button_Lijst" onclick="gepersonaliseerdelijst()" title="Maak zelf een lijst met mogelijke antwoorden aan." type="button" >Gepersonaliseerde lijst</button>
            </div>
        </div>
        
        <!-- Gepersonaliseerde lijst -->
        <div class="form_box_1">
            <div id="GepersonaliseerdeLijst" class="GepersonaliseerdeLijst">
                <!-- Mogelijk antwoord toevoegen -->
                <label class="form_lbl" for="Mogelijk_antwoord" title="Geef een mogelijk antwoord in en druk op de knop.">Geef een mogelijk antwoord in:</label><br />
                <!-- Tekstvak en knop om mogelijke antwoorden toe te voegen -->
                <div class="form_box_in">
                    <button class='form_pls' type="submit" id="Mogelijk_antwoord_toevoegen" name="Mogelijk_antwoord_toevoegen" title="Druk op de knop om het mogelijke antwoord toe te voegen.">+</button>
                    <input class="form_in" type="text" id="Mogelijk_antwoord" name="Mogelijk_antwoord" title="Geef een mogelijk antwoord in en druk op de knop."/>
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
                                        echo "<button class='form_mn' type='submit' id='".$Mogelijk_antwoord."' name='".$Mogelijk_antwoord."' title='Druk op de knop om het mogelijke antwoord te verwijderen.'>x</button>";
                                        /** Mogelijk antwoord tonen in tekstvak */
                                        echo "<label class='form_lbl' type='text' id='Mogelijke_antwoorden' name='Mogelijke_antwoorden[]' title='Het mogelijke antwoord is: ".$Mogelijk_antwoord.".'>".$Mogelijk_antwoord."</label><br/>";
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
                <label class="form_lbl" for="Max_antwoord" title="Geef het maximaal aantal toegelaten antwoorden in (maximum 999).">Maximaal aantal antwoorden:</label><br />
                <div class="form_box_in ">
                    <input class="form_in" type="text" id="Max_antwoord" name="Max_antwoord" pattern=".{1,3}" title="Geef het maximaal aantal toegelaten antwoorden in (maximum 999)." <?php echo "value='".$_SESSION['Max_antwoord']."'"?> /><br />
                </div>
            </div>
        </div>
        
        <!-- Bestemmingen -->
        <div class="form_box_1">
            <label class="form_lbl" for="Bestemming" title="Meerdere bestemmingen mogelijk. (Minstens 1 verplicht!)">Bestemming antwoord:</label>
            <div class="form_newvraag_lstb" id="Bestemming">
                <?php
                    $sql = "SELECT * FROM tbl_bestemmingen";
                    $result = $conn->query($sql);
                    /** Bestemmingen worden uit de databank gehaald en met checkbox getoond */
                    if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc())
                                {
                                        echo "<input type='checkbox' id='".$row['fld_bestemming_id']."' name='Bestemming[]' title='Het antwoord op deze vraag zal naar de databank van ".$row['fld_bestemming_naam']." verstuurd worden.' value='".$row['fld_bestemming_id']."'/>";
                                        echo "<label class='form_lbl' for='".$row['fld_bestemming_id']."' title='Het antwoord op deze vraag zal naar de databank van ".$row['fld_bestemming_naam']." verstuurd worden.'> ".$row['fld_bestemming_naam']."</label><br />";
                                }
                        }
                ?>
            </div>
        </div>
        
        <!-- Verplicht J/N -->
        <div class="form_box_1">
            <input id="Verplicht" name="Verplicht" title="Aanvinken indien de vraag verplicht beantwoord moet worden." type="checkbox" />
            <label class="form_lbl" for="Verplicht" title="Aanvinken indien de vraag verplicht beantwoord moet worden.">Antwoord verplicht</label>
        </div>
      
        
        <div class="form_box_btn_border">
        </div>
        
        <div class="form_box_btn">
            <!-- Knop om de vraag op te slaan -->
            <button class="form_btn" id="Vraag_opslaan" name="Vraag_opslaan" title="Vraag opslagen en formulier leegmaken voor de volgende vraag." type="submit">Vraag opslaan</button>
            <!-- Knop om te annuleren, alle -->
            <button class="form_ccl" id="Vraag_annuleren" name="Vraag_annuleren" title="Vraag niet opslagen en formulier leegmaken." type="submit">Annuleren</button>
        </div>
    
    </form>
    
    <script type="text/javascript">
    
        
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
        $(function() 
            {
                $('#Vraag_Zoeken_in').on('input',function() 
                    {
                        var opt = $('option[value="'+$(this).val()+'"]');
                        document.getElementById("Vraag_Zoeken").value = opt.attr('id');
                    });
            });  
    
    </script>
    
    <?php
        if ($_SESSION['Nieuwe_vraag'] != "")
            {
                echo '<script type="text/javascript">gepersonaliseerdelijst();</script>';
            }
    ?>
</body>
</html>
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
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>Vragen toevoegen</title>

</head>

<body>
<?php
    include "WISA-Connection.php";
?>
<!-- Formulier om vragen toe te voegen -->
<form action="WISA-VraagToevoegen_Check.php" method="post" style="display: inline;">
<table class="Vragen_Toevoegen_Table">
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Nieuwe vraag toevoegen -->
        <label for="Nieuwe_vraag">Nieuwe vraag:</label><br />
        <input id="Nieuwe_vraag" type="text" name="Nieuwe_vraag" <?php echo "value='".$_SESSION['Nieuwe_vraag']."'"?> required="True" class="Nieuwe_vraag"/>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Kernwoord toevoegen -->
        <label for="Kernwoord_vraag">Kernwoord vraag:</label><br />
        <input id="Kernwoord_vraag" type="text" name="Kernwoord_vraag" <?php echo "value='".$_SESSION['Kernwoord_vraag']."'"?>/>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Soort antwoord selecteren, na toevoeging mogelijk antwoord 'Lijst' optie 1 anders 'Lijst' is laaste,
         indien 'Lijst' geselecteerd -> knoppen 'bestaande lijst' en 'gepersonaliseerde lijst' zichtbaar -->
        <label for="Soort_antwoord">Soort antwoord:</label><br />
        <select id="Soort_antwoord" onchange="lijst()" name="Soort_antwoord">
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
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Knoppen 'Bestaande lijst' en 'Gepersonaliseerde lijst' -->
        <div id="Lijst" class="Lijst">
            <button type="button" onclick="bestaandelijst()" id="Lijst_Button" name="Lijst_Button">Bestaande lijst</button>
            <label class="Of">of</label>
            <button type="button" onclick="gepersonaliseerdelijst()" id="Lijst_Button" name="Button_Lijst">Gepersonaliseerde lijst</button>
        </div>
    </td>
  </tr>

  <tr>
    <!-- Gepersonaliseerde lijst -->
    <td class="Vragen_Toevoegen_Td">
        <div id="GepersonaliseerdeLijst" class="GepersonaliseerdeLijst">
            <!-- Mogelijk antwoord toevoegen -->
            <label for="Mogelijk_antwoord">Geef een mogelijk antwoord in:</label><br />
            <!-- Tekstvak en knop om mogelijke antwoorden toe te voegen -->
            <input type="text" id="Mogelijk_antwoord" name="Mogelijk_antwoord"/>
            <button type="submit" id="Mogelijk_antwoord_toevoegen" name="Mogelijk_antwoord_toevoegen">+</button>
        </div>
    </td>
    <td class="Vragen_Toevoegen_Td">
        <div id="Mogelijke_antwoorden" class="Mogelijke_antwoorden">
            <!-- Mogelijke antwoorden tonen met verwijden en aanpas knop -->
            <?php
                $i = 0;
                #$x = -1;
                if (isset($_SESSION['Mogelijke_antwoorden'])){
                    foreach ($_SESSION['Mogelijke_antwoorden'] as $Mogelijk_antwoord){
                        /** Mogelijk antwoord tonen in tekstvak */
                        echo "<input type='text' id='Mogelijke_antwoorden' name='Mogelijke_antwoorden[]' value='".$Mogelijk_antwoord."'/>";
                        /** Aanpasknop 
                        echo "<button type='submit' id='".$x."' name='".$x."'>Wijziging opslaan</button>";*/
                        /** Verwijderknop */
                        echo "<button type='submit' id='".$Mogelijk_antwoord." 'name='".$Mogelijk_antwoord."'>X</button><br />";
                        ++$i;
                        #--$x;
                    }
                }
            ?>
        </div>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Bestaande lijst selecteren -->
        <div id="BestaandeLijst" class="BestaandeLijst">
            <label for="Bestaande_lijst">Kies een bestaande lijst:</label><br />
            <select id="Bestaande_lijst" name="Bestaande_lijst">
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
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Maximaal aantal antwoorden -->
        <div id="Max_aantal_antwoorden" class="Max_antwoord">
            <label for="Max_antwoord">Maximaal aantal antwoorden:</label><br />
            <input type="text" id="Max_antwoord" name="Max_antwoord" <?php echo "value='".$_SESSION['Max_antwoord']."'"?> /><br />
        </div>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Bestemmingen -->
        <label for="Bestemming" class="Vragen_Toevoegen_Label">Bestemming antwoord:</label>
        <div id="Bestemming">
            <?php
                $sql = "SELECT * FROM tbl_bestemmingen";
                $result = $conn->query($sql);
                /** Bestemmingen worden uit de databank gehaald en met checkbox getoond */
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<input type='checkbox' id='".$row['fld_bestemming_id']."' name='Bestemming[]' value='".$row['fld_bestemming_id']."'/>";
                        echo "<label for='".$row['fld_bestemming_id']."'>".$row['fld_bestemming_naam']."</label><br />";
                    }
                }
            ?>
        </div>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Verplicht J/N -->
        <input type="checkbox" name="Verplicht" id="Verplicht"/>
        <label for="Verplicht">Antwoord verplicht</label>
    </td>
  </tr>
  
  <tr>
    <td class="Vragen_Toevoegen_Td">
        <!-- Knop om de vraag op te slaan -->
       <button type="submit" name="Vraag_opslaan" id="Vraag_opslaan">Vraag opslaan</button> 
    </td>
  </tr>
  
  <tr>
    <td>
        <!-- Knop om te annuleren, alle -->
        <button type="submit" name="Vraag_annuleren" id="Vraag_annuleren">Annuleren</button>
    </td>
  </tr>
</table>
</form>

<script type="text/javascript">
<!--
    function bestaandelijst() {
        document.getElementById('BestaandeLijst').style.display = 'block';
        document.getElementById('GepersonaliseerdeLijst').style.display = 'none';
        document.getElementById('Max_aantal_antwoorden').style.display = 'block';
        document.getElementById('Mogelijke_antwoorden').style.display = 'none';
    }
    function gepersonaliseerdelijst() {
        document.getElementById('BestaandeLijst').style.display = 'none';
        document.getElementById('GepersonaliseerdeLijst').style.display = 'block';
        document.getElementById('Max_aantal_antwoorden').style.display = 'block';
        document.getElementById('Mogelijke_antwoorden').style.display = 'block';
        document.getElementById('Lijst').style.display = 'block';
    }
    function lijst() {
        var soort_antwoord = document.getElementById("Soort_antwoord");
        var selectedValue = soort_antwoord.options[soort_antwoord.selectedIndex].value;
        if (soort_antwoord.value == "fld_antwoord_type_lijst") {
            document.getElementById('Lijst').style.display = 'block';
        }
        else {
            document.getElementById('Lijst').style.display = 'none';
            document.getElementById('BestaandeLijst').style.display = 'none';
            document.getElementById('GepersonaliseerdeLijst').style.display = 'none';
            document.getElementById('Max_aantal_antwoorden').style.display = 'none';
        }
    }
-->
</script>

<?php
    if ($_SESSION['Nieuwe_vraag'] != "") {
        echo '<script type="text/javascript">gepersonaliseerdelijst();</script>';
    }
?>
</body>
</html>
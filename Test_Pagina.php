<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    
	<title>Test_Pagina</title>
    
</head>

<body>
<?php include "WISA-Connection.php";?>


<table class="Vragen_Toevoegen_Table">
<tr>
    <!-- Gepersonaliseerde lijst -->
    <td class="Vragen_Toevoegen_Td">
        <div id="GepersonaliseerdeLijst" class="GepersonaliseerdeLijst">
            <!-- Mogelijk antwoord toevoegen -->
            <label for="Mogelijk_antwoord">Geef een mogelijk antwoord in:</label>
        </div>
    </td>
    <td class="Vragen_Toevoegen_Td">
        <div id="GepersonaliseerdeLijstAntwoord" class="GepersonaliseerdeLijst">
        <!-- Tekstvak en knop om mogelijke antwoorden toe te voegen -->
        <input type="text" id="Mogelijk_antwoord" name="Mogelijk_antwoord"/>
        <button type="submit" id="Mogelijk_antwoord_toevoegen" name="Mogelijk_antwoord_toevoegen">+</button>
        </div>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
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
</table>
<script type="text/javascript">
<!--
    function gepersonaliseerdelijst() {
        document.getElementById('GepersonaliseerdeLijst').style.display = 'block'
        document.getElementById('GepersonaliseerdeLijstAntwoord').style.display = 'block'
    }
	gepersonaliseerdelijst()
-->
</script>
</body>
</html>
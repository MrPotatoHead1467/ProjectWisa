<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Relaties formulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
?>

<form action="WISA-RelatiesFormulier_Check.php" method="post">
    
    <!-- bestanden toevoegen -->
    <div class="form_box_1">
        <input class="form_bsd" id="Bestand_relatie" name="Bestand_relatie[]" multiple type="file"/>
        <label class="form_bsdi" onclick="KlikKnop('Bestand_relatie')" title="Document selecteren."></label>
    </div>
    
    <!-- keuze leerling -->
    <div class="form_box_1">
        <label class='form_lbl' for="Leerling">Leerling</label><br />
        <?php 
            /** Als er een leerling is meegenomen uit persoonsformulier wordt zijn naam automatisch getoond */
            if (isset($_SESSION['Leerling'])){
                echo '<label for="Persoon_1">Naam leerling</label><br />';
                $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$_SESSION['Leerling'];
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<p id='Persoon_1'>".$row['fld_persoon_naam']."</p>";
                    }
                }
            }
            /** Als er geen leerling is meegenomen wordt er een zoekvak met keuzelijst tevoorschijn */
            
            
        ?>
    </div>
        
    <!-- Persoon 2 -->
    <div  class="form_box_1">
        <label class='form_lbl' for="Persoon2">Tweede persoon</label><br />
    </div>
    
    <div  class="form_box_1">
        <!-- Keuzelijst relatie -->
        <label class='form_lbl' for="Relatie">Relatie</label><br />
        <select class="form_slt" id="Relatie" name="Relatie">
            <option value="Kies">...</option>
            <?php
                $sql = "SELECT * FROM tbl_soorten";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['fld_soort_id']."'>".$row['fld_soort_naam']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    
    <div class="form_box_1">
        <!-- Veld om beschrijving aan de relatie toe te voegen -->
        <label class="form_lbl" for="Relatie_beschrijving">Beschrijving</label><br/>
        <textarea class="form_in1" id="Relatie_beschrijving" maxlength="511" name="Relatie_beschrijving" title="Voeg een beschrijving van de relatie tussen deze twee personen. Mag persoon 2 gecontacteerd worden? Zo ja, wanneer?"></textarea>
    </div>
    
    <div>
            <?php
                if (isset($_SESSION['Personen_Relaties']))
                    {
                    $i = 0;
                    foreach($_SESSION['Personen_Relaties'] as $x => $value) 
                        {
                        $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$x."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $x = $row['fld_persoon_naam'];
                            }
                        }
                        
                        $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$value."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $x_value = $row['fld_soort_naam'];
                            }
                        }
                        
                        $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$_SESSION['Leerling'];
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $Leerling = $row['fld_persoon_naam'];
                            }
                        }
                        echo "<div class='form_box_in'>";
                            /** Verwijderknop */
                            echo "<button class='form_mn' id='".$i."' name='".$i."' title='Relatie verwijderen.' type='submit' >x</button>";
                            /** Al toegevoegde relaties*/
                            echo "<label class='form_lbl' for='".$i."' title='Bestaande relatie: ".$x.", ".$x_value." van ".$Leerling.".' type='text'>".$x.", ".$x_value." van ".$Leerling."</label><br/>";
                        echo '</div>';
                        ++$i;
                        }
                    }
            ?>
        </div>
    
    <div>
        <!-- Relatie opslaan knop -->
        <button class="form_btn" type="submit" id="Relatie_opslaan" name="Relatie_opslaan">Relatie opslaan</button>
        <!-- Volgende knop -->
        <button class="form_ccl" type="submit" id="Volgende" name="Volgende" title="Volgende formulier: Contactgegevens.">Volgende</button>
    </div>
</form>

    <script>
        function KlikKnop(knop)
        {
            document.getElementById(knop).click();
        }
    
    </script>

</body>
</html>
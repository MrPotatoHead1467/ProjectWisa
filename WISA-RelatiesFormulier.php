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
    <div>
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
            else {
                echo "<label for='Filter_1'>Zoeken</label>";
                echo "<input type='text' id='Filter_1' name='Filter_1'/>";
                echo "<button type='submit' id='Filter_1_Zoeken' name='Filter_1_Zoeken'>Zoeken</button><br />";
                echo '<label for="Persoon_1">Naam leerling</label><br />';
                echo "<select id='Persoon_1' name='Persoon_1'>";
                echo "<option value='Kies'>Kies een leerling</option>";
                /** Als er iets in het zoekvak is ingevuld, worden alleen de overige namen getoond. Als er niets is ingevuld,
                    worden alle namen getoond */
                if (isset($_SESSION['Filter_1'])){
                    $sql = $_SESSION['Filter_1'];
                }
                else {
                    $sql = "SELECT * FROM tbl_personen";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['fld_persoon_id']."'>".$row['fld_persoon_naam']."</option>";
                    }
                }
                echo "</select>";
            }
            
        ?>
    </div>
    
    <div>
        <!-- Zoekvak persoon 2 -->
        <label for="Filter_2">Zoeken</label><br />
        <input type="text" id="Filter_2" name="Filter_2"/>
        <button type='submit' id='Filter_2_Zoeken' name='Filter_2_Zoeken'>Zoeken</button><br />
    </div>
    
    <div>
        <!-- Persoon 2 -->
        <label for="Persoon_2">Persoon 2</label>
        <select id="Persoon_2" name="Persoon_2">
            <option value="Kies">Kies persoon 2</option>
            <?php
                /** Als er iets in het zoekvak is ingevuld, worden alleen de overige namen getoond. Als er niets is ingevuld,
                    worden alle namen getoond */
                if (isset($_SESSION['Filter_2'])){
                    $sql = $_SESSION['Filter_2'];
                }
                else {
                    $sql = "SELECT * FROM tbl_personen";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['fld_persoon_id']."'>".$row['fld_persoon_naam']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    
    <div>
        <!-- Keuzelijst relatie -->
        <label for="Relatie">Relatie</label>
        <select id="Relatie" name="Relatie">
            <option value="Kies">Kies de relatie</option>
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
    
    <div>
        <!-- Veld om beschrijving aan de relatie toe te voegen -->
        <label for="Relatie_beschrijving">Beschrijving</label>
        <textarea id="Relatie_beschrijving" name="Relatie_beschrijving"></textarea>
    </div>
    
    <div>
        <!-- Relatie opslaan knop -->
        <button type="submit" id="Relatie_opslaan" name="Relatie_opslaan">Relatie opslaan</button>
        <!-- Volgende knop -->
        <button type="submit" id="Volgende" name="Volgende">Volgende</button>
    </div>
</form>

</body>
</html>
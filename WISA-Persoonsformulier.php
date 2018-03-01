<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>WISA | Persoonsformulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
?>
<form action="WISA-Persoonsformulier_Check.php" method="post" enctype="multipart/form-data">
    <input type="checkbox" name="Leerling" id="Leerling" checked="True"/>
    <label for="Leerling">Leerling</label><br />
    
    <label for="Voornaam">Voornaam</label><br />
    <input type="text" id="Voornaam" name="Voornaam" required="True"/><br />
    <label for="Achternaam">Achternaam</label><br />
    <input type="text" id="Achternaam" name="Achternaam" required="True"/><br />
    
    <label for="Geslacht">Geslacht</label>
    <select id="Geslacht" name="Geslacht">
        <option value="Kies">Geslacht</option>
        <option value="M">Man</option>
        <option value="V">Vrouw</option>
    </select>
    
    <label for="GBDatum">Geboortedatum</label>
    <input type="date" id="GBDatum" name="GBDatum"/>
    
    <div id="Leerlingen">
        <label for="GB_Plaats">Geboorteplaats</label>
        
        <label for="Register_nr">Rijksregisternummer</label>
        <input type="text" id="Register_nr" name="Register_nr"/>
        <input type="checkbox" id="Geen_Register_nr" name="Geen_Register_nr"/>
        <label for="Geen_Register_nr">Geen rijksregisternummer</label>
        
        <label for="Nationaliteit">Nationaliteit</label>
        <select>
            <?php
                $sql = "SELECT * FROM tbl_nationaliteiten";
                $result = $conn->query($sql);
                /** Bestemmingen worden uit de databank gehaald en met checkbox getoond */
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['fld_nation_id']."'>".$row['fld_nation_nation']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    
</form>

</body>
</html>
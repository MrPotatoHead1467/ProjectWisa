<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    
	<title>Inschrijvingsformulier</title>
    
</head>

<body>
<?php
include "WISA-Connection.php";
?>
<div>
<form action="WISA-Inschrijvingsformulier_Check.php" method="post" enctype="multipart/form-data">
<table class="Inschrijvingsformulier_Table">
<?php
$sqlVragen = "SELECT * FROM tbl_vragen";
$result = $conn->query($sqlVragen);
$_SESSION['Vragen_Id'] = array();

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td class='Inschrijvingsformulier_Td' ><label for='".$row['fld_vraag_id']."'>".$row['fld_vraag_vraag']." </label></td>";
        if ($row['fld_antwoord_type_k_tekst'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td'><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td' ><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_l_tekst'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td'><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td'><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_num'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td'><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td'><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_datum'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td'><input type='date' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td'><input type='date' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_j/n'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td'><input type='checkbox' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td'><input type='checkbox' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_foto'] == 1){
            if ($row['fld_vraag_antwoord_verplicht'] == "1"){
                echo "<td class='Inschrijvingsformulier_Td' ><input type='file' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True'/>";
            }
            else {
                echo "<td class='Inschrijvingsformulier_Td'><input type='file' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
            }
            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
        }
        elseif ($row['fld_antwoord_type_lijst'] == 1){
            $sqlLijst = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_vraag_id_fk = ".$row['fld_vraag_id'];
            $resultLijst = $conn->query($sqlLijst);
            if ($resultLijst->num_rows > 0){
                echo "<td class='Inschrijvingsformulier_Td'>";
                echo "<select>";
                while ($rowLijst = $resultLijst->fetch_assoc()){
                    echo "<option>".$rowLijst['fld_lijst_item']."</option>";
                }
                echo "</select>";
                echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand[]' multiple/></td>";
            }
        }
        else {
            "Er is iets verkeerd gegaan";
            }
        echo "</tr>";
        array_push($_SESSION['Vragen_Id'],mysqli_real_escape_string($conn, $row['fld_vraag_id']));
    }
}
?>
    <tr>
        <td class='Inschrijvingsformulier_Td' >
            <button type="submit" name="Inschrijving_Opslaan">Opslaan</button>
        </td>
    </tr>
</table>
</form>
</div>
    

</body>
</html>
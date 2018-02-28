<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    
	<title>WISA | Inschrijving goedkeuren</title>
    
</head>

<body>
    <?php
    include "WISA-Connection.php";
    ?>
    <div>
        <form action="WISA-Inschrijvingsformulier_Check.php" method="post" enctype="multipart/form-data">
            <table class="Inschrijvingsformulier_Table">
            <p>Inschrijvingen goedkeuren</p>
                <?php
                $sqlVragen = "SELECT * FROM tbl_vragen";
                $result = $conn->query($sqlVragen);
                $_SESSION['Aantal_Vragen'] = 0;
                
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        $_SESSION['Aantal_Vragen']++;
                        echo "<td class='Inschrijvingsformulier_Td' ><label for='".$row['fld_vraag_id']."'>".$row['fld_vraag_vraag']." </label></td>";
                        if ($row['fld_antwoord_type_k_tekst'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_l_tekst'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_num'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_datum'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='date' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_j/n'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='checkbox' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_foto'] == 1){
                            echo "<td class='Inschrijvingsformulier_Td' ><input type='text' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."'/>";
                            echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                        }
                        elseif ($row['fld_antwoord_type_lijst'] == 1){
                            $sqlLijst = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_vraag_id_fk = ".$row['fld_vraag_id'];
                            $resultLijst = $conn->query($sqlLijst);
                            if ($resultLijst->num_rows > 0){
                                echo "<td class='Inschrijvingsformulier_Td' >";
                                echo "<select>";
                                while ($rowLijst = $resultLijst->fetch_assoc()){
                                    echo "<option>".$rowLijst['fld_lijst_item']."</option>";
                                }
                                echo "</select>";
                                echo "<input type='file' id='".$row['fld_vraag_id']."_Bestand' name='".$row['fld_vraag_id']."_Bestand'/></td>";
                            }
                        }
                        else {
                            "Er is iets verkeerd gegaan";
                            }
                        echo "</tr>";
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
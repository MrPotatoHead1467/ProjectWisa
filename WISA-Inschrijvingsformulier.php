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
    
    
    
    <form action="WISA-Inschrijvingsformulier_Check.php" method="post" enctype="multipart/form-data">
    
        <?php
        $sqlVragen = "SELECT * FROM tbl_vragen";
        $result = $conn->query($sqlVragen);
        $_SESSION['Vragen_Id'] = array();
        
        if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                    {
                        echo "<div class='form_box_1'>";
                            if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                {
                                    echo "<label class='form_lbl' for='".$row['fld_vraag_id']."' title='Verplicht in te vullen vraag.'>".$row['fld_vraag_vraag']." *</label><br/>";
                                }
                            elseif ($row['fld_vraag_antwoord_verplicht'] == "0")
                                {
                                    echo "<label class='form_lbl' for='".$row['fld_vraag_id']."' title='Vraag mag onbeantwoord blijven.'>".$row['fld_vraag_vraag']."</label><br/>";
                                }
                            
                            // korte tekst vraag
                            if ($row['fld_antwoord_type_k_tekst'] == 1)
                                {
                                    // extra bestand voor korte tekst    
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]'  type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // input korte tekst
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' maxlength='255' name='".$row['fld_vraag_id']."' required='True' type='text'/>";
                                        
                                            }
                                        else 
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' maxlength='255' name='".$row['fld_vraag_id']."' type='text'/>";
                                            }
                                    echo "</div>";
                                }
                            // lange tekst vraag
                            elseif ($row['fld_antwoord_type_l_tekst'] == 1)
                                {
                                    // extra bestand voor lange tekst
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]' type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // input lange tekst
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<textarea  class='form_in1' id='".$row['fld_vraag_id']."' maxlength='511' name='".$row['fld_vraag_id']."' required='True'></textarea>";
                                            }
                                        else 
                                            {
                                                echo "<textarea  class='form_in1' id='".$row['fld_vraag_id']."' maxlength='511' name='".$row['fld_vraag_id']."'></textarea>";
                                            }
                                    echo "</div>";
                                    }
                            // num vraag
                            elseif ($row['fld_antwoord_type_num'] == 1)
                                {
                                    // extra bestand voor num
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]' type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // input num
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True' type='text'/>";
                                        
                                            }
                                        else 
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='text'/>";
                                            }
                                    echo "</div>";
                                    }
                            // datum vraag
                            elseif ($row['fld_antwoord_type_datum'] == 1)
                                {
                                    //extra bestand voor datum
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]' type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // invoervak datum
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True' type='date'/>";
                                            }
                                        else 
                                            {
                                                echo "<input class='form_in' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='date'/>";
                                            }
                                    echo "</div>";
                                }
                            // j/n vraag
                            elseif ($row['fld_antwoord_type_j/n'] == 1)
                                {
                                    // extra bestand voor j/n
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]' type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // invoervak voor j/n
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True' type='checkbox'/>";
                                            }
                                        else 
                                            {
                                                echo "<input id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='checkbox'/>";
                                            }
                                    echo "</div>";
                                    }
                            // foto vraag
                            elseif ($row['fld_antwoord_type_foto'] == 1)
                                {
                                    // knop foto
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input class='form_picp' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='file' required='True'/>";
                                                echo "<label class='form_picpi' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Pasfoto van de leerling selecteren.'></label>";
                                            }
                                        else 
                                            {
                                                echo "<input class='form_picp' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='file'/>";
                                                echo "<label class='form_picpi' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Pasfoto van de leerling selecteren.'></label>";
                                            }
                                    echo "</div>";
                                }
                            /**
                            // doc vraag 
                            elseif ($row['fld_antwoord_type_doc'] == 1)
                                {
                                    // knop doc
                                    echo "<div class='form_box_in'>";
                                        if ($row['fld_vraag_antwoord_verplicht'] == "1")
                                            {
                                                echo "<input class='form_bsd' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' required='True' type='file'/>";
                                                echo "<label class='form_bsdi1' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren.'></label>";
                                            }
                                        else 
                                            {
                                                echo "<input class='form_bsd' id='".$row['fld_vraag_id']."' name='".$row['fld_vraag_id']."' type='file'/>";
                                                echo "<label class='form_bsdi1' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren.'></label>";
                                            }
                                    echo "</div>";
                                }  
                            * 
                             */ 
                            // lijst vraag
                            elseif ($row['fld_antwoord_type_lijst'] == 1)
                                {   
                                    // extra bestand voor lijst
                                    echo "<input class='form_bsd' id='".$row['fld_vraag_id']."_Bestand' multiple name='".$row['fld_vraag_id']."_Bestand[]' type='file'/>";
                                    echo "<label class='form_bsdi2' onclick='KlikKnop("; echo '"'.$row['fld_vraag_id'].'"'; echo ")' title='Document selecteren voor: "; echo '"'.$row['fld_vraag_vraag'].'"'; echo "'></label>";
                                    // lijst
                                    $sqlLijst = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_vraag_id_fk = ".$row['fld_vraag_id'];
                                    $resultLijst = $conn->query($sqlLijst);
                                    if ($resultLijst->num_rows > 0)
                                        {
                                            echo "<select class='form_slt'>";
                                            while ($rowLijst = $resultLijst->fetch_assoc())
                                                {
                                                    echo "<option>".$rowLijst['fld_lijst_item']."</option>";
                                                }
                                            echo "</select>";
                                            
                                        }
                                    
                                }
                            else 
                                {
                                    echo "Er is iets verkeerd gegaan...";
                                }
                        echo "</div>";
                        array_push($_SESSION['Vragen_Id'],mysqli_real_escape_string($conn, $row['fld_vraag_id']));
                    }
            }
        ?>
        <div>
            <!-- inschrijving voltooien -->
            <button type="submit" name="Inschrijving_Opslaan">Inschrijving voltooien</button>
            <!-- Knop om te annuleren --> 
            <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
        </div>
    </form>
    
    <script type="text/javascript">
    
        function KlikKnop(knop)
            {
                document.getElementById(knop).click();
            }
    </script>
    

</body>
</html>
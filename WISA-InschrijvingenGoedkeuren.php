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
                    $sqlGoedkeuren = "SELECT * FROM ((tbl_inschrijvingen INNER JOIN tbl_personen ON tbl_inschrijvingen.fld_persoon_id_fk = tbl_personen.fld_persoon_id) INNER JOIN tbl_antwoorden ON tbl_inschrijvingen.fld_persoon_id_fk = tbl_antwoorden.fld_persoon_id_fk) WHERE tbl_inschrijvingen.fld_inschrijving_status_id_fk = 1 OR tbl_inschrijvingen.fld_inschrijving_status_id_fk = 4 ORDER BY tbl_inschrijvingen.fld_inschrijving_status_id_fk ASC;";
                            
                    $resultGoedkeuren = mysqli_query($conn, $sqlGoedkeuren);
                    if (mysqli_num_rows($resultGoedkeuren) > 0)
                        {
                            $lastrow = "";
                            while($row = mysqli_fetch_assoc($resultGoedkeuren))
                                {
                                    if($row['fld_persoon_id'] != $lastrow){
                                        echo $row['fld_persoon_naam'].":";
                                    }
                                    echo " antwoord: ".$row['fld_antwoord_k_tekst']."<br />";
                                    $lastrow = $row['fld_persoon_id'];
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
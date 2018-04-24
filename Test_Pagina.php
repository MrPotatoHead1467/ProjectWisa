<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Test formulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
?>

<!-- school -->
<div class="form_box_1">
    <label class="form_lbl" for="School">School</label><br />
    
    <div class="form_zoek">
        <input class="form_in" id="School_Zoeken_in" list="School_Zoeken_List" name="School_Zoeken_in" placeholder="..." />
    </div>
    <datalist class="form_slt" id="School_Zoeken_List" >
        <?php
            $sql = "SELECT tbl_scholen.fld_school_naam, tbl_scholen.fld_school_id, tbl_adressen_linken.fld_adres_id_fk, tbl_adressen.fld_adres_id, tbl_postcodes.fld_postnummer, tbl_postcodes.fld_woonplaats_naam
                    FROM (((tbl_scholen
                    INNER JOIN tbl_adressen_linken ON tbl_scholen.fld_school_id = tbl_adressen_linken.fld_school_id_fk)
                    INNER JOIN tbl_adressen ON tbl_adressen_linken.fld_adres_id_fk = tbl_adressen.fld_adres_id)
                    INNER JOIN tbl_postcodes ON tbl_adressen.fld_adres_postcode_id_fk = tbl_postcodes.fld_postcode_id);";
                    
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                        {              
                            echo "<option id='".$row['fld_school_id']."' value='".$row['fld_school_naam']." | ".$row['fld_postnummer']."(".$row['fld_woonplaats_naam'].")'>";
                        }
                }
        ?>
    </datalist>
    <input id="School_Zoeken" name="School_Zoeken" type="hidden"/>
</div>


</body>
</html>
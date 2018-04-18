<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Loopbaan formulier</title>
</head>

<body>
<?php
include "WISA-Connection.php";
?>

<!-- icons -->
<label class="form_bsdi" onclick="KlikKnop('Bestand_loopbaan')" title="Document selecteren."></label>

<div class="form_box_zoek">
</div>

<div class="form_box_zoek_border">
</div>

<form action="WISA-LoopbaanFormulier_Check.php" method="post">
    
    <!-- bestanden toevoegen -->
    <input class="form_bsd" id="Bestand_loopbaan" name="Bestand_loopbaan[]" multiple type="file"/>
    
    <!-- schooljaar -->
    <div class="form_box_1">
        <label class="form_lbl" for="Schooljaar">Schooljaar</label><br />
        <select class="form_slt" id="Schooljaar" onchange="display_school()">
            <option value="Kies">...</option>
            <?php
                $Datum = date('Y');
                echo "<option value='".$Datum." - ".($Datum + 1)."'>".$Datum." - ".($Datum + 1)."</option>";
                for( $i= 0 ; $i <= 10 ; $i++ ){
                    echo "<option value='".($Datum - $i - 1)." - ".($Datum - $i)."'>".($Datum - $i - 1)." - ".($Datum - $i)."</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="Loopbaan" id="Loopbaan">
        <!-- richting -->
        <div class="form_box_1">
            <label class="form_lbl">Richting</label><br />
            <div class="form_zoek">
                <input class="form_in" id="Richting_Zoeken_in" list="Richting_Zoeken_List" name="Richting_Zoeken_in" placeholder="..." />
            </div>
            <datalist class="form_slt" id="Richting_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_richtingen";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_richting_id']."' value='".$row['fld_richting_naam']." | ".$row['fld_richting_leerjaar']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Richting_Zoeken" name="Richting_Zoeken" type="hidden"/> 
        </div>
        
        <!--
        <div class="form_box_1">
            <label class="form_lbl"></label><br/>
            <select class="form_slt">
                <option value="Kies">...</option>
                <?php
                
                ?>
            </select>
        </div>
        -->
        
        
        <div class="Dit_Schooljaar" id="Dit_Schooljaar">        
            
        </div>
        
        <div class="Niet_Dit_Schooljaar" id="Niet_Dit_Schooljaar">
            <div>
                <!-- Attest -->
                <div class="form_box_1">
                    <label class="form_lbl" for="Attest_Zoeken_in">Attest</label><br/>
                    <div class="form_zoek">
                        <input class="form_in" id="Attest_Zoeken_in" list="Attest_Zoeken_List" name="Attest_Zoeken_in" onchange="display_attest()" placeholder="..."  />
                    </div>
                    <datalist class="form_slt" id="Attest_Zoeken_List" >
                        <option value="A">
                        <option value="B">
                        <option value="C">
                    </datalist>
                </div>
                
                <!-- Attest -->
                <div class="form_box_1" id="Attest_Doc_Div">
                    <div class="form_box_in">
                        <input class="form_bsd" id="Attest_Doc" name="Attest_Doc" type="file"/> 
                        <label class="form_bsdi1" onclick="KlikKnop('Attest_Doc')" title="Attest selecteren (document)."></label>
                    </div>
                </div>
                
                <!-- clausule -->
                <div class="form_box_1" id="Clausule_Div">
                    <label class="form_lbl" for="Clausule">Clausule</label><br />
                    <div class="form_box_in">  
                        <input id="Clausule" name="Clausule" type="text"/>
                    </div>
                </div>
            </div>
            
            <!-- school -->
            <div class="form_box_1">
                <label class="form_lbl" for="School">School</label><br />
                
                <div class="form_zoek">
                    <input class="form_in" id="School_Zoeken_in" list="School_Zoeken_List" name="School_Zoeken_in" placeholder="..." />
                </div>
                <datalist class="form_slt" id="School_Zoeken_List" >
                    <?php
                        $sql = "SELECT * FROM tbl_scholen";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) 
                            {
                                while($row = mysqli_fetch_assoc($result))
                                    {
                                        $Schoolnaam = $row['fld_school_naam'];
                                        $School_Id = $row['fld_school_id'];
                                        $sqlSchoolAdres = "SELECT * FROM tbl_adressen_linken WHERE fld_school_id_fk=".$School_Id;
                                        $resultSchoolAdres = mysqli_query($conn, $sqlSchoolAdres);
                                        if (mysqli_num_rows($resultSchoolAdres) > 0) 
                                            {
                                                while($rowSchoolAdres = mysqli_fetch_assoc($resultSchoolAdres))
                                                    {
                                                        $Adres_Id = $rowSchoolAdres['fld_adres_id_fk'];
                                                    }
                                            }
                                        echo "<option id='".$row['fld_school_id']."' value='".$row['fld_school_naam']."'>";
                                    }
                            }
                    ?>
                </datalist>
                <input id="School_Zoeken" name="School_Zoeken" type="hidden"/>
            </div>
        </div>
        
        <div>
            <label for="Begindatum">Begindatum</label>
            <input name="Begindatum" type="date"/>
        </div>
        
        <div>
            <label for="Einddatum">Einddatum</label>
            <input name="Einddatum" type="date"/>
        </div>
    </div>
    
    <div class="form_box_btn_border">
    </div>
    
    <div class="form_box_btn">
        <!-- Loopbaan opslaan knop -->
        <button class="form_btn" type="submit" id="Loopbaan_Opslaan" name="Loopbaan_Opslaan" title="Schooljaar opslagen en formulier leegmaken voor het volgende schooljaar.">Jaar opslaan</button>
        <!-- Knop om te annuleren --> 
        <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
        <!-- Volgende formulier -->
        <button class="form_next"  id="VolgendeInschrijving" name="VolgendeInschrijving" title="Volgende formulier: Inschrijving." type="submit">Volgende</button>
        <label class="form_nexti" onclick="KlikKnop('VolgendeInschrijving')" title="Volgende formulier: Inschrijving."></label>
    </div>
</form>

<script type="text/javascript">
<!--
        function KlikKnop(knop)
        {
            document.getElementById(knop).click();
        }
    
	function display_school(){
        var Schooljaar = document.getElementById("Schooljaar").value;
        var currentdate = new Date(); 
        var currentyear = currentdate.getFullYear();
        var date = currentyear + " - " + (currentyear + 1);
        var date2 = (currentyear - 1) + " - " + currentyear;
        if (Schooljaar == date || Schooljaar == date2) {
            document.getElementById('Dit_Schooljaar').style.display = 'block';
            document.getElementById('Niet_Dit_Schooljaar').style.display = 'none';
            document.getElementById('Loopbaan').style.display = 'block';
        }
        else if (Schooljaar < date) {
            document.getElementById('Dit_Schooljaar').style.display = 'none';
            document.getElementById('Niet_Dit_Schooljaar').style.display = 'block';
            document.getElementById('Loopbaan').style.display = 'block';
        }
        else {
            document.getElementById('Loopbaan').style.display = 'none';
        }
    }
    
    function display_attest(){
        var Attest = document.getElementById("Attest_Zoeken_in").value;
        if (Attest == "B") {
            document.getElementById('Clausule_Div').style.display = 'block';
        }
        else {
            document.getElementById('Clausule_Div').style.display = 'none';
        }
    }

-->
</script>

</body>
</html>
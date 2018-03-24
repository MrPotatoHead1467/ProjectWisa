<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

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
        
        <!-- richting -->
        <div class="form_box_1">
            <label class="form_lbl">Richting</label><br />
            <select class="form_slt" id="Richting">
                <option value="Kies">...</option>
                <?php
                    $sql = "SELECT * FROM tbl_richtingen";
                ?>
            </select>
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
            <div>
                <!-- Attest -->
                <div class="form_box_1">
                    <label class="form_lbl" for="Attest_Slct">Attest</label><br/>
                    <select class="form_slt" id="Attest_Slct" onchange="display_attest()">
                        <option value="Kies">...</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                
                <!-- Attest -->
                <div class="form_box_1" id="Attest_Doc_Div">
                    <div class="form_box_in">
                        <input class="form_bsd" id="Attest_Doc" name="Attest_Doc" type="file"/> 
                        <label class="form_bsdi1" onclick="KlikKnop('Attest_Doc')" title="Attest selecteren (document)."></label>
                    </div>
                </div>
                
                <div class="form_box_1" id="Clausule_Div">
                    <label class="form_lbl" for="Clausule">Clausule</label><br />
                    <div class="form_box_in">  
                        <input id="Clausule" name="Clausule" type="text"/>
                    </div>
                </div>
            </div>
            
            <div class="form_box_1">
                <label class="form_lbl" for="School">School</label><br />
                <select class="form_slt" id="School">
                    <option value="Kies">...</option>
                </select>
            </div>
        </div>
        
        <div class="form_box_1">
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
            var Schooljaar = document.getElementById("Schooljaar");
            var currentdate = new Date(); 
            var currentyear = currentdate.getFullYear();
            var date = currentyear + " - " + (currentyear + 1);
            var date2 = (currentyear - 1) + " - " + currentyear;
            if (Schooljaar.value == date || Schooljaar.value == date2) {
                document.getElementById('Dit_Schooljaar').style.display = 'none';
            }
            else {
                document.getElementById('Dit_Schooljaar').style.display = 'block';
            }
        }
        
        function display_attest(){
            var Attest = document.getElementById("Attest_Slct");
            if (Attest.value == "B") {
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
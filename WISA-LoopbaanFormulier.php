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

<form action="WISA-LoopbaanFormulier_Check.php" method="post">
    <div>
        <label for="Schooljaar">Schooljaar</label>
        <select id="Schooljaar" onchange="display_school()">
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
    
    <div>
        <label>Richting</label>
        <select id="Richting">
            <option value="Kies">...</option>
            <?php
                $sql = "SELECT * FROM tbl_richtingen";
            ?>
        </select>
    </div>
    
    <div>
        <label></label>
        <select>
            <option value="Kies">...</option>
            <?php
            
            ?>
        </select>
    </div>
    
    
    <div class="Dit_Schooljaar" id="Dit_Schooljaar">        
        <div>
            <div>
                <label for="Attest_Slct">Attest</label>
                <select id="Attest_Slct" onchange="display_attest()">
                    <option value="Kies">...</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            
            <div id="Attest_Doc_Div">
                <input id="Attest_Doc" name="Attest_Doc" type="file"/>
            </div>
            
            <div id="Clausule_Div">
                <label for="Clausule">Clausule</label>
                <input id="Clausule" name="Clausule" type="text"/>
            </div>
        </div>
        
        <div>
            <label for="School">School</label>
            <select id="School">
                <option value="Kies">...</option>
            </select>
        </div>
    </div>
    
    <div>
        <!-- Loopbaan opslaan knop -->
        <button type="submit" id="Loopbaan_Opslaan" name="Loopbaan_Opslaan">Opslaan</button>
        <!-- Volgende knop -->
        <button type="submit" id="Volgende" name="Volgende">Volgende</button>
    </div>
</form>

<script type="text/javascript">
<!--
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
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Relaties formulier</title>
</head>

<body>
    <?php
    include "WISA-Connection.php";
    ?>
    
    <!-- icons -->                        
    <label class="form_bsdi" onclick="KlikKnop('Bestand_relatie')" title="Document selecteren."></label>
    
    <div class="form_box_zoek">
    </div>
    
    <div class="form_box_zoek_border">
    </div>

<form action="WISA-RelatiesFormulier_Check.php" method="post">
    
    <!-- bestanden toevoegen -->
    <input class="form_bsd" id="Bestand_relatie" name="Bestand_relatie[]" multiple type="file"/>
    
    <!-- keuze leerling -->
    <div class="form_box_1">
        <label class='form_lbl' for="Leerling">Leerling</label><br />
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
                
            
        ?>
    </div>
        
    <!-- Persoon 2 -->
    <div  class="form_box_1">
        <label class="form_lbl" for="Persoon_Zoeken_in">Tweede persoon</label><br />
        <div class="form_zoek">
            <input class="form_in" id="Persoon_Zoeken_in" list="Persoon_Zoeken_List" name="Persoon_Zoeken_in" placeholder="..." />
        </div>
        <datalist class="form_slt" id="Persoon_Zoeken_List" >
            <?php
                $sql = "SELECT * FROM tbl_personen";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option id='".$row['fld_persoon_id']."' value='".$row['fld_persoon_naam']." (".$row['fld_persoon_gb_datum'].") '>";
                    }
                }
            ?>
        </datalist>
        <input id="Persoon_Zoeken" name="Persoon_Zoeken" type="hidden"/>
    </div>
    
    <div  class="form_box_1">
        <!-- Keuzelijst relatie -->
        <label class='form_lbl' for="Relatie_Zoeken_In">Relatie</label><br />
        <div class="form_zoek">
            <input class="form_in" id="Relatie_Zoeken_in" list="Relatie_Zoeken_List" name="Relatie_Zoeken_in" placeholder="Soort relatie" />
        </div>
        <datalist class="form_slt" id="Relatie_Zoeken_List" >
            <?php
                $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_item = 'Relatie'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option id='".$row['fld_soort_id']."' value='".$row['fld_soort_naam']."'>";
                    }
                }
            ?>
        </datalist>
        <input id="Relatie_Zoeken" name="Relatie_Zoeken" type="hidden"/>  
        
        <!-- Beschrijving relatie -->
        <textarea class="form_in1" id="Relatie_beschrijving" maxlength="511" name="Relatie_beschrijving" placeholder="Beschrijving relatie" title="Voeg een beschrijving van de relatie tussen deze twee personen. Mag persoon 2 gecontacteerd worden? Zo ja, wanneer?"></textarea>
    </div>
    
    <div>
            <?php
                if (isset($_SESSION['Personen_Relaties']))
                    {
                    $i = 0;
                    foreach($_SESSION['Personen_Relaties'] as $x => $value) 
                        {
                        $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$x."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $x = $row['fld_persoon_naam'];
                            }
                        }
                        
                        $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$value."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $x_value = $row['fld_soort_naam'];
                            }
                        }
                        
                        $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id=".$_SESSION['Leerling'];
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $Leerling = $row['fld_persoon_naam'];
                            }
                        }
                        echo "<div class='form_box_in'>";
                            /** Verwijderknop */
                            echo "<button class='form_mn' id='".$i."' name='".$i."' title='Relatie verwijderen.' type='submit' >x</button>";
                            /** Al toegevoegde relaties*/
                            echo "<label class='form_lbl' for='".$i."' title='Bestaande relatie: ".$x.", ".$x_value." van ".$Leerling.".' type='text'>".$x.", ".$x_value." van ".$Leerling."</label><br/>";
                        echo '</div>';
                        ++$i;
                        }
                    }
            ?>
        </div>
    
    <div class="form_box_btn_border">
    </div>
    
    <div class="form_box_btn">
        <!-- Relatie opslaan knop -->
        <button class="form_btn" type="submit" id="Relatie_opslaan" name="Relatie_opslaan">Relatie opslaan</button>
        <!-- Knop om te annuleren --> 
        <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
        <!-- Volgende formulier -->
        <button class="form_next"  id="VolgendeContact" name="VolgendeContact" title="Volgende formulier: Contactgegevens." type="submit">Volgende</button>
        <label class="form_nexti" onclick="KlikKnop('VolgendeContact')" title="Volgende formulier: Contactgegevens."></label>
    </div>
</form>

    <script>
        function KlikKnop(knop)
        {
            document.getElementById(knop).click();
        }
        $(function()
            {
              $('#Persoon_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Persoon_Zoeken").value = opt.attr('id');
                                                  });
            });
        $(function()
            {
              $('#Relatie_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Relaties_Zoeken").value = opt.attr('id');
                                                  });
            });
        
    
    </script>

</body>
</html>
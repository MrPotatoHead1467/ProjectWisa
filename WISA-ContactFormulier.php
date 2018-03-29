<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<title>WISA | Contact formulier</title>
</head>

<body>
    <?php
    include "WISA-Connection.php";
    ?>
    
    <!-- bestanden toevoegen D1-->
    <label class="form_bsdi" onclick="KlikKnop('Bestand_contact')" title="Document selecteren."></label>
    
    <!-- Persoons gegevens zoeken -->
    <div>
        <form action="WISA-ContactFormulier_Check.php" method="post">
            <div class="form_box_zoek">
                <label class="form_lbl" for="Contact_Zoeken_in">Persoons gegevens zoeken</label><br />
                <button class="form_edit" id="Contact_Zoeken_btn" name="Contact_Zoeken_btn" type="submit">Gegevens invullen</button>
                <div class="form_zoek">
                    <input class="form_in" id="Contact_Zoeken_in" list="Contact_Zoeken_List" name="Contact_Zoeken_in" placeholder="..." 
                    <?php 
                        if (isset($_SESSION['Contact']) && $_SESSION['Contact'] != ''){
                            $sql = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$_SESSION['Contact']."'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    echo "value='".$row['fld_persoon_naam']." (".$row['fld_persoon_gb_datum'].")'";
                                }
                            }           
                        }
                     ?>
                    />
                    <label class="form_editi" for="Contact_Zoeken_btn" onclick="KlikKnop('Contact_Zoeken_btn')" title="Personns gegevens zoekn."></label>
                </div>
                <datalist class="form_slt" id="Contact_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_personen";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option id='".$row['fld_persoon_id']."' value='".$row['fld_persoon_naam']." (".$row['fld_persoon_gb_datum'].")'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Contact_Zoeken" name="Contact_Zoeken" type="hidden"/>
            </div>
        </form>
    </div>
    
    <div class="form_box_zoek_border">
    </div>
    
    <form action="WISA-ContactFormulier_Check.php" method="post">
    
        <!-- bestanden toevoegen D2-->
        <input class="form_bsd" id="Bestand_contact" name="Bestand_contact[]" multiple type="file"/>
        
        <!-- GSM -->
        <div class="form_box_1">
            <label class="form_lbl" for="GSM">GSM</label><br />
            
            <!-- nummer -->
            <div class="form_box_in">
                <input type="text" id="GSM" name="GSM" placeholder="Nummer"/>
            </div>
    
            <!-- Soort geg -->
            <div class="form_zoek">
                <input class="form_in" id="Soort_GSM_Zoeken_in" list="Soort_GSM_Zoeken_List" name="Soort_GSM_Zoeken_in" placeholder="Soort" />
            </div>
            <datalist class="form_slt" id="Soort_GSM_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_item = 'Gegeven'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_soort_id']."' value='".$row['fld_soort_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Soort_GSM_Zoeken" name="Soort_GSM_Zoeken" type="hidden"/>  
            
            <!-- toevoeg knop -->
            <button class='form_pls1' id="GSM_Opslaan" name="GSM_Opslaan" type="submit">+</button>
            <!-- beschrijving GSM nummer -->
            <textarea class="form_in1" id="Besch_GSM" name="Besch_GSM" placeholder="Beschrijving"></textarea>
        </div>
        
        <!-- Bestaande GSM nummers -->
        <div class="form_box_1" id="Mogelijke_GSM">
            <ul>
                <?php
                    if (isset($_SESSION['Mogelijke_GSM_nrs']) && $_SESSION['Mogelijke_GSM_nrs'] != '')
                        {
                            foreach ($_SESSION['Mogelijke_GSM_nrs'] as $i => $Mogelijk_GSM)
                                {
                                    foreach ($Mogelijk_GSM as $Omsch => $Waarde)
                                        {
                                            if ($Omsch == 'GSM_Nr'){
                                                $GSM_Nr = $Waarde;
                                            }
                                            elseif ($Omsch == 'GSM_Soort'){
                                                $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$Waarde."'";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $GSM_Soort = $row['fld_soort_naam'];
                                                    }
                                                }
                                            }
                                            elseif ($Omsch == 'GSM_Besch'){
                                                $GSM_Besch = $Waarde;
                                                if ($GSM_Besch != ''){
                                                    $GSM_Besch = " (".$GSM_Besch.")";
                                                }
                                            }
                                        }
                                        /** 
                                        $GSM_Nr = GSMnummer
                                        $GSM_Soort = Soort GSMnummer
                                        $GSM_Besch = Beschrijving GSMnummer
                                        
                                        Onder mijn domme echo kan je zien dat je div er nog staat.
                                        Je mag onder de button kiezen hoe je de al aangemaakte GSMnummers wilt laten zien.
                                        De namen die je nodig hebt zie je hierboven :)
                                        Zolang je niet voorbij de } gaat zouden er geen problemen moeten zijn.
                                        Deze commentaar en mijn domme echo mogen weg :D
                                        */
                                        //echo "Kijk in de code hierboven voor de namen en zet ze hoe je wil :)";
                                        
                                        echo "<li class='form_li_gsm'>";
                                            echo "<div class='form_box_in'>";
                                                /** Verwijderknop */
                                                echo "<button class='form_mn' id='GSM_".$i."' name='GSM_".$i."' type='submit'>x</button>";
                                                /** Mogelijk GSM nummer tonen in tekstvak */
                                                echo "<label class='form_lbl' type='text'><b>".$GSM_Soort.":</b> ".$GSM_Nr.$GSM_Besch."</label>"; 
                                            echo "</div>";
                                        echo "</li>";
                                }
                        }
                ?>
            </ul>
        </div>
        
        <!-- telefoon -->
        <div class="form_box_1">
            <label class="form_lbl" for="Telefoon">Telefoon</label><br />
            <!-- telefoon nummer -->
            <div class="form_box_in">
                <input id="Telefoon" name="Telefoon" placeholder="Nummer" type="text"/>
            </div>
            
            <!-- Soort geg -->
            <div class="form_zoek">
                <input class="form_in" id="Soort_Tel_Zoeken_in" list="Soort_Tel_Zoeken_List" name="Soort_Tel_Zoeken_in" placeholder="Soort" />
            </div>
            <datalist class="form_slt" id="Soort_Tel_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_item = 'Gegeven'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_soort_id']."' value='".$row['fld_soort_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Soort_Tel_Zoeken" name="Soort_Tel_Zoeken" type="hidden"/>  
            
            <!-- toevoeg knop -->
            <button class='form_pls1' id="Telefoon_Opslaan" name="Telefoon_Opslaan" type="submit">+</button>
            <!-- beschrijving -->
            <textarea class="form_in1" id="Besch_Tel" name="Besch_Tel" placeholder="Beschrijving"></textarea>
        </div>
                
        <!-- toegevoegde telefoon nummers -->  
        <div class="form_box_1" id="Mogelijke_Tel">
            <ul>
            <?php
                if (isset($_SESSION['Mogelijke_Tel_nrs']) && $_SESSION['Mogelijke_Tel_nrs'] != '')
                        {
                            foreach ($_SESSION['Mogelijke_Tel_nrs'] as $i => $Mogelijk_Tel)
                                {
                                    foreach ($Mogelijk_Tel as $Omsch => $Waarde)
                                        {
                                            if ($Omsch == 'Tel_Nr'){
                                                $Tel_Nr = $Waarde;
                                            }
                                            elseif ($Omsch == 'Tel_Soort'){
                                                $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$Waarde."'";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $Tel_Soort = $row['fld_soort_naam'];
                                                    }
                                                }
                                            }
                                            elseif ($Omsch == 'Tel_Besch'){
                                                $Tel_Besch = $Waarde;
                                                if ($Tel_Besch != ''){
                                                    $Tel_Besch = " (".$Tel_Besch.")";
                                                }
                                                
                                            }
                                        }
                                        /** 
                                        $Tel_Nr = Telefoonnummer
                                        $Tel_Soort = Soort telefoonnummer
                                        $Tel_Besch = Beschrijving telefoonnummer
                                        
                                        Onder mijn domme echo kan je zien dat je div er nog staat.
                                        Je mag onder de butten kiezen hoe je de al aangemaakte telefoonnummers wilt laten zien.
                                        De namen die je nodig hebt zie je hierboven :)
                                        Zolang je niet voorbij de } gaat zouden er geen problemen moeten zijn.
                                        Deze commentaar en mijn domme echo mogen weg :D
                                        */
                                        //echo "Kijk in de code hierboven voor de namen en zet ze hoe je wil :)";
                                        
                                        echo "<li class='form_li_tel'>";
                                            echo "<div class='form_box_in'>";
                                                /** Verwijderknop */
                                                echo "<button class='form_mn' id='Tel_".$i."' name='Tel_".$i."' type='submit'>x</button>";
                                                /** Mogelijk Tel nummer tonen in tekstvak */
                                                echo "<label class='form_lbl' type='text'><b>".$Tel_Soort.":</b> ".$Tel_Nr.$Tel_Besch."</label>"; 
                                            echo "</div>";
                                        echo "</li>";
                                }
                        }
            ?>
            </ul>
        </div>
        
        <!-- e-mail -->
        <div class="form_box_1">
            <label class="form_lbl" for="EMail">E-mail</label><br />
            <!-- E-mail adres -->
            <div class="form_box_in">
                <input id="EMail" name="EMail" placeholder="Adres" type="text"/>
            </div>
            
            <!-- Soort geg -->
            <div class="form_zoek">
                <input class="form_in" id="Soort_EMail_Zoeken_in" list="Soort_EMail_Zoeken_List" name="Soort_EMail_Zoeken_in" placeholder="Soort" />
            </div>
            <datalist class="form_slt" id="Soort_EMail_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_item = 'Gegeven'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_soort_id']."' value='".$row['fld_soort_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Soort_EMail_Zoeken" name="Soort_EMail_Zoeken" type="hidden"/>  
            
            <!-- toevoeg knop -->
            <button class='form_pls1' id="EMail_Opslaan" name="EMail_Opslaan" type="submit">+</button>
            <!-- Beschrijving E-mail adres -->
            <textarea class="form_in1" id="Besch_EMail" name="Besch_EMail" placeholder="Beschrijving"></textarea>
        </div>
                      
        <!-- bestaande e-mail adressen -->    
        <div class="form_box_1" id="Mogelijke_Email">
            <ul>
            <?php
                if (isset($_SESSION['Mogelijke_EMail']) && $_SESSION['Mogelijke_EMail'] != '')
                        {
                            foreach ($_SESSION['Mogelijke_EMail'] as $i => $Mogelijk_EMail)
                                {
                                    foreach ($Mogelijk_EMail as $Omsch => $Waarde)
                                        {
                                            if ($Omsch == 'EMail'){
                                                $EMail = $Waarde;
                                            }
                                            elseif ($Omsch == 'EMail_Soort'){
                                                $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$Waarde."'";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $EMail_Soort = $row['fld_soort_naam'];
                                                    }
                                                }
                                            }
                                            elseif ($Omsch == 'EMail_Besch'){
                                                $EMail_Besch = $Waarde;
                                                if ($EMail_Besch != ''){
                                                    $EMail_Besch = " (".$EMail_Besch.")";
                                                }
                                            }
                                        }
                                        /** 
                                        $EMail = EMail
                                        $EMail_Soort = Soort EMail
                                        $EMail_Besch = Beschrijving EMail
                                        
                                        Onder mijn domme echo kan je zien dat je div er nog staat.
                                        Je mag onder de butten kiezen hoe je de al aangemaakte EMailadressen wilt laten zien.
                                        De namen die je nodig hebt zie je hierboven :)
                                        Zolang je niet voorbij de } gaat zouden er geen problemen moeten zijn.
                                        Deze commentaar en mijn domme echo mogen weg :D
                                        */
                                        //echo "Kijk in de code hierboven voor de namen en zet ze hoe je wil :)";
                                        
                                        echo "<li class='form_li_email'>";
                                            echo "<div class='form_box_in'>";
                                                /** Verwijderknop */
                                                echo "<button class='form_mn' id='EMail_".$i."' name='EMail_".$i."' type='submit'>x</button>";
                                                /** Mogelijk EMail nummer tonen in tekstvak */
                                                echo "<label class='form_lbl' type='text'><b>".$EMail_Soort.":</b> ".$EMail.$EMail_Besch."</label>";
                                            echo "</div>";
                                        echo "</li>";
                                }
                        }
            ?>
            </ul>
        </div>
        
        <!-- adres -->
        <div class="form_box_1">
            <label class="form_lbl" for="Straat">Adres</label><br />
            
            <!-- België? -->
            <div class="form_box_in">
                <!-- Checkbox voor woonplaats niet in België -->
                <input id="Niet_Be" name="Niet_Be" onclick="woonplaats_niet_be()" type="checkbox"/>
                <label class="form_lbl" for="Niet_Be">Woonplaats niet in Belgi&euml;</label>
            </div>
            
            <!-- straat -->
            <div class="form_box_in">
                <input id="Straat" name="Straat" placeholder="Straatnaam" type="text" />
            </div>
            
            <!-- huisnummer -->
            <div class="form_box_in">
                <input id="Huisnummer" name="Huisnummer" placeholder="Huisnummer" type="text"/>
            </div>
            
            <!-- bus -->
            <div class="form_box_in">
                <input id="Bus" name="Bus" placeholder="Bus" type="text"/>
            </div>
            
            <!--  Woonplaats -->
            
            <div id="Woonplaats_Wel_Be">
                <div class="form_zoek">
                    <input class="form_in" id="Woonplaats_in" list="Woonplaats_List" name="Woonplaats_Lijst" placeholder="Postcode en woonplaats"/>
                </div>
                
                <datalist class="form_slt" id="Woonplaats_List">
                    <?php
                        $sql = "SELECT * FROM tbl_postcodes";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc())
                                {
                                    echo "<option id='".$row['fld_postcode_id']."' value='".$row['fld_postnummer']." | ".$row['fld_woonplaats_naam']."'>";
                                }
                        }
                    ?>
                </datalist>
                <input id="Woonplaats" name="Woonplaats" type="hidden"/>
                
                <div>
                    <div class="form_zoek">
                        <input class="form_in" disabled="true" id="Land_Be" name="Land_Be" value="Belgi&euml;" type="text"/>
                    </div>
                    <input id="Land_Be_Hidden" name="Land_Be_Hidden" type="hidden" value="Belgi&euml;" />
                </div>
            </div>
            <div id="Woonplaats_niet_be">
                <div class="form_box_in">
                    <input id="Woonplaats_niet_be_in" name="Woonplaats_niet_be_in" placeholder="Woonplaats (niet in Belgi&euml;)" type="text"/>
                </div>
                
                <!-- land -->
                <div class="form_zoek">
                    <input class="form_in" id="Land_Zoeken_in" list="Land_Zoeken_List" name="Land_Zoeken_in" placeholder="Land" />
                </div>
                <datalist class="form_slt" id="Land_Zoeken_List" >
                    <?php
                        $sql = "SELECT * FROM tbl_landen";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option id='".$row['fld_land_id']."' value='".$row['fld_land_naam']." (".$row['fld_land_afkorting'].")'>";
                            }
                        }
                    ?>
                </datalist>
                <input id="Land_Zoeken" name="Land_Zoeken" type="hidden"/>
            </div>

            <!-- Soort geg -->
            <div class="form_zoek">
                <input class="form_in" id="Soort_Adres_Zoeken_in" list="Soort_Adres_Zoeken_List" name="Soort_Adres_Zoeken_in" placeholder="Soort" />
            </div>
            <datalist class="form_slt" id="Soort_Adres_Zoeken_List" >
                <?php
                    $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_item = 'Adres'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option id='".$row['fld_soort_id']."' value='".$row['fld_soort_naam']."'>";
                        }
                    }
                ?>
            </datalist>
            <input id="Soort_Adres_Zoeken" name="Soort_Adres_Zoeken" type="hidden"/>
                        
            <!-- toevoeg knop -->
            <button class='form_pls1' id="Adres_Opslaan" name="Adres_Opslaan" type="submit">+</button>
            <!-- beschrijving -->
            <textarea class="form_in1" id="Besch_Adres" name="Besch_Adres" placeholder="Beschrijving adres"></textarea>
        </div>
        
        <div class="form_box_1" id="Mogelijke_Adres">
            <ul>
            <?php
                if (isset($_SESSION['Mogelijke_Adressen']) && $_SESSION['Mogelijke_Adressen'] != '')
                        {
                            foreach ($_SESSION['Mogelijke_Adressen'] as $i => $Mogelijk_Adres)
                                {
                                    foreach ($Mogelijk_Adres as $Omsch => $Waarde)
                                        {
                                            if ($Omsch == 'Adres_Straat'){
                                                $Adres_Straat = $Waarde;
                                            }
                                            elseif ($Omsch == 'Adres_Huisnr'){
                                                $Adres_Huisnr = $Waarde;
                                            }
                                            elseif ($Omsch == 'Adres_Bus'){
                                                $Adres_Bus = $Waarde;
                                                if ($Adres_Bus != ''){
                                                    $Adres_Bus = " (".$Adres_Bus.")";
                                                }
                                            }
                                            elseif ($Omsch == 'Adres_Niet_Be'){
                                                $Adres_Niet_Be = $Waarde;
                                            }
                                            elseif ($Omsch == 'Adres_Woonplaats'){
                                                if ($Adres_Niet_Be == true){
                                                    $Adres_Woonplaats = $Waarde;
                                                }
                                                else {
                                                    $sql = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$Waarde."'";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $Adres_Post = $row['fld_postnummer'];
                                                            $Adres_Gem = $row['fld_woonplaats_naam'];
                                                            $Adres_Woonplaats = $Adres_Post." ".$Adres_Gem;
                                                        }
                                                    }
                                                }
                                                
                                            }
                                            elseif ($Omsch == 'Adres_Land'){
                                                $sql = "SELECT * FROM tbl_landen WHERE fld_land_id='".$Waarde."'";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $Adres_Land = $row['fld_land_naam'];
                                                    }
                                                }
                                            }
                                            elseif ($Omsch == 'Adres_Soort'){
                                                $sql = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$Waarde."'";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $Adres_Soort = $row['fld_soort_naam'];
                                                    }
                                                }
                                            }
                                            elseif ($Omsch == 'Adres_Besch'){
                                                $Adres_Besch = $Waarde;
                                                if ($Adres_Besch != ''){
                                                    $Adres_Besch = " (".$Adres_Besch.")";
                                                }
                                            }
                                        }
                                        /** 
                                        $Adres_Straat = Straatnaam
                                        $Adres_Huisnr = Huisnummer
                                        $Adres_Bus = Bus
                                        $Adres_Niet_Be = true -> niet be
                                                         false -> wel be
                                                         Ik denk dat het niet nodig is om deze te laten zien aan de gebruiker
                                        $Adres_Post = Postnummer
                                        $Adres_Gem = Gemeente
                                        $Adres_Land = Land
                                        $Adres_Soort = Soort adres
                                        $Adres_Besch = Beschrijving adres
                                        
                                        Onder mijn domme echo kan je zien dat je div er nog staat.
                                        Je mag onder de butten kiezen hoe je de al aangemaakte adressen wilt laten zien.
                                        De namen die je nodig hebt zie je hierboven :)
                                        Zolang je niet voorbij de } gaat zouden er geen problemen moeten zijn.
                                        Deze commentaar en mijn domme echo mogen weg :D
                                        */
                                        //echo "Kijk in de code hierboven voor de namen en zet ze hoe je wil :)";
                                        
                                        echo "<li class='form_li_adres'>";
                                            echo "<div class='form_box_in'>";
                                                /** Verwijderknop */
                                                echo "<button class='form_mn' id='Adres_".$i."' name='Adres_".$i."' type='submit'>x</button>";
                                                /** Mogelijk Adres tonen in tekstvak */
                                                echo "<label class='form_lbl' type='text'><b>".$Adres_Soort.":</b> ".$Adres_Straat." ".$Adres_Huisnr.$Adres_Bus.", ".$Adres_Woonplaats.", ".$Adres_Land.$Adres_Besch."</label>";
                                            echo "</div>";
                                        echo "</li>";
                                }
                        }
            ?>
            </ul>
        </div>
        
        <div class="form_box_btn_border">
        </div>
        
        <div class="form_box_btn">
            <!-- Contact opslaan knop -->
            <button class="form_btn" id="Contact_Opslaan" name="Contact_Opslaan" type="submit">Gegevens opslaan</button>
            <!-- Knop om te annuleren --> 
            <button class="form_ccl" id="Annuleer" name="Annuleer" type="submit">Annuleren</button>
            <!-- Volgende formulier -->
            <button class="form_next"  id="Volgende" name="Volgende" title="Volgende formulier: Loopbaan." type="submit">Volgende</button>
            <label class="form_nexti" onclick="KlikKnop('Volgende')" title="Volgende formulier: Loopbaan."></label>
        </div>
    </form>

    <script type="text/javascript">
    <!--
        function KlikKnop(knop)
            {
                document.getElementById(knop).click();
            }
    
    	function woonplaats_niet_be() 
            {
                if (document.getElementById('Niet_Be').checked)
                    {
                        document.getElementById('Woonplaats_niet_be').style.display = 'block';
                        document.getElementById('Woonplaats_Wel_Be').style.display = 'none';
                    }
                else 
                    {
                        document.getElementById('Woonplaats_niet_be').style.display = 'none';
                        document.getElementById('Woonplaats_Wel_Be').style.display = 'block';
                    }
            }
        
        $(function() 
            {
                $('#Contact_Zoeken_in').on('input',function()
                                                {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Contact_Zoeken").value = opt.attr('id');
                                                });
            });
            
        $(function()
            {
              $('#Soort_GSM_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Soort_GSM_Zoeken").value = opt.attr('id');
                                                  });
            });
            
        $(function()
            {
              $('#Soort_Tel_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Soort_Tel_Zoeken").value = opt.attr('id');
                                                  });
            });
            
        $(function()
            {
              $('#Soort_EMail_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Soort_EMail_Zoeken").value = opt.attr('id');
                                                  });
            });
        
        $(function()
            {
              $('#Soort_Adres_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Soort_Adres_Zoeken").value = opt.attr('id');
                                                  });
            });
            
        $(function()
            {
              $('#Woonplaats_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Woonplaats").value = opt.attr('id');
                                                  });
            });
        
        $(function()
            {
              $('#Land_Zoeken_in').on('input',function() 
                                                  {
                                                    var opt = $('option[value="'+$(this).val()+'"]');
                                                    document.getElementById("Land_Zoeken").value = opt.attr('id');
                                                  });
            });
        
        
    -->
    </script>

</body>
</html>
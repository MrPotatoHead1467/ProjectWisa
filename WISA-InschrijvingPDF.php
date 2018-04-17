
<?php
    //session_start();

    require ("fpdf181/fpdf.php");
    include "WISA-Connection.php";
    
    // logo <img id='kamers_foto' src='data:image/jpeg;base64, ".base64_encode($_SESSION['schoolLogo'])."' width='350' height='350'/>
    //$_SESSION['schoolLogo'];
    // schoolnaam: 
    $_SESSION['schoolNaam'] = 'Minlipinou';
    // adres school: 
    $_SESSION['schoolStraat'] = "Scholenstraat";
    $_SESSION['schoolHuisNR'] = '123';
    $_SESSION['schoolBus'] = 'b';
    if ($_SESSION['schoolBus'] == '')
        {
            $_SESSION['schoolAdres'] = $_SESSION['schoolStraat'].' '.$_SESSION['schoolHuisNR'];
        }
    else
        {
            $_SESSION['schoolAdres'] = $_SESSION['schoolStraat'].' '.$_SESSION['schoolHuisNR'].' ('.$_SESSION['schoolBus'].')';
        }
    // postcde & gemeente school: 
    $_SESSION['schoolPostNR'] = '4010';
    $_SESSION['schoolPlaats'] = 'Somewhere Ville';
    // tel school:
    $_SESSION['schoolTel'] = '016030563';
    // fax school:
    $_SESSION['schoolFax'] = '022030564';
    // e-mail school:
    $_SESSION['schoolEmail'] = 'info@Minlipinou.be';
    // titel doc: 
    $_SESSION['titelDoc'] = 'Inschrijving leerling 2017-2018';
    // inschrijvingsdatum
    $_SESSION['inschrijvingDatum'] = '29/03/2017';
    // status inschrijving
    $_SESSION['inschrijvingStatus'] = 'Aanvraag';
    // gebuiker I
    $_SESSION['inschrijverNaam'] = 'Louis Marchant';
    // update date
    $_SESSION['inschrijvingUDatum'] = 'some date';
    // lln id 
    $_SESSION['Leerling'] = 22;
    $llnID = 22;
    //
    $sqlZoekLln = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$llnID."'";
    $infoLln = $conn->query($sqlZoekLln);
    if ($infoLln->num_rows > 0) 
        {
            while($row = $infoLln->fetch_assoc())
                {
                    $llnNaam = $row['fld_persoon_naam'];
                    $llnGeslacht = $row['fld_persoon_geslacht'];
                    $llnGBDatum = $row['fld_persoon_gb_datum'];
                    $llnGBPlaatsID = $row['fld_persoon_gb_plaats'];
                    //$llnGBPlaatsNB = $row['fld_persoon_gb_plaats_niet_be'];
                    $llnNationID = $row['fld_persoon_nation_id_fk'];
                    $llnRijkNR = $row['fld_persoon_register_nr'];
                    $llnBisNR = $row['fld_persoon_bis_nr'];
                    $llnGodsID = $row['fld_godsdienst_id_fk'];
                }
        }
    //
    $_SESSION['LeerlingNaam'] = $llnNaam;
    //
    $sqlGBPlaats = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$llnGBPlaatsID."'";
    $infoGBPlaats = $conn->query($sqlGBPlaats);
    if ($infoGBPlaats->num_rows > 0) 
        {
            while($row = $infoGBPlaats->fetch_assoc())
                {
                    $llnGBPlaats = $row['fld_woonplaats_naam'];
                }
        }
    // lln
    $sqlGods = "SELECT * FROM tbl_godsdiensten WHERE fld_godsdienst_id='".$llnGodsID."'";
    $infoGods = $conn->query($sqlGods);
    if ($infoGods->num_rows > 0) 
        {
            while($row = $infoGods->fetch_assoc())
                {
                    $llnGods = $row['fld_godsdienst_naam'];
                }
        }
        
    // lln nation
    $sqlNation = "SELECT * FROM tbl_nationaliteiten WHERE fld_nation_id='".$llnNationID."'";
    $infoNation = $conn->query($sqlNation);
    if ($infoNation->num_rows > 0) 
        {
            while($row = $infoNation->fetch_assoc())
                {
                    $llnNation = $row['fld_nation_nation'];
                }
        }
    
    // Lln geg
    $sqlGegLln = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$llnID."' ORDER BY fld_soort_id_fk";
    $infoGegLln = $conn->query($sqlGegLln);
    $aantalLlnGeg = mysqli_num_rows($infoGegLln);
    if ($infoGegLln->num_rows > 0)
        {
            $a = 1;
            $gegLln = array();
            
            while($row = $infoGegLln->fetch_assoc() && $a <= $aantalLlnGeg)
                {
                    $gegLlnInhoud = array("SOORT"=>"", "GEG"=>"", "BESCHR"=>$row['fld_persoon_gegeven-beschrijving']);
                    
                    $soortGeg = $row['fld_soort_id_fk'];
                    $sqlSoortGeg = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortGeg."'";
                    $infoSoortGeg = $conn->query($sqlSoortGeg);
                    if ($infoSoortGeg->num_rows > 0)
                        {
                            while($row = $infoSoortGeg->fetch_assoc())
                                {
                                    $gegLlnInhoud['SOORT'] = $row['fld_soort_naam'];
                                }
                                
                        }
                    echo 
                    $inhoudGeg = $row['fld_soort_id_fk'];
                    $sqlInhoudGeg = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$inhoudGeg."'";
                    $infoInhoudGeg = $conn->query($sqlInhoudGeg);
                    if ($infoInhoudGeg->num_rows > 0)
                        {
                            while($row = $infoSoortGeg->fetch_assoc())
                                {
                                    $gegLlnInhoud['GEG'] = $row['fld_gegeven_inhoud'];
                                }
                                
                        }
                    array_push($gegLln, $gegLlnInhoud);
                    ++$a;
                    
                    
                    
                }
        }    
        //foreach ($geg)
    
    //
    //
    $adresLln1 = array("STRAAT"=>"",);
    
    //
    //
    //
    //
    //
    //
    
    
    class PDF extends FPDF
        {
            function Header()   
                {
                    if (($this -> PageNo()) == 1)
                        {
                            $this -> Image('MIN_Print_Icon.png',20,10,30,30);
                            $this -> SetFont('Arial','B',10); 
                            //$this -> cell(190, 5, '', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $_SESSION['schoolNaam'], 0, 1, 'L');
                            $this -> SetFont('Arial','',9); 
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $_SESSION['schoolAdres'], 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $_SESSION['schoolPostNR'].' '.$_SESSION['schoolPlaats'], 0, 1, 'L');
                            // Tel
                            if ($_SESSION['schoolTel'] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'Tel: '.$_SESSION['schoolTel'], 0, 1, 'L');    
                                }
                            // Fax
                            if ($_SESSION['schoolFax'] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'Fax: '.$_SESSION['schoolFax'], 0, 1, 'L');    
                                }
                            // E-mail    
                            if ($_SESSION['schoolEmail'] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'E-mail: '.$_SESSION['schoolEmail'], 0, 1, 'L');    
                                }
                            $this -> Ln(5);
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, $_SESSION['titelDoc'], 0, 1, 'C');
                            $this -> Ln(2);
                            $this -> cell(190, 0, '', 1, 1, 'L');
                            $this -> Ln(5);
                        }
                        
                    if (($this -> PageNo()) > 1)
                        {
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, $_SESSION['titelDoc'], 0, 1, 'C');
                            $this -> Ln(2);
                            $this -> cell(190, 0, '', 1, 1, 'C');
                            $this -> Ln(5);
                        }
                }
            function Footer()   
                {
                    $this -> SetY( -20 );
                    $this -> SetFont('Arial','B',10);
                    
                    $this -> Ln(5);
                    $this -> cell(190, 0, '', 1, 1, 'C');
                    $this -> Ln(2);
                    $this -> cell(170, 5, $_SESSION['schoolNaam'].' | Inschrijving '.$_SESSION['LeerlingNaam'], 0, 0);
                    $this -> cell(20, 5, $this ->PageNo().' | {nb}', 0, 0, 'R');
                }
        }
    
    //new PDF: default margin: 10mm
    $pdf = new PDF('P', 'mm', 'A4');
    $pdf -> SetTitle('Inschrijving-Leerling');
    
    $pdf->AliasNbPages('{nb}');
    
    // Style
    // Schoolnaam = SetFont('Arial','B',10)
    // Tussentitel = SetFont('Arial','B',11)
    // Gegevens = SetFont('Arial','',10)
    // Footer = SetFont('Arial','B',11)

    $pdf -> AddPage('P', 'A4');
    //$pdf->setTopMargin(1);
    //$pdf->setLeftMargin(1);
    //$pdf->setRightMargin(1);
    // Container (for text) = cell(width, heigth, text, border(1=all, 0=none), end line (1=newline, 0=continue), align (L,C,R),
     
    // Info inschrijving
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(175, 5, strtoupper($_SESSION['inschrijvingStatus']), 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(32, 5, 'Inschrijvingsdatum: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(30, 5, $_SESSION['inschrijvingDatum'], 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(32, 5, 'Ingeschreven door: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(50, 5, $_SESSION['inschrijverNaam'], 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    if ($_SESSION['inschrijvingUDatum'] == '' or $_SESSION['inschrijvingUDatum'] == $_SESSION['inschrijvingDatum'])
        {   
            $pdf -> Ln(0);
        }
    else
        {
            $pdf -> Ln(2);
            $pdf -> cell(5, 5, '', 0, 0);
            $pdf -> cell(28, 5, 'Laatst gewijzigd: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(50, 5, $_SESSION['inschrijvingUDatum'], 0, 1);
            $pdf -> SetTextColor( 0, 0, 0 );
        }
    
    $pdf -> Ln(5);
    
    // Gegevens leerling
    $pdf -> SetFont('Arial','B',11);;
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Gegevens leerling', 0,1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(12, 5, 'Naam: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(158, 5, $llnNaam, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(17, 5, 'Geslacht: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(153, 5, $llnGeslacht, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> Ln(2);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(27, 5, 'Geboortedatum: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(143, 5, $llnGBDatum, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(27, 5, 'Geboorteplaats: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(143, 5, $llnGBPlaats, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(21, 5, 'Nationaliteit: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(149, 5, $llnNation, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    if ($llnBisNR == '')
        {
            if ($llnRijkNR == '')
                {
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> cell(35, 5, 'Rijksregisternummer: ', 0, 0);
                    $pdf -> SetTextColor( 137, 137, 137 );
                    $pdf -> cell(137, 5, '/', 0, 1);
                    $pdf -> SetTextColor( 0, 0, 0 );
                }
            else
                {
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> cell(35, 5, 'Rijksregisternummer: ', 0, 0);
                    $pdf -> SetTextColor( 137, 137, 137 );
                    $pdf -> cell(55, 5, $llnRijkNR, 0, 1);
                    $pdf -> SetTextColor( 0, 0, 0 );
                }
        }
    else
        {
            $pdf -> cell(10, 5, '', 0, 0);
            $pdf -> cell(20, 5, 'Bisnummer: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(55, 5, $llnRijkNR, 0, 1);
            $pdf -> SetTextColor( 0, 0, 0 );
        }
    
    $pdf -> Ln(2);    
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(20, 5, 'Godsdienst: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(153, 5, $llnGods, 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> Ln(2);
    
    foreach ($gegLln as $gegLlnInhoud)
        {
            $pdf -> cell(10, 5, '', 0, 0);  
            $pdf -> cell(5, 5, '•', 0, 0);
            $pdf -> cell(175, 5, $gegLlnInhoud["SOORT"], 0, 1);
            $pdf -> cell(15, 5, '', 0, 0);
            $pdf -> cell(175, 5, $gegLlnInhoud["GEG"], 0, 1);
            $pdf -> cell(15, 5, '', 0, 0);
            $pdf -> MultiCell(180, 5, $gegLlnInhoud["BESCHR"], 0, 1);
            $pdf -> Ln(2);
        }
    
    $pdf -> cell(10, 10, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Straatnaam huisnummer (bus)', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Postcode woonplaats', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Land', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(5);   
     
    $pdf -> AddPage('P', 'A4'); 
     
    // Gegevens relaties
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Gegevens relatie', 0,1);
    $pdf -> Ln(2);    
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Voornaam Achternaam', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geslacht', 0, 1);
    $pdf -> Ln(2);    
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geboortedatum', 0, 1);
    $pdf -> Ln(2);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Telefoon', 0, 1); 
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(2);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'E-mail', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(2);      
    $pdf -> cell(10, 10, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Straatnaam huisnummer (bus)', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Postcode woonplaats', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Land', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(5);   
    
    $pdf -> AddPage('P', 'A4');
    
    // Loopbaan
    $pdf -> SetFont('Arial','B',11);;
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Loopbaan leerling', 0,1);
    $pdf -> Ln(2);
    // Loopbaan (0)
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'Schooljaar', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Graad jaar onderwijs', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Richting', 0, 1);
    $pdf -> Ln(2);
    // Loopbaan (-1/ ...)
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(175, 5, 'SCHOOLNAAM', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Schooljaar', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Graad jaar onderwijs', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Richting', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'Attest (Clausule)', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Advies klassenraad', 0, 1);
    $pdf -> Ln(5);
    
    $pdf -> AddPage('P', 'A4');
    
    // Vragenlijst
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Vragenlijst', 0,1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '1', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Antwoord', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '2', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> Cell(5,5, '•', 0,0);
    $pdf -> cell(170, 5, 'Antwoord 1', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> Cell(5,5, '•', 0,0);
    $pdf -> cell(170, 5, 'Antwoord 2', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> Cell(5, 5, '•', 0,0);
    $pdf -> cell(170, 5, 'Antwoord 3', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '3', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Antwoord', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '4', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Antwoord', 0, 1);
    
    $pdf -> AddPage('P', 'A4');
    
    // Voorwaarden
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Voorwaarden', 0,1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[  ]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 1', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 2', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 3', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 4', 0, 1);
    $pdf -> Ln(5);
    
    // Hantekeningen
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Handtekeningen', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Leerling', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Ouder', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Directie', 0, 1, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Datum', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Datum', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Datum', 0, 1, 'C');
    $pdf -> cell(10, 30, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 0, 'C');
    $pdf -> cell(10, 30, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 0, 'C');
    $pdf -> cell(10, 30, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 1, 'C');
    $pdf -> Ln(5);
    
    // Commentaar
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Commentaar', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> MultiCell(180, 5, 'Tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst tekst...', 0, 1);
    
    // ...
    
    
    
    
    //$pdf -> AddPage('P', 'A4');
    
    
    // create PDF
    $pdf -> OutPut(); // download: 'DagUur_Inschrijving-Leerling.pdf', 'D'
    
?>
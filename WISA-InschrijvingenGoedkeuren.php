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
        <form action="AddLeerling.php" method="post" enctype="multipart/form-data">
            <table class="Inschrijvingsformulier_Table">
            <p>Inschrijvingen goedkeuren</p>
                <?php
                $_SESSION['schoolID'] = 4199;
                $schoolID = $_SESSION['schoolID'];
                $_SESSION['schoolNaam'] = 'Miniemeninstituut';
                $schoolNaam = $_SESSION['schoolNaam'];
                
                $schoolStraat = "Scholenstraat";
                $schoolHuisNR = '123';
                $schoolBus = 'b';
                if ($schoolBus == '')
                    {
                        $schoolAdres = $schoolStraat.' '.$schoolHuisNR;
                    }
                else
                    {
                        $schoolAdres = $schoolStraat.' '.$schoolHuisNR.' ('.$schoolBus.')';
                    }
                $schoolPost = '4010';
                $schoolPlaats = 'Somewhere Ville';
                
                $schoolTel = '016030563';
                $schoolFax = '022030564';
                $schoolEmail = 'info@Minlipinou.be';
                
                $schoolGeg = array("ID"=>$schoolID, "NAAM"=>ucwords(strtolower($schoolNaam)), "ADRES"=>ucwords(strtolower($schoolAdres)), "POST"=>$schoolPost, "PLAATS"=>ucwords(strtolower($schoolPlaats)), "TEL"=>$schoolTel, "FAX"=>$schoolFax, "EMAIL"=>$schoolEmail);

                $sqlInschrijvingen = "SELECT * FROM tbl_inschrijvingen";
                $resultInschrijvingen = $conn->query($sqlInschrijvingen);
                    if ($resultInschrijvingen->num_rows > 0) 
                        {
                            while($rowInschrijvingen = $resultInschrijvingen->fetch_assoc())
                                {
                                    $llnID = $rowInschrijvingen['fld_persoon_id_fk'];
                                    $lln = array();
                                    $sqlZoekLln = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$llnID."'";
                                    $infoLln = $conn->query($sqlZoekLln);
                                    if ($infoLln->num_rows > 0) 
                                        {
                                            while($row = $infoLln->fetch_assoc())
                                                {
                                                    $llnNaam = $row['fld_persoon_naam'];
                                                    $llnGeslacht = $row['fld_persoon_geslacht'];
                                                    $llnGBDatum = $row['fld_persoon_gb_datum'];
                                                    $llnRijkNR = $row['fld_persoon_register_nr'];
                                                    $llnBisNR = $row['fld_persoon_bis_nr'];
                                                    
                                                    $llnGBPlaatsID = $row['fld_persoon_gb_plaats'];
                                                    $sqlGBPlaats = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$llnGBPlaatsID."'";
                                                    $infoGBPlaats = $conn->query($sqlGBPlaats);
                                                    if ($infoGBPlaats->num_rows > 0)
                                                        {
                                                            while($rowGBPlaats = $infoGBPlaats->fetch_assoc())
                                                                {
                                                                    $llnGBPlaats = ucfirst(strtolower($rowGBPlaats['fld_woonplaats_naam']));
                                                                }
                                                        }
                                                    else
                                                        {
                                                            $llnGBPlaats = $row['fld_persoon_gb_plaats'];
                                                        }
                                                    
                                                    $llnNationID = $row['fld_persoon_nation_id_fk'];
                                                    $sqlNation = "SELECT * FROM tbl_nationaliteiten WHERE fld_nation_id='".$llnNationID."'";
                                                    $infoNation = $conn->query($sqlNation);
                                                    if ($infoNation->num_rows > 0) 
                                                        {
                                                            while($rowNation = $infoNation->fetch_assoc())
                                                                {
                                                                    $llnNation = $rowNation['fld_nation_nation'];
                                                                }
                                                        }
                                                    
                                                    $llnGodsID = $row['fld_godsdienst_id_fk'];
                                                    $sqlGods = "SELECT * FROM tbl_godsdiensten WHERE fld_godsdienst_id='".$llnGodsID."'";
                                                    $infoGods = $conn->query($sqlGods);
                                                    if ($infoGods->num_rows > 0) 
                                                        {
                                                            while($rowGods = $infoGods->fetch_assoc())
                                                                {
                                                                    $llnGods = $rowGods['fld_godsdienst_naam'];
                                                                }
                                                        }
                                                }
                                            $lln = array("ID"=>$llnID, "NAAM"=>$llnNaam, "GESLACHT"=>$llnGeslacht, "DATUM"=>(date('d/m/Y', strtotime($llnGBDatum))), "GBPLAATS"=>$llnGBPlaats, "NATION"=>$llnNation, "RIJKNR"=>$llnRijkNR, "BISNR"=>$llnBisNR, "GODS"=>$llnGods);
                                        }
                                              
                                    // Lln geg
                                    $gegLln = array();
                                    $sqlGegLln = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$llnID."' ORDER BY fld_soort_id_fk";
                                    $infoGegLln = $conn->query($sqlGegLln);
                                    $aantalLlnGeg = mysqli_num_rows($infoGegLln);
                                    if ($infoGegLln->num_rows > 0)
                                        {
                                            $a = 0;
                                            
                                            while(($row = $infoGegLln->fetch_assoc()) && $a < $aantalLlnGeg)
                                                {
                                                    
                                                    $gegLln[$a] = array();
                                                    
                                                    $Beschr = $row['fld_persoon_gegeven_beschrijving'];
                                                    
                                                    
                                                    $soortGegID = $row['fld_soort_id_fk'];
                                                    $sqlSoortGeg = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortGegID."'";
                                                    $infoSoortGeg = $conn->query($sqlSoortGeg);
                                                    if ($infoSoortGeg->num_rows > 0)
                                                        {
                                                            while($rowSoort = $infoSoortGeg->fetch_assoc())
                                                                {
                                                                    $Soort = $rowSoort['fld_soort_naam'];
                                                                }
                                                                
                                                        }
                                                    $inhoudGegID = $row['fld_gegeven_id_fk'];
                                                    $sqlInhoudGeg = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$inhoudGegID."'";
                                                    $infoInhoudGeg = $conn->query($sqlInhoudGeg);
                                                    if ($infoInhoudGeg->num_rows > 0)
                                                        {
                                                            while($rowInhoud = $infoInhoudGeg->fetch_assoc())
                                                                {
                                                                    $Gegeven = $rowInhoud['fld_gegeven_inhoud'];
                                                                    
                                                                    $gegevenSoortID = $rowInhoud['fld_gegeven_soort_id_fk'];
                                                                    $sqlGegevenSoort = "SELECT * FROM tbl_gegevens_soorten WHERE fld_gegeven_soort_id='".$gegevenSoortID."'";
                                                                    $infoGegevenSoort = $conn->query($sqlGegevenSoort);
                                                                    if ($infoGegevenSoort->num_rows > 0)
                                                                        {
                                                                            while($rowGegSoort = $infoGegevenSoort->fetch_assoc())
                                                                                {
                                                                                    $gegevenSoort = $rowGegSoort['fld_gegeven_soort_naam'];
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                        
                                                    $gegLln[$a] = array("SOORT"=>strtoupper($gegevenSoort).": ".strtolower($Soort), "GEG"=>$Gegeven, "BESCHR"=>$Beschr);
                                                    array_push($gegLln, $gegLln[$a]);
                                                    ++$a;
                                                    
                                                    
                                                }
                                                $noMultiArray = array_map('serialize', $gegLln);
                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                $gegLln = array_map('unserialize', $unique_noMultiArray);
                                        }
                                    // Lln adres
                                    $adresLln = array();
                                    $sqlAdresLln = "SELECT * FROM tbl_adressen_linken WHERE fld_persoon_id_fk='".$llnID."' ORDER BY fld_soort_id_fk";
                                    $infoAdresLln = $conn->query($sqlAdresLln);
                                    $aantalAdresLln = mysqli_num_rows($infoAdresLln);
                                    if ($infoAdresLln->num_rows > 0)
                                        {
                                            $a = 0;
                                            
                                            while(($row = $infoAdresLln->fetch_assoc()) && $a < $aantalAdresLln)
                                                {
                                                    $adresLln[$a] = array();
                                                    
                                                    $BeschrALln = $row['fld_adres_link_beschrijving'];
                                                    
                                                    $soortAdresID = $row['fld_soort_id_fk'];
                                                    $sqlSoortAdres = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortAdresID."'";
                                                    $infoSoortAdres = $conn->query($sqlSoortAdres);
                                                    if ($infoSoortAdres->num_rows > 0)
                                                        {
                                                            while($rowSoort = $infoSoortAdres->fetch_assoc())
                                                                {
                                                                    $SoortALln = $rowSoort['fld_soort_naam'];
                                                                }
                                                        }
                                                    $inhoudAdresID = $row['fld_adres_id_fk'];
                                                    $sqlInhoudAdres = "SELECT * FROM tbl_adressen WHERE fld_adres_id='".$inhoudAdresID."'";
                                                    $infoInhoudAdres = $conn->query($sqlInhoudAdres);
                                                    if ($infoInhoudAdres->num_rows > 0)
                                                        {
                                                            while($rowInhoud = $infoInhoudAdres->fetch_assoc())
                                                                {
                                                                    $StraatALln = $rowInhoud['fld_adres_straatnaam'];
                                                                    $HuisALln = $rowInhoud['fld_adres_huis_nr'];
                                                                    $BusALln = $rowInhoud['fld_adres_bus_nr'];
                                                                    
                                                                    if ($rowInhoud['fld_adres_postcode_id_fk'] != "")
                                                                        {
                                                                            $postID = $rowInhoud['fld_adres_postcode_id_fk'];
                                                                            $sqlPost = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$postID."'";
                                                                            $infoPost = $conn->query($sqlPost);
                                                                            if ($infoPost->num_rows > 0)
                                                                                {
                                                                                    while($rowPost = $infoPost->fetch_assoc())
                                                                                        {
                                                                                            $PostALln = $rowPost['fld_postnummer'];
                                                                                            $PlaatsALln = $rowPost['fld_woonplaats_naam'];
                                                                                        }
                                                                                }
                                                                        }
                                                                    elseif ($rowInhoud['fld_adres_postcode_id_fk'] == "")
                                                                        {
                                                                            $PostALln = "";
                                                                            $PlaatsALln = $rowPost['fld_adres_niet_be'];
                                                                        }
                                                                        
                                                                    $landID = $rowInhoud['fld_adres_land_id_fk'];
                                                                    $sqlLand = "SELECT * FROM tbl_landen WHERE fld_land_id='".$landID."'";
                                                                    $infoLand = $conn->query($sqlLand);
                                                                    if ($infoLand->num_rows > 0)
                                                                        {
                                                                            while($rowLand = $infoLand->fetch_assoc())
                                                                                {
                                                                                    $LandALln = $rowLand['fld_land_naam'];
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                        
                                                    $adresLln[$a] = array("SOORT"=>"ADRES: ".strtolower($SoortALln), "STRAAT"=>$StraatALln, "HUIS"=>$HuisALln, "BUS"=>$BusALln, "POST"=>$PostALln, "PLAATS"=>$PlaatsALln, "LAND"=>$LandALln, "BESCHR"=>$BeschrALln);
                                                    array_push($adresLln, $adresLln[$a]);
                                                    ++$a;
                                                }
                                                $noMultiArray = array_map('serialize', $adresLln);
                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                $adresLln = array_map('unserialize', $unique_noMultiArray);
                                                //print_r($adresLln)."<br/>";                
                                        }
                                    
                                    // Lln relaties
                                    $relatieLln = array();
                                    $sqlRelatieLln = "SELECT * FROM tbl_personen_linken WHERE fld_child_id_fk='".$llnID."' ORDER BY fld_soort_id_fk";
                                    $infoRelatieLln = $conn->query($sqlRelatieLln);
                                    $aantalRelatieLln = mysqli_num_rows($infoRelatieLln);
                                    if ($infoRelatieLln->num_rows > 0)
                                        {
                                            $a = 0;
                                            
                                            while(($row = $infoRelatieLln->fetch_assoc()) && $a < $aantalRelatieLln)
                                                {
                                                    $relatieLln[$a] = array();
                                                    
                                                    $BeschrRLln = $row['fld_persoon_link_beschrijving'];
                                    
                                                    $soortRelatieID = $row['fld_soort_id_fk'];
                                                    $sqlSoortRelatie = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortRelatieID."'";
                                                    $infoSoortRelatie = $conn->query($sqlSoortRelatie);
                                                    if ($infoSoortRelatie->num_rows > 0)
                                                        {
                                                            while($rowSoort = $infoSoortRelatie->fetch_assoc())
                                                                {
                                                                    $SoortRLln = $rowSoort['fld_soort_naam'];
                                                                }
                                                        }
                                                        
                                                    $masterID = $row['fld_master_id_fk'];
                                                    $sqlMaster = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$masterID."'";
                                                    $infoMaster = $conn->query($sqlMaster);
                                                    if ($infoMaster->num_rows > 0)
                                                        {
                                                            while($rowMaster = $infoMaster->fetch_assoc())
                                                                {
                                                                    $NaamRLln = $rowMaster['fld_persoon_naam'];
                                                                    $GeslachtRLln = $rowMaster['fld_persoon_geslacht'];
                                                                    $GbRLln = $rowMaster['fld_persoon_gb_datum'];
                                                                    $OverledenRLln = $rowMaster['fld_persoon_overleden'];
                                                                }
                                                        }
                                                    //  
                                                    $gegR = array();  
                                                    $sqlGegR = "SELECT * FROM tbl_personen_gegevens WHERE fld_persoon_id_fk='".$masterID."' ORDER BY fld_soort_id_fk";
                                                    $infoGegR = $conn->query($sqlGegR);
                                                    $aantalGegR = mysqli_num_rows($infoGegR);
                                                    if ($infoGegR->num_rows > 0)
                                                        {
                                                            $b = 0;
                                                                                       
                                                            while(($rowR = $infoGegR->fetch_assoc()) && $a < $aantalGegR)
                                                                {
                                                                    
                                                                    $gegR[$b] = array();
                                                                    
                                                                    $BeschrGegR = $rowR['fld_persoon_gegeven_beschrijving'];
                                                                    
                                                                    
                                                                    $soortGegRID = $rowR['fld_soort_id_fk'];
                                                                    $sqlSoortGegR = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortGegRID."'";
                                                                    $infoSoortGegR = $conn->query($sqlSoortGegR);
                                                                    if ($infoSoortGegR->num_rows > 0)
                                                                        {
                                                                            while($rowSoortR = $infoSoortGegR->fetch_assoc())
                                                                                {
                                                                                    $SoortR = $rowSoortR['fld_soort_naam'];
                                                                                }
                                                                                
                                                                        }
                                                                    $inhoudGegRID = $rowR['fld_gegeven_id_fk'];
                                                                    $sqlInhoudGegR = "SELECT * FROM tbl_gegevens WHERE fld_gegeven_id='".$inhoudGegRID."'";
                                                                    $infoInhoudGegR = $conn->query($sqlInhoudGegR);
                                                                    if ($infoInhoudGegR->num_rows > 0)
                                                                        {
                                                                            while($rowInhoudR = $infoInhoudGegR->fetch_assoc())
                                                                                {
                                                                                    $GegevenR = $rowInhoudR['fld_gegeven_inhoud'];
                                                                                    
                                                                                    $gegevenSoortRID = $rowInhoudR['fld_gegeven_soort_id_fk'];
                                                                                    $sqlGegevenSoortR = "SELECT * FROM tbl_gegevens_soorten WHERE fld_gegeven_soort_id='".$gegevenSoortRID."'";
                                                                                    $infoGegevenSoortR = $conn->query($sqlGegevenSoortR);
                                                                                    if ($infoGegevenSoortR->num_rows > 0)
                                                                                        {
                                                                                            while($rowGegSoortR = $infoGegevenSoortR->fetch_assoc())
                                                                                                {
                                                                                                    $gegevenSoortR = $rowGegSoortR['fld_gegeven_soort_naam'];
                                                                                                }
                                                                                        }
                                                                                }
                                                                        }
                                                                    $gegR[$b] = array("SOORT"=>strtoupper($gegevenSoortR).": ".strtolower($SoortR), "GEG"=>$GegevenR, "BESCHR"=>$BeschrGegR);
                                                                    array_push($gegR, $gegR[$b]);
                                                                    ++$b;
                                                                }
                                                                $noMultiArray = array_map('serialize', $gegR);
                                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                                $gegR = array_map('unserialize', $unique_noMultiArray);
                                                        }
                                                    $adresR = array();
                                                    $sqlAdresR = "SELECT * FROM tbl_adressen_linken WHERE fld_persoon_id_fk='".$masterID."' ORDER BY fld_soort_id_fk";
                                                    $infoAdresR = $conn->query($sqlAdresR);
                                                    $aantalAdresR = mysqli_num_rows($infoAdresR);
                                                    if ($infoAdresR->num_rows > 0)
                                                        {
                                                            $c = 0;
                                                            
                                                            while(($rowAdresR = $infoAdresR->fetch_assoc()) && $a < $aantalAdresR)
                                                                {
                                                                    $adresR[$c] = array();
                                                                    
                                                                    $BeschrAR = $rowAdresR['fld_adres_link_beschrijving'];
                                                                    
                                                                    $soortAdresID = $rowAdresR['fld_soort_id_fk'];
                                                                    $sqlSoortAdres = "SELECT * FROM tbl_soorten WHERE fld_soort_id='".$soortAdresID."'";
                                                                    $infoSoortAdres = $conn->query($sqlSoortAdres);
                                                                    if ($infoSoortAdres->num_rows > 0)
                                                                        {
                                                                            while($rowSoort = $infoSoortAdres->fetch_assoc())
                                                                                {
                                                                                    $SoortAR = $rowSoort['fld_soort_naam'];
                                                                                }
                                                                        }
                                                                    $inhoudAdresID = $rowAdresR['fld_adres_id_fk'];
                                                                    $sqlInhoudAdres = "SELECT * FROM tbl_adressen WHERE fld_adres_id='".$inhoudAdresID."'";
                                                                    $infoInhoudAdres = $conn->query($sqlInhoudAdres);
                                                                    if ($infoInhoudAdres->num_rows > 0)
                                                                        {
                                                                            while($rowInhoud = $infoInhoudAdres->fetch_assoc())
                                                                                {
                                                                                    $StraatAR = $rowInhoud['fld_adres_straatnaam'];
                                                                                    $HuisAR = $rowInhoud['fld_adres_huis_nr'];
                                                                                    $BusAR = $rowInhoud['fld_adres_bus_nr'];
                                                                                    
                                                                                    if ($rowInhoud['fld_adres_postcode_id_fk'] != "")
                                                                                        {
                                                                                            $postID = $rowInhoud['fld_adres_postcode_id_fk'];
                                                                                            $sqlPost = "SELECT * FROM tbl_postcodes WHERE fld_postcode_id='".$postID."'";
                                                                                            $infoPost = $conn->query($sqlPost);
                                                                                            if ($infoPost->num_rows > 0)
                                                                                                {
                                                                                                    while($rowPost = $infoPost->fetch_assoc())
                                                                                                        {
                                                                                                            $PostAR = $rowPost['fld_postnummer'];
                                                                                                            $PlaatsAR = $rowPost['fld_woonplaats_naam'];
                                                                                                        }
                                                                                                }
                                                                                        }
                                                                                    elseif ($rowInhoud['fld_adres_postcode_id_fk'] == "")
                                                                                        {
                                                                                            $PostAR = "";
                                                                                            $PlaatsAR = $rowPost['fld_adres_niet_be'];
                                                                                        }
                                                                                        
                                                                                    $landID = $rowInhoud['fld_adres_land_id_fk'];
                                                                                    $sqlLand = "SELECT * FROM tbl_landen WHERE fld_land_id='".$landID."'";
                                                                                    $infoLand = $conn->query($sqlLand);
                                                                                    if ($infoLand->num_rows > 0)
                                                                                        {
                                                                                            while($rowLand = $infoLand->fetch_assoc())
                                                                                                {
                                                                                                    $LandAR = $rowLand['fld_land_naam'];
                                                                                                }
                                                                                        }
                                                                                }
                                                                        }
                                                                    $adresR[$c] = array("SOORT"=>"ADRES: ".strtolower($SoortAR), "STRAAT"=>$StraatAR, "HUIS"=>$HuisAR, "BUS"=>$BusAR, "POST"=>$PostAR, "PLAATS"=>$PlaatsAR, "LAND"=>$LandAR, "BESCHR"=>$BeschrAR);
                                                                    array_push($adresR, $adresR[$c]);
                                                                    ++$c;
                                                                }
                                                                $noMultiArray = array_map('serialize', $adresR);
                                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                                $adresR = array_map('unserialize', $unique_noMultiArray);               
                                                            }
                                                            
                                                    $relatieLln[$a] = array("SOORT"=>strtolower($SoortRLln), "NAAM"=>$NaamRLln, "GESLACHT"=>$GeslachtRLln, "GEBOORTE"=>(date('d/m/Y', strtotime($GbRLln))), "OVER"=>$OverledenRLln, "BESCHR"=>$BeschrRLln, "GEGR"=>$gegR, "ADRESR"=>$adresR);
                                                    array_push($relatieLln, $relatieLln[$a]);
                                                    ++$a;
                                                }
                                                $noMultiArray = array_map('serialize', $relatieLln);
                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                $relatieLln = array_map('unserialize', $unique_noMultiArray);              
                                        }                    
                                    
                                    // loopbaan lln
                                    
                                    $loopbaanLln = array();
                                    $sqlLoopbaanLln = "SELECT * FROM tbl_loopbanen WHERE fld_persoon_id_fk='".$llnID."' ORDER BY fld_loopbaan_schooljaar DESC";
                                    $infoLoopbaanLln = $conn->query($sqlLoopbaanLln);
                                    $aantalLoopbaanLln = mysqli_num_rows($infoLoopbaanLln);
                                    if ($infoLoopbaanLln->num_rows > 0)
                                        {
                                            $a = 0;
                                            
                                            while(($row = $infoLoopbaanLln->fetch_assoc()))
                                                {
                                                    $loopbaanLln[$a] = array();
                                                    
                                                    $SchooljaarL = $row['fld_loopbaan_schooljaar'];
                                                    $BDatumL = $row["fld_loopbaan_b_datum"];
                                                    $EDatumL = $row["fld_loopbaan_e_datum"];
                                                    $adviesRaad = $row["fld_loopbaan_advies_klassenraad"];
                                                    $attest = $row["fld_loopbaan_attest"];
                                                    $clausule = $row["fld_loopbaan_clausule"];
                                                    
                                                    $schoolID = $row['fld_school_id_fk'];
                                                    $sqlSchool = "SELECT * FROM tbl_scholen WHERE fld_school_id='".$schoolID."'";
                                                    $infoSchool = $conn->query($sqlSchool);
                                                    if ($infoSchool->num_rows > 0)
                                                        {
                                                            while($rowSchool = $infoSchool->fetch_assoc())
                                                                {
                                                                    $SchoolL = $rowSchool['fld_school_naam'];
                                                                }
                                                        }
                                                    $richtingID = $row['fld_richting_id_fk'];
                                                    $sqlRichting = "SELECT * FROM tbl_richtingen WHERE fld_richting_id='".$richtingID."'";
                                                    $infoRichting = $conn->query($sqlRichting);
                                                    if ($infoRichting->num_rows > 0)
                                                        {
                                                            while($rowRichting = $infoRichting->fetch_assoc())
                                                                {
                                                                    $RichtingL = $rowRichting['fld_richting_naam'];
                                                                    $RichtingGraad = $rowRichting['fld_richting_graad'];
                                                                    $RichtingJaar = $rowRichting['fld_richting_leerjaar'];
                                                                    $RichtingVorm = $rowRichting["fld_richting_onderwijsvorm"];
                                                                }
                                                        }
                                                    $klasID = $row['fld_school_id_fk'];
                                                    $sqlKlas = "SELECT * FROM tbl_klassen WHERE fld_klas_id='".$klasID."'";
                                                    $infoKlas = $conn->query($sqlKlas);
                                                    if ($infoKlas->num_rows > 0)
                                                        {
                                                            while($rowKlas = $infoKlas->fetch_assoc())
                                                                {
                                                                    $KlasL = $rowKlas['fld_klas_afkorting'];
                                                                }
                                                        }
                                                    else
                                                        {
                                                            $KlasL = '';
                                                        }
                                                    $loopbaanLln[$a] = array("SCHOOL"=>$SchoolL, "JAAR"=>$SchooljaarL, "RICHTING"=>$RichtingL, "GRAAD"=>$RichtingGraad, "LEERJAAR"=>strtolower($RichtingJaar), "VORM"=>$RichtingVorm,"KLAS"=>$KlasL, "BEGIN"=>(date('d/m/Y', strtotime($BDatumL))), "EIND"=>(date('d/m/Y', strtotime($EDatumL))), "ATTEST"=>strtoupper($attest), "CLAUSULE"=>$clausule, "ADVIES"=>$adviesRaad);
                                                    array_push($loopbaanLln, $loopbaanLln[$a]);
                                                    ++$a;
                                                }
                                                $noMultiArray = array_map('serialize', $loopbaanLln);
                                                $unique_noMultiArray = array_unique($noMultiArray);
                                                $loopbaanLln = array_map('unserialize', $unique_noMultiArray);
                                        }
                                    
                                    
                                    // VRAGENLIJST
                                    $vragenlijst = array();
                                    $sqlVragenlijst = "SELECT * FROM tbl_vragen WHERE fld_vraag_zichtbaar='1'";
                                    $infoVragenlijst = $conn->query($sqlVragenlijst);
                                    $aantalVragenlijst = mysqli_num_rows($infoVragenlijst);
                                    if ($infoVragenlijst->num_rows > 0)
                                        {
                                            $a = 0;
                                            
                                            while(($row = $infoVragenlijst->fetch_assoc()))  
                                                {
                                                    //echo '<br />jes ';
                                                    $vraag[$a] = array();
                                                    
                                                    $vraagID = $row['fld_vraag_id'];
                                                    $vraagVraag = $row["fld_vraag_vraag"];
                                                    
                                                    if ($row["fld_antwoord_type_k_tekst"] == 1)
                                                        {
                                                            //echo "soort: ktekst";
                                                            $vraagType = 'ktekst';
                                                            
                                                            $sqlAntwoord = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                            $infoAntwoord = $conn->query($sqlAntwoord);
                                                            if ($infoAntwoord->num_rows > 0)
                                                                {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                    {
                                                                        $antwoordenlijst[$b] = $rowAntwoord["fld_antwoord_k_tekst"];
                                                                    }
                                                            }
                                                    }
                                                elseif ($row["fld_antwoord_type_l_tekst"] == 1)
                                                    {
                                                        //echo "soort: ltekst";
                                                        $vraagType = 'ltekst';
                                                        
                                                        $sqlAntwoord = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                        $infoAntwoord = $conn->query($sqlAntwoord);
                                                        if ($infoAntwoord->num_rows > 0)
                                                            {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                    {
                                                                        $antwoordenlijst[$b] = $rowAntwoord["fld_antwoord_l_tekst"];
                                                                    }
                                                            }
                                                    }
                                                elseif ($row["fld_antwoord_type_num"] == 1)
                                                    {
                                                        //echo "soort: num";
                                                        $vraagType = 'num';
                                                        
                                                        $sqlAntwoord = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                        $infoAntwoord = $conn->query($sqlAntwoord);
                                                        if ($infoAntwoord->num_rows > 0)
                                                            {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                    {
                                                                        $antwoordenlijst[$b] = $rowAntwoord["fld_antwoord_num"];
                                                                    }
                                                            }
                                                    }
                                                elseif ($row["fld_antwoord_type_datum"] == 1)
                                                    {
                                                        //echo "soort: datum";
                                                        $vraagType = 'datum';
                                                        
                                                        $sqlAntwoord = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                        $infoAntwoord = $conn->query($sqlAntwoord);
                                                        if ($infoAntwoord->num_rows > 0)
                                                            {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                    {
                                                                        $antwoordenlijst[$b]= (date('d/m/Y', strtotime($rowAntwoord["fld_antwoord_datum"])));
                                                                    }
                                                            }
                                                    }
                                                elseif ($row["fld_antwoord_type_jn"] == 1)
                                                    {
                                                        //echo "soort: j/n";
                                                        $vraagType = 'j/n';
                                                        
                                                        $sqlAntwoord = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                        $infoAntwoord = $conn->query($sqlAntwoord);
                                                        if ($infoAntwoord->num_rows > 0)
                                                            {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                    {
                                                                        $antwoordInhoud = $rowAntwoord["fld_antwoord_j/n"];
                                                                        if ($antwoordInhoud == 1)
                                                                            {
                                                                                $antwoordenlijst[$b] = "Ja";
                                                                            }
                                                                        elseif ($antwoordInhoud == 0)
                                                                            {
                                                                                $antwoordenlijst[$b] = "Nee";
                                                                            }
                                                                    }
                                                            }
                                                    }
                                                elseif ($row["fld_antwoord_type_foto"] == 1)
                                                    {
                                                        //echo "soort: foto";
                                                        $vraagType = 'foto';
                                                        
                                                        $antwoordenlijst = array("0"=>"foto");
                                                    }
                                                elseif ($row["fld_antwoord_type_doc"] == 1)
                                                    {
                                                        //echo "soort: doc";
                                                        $vraagType = 'doc';
                                                        
                                                        $antwoordenlijst = array("0"=>"doc");
                                                    }
                                                elseif ($row["fld_antwoord_type_lijst"] == 1)
                                                    {
                                                        //echo "soort: lijst";
                                                        $vraagType = 'lijst';
                                                        
                                                        $antwoordenlijst = array();
                                                        $sqlAntwoordenLijst = "SELECT * FROM tbl_antwoorden WHERE fld_persoon_id_fk='".$lln["ID"]."' AND fld_vraag_id_fk='".$vraagID."'";
                                                        $infoAntwoordenLijst = $conn->query($sqlAntwoordenLijst);
                                                        if ($infoAntwoordenLijst->num_rows > 0)
                                                            {
                                                                $b = 0;
                                                                
                                                                while($rowAntwoordenLijst = $infoAntwoordenLijst->fetch_assoc())
                                                                    {
                                                                        $antwoordID = $rowAntwoordenLijst['fld_antwoord_lijst_id_fk'];
                                                                        $sqlAntwoord = "SELECT * FROM tbl_antwoorden_lijst WHERE fld_lijst_id='".$antwoordID."'";
                                                                        $infoAntwoord = $conn->query($sqlAntwoord);
                                                                        if ($infoAntwoord->num_rows > 0)
                                                                            {
                                                                                 while($rowAntwoord = $infoAntwoord->fetch_assoc())
                                                                                    {
                                                                                        $antwoordenlijst[$b] = $rowAntwoord["fld_lijst_item"];
                                                                                    }
                                                                            }
                                                                        ++$b;
                                                                    }
                                                            }
                                                        //print_r($antwoordenlijst);
                                                        //echo "<br/>";
                                                    }
                                                    
                                                $vraag[$a] = array("ID"=>$vraagID, "VRAAG"=>$vraagVraag, "TYPE"=>$vraagType, "ANTWOORDEN"=>$antwoordenlijst);
                                                array_push($vragenlijst, $vraag[$a]);
                                                ++$a;
                                            }
                                        $noMultiArray = array_map('serialize', $vragenlijst);
                                        $unique_noMultiArray = array_unique($noMultiArray);
                                        $vragenlijst = array_map('unserialize', $unique_noMultiArray);
                                    }
                                    
                                    
                                // INSCHRIJVING GEG
                                $inschrijvingGeg = array();
                                $sqlInschr = "SELECT * FROM tbl_inschrijvingen WHERE fld_persoon_id_fk='".$llnID."'";
                                $infoInschr = $conn->query($sqlInschr);
                                if ($infoInschr->num_rows > 0) 
                                    {
                                        while($row = $infoInschr->fetch_assoc())
                                            {
                                                $inschrijvingID = $row["fld_inschrijving_id"];
                                                $inschrijvingDatum = $row['fld_inschrijving_datum'];
                                                $inschrijvingUDatum = $row['fld_inschrijving_update_datum'];
                                                $inschrijvingComm = $row['fld_inschrijving_commentaar'];
                                                
                                                $inschrijvingStatusID = $row['fld_inschrijving_status_id_fk'];
                                                $sqlStatus = "SELECT * FROM tbl_inschrijvingen_statussen WHERE fld_inschrijving_status_id='".$inschrijvingStatusID."'";
                                                $infoStatus = $conn->query($sqlStatus);
                                                if ($infoStatus->num_rows > 0)
                                                    {
                                                        while($rowStatus = $infoStatus->fetch_assoc())
                                                            {
                                                                $inschrijvingStatus = $rowStatus['fld_inschrijving_status_naam'];
                                                            }
                                                    }
                                                
                                                $inschrijverID = $row['fld_gebruiker_id_fk'];
                                                $sqlGebrui = "SELECT * FROM tbl_gebruikers WHERE fld_gebruiker_id='".$inschrijverID."'";
                                                $infoGebrui = $conn->query($sqlGebrui);
                                                if ($infoGebrui->num_rows > 0)
                                                    {
                                                        while($rowGebrui = $infoGebrui->fetch_assoc())
                                                            {
                                                                $inschrijverPersoonID = $rowGebrui['fld_persoon_id_fk'];
                                                                $sqlPersoon = "SELECT * FROM tbl_personen WHERE fld_persoon_id='".$inschrijverPersoonID."'";
                                                                $infoPersoon = $conn->query($sqlPersoon);
                                                                if ($infoPersoon->num_rows > 0)
                                                                    {
                                                                        while($rowPersoon = $infoPersoon->fetch_assoc())
                                                                            {
                                                                                $inschrijverNaam = $rowPersoon['fld_persoon_naam'];
                                                                            }
                                                                    }
                                                            }
                                                    }                    
                                            }
                                        $inschrijvingGeg = array("ID"=>$inschrijvingID, "DATUM"=>(date('d/m/Y', strtotime($inschrijvingDatum))), "STATUS"=>$inschrijvingStatus, "NAAM"=>$inschrijverNaam, "UPDATE"=>$inschrijvingUDatum, "COMM"=>$inschrijvingComm);
                                        //echo 'update:'.$inschrijvingGeg["UPDATE"].'.';
                                    }
                                    
                                
                                // instellingen
                                $instellingGeg = array();
                                $sqlInstell = "SELECT * FROM tbl_instellingen WHERE fld_school_id_fk='".$schoolGeg['ID']."'";
                                $infoInstell = $conn->query($sqlInstell);
                                if ($infoInstell->num_rows > 0)
                                    {
                                        while($rowInstell = $infoInstell->fetch_assoc())
                                            {
                                                $titelDoc = $rowInstell['fld_instelling_titel_doc'];
                                                $logoSchool = $rowInstell["fld_instelling_logo"];
                                                $handtekeningDigitaal = $rowInstell["fld_instelling_digitaal_handtekening"];
                                                
                                                $handtekeningLln = $rowInstell["fld_instelling_handtekening_leerling"];
                                                $handtekeningOuder = $rowInstell["fld_instelling_handtekening_ouder"];
                                                $handtekeningDirectie = $rowInstell["fld_instelling_handtekening_directie"];
                                                
                                                $handtekeningen = array();
                                                if ($handtekeningLln == 1)
                                                    {
                                                        $input = "Leerling";
                                                        array_push($handtekeningen, $input);
                                                    }
                                                if ($handtekeningOuder == 1)
                                                    {
                                                        $input = "Ouder / voogd";
                                                        array_push($handtekeningen, $input);
                                                    }
                                                if ($handtekeningDirectie == 1)
                                                    {
                                                        $input = "Directie";
                                                        array_push($handtekeningen, $input);
                                                    }                    
                                            }
                                        $instellingGeg = array("DOC"=>$titelDoc, "LOGO"=>$logoSchool, "DIGITAAL"=>$handtekeningDigitaal, "LLN"=>$handtekeningLln, "OUDER"=>$handtekeningOuder, "DIRECTIE"=>$handtekeningDirectie, "SIGNS"=>$handtekeningen);
                                    }
                                    
                                
                                // VOORWAARDEN
                                $voorwaardenlijst = array();
                                $sqlVoorwaarden = "SELECT * FROM tbl_inschrijvingen_voorwaarden_check WHERE fld_inschrijving_id_fk='".$inschrijvingGeg['ID']."'";
                                $infoVoorwaarden = $conn->query($sqlVoorwaarden);
                                if ($infoVoorwaarden->num_rows > 0)
                                    {
                                        $a = 0;
                                        
                                        while($row = $infoVoorwaarden->fetch_assoc())
                                            {
                                                $voorwaarde[$a] = array();
                                                
                                                $voorwaardeCheck = $row["fld_voorwaarde_check_check"];
                                                
                                                $voorwaardeID = $row["fld_inschrijving_voorwaarde_id_fk"];
                                                $sqlVoorwaarde = "SELECT * FROM tbl_inschrijvingen_voorwaarden WHERE fld_inschrijving_voorwaarde_id='".$voorwaardeID."'";
                                                $infoVoorwaarde = $conn->query($sqlVoorwaarde);
                                                if ($infoVoorwaarde->num_rows > 0)
                                                    {
                                                        while($rowVoorwaarde = $infoVoorwaarde->fetch_assoc())
                                                            {
                                                                $voorwaardeInhoud = $rowVoorwaarde["fld_inschrijving_voorwaarde_beschrijving"];
                                                                $voorwaardeLink = $rowVoorwaarde["fld_inschrijving_voorwaarde_link"];
                                                            }
                                                    }
                                                $voorwaarde[$a] = array("INHOUD"=>$voorwaardeInhoud, "LINK"=>$voorwaardeLink, "CHECK"=>$voorwaardeCheck);
                                                array_push($voorwaardenlijst, $voorwaarde[$a]);
                                                ++$a;
                                                
                                            }
                                        $noMultiArray = array_map('serialize', $voorwaardenlijst);
                                        $unique_noMultiArray = array_unique($noMultiArray);
                                        $voorwaardenlijst = array_map('unserialize', $unique_noMultiArray); 
                                    }
                                    
                                    echo "<button type='button' onclick='Open(&#34;Leerling_".$lln['ID']."&#34;)'>".$lln['NAAM']."</button>";
                                    echo "<button type='submit' name='".$lln['ID']."' id='".$lln['ID']."'>Goed</button>";
                                    echo "<div id='Leerling_".$lln['ID']."' style='display: none;'>";
                                        echo "Geslacht: ".$lln['GESLACHT']."<br />";
                                        echo "GBDatum: ".$lln['DATUM']."<br />";
                                        echo "GBPlaats: ".$lln['GBPLAATS']."<br />";
                                        echo "Nationaliteit: ".$lln['NATION']."<br />";
                                        
                                        if  ($lln['RIJKNR'] == ''){
                                            echo "Leerling Bisnr: ".$lln['BISNR']."<br />";
                                        }
                                        else {
                                            echo "Rijksregisternr: ".$lln['RIJKNR']."<br />";
                                        }
                                        
                                        echo "Leerling Godsdienst: ".$lln['GODS']."<br /><br />";
                                        foreach ($gegLln as $Gegeven){
                                            echo "Leerling Soort: ".$Gegeven['SOORT']."<br />";
                                            echo "Leerling Gegeven: ".$Gegeven['GEG']."<br />";
                                            echo "Leerling Gegeven: ".$Gegeven['BESCHR']."<br /><br />";
                                        }
                                        
                                    echo "</div>";
                                    
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
    
<script type="text/javascript">
<!--
	function Open(id){
	   document.getElementById(id).style.display = 'block';
	}
-->
</script>

</body>
</html>
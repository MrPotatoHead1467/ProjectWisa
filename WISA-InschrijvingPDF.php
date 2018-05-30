
<?php
    //session_start();

    require ("fpdf181/fpdf.php");
    include "WISA-Connection.php";
    
    // logo <img id='kamers_foto' src='data:image/jpeg;base64, ".base64_encode($_SESSION['schoolLogo'])."' width='350' height='350'/>
    //$_SESSION['schoolLogo'];
    
    // variabelen schooljaren
    $Jaar = date("Y");
    $Maand = date("m");
    if ($Maand >= 7)
        {
            $ditSchooljaar = $Jaar." - ".($Jaar + 1);
            $volgendSchooljaar = ($Jaar + 1)." - ".($Jaar + 2);
        }
    else 
        {
            $ditSchooljaar = ($Jaar - 1)." - ".$Jaar;
            $volgendSchooljaar = $Jaar." - ".($Jaar + 1);
        }
    
    // school gegevens: 
    $_SESSION['schoolID'] = 2532;
    $schoolID = $_SESSION['schoolID'];
    $_SESSION['schoolNaam'] = 'Miniemeninstituut';
    $schoolNaam = $_SESSION['schoolNaam'];
    
    $schoolStraat = "Diestsestraat";
    $schoolHuisNR = '163';
    $schoolBus = '';
    if ($schoolBus == '')
        {
            $schoolAdres = $schoolStraat.' '.$schoolHuisNR;
        }
    else
        {
            $schoolAdres = $schoolStraat.' '.$schoolHuisNR.' ('.$schoolBus.')';
        }
    $schoolPost = '3000';
    $schoolPlaats = 'Leuven';
    
    $schoolTel = '016319000';
    $schoolFax = '';
    $schoolEmail = 'info@miniemeninstituut.be';
    
    $schoolGeg = array("ID"=>$schoolID, "NAAM"=>ucwords(strtolower($schoolNaam)), "ADRES"=>ucwords(strtolower($schoolAdres)), "POST"=>$schoolPost, "PLAATS"=>ucwords(strtolower($schoolPlaats)), "TEL"=>$schoolTel, "FAX"=>$schoolFax, "EMAIL"=>$schoolEmail);
    // titel doc: 
    
    
    
    
    
    // lln id 
    $_SESSION['Leerling'] = 22;
    $llnID = 22;
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
                //print_r($gegLln);
        }
        /**
         * 
        foreach ($gegLln as $geg)
        {
            echo count($gegLln)."<br/>";
            echo $geg["SOORT"]."<br />";
            echo $geg["GEG"]."<br />";
            echo $geg["BESCHR"]."<br />";
        }
        
         */
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
                                //echo "gegR";
                                //print_r($gegR);
                                //echo "<br/>";
                        //
                        }
                    //echo "test3";
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
                                //print_r($adresLln)."<br/>";                
                            }
                            
                    $relatieLln[$a] = array("SOORT"=>strtolower($SoortRLln), "NAAM"=>$NaamRLln, "GESLACHT"=>$GeslachtRLln, "GEBOORTE"=>(date('d/m/Y', strtotime($GbRLln))), "OVER"=>$OverledenRLln, "BESCHR"=>$BeschrRLln, "GEGR"=>$gegR, "ADRESR"=>$adresR);
                    array_push($relatieLln, $relatieLln[$a]);
                    ++$a;
                }
                $noMultiArray = array_map('serialize', $relatieLln);
                $unique_noMultiArray = array_unique($noMultiArray);
                $relatieLln = array_map('unserialize', $unique_noMultiArray);
                //print_r($relatieLln);
                //echo "<br/>";                
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
                                    //echo 'link: '.$voorwaardeLink.'<br/>';
                                }
                        }
                    $voorwaarde[$a] = array("INHOUD"=>$voorwaardeInhoud, "LINK"=>$voorwaardeLink, "CHECK"=>$voorwaardeCheck);
                    array_push($voorwaardenlijst, $voorwaarde[$a]);
                    ++$a;
                    
                }
            $noMultiArray = array_map('serialize', $voorwaardenlijst);
            $unique_noMultiArray = array_unique($noMultiArray);
            $voorwaardenlijst = array_map('unserialize', $unique_noMultiArray); 
            //print_r($voorwaardenlijst);
            //echo "<br/>";
        }
    
    
    class PDF extends FPDF
        {
            function Header()   
                {
                    global $schoolGeg;
                    global $inschrijvingGeg;
                    global $instellingGeg;
                    
                    if (($this -> PageNo()) == 1)
                        {
                            $this -> Image('MIN_Print_Icon.png',20,10,30,30);
                            $this -> SetFont('Arial','B',10); 
                            //$this -> cell(190, 5, '', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $schoolGeg["NAAM"], 0, 1, 'L');
                            $this -> SetFont('Arial','',9); 
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $schoolGeg["ADRES"], 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, $schoolGeg['POST'].' '.$schoolGeg['PLAATS'], 0, 1, 'L');
                            // Tel
                            if ($schoolGeg['TEL'] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'Tel: '.$schoolGeg['TEL'], 0, 1, 'L');    
                                }
                            // Fax
                            if ($schoolGeg['FAX'] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'Fax: '.$schoolGeg['FAX'], 0, 1, 'L');    
                                }
                            // E-mail    
                            if ($schoolGeg["EMAIL"] == '')
                                {
                                    $this -> Ln(5);
                                }
                            else
                                {
                                    $this -> cell(50, 5, '', 0, 0, 'L');
                                    $this -> cell(140, 5, 'E-mail: '.$schoolGeg["EMAIL"], 0, 1, 'L');    
                                }
                            $this -> Ln(5);
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, $instellingGeg["DOC"], 0, 1, 'C');
                            $this -> Ln(2);
                            $this -> cell(190, 0, '', 1, 1, 'L');
                            $this -> Ln(5);
                        }
                        
                    if (($this -> PageNo()) > 1)
                        {
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, $instellingGeg["DOC"], 0, 1, 'C');
                            $this -> Ln(2);
                            $this -> cell(190, 0, '', 1, 1, 'C');
                            $this -> Ln(5);
                        }
                }
            function Footer()   
                {
                    global $schoolGeg;
                    global $lln;
                    
                    $this -> SetY( -20 );
                    $this -> SetFont('Arial','B',10);
                    
                    $this -> Ln(5);
                    $this -> cell(190, 0, '', 1, 1, 'C');
                    $this -> Ln(2);
                    $this -> cell(170, 5, $schoolGeg["NAAM"].' | Inschrijving '.$lln["NAAM"], 0, 0);
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
    $pdf -> cell(175, 5, strtoupper($inschrijvingGeg["STATUS"]), 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(32, 5, 'Inschrijvingsdatum: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(30, 5, $inschrijvingGeg["DATUM"], 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(32, 5, 'Ingeschreven door: ', 0, 0);
    $pdf -> SetTextColor( 137, 137, 137 );
    $pdf -> cell(50, 5, $inschrijvingGeg["NAAM"], 0, 1);
    $pdf -> SetTextColor( 0, 0, 0 );
    if ($inschrijvingGeg["UPDATE"] != '')
        {   
            $pdf -> Ln(2);
            $pdf -> cell(5, 5, '', 0, 0);
            $pdf -> cell(28, 5, 'Laatst gewijzigd: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(50, 5, $inschrijvingGeg["UPDATE"], 0, 1);
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
    
    foreach ($gegLln as $gegLln)
        {
            $pdf -> cell(10, 5, '', 0, 0);  
            $pdf -> cell(5, 5, '•', 0, 0);
            $pdf -> cell(175, 5, $gegLln["SOORT"], 0, 1);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(15, 5, '', 0, 0);
            $pdf -> cell(175, 5, $gegLln["GEG"], 0, 1);
            if ($gegLln["BESCHR"] != "")
                {
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> MultiCell(180, 5, '('.$gegLln["BESCHR"].')', 0, 1);
                }
            $pdf -> SetTextColor( 0, 0, 0 );
            $pdf -> Ln(2);
        }
    
    foreach ($adresLln as $adresLln)
        {
            $pdf -> cell(10, 5, '', 0, 0);  
            $pdf -> cell(5, 5, '•', 0, 0);
            $pdf -> cell(175, 5, $adresLln["SOORT"], 0, 1);
            $pdf -> SetTextColor( 137, 137, 137 );
            if ($adresLln['BUS'] != "")
                {
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> cell(175, 5, $adreLln['STRAAT']." ".$adresLln['HUIS']." (".$adresLln['BUS'].")", 0, 1);
                }
            elseif ($adresLln['BUS'] == "")
                {
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> cell(175, 5, $adresLln['STRAAT']." ".$adresLln['HUIS'], 0, 1);
                }
            $pdf -> cell(15, 5, '', 0, 0);
            $pdf -> cell(175, 5, $adresLln["POST"]." ".$adresLln["PLAATS"], 0, 1);
            $pdf -> cell(15, 5, '', 0, 0);
            $pdf -> cell(175, 5, $adresLln["LAND"], 0, 1);
            if ($adresLln["BESCHR"] != "")
                {
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> MultiCell(180, 5, '('.$adresLln["BESCHR"].')', 0, 1);
                }
            $pdf -> SetTextColor( 0, 0, 0 );
            $pdf -> Ln(2);
        }
     
    $pdf -> AddPage('P', 'A4');
     
     
    // relaties
    foreach ($relatieLln as $gegRelatie)
        {
            $pdf -> SetFont('Arial','B',11);
            $pdf -> cell(5, 5, '', 0, 0);
            $pdf -> Cell(185, 7, 'Gegevens '.$gegRelatie['SOORT'], 0,1);
            $pdf -> Ln(2);
            $pdf -> SetFont('Arial','',10);
            $pdf -> cell(10, 5, '', 0, 0);
            $pdf -> cell(12, 5, 'Naam: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(158, 5, $gegRelatie['NAAM'], 0, 1);
            $pdf -> SetTextColor( 0, 0, 0 );
            $pdf -> cell(10, 5, '', 0, 0);
            $pdf -> cell(17, 5, 'Geslacht: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(153, 5, $gegRelatie['GESLACHT'], 0, 1);
            $pdf -> SetTextColor( 0, 0, 0 );
            $pdf -> Ln(2);
            $pdf -> cell(10, 5, '', 0, 0);
            $pdf -> cell(27, 5, 'Geboortedatum: ', 0, 0);
            $pdf -> SetTextColor( 137, 137, 137 );
            $pdf -> cell(143, 5, $gegRelatie['GEBOORTE'], 0, 1);
            $pdf -> SetTextColor( 0, 0, 0 ); 
            $pdf -> Ln(2);
            if ($gegRelatie['OVER'] == 1)
                {
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> SetFont('Arial','B',10);
                    $pdf -> cell(170, 5, "Overleden", 0, 1);
                    $pdf -> SetFont('Arial','',10);
                    $pdf -> Ln(2);
                }
            elseif ($gegRelatie['OVER'] == 0)
                {
                    // geg relaties
                    foreach ($gegR as $gegRR)
                        {
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(5, 5, '•', 0, 0);
                            $pdf -> cell(175, 5, $gegRR["SOORT"], 0, 1);
                            $pdf -> SetTextColor( 137, 137, 137 );
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $gegRR["GEG"], 0, 1);
                            if ($gegRR["BESCHR"] != "")
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> MultiCell(180, 5, '('.$gegRR["BESCHR"].')', 0, 1);
                                }
                            $pdf -> SetTextColor( 0, 0, 0 );
                            $pdf -> Ln(2);
                        }
                     // adressen relaties   
                     foreach ($adresR as $adresRR)
                        {
                            $pdf -> cell(10, 5, '', 0, 0);  
                            $pdf -> cell(5, 5, '•', 0, 0);
                            $pdf -> cell(175, 5, $adresRR["SOORT"], 0, 1);
                            $pdf -> SetTextColor( 137, 137, 137 );
                            if ($adresRR['BUS'] != "")
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $adreRR['STRAAT']." ".$adresRR['HUIS']." (".$adresRR['BUS'].")", 0, 1);
                                }
                            elseif ($adresRR['BUS'] == "")
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $adresRR['STRAAT']." ".$adresRR['HUIS'], 0, 1);
                                }
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $adresRR["POST"]." ".$adresRR["PLAATS"], 0, 1);
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $adresRR["LAND"], 0, 1);
                            if ($adresRR["BESCHR"] != "")
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> MultiCell(180, 5, '('.$adresRR["BESCHR"].')', 0, 1);
                                }
                            $pdf -> SetTextColor( 0, 0, 0 );
                            $pdf -> Ln(2);
                        }
        $pdf -> Ln(5);
                }
                
        }

    $pdf -> AddPage('P', 'A4');
    
    // jaar va inschrijving: schooljaar, graad, jaar, onderwijs, richting..
    // Loopbaan
    $pdf -> SetFont('Arial','B',11);;
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Loopbaan leerling', 0,1);
    $pdf -> Ln(2);
    
    
    $eersteLoopbaan = 1; 
    foreach ($loopbaanLln as $loopbaan)
        {
                //echo $ditSchooljaar."<br/>";
                //echo $volgendSchooljaar."<br/>";
                //echo $loopbaan["JAAR"]."<br /><br />";
                //echo $loopbaan["SCHOOL"]." = ".$schoolGeg["NAAM"];
                
            if (($loopbaan["SCHOOL"] == $schoolGeg["NAAM"]) && (($loopbaan["JAAR"] == $ditSchooljaar) || ($loopbaan["JAAR"] == $volgendSchooljaar)))
                {
                    
                    if ($loopbaan["JAAR"] == $volgendSchooljaar)
                        {
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> SetFont('Arial','B',10);
                            $pdf -> cell(180, 5, 'Inschrijving voor:', 0, 0);
                            $pdf -> SetFont('Arial','',10);
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["JAAR"], 0, 1);
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["BEGIN"].' tot ...', 0, 1);
                            if ($loopbaan["KLAS"] != '')
                                {
                                    $pdf -> cell(10, 5, '', 0, 0);
                                    $pdf -> cell(180, 5, $loopbaan["RICHTING"].' ('.$loopbaan["KLAS"].')', 0, 1);
                                }
                            else 
                                {
                                    $pdf -> cell(10, 5, '', 0, 0);
                                    $pdf -> cell(180, 5, $loopbaan["RICHTING"].' (Klas nog niet toegewezen)', 0, 1);
                                }
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["GRAAD"].', '.$loopbaan["LEERJAAR"].', '.$loopbaan["VORM"], 0, 1);
                            
                            $eersteLoopbaan = 0;
                        }
                        
                    elseif (($loopbaan["JAAR"] == $ditSchooljaar) && ($eersteLoopbaan == 1))
                        {
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> SetFont('Arial','B',10);
                            $pdf -> cell(180, 5, 'Inschrijving voor:', 0, 0);
                            $pdf -> SetFont('Arial','',10);
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["JAAR"], 0, 1);
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["BEGIN"].' tot ...', 0, 1);
                            if ($loopbaan["KLAS"] != '')
                                {
                                    $pdf -> cell(10, 5, '', 0, 0);
                                    $pdf -> cell(180, 5, $loopbaan["RICHTING"].' ('.$loopbaan["KLAS"].')', 0, 1);
                                }
                            else 
                                {
                                    $pdf -> cell(10, 5, '', 0, 0);
                                    $pdf -> cell(180, 5, $loopbaan["RICHTING"].' (Klas nog niet toegewezen)', 0, 1);
                                }
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(180, 5, $loopbaan["GRAAD"].', '.$loopbaan["LEERJAAR"].', '.$loopbaan["VORM"], 0, 1);
                            
                            $eersteLoopbaan = 0;
                        }
                    
                    elseif (($loopbaan["JAAR"] == $ditSchooljaar) && ($eersteLoopbaan == 0))
                        {
                            $pdf -> cell(10, 5, '', 0, 0);
                            $pdf -> cell(5, 5, '•', 0, 0);
                            $pdf -> SetFont('Arial','B',10);
                            $pdf -> cell(175, 5, $loopbaan["SCHOOL"], 0, 1);
                            $pdf -> SetFont('Arial','',10);
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["JAAR"], 0, 1);
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["BEGIN"].' tot '.$loopbaan["EIND"], 0, 1);
                            if ($loopbaan["KLAS"] != '')
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $loopbaan["RICHTING"].' ('.$loopbaan["KLAS"].')', 0, 1);
                                }
                            else 
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $loopbaan["RICHTING"], 0, 1);
                                }
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["GRAAD"].', '.$loopbaan["LEERJAAR"].', '.$loopbaan["VORM"], 0, 1);
                            if ($loopbaan["CLAUSULE"] != '')
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $loopbaan["ATTEST"].'-attest'.' ('.$loopbaan["CLAUSULE"].')', 0, 1);
                                }
                            else
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> cell(175, 5, $loopbaan["ATTEST"].'-attest', 0, 1);
                                }
                            if ($loopbaan["ADVIES"] != '')
                                {
                                    $pdf -> cell(15, 5, '', 0, 0);
                                    $pdf -> MultiCell(175, 5, $loopbaan["ADVIES"], 0, 1);
                                }
                        }
                    
                }
            else
                {
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> cell(5, 5, '•', 0, 0);
                    $pdf -> SetFont('Arial','B',10);
                    $pdf -> cell(175, 5, $loopbaan["SCHOOL"], 0, 1);
                    $pdf -> SetFont('Arial','',10);
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> cell(175, 5, $loopbaan["JAAR"], 0, 1);
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> cell(175, 5, $loopbaan["BEGIN"].' tot '.$loopbaan["EIND"], 0, 1);
                    if ($loopbaan["KLAS"] != '')
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["RICHTING"].' ('.$loopbaan["KLAS"].')', 0, 1);
                        }
                    else 
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["RICHTING"], 0, 1);
                        }
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> cell(175, 5, $loopbaan["GRAAD"].', '.$loopbaan["LEERJAAR"].', '.$loopbaan["VORM"], 0, 1);
                    if ($loopbaan["CLAUSULE"] != '')
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["ATTEST"].'-attest'.' ('.$loopbaan["CLAUSULE"].')', 0, 1);
                        }
                    else
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> cell(175, 5, $loopbaan["ATTEST"].'-attest', 0, 1);
                        }
                    if ($loopbaan["ADVIES"] != '')
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> MultiCell(175, 5, $loopbaan["ADVIES"], 0, 1);
                        }
                }
            
            
            $pdf -> Ln(5);
        }
    
    
    $pdf -> AddPage('P', 'A4');
    
    // Vragenlijst
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Vragenlijst', 0,1);
    $pdf -> Ln(2);
    
    $a = 1;
    foreach ($vragenlijst as $vraag)
        {
            if ($vraag["TYPE"] != "lijst")
                {
                    $pdf -> SetFont('Arial','B',10);
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> cell(5, 5, $a, 0, 0);
                    $pdf -> cell(175, 5, $vraag["VRAAG"], 0, 1);
                    $pdf -> SetFont('Arial','',10);
                    $pdf -> cell(15, 5, '', 0, 0);
                    $pdf -> MultiCell(175, 5, $vraag["ANTWOORDEN"][0], 0, 1);
                    $pdf -> Ln(2);
                }
            else 
                {
                    $pdf -> SetFont('Arial','B',10);
                    $pdf -> cell(10, 5, '', 0, 0);
                    $pdf -> cell(5, 5, $a, 0, 0);
                    $pdf -> cell(175, 5, $vraag['VRAAG'], 0, 1);
                    $pdf -> SetFont('Arial','',10);
                    
                    foreach ($vraag["ANTWOORDEN"] as $antwoord)
                        {
                            $pdf -> cell(15, 5, '', 0, 0);
                            $pdf -> Cell(5,5, '•', 0,0);
                            $pdf -> cell(170, 5, $antwoord, 0, 1);
                        }
                    $pdf -> Ln(2);
                }
            ++$a;
        }
    
    $pdf -> AddPage('P', 'A4');
    
    // Voorwaarden
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Voorwaarden', 0,1);
    $pdf -> Ln(2);
    
    foreach ($voorwaardenlijst as $voorwaarde)
        {
            $pdf -> SetFont('Arial','B',10);
            $pdf -> cell(10, 5, '', 0, 0);
            if ($voorwaarde["CHECK"] == 1)
                {
                    $pdf -> cell(7, 5, '[x]', 0, 0);
                }
            else
                {
                    $pdf -> cell(7, 5, '[  ]', 0, 0);
                }
            $pdf -> SetFont('Arial','',10);
            if ($voorwaarde["LINK"] != '')
                {
                    //$aantalTekens = (count(str_split($voorwaarde["INHOUD"])));
                    //echo $aantalTekens;
                    //$aantalRegels = floor($aantalTekens/100);
                    //echo $aantalRegels;
                    //$aantalRest = ($aantalTekens%100);
                    //echo $aantalRest;
                    $pdf -> multicell(173, 5, $voorwaarde["INHOUD"], 0, 1, false, 0,$voorwaarde["LINK"]); // multicell cannot have an URL link, but no error given..
                }
            else
                {
                    $pdf -> multicell(173, 5, $voorwaarde["INHOUD"], 0, 1);
                }
            
            $pdf -> Ln(2);
        }
     
    
    // Hantekeningen
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Handtekeningen', 0, 1);
    $pdf -> Ln(2);
    
    $pdf -> SetFont('Arial','',10);
    
    $aantalHandtekeningen = intval($instellingGeg["LLN"]) + intval($instellingGeg["OUDER"]) + intval($instellingGeg["DIRECTIE"]);
    
    if ($instellingGeg["DIGITAAL"] == 1)
        {
            
        }
        
        
    elseif ($instellingGeg["DIGITAAL"] == 0) 
        {
            if ($aantalHandtekeningen == 3)
                { 
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][0], 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][1], 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][2], 0, 1, 'C');
                    
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 1, 'C');
                    
                    $pdf -> cell(10, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 0, 'C');
                    $pdf -> cell(10, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 0, 'C');
                    $pdf -> cell(10, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 1, 'C');
                }
            elseif ($aantalHandtekeningen == 2)
                {
                    $pdf -> cell(40, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][0], 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][1], 0, 0, 'C');
                    
                    $pdf -> cell(40, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 0, 'C');
                    $pdf -> cell(10, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 1, 'C');
                    
                    $pdf -> cell(40, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 0, 'C');
                    $pdf -> cell(10, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 1, 'C');
                }
            elseif ($aantalHandtekeningen == 1)
                {
                    $pdf -> cell(70, 10, '', 0, 0);
                    $pdf -> cell(50, 10, $instellingGeg["SIGNS"][0], 0, 0, 'C');
                    
                    $pdf -> cell(70, 10, '', 0, 0);
                    $pdf -> cell(50, 10, '__ /__ /____', 0, 1, 'C');
                    
                    $pdf -> cell(70, 30, '', 0, 0);
                    $pdf -> cell(50, 30, '', 1, 1, 'C');
                }
        }   
    
    $pdf -> Ln(5);    
    
    // Commentaar
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Commentaar', 0, 1);
    $pdf -> Ln(2);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> MultiCell(180, 5, $inschrijvingGeg['COMM'], 0, 1);
    
    // ...
    
    
    
    
    //$pdf -> AddPage('P', 'A4');
    
    
    // create PDF
    $pdf -> OutPut('D', $instellingGeg['DOC'].$lln['NAAM'].'.pdf'); // download: 'DagUur_Inschrijving-Leerling.pdf', 'D'
    
?>
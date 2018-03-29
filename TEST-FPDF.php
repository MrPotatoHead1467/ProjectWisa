<?php
    require ("fpdf181/fpdf.php");
    
    //new PDF: default margin: 10mm
    $pdf = new FPDF('p', 'mm', 'A4');
    
    class PDF extends FPDF  {
                            function Header()   {
                                                $this->Image('WISA_Print_IconPic-Normal.png',10,6,30);
                                                $this->SetFont('Arial','B',15);
                                                }
                            function Footer()   {
                                                $this -> cell(10, 5, $pdf ->PageNo(), 1, 1);
                                                }
                            }
    $pdf -> AddPage();
    //$pdf->setTopMargin(1);
    //$pdf->setLeftMargin(1);
    //$pdf->setRightMargin(1);
    
    $pdf -> Header(); // BLEM!!
    
    // Container (for text) = cell(width, heigth, text, border(1=all, 0=none), end line (1=newline, 0=continue), align (L,C,R),
    
    // Header
    $pdf -> SetFont('Arial','B',14); 
    $pdf -> cell(190, 50, 'TEMPORARY HEADER', 1, 1, 'C');
    $pdf -> Ln(5); 
    // Info inschrijving
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(190, 5, 'Inschrijvingsdatum: 29/03/2018', 0,1,'L');
    $pdf -> cell(190, 5, 'Ingeschreven door: Voornaam Achternaam', 0,1,'L');
    $pdf -> Ln(5);
    // Gegevens leerling
    $pdf -> SetFont('Arial','B',11);
    $pdf -> Cell(50, 7, 'Gegevens leerling', 0,1);
    $pdf -> Ln(3);    
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Voornaam Achternaam', 0, 1);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Geslacht', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Geboortedatum', 0, 1);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Geboorteplaats', 0, 1);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Nationaliteit', 0, 1);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Rijksregisternummer/ bisnummer', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Godsdienst', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'GSM', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'Telefoon', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);  
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'E-mail', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);
    $pdf -> Ln(3);      
    $pdf -> cell(5, 10, '', 0, 0);
    $pdf -> cell(30, 10, 'SOORT:', 1, 0);
    $pdf -> cell(70, 10, 'Adres', 1, 0); 
    $pdf -> cell(85, 10, '(beschrijving)', 1, 1);
    $pdf -> Ln(5);    
    // Gegevens relaties
    $pdf -> SetFont('Arial','B',11);
    $pdf -> Cell(50, 7, 'Gegevens relatie', 0,1);
    $pdf -> Ln(3);    
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Voornaam Achternaam', 0, 1);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Geslacht', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Geboortedatum', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'GSM', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'Telefoon', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);  
    $pdf -> Ln(3);    
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(30, 5, 'SOORT:', 1, 0);
    $pdf -> cell(70, 5, 'E-mail', 1, 0); 
    $pdf -> cell(85, 5, '(beschrijving)', 1, 1);
    $pdf -> Ln(3);      
    $pdf -> cell(5, 10, '', 0, 0);
    $pdf -> cell(30, 10, 'SOORT:', 1, 0);
    $pdf -> cell(70, 10, 'Adres', 1, 0); 
    $pdf -> cell(85, 10, '(beschrijving)', 1, 1);
    $pdf -> Ln(5);    
    
    // ...

    $pdf -> Footer(); // BLEM
    
    $pdf -> cell(170, 5, 'SCHOOL | Inschrijving leerling', 1, 0);
    $pdf -> cell(20, 5, 'P | '.$pdf ->PageNo(), 1, 1);
    
    
    // create PDF
    $pdf -> OutPut();
    
?>
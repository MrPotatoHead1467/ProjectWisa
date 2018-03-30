<?php
    require ("fpdf181/fpdf.php");
    
    class PDF extends FPDF
        {
            function Header()   
                {
                    if (($this -> PageNo()) == 1)
                        {
                            $this -> Image('MIN_Print_Icon.png',20,15,30,30);
                            $this -> SetFont('Arial','B',11); 
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, '', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'SCHOOLNAAM', 0, 1, 'L');
                            $this -> SetFont('Arial','',11); 
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, 'Adres', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, 'Postcode en Gemeente', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, 'Tel:', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, 'Fax:', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, 'E-mail: ', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'C');
                            $this -> cell(140, 5, '', 0, 1, 'L');
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 7, 'TITEL DOCUMENT', 0, 1, 'C');
                            $this -> Ln(5);
                        }
                     
                
                }
            function Footer()   
                {
                    $this -> SetY( -15 );                                            
                    $this -> SetFont('Arial','B',11);
                    //$this -> SetTextColor( 0, 0, 0 ); RGB()
                    $this -> cell(170, 5, 'SCHOOL | Inschrijving leerling', 1, 0);
                    $this -> cell(20, 5, 'P | '.$this ->PageNo(), 1, 0);
                }
        }
    
    //new PDF: default margin: 10mm
    $pdf = new PDF('P', 'mm', 'A4');
    $pdf -> SetTitle('Inschrijving-Leerling');

    $pdf -> AddPage('P', 'A4');
    //$pdf->setTopMargin(1);
    //$pdf->setLeftMargin(1);
    //$pdf->setRightMargin(1);
    // Container (for text) = cell(width, heigth, text, border(1=all, 0=none), end line (1=newline, 0=continue), align (L,C,R),
    
    
     
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

    
    
    
    //$pdf -> AddPage('P', 'A4');
    
    
    // create PDF
    $pdf -> OutPut(); // download: 'DagUur_Inschrijving-Leerling.pdf', 'D'
    
?>
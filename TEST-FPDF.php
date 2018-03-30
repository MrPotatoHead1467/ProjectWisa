
<?php
    $teken = "&#10004;";

    require ("fpdf181/fpdf.php");
    
    
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
                            $this -> cell(140, 5, 'SCHOOLNAAM', 0, 1, 'L');
                            $this -> SetFont('Arial','',10); 
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'Adres', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'Postcode en Gemeente', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'Tel:', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'Fax:', 0, 1, 'L');
                            $this -> cell(50, 5, '', 0, 0, 'L');
                            $this -> cell(140, 5, 'E-mail: ', 0, 1, 'L');
                            $this -> cell(50, 3, '', 0, 0, 'L');
                            $this -> cell(140, 3, '', 0, 1, 'L');
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, 'TITEL DOCUMENT', 0, 1, 'C');
                            $this -> cell(190, 3, '', 0, 1, 'L');
                            $this -> cell(190, 0, '', 1, 1, 'L');
                            $this -> Ln(5);
                        }
                        
                    if (($this -> PageNo()) > 1)
                        {
                            $this -> SetFont('Arial','B',14); 
                            $this -> cell(190, 5, 'TITEL DOCUMENT', 0, 1, 'C');
                            $this -> cell(50, 3, '', 0, 0, 'C');
                            $this -> cell(140, 3, '', 0, 1, 'L');
                            $this -> cell(190, 0, '', 1, 1, 'C');
                            $this -> Ln(5);
                        }
                }
            function Footer()   
                {
                    $this -> SetY( -20 );
                    $this -> SetFont('Arial','B',10);
                    //$this -> SetTextColor( 0, 0, 0 ); RGB()
                    
                    $this -> Ln(5);
                    $this -> cell(190, 0, '', 1, 1, 'C');
                    $this -> cell(190, 3, '', 0, 1, 'C');
                    $this -> cell(170, 5, 'SCHOOLNAAM | Inschrijving leerling', 0, 0);
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
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Inschrijvingsdatum: 29/03/2018', 0,1,'L');
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> cell(185, 5, 'Ingeschreven door: Voornaam Achternaam', 0,1,'L');
    $pdf -> Ln(5);
    
    // Gegevens leerling
    $pdf -> SetFont('Arial','B',11);;
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Gegevens leerling', 0,1);
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Voornaam Achternaam', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geslacht', 0, 1);
    $pdf -> Ln(3);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geboortedatum', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geboorteplaats', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Nationaliteit', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Rijksregisternummer/ bisnummer', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Godsdienst', 0, 1);
    $pdf -> Ln(3);  
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> cell(175, 5, 'GSM', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(180, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Telefoon', 0, 1); 
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'E-mail', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(3);      
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
    $pdf -> Ln(3);    
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Voornaam Achternaam', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geslacht', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Geboortedatum', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Telefoon', 0, 1); 
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(3);    
    $pdf -> cell(10, 5, '', 0, 0);  
    $pdf -> cell(5, 5, '•', 0, 0);
    $pdf -> cell(175, 5, 'SOORT', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'E-mail', 0, 1);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Beschrijving', 0, 1);
    $pdf -> Ln(3);      
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
    $pdf -> Ln(3);
    // Loopbaan (0)
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Schooljaar', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Graad jaar onderwijs', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Richting', 0, 1);
    $pdf -> Ln(3);
    // Loopbaan (-1/ ...)
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'School', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Schooljaar', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Graad jaar onderwijs', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Richting', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(180, 5, 'Attest (Clausule)', 0, 1);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> MultiCell(180, 5, 'Advies klassenraad', 0, 1);
    $pdf -> Ln(5);
    
    $pdf -> AddPage('P', 'A4');
    
    // Vragenlijst
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Vragenlijst', 0,1);
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '1', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Antwoord', 0, 1);
    $pdf -> Ln(3);
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
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(5, 5, '3', 0, 0);
    $pdf -> cell(175, 5, 'VRAAG', 0, 1);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(15, 5, '', 0, 0);
    $pdf -> MultiCell(175, 5, 'Antwoord', 0, 1);
    $pdf -> Ln(3);
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
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[  ]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 1', 0, 1);
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 2', 0, 1);
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 3', 0, 1);
    $pdf -> Ln(3);
    $pdf -> SetFont('Arial','B',10);
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(7, 5, '[x]', 0, 0);
    $pdf -> SetFont('Arial','',10);
    $pdf -> cell(173, 5, 'Voorwaarde 4', 0, 1);
    $pdf -> Ln(5);
    
    // Voorwaarden
    $pdf -> SetFont('Arial','B',11);
    $pdf -> cell(5, 5, '', 0, 0);
    $pdf -> Cell(185, 7, 'Handtekeningen', 0, 1);
    $pdf -> Ln(3);
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Leerling', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Ouder', 0, 0, 'C');
    $pdf -> cell(10, 10, '', 0, 0);
    $pdf -> cell(50, 10, 'Directie', 0, 1, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 5, 'Datum', 0, 0, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 5, 'Datum', 0, 0, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 5, 'Datum', 0, 1, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 0, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 0, 'C');
    $pdf -> cell(10, 5, '', 0, 0);
    $pdf -> cell(50, 30, 'Handtekening', 1, 1, 'C');
    
    
    
    // ...
    
    
    
    
    //$pdf -> AddPage('P', 'A4');
    
    
    // create PDF
    $pdf -> OutPut(); // download: 'DagUur_Inschrijving-Leerling.pdf', 'D'
    
?>
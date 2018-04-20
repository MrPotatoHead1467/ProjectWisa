<?php
include "WISA-Connection.php";
///**
$sql = "SELECT * FROM tbl_scholen WHERE fld_school_naam='Miniemeninstituut'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_school_id'];
        echo "<br />";
    }
}
//*/
/**
$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
// /**
$res=$client->GetXMLData($auth,'BI_SCHOOL','',5,'');

//  /**
$xml_SMART=simplexml_load_string($res);

$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
// /**
foreach ($array as $Test2 => $array2){
    foreach ($array2 as $Test3 => $array3){
        foreach ($array3 as $Omsch => $School){
            
            if ($Omsch == "SC_ID"){
                $Wisa_School_ID = $School;
            }
            elseif ($Omsch == "SC_INSTELLINGSNUMMER"){
                $Instellingsnummer = $School;
            }
            elseif ($Omsch == "SC_STRAAT"){
                $Straat = mysqli_real_escape_string($conn,$School);
            }
            elseif ($Omsch == "SC_STRAATNR"){
                $Straatnummer = $School;
            }
            elseif ($Omsch == "SC_GEMEENTE_FK"){
                $Postcode_ID = $School;
                $sql = "SELECT * FROM tbl_postcodes WHERE fld_postcode_wisa_id='".$Postcode_ID."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Postcode_ID = $row['fld_postcode_id'];
                    }
                }
            }
            elseif ($Omsch == "SC_TELEFOON"){
                $Tel = $School;
            }
            elseif ($Omsch == "SC_FAX"){
                $Fax = $School;
            }
            elseif ($Omsch == "SC_EMAIL"){
                $EMail = $School;
            }
            elseif ($Omsch == "SC_WWW"){
                $Website = $School;
            }
            elseif ($Omsch == "SC_NAAM"){
                $Schoolnaam = mysqli_real_escape_string($conn,$School);
            }
            elseif ($Omsch == "GM_LAND_FK"){
                $Land_ID = $School;
                $sql = "SELECT * FROM tbl_landen WHERE fld_land_wisa_id='".$Land_ID."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $Land_ID = $row['fld_land_id'];
                    }
                }
            }
            
           ++$i;
        }
        ///**
        if ($Schoolnaam == "Miniemeninstituut"){
            echo "<br />";
            echo "Wisa_ID: ".$Wisa_School_ID."<br />";
            echo "Instellingsnummer: ".$Instellingsnummer."<br />";
            echo "Straat: ".$Straat."<br />";
            echo "Straatnummer: ".$Straatnummer."<br />";
            echo "Postcode_ID: ".$Postcode_ID."<br />";
        
            
            if ($Tel != ''){
                echo "Tel: ".$Tel."<br />";
            }
            if ($Fax != ''){
                echo "Fax: ".$Fax."<br />";
            }
            if ($EMail != ''){
                echo "EMail: ".$EMail."<br />";
            }
            if ($Website != ''){
                echo "Website: ".$Website."<br />";
            } 
            echo "Schoolnaam: ".$Schoolnaam."<br />";
            echo "Land_ID: ".$Land_ID."<br />";
        }
        //*/
        /**
        $sqlSchool = "INSERT INTO tbl_scholen (fld_school_naam, fld_school_instellingsnummer, fld_school_wisa_id)
                      VALUES ('".$Schoolnaam."', '".$Instellingsnummer."', '".$Wisa_School_ID."')";
        if (mysqli_query($conn, $sqlSchool)){
            $School_ID = mysqli_insert_id($conn);
            $sqlAdres = "INSERT INTO tbl_adressen (fld_adres_straatnaam, fld_adres_huis_nr, fld_adres_postcode_id_fk, fld_adres_land_id_fk) 
                         VALUES ('".$Straat."', '".$Straatnummer."', '".$Postcode_ID."', '".$Land_ID."')";
                         
            if (mysqli_query($conn, $sqlAdres)){
                $Adres_ID = mysqli_insert_id($conn);
                $sqlSchoolAdres = "INSERT INTO tbl_adressen_linken (fld_adres_id_fk, fld_soort_id_fk, fld_school_id_fk) 
                                   VALUES ('".$Adres_ID."', '23', '".$School_ID."')";
                if (mysqli_query($conn, $sqlSchoolAdres)){

                }
                else {
                    echo "Error: " . $sqlSchoolAdres . "<br>" . mysqli_error($conn);
                }
            }
            else {
                echo "Error: " . $sqlAdres . "<br>" . mysqli_error($conn);
            }
            
            $sqlSchoolGegeven = "INSERT INTO tbl_scholen_gegevens (fld_school_id_fk, fld_gegeven_id_fk)
                                  VALUES ('".$School_ID."', '".$Gegeven_ID."')";
            if ($Tel != ''){
                $sqlTel = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk)
                       VALUES ('".$Tel."', '2')";
                if (mysqli_query($conn, $sqlTel)){
                    $Gegeven_ID = mysqli_insert_id($conn);
                    if (mysqli_query($conn, $sqlSchoolGegeven)){
    
                    }
                    else {
                        echo "Error: " . $sqlSchoolGegeven . "<br>" . mysqli_error($conn);
                    }
                }
                else {
                    echo "Error: " . $sqlTel . "<br>" . mysqli_error($conn);
                }
            }
            
            if ($Fax != ''){
                $sqlFax = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk)
                       VALUES ('".$Fax."', '4')";
            
                if (mysqli_query($conn, $sqlFax)){
                    $Gegeven_ID = mysqli_insert_id($conn);
                    if (mysqli_query($conn, $sqlSchoolGegeven)){
    
                    }
                    else {
                        echo "Error: " . $sqlSchoolGegeven . "<br>" . mysqli_error($conn);
                    }
                }
                else {
                    echo "Error: " . $sqlFax . "<br>" . mysqli_error($conn);
                }
            }
            
            if ($EMail != ''){
                $sqlEMail = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk)
                       VALUES ('".$EMail."', '1')";
            
                if (mysqli_query($conn, $sqlEMail)){
                    $Gegeven_ID = mysqli_insert_id($conn);
                    if (mysqli_query($conn, $sqlSchoolGegeven)){
    
                    }
                    else {
                        echo "Error: " . $sqlSchoolGegeven . "<br>" . mysqli_error($conn);
                    }
                }
                else {
                    echo "Error: " . $sqlEMail . "<br>" . mysqli_error($conn);
                }
            }
            
            if ($Website != ''){
                $sqlWebsite = "INSERT INTO tbl_gegevens (fld_gegeven_inhoud, fld_gegeven_soort_id_fk)
                       VALUES ('".$Website."', '5')";
                       
                if (mysqli_query($conn, $sqlWebsite)){
                    $Gegeven_ID = mysqli_insert_id($conn);
                    if (mysqli_query($conn, $sqlSchoolGegeven)){
    
                    }
                    else {
                        echo "Error: " . $sqlSchoolGegeven . "<br>" . mysqli_error($conn);
                    }
                }
                else {
                    echo "Error: " . $sqlWebsite . "<br>" . mysqli_error($conn);
                }
            } 
        }
        else {
            echo "Error: " . $sqlSchool . "<br>" . mysqli_error($conn);
        }
        //*/
        /**
        $Instellingsnummer = '';
        $Straat = '';
        $Straatnummer = '';
        $Postcode_ID = '';
        $Tel = '';
        $Fax = '';
        $EMail = '';
        $Website = '';
        $Wisa_School_ID = '';
        $Schoolnaam = '';
        $Land_ID = '';

        $i = 0;
    }
}
echo "Done";
// */
 /**
$res=$client->GetCSVData($auth,'BI_SCHOOL','',true,';','');
// echo $res;
// /**
$i = 0;

$explode = explode(";",$res);
foreach ($explode as $exploded){
    echo $exploded."<br />";
    // echo $exploded."<br />";
}
$i=0;
// */
/**
0 id
3 instellingsnummer
5 straatnaam
6 straatnummer
7 postcode id
8 telefoon
9 fax
10 email
11 website
14 schoolnaam
26 land id
*/
?>
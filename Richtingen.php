<meta charset="UTF-8">
<?php
include "WISA-Connection.php";
/**
$sql = "SELECT * FROM tbl_landen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_land_naam'];
        echo "<br />";
    }
}
*/

$auth=array('Username'=>'API','Password'=>'API','Database'=>'Miniemen');
$client = new SoapClient('http://remote.wisa.be:60580/SOAP/WisaAPIService.wsdl');
// /**
$res=$client->GetXMLData($auth,'BI_RICHT','',5,'');

// /**
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
// /**
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Name => $Value){
            if ($i == 0){
                $Richting_Id = $Value;
            }
            elseif ($i == 1){
                $Code = $Value;
            }
            elseif ($i == 2){
                $Omschrijving = $Value;
            }
            elseif ($i == 4){
                $Leerjaar = $Value;
            }
            elseif ($i == 6){
                $Graad = $Value;
            }
            elseif ($i == 7){
                $Richting_Code = $Value;
            }
            elseif ($i == 8){
                $Richting = $Value;
            }
            elseif ($i == 11){
                $Onderwijsvorm = $Value;
            }
            echo $Name.": ".$Value."<br />";
           
           ++$i;
        }
        echo "<br />";
        /**
        echo "Richting_Id = ".$Richting_Id."<br />";
        echo "Code = ".$Code."<br />";
        echo "Omschrijving = ".$Omschrijving."<br />";
        echo "Leerjaar = ".$Leerjaar."<br />";
        echo "Graad = ".$Graad."<br />";
        echo "Richting_Code = ".$Richting_Code."<br />";
        echo "Richting = ".$Richting."<br />";
        echo "Onderwijsvorm = ".$Onderwijsvorm."<br />";
        echo "<br />";
        */
        $sqlRichting = "INSERT INTO tbl_richtingen (fld_
                        VALUES ('";
        /**
        if (mysqli_query($conn, $sqlRichting)){
            
        }
        else {
            echo "Error: " . $sqlRichting . "<br>" . mysqli_error($conn);
        }
        */
        $i = 0;
    }
}
// */
 /**
$res=$client->GetCSVData($auth,'BI_RICHT','',true,';','');
// /**
$explode = explode(";",$res);
foreach ($explode as $exploded){
    echo $exploded."<br />";
    
    // echo $exploded."<br />";
}
// */
/**
0 id
1 ag_code?
2 omschrijving
4 leerjaar
6 graad
7 richtingcode
8 richting
11 onderwijsvormcode vb tso

*/
?>
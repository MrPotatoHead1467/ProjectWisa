<?php
include "WISA-Connection.php";
include "XML_Connection.php";

$sql = "SELECT * FROM tbl_landen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo $row['fld_land_naam'];
        echo "<br />";
    }
}

/**
$res=$client->GetXMLData($auth,'BI_NAT','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Nat){
            
            if ($i == 0){
                $Nat_Id = mysqli_real_escape_string($conn, $Nat);
            }
            elseif ($i == 6){
                $Nat_Naam = mysqli_real_escape_string($conn, $Nat);
            }
            ++$i;
        }
        $sqlNation = "INSERT INTO tbl_nationaliteiten (fld_nation_nation, fld_nation_wisa_id) VALUES ('".$Nat_Naam."', '".$Nat_Id."')";
        if (mysqli_query($conn, $sqlNation)){
            echo "Nat_Id = ".$Nat_Id."<br />";
            echo "Nat_Naam = ".$Nat_Naam."<br />";
            echo "!Gelukt!<br /><br />";
        }
        else {
            echo "Error: " . $sqlNation . "<br>" . mysqli_error($conn);
        }
        $i = 0;
        
    }
}
*/
/**
$res=$client->GetCSVData($auth,'BI_NAT','',true,';','');
echo $res;
*/
?>
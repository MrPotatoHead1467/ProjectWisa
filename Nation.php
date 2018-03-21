<?php
include "WISA-Connection.php";
include "XML_Connection.php";
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
$res=$client->GetXMLData($auth,'BI_NAT','',5,'');
$xml_SMART=simplexml_load_string($res);
$json = json_encode($xml_SMART);
$array = json_decode($json,TRUE);
$i = 0;
foreach ($array as $array2){
    foreach ($array2 as $array3){
        foreach ($array3 as $Nat){
            $sqlNationaliteit = "INSERT INTO tbl_nationaliteiten(fld_nation_nation) VALUES ('".$Nat."')";
            if (mysqli_query($conn, $sqlNationaliteit)){

            }
            else {
                echo "Error: " . $sqlNationaliteit . "<br>" . mysqli_error($conn);
            }
        }
    }
}

?>
<?php
$arrayA = array("SOORT" => 21, "GEG" => "016 22 41 06", "BESCHR" => "Niet bellen tussen 7 en 16");
$arrayB = array("SOORT" => 22, "GEG" => "04 74 24 35 95", "BESCHR" => "Niet bellen tussen 8 en 17");
$array1 = array($arrayA, $arrayB);

foreach ($array1 as $Array_Test) {
    echo $Array_Test['SOORT']."<br />";
    echo $Array_Test['GEG']."<br />";
    echo $Array_Test['BESCHR']."<br />";
    echo "<br />";
}


?>
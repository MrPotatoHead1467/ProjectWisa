<?php
$Jaar = date("Y");
$Maand = date("m");
if ($Maand >= 7){
    $ditSchooljaar = $Jaar." - ".($Jaar + 1);
    $Volgend_Schooljaar = ($Jaar + 1)." - ".($Jaar + 2);
}
else {
    $ditSchooljaar = ($Jaar - 1)." - ".$Jaar;
    $Volgend_Schooljaar = $Jaar." - ".($Jaar + 1);
}
echo $ditSchooljaar."<br />";
echo $Volgend_Schooljaar;
?>
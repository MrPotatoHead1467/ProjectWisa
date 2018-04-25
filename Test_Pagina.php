<?php
$Naam = "Maarten Van Beneden";
$Persoon_Id = 13;
$target_dir = 'Uploads/'.$Naam.'_'.$Persoon_Id;
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
if (!file_exists($target_dir.'/Persoon')) {
    mkdir($target_dir.'/Persoon', 0777, true);
}
if (!file_exists($target_dir.'/Relatie')) {
    mkdir($target_dir.'/Relatie', 0777, true);
}
if (!file_exists($target_dir.'/Contact')) {
    mkdir($target_dir.'/Contact', 0777, true);
}
if (!file_exists($target_dir.'/Loopbaan')) {
    mkdir($target_dir.'/Loopbaan', 0777, true);
}
if (!file_exists($target_dir.'/Inschrijving')) {
    mkdir($target_dir.'/Inschrijving', 0777, true);
}
?>
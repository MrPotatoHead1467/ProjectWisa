<?php

if (isset($_POST['nav1-link2'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: WISA-Inloggen.php");
    #exit();
}
?>
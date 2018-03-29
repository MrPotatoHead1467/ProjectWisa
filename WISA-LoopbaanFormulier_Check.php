<?php

    include "WISA-Connection.php";
    
    if (isset($_POST['Volgende']))
            {
                header("Location: WISA-Formulier.php?vragen");
            }

?>
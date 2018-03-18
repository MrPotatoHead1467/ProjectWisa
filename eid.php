<?php
    /* Made by Jochem De Jaeghere (lljochemll), all rights reserved
    *  License: MIT
    *  Leave this header unmodified
    */
    class IDCard {
        public $birthDate;
        public $name;
        public $prename;
        public $serial;

        public function __construct() {
            //Checks if a client certificate was provided
            if (!isset($_SERVER["SSL_CLIENT_VERIFY"])) {
                throw new Exception("No client certificate provided", 1);
                echo 'exception';
            }
            
            //Tries to fill all fields with data. 
            //If an error occurs, we assume the code is perfect and an invalid certificate was provided
            try {
                $this->name = $_SERVER["SSL_CLIENT_S_DN_S"];
                $this->prename = $_SERVER["SSL_CLIENT_S_DN_G"];
                $this->serial = substr($_SERVER["SSL_CLIENT_S_DN"], strpos($_SERVER["SSL_CLIENT_S_DN"], "serialNumber=") + 13, 11);
            } catch (Exception $e) {
                throw new Exception("Provided client certificate doesn't match that of a belgian eID");
                echo 'exception';
            }
        }

        public function name() {
            return $name;
        }

        public function prename() {
            return $prename;
        }

        public function serial() {
            return $serial;
        }
    }
?>
<?php

    $database= new mysqli("localhost","root","","anugrah_medika");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
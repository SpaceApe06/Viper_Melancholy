<?php
    $server = "localhost"; // server navn
    $user = "root"; // brukernavn
    $pw = "ADMIN"; // passord
    $db = "viperdb"; // database navn

    $conn = mysqli_connect($server, $user, $pw, $db);

    if(!$conn) {
        echo "Connection failed!";        
    }
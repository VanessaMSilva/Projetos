<?php
    $dbname = "moviestar";
    $dbhost = "localhost";
    $dbuser = "root";
    $pass = "";

    $conn = new PDO("mysql:dbname=" . $dbname . ";host=" . $dbhost, $dbuser, $pass);

    //habilitar erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>
<?php 

function connectionDB() {
    
    $config = require 'config/config.php';

    // Získání hodnot z konfiguračního souboru
    $db_host = $config['DB_HOST'];
    $db_user = $config['DB_USER'];
    $db_pass = $config['DB_PASS'];
    $db_name = $config['DB_NAME'];

    
    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

   
    if (mysqli_connect_error()) {
        echo "Connection error: " . mysqli_connect_error();
        exit;
    }

    return $connection;
}
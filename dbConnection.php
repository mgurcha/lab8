<?php

function connectToDB($dbName) {
    $host = 'us-cdbr-iron-east-05.cleardb.net';
    $db   =  'heroku_241fa2afdb4ac3c';
    $user = 'b43c999f1d350b';
    $pass = '5666d977';
    $charset = 'utf8mb4';
    // mysql://b43c999f1d350b:5666d977@us-cdbr-iron-east-05.cleardb.net/heroku_241fa2afdb4ac3c?reconnect=true
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo; 
}



?>

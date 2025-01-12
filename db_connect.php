<?php

$host = '127.0.0.1';  
$port = '5432';       
$dbname = 'bsa';  
$user = 'postgres';        
$password = 'lid1999!';    

try{

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

    $pdo = new PDO($dsn, $user, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to the PostgreSQL database successfully!";
} catch (PDOException $e) {

    echo "Failed to connect to the PostgreSQL database: " . $e->getMessage();
    exit();
}
?>

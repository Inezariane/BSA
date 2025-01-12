<?php

$host = 'Host_name'; // Host name
$port = 'Port_number'; // Port number being used ( 5432 by default )
$dbname = 'database_name'; // Database name
$user = 'username'; // Username    
$password = 'password'; // Password   

try{

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Display message
    echo "Connected to the PostgreSQL database successfully!";
} catch (PDOException $e) {

    echo "Failed to connect to the PostgreSQL database: " . $e->getMessage();
    exit();
}
?>

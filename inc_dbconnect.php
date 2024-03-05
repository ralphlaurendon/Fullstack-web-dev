<?php
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "myfirstdb";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

echo "Connected successfully";
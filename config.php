<?php
$hostname = "localhost";
$dbname = "inventory_management";
$username = "root";
$password = "chanchal";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Database Connection Failed: " . $exception->getMessage());
}
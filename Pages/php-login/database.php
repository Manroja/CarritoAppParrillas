<?php
$server = '127.0.0.1';
$port='8080';
$username = 'root';
$password = '123456';
$database = 'parrillas_db';
try {
  $conn = new PDO("mysql:host=$server;$port;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
?>

<?php


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'muruganqr';


$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

?>

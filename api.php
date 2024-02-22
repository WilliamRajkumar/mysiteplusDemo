<?php

include 'db_connection.php';

// Create a connection to the database
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// SQL query to select data from your table
$sql = 'SELECT * FROM products';

// Execute the query
$result = $connection->query($sql);

// Check if the query was successful
if (!$result) {
    die('Error in query: ' . $connection->error);
}

// Fetch data from the result set
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$connection->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Return the data as JSON
echo json_encode($data);

?>

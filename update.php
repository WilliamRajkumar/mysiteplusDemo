<?php

include 'db_connection.php';


$tableName = 'products';

// Assuming you have form data with updated values and the ID to update
$idToUpdate = $_POST['id']; // You may want to validate and sanitize this input
$newName = $_POST['name']; 
$mrp = $_POST['mrp'];
$baseCost = $_POST['base_cost'];
$tax = $_POST['tax'];
$cost = $_POST['cost'];
$salesPrice = $_POST['sales_price'];
$uom = $_POST['uom'];
$product_base_qr = $_POST['product_base_qr'];
// SQL query to update data in the table
$sql = "UPDATE $tableName SET 
            name = '$newName',
            mrp = '$mrp',
            base_cost = '$baseCost',
            tax = '$tax',
            cost = '$cost',
            sales_price = '$salesPrice',
            uom = '$uom',
            product_base_qr='$product_base_qr'
        WHERE id = $idToUpdate";

// Execute the query
if ($connection->query($sql) === TRUE) {
    echo 'Record updated successfully';
} else {
    echo 'Error updating record: ' . $connection->error;
}

// Close the database connection
$connection->close();

?>

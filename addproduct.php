<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

// Replace 'your_table_name' with the actual table name
$tableName = 'products';

// Assuming you have form data with new values
$code = $_POST['id']; 
$newName = $_POST['name']; 
$mrp = $_POST['mrp'];
$baseCost = $_POST['base_cost'];
$tax = $_POST['tax'];
$cost = $_POST['cost'];
$salesPrice = $_POST['sales_price'];
$uom = $_POST['uom'];
$product_base_qr = $_POST['product_base_qr'];

// Check if the product ID already exists
$checkQuery = "SELECT COUNT(*) as count FROM $tableName WHERE code = ?";
$stmt = $connection->prepare($checkQuery);
$stmt->bind_param('s', $code);
$stmt->execute();
$checkResult = $stmt->get_result();
$checkRow = $checkResult->fetch_assoc();

if ($checkRow['count'] > 0) {
    $response = array('error' => 'Product ID already exists');
    echo json_encode($response);
    exit();

} else {
    // SQL query to insert a new record into the table
    $insertQuery = "INSERT INTO $tableName (code, name, mrp, base_cost, tax, cost, sales_price, uom, product_base_qr,name_tamil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ' ')";
    
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param('sssssssss', $code, $newName, $mrp, $baseCost, $tax, $cost, $salesPrice, $uom, $product_base_qr);
    $stmt->execute();

    $response = array('success' => 'Product Added Successfully');
}

// Send JSON response
echo json_encode($response);

// Close the database connection
$stmt->close();
$connection->close();
?>

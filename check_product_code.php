<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'db_connection.php';

$tableName = 'products';


$productCode = $_POST['product_code'];


$checkQuery = "SELECT COUNT(*) as count FROM $tableName WHERE code = ?";
$stmt = $connection->prepare($checkQuery);
$stmt->bind_param('s', $productCode);
$stmt->execute();
$checkResult = $stmt->get_result();
$checkRow = $checkResult->fetch_assoc();

$response = array('exists' => ($checkRow['count'] > 0));
echo json_encode($response);


$stmt->close();
$connection->close();
?>

<?php

include 'db_connection.php';

$id = $_REQUEST['id'];
$cnt = $_REQUEST['cnt'];
// Create a connection to the database
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// SQL query to select data from your table
$sql = 'SELECT * FROM products where id='.$id;

// Execute the query
$result = $connection->query($sql);

// Check if the query was successful
if (!$result) {
    die('Error in query: ' . $connection->error);
}

// Fetch data from the result set
$data = array();
while ($row = $result->fetch_assoc()) {
    $data = $row;
}

// Close the database connection
$connection->close();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Include Vue.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <style type="text/css">
    	p {
    		padding: 0px;
    		margin: 0px;
    	}
    	@page {
    size: 7in 9.25in;
    margin: 27mm 16mm 27mm 16mm;
}
    </style>
</head>
<body>

<?php
for($i=0;$i<$cnt;$i++){
	?>
<div style="border:1px solid red;text-align:center;height: 22mm;width: 35mm;display: inline-block;padding: 10px;">
	<p style="font-size: 10px;font-weight: bold;">SRI MURUGAN OIL STORE</p>
	<svg class="barcode"
  jsbarcode-value="<?=$data['code']?>"
  jsbarcode-height="15"
   jsbarcode-width="1"
  jsbarcode-margin="0"
  jsbarcode-marginTop="2"
  jsbarcode-fontSize="10"

  jsbarcode-fontoptions="bold">
</svg>
<p style="font-size: 12px;font-weight: bold;text-align: center;"><?=$data['sales_price']?></p>
<p style="font-size: 10px;font-weight: bold;"><?=$data['name']?></p>
<p style="font-size: 10px;font-weight: bold;">Pkd:<?=date('Y-m-d')?> &nbsp;&nbsp;&nbsp; Exp:</p>
</div>
	
	<?php
}
?>

</body>
<script type="text/javascript">
	JsBarcode(".barcode").init();

</script>
</html>

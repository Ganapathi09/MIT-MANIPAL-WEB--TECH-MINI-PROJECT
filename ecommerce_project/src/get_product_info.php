<?php
// get_product_info.php

$host = 'localhost';
$db = 'ecommerce';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product_id = 1; // Example product ID

$stmt = $pdo->prepare("CALL GetProductInfo(?)");
$stmt->execute([$product_id]);
$result = $stmt->fetch();

echo "Product: " . $result['product_name'] . "<br>";
echo "Category: " . $result['category_name'] . "<br>";
echo "Total Orders: " . $result['total_orders'] . "<br>";
?>

<?php
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $order_quantity = $_POST['order_quantity'];

    // Check stock availability
    $stmt = $pdo->prepare("SELECT stock_quantity FROM Products WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch();

    if ($product && $product['stock_quantity'] >= $order_quantity) {
        // Place the order and update stock
        $pdo->beginTransaction();
        try {
            // Insert order
            $stmt = $pdo->prepare("INSERT INTO Orders (product_id, order_quantity) VALUES (:product_id, :order_quantity)");
            $stmt->execute(['product_id' => $product_id, 'order_quantity' => $order_quantity]);

            // Update stock quantity
            $stmt = $pdo->prepare("UPDATE Products SET stock_quantity = stock_quantity - :order_quantity WHERE product_id = :product_id");
            $stmt->execute(['order_quantity' => $order_quantity, 'product_id' => $product_id]);

            $pdo->commit();
            // Redirect to confirmation page
            header('Location: order_confirmation.php');
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Failed to place order: " . $e->getMessage();
        }
    } else {
        echo "Error: Not enough stock available.";
    }
}

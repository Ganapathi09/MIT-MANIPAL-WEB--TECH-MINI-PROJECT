<?php
require_once '../config/db_config.php';

// Fetch products from the database
$stmt = $pdo->query("SELECT p.product_id, p.product_name, p.price, p.stock_quantity, c.category_name 
                      FROM Products p 
                      JOIN Categories c ON p.category_id = c.category_id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/order_confirmation.css">
    <link rel="stylesheet" href="../assets/products.css"> <!-- Updated to link the new CSS file -->
    <title>Product List</title>
</head>
<body>
    <div class="container">
        <h1>Available Products</h1>
        <div class="products">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Order Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                            <td><?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                            <td>
                                <form action="place_order.php" method="POST" style="display: flex; align-items: center;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="number" name="order_quantity" min="1" max="<?php echo $product['stock_quantity']; ?>" required style="width: 60px; padding: 5px; margin-right: 5px;">
                                    <button type="submit" class="order-button">Order</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
require_once '../config/db_config.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert categories
    $pdo->exec("INSERT INTO Categories (category_id, category_name) VALUES 
                (1, 'Electronics'), 
                (2, 'Clothing'), 
                (3, 'Books'),
                (4, 'Home Appliances'),
                (5, 'Toys'),
                (6, 'Sports Equipment')");

    // Insert products, referencing existing category IDs
    $pdo->exec("INSERT INTO Products (product_name, price, stock_quantity, category_id) VALUES 
                ('Laptop', 1200.00, 10, 1),
                ('Smartphone', 800.00, 15, 1),
                ('Headphones', 50.00, 30, 1),
                ('T-Shirt', 15.00, 50, 2),
                ('Jeans', 40.00, 25, 2),
                ('Novel', 10.00, 30, 3),
                ('Cookware Set', 80.00, 20, 4),
                ('Blender', 60.00, 10, 4),
                ('Action Figure', 25.00, 40, 5),
                ('Basketball', 30.00, 12, 6)");

    echo "Sample data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

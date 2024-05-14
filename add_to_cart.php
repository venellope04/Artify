<?php
// Database connection parameters
$host = "localhost:3308"; // Host name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "artify"; // Database name

// Retrieve product data from the POST request
$productID = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
// Add any other product data fields as needed

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if the product is already in the cart
    $stmt_check = $pdo->prepare("SELECT * FROM cart WHERE productID = :productID");
    $stmt_check->bindParam(':productID', $productID);
    $stmt_check->execute();
    $existing_product = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_product) {
        // If the product is already in the cart, increment the quantity
        $quantity = $existing_product['quantity'] + 1;
        $stmt_update = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE productID = :productID");
        $stmt_update->bindParam(':quantity', $quantity);
        $stmt_update->bindParam(':productID', $productID);
        $stmt_update->execute();
    } else {
        // If the product is not in the cart, insert a new record
        $stmt_insert = $pdo->prepare("INSERT INTO cart (productID, name, price, image, quantity) VALUES (:productID, :name, :price, :image, 1)");
        $stmt_insert->bindParam(':productID', $productID);
        $stmt_insert->bindParam(':name', $name);
        $stmt_insert->bindParam(':price', $price);
        $stmt_insert->bindParam(':image', $image);
        $stmt_insert->execute();
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    // Return error response
    echo json_encode(["error" => "Error adding item to cart: " . $e->getMessage()]);
}
?>

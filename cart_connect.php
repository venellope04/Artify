<?php
// Database configuration
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "artify";

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch cart items from the database
    $stmt = $pdo->prepare("SELECT * FROM cart");
    $stmt->execute();
    
    // Fetch all rows as associative array
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Convert to JSON and output
    echo json_encode($cart_items);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

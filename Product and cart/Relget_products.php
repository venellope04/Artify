<?php
// Database connection parameters
$host = "localhost:3308"; // Host name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database ="Artify"; // Database name

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT productID, name, price, image FROM relart";
    $stmt = $pdo->query($sql);

    // Check if the query was executed successfully
    if ($stmt) {
        // Check if any products were found
        if ($stmt->rowCount() > 0) {
            // Output data of each row
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Output products data as JSON
            header('Content-Type: application/json');
            echo json_encode($products);
        } else {
            echo json_encode(["error" => "No products found."]);
        }
    } else {
        echo json_encode(["error" => "Error executing SQL query."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error fetching product data: " . $e->getMessage()]);
}
// Close connection (optional for PDO, as it's automatically closed at the end of the script)
$pdo = null;
?>

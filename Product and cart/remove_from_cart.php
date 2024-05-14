<?php
// Database configuration
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "artify";

// Check if the id is provided in the request
if(isset($_POST['id'])) {
    // Get the id from the request data
    $id = $_POST['id'];
    
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Remove item from the cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            // Return success response
            echo json_encode(["success" => true]);
        } else {
            // Return error response if no rows were affected
            echo json_encode(["error" => "Item not found in the cart"]);
        }
    } catch(PDOException $e) {
        // Return error response
        echo json_encode(["error" => "Error removing item from cart: " . $e->getMessage()]);
    }
} else {
    // Return error response if id is not provided
    echo json_encode(["error" => "Item ID not provided"]);
}
?>

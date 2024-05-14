<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password (you can add more robust validation as needed)
    if ($username === 'admin' && $password === 'admin123') {
        // If the credentials are valid, redirect to a success page or perform further actions
        header("Location: index2.html");
        exit;
    } else {
        // If the credentials are invalid, display an error message
        echo "<script>alert('Invalid username or password. Please try again.');</script>";
    }
}
?>

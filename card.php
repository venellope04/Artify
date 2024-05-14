<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cardNumber = $_POST["number"];
    $expiryDate = $_POST["e-date"];
    $cvv = $_POST["cvv"];
    $email = $_POST["email"];

    // Process the form data (you can save it to a database, send an email, etc.)
    // For demonstration purposes, let's just echo the data
    echo "Card Number: $cardNumber<br>";
    echo "Expiry Date: $expiryDate<br>";
    echo "CVV: $cvv<br>";
    echo "Email: $email<br>";
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/e8fa2e31b4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="card.css">
</head>
<body>
<div class="container">
    <div class="left">
        <!-- Your left side content -->
    </div>
    <div class="center">
        <!-- Your center content with form -->
        <div class="card-details">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Your form fields -->
                <!-- Card number -->
                <p>Card number</p>
                <div class="c-number" id="c-number">
                    <input name="number" id="number" class="cc-number" placeholder="Card number" maxlength="19" required>
                    <i class="fa-solid fa-credit-card" style="margin: 0;"></i>
                </div>
                <!-- Expiry date and CVV -->
                <div class="c-details">
                    <!-- Expiry date -->
                    <div>
                        <p>Expiry date</p>
                        <input name="e-date" id="e-date" class="cc-exp" placeholder="MM/YY" required maxlength="5" required>
                    </div>
                    <!-- CVV -->
                    <div>
                        <p>CVV</p>
                        <div class="cvv-box" id="cvv-box">
                            <input name="cvv" id="cvv" class="cc-cvv" placeholder="CVV" required maxlength="3" required>
                            <i class="fa-solid fa-circle-question" title="3 digits on the back of the card" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <!-- Email -->
                <div class="email">
                    <p>Email</p>
                    <input type="email" name="email" placeholder="example@email.com" id="email" required>
                </div>
                <!-- Submit button -->
                <button type="submit">PAY NOW</button>
            </form>
        </div>
    </div>
    <div class="right">
        <!-- Your right side content -->
    </div>
</div>
<script src="card.js"></script>
</body>
</html>

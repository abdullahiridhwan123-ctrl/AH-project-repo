<?php
// Initialize sessions
session_start();
// If the user is logged in, redirect to the home page
if (isset($_SESSION['account_loggedin'])) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dark.css">
    <link rel="stylesheet" href="media/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0bfbba446d.js" crossorigin="anonymous"></script>
    <title>Thank you for your order!</title>
</head>

<body>
    <section id="first-sec">
        <div class="section-ctn">
            <div class="order-confirm-sec">
                <i class="fas fa-crown fa-4x"></i>
                <h1 class="title-txt">Order Confirmation</h1>
                <p class="footer-p" style="text-align: center;">Thank you for your order <?=htmlspecialchars($_SESSION['account_name'])?>! Your receipt has been sent to your email address with an estimated delivery date.</p>

            <?php
                // If the order submission session variable is not set or not true, redirect back to order page
                if (!isset($_SESSION['order_submitted']) || $_SESSION['order_submitted'] !== true) {
                    header('Location: product-details.php');
                    exit;
                }
                else{
                    // Get the order details from the session variables
                    $print = htmlspecialchars($_SESSION['order_print']);
                    $product = htmlspecialchars($_SESSION['order_product']);
                    $colour = htmlspecialchars($_SESSION['order_colour']);
                    $size = htmlspecialchars($_SESSION['order_size']);
                    $quantity = htmlspecialchars($_SESSION['order_quantity']);
                    $comment = htmlspecialchars($_SESSION['order_comment']);
                }
                // Unset the order submission session variable so that the confirmation message only appears once
                unset($_SESSION['order_submitted']);
                // Display the order details to the user
                echo "<h2>Order Details:</h2>";
                echo "<p class='footer-p'><strong>Print:</strong> $print</p>";
                echo "<p class='footer-p'><strong>Product:</strong> $product</p>";
                echo "<p class='footer-p'><strong>Colour:</strong> $colour</p>";
                echo "<p class='footer-p'><strong>Size:</strong> $size</p>";
                echo "<p class='footer-p'><strong>Quantity:</strong> $quantity</p>";
                if (!empty($comment)) {
                    echo "<p class='footer-p'><strong>Customer Comment:</strong> $comment</p>";
                }
            ?>
                <button class="sub_btn_alt" type="button" onclick="location.replace('home.php')">Back to Shop</button>
            </div>
        </div>
    </section>
    <script src="dark.js"></script>
</body>
</html>
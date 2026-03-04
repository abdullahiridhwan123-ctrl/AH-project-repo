<?php
// We need to use sessions, so you should always initialize sessions using the below function
session_start();
// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['account_loggedin'])) {
    header('Location: login.php');
    exit;
}
// Change the below variables to reflect your MySQL database details
$db_host = 'localhost';
$db_username = '241464040';
$db_password = '241464040';
$db_name = 'phplogin';
// Try and connect using the info above
$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Ensure there are no con$con errors
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL!');
}
?>

<?php
    // get the customer order submission encoded in the URL
    $product = $_POST['product'];
    $colour = $_POST['colour'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $comment = $_POST['customer-comment'];
    

    // execute SQL query to insert values into the orders table
    $query_string = "INSERT INTO orders (product, colour, size, quantity, comment) VALUES ('$product', '$colour', '$size', '$quantity', '$comment')";

    // The query is passed to the server and the result evaluated as true if successful
    if (mysqli_query($con, $query_string))
    {
        // create session variable to confirm order submission
        $_SESSION['order_submitted'] = true;
    }
    else {
        echo "<h1> Error Confirming Order </h1>";
        echo("Error description: " . mysqli_error($con)) . "<br>";
    }
    // Close the connection
    mysqli_close($con);
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
                // Unset the order submission session variable so that the confirmation message only appears once
                unset($_SESSION['order_submitted']);
                // Display the order details to the user
                echo "<h2>Order Details:</h2>";
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
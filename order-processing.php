<?php
// Initialize sessions
session_start();
// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['account_loggedin'])) {
    header('Location: login.php');
    exit;
}

$db_host = 'localhost';
$db_username = '241464040';
$db_password = '241464040';
$db_name = 'phplogin';
// Create connection to MySQL database using the above credentials
$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Ensure there are no connection errors
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL!');
}
?>

<?php
    // get the customer order submission encoded in the URL and make them into session variables to be used on the order confirmation page
    $_SESSION['print'] = $_POST['print'];
    $_SESSION['product'] = $_POST['product'];
    $_SESSION['colour'] = $_POST['colour'];
    $_SESSION['size'] = $_POST['size'];
    $_SESSION['quantity'] = $_POST['quantity'];
    $_SESSION['comment'] = $_POST['customer-comment'];
    

    // execute SQL query to insert values into the orders table
    $query_string = "INSERT INTO orders (print, product, colour, size, quantity, comment) VALUES ('" . $_SESSION['print'] . "', '" . $_SESSION['product'] . "', '" . $_SESSION['colour'] . "', '" . $_SESSION['size'] . "', '" . $_SESSION['quantity'] . "', '" . $_SESSION['comment'] . "')";

    // The query is passed to the server and the result evaluated as true if successful
    if (mysqli_query($con, $query_string))
    {
        // create session variable to confirm order submission
        $_SESSION['order_submitted'] = true;
        // redirect to the order confirmation page
        header('Location: pre-order-confirm.php');
        exit;
    }
    else {
        echo "<h1> Error Confirming Order </h1>";
        echo("Error description: " . mysqli_error($con)) . "<br>";
    }
    // Close the connection
    mysqli_close($con);
?>
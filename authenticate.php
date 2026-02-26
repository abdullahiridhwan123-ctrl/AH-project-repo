<?php
//Start The Session
session_start();
$db_host = 'localhost';
$db_username = '241464040';
$db_password = '241464040';
$db_name = 'phplogin';
// Create connection to the database
$connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);
$error = "Incorrect Username and/or Password";

// Check for connection errors
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error
    exit('Failed to connect to MySQL!');
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists
if (!isset($_POST['username'], $_POST['password'])) {
    // Could not get the data that should have been sent
    exit('Please fill both the username and password fields!');
}
// ----- The code above was all written by me (SCN: 241464040) ----- //


// ----- The code below while mainly edited by me,was taken from https://codeshack.io/secure-login-system-php-mysql/ ----- //
// Prepare our SQL, which will prevent SQL injection
if ($stmt = $connect->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database
    $stmt->store_result();
    
    // Check if account exists with the input username
if ($stmt->num_rows > 0) {
    // Account exists, so bind the results to variables
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Note: remember to use password_hash in your registration file to store the hashed passwords
    if ($password !== null && password_verify($_POST['password'], $password)) {
        // Password is correct! User has logged in!
        // Regenerate the session ID to prevent session fixation attacks
        session_regenerate_id();
        // Declare session variables (they basically act like cookies but the data is remembered on the server)
        $_SESSION['account_loggedin'] = TRUE;
        $_SESSION['account_name'] = $_POST['username'];
        $_SESSION['account_id'] = $id;
        // Output success message
        header('Location: home.php');
        exit;
    } else {
        // Incorrect password
        $_SESSION['error'] = $error;
        header('Location: login.php');
    }
} else {
    // Incorrect username
    $_SESSION['error'] = $error;
    header('Location: login.php');
}

    // Close the prepared statement
    $stmt->close();
}
?>
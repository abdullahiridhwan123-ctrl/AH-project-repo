<?php 
    // header( "refresh:5; url=login.php" );
    header('Location: login.php');
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
    <title>Success</title>
</head>
<body>
<?php
    //Start The Session
    session_start();
    // Set Database connection variables
    $db_host = 'localhost';
    $db_username = '241464040';
    $db_password = '241464040';
    $db_name = 'phplogin';
    // Create connection to the database
    $connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    $error = "Please fill all the fields!";
    $error_username = "Username or email already exists! Please choose another!";

    // Check for connection errors
    if (mysqli_connect_errno()) {
        // If there is an error with the connection, stop the script and display the error
        exit('Failed to connect to MySQL!');
    }

    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        // Could not get the data that should have been sent
        $_SESSION['error'] = $error;
        // Redirect to the register page with the error message stored in the session variable to be displayed on the register page
        header('Location: register.php');
        exit();
    }

    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        // If One or more values are empty.
        $_SESSION['error'] = $error;
        // Redirect to the register page with the error message stored in the session variable to be displayed on the register page
        header('Location: register.php');
        exit();
    }

    if ($query = "SELECT id FROM accounts WHERE username = '" . $_POST['username'] . "' OR email = '" . $_POST['email'] . "'") {
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            // Username or email already exists
            $_SESSION['error'] = $error_username;
            // Redirect to the register page with the error message stored in the session variable to be displayed on the register page
            header('Location: register.php');
            exit();
        }
    }

    // ----- The code above was all written by me (SCN: 241464040) ----- //

    // ----- The code below while mainly edited by me,was taken from https://codeshack.io/secure-registration-system-php-mysql/ ----- //
    // Check if the username and email already exists
    if ($stmt = $connect->prepare('SELECT id, password FROM accounts WHERE username = ? OR email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('ss', trim($_POST['username'], " \t\n"), trim($_POST['email'], " \t\n"));
        $stmt->execute();
        // Store the result so we can check if the account exists in the database
        $stmt->store_result();
        
        // Validate username (must be alphanumeric)
        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('Username is not valid!');
        }

        // Validate password (between 6 and 36 characters long)
        if (strlen($_POST['password']) > 36 || strlen($_POST['password']) < 6) {
            exit('Password must be between 6 and 36 characters long!');
        }

        // Validate email (must be a valid email address)
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid!');
        }

        // Check if the account exists
        if ($stmt->num_rows > 0) {
            // Username or email already exists
            $_SESSION['error'] = $error_username;
            // Redirect to the register page with the error message stored in the session variable to be displayed on the register page
            header('Location: register.php');
            exit();
        }

        else {
            // Declare variables
            $registered = date('Y-m-d H:i:s');
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Username does not exist, insert new account
            if ($stmt = $connect->prepare('INSERT INTO accounts (username, password, email, registered) VALUES (?, ?, ?, ?)')) {
                // Bind POST data to the prepared statement
                $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $registered);
                $stmt->execute();
                // Output success message
                echo '<script>alert("You have successfully registered! You can now login!");</script>';
            }
            else {
                // Something is wrong with the SQL statement, check to make sure the accounts table exists with all 3 fields
                echo 'Could not prepare statement!';
            }
        }
        // Close the statement
        $stmt->close();
    }

    else {
        // Something is wrong with the SQL statement, check to make sure the accounts table exists with all 3 fields.
        echo 'Could not prepare statement!';
    }
    // Close the connection
    $connect->close();
?>
</body>
</html>
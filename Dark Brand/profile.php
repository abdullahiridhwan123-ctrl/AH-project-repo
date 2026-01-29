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
// Ensure there are no connection errors
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL!');
}
// We don't have the email or registered info stored in sessions so instead we can get the results from the database
// Initialize variables to prevent null type errors
$email = '';
$registered = '';

$stmt = $con->prepare('SELECT email, registered FROM accounts WHERE id = ?');
if ($stmt === null) {
    die('Prepare failed: ' . $con->error);
}
// In this case, we can use the account ID to get the account info
$stmt->bind_param('i', $_SESSION['account_id']);
$stmt->execute();
$stmt->bind_result($email, $registered);
$stmt->fetch();
$stmt->close();
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
    <title>Dark Home</title>
</head>
<body>
    <div id="dark-bg">
        <nav>
            <div id="nav-logo">
                <a href="index.php">
                    <i class="fas fa-crown fa-lg"></i>
                </a>
            </div>

            <!-- <div id="nav-right">
                <a class="nav_btn" href="new.html">New In</a>
                <a class="nav_btn" href="sale.html">Sale</a>
                <a class="nav_btn" href="brands.html">Brands</a>
                <a class="nav_btn" href="about.html">About</a>
            </div> -->

            <div class="nav-right-right">
                <div class="nav-right-ctn" id="myTopnav">
                    <div class="user-icon">
                        <a href="profile.php">
                            <i class="fas fa-user fa-lg"></i>
                        </a>
                    </div>
                    <div class="cart-icon">
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </a>
                    </div>
                    <div class="cart-icon">
                        <a href="cart.html">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </a>
                    </div>
                    <div class="menu-bar">
                        <a href="javascript:void(0);" class="icon" onclick="openNav()">
                            <i class="fas fa-bars fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- The overlay -->
        <div id="navMenu" class="overlay">
            <!-- Button to close the overlay navigation -->
            <a href="javascript:void(0);" class="closebtn" onclick="closeNav()"><i class="fas fa-times"></i></a>
            <!-- Overlay content -->
            <div class="overlay-content">
                <a class="nav_btn" href="new.html">New In</a>
                <a class="nav_btn" href="sale.html">Sale</a>
                <a class="nav_btn" href="brands.html">Brands</a>
                <a class="nav_btn" href="about.html">About</a>
                <a href="javascript:void(0);"></a>
            </div>
        </div>

        <section id="first-sec">
            <div class="section-ctn">
                <div class="block">
                    <div class="profile-detail">
                        <strong>Username</strong>
                        <?=htmlspecialchars($_SESSION['account_name'])?>
                    </div>

                    <div class="profile-detail">
                        <strong>Email</strong>
                        <?=htmlspecialchars($email)?>
                    </div>

                    <div class="profile-detail">
                        <strong>Registered</strong>
                        <?=htmlspecialchars($registered)?>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="second-sec">
            
        </section>
    </div>

    <!-- <footer>
        <div class="foot_links_left">
            <ul>
                <li><a href="#"></a>1</li>
                <li><a href="#"></a>2</li>
                <li><a href="#"></a>3</li>
                <li><a href="#"></a>4</li>
                <li><a href="#"></a>5</li>
                <li><a href="#"></a>6</li>
                <li><a href="#"></a>7</li>
                <li><a href="#"></a>8</li>
            </ul>

            <div class="foot_bottom">
                <div class="socials">
                    <a href="#"><i class="fab fa-tiktok fa-lg"></i></a>
                    <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fab fa-discord fa-lg"></i></i></a>
                </div>
            </div>
        </div>
    </footer> -->

    <script src="dark.js"></script>
</body>
</html>
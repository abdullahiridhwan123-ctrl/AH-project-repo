<?php
// We need to use sessions, so you should always initialize sessions using the below function
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
    <title>Login</title>
</head>

<body>
    <div id="dark-bg">
        <nav>
            <div id="nav-logo">
                <a href="index.php">
                    <i class="fas fa-crown fa-lg"></i>
                </a>
            </div>

            <div id="nav-right" style="display: none;">
                <a class="nav_btn" href="new.html">New In</a>
                <a class="nav_btn" href="sale.html">Sale</a>
                <a class="nav_btn" href="brands.html">Brands</a>
                <a class="nav_btn" href="about.html">About</a>
            </div>

            <div class="nav-right-right" style="display: none;">
                <div class="nav-right-ctn" id="myTopnav">
                    <div class="user-icon">
                        <a href="login.php">
                            <i class="fas fa-user fa-lg"></i>
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

    <div id="login-ctn">
        <h1>Login</h1>

        <form action="authenticate.php" method="post" class="login-form">
                <div class="form-group">
                    <i class="fas fa-user form-icon-left"></i>
                    <input class="form-input" type="text" name="username" placeholder="Username" id="username" maxlength="30" required >
                </div>

                <div class="form-group mar-bot-5">
                    <i class="fas fa-user-lock form-icon-left"></i>
                    <input class="form-input" type="password" name="password" placeholder="Password" id="password" maxlength="36" required>
                    <div class="show-pass-btn" onclick="showPassword()"> <i class="far fa-eye form-icon-right" id="showPass"></i> </div>
                </div>

                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span style='color:red; text-align:center; font-size:11px;'>$error</span>";
                    }
                ?>  
                
                <button class="sub_btn" type="submit">Login</button>

                <p class="register-link" style="padding: 0 0;"> OR </p>

                <div class="sub_btn">
                    <p>Continue with <i class="fab fa-google"></i></p>
                </div>

                <p class="register-link">Don't have an account? <a href="register.php" class="form-link">Create one</a></p>
        </form>
    </div>
    <script src="/Other/dark.js"></script>
</body>
</html>

<?php
    unset($_SESSION["error"]);
?>

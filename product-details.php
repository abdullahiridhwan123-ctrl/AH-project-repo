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
    <title>Brands</title>
</head>

<body>
    <div id="dark-bg">
        <nav>
            <div id="nav-logo">
                <a href="index.php">
                    <i class="fas fa-crown fa-lg"></i>
                </a>
            </div>

            <div id="nav-right">
                <a class="nav_btn" href="new.html">New In</a>
                <a class="nav_btn" href="sale.html">Sale</a>
                <a class="nav_btn" href="brands.html">Brands</a>
                <a class="nav_btn" href="about.html">About</a>
            </div>

            <div class="nav-right-right">
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
    </div>

    <section id="first-sec">
        <div class="section-ctn">
            <form action="pre-order-confirm.php" method="POST" id="print-order-form">
                <h1 class="prod-title">Please fill out the Order form.</h1>
                <select name="product" id="product" required>
                    <option value="" disabled selected><--Hoodies--></option>
                    <option value="Pullover Hoodie">Dynamix Pullover Hoodie</option>
                    <option value="Zip-up Hoodie">Dynamix Zip-up Hoodie</option>
                    <option value="Fleece Hoodie">Dynamix Fleece Hoodie</option>
                    <option value="Oversized Hoodie">Dynamix Oversized Hoodie</option>
                    <option value="" disabled selected><--Tshirts--></option>
                    <option value="Oversized T-Shirt">Dynamix Oversized fit T-Shirt</option>
                    <option value="Loose T-Shirt">Dynamix Loose fit T-Shirt</option>
                    <option value="Regular T-Shirt">Dynamix Regular fit T-Shirt</option>
                    <option value="Cropped T-Shirt">Dynamix Cropped T-Shirt</option>
                    <option value="" disabled selected><--Jackets--></option>
                    <option value="Hooded Jacket">Dynamix Hooded Jacket</option>
                    <option value="Shirt Jacket">Dynamix Shirt Jacket</option>
                    <option value="Fleece Jacket">Dynamix Fleece Jacket</option>
                    <option value="Puffer Jacket">Dynamix Puffer Jacket</option>
                    <option value="Windproof Jacket">Dynamix Windproof Jacket</option>
                    <option value="" disabled selected>Select Product</option>
                </select>

                <select name="colour" id="colour" required>
                    <option value="" disabled selected>Select Colour</option>
                    <option value="Jet Black">Jet Black</option>
                    <option value="Pure White">Pure White</option>
                    <option value="Light Grey">Light Grey</option>
                    <option value="Royal Blue">Royal Blue</option>
                    <option value="Crimson Red">Crimson Red</option>
                    <option value="Emerald Green">Emerald Green</option>
                    <option value="Midnight Purple">Midnight Purple</option>
                </select>

                <select name="size" id="size" required>
                    <option value="" disabled selected>Select Size</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">X-Large (XL)</option>
                    <option value="XXL">XX-Large (XXL)</option>
                </select>

                <input type="number" name="quantity" id="quantity" min="1" max="12" value="1">

                <div>
                    <p>If you would like to personalise your product, please let us know in the comment area:</p>
                    <textarea name="customer-comment" id="customer-comment" placeholder="Type here..." cols="40"></textarea>
                </div>
                
                <div>
                    <p id="mail-list">Subscribe to our Mailing list to stay informed, get early access to new collections and access to exclusive offers.</p>
                    <input type="checkbox" name="email-list" id="email-list">
                </div>

                <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
                    <button class="sub_btn_alt" type="submit">Submit Order</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <!-- <div class="footer-top-section">
            <div class="footer-ctn">
                <button class="footer-accordion-btn" onmousedown="toggleAccordion()"><h3 class="footer-title">Shop</h3></button>
                <div class="accordion-panel">
                    <a href="#">All</a>
                    <a href="#">Accessories</a>
                    <a href="#">Outerwear</a>
                    <a href="#">Sale</a>
                    <a href="#">Gift Card</a>
                </div>
            </div>

            <div class="footer-ctn">
                <button class="footer-accordion-btn" onmousedown="toggleAccordion()"><h3 class="footer-title">Helpful Links</h3></button>
                <div class="accordion-panel">
                    <a href="#">FAQ</a>
                    <a href="#">Shipping & Returns</a>
                    <a href="#">Size Guide</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                </div>
            </div>

            <div class="footer-ctn">
                <button class="footer-accordion-btn" onmousedown="toggleAccordion()"><h3 class="footer-title">Contact Us</h3></button>
                <div class="accordion-panel">
                    <p class="footer-p">Email: contact@dynamix.com</p>
                </div>
                <div class="socials">
                    <a href="#"><i class="fab fa-tiktok fa-lg"></i></a>
                    <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fab fa-discord fa-lg"></i></a>
                </div>
            </div>
        </div> -->
        

        <div class="footer-logo">
            <div>
                <h2 class="title-txt-alt">DYNAMIX</h2>
            </div>
            
        </div>
        <p class="copyright-p">© 2026 DYNAMIX. All rights reserved.</p>
    </footer>

    <script src="dark.js"></script>
</body>
</html>
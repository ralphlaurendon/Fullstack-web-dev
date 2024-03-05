<?php session_start();
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
}?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <br>
        <ul>
        <?php if (isset($_SESSION["user_id"])) {
            echo "<p style='color: green;'>$message</p>";?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Profile</a></li>
        <?php } elseif (isset($message)) {
                echo "<p style='color: red;'>$message</p>";
        ?>
                <li><a href="user_registration.php">Register</a></li>
                <li><a href="user_login.php">Login</a></li>
        <?php
            }else { ?>
            <li><a href="user_registration.php">Register</a></li>
            <li><a href="user_login.php">Login</a></li>
        <?php } ?>
        </ul>
    </nav>
</header>
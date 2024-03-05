<?php
session_start();

include 'inc_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT UserID, Username, Password FROM [USER] WHERE Username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION['user_id'] = $user['UserID'];
        //User login is successful
        $_SESSION['message'] = "Successful login";

    } else {
        //User login is not successful
        $_SESSION["message"] = "Invalid username or password";
    }
}
header('Location: index.php');

exit();
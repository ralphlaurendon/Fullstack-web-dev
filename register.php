<?php
include 'inc_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO [USER] (Username, Email, Password, Role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hash, $role]);

    //Check if the role was inserted correctly
    if ($stmt->rowCount() > 0) {
        header('Location: index.php');
    } else {
        echo "Error inserting row.";
    }

    exit();
}
<?php
session_start();
include 'inc_dbconnect.php';

$title = $_POST['title'];
$isbn = $_POST['isbn'];
$genre = $_POST['genre'];
$price = $_POST['price'];
$authorID = $_POST['authorID']; // Assuming you will have a field to capture this in the form
$publisherID = $_POST['publisherID']; // Assuming you will have a field to capture this in the form

$stmt = $conn->prepare('INSERT INTO BOOK (Title, ISBN, Genre, Price, AuthorID, PublisherID) VALUES
(:title, :isbn, :genre, :price, :authorID, :publisherID)');

$stmt->execute([
    'title' => $title,
    'isbn' => $isbn,
    'genre' => $genre,
    'price' => $price,
    'authorID' => $authorID,
    'publisherID' => $publisherID
]);

if ($stmt->rowCount() > 0) {
    $message = "New item added to database!";
} else {
    $message = "Error: Failed to add new item to database.";
}

//Store the message in a session variable
$_SESSION['message'] = $message;

// Redirect the user back to the original form
header("Location: admin.php");
exit();
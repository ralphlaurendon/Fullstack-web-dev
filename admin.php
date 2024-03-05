<?php include 'inc_dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Book</title>
</head>
<body>
    <?php
    session_start();

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <h1>Add Book</h1>
    <form action="insert_book.php" method="post">
    <label>Title:</label>
    <input type="text" name="title"><br>

    <label>ISBN:</label>
    <input type="text" name="isbn"><br>

    <label>Genre:</label>
    <select name="genre">
        <option value="">Select Genre</option>
        <?php
            $stmt = $conn->prepare('SELECT DISTINCT Genre FROM BOOK');
            $stmt->execute();
            $genres = $stmt->fetchAll();

            foreach ($genres as $genre) {
                echo '<option value="'.$genre['Genre'].'">'.$genre['Genre'].'</option>';
            }
        ?>
    </select><br>

    <label>Price:</label>
    <input type="number" name="price" step="0.01"><br>

    <label>Author:</label>
    <select name="authorID">
        <option value="">Select Author</option>
        <?php
            $stmt = $conn->prepare('SELECT AuthorID, Name FROM AUTHOR');
            $stmt->execute();
            $authors = $stmt->fetchAll();

            foreach ($authors as $author) {
                echo '<option value="'.$author['AuthorID'].'">'.$author['Name'].'</option>';
            }
        ?>
    </select><br>

    <label>Publisher:</label>
    <select name="publisherID">
        <option value="">Select Publisher</option>
        <?php
            $stmt = $conn->prepare('SELECT PublisherID, Name FROM PUBLISHER');
            $stmt->execute();
            $publishers = $stmt->fetchAll();

            foreach ($publishers as $publisher) {
                echo '<option value="'.$publisher['PublisherID'].'">'.$publisher['Name'].'</option>';
            }
        ?>
    </select><br>

    <input type="submit" value="Add Book">
</form>

</body>
</html>

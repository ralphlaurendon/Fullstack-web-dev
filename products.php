<?php include 'inc_dbconnect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Simple Website Template</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php include 'inc_nav.php'; ?>
    <section id="shop">
        <h1>Buy Stuff</h1>
        <p>
            <?php
            $genre = isset($_GET['genre']) ? $_GET['genre'] : false;

            if ($genre) {
                $stmt = $conn->prepare("SELECT * FROM BOOKS WHERE Genre = :genre");
                $stmt->execute([':genre' => $genre]);
                $books = $stmt->fetchAll();

                foreach ($result as $row) {
                    echo $row['title'] . "<br";
                    echo $row['genre'] . "<br>";
                    echo $row["price"] ."<br>";
                    echo "<a href='cart.php?action=add&id=" . $row['book_id'] ."'>Add to Cart</a><br>";
                }

                foreach ($books as $book) {
                    echo "Title: " . htmlspecialchars($book['Title']) . "<br>";
                    echo "Author: " . htmlspecialchars($book['Author']) . "<br>";
                    echo "Price: $" . htmlspecialchars($book['Price']) . "<br><br>";
                }
            } else {
                echo "No genre selected.";
            }
            ?>
        </p>
    </section>
    <footer>Copyright © 2021 Simple Website Template</footer>
</body>

</html>
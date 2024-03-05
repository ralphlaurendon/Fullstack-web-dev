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
            // Adjusted to fetch distinct genres for clickable links
            $stmt = $conn->prepare("SELECT DISTINCT Genre FROM BOOKS");
            $stmt->execute();
            $genres = $stmt->fetchAll();

            foreach ($genres as $genre) {
                echo "<a href='products.php?genre=".urlencode($genre['Genre'])."'>".$genre['Genre']."</a><br>";
            }
            ?>
        </p>
    </section>
    <footer>Copyright © 2021 Simple Website Template</footer>
</body>

</html>
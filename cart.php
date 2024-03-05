<?php

include 'inc_dbconnect.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}

$book_id = isset($_GET['BookID']) ? $_GET['BookID'] : 0;

?>
<!DOCTYPE html>
<html lang = en>

<head>
    <title>Simple Website Template</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include 'inc_nav.php'; ?>
    <section id="home">
        <h1>Cart</h1>
        <p>
            <?php
            switch ($action) {
                case 'add':
                    addToCart($book_id, $conn);
                    break;
                case 'update':
                    updateCart($conn);
                    break;
                case 'delete':
                    deleteCart($book_id, $conn);
                    break;
                case 'clear':
                    clearCart($conn);
                    break;
                default:
                    displayCart($conn);
                    break;
            }

            function addToCart($book_id, $conn) {
                if (isset($_SESSION['cart'][$book_id])) {
                    $_SESSION['cart'][$book_id]++;
                } else {
                    $_SESSION['cart'][$book_id] = 1;
                }
                displayCart($conn);
            }

            function updateCart($conn) {
                if (isset($_POST['quantity'])) {
                    foreach ($_POST['quantity'] as $book_id => $quantity) {
                        if ((int)$quantity <=0) {
                            unset($_SESSION['cart'][ $book_id ]);
                        } else {
                            $_SESSION['cart'][$book_id] = (int)$quantity;
                        }
                    }
                }
                displayCart($conn);
            }

            function deleteCart($book_id, $conn) {
                if (isset($_SESSION['cart'][$book_id])) {
                    unset($_SESSION['cart'][$book_id]);
                }
                displayCart($conn);
            }

            function clearCart($conn) {
                $_SESSION['CART'] = array();
                displayCart($conn);
            }

            function displayCart($conn) {
                if (empty($_SESSION['cart'])) {
                    echo "Your cart is empty.";
                    return;
                }

                $book_ids = array_keys($_SESSION['cart']);
                $placeholders = rtrim(str_repeat('?', count($book_ids)),',');
                $stmt = $conn->prepare("SELECT * FROM [BOOK] WHERE BookID IN ($placeholders)");
                $stmt->execute($book_ids);
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Start the form
                echo "<form action='cart.php' method='post'>";
                echo "<input type='hidden' name='action' value='update'>";
                
                foreach ($books as $book) {
                    echo $book['title'] . " x ";
                    echo "<input type='number' min='1' name='quantity'[" . $book['book_id'] . "]'
                    value='" . $_SESSION['cart'][$book['book_id']] . "'>";
                echo " <a href='cart.php?action=delete&id=" . $book['book_id'] . "'>Remove</a>";
                echo "<br>";
                }

                // Add the 'Update Cart' button
                echo "<input type='submit' value ='Update Cart'>";
                echo "</form>";
                echo "<a href='cart.php?action=clear'>Clear Cart</a>";
                echo "<br><br><a href='checkout.php'>Checkout</a>";
            }
            ?>
        </p>
    </section>
    <footer>Copyright © 2021 Simple Website Template</footer>
</body>

</html>
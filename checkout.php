<?php
include 'inc_dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    processCheckout($conn);
} else {
    displayCheckoutForm($conn);
}

function processCheckout($conn) {
    // Simulate a fake payment method
    $payment_status = 'completed';

    if($payment_status == 'completed') {
        $customer_id = $_POST['user_id'];
        //Insert order into database
        $stmt = $conn->prepare("INSERT INTO [PURCHASE] (customer_id) VALUES (?)");
        $stmt->execute([$customer_id]);
        $order_id = $stmt->lastInsertID();

        // Insert order items into the databse
        foreach ($_SESSION['cart'] as $book_id => $quantity) {
            $stmt = $conn->prepare("INSERT INTO PURCHASE_ITEMS (purchase_id, book_id) VALUES (?, ?)");
            $stmt->execute([$order_id, $book_id, $quantity]);
        }
        
        // Clear the cart
        $_SESSION['cart'] = [];

        echo 'Your order has been placed successfully. Check your email for the order confirmation.';
    } else {
        echo 'Error: Payment not completed.';
    }
}

function displayCheckoutForm($conn) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Simple Website Template</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <?php include 'inc_nav.php'; ?>
        <?php displayCartSummary($conn); ?>
        <section id="checkout">
            <h1>Checkout</h1>
                <form action="checkout,php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <input type="submit" value="Place Order">
                </form>
        </section>
        <footer>Copyright © 2021 Simple Website Template</footer>
    </body>

    </html>
<?php
}

function displayCartSummary($conn) {

    if (empty($_SESSION['cart'])) {
        echo "Your cart is empty.";
        return;
    }

    $book_ids = array_keys((array)$_SESSION['cart']);
    $placeholders = rtrim(str_repeat('?,', count($book_ids)), ',');
    $stmt = $conn->prepare("SELECT * FROM [BOOK] WHERE BookID IN ($placeholders)");
    $stmt->execute($book_ids);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Cart Summary<h2>";
    echo "<table>";
    echo "<tr><th>Product</th><th>Quantity</th></tr>";

    foreach ($books as $book) {
        echo "<tr>";
        echo "<td>" . $book["Title"] ."</td>";
        echo "<td>". $_SESSION['cart'][$book['book_id']] ."</td>";
        echo "</tr>";
    }

    echo "</table><br><br>";
}
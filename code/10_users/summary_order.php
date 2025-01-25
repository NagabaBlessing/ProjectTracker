<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['order'] = [
        'Rolls-Royce' => $_POST['product1'],
        'Bentley Continental GT' => $_POST['product2'],
        'BMW' => $_POST['product3'],
        'Audi' => $_POST['product4'],
        'Lexus' => $_POST['product5'],
        'Escalade' => $_POST['product6'],
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
</head>
<body>
    <h1>Order Summary</h1>

    <?php if (isset($_SESSION['order'])): ?>
        <ul>
            <?php foreach ($_SESSION['order'] as $product => $quantity): ?>
                <li><?= ucfirst(str_replace('_', ' ', $product)) . ": " . ($quantity ? $quantity : '0'); ?></li>
            <?php endforeach; ?>
        </ul>

        <a href="form_order.php">Back to Order Form</a>
        <br><br>
        <form action="" method="POST">
            <input type="submit" name="checkout" value="Check Out">
        </form>

        <?php
        if (isset($_POST['checkout'])) {
            unset($_SESSION['order']);
            echo "<p>Your order has been cleared!</p>";
        }
        ?>

    <?php else: ?>
        <p>No order has been placed yet.</p>
        <a href="order_form.php">Go to Order Form</a>
    <?php endif; ?>

</body>
</html>

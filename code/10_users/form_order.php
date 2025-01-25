<!-- Write a PHP program that displays an order form. The order form should list six
products. Next to each product name there should be a text box into which a user
can enter how many of that product she wants to order. When the form is sub!
mitted, the submitted form data should be saved into the session. Make another
page that displays the contents of the saved order, a link back to the order form
page, and a Check Out button. If the link back to the order form page is clicked,
the order form page should be displayed with the saved order quantities from the
session in the text boxes. When the Check Out button is clicked, the order should
be cleared from the session -->


<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
</head>
<body>
    <h1>Order Form</h1>

    <form action="summary_order.php" method="POST">
        <label for="product1">Rolls-Royce :</label>
        <input type="number" name="product1" value="<?= isset($_SESSION['order']['product1']) ? $_SESSION['order']['product1'] : ''; ?>" min="0">
        <br><br>

        <label for="product2">Bentley Continental GT:</label>
        <input type="number" name="product2" value="<?= isset($_SESSION['order']['product2']) ? $_SESSION['order']['product2'] : ''; ?>" min="0">
        <br><br>

        <label for="product3">BMW:</label>
        <input type="number" name="product3" value="<?= isset($_SESSION['order']['product3']) ? $_SESSION['order']['product3'] : ''; ?>" min="0">
        <br><br>

        <label for="product4">Audi:</label>
        <input type="number" name="product4" value="<?= isset($_SESSION['order']['product4']) ? $_SESSION['order']['product4'] : ''; ?>" min="0">
        <br><br>

        <label for="product5">Lexus:</label>
        <input type="number" name="product5" value="<?= isset($_SESSION['order']['product5']) ? $_SESSION['order']['product5'] : ''; ?>" min="0">
        <br><br>

        <label for="product6">Escalade:</label>
        <input type="number" name="product6" value="<?= isset($_SESSION['order']['product6']) ? $_SESSION['order']['product6'] : ''; ?>" min="0">
        <br><br>

        <input type="submit" value="Submit Order">
    </form>
</body>
</html>

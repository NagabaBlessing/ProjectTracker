<!-- Write a program that displays a form asking for a price. When the form is sub!
mitted, the program should print out the names and prices of the dishes whose
price is at least the submitted price. Don’t retrieve from the database any rows or
columns that aren’t printed in the table. -->
<?php
$server = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "test"; 

try {
    $db = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$dishes = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

    $stmt = $db->prepare("SELECT dish_name, price FROM dishes WHERE price >= :price");
    $stmt->execute(['price' => $price]);
    $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> Dishes by Price</title>
</head>
<body>
    <h1> Dishes by Price</h1>
    <form method="POST">
        <label for="price">Enter minimum price:</label>
        <input type="number" step="0.01" id="price" name="price" required>
        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($dishes)): ?>
        <h2>Results:</h2>
        <table border="1">
            <tr>
                <th>Dish Name</th>
                <th>Price</th>
            </tr>
            <?php foreach ($dishes as $dish): ?>
                <tr>
                    <td><?= htmlspecialchars($dish['dish_name']) ?></td>
                    <td><?= htmlspecialchars($dish['price']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

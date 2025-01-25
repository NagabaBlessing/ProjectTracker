<!-- Write a program that displays a form with a <select> menu of dish names. Cre!
ate the dish names to display by retrieving them from the database. When the
form is submitted, the program should print out all of the information in the
table (ID, name, price, and spiciness) for the selected dish. -->

<?php
$server = "localhost"; 
$username = "root"; 
$password = "1234@1234"; 
$dbname = "test";

try {
    $db = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$stmt = $db->query("SELECT dish_id, dish_name FROM dishes");
$dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selected_dish = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dish_id = isset($_POST['dish_id']) ? (int)$_POST['dish_id'] : 0;

    $stmt = $db->prepare("SELECT * FROM dishes WHERE dish_id = :dish_id");
    $stmt->execute(['dish_id' => $dish_id]);
    $selected_dish = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dish Details</title>
</head>
<body>
    <h1>Select a Dish</h1>
    <form method="POST">
        <label for="dish_id">Choose a dish:</label>
        <select name="dish_id" id="dish_id" required>
            <option value="">-- Select a Dish --</option>
            <?php foreach ($dishes as $dish): ?>
                <option value="<?= htmlspecialchars($dish['dish_id']) ?>">
                    <?= htmlspecialchars($dish['dish_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php if ($selected_dish): ?>
        <h2>Dish Details</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Spiciness</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($selected_dish['dish_id']) ?></td>
                <td><?= htmlspecialchars($selected_dish['dish_name']) ?></td>
                <td><?= htmlspecialchars($selected_dish['price']) ?></td>
                <td><?= htmlspecialchars($selected_dish['is_spicy']) ? 'Spicy' : 'Not Spicy' ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>
</html>

<?php
$server = "localhost"; 
$username = "root"; 
$password = "1234@1234"; 
$dbname = "test";

function DatabaseConnect($e) {
    error_log("Database Error: " . $e->getMessage());

    echo "<p>There was an error processing your request. Please try again later.</p>";

   
    exit();
}

try {
    $db = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerName = $_POST['customer_name'];
        $phoneNumber = $_POST['phone_number'];
        $favoriteDish = $_POST['favorite_dish'];

        $stmt = $db->prepare("INSERT INTO customers (customer_name, phone_number, favorite_dish_id) VALUES (:customer_name, :phone_number, :favorite_dish_id)");
        $stmt->execute([
            ':customer_name' => $customerName,
            ':phone_number' => $phoneNumber,
            ':favorite_dish_id' => $favoriteDish
        ]);

        echo "<p>Customer added successfully!</p>";
    }

    $dishStmt = $db->query("SELECT dish_id, dish_name FROM dishes");
    $dishes = $dishStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    DatabaseConnect($e); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>
    <form method="POST" action="">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name" required>
        <br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" required>
        <br><br>

        <label for="favorite_dish">Favorite Dish:</label>
        <select name="favorite_dish" id="favorite_dish" required>
            <option value="">Select a Dish</option>
            <?php foreach ($dishes as $dish): ?>
                <option value="<?= $dish['dish_id']; ?>"><?= htmlspecialchars($dish['dish_name']); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit">Add Customer</button>
    </form>
</body>
</html>

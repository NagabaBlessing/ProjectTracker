<?php
session_start();

if (isset($_POST['color'])) {
    $_SESSION['color'] = $_POST['color'];
}

$backgroundColor = isset($_SESSION['color']) ? $_SESSION['color'] : 'white'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Display</title>
</head>
<body style="background-color: <?= htmlspecialchars($backgroundColor); ?>;">
    <h1>Your Favorite Color is: <?= htmlspecialchars($backgroundColor); ?></h1>
    <p>The background color of this page is set to your favorite color!</p>
    <a href="form_color.php">Change Color</a>
</body>
</html>

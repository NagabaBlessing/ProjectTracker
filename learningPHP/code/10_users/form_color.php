<!-- Write a PHP program that displays a form for a user to pick his favorite color
from a list of colors. Make another page whose background color is set to the
color that the user picks in the form. Store the color value in $_SESSION so that
both pages can access it. -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick Your Favorite Color</title>
</head>
<body>
    <h1>Pick Your Favorite Color</h1>
    <form action="color_display.php" method="POST">
        <label for="color">Choose a color:</label>
        <select name="color" id="color">
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
            <option value="yellow">Yellow</option>
            <option value="orange">Orange</option>
            <option value="purple">Purple</option>
        </select>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

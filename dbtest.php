<?php
echo "Step 1<br>";

$conn = mysqli_connect("localhost", "root", "", "test");

echo "Step 2<br>";

if (!$conn) {
    die("Connection failed");
}

echo "Step 3 - Connected!";
?>
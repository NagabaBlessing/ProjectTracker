<!-- The following exercises use a database table called dishes with the following struc!
ture:
CREATE TABLE dishes (
dish_id
INT,
dish_name
VARCHAR(255),
price
DECIMAL(4,2),
is_spicy
INT
)
Here is some sample data to put into the dishes table:
INSERT INTO dishes VALUES (1,'Walnut Bun',1.00,0)
INSERT INTO dishes VALUES (2,'Cashew Nuts and White Mushrooms',4.95,0)
INSERT INTO dishes VALUES (3,'Dried Mulberries',3.00,0)
INSERT INTO dishes VALUES (4,'Eggplant with Chili Sauce',6.50,1)
INSERT INTO dishes VALUES (5,'Red Bean Bun',1.00,0)
INSERT INTO dishes VALUES (6,'General Tso''s Chicken',5.50,1)
1. Write a program that lists all of the dishes in the table, sorted by price. -->
<?php
$server = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "test"; 


$conn = new mysql($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT dish_id, dish_name, price FROM dishes ORDER BY price";
$results = $conn->query($sql);

if ($results->rows > 0) {
    echo "<h1>List of Dishes</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['dish_name']) . " - $" . htmlspecialchars($row['price']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "No dishes found.";
}

$conn->close();
?>

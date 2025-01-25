<!-- Find and fix the errors in it.
// Connect to the database
try {
$db = new PDO('sqlite::/tmp/restaurant.db');
} catch ($e) {
die("Can't connect: " . $e->getMessage());
}
// Set up exception error handling
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Set up fetch mode: rows as arrays
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// Get the array of dish names from the database
$dish_names = array();
$res = $db->query('SELECT dish_id,dish_name FROM dishes');
foreach ($res->fetchAll() as $row) {
$dish_names[ $row['dish_id']]] = $row['dish_name'];
}
$res = $db->query('SELECT ** FROM customers ORDER BY phone DESC');
$customers = $res->fetchAll();
if (count($customers) = 0) {
print "No customers.";
} else {
print '<table>';
print '<tr><th>ID</th><th>Name</th><th>Phone</th>
<th>Favorite Dish</th></tr>';
foreach ($customers as $customer) {
printf("<tr><td>%d</td><td>%s</td><td>%f</td><td>%s</td></tr>\n",
$customer['customer_id'],
htmlentities($customer['customer_name']),
$customer['phone'],
$customer['favorite_dish_id']);
}
print '</table>'; -->


<?php
// Connect to the database
try {
    $db = new PDO('sqlite:/tmp/restaurant.db'); //  Remove extra colon before the path
} catch (PDOException $e) { //  Catch specific exception type for better error handling
    die("Can't connect: " . $e->getMessage());
}


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$dish_names = array();
$res = $db->query('SELECT dish_id, dish_name FROM dishes');
foreach ($res->fetchAll() as $row) {
    $dish_names[$row['dish_id']] = $row['dish_name']; //  Removed extra bracket
}

$res = $db->query('SELECT * FROM customers ORDER BY phone DESC'); //  Changed SELECT ** to SELECT *
$customers = $res->fetchAll();

if (count($customers) == 0) { //  Changed '=' to '==' for comparison
    print "No customers.";
} else {
    print '<table>';
    print '<tr><th>ID</th><th>Name</th><th>Phone</th><th>Favorite Dish</th></tr>';
    
    foreach ($customers as $customer) {
        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", //  Changed %f to %s for phone number
            $customer['customer_id'],
            htmlentities($customer['customer_name']),
            htmlentities($customer['phone']), //  Used htmlentities for phone number
            htmlentities($customer['favorite_dish_id'])); 
    }
    
    print '</table>';
}
?>


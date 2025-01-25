<!-- 
<form method="POST" action="order.php">
Braised Noodles with: <select name="noodle">
<option>crab meat</option>
<option>mushroom</option>
<option>barbecued pork</option>
<option>shredded ginger and green onion</option>
</select>
<br/>
Sweet: <select name="sweet[]" multiple>
<option value="puff"> Sesame Seed Puff
<option value="square"> Coconut Milk Gelatin Square
<option value="cake"> Brown Sugar Cake
<option value="ricemeat"> Sweet Rice and Meat
</select>
<br/>
Sweet Quantity: <input type="text" name="sweet_q">
<br/>
<input type="submit" name="submit" value="Order">
</form> -->



<?php
function process_form() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    echo htmlspecialchars($key) . ": " . htmlspecialchars($item) . "<br/>";
                }
            } else {
                echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br/>";
            }
        }
    } else {
        echo "No form data submitted.";
    }
}

process_form();
?>




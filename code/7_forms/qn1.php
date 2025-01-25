<!-- 
What does $_POST look like when the following form is submitted with the third
option in the Braised Noodles menu selected, the first and last options in the
Sweet menu selected, and 4 entered into the text box?


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
</form> 
?>
-->



Array
(
    [noodle] => barbecued pork //not an array
    [sweet] => Array
        (
            [0] => puff
            [1] => ricemeat
        )

    [sweet_q] => 4
)

<!-- Add a method to your IngredientCost class that changes the cost of an ingredi!
ent. -->
<?php
use Test\Ingredient;
require 'ingredient.php';

// Creating an instance
$tomatoes = new Ingredient("Tomatoes", 10500);
echo $tomatoes->product(); 

echo "\n"; 
echo $tomatoes->newcost(12000);
echo "\n";
echo $tomatoes->product(); 

?>
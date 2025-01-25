<?php
include 'entree.php';
include 'ingredient.php';
class IngredientEntree extends Entree {
    public function Total() {
        $totalCost = 0;

        foreach ($this->ingredients as $ingredient) {
            $totalCost += $ingredient->cost; // Add each ingredient's cost
        }

        return $totalCost;
    }
}

$tomato = new Ingredient("Tomato", 9);
$mango = new Ingredient("Mango", 80);
$onion = new Ingredient("onion", 700);
//creat instance
$pizza = new IngredientEntree("Pizza");
//
$pizza->add_ingredient($tomato);
$pizza->add_ingredient($mango);
$pizza->add_ingredient($onion);

// shos total cost 
echo "The total cost of {$pizza->name} is $" . $pizza->Total();
?>
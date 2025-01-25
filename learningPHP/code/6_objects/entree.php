<!-- Make a subclass of the Entree class used in this chapter that accepts Ingredient
objects instead of string ingredient names to specify the ingredients. Give your
Entree subclass a method that returns the total cost of the entrée. -->
<?php
class Entree {
    public $name;
    public $ingredients = []; 

    public function __construct($name) {
        $this->name = $name;
    }

    public function add_ingredient($ingredient) {
        $this->ingredients[] = $ingredient;
    }
}
?>
<?php
namespace Test;
class Ingredient{
    public $name;
    public $cost;

    public function __construct($name,$cost){
        $this->name = $name;
        $this->cost = $cost;

    }
    public function product(){
        return "Ingredient is : $this->name ,Cost Shs." . number_format( $this->cost)  ;
    }
    public function newcost($newCost) {
        $this->cost = $newCost;
        return "Ingredient is: $this->name, with new Cost Shs.".number_format($newCost);
    }
}

?>
<!-- Create a class called Ingredient. Each instance of this class represents a single
ingredient. The instance should keep track of an ingredient’s name and its cost. -->
<!-- What does the following code print out? -->
<?php
function restaurant_check($meal, $tax, $tip) {
$tax_amount = $meal * ($tax / 100);
$tip_amount = $meal * ($tip / 100);
return $meal + $tax_amount + $tip_amount;
}
$cash_on_hand = 31;
$meal = 25;
$tax = 10;
$tip = 10;
while(($cost = restaurant_check($meal,$tax,$tip)) < $cash_on_hand) {
$tip++;
print "I can afford a tip of $tip% ($cost)\n";
}
?>

<!-- 
answer

in the first iteration  the restaurant_check function will return  30
 hence making  the while loop false
 the tip value will be increased by 1 making it 11 and print i can afford a tip of 11% (30)
in the second iteration the  while condition will be false  and the restaurant_check function would 
return 30.25 tip will be increased to 12 and print i can afford a tip of 12% (30.25)
in the third iteration the  while condition will be false  and the restaurant_check function would 
return 30.5 tip will be increased to 13 and print i can afford a tip of 13% (30.5)
in the fourth iteration the  while condition will be false  and the restaurant_check function would 
return 30.75 tip will be increased to 14 and print i can afford a tip of 14% (30.75)
in the fifth iteration the while condition will be true hence terminating .
therefore the output is 
I can afford a tip of 11% (30)
I can afford a tip of 12% (30.25)
I can afford a tip of 13% (30.5)
I can afford a tip of 14% (30.75)
-->
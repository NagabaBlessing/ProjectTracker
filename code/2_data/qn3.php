Qn3:
<!-- 
Modify your solution to the previous exercise to print out a formatted bill.
 For each item in the meal, print the price, quantity, and total cost. 
 Print the pre-tax food and drink total, the post-tax total, and the total with tax and tip.
  Make sure that prices in your output are vertically aligned. -->

  <html>
<head>
<title> Total cost</title>
</head>
<body>
<?php
$hamburgers_cost = 4.95;
$chocolate_milkshake = 1.95;
$colo = 0.85;
$sales_tax = 0.075;
$pre_tax = 0.16;
$hamburgers_qty = 2;
$colo_qty = 1;
$chocolate_qty = 1;
$hamburgers_total = $hamburgers_cost * $hamburgers_qty;
$chocolate_total = $chocolate_milkshake * $chocolate_qty;
$cola_total = $cola_qty * $cola;


$cost = ($hamburgers_cost * $hamburgers_qty) + ($chocolate_milkshake * $chocolate_qty) + ($cola * $colo_qty);

$tax = $cost * $sales_tax;
$tip = $cost * $pre_tax;

$total = $cost + $tax + $tip;



print str_pad("Item", 20) . str_pad("Price", 10) . str_pad("Qty", 5) . str_pad("Total", 10) . "\n";
print str_repeat("-", 45) . "\n";
printf("%-20s %10.2f %5d %10.2f\n", "Hamburger", $hamburgers_cost, $hamburgers_qty, $hamburgers_total);
printf("%-20s %10.2f %5d %10.2f\n", "Milkshake", $chocolate_milkshake, $chocolate_qty, $chocolate_total);
printf("%-20s %10.2f %5d %10.2f\n", "Cola", $colo, $colo_qty, $cola_total);
print str_repeat("-", 45) . "\n";
printf("%-30s %15.2f\n", "Pre-tax Total:", $cost);
printf("%-30s %15.2f\n", "Sales Tax (7.5%):", $tax);
printf("%-30s %15.2f\n", "Tip (16%):", $tip);
print str_repeat("-", 45) . "\n";
printf("%-30s %15.2f\n", "Total with Tax and Tip:", $total);
?>
</body>
</html>


<?php
$hamburgers_cost = 4.95;
$chocolate_milkshake = 1.95;
$colo = 0.85;
$sales_tax = 0.075;
$pre_tax = 0.16;
$hamburgers_qty = 2;
$colo_qty = 1;
$chocolate_qty = 1;

$cost = ($hamburgers_cost * $hamburgers_qty) + ($chocolate_milkshake * $chocolate_qty) + ($colo * $colo_qty);

$tax = $cost * $sales_tax;
$tip = $cost * $pre_tax;

$total  = $cost + $tax + $tip;
echo "Cost is : $" . number_format($cost, 2) . "\n";
echo "Tax: $" . number_format($tax, 2) . "\n";
echo "Tip: $" . number_format($tip, 2) . "\n";
echo "Total : $" . number_format($total, 2) . "\n";

echo("Cost is : $" . number_format($cost, 2) . "\n") ;
echo "Tax: $" . number_format($tax, 2) . "\n";
echo "Tip: $" . number_format($tip, 2) . "\n";
echo "Total : $" . number_format($total, 2) . "\n";
?>

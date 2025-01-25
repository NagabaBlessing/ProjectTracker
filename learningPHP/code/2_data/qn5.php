// Write a PHP program that uses the increment operator (++) and 
//the combined multiplication operator (*=) 
//to print out the numbers from 1 to 5 and powers of 2 from 2 (21) to 32 (25).

<?php
for ($i = 1; $i <= 5; $i++) {
    print "Number: " . $i . "\n";
}

$two_power = 2;  
for ($i = 1; $i <= 5; $i++) {
    print "2^" . $i . " = " . $two_power . "\n";
    $two_power *= 2;  
}
?>
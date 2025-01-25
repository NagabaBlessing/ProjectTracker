<!-- Use while() to print a table of Fahrenheit and Celsius temperature equivalents
from –50 degrees F to 50 degrees F in 5-degree increments. On the Fahrenheit
temperature scale, water freezes at 32 degrees and boils at 212 degrees. On the
Celsius scale, water freezes at 0 degrees and boils at 100 degrees. So, to convert
from Fahrenheit to Celsius, you subtract 32 from the temperature, multiply by 5,
and divide by 9. To convert from Celsius to Fahrenheit, you multiply by 9, divide
by 5, and then add 32.
4. Modify your answer to Exercise 3 to use for() instead of while(). -->

<?php
print "Fahrenheit\tCelsius\n";
print "---------------------\n";

for ($fahrenheit = -50; $fahrenheit <= 50; $fahrenheit += 5) {
    $celsius = ($fahrenheit - 32) * 5 / 9;

    printf("%10d\t%7.2f\n", $fahrenheit, $celsius);
}
?>

<!-- Web colors such as #ffffff and #cc3399 are made by concatenating the hexa!
decimal color values for red, green, and blue. Write a function that accepts deci!
mal red, green, and blue arguments and returns a string containing the
appropriate color for use in a web page. For example, if the arguments are 255, 0,
and 255, then the returned string should be #ff00ff. You may find it helpful to
use the built-in function dechex(), which is documented at http://www.php.net/
dechex. -->

<?php
function colors($red, $green, $blue) {
    $red = max(0, min(255, $red));
    $green = max(0, min(255, $green));
    $blue = max(0, min(255, $blue));
    
    $Red = str_pad(dechex($red), 2, "0", STR_PAD_LEFT);
    $Green = str_pad(dechex($green), 2, "0", STR_PAD_LEFT);
    $Blue = str_pad(dechex($blue), 2, "0", STR_PAD_LEFT);
    
    return "#" . $Red . $Green . $Blue;
}

echo colors(255, 0, 255); 
?>

<!-- This program has a syntax error in it:
$name = 'Umberto';
function say_hello() {
print 'Hello, ';
print global $name;
}
say_hello();
-->
<?php
$name = 'Umberto';

function say_hello() {
    global $name; 
    print 'Hello, ';
    print $name; 
}

say_hello();
?> 
<!-- you cannot use global with (along side) print  -->
<!-- Modify the function in the previous exercise so that only the filename is passed
to the function in the URL argument. Inside the function, prepend a global vari!
able to the filename to make the full URL. For example, if you pass photo.png to
the function, and the global variable contains /images/, then the src attribute of
the returned <img> tag would be /images/photo.png. A function like this is an
easy way to keep your image tags correct, even if the images move to a new path
or server. Just change the global variable—for example, from /images/ to
http://images.example.com/. -->

<?php
$path = '/images/';

// function createImageTag($filename, $alt = "", $height = "", $width = "") {
    function customImage($name, $alt = "", $height = "", $width = "") {

    global $path;

    $location = $path . $name;

    return '<img src="' . $location . '" alt="' . $alt . '" height="' . $height . '" width="' . $width . '" />';
}

$image = customImage("food.png", "Food", "200", "300");
echo $image; 
?>

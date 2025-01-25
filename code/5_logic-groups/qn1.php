<!-- Write a function to return an HTML <img /> tag. The function should accept a
mandatory argument of the image URL and optional arguments for alt text,
height, and width. -->

<?php
function customImage($url, $alt = "", $height = "", $width = "") {
    return '<img src="' . htmlspecialchars($url) . '" alt="' . htmlspecialchars($alt) . '" height="' . htmlspecialchars($height) . '" width="' . htmlspecialchars($width) . '" />';
}

$image = customImage("https://imgs.search.brave.com/UILYM7LTJSK_gjxj_WB7vpNvBz9MdAz6Cw2c7o6n_M4/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvNjk0/MTc3MzE2L3Bob3Rv/L2JicS1mZWFzdC5q/cGc_cz02MTJ4NjEy/Jnc9MCZrPTIwJmM9/OG9VLVMyMkpsQlBU/aUhCQndaaUpZczdm/Q0pXaVhqVkkwVkdX/b1R0bHpYST0", "Food", "200", "300");
echo $image; 
?>

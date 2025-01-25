<!-- Make a web page that uses a cookie to keep track of how many times a user has
viewed the page. The first time a particular user looks at the page, it should print
something like “Number of views: 1.” The second time the user looks at the page,
it should print “Number of views: 2,” and so on. -->
<?php
$cookie = 'page_views';

if (isset($_COOKIE[$cookie])) {
    $page_cookies = (int)$_COOKIE[$cookie] + 1;
} else {
    $page_cookies = 1;
}

// expires in 1 day (60 seconds * 60 minutes * 1 hours * 1days)
setcookie($cookie, $page_cookies, time() + (60 * 60 * 1 * 1));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page View Tracker</title>
</head>
<body>
    <h1>Number of Times you have viewed this page</h1>
    <p>Number of views: <?= $page_cookies; ?></p>
</body>
</html>

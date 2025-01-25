<!-- Modify the web page from the first exercise so that it prints out a special message
on the 5th, 10th, and 15th times the user looks at the page. Also modify it so that on the 20th time the user looks at the page, it deletes the cookie and the page
count starts over. -->
<?php
$cookie = 'page_views';

if (isset($_COOKIE[$cookie])) {
    $page_cookies = (int)$_COOKIE[$cookie] + 1;
} else {
    $page_cookies = 1;
}

if ($page_cookies == 20) {
    setcookie($cookie, "", time() - 3600);  // Expire the cookie
    $page_cookies = 1;  // Reset views
    echo "<p>Congrats! You've visited the page 20 times. The counter has been reset.</p>";
} else {
    setcookie($cookie, $page_cookies, time() + (60 * 60 * 24));  // 1 day expiration
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page View Tracker</title>
</head>
<body>
    <h1>Page View Tracker</h1>

    <p>Number of views: <?= $page_cookies; ?></p>

    <?php
    if ($page_cookies == 5) {
        echo "<p>You've visited the page 5 times! Keep it up!</p>";
    } elseif ($page_cookies == 10) {
        echo "<p>You've visited the page 10 times! Amazing!</p>";
    } elseif ($page_cookies == 15) {
        echo "<p>You've visited the page 15 times! You're on fire!</p>";
    }
    ?>
</body>
</html>

<!-- Write a program that displays, validates, and processes a form for entering infor!
mation about a package to be shipped. The form should contain inputs for the
from and to addresses for the package, dimensions of the package, and weight of
the package. The validation should check (at least) that the package weighs no
more than 150 pounds and that no dimension of the package is more than 36
inches. You can assume that the addresses entered on the form are both US
addresses, but you should check that a valid state and a zip code with valid syntax
are entered. The processing function in your program should print out the infor!
mation about the package in an organized, formatted report. -->

<?php
function shipping_form() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from_address = trim($_POST['from_address']);
        $to_address = trim($_POST['to_address']);
        $length = floatval($_POST['length']);
        $width = floatval($_POST['width']);
        $height = floatval($_POST['height']);
        $weight = floatval($_POST['weight']);
        $zip_code = trim($_POST['zip_code']);
        $state = trim($_POST['state']);

        // Validate weight
        if ($weight > 150) {
            echo "Error: Package weight cannot exceed 150 pounds.<br/>";
            return;
        }

        // Validate dimensions
        if ($length > 36 || $width > 36 || $height > 36) {
            echo "Error: No dimension can exceed 36 inches.<br/>";
            return;
        }

        // Validate zip code (5 digits)
        if (!preg_match('/^\d{5}$/', $zip_code)) {
            echo "Error: Invalid ZIP code format. It must be 5 digits.<br/>";
            return;
        }

        // Validate state (simple example, you can expand this list)
        $valid_states = [
            'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA',
            'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
            'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ',
            'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC',
            'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'
        ];
        
        if (!in_array($state, $valid_states)) {
            echo "Error: Invalid state abbreviation.<br/>";
            return;
        }

        // Display the formatted report
        echo "<h2>Package Shipping Information</h2>";
        echo "<strong>From Address:</strong> $from_address<br/>";
        echo "<strong>To Address:</strong> $to_address<br/>";
        echo "<strong>Dimensions:</strong> {$length} x {$width} x {$height} inches<br/>";
        echo "<strong>Weight:</strong> {$weight} pounds<br/>";
        echo "<strong>State:</strong> $state<br/>";
        echo "<strong>ZIP Code:</strong> $zip_code<br/>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Shipping Form</title>
</head>
<body>

<h1>Package Shipping Form</h1>
<form method="POST" action="">
    <label for="from_address">From Address:</label><br/>
    <input type="text" name="from_address" required><br/><br/>

    <label for="to_address">To Address:</label><br/>
    <input type="text" name="to_address" required><br/><br/>

    <label for="length">Length (inches):</label><br/>
    <input type="number" name="length" required><br/><br/>

    <label for="width">Width (inches):</label><br/>
    <input type="number" name="width" required><br/><br/>

    <label for="height">Height (inches):</label><br/>
    <input type="number" name="height" required><br/><br/>

    <label for="weight">Weight (pounds):</label><br/>
    <input type="number" name="weight" required><br/><br/>

    <label for="state">State (2-letter abbreviation):</label><br/>
    <input type="text" name="state" maxlength="2" required><br/><br/>

    <label for="zip_code">ZIP Code:</label><br/>
    <input type="text" name="zip_code" required><br/><br/>

    <input type="submit" value="Submit">
</form>

<?php
// Call the function to process the form data
process_shipping_form();
?>

</body>
</html>

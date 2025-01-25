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
function shipping_info($from_address, $to_address, $length, $width, $height, $weight, $zip_code, $state) {
    if ($weight > 150) {
        echo "Error: Package weight cannot exceed 150 pounds.\n";
        return;
    }

    if ($length > 36 || $width > 36 || $height > 36) {
        echo "Error: No dimension can exceed 36 inches.\n";
        return;
    }

    if (!preg_match('/^\d{5}$/', $zip_code)) {
        echo "Error: Invalid ZIP code format. It must be 5 digits.\n";
        return;
    }

    $valid_states = [
        'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA',
        'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ',
        'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC',
        'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'
    ];
    
    if (!in_array($state, $valid_states)) {
        echo "Error: Invalid state abbreviation.\n";
        return;
    }

    echo "\n--- Shipping Information ---\n";
    echo "From Address: $from_address\n";
    echo "To Address: $to_address\n";
    echo "Dimensions: {$length} x {$width} x {$height} inches\n";
    echo "Weight: {$weight} pounds\n";
    echo "State: $state\n";
    echo "ZIP Code: $zip_code\n";
}

echo "Enter the From Address: ";
$from_address = trim(fgets(STDIN));

echo "Enter the To Address: ";
$to_address = trim(fgets(STDIN));

echo "Enter Length (inches): ";
$length = floatval(trim(fgets(STDIN)));

echo "Enter Width (inches): ";
$width = floatval(trim(fgets(STDIN)));

echo "Enter Height (inches): ";
$height = floatval(trim(fgets(STDIN)));

echo "Enter Weight (pounds): ";
$weight = floatval(trim(fgets(STDIN)));

echo "Enter State (2-letter abbreviation): ";
$state = strtoupper(trim(fgets(STDIN))); // Convert to uppercase

echo "Enter ZIP Code: ";
$zip_code = trim(fgets(STDIN));

shipping_info($from_address, $to_address, $length, $width, $height, $weight, $zip_code, $state);
?>

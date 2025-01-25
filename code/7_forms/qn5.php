
<!-- . (Optional) Modify your process_form() function that enumerates all submitted
form parameters and their values so that it correctly handles submitted form
parameters that have array values. Remember, those array values could them!
selves contain arrays. -->
<?php
// Function to process the order form
function process_order() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $noodle = htmlspecialchars(trim($_POST['noodle']));
        $sweet = isset($_POST['sweet']) ? $_POST['sweet'] : []; //null checker
        $sweet_quantity = htmlspecialchars(trim($_POST['sweet_q']));

        if (!is_numeric($sweet_quantity) || intval($sweet_quantity) < 1) {
            echo "Error: Sweet quantity must be a positive number.<br/>";
            return;
        }

        echo "<h2>Order Summary</h2>";
        echo "<strong>Braised Noodles with:</strong> $noodle<br/>";
        
        // Check if any sweets were selected
        if (!empty($sweet)) {
            echo "<strong>Sweets:</strong> " . implode(", ", array_map('htmlspecialchars', $sweet)) . "<br/>";
            echo "<strong>Sweet Quantity:</strong> $sweet_quantity<br/>";
        } else {
            echo "<strong>No sweets selected.</strong><br/>";
        }
    } else {
        echo "No form data submitted.";
    }
}

// Call the function to process the order form
process_order();
?>

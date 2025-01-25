<!-- Write a program that does basic arithmetic. Display a form with text box inputs
for two operands and a <select> menu to choose an operation: addition, sub!
traction, multiplication, or division. Validate the inputs to make sure that they
are numeric and appropriate for the chosen operation. The processing function
should display the operands, the operator, and the result. For example, if the
operands are 4 and 2 and the operation is multiplication, the processing function
should display something like 4 * 2 = 8. -->
<?php
function performArithmetic($firstNumber, $secondNumber, $operation) {
    if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) {
        echo "Error: Both inputs must be numeric.\n";
        return; 
    }

    // Convert inputs to floats for calculation
    $firstNumber = floatval($firstNumber);
    $secondNumber = floatval($secondNumber);
    
    $result = null;

    // Determine the operation to perform
    switch ($operation) {
        case 'addition':
            $result = $firstNumber + $secondNumber;
            $operator = '+'; 
            break;
        case 'subtraction':
            $result = $firstNumber - $secondNumber;
            $operator = '-';
            break;
        case 'multiplication':
            $result = $firstNumber * $secondNumber;
            $operator = '*';
            break;
        case 'division':
            if ($secondNumber == 0) {
                echo "Error: Division by zero is not allowed.\n";
                return; 
            }
            $result = $firstNumber / $secondNumber;
            $operator = '/';
            break;
        default:
            echo "Error: Invalid operation. Please use addition, subtraction, multiplication, or division.\n";
            return; 
    }

    echo "$firstNumber $operator $secondNumber = $result\n";
}

// Check if the correct number of arguments is provided
if ($argc != 4) {
    echo "Usage: php qn.php <operand1> <operand2> <operation>\n";
    echo "Operations: addition, subtraction, multiplication, division\n";
    exit(1); // Exit with an error code if usage is incorrect
}

// Get operands from command line arguments
$operand1 = $argv[1]; 
$operand2 = $argv[2]; 
$operation = strtolower($argv[3]); // Operation converted to lowercase

performArithmetic($operand1, $operand2, $operation);
?>

<!-- to run this file use php qn3.php 4 8 addition -->
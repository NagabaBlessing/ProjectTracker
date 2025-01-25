<?php
function performArithmetic($firstNumber, $secondNumber, $operation) {
    error_log("Form Parameter: firstNumber = $firstNumber");
    error_log("Form Parameter: secondNumber = $secondNumber");
    error_log("Form Parameter: operation = $operation");

    if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) {
        echo "Error: Both inputs must be numeric.\n";
        return; 
    }

    $firstNumber = floatval($firstNumber);
    $secondNumber = floatval($secondNumber);
    
    $result = null;

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

if ($argc != 4) {
    echo "Usage: php qn.php <operand1> <operand2> <operation>\n";
    echo "Operations: addition, subtraction, multiplication, division\n";
    exit(1); 
}

$operand1 = $argv[1]; 
$operand2 = $argv[2]; 
$operation = strtolower($argv[3]); 

performArithmetic($operand1, $operand2, $operation);
?>

<!-- Write a program that does basic arithmetic. Display a form with text box inputs
for two operands and a <select> menu to choose an operation: addition, sub!
traction, multiplication, or division. Validate the inputs to make sure that they
are numeric and appropriate for the chosen operation. The processing function
should display the operands, the operator, and the result. For example, if the
operands are 4 and 2 and the operation is multiplication, the processing function
should display something like 4 * 2 = 8. -->
<?php
function Basic_arithemtic($a,$b,$operation) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST['a'];
        $b = $_POST['b'];
        $operation = $_POST['operation'];

        if (!is_numeric($a) || !is_numeric($b)) {
            echo "Both inputs must be numeric.";
            return;
        }

        
        $a = floatval($a);
        $b = floatval($b);
        $result = null;

        
        switch ($operation) {
            case 'addition':
                $result = $a + $b;
                $operator = '+';
                break;
            case 'subtraction':
                $result = $a - $b;
                $operator = '-';
                break;
            case 'multiplication':
                $result = $a * $b;
                $operator = '*';
                break;
            case 'division':
                if ($b == 0) {
                    echo "Error: Division by zero is not allowed.";
                    return;
                }
                $result = $a / $b;
                $operator = '/';
                break;
            default:
                echo "Invalid operation.";
                return;
        }

        // Display the result
        echo "$a $operator $b = $result";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Arithmetic </title>
</head>
<body>

<h1>Basic Arithmetic </h1>
<form method="POST" action="">
    Input 1: <input type="text" name="a" required><br/>
   Input 2: <input type="text" name="b" required><br/>
    Operation:
    <select name="operation" required>
        <option value="addition">Addition (+)</option>
        <option value="subtraction">Subtraction (-)</option>
        <option value="multiplication">Multiplication (*)</option>
        <option value="division">Division (/)</option>
    </select><br/>
    <input type="submit" value="Calculate">
</form>

<?php
Basic_arithemtic(2,4,4);
?>

</body>
</html>

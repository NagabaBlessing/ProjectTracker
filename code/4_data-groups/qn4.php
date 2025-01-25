<!-- For each of the following kinds of information, state how you would store it in an
array and then give sample code that creates such an array with a few elements.
For example, for the first item, you might say, “An associative array whose key is
the student’s name and whose value is an associative array of grade and ID num!
ber,” as in the following:
$students = [ 'James D. McCawley' => [ 'grade' => 'A+','id' => 271231 ],
'Buwei Yang Chao' => [ 'grade' => 'A', 'id' => 818211] ];
a. The grades and ID numbers of students in a class
b. How many of each item in a store inventory are in stock
c. School lunches for a week: the different parts of each meal (entrée, side dish,
drink, etc.) and the cost for each day
d. The names of people in your family
e. The names, ages, and relationship to you of people in your family -->


a: Multi dimensional  array where the key is the student's name and the value is another associative array (grade and ID number).
$students = [
    'James D. McCawley' => ['grade' => 'A+', 'id' => 271231],
    'Buwei Yang Chao' => ['grade' => 'A', 'id' => 818211],
    'Alice Smith' => ['grade' => 'B', 'id' => 123456]
];
b: Associative array where the key is the item name and the value is the quantity in stock.
$stock = [
    'Gloves' => 40,
    'Injections' => 5];
c: Multidimensional  array where the key is the day and the value is an associative array of lunch details (entrée, side, drink, cost).
$lunches = [
    'Monday' => ['entrée' => 'Posho and Beans', 'side' => 'Cabagge', 'drink' => 'Water', 'cost' => 5000],
    'Tuesday' => ['entrée' => 'rice and meat', 'side' => 'Salad', 'drink' => 'Soda', 'cost' => 6500],
    'Wednesday' => ['entrée' => 'Posho and Meat', 'side' => 'rice', 'drink' => 'Juice', 'cost' => 5500],
    'Thursday' => ['entrée' => 'Rice and beans', 'side' => 'posho', 'drink' => 'water', 'cost' => 5000],
    'Friday' => ['entrée' => 'Sweet potatoes and Meat', 'side' => 'rice', 'drink' => 'Yogurt', 'cost' => 8000],
    'Wednesday' => ['entrée' => 'Chips and liver', 'side' => 'pizza', 'drink' => 'Juice', 'cost' => 9000],
    'Wednesday' => ['entrée' => 'Chips and Chicken', 'side' => 'Greens', 'drink' => 'Yogurt', 'cost' => 10000],

];

d: Associative array where the values are family members' names.
$relatives=['mariam','sophia'];


e: Multidimensional array where the key is the person's name and the value is another array (age and relationship).
$relatives_details = [
    'Mariam' => ['age' => 4, 'relationship' => 'Mother'],
    'Sophia' => ['age' => 2, 'relationship' => 'Sister'],
   
];

<!-- Modify your solution to the previous exercise so that the rows in the result table
are ordered by population. Then modify your solution so that the rows are
ordered by city name. -->

<!-- order by population -->

<?php
// Define an array to hold city names and populations
$cities = [
    "New York, NY" => 8175133,
    "Los Angeles, CA" => 3792621,
    "Chicago, IL" => 2695598,
    "Houston, TX" => 2100263,
    "Philadelphia, PA" => 1526006,
    "Phoenix, AZ" => 1445632,
    "San Antonio, TX" => 1327407,
    "San Diego, CA" => 1307402,
    "Dallas, TX" => 1197816,
    "San Jose, CA" => 945942,
];

arsort($cities);

$total_population = 0;

print "City and State\t\tPopulation\n";
print "-------------------------------\n";

foreach ($cities as $city => $population) {
    print $city . "\t" . $population . "\n";

    $total_population += $population;
}

print "-------------------------------\n";
print "Total Population:\t" . $total_population . "\n";
?>


<!-- order by city name -->
<?php
$cities = [
    "New York, NY" => 8175133,
    "Los Angeles, CA" => 3792621,
    "Chicago, IL" => 2695598,
    "Houston, TX" => 2100263,
    "Philadelphia, PA" => 1526006,
    "Phoenix, AZ" => 1445632,
    "San Antonio, TX" => 1327407,
    "San Diego, CA" => 1307402,
    "Dallas, TX" => 1197816,
    "San Jose, CA" => 945942,
];

ksort($cities);

$total_population = 0;

print "City and State\t\tPopulation\n";
print "-------------------------------\n";

foreach ($cities as $city => $population) {
    print $city . "\t" . $population . "\n";

    $total_population += $population;
}

print "-------------------------------\n";
print "Total Population:\t" . $total_population . "\n";
?>

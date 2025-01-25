<!-- Modify your solution to the first exercise so that the table also contains rows that
hold state population totals for each state represented in the list of cities. -->
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

$state_totals = [];
$total_population = 0;

foreach ($cities as $city => $population) {
    // Extract state abbreviation
    $state = explode(', ', $city)[1];

    // Initialize and update state total
    $state_totals[$state] = $state_totals[$state] ?? 0;
    $state_totals[$state] += $population;

    // Update total population
    $total_population += $population;
}

print_r($state_totals);
print "Total Population: $total_population\n";
?>
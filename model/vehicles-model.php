<?php
//printing a nice message about cars
echo "<h1>Welcome to the Cars for Sale Page</h1>";
//creating a small array to be displayed to the user
$cars = array(
    array(
        "make" => "Ford",
        "model" => "Mustang",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/mustang.jpg"
    ),
    array(
        "make" => "Chevrolet",
        "model" => "Corvette",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/corvette.jpg"
    ),
    array(
        "make" => "Dodge",
        "model" => "Charger",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/charger.jpg"
    ),
    array(
        "make" => "Ford",
        "model" => "Mustang",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/mustang.jpg"
    ),
    array(
        "make" => "Chevrolet",
        "model" => "Corvette",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/corvette.jpg"
    ),
    array(
        "make" => "Dodge",
        "model" => "Charger",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/charger.jpg"
    ),
    array(
        "make" => "Ford",
        "model" => "Mustang",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/mustang.jpg"
    ),
    array(
        "make" => "Chevrolet",
        "model" => "Corvette",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/corvette.jpg"
    ),
    array(
        "make" => "Dodge",
        "model" => "Charger",
        "year" => "1964",
        "price" => "19,995",
        "image" => "images/charger.jpg"
    ));
//printing the array to the user
echo "<table>";
foreach ($cars as $car) {
    echo "<tr>";
    echo "<td><img src='" . $car['image'] . "'></td>";
    echo "<td>";
    echo "<h2>" . $car['make'] . " " . $car['model'] . "</h2>";
    echo "<p>Year: " . $car['year'] . "</p>";
    echo "<p>Price: " . $car['price'] . "</p>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<?php
// Dev Credentials
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "car_rental";

// Prod Credentials
$servername = "localhost";
$username = "id22112936_root";
$password = "Carrentalsystem@000";
$database = "id22112936_car_rental";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
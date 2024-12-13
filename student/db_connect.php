<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your password
$database = "pcr1db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

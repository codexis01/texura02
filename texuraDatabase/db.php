<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set character encoding
mysqli_set_charset($conn, "utf8");

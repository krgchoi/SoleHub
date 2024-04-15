<?php
$server = "localhost";
$username = "root";
$passwrd = "";
$database = "db";

$conn = new mysqli($server, $username, $passwrd, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

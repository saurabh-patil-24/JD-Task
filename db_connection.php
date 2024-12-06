<?php
$conn = mysqli_connect("localhost", "root", "", "jdtask");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<?php
 $conn = new mysqli("localhost", "root", "", "swetrydb");
 if ($conn->connect_error) {
 exit("Connection failed: " . $conn->connect_error);
 }
?>

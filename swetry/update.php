<?php
$conn = new mysqli("localhost", "root", "", "swetrydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];
$nazwa = $conn->real_escape_string($_POST["nazwa"]);
$opis = $conn->real_escape_string($_POST["opis"]);
$gramatura = $conn->real_escape_string($_POST["gramatura"]);
$wiek = (int) $_POST["wiek"];

$sql = "UPDATE swetry SET nazwa='$nazwa', opis='$opis', gramatura='$gramatura', wiek=$wiek WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: details.php?id=$id");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

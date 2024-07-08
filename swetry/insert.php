<?php
$target_dir = "obrazki/";
$target_file = $target_dir . basename($_FILES["obrazek"]["name"]);
move_uploaded_file($_FILES["obrazek"]["tmp_name"], $target_file);

$idKategorii = $_POST["idKategorii"];
$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$gramatura = $_POST["gramatura"];
$wiek = $_POST["wiek"];
$obrazek = basename($_FILES["obrazek"]["name"]);

$conn = new mysqli("localhost", "root", "", "swetrydb");
$sql = "INSERT INTO swetry (idKategorii, nazwa, obrazek, opis, gramatura, wiek) VALUES ($idKategorii, '$nazwa', '$obrazek', '$opis', $gramatura, $wiek)";
$conn->query($sql);
$conn->close();

header("Location: index.php");
?>

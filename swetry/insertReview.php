<?php
session_start();
require("session.php");
require("db.php");
?>
<p>
    Witaj <?= $_SESSION["login"] ?>!
    <a href="myReviews.php">Moje recenzje</a>
    <a href="logout.php">Wyloguj</a>
</p>
<?php
$idSwetra = $_POST["idSwetra"];
$nick = $_SESSION["login"];
$ocena = $_POST["ocena"];
$tresc = $_POST["tresc"];

$conn = new mysqli("localhost", "root", "", "swetrydb");
$sql = "INSERT INTO recenzje (idSwetra, nick, ocena, tresc) VALUES ($idSwetra, '$nick', $ocena, '$tresc')";
$conn->query($sql);
$conn->close();

header("Location: details.php?id=$idSwetra")
?>

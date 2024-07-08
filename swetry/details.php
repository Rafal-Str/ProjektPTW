<?php require("session.php"); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły swetra</title>
    <link rel="stylesheet" href="styldetails.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<header>
    <h1>Szczegóły swetra</h1>
</header>

<div class="container">
    <nav class="menu">
        <?php require("menu.php"); ?>
    </nav>
    <?php
    $conn = new mysqli("localhost", "root", "", "swetrydb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET["id"];
    $idUzytkownika = $_SESSION["id"];

    $sql = "SELECT id FROM ulubione WHERE idSwetra = $id AND idUzytkownika = $idUzytkownika";
    $added = $conn->query($sql)->num_rows > 0;
    $heartImage = $added ? "obrazki/filled_heart.png" : "obrazki/empty_heart.png";

    $sql = "SELECT AVG(ocena) AS srednia FROM recenzje WHERE idSwetra = $id";
    $result = $conn->query($sql);
    $srednia = $result->fetch_object()->srednia;

    $sql = "SELECT idKategorii, k.nazwa AS nazwaKat, d.nazwa, obrazek, d.opis, gramatura, wiek 
            FROM swetry d 
            JOIN kategorie k ON d.idKategorii = k.id 
            WHERE d.id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_object();
    ?>

    <div class="details">
        <p><strong>Kategoria:</strong> <a href='index.php?idKat=<?= $row->idKategorii ?>'><?= $row->nazwaKat ?></a></p>
        <p><strong>Nazwa:</strong> <?= $row->nazwa ?></p>
        <p><img src='obrazki/<?= $row->obrazek ?>' width='300' height='300'></p>
        <p><strong>Opis:</strong> <?= $row->opis ?></p>
        <p><strong>Gramatura:</strong> <?= $row->gramatura ?> g/m²</p>
        <p><strong>Wiek:</strong> <?= $row->wiek ?> lat</p>
        <p><strong>Średnia ocena:</strong> <?= round($srednia, 2) ?></p>
        <img class='fav' data-sweter='<?= $id ?>' src='<?= $heartImage ?>' alt='Toggle Favourite' width='30' height='30'>
    </div>

    <p class="edit-button"><a href='updateForm.php?id=<?= $id ?>' class='btn edit-btn'>Edytuj sweter</a></p>

    <form action="delete.php" method="post" class="delete-form">
        <input type="hidden" name="idSwetra" value="<?= $id ?>">
        <input type="submit" value="Usuń sweter" class="btn delete-btn">
    </form>
    <br></br>
    <div class="review-form">
        <form action="insertReview.php" method="post">
            <input type="hidden" name="idSwetra" value="<?= $id ?>">
            <p>
                <label for="ocena">Ocena:</label>
                <select name="ocena" id="ocena">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </p>
            <p>
                <label for="tresc">Treść:</label>
                <textarea name="tresc" id="tresc" style="width: 600px; height: 120px;"></textarea>
            </p>
            <p><input type="submit" value="Dodaj recenzję" class="btn"></p>
        </form>
    </div>

    <div class="reviews">
        <?php
        $sql = "SELECT r.nick, r.ocena, r.tresc, r.data, u.profile_picture 
                FROM recenzje r 
                JOIN uzytkownicy u ON r.nick = u.login 
                WHERE r.idSwetra = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Recenzje</h2>";
            while ($row = $result->fetch_object()) {
                echo "<div class='review'>";
                echo "<img src='{$row->profile_picture}' width='30' height='30' class='profile-pic'> ";
                echo "<strong>{$row->nick}</strong> ({$row->ocena}/5) - {$row->data}<br>";
                echo "{$row->tresc}";
                echo "</div>";
            }
        } else {
            echo "<p>Brak recenzji</p>";
        }
        $conn->close();
        ?>
    </div>

    <a href="index.php" class="back-link">Powrót do listy swetrów</a>
    <br></br>
</div>

<footer>
    <?php require("footer.php"); ?>
</footer>

</body>
</html>


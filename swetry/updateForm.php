<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj sweter</title>
    <link rel="stylesheet" href="styl.css">
    <style>
        body {
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Edytuj sweter</h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "swetrydb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET["id"];
    $sql = "SELECT id, nazwa, opis, gramatura, wiek FROM swetry WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        ?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <p>Nazwa: <input type="text" name="nazwa" value="<?= $row->nazwa ?>"></p>
            <p>Opis: <textarea name="opis" cols="30" rows="10"><?= $row->opis ?></textarea></p>
            <p>Gramatura: <input type="text" name="gramatura" value="<?= $row->gramatura ?>"></p>
            <p>Wiek: <input type="number" name="wiek" value="<?= $row->wiek ?>"></p>
            <p><input type="submit" value="Zapisz zmiany"></p>
        </form>

        <?php
    } else {
        echo "Nie znaleziono takiego swetera";
    }

    $conn->close();
    ?>

    <p><a href="index.php" class="back-link">Powrót do listy sweterów</a></p>
</body>
</html>

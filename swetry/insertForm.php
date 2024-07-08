<!DOCTYPE html>
<html>
<head>
  <title>Dodaj Sweter</title>
  <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Dodaj Sweter</h1>
</header>

<div class="container">
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <p>Obrazek: <input type="file" name="obrazek"></p>
        <p>Nazwa: <input type="text" name="nazwa"></p>
        <p>Opis: <textarea name="opis"></textarea></p>
        <p>Gramatura: <input type="text" name="gramatura" inputmode="numeric" pattern="\d*"></p>
        <p>Wiek: <input type="text" name="wiek" inputmode="numeric" pattern="\d*"></p>
        <p>Kategoria: 
            <select name="idKategorii">
                <?php
                $conn = new mysqli("localhost", "root", "", "swetrydb");
                $sql = "SELECT id, nazwa FROM kategorie ORDER BY nazwa";
                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    echo "<option value='{$row->id}'>{$row->nazwa}</option>";
                }
                $conn->close();
                ?>
            </select>
        </p>
        <p><input type="submit" value="Dodaj"></p>
    </form>

    <a href="index.php" class="back-link">Powrót do listy swetrów</a>
</div>

</body>
</html>

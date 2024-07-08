<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Rejestracja</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="style.css">

<body>

<?php
require("db.php");

if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];
    $email = $_POST["email"];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'upload_profile_pics/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profilePicturePath = $dest_path;
            } else {
                $profilePicturePath = 'upload_profile_pics/default.png';
            }
        }
    } else {
        $profilePicturePath = 'upload_profile_pics/default.png';
    }

    $sql_check = "SELECT * FROM uzytkownicy WHERE login = '$login'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "
        <div class='form'>
            <h3>Użytkownik o podanej nazwie już istnieje.</h3><br/>
            <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a>.</p>
        </div>";
    } else {
        $sql = "INSERT INTO uzytkownicy (login, haslo, email, profile_picture) VALUES ('$login', '" . md5($haslo) . "', '$email', '$profilePicturePath')";
        $result = $conn->query($sql);

        if ($result) {
            echo "
            <div class='form'>
                <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/>
                <p class='link'>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p>
            </div>";
        } else {
            echo "
            <div class='form'>
                <h3>Nie udało się zarejestrować. Spróbuj ponownie później.</h3><br/>
                <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a>.</p>
            </div>";
        }
    }
} else {
?>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        <h1 class="login-title">Rejestracja</h1>
        <input type="text" class="login-input" name="login" placeholder="Login" required/>
        <input type="password" class="login-input" name="haslo" placeholder="Hasło" required/>
        <input type="text" class="login-input" name="email" placeholder="Adres email" required/>
        <input type="file" class="login-input" name="profile_picture" accept="image/*"/>
        <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
        <p class="link"><a href="login.php">Zaloguj się</a></p>
    </form>
<?php
}
?>

</body>
</html>

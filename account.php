<?php
header ('Content-Type: text/html; charset=utf-8');
session_start();

require_once 'connect_db.php';

if (!$_SESSION['user_email']) {
    header('Location: index.php');
}

$user_email = $_SESSION['user_email'];

$user = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$user_email'");

if (mysqli_num_rows($user) > 0) {
    $user = mysqli_fetch_assoc($user);
    $user_name = $user['name'];
} else {
    echo 'непредвиденная ошибка';
    if ($_SESSION['user_email']) {
        unset($_SESSION['user_email']);
    }
    die();
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
</head>

<body>
<div class="account__container">
    <div class="account__welcome">
    <?php echo $user_name; ?>, приветствуем Вас в личном кабинете!
    </div>
    <div class="account__button-logout" onclick="window.location.href = 'logout.php'">Выйти из личного кабинета</div>
</div>
</body>

</html>
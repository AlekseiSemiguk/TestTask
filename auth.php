<?php
header ('Content-Type: text/html; charset=utf-8');
session_start();

require_once 'connect_db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$email = mysqli_real_escape_string($link, $email);

$user = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$email'");

if (mysqli_num_rows($user) < 1) {
    
    $response = [
        "status" => false,
        "message" => "пользователь с таким e-mail не зарегистрирован",
    ];

    echo json_encode($response);
    die();
}

$user = mysqli_fetch_assoc($user);

$user_salt = $user['salt'];
$password = md5($password.$user_salt);

if ($user['password'] == $password) {

    $_SESSION['user_email'] = $email;

    $response = [
        "status" => true
    ];

    echo json_encode($response);

} else {

    $response = [
        "status" => false,
        "message" => 'не верный пароль'
    ];

    echo json_encode($response);
}
?>

<?php
header ('Content-Type: text/html; charset=utf-8');
session_start();

require_once 'connect_db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$name = mysqli_real_escape_string($link, $name);
$email = mysqli_real_escape_string($link, $email);

$check_email = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$email'");
if (mysqli_num_rows($check_email) > 0) {
    $response = [
        "status" => false,
        "message" => "пользователь с таким e-mail уже зарегистрирован",
    ];

    echo json_encode($response);
    die();
}

$salt = '';
$saltLength = 8;
for($i=0; $i<$saltLength; $i++) {
$salt .= chr(mt_rand(97,122));
}

$password = md5($password.$salt);

mysqli_query($link, "INSERT INTO `users` (`name`, `email`, `password`, `salt`) VALUES ('$name', '$email', '$password', '$salt')");

$_SESSION['user_email'] = $email;

$response = [
    "status" => true,
];
echo json_encode($response);

?>

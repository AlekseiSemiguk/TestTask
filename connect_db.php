<?php
header ('Content-Type: text/html; charset=utf-8');

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "users");

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( !$link ) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "<br>Код ошибки errno: ".mysqli_connect_errno( );
    echo "<br>Текст ошибки error: ".mysqli_connect_error( );
}
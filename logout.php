<?php
header ('Content-Type: text/html; charset=utf-8');
session_start();

if ($_SESSION['user_email']) {
    unset($_SESSION['user_email']);
}

header('Location: index.php');
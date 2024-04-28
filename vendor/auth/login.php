<?php
session_start();

require_once __DIR__ . '/../config/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$error_messages = [];

if ($email === '') {
    $error_messages['email'] = 'Поле "E-mail" не заполнено';
}

if ($password === '') {
    $error_messages['password'] = 'Поле "Пароль" не заполнено';
}

if (!empty($error_messages)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => $error_messages,
        "fields" => array_keys($error_messages)
    ];

    echo json_encode($response);

    die();
}

$password = md5($password);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['user_id'],
        "username" => $user['username'],
        "email" => $user['email'],
        "password" => $user['password'],
    ];

    $response = [
        "status" => true
    ];

    echo json_encode($response);
} else {

    $response = [
        "status" => false,
        "type" => 2,
        "message" => 'Не верный E-mail или пароль'
    ];

    echo json_encode($response);
}
?>

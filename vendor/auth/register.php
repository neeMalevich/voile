<?php
session_start();

require_once __DIR__ . '/../config/db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");

$error_messages = [];

if (mysqli_num_rows($check_email) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => [
            'email' => "Такой E-mail уже существует"
        ],
        "fields" => ['email']
    ];

    echo json_encode($response);
    die();
}

if ($password === $password_confirm) {
    $password = md5($password);

    mysqli_query($connect, "INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`) VALUES (NULL, '$username', '$email', '$password')");

    $user = [
        "id" => mysqli_insert_id($connect),
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "register" => 'success',
    ];

    $_SESSION['user'] = $user;

    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => [
            'password_confirm' => 'Пароли не совпадают'
        ],
        "fields" => ['password_confirm']
    ];
    echo json_encode($response);
}
?>
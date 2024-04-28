<?php

session_start();

require_once __DIR__ . '/../config/db.php';
include __DIR__ . '/../function.php';

global $connect;

$username = isset($_POST['username']) ? $_POST['username'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$avatar = $_FILES['avatar'];
$password = isset($_POST['password']) ? $_POST['password'] : null;
$password_new = isset($_POST['password_new']) ? $_POST['password_new'] : null;
$password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : null;

$avatar_old = get_user_avatar($_SESSION['user']);

$response = array(
    'success' => true,
    'message' => 'Данные успешно обновлены',
    'errors' => [],
    'avatar' => $avatar['name']
);

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['success'] = false;
    $response['errors']['email_validation'] = 'Некорректный E-mail. Поле обязательно для заполнения';
}

$user_id = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);

if (!empty($password)) {
    if (strlen($password) > 8 && md5($password) == $user['password']) {
        if ($password_new == $password_confirm) {
            $hashed_password = md5($password_new);
            $update_query = "UPDATE users SET password='$hashed_password' WHERE user_id =$user_id";
            mysqli_query($connect, $update_query);

            $_SESSION['user']['password'] = $password;
        } else {
            $response['success'] = false;
            $response['errors']['password_new'] = 'Пароли не совпадают';
        }
    } elseif (strlen($password) <= 8) {
        $response['success'] = false;
        $response['errors']['password'] = 'Текущий пароль должен содержать более 8 символов';
    } else {
        $response['success'] = false;
        $response['errors']['password'] = 'Неверный текущий пароль';
    }
}

if (!empty($username)) {
    if (strlen($username) > 4){
        $_SESSION['user']['username'] = $username;

        $update_query = "UPDATE users SET user_name='$username' WHERE user_id=$user_id";
        mysqli_query($connect, $update_query);

    } else{
        $response['success'] = false;
        $response['errors']['username'] = 'Имя должно содержать более 4 символов';
    }
} else {
    $response['success'] = false;
    $response['errors']['username'] = 'Имя является обязательным полем';
}

if (!empty($avatar) && isset($avatar) && !empty($avatar['name'])) {
    $avatar_path_local = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $avatar['name'];
    $avatar_path = '/uploads/' . $avatar['name'];

    if (move_uploaded_file($avatar['tmp_name'], $avatar_path_local)) {
        $_SESSION['user']['avatar'] = '/uploads/' . $avatar['name'];

        $response['avatar'] = '/uploads/' . $avatar['name'];
    } else {
        $response['success'] = false;
        $response['errors']['avatar'] = "Ошибка при загрузке изображения";
    }

    $update_query = "UPDATE users SET avatar='$avatar_path' WHERE user_id=$user_id";
    mysqli_query($connect, $update_query);
}

if (!empty($email)) {
    $_SESSION['user']['email'] = $email;

    $update_query = "UPDATE users SET email='$email' WHERE user_id=$user_id";
    mysqli_query($connect, $update_query);
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
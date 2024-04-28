<?php
session_start();

include __DIR__ . '/../function.php';

global $connect;

$whishlist_add = $_POST['whishlist_add'];
$whishlist_remove = $_POST['whishlist_remove'];
$whishlist = $_POST['whishlist'];

if (isset($_SESSION['user']['id'])) {
    $user_id = $_SESSION['user']['id'];

    // Инициализация или перезапись $_SESSION['user']['whishlist'] как пустого массива, если он не существует
    if (!isset($_SESSION['user']['whishlist'])) {
        $_SESSION['user']['whishlist'] = [];
    }

    if (!empty($whishlist_add)) {
        $query = "INSERT INTO favorites (user_id, product_id) VALUES ('$user_id', '$whishlist_add')";

        // Добавляем товар в $_SESSION['user']['whishlist'], если его нет в массиве
        if (!in_array($whishlist_add, $_SESSION['user']['whishlist'])) {
            $_SESSION['user']['whishlist'][] = $whishlist_add;
        }

        mysqli_query($connect, $query);
    }

    if (!empty($whishlist_remove)) {
        $query = "DELETE FROM favorites WHERE user_id = '$user_id' AND product_id = '$whishlist_remove'";

        // Удаляем товар из $_SESSION['user']['whishlist'], если он присутствует в массиве
        $index = array_search($whishlist_remove, $_SESSION['user']['whishlist']);
        if ($index !== false) {
            unset($_SESSION['user']['whishlist'][$index]);
        }

        mysqli_query($connect, $query);
    }
}

?>



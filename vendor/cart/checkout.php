<?php
session_start();

include __DIR__ . '/../function.php';

global $connect;

$order_tel = $_POST['order_tel'];
$order_data = $_POST['order_data'];
$order_time = $_POST['order_time'];
$adress = $_POST['adress'];

$comment = isset($_POST['comment']) ? $_POST['comment'] : null;

$user_id = $_SESSION['user']['id'];

$query = "INSERT INTO orders (user_id, order_data, order_time, order_tel, comment, adress) VALUES ('$user_id', '$order_data', '$order_time', '$order_tel', '$comment', '$adress')";
$result = mysqli_query($connect, $query);

if ($result) {
    $order_id = mysqli_insert_id($connect);
}

$query_user = "SELECT order_id FROM product_order WHERE user_id = '$user_id' AND COALESCE(order_id, '') = ''";
$result_user = mysqli_query($connect, $query_user);

if ($result_user) {
    while ($row = mysqli_fetch_assoc($result_user)) {
        $update_query = "UPDATE product_order SET order_id = '$order_id' WHERE user_id = '$user_id' AND COALESCE(order_id, '') = ''";
        $update_result = mysqli_query($connect, $update_query);
    }

    $response = [
        "status" => true,
        "message" => "Заявка прошла успешно!",
    ];
    echo json_encode($response);
//
//    header('Location: /order-success.php');
//    exit;
}


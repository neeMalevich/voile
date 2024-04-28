<?php

session_start();

include __DIR__ . '/../function.php';

global $connect;

$cart_add = $_POST['cart_add'];
$cart_remove = $_POST['cart_remove'];
$cart_count = $_POST['cart_count'];
$cart_count_header = $_POST['cart_count_header'];

$user_id = $_SESSION['user']['id'];

$_SESSION['user']['cart_count_header'] = $cart_count_header;

debug($cart_add);
debug($cart_remove);
debug($cart_count);
debug($cart_count_header);
debug($user_id);


if (isset($cart_add) && !empty($cart_add)) {
    $check_query = "SELECT count FROM product_order WHERE product_id = '$cart_add' AND (order_id IS NULL OR order_id = '')";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $count = $cart_count ? $cart_count : $row['count'] + 1;

        $query = "UPDATE product_order SET count = '$count' WHERE product_id = '$cart_add' AND user_id = '$user_id'";
    } else {
        $query = "INSERT INTO product_order (product_id, count, user_id) VALUES ('$cart_add', 1, '$user_id')";
    }
}

if (isset($cart_remove) && !empty($cart_remove)) {
    $query = "DELETE FROM product_order WHERE product_id = '$cart_remove' AND user_id = '$user_id' AND (order_id IS NULL OR order_id = '')";
}

$result = mysqli_query($connect, $query);


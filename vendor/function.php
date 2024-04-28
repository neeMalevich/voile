<?php

require_once __DIR__ . '/config/db.php';

function debug($item){
    echo '<pre>';
    echo print_r($item);
    echo '</pre>';
}

function get_menu(){
    global $connect;

    $query = "SELECT id, name FROM categories";
    $result = mysqli_query($connect, $query);

    $menu = [];
    while ($row = mysqli_fetch_assoc($result)){
        $menu[$row['id']] = $row;
    }

    return $menu;
}

function get_products_by_category($id){
    global $connect;

    if($id){
        $query = "SELECT * FROM products where category_id IN($id) ORDER BY name";
    } else{
        $query = "SELECT * FROM products ORDER BY name";
    }

    $result = mysqli_query($connect, $query);

    $products = [];
    while ($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }

    return $products;
}

function get_latest_products($limit = 8){
    global $connect;

    $query = "SELECT * FROM products ORDER BY product_id DESC LIMIT $limit";

    $result = mysqli_query($connect, $query);

    $products = [];
    while ($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }

    return $products;
}

function get_products($id){
    global $connect;

    if($id){
        $query = "SELECT p.*, s.size, m.material, c.color, c.hex 
                  FROM products p 
                  JOIN sizes s ON p.size_id = s.size_id 
                  JOIN materials m ON p.material_id = m.material_id 
                  JOIN colors c ON p.color_id = c.color_id 
                  WHERE p.product_id = $id";

        $result = mysqli_query($connect, $query);

        $products = mysqli_fetch_assoc($result);

        if (!$products) {
            return false;
        }

        return $products;
    } else {
        return false;
    }
}


function get_categories(){
    global $connect;

    $query = "SELECT id, name, image FROM categories";
    $result = mysqli_query($connect, $query);

    $menu = [];
    while ($row = mysqli_fetch_assoc($result)){
        $menu[$row['id']] = $row;
    }

    return $menu;
}
function get_category_by_id($categoryId) {
    global $connect;

    if (!$categoryId) {
        return false;
    }

    $query = "SELECT name FROM categories WHERE id = $categoryId";
    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($result);

    return $row ? $row['name'] : '';
}

function check_table_exists($table_name) {
    global $connect;

    $query = "SHOW TABLES LIKE '$table_name'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        return true; // Таблица существует
    } else {
        return false; // Таблица не существует
    }
}


function get_count_product($user, $count_name, $table, $total = false, $product_id = null)
{
    global $connect;

    if (!$user) {
        return false;
    }

    if ($total) {
        $query = "SELECT COUNT(user_id) AS $count_name FROM $table WHERE user_id = $user AND (order_id IS NULL OR order_id = '')";
    } else {
        $query = "SELECT COUNT(user_id) AS $count_name FROM $table WHERE user_id = $user";
    }

    if ($product_id) {
        $query .= " AND product_id = $product_id";
    }

    $result = mysqli_query($connect, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $count = $row[$count_name];

        return $count;
    } else {
        return false;
    }
}

function get_user_avatar($user){
    global $connect;

    if(!$user){
        return false;
    }

    $user_id = $user['id'];
    $query = "SELECT avatar FROM users where user_id = $user_id";

    $result = mysqli_query($connect, $query);

    $avatar = mysqli_fetch_assoc($result);

    if (strpos($avatar['avatar'], "/uploads/") !== false) {
        $avatar['avatar'] = null;
    }

    return $avatar['avatar'] ?? $user['avatar'];
}

function get_wishlist_icon_by_count($user){
    if (!isset($user)){
        return '<a class="whishlist-btn" href="/login.php"><img src="/assets/images/whishlist.png" alt=""></a>';
    }

    $whishlistCount = get_count_product($user['id'], 'whishlist_count', 'favorites');
    $activeClass = ($whishlistCount > 0) ? '_is-active' : "";

    return '<a class="whishlist-btn ' . $activeClass . '" href="/whishlist.php">
        <img src="/assets/images/whishlist.png" alt="">
        <span class="whishlist-count">' . $whishlistCount . '</span>
    </a>';
}

function get_cart_icon_by_count($user){
    if (!isset($user)){
        return '<a class="basket-btn" href="/login.php"><img src="/assets/images/card.png" alt=""></a>';
    }

    $basketCount = get_count_product($user['id'], 'basket_count', 'product_order', true);
    $activeClass = ($basketCount > 0) ? '_is-active' : "";
    $isCount = (isset($basketCount) && !empty($basketCount)) ? $basketCount : 0;

    return '<a class="basket-btn ' . $activeClass . '" href="/cart.php">
        <img src="/assets/images/card.png" alt="">
        <span class="basket-count">' . $isCount . '</span>
    </a>';
}

function get_filter_column($table_name, $table_title_column, $filter_id = null)
{
    global $connect;

    $tableExists = check_table_exists($table_name);
    if (!$tableExists) {
        return false;
    }

    if ($filter_id){
        $product_filter_id = $table_title_column . '_id';
        $query = "SELECT $table_title_column FROM $table_name WHERE $product_filter_id = $filter_id";
    } else{
        $query = "SELECT * FROM $table_name";
    }

    $result = mysqli_query($connect, $query);

    $tableFilterColumn = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row["filter_column"] = $table_title_column . '_' . $row[$table_title_column . '_id'];
        $tableFilterColumn[] = $row;
    }

    return $tableFilterColumn;
}

function get_basket($user){
    global $connect;

    if(!$user){
        return false;
    }

    $query = "SELECT 
            products.product_id, 
            products.name, 
            products.description, 
            products.price, 
            products.image,
            products.color_id,
            products.material_id,
            product_order.count
        FROM product_order
        RIGHT JOIN 
            products 
        ON 
            product_order.product_id = products.product_id
        WHERE 
            product_order.user_id = $user
        AND (product_order.order_id IS NULL OR product_order.order_id = '')";

    $result = mysqli_query($connect, $query);

    $products = ['sum_basket_product' => 0];
    while ($row = mysqli_fetch_assoc($result)){
        $color = get_filter_column('colors', 'color', $row['color_id']);
        $material = get_filter_column('materials', 'material', $row['material_id']);

//      debug($color);
        $row['color_name'] = $color[0]['color'];
        $row['material_name'] = $material[0]['material'];
        $products['sum_basket_product'] += $row['price'] * $row['count'];

        $products[] = $row;
    }

    return $products;
}

function get_whishlict_user($user)
{
    global $connect;

    if(!$user){
        return false;
    }

    $query = "
        SELECT 
            products.product_id, 
            products.name, 
            products.price, 
            products.image
        FROM favorites
        RIGHT JOIN 
            products 
        ON 
            favorites.product_id = products.product_id
        WHERE 
            favorites.user_id = $user";

    $result = mysqli_query($connect, $query);

    $products = [];
    while ($row = mysqli_fetch_assoc($result)){
        $products[$row['product_id']] = $row;
    }

    return $products;
}

<?php
session_start();

include __DIR__ . '/../function.php';

global $connect;

$material = $_POST['material'];
$color = $_POST['color'];
$size = $_POST['size'];
$priceMax = $_POST['price_max'];
$priceMin = $_POST['price_min'];

$category = $_POST['category'];
$sort = $_POST['sort'];
$pagination = $_POST['pagination'];

$query = "SELECT * FROM products";
$conditions = [];

if (isset($color) && !empty($color) && is_array($color)) {
    $conditions[] = "color_id IN (" . implode(',', $color) . ")";
}

if (isset($category) && !empty($category)) {
    $conditions[] = "category_id IN ($category)";
}

if (isset($material) && !empty($material) && is_array($material)) {
    $conditions[] = "material_id IN (" . implode(',', $material) . ")";
}

if (isset($size) && !empty($size) && is_array($size)) {
    $conditions[] = "size_id IN (" . implode(',', $size) . ")";
}

if ($priceMax && $priceMin) {
    $conditions[] = "price BETWEEN $priceMin AND $priceMax";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

if (isset($sort) && !empty($sort)) {
    switch ($sort) {
        case 'price-low':
            $query .= " ORDER BY price ASC";
            break;
        case 'price-high':
            $query .= " ORDER BY price DESC";
            break;
        case 'sort-az':
            $query .= " ORDER BY name ASC";
            break;
        case 'sort-za':
            $query .= " ORDER BY name DESC";
            break;
    }
}

if (!empty($pagination)) {
    $query .= " LIMIT " . $pagination;
}

//debug($query);

$result = mysqli_query($connect, $query);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $image_id = $row['image'];

    if ($image_id) {
        $image_url = get_image_url($connect, $image_id);
        $row['image_src'] = $image_url;
    }

    $products[] = $row;
}
//debug(count($products));

if (!empty($products)) :
    foreach ($products as $product) : ?>

        <?php include __DIR__ . '/product-item.php'?>

    <?php endforeach; ?>
<?php else: ?>
    <div class="sidebar__top">Нет товаров</div>
<?php endif; ?>

<?php if (count($products) <= 12): ?>
    <script>
        $(document).ready(function () {
            $('.catalog__pagination').hide();
        });
    </script>
<?php endif; ?>
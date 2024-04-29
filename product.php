<?php
session_start();

include __DIR__ . '/vendor/function.php';

if (!isset($_GET['prod'])) {
    header('Location: 404.php');
    exit;
}

$productId = isset($_GET['prod']) ? (int)$_GET['prod'] : null;

$product = get_products($productId);

if (empty($product)) {
    header('Location: 404.php');
    exit;
}

require_once __DIR__ . '/vendor/components/header.php';

$whishlists_active = '';
if (isset($_SESSION['user'])){
    if (array_key_exists($product['product_id'], get_whishlict_user($_SESSION['user']['id'])) == $product['product_id']) {
        $whishlists_active = ' _is-active';
    }
}
$cart_active = get_count_product($_SESSION['user']['id'], 'product_count', 'product_order', false, $productId);
$class_cart_active = $cart_active ? '_is-active' : '';

?>


<section class="product mt70">
    <div class="container">
        <div class="product__inner">

            <div class="product__images">
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <?php foreach ($product['images'] as $image) : ?>
                            <div class="swiper-slide mask">
                                <img src="/assets/images/product/<?= $image; ?>" alt="<?= $product['name']; ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="history__pagination product__pagination">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="product__content">
                <h1>
                    <?= $product['name']; ?>
                </h1>
                <div class="product__price">
                    <?= $product['price']; ?> <span>РУБ</span>
                </div>
                <div class="product__attribyte">
                    <div class="product__attribyte-name">Материал:</div>
                    <div class="product__attribyte-sostav">
                        <?= $product['material']; ?>
                    </div>
                </div>
                <div class="product__attribyte">
                    <div class="product__attribyte-name">Цвет:</div>
                    <div class="product__attribyte-sostav"><?= $product['color']; ?></div>
                </div>
                <div class="product__attribyte product__attribyte--size">
                    <div class="product__attribyte-name">Размер:</div>
                    <div class="product__attribyte-sostav"><?= $product['size']; ?></div>
                </div>

                <div
                    class="product__shop"
                    data-id="<?= $product['product_id']; ?>"
                    data-user_id="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; ?>"
                >
                    <button class="btn card <?= $class_cart_active; ?>">
                        <span class="card--add">Добавить в корзину</span>
                        <span class="card--remove">Удалить из корзины</span>
                    </button>
                    <button
                        class="btn product__shop-favorite <?= $whishlists_active; ?>"
                        data-id="<?= $product['product_id']; ?>"
                        data-user_id="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; ?>"
                    >
                        <svg width="31" height="27" viewBox="0 0 31 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.927 25.4626L16.9237 25.4655C16.1267 26.1801 14.893 26.1797 14.0962 25.455L14.0962 25.455L14.0914 25.4507L13.921 25.2977L13.9192 25.2961C9.83086 21.6434 6.53724 18.6946 4.27773 15.9288C2.03245 13.1805 0.916118 10.7395 1.00493 8.11425C1.08702 5.82596 2.2769 3.63121 4.18909 2.34559L4.18963 2.34522C7.80114 -0.0863525 12.2982 1.0269 14.7433 3.85302L15.4996 4.72709L16.2558 3.85302C18.703 1.02453 23.199 -0.0992063 26.8074 2.34379L26.8101 2.34559C28.7225 3.63138 29.9125 5.82656 29.9943 8.11519L29.9943 8.11598C30.0902 10.7398 28.975 13.1798 26.7271 15.9328C24.472 18.6946 21.1875 21.6414 17.1156 25.2948L17.0819 25.3249L17.0784 25.3281L16.927 25.4626Z"
                                stroke="#EDE5D9" stroke-width="2" />
                        </svg>
                    </button>
                </div>

                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($product['images'] as $image) : ?>
                            <div class="swiper-slide mask">
                                <img src="/assets/images/product/<?= $image; ?>" alt="<?= $product['name']; ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<div class="modal-order">
    <div class="modal-order-content">
        <span class="close-button-order">×</span>
        <div class="modal_product_title">Для добавления товара необходимо войти в аккаунт</div>
        <div class="account__btn">
            <a href="/login.php" class="btn" style="margin-top: 25px">Войти</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/vendor/components/product-slider.php'; ?>

<?php include __DIR__ . '/assets/js/ajax/cart.php'; ?>
<?php include __DIR__ . '/assets/js/ajax/whishlist.php'; ?>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>
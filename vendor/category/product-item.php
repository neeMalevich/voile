<?php
session_start();

$whishlists_active = '';
if (isset($_SESSION['user'])){
    if (array_key_exists($product['product_id'], get_whishlict_user($_SESSION['user']['id'])) == $product['product_id']) {
        $whishlists_active = ' _is-active';
    }
}
?>

<div class="product__item <?= $_SERVER['REQUEST_URI'] == '/whishlist.php' ? ' product__item-whishlist' : ''; ?>">
    <div>
        <a href="/product.php?prod=<?= $product['product_id']; ?>" class="product__img mask">
            <img src="/assets/images/product/<?= $product['image_src']; ?>" alt="<?= $product['name']; ?>">
        </a>
        <a href="/product.php?prod=<?= $product['product_id']; ?>" class="product__title">
            <?= $product['name']; ?>
        </a>
    </div>
    <div class="product__price">
        <?= $product['price']; ?> руб
    </div>
    <div class="product__feedback">
        <button
            class="whishlist <?= $whishlists_active; ?>"
            data-id="<?= $product['product_id']; ?>"
            data-user_id="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; ?>"
        >
            <svg width="24" height="21" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.953 19.6397L12.9498 19.6426C12.4192 20.1205 11.5972 20.1201 11.0668 19.6355L11.0669 19.6355L11.062 19.6312L10.9301 19.5121L10.9283 19.5106C7.75845 16.6654 5.22387 14.3847 3.48809 12.2502C1.7667 10.1334 0.937524 8.28599 1.00368 6.31872C1.06487 4.60652 1.95203 2.96595 3.37093 2.00757L3.37147 2.0072C6.0575 0.190366 9.41194 1.01555 11.2419 3.14047L11.9997 4.02031L12.7574 3.14047C14.5895 1.01316 17.9428 0.180931 20.6257 2.00576L20.6284 2.00757C22.0476 2.96611 22.9348 4.60707 22.9957 6.31959L22.9957 6.32038C23.0672 8.28617 22.2392 10.1327 20.5156 12.2534C18.7807 14.388 16.2485 16.6703 13.0851 19.5217L13.073 19.5326L13.0695 19.5358L12.953 19.6397Z" stroke="#4C4239" stroke-width="2" />
            </svg>
        </button>

    </div>
</div>
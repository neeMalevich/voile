<?php require_once __DIR__ . '/vendor/components/header.php'; ?>

<section class="s-catalog">
    <div class="container">
        <div class="catalog">

            <div class="sidebar">
                <div class="sidebar__top">
                    <img src="/assets/images/filter.png" alt="">
                    Фильтр
                </div>

                <?php require_once __DIR__ . '/vendor/category/filter.php'; ?>
            </div>

            <div class="catalog__wrapper">

                <?php require_once __DIR__ . '/vendor/category/sorting.php'; ?>

                <div class="catalog__inner">
                    <?php include __DIR__ . '/vendor/category/products.php'; ?>
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

<?php include __DIR__ . '/assets/js/ajax/filter.php'; ?>
<?php include __DIR__ . '/assets/js/ajax/whishlist.php'; ?>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>
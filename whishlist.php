<?php
require_once __DIR__ . '/vendor/components/header.php';

session_start();

if (!$_SESSION['user']) {
    header('Location: /login.php');
    exit;
}
?>

<section class="login">
    <div class="container">
        <div class="login__inner">
            <h1 class="tac">аккаунт</h1>

            <div class="login__wrapper">

                <?php include_once 'vendor/auth/sidebar.php' ?>

                <?php
                $products = get_whishlict_user($_SESSION['user']['id']);

                if ($products) : ?>
                    <div class="catalog__inner wishlist">
                        <?php
                        if (!empty($products)) :
                            foreach ($products as $product) : ?>

                                <?php include __DIR__ . '/vendor/category/product-item.php'; ?>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="sidebar__top">Нет товаров</div>
                        <?php endif; ?>

                    </div>

                    <div class="wishlist-none"></div>

                <?php else:  ?>
                    <div class="account__whislist dac">
                        <img src="./assets/images/whishlist-none.png" alt="">

                        <div class="account__whislist-title">Список избранного пуст</div>
                        <div class="account__whislist-text">У вас пока нет товаров в списке желаний. <br>  На странице «Товары» вы найдете много интересных товаров.</div>

                        <div class="account__btn">
                            <a href="/catalog.php" id="account-login" class="btn">
                                вернуться в магазин
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/assets/js/ajax/whishlist.php'; ?>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>
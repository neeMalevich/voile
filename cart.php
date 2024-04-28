<?php
require_once __DIR__ . '/vendor/components/header.php';
$baskets = get_basket($_SESSION['user']['id']);
$basket_sum = array_shift($baskets);

?>

    <section class="login">
        <div class="container">
            <div class="login__inner">
                <h1 class="tac">Корзина</h1>

                <?php if ($baskets) : ?>
                    <div class="basket__wrapper">
                        <div class="basket__inner">
                            <?php foreach ($baskets as $product) : ?>
                                <div class="basket__item card">
                                    <div class="basket__img mask">
                                        <?php if ($product['image']) : ?>
                                            <img src="/assets/images/product/<?= $product['image']; ?>"
                                                 alt="<?= $product['name']; ?>">
                                        <?php else : ?>
                                            <img src="/assets/images/product/no-image.jpg" alt="Нет фото">
                                        <?php endif; ?>
                                    </div>
                                    <div class="basket__content">
                                        <div class="basket__content-left">
                                            <div class="basket__title">
                                                <?= $product['name']; ?>
                                            </div>
                                            <div class="basket__price basket__price-top card__price" data-price="<?= $product['price']; ?>">
                                                <?= $product['price']; ?> руб
                                            </div>

                                            <div class="basket__attribyte-name">Размер</div>
                                            <div class="basket__attribyte"><?= $product['material_name']; ?></div>

                                            <div class="basket__attribyte-name">Цвет</div>
                                            <div class="basket__attribyte"><?= $product['color_name']; ?></div>

                                            <div class="quantity_inner" data-id="<?= $product['product_id']; ?>" data-start-pice="<?= $product['price']; ?>">
                                                <button class="bt_minus">
                                                    <svg viewBox="0 0 24 24">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                                <input type="text" value="<?= $product['count'] ?>" size="2" class="quantity" data-max-count="20">
                                                <button class="bt_plus">
                                                    <svg viewBox="0 0 24 24">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="basket__content-right">
                                            <div class="basket__price card__price"><?= $product['price']; ?> руб</div>
                                            <button class="basket__del" data-id="<?= $product['product_id']; ?>">
                                                <img src="./assets/images/trash.png" alt="">
                                                <span>Удалить</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="basket__bottom">
                            <div class="basket__full-price">Итого: <span><?= $basket_sum; ?></span></div>
                            <a href="/order.php" class="basket__btn btn">Оформить заказ</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="sidebar__top tac">Нет товаров</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/assets/js/ajax/cart.php'; ?>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>
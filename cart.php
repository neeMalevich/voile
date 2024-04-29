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
                                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.24067 0.6636C6.3421 0.464303 6.49804 0.296666 6.69102 0.179463C6.88401 0.0622598 7.10641 0.000118978 7.33333 0H14.6667C14.8936 0.000118978 15.116 0.0622598 15.309 0.179463C15.502 0.296666 15.6579 0.464303 15.7593 0.6636L17.8664 4.8H20.7778C21.1019 4.8 21.4128 4.92643 21.642 5.15147C21.8712 5.37652 22 5.68174 22 6C22 6.31826 21.8712 6.62348 21.642 6.84853C21.4128 7.07357 21.1019 7.2 20.7778 7.2H19.5556V20.4C19.5556 21.3548 19.1692 22.2705 18.4816 22.9456C17.794 23.6207 16.8613 24 15.8889 24H6.11111C5.13865 24 4.20602 23.6207 3.51839 22.9456C2.83075 22.2705 2.44444 21.3548 2.44444 20.4V7.2H1.22222C0.898069 7.2 0.587192 7.07357 0.357981 6.84853C0.128769 6.62348 0 6.31826 0 6C0 5.68174 0.128769 5.37652 0.357981 5.15147C0.587192 4.92643 0.898069 4.8 1.22222 4.8H4.13356L6.24067 0.6636ZM13.9113 2.4L15.1336 4.8H6.86644L8.08867 2.4H13.9113ZM9.77778 10.8C9.77778 10.4817 9.64901 10.1765 9.4198 9.95147C9.19059 9.72643 8.87971 9.6 8.55556 9.6C8.2314 9.6 7.92053 9.72643 7.69131 9.95147C7.4621 10.1765 7.33333 10.4817 7.33333 10.8V18C7.33333 18.3183 7.4621 18.6235 7.69131 18.8485C7.92053 19.0736 8.2314 19.2 8.55556 19.2C8.87971 19.2 9.19059 19.0736 9.4198 18.8485C9.64901 18.6235 9.77778 18.3183 9.77778 18V10.8ZM14.6667 10.8C14.6667 10.4817 14.5379 10.1765 14.3087 9.95147C14.0795 9.72643 13.7686 9.6 13.4444 9.6C13.1203 9.6 12.8094 9.72643 12.5802 9.95147C12.351 10.1765 12.2222 10.4817 12.2222 10.8V18C12.2222 18.3183 12.351 18.6235 12.5802 18.8485C12.8094 19.0736 13.1203 19.2 13.4444 19.2C13.7686 19.2 14.0795 19.0736 14.3087 18.8485C14.5379 18.6235 14.6667 18.3183 14.6667 18V10.8Z" fill="#4C4239"/>
                                                </svg>

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
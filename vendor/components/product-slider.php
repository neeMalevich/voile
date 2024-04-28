<section class="c-product">
    <div class="container">
        <div class="c-product__inner">
            <div class="c-product__left">
                <h2 class="c-product__title" data-aos="fade-up" data-aos-anchor-placement="top-bottom">Новая
                    коллекция в нашем магазине</h2>

                <div class="c-product__arrow">
                    <div class="swiper-button-prev">
                        <img src="./assets/images/arrow-left-slider.png" alt="">
                    </div>
                    <div class="swiper-button-next">
                        <img src="./assets/images/arrow-right-slider.png" alt="">
                    </div>
                </div>

                <a href="/catalog.php" class="btn">Каталог</a>
            </div>
            <div class="c-product__content">
                <div class="swiper js-c-product-swiper">
                    <div class="swiper-wrapper">

                        <?php
                        $products = get_latest_products();

                        if (!empty($products)) :
                            foreach ($products as $product) : ?>
                                <div class="swiper-slide">
                                    <?php include __DIR__ . '/../category/product-item.php'?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="history__pagination c-product__pagination">
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
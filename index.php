<?php require_once __DIR__ . '/vendor/components/header.php'; ?>

<section class="banner">
    <div class="container">
        <div class="banner__inner">
            <div class="banner__img">
                <img class="mask--banner" src="./assets/images/banner.png" alt="">
            </div>

            <div class="banner__content is-visible" data-anim="data-anim">
                <div class="banner__content-inner">
                    <div class="banner__content-top">
                        <h1 data-aos="fade-down" data-aos-easing="linear" data-aos-duration="500">
                            Винтажная одежда
                        </h1>

                        <a href="/catalog.php" class="btn">Смотреть каталог</a>
                    </div>
                    <div class="banner__bottom">
                        <div class="banner__bottom-img">
                            <img class="mask--banner" src="./assets/images/banner-mini.png" alt="">
                        </div>
                        <ul>
                            <li data-aos="fade-left" data-aos-offset="200" data-aos-easing="ease-in-sine">МОДНО</li>
                            <li data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">УДОБНО
                            </li>
                            <li data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine">СТИЛЬНО
                            </li>
                            <li data-aos="fade-left" data-aos-offset="500" data-aos-easing="ease-in-sine">
                                КАЧЕСТВЕННО</li>
                        </ul>
                    </div>
                </div>
                <div class="banner__right">
                    <a href="#">
                        <img src="./assets/images/soc/twitter.png" alt="">
                    </a>
                    <a href="#">
                        <img src="./assets/images/soc/insta.png" alt="">
                    </a>
                    <a href="#">
                        <img src="./assets/images/soc/facebook.png" alt="">
                    </a>
                    <a href="#">
                        <img src="./assets/images/soc/pinterest.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/vendor/components/product-slider.php'; ?>

<section class="our-values">
    <h2 class="section-title tac" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        НАШИ ЦЕННОСТИ
    </h2>
    <div class="container container--mini">
        <div class="our-values__inner">
            <div class="our-values__item">
                <div class="our-values__text" data-aos="zoom-out-right" data-aos-duration="400">
                    Создать <span>СТИЛЬНУЮ</span> и <span>КАЧЕСТВЕННУЮ</span> винтажную одежду для женщин
                </div>
                <div class="our-values__img mask" data-aos="fade-right">
                    <img class="" src="./assets/images/our-values-3.png" alt="">
                </div>
                <div class="our-values__text" data-aos="zoom-out-right" data-aos-duration="600">
                    долгая <span>ИЗНОСОСТОЙКОСТЬ</span> и <span>ПРОЧНОСТЬ</span>
                </div>
            </div>
            <div class="our-values__item">
                <div class="our-values__img mask del-2" data-aos="fade-left">
                    <img class="" src="./assets/images/our-values-1.png" alt="">
                </div>
                <div class="our-values__text" data-aos="zoom-in-left" data-aos-duration="400">
                    <span>ЛУЧШИЕ</span> материалы обеспечивающие <span>ПРЕКРАСНЫЙ ВНЕШНИЙ ВИД</span> в любой
                    ситуации
                </div>
                <div class="our-values__img mask del-5" data-aos="fade-left">
                    <img class="" src="./assets/images/our-values-2.png" alt="">
                </div>
            </div>
        </div>

        <div class="our-values__btn">
            <a href="#" class="btn">ЧИТАТЬ ПОДРОБНЕЕ</a>
        </div>
    </div>
</section>

<section class="why-us">
    <h2 class="section-title tac" data-aos="fade-up" data-aos-anchor-placement="top-bottom">ПОЧЕМУ МЫ?</h2>
    <div class="container">
        <div class="why-us__inner">
            <div class="why-us__item" data-aos="zoom-in-up" data-aos-duration="300">
                <div class="why-us__img">
                    <img src="./assets/images/delivery.png" alt="">
                </div>
                <div class="why-us__title">ДОСТАВКА ЗАКАЗОВ</div>
                <div class="why-us__text">удобный способ доставки на выбор</div>
            </div>
            <div class="why-us__item" data-aos="zoom-in-up" data-aos-duration="450">
                <div class="why-us__img">
                    <img src="./assets/images/security.png" alt="">
                </div>
                <div class="why-us__title">БЕЗОПАСНАЯ ОПЛАТА</div>
                <div class="why-us__text">оплата при получении, никакого риска</div>
            </div>
            <div class="why-us__item" data-aos="zoom-in-up" data-aos-duration="600">
                <div class="why-us__img">
                    <img src="./assets/images/return-arrow.png" alt="">
                </div>
                <div class="why-us__title">ОБМЕН И ВОЗВРАТ</div>
                <div class="why-us__text">если вы недовольны мы вернем вам деньги</div>
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

<?php include __DIR__ . '/assets/js/ajax/whishlist.php'; ?>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>
<?php
session_start();

if ($_SERVER['PHP_SELF'] != '/product.php'){
    include __DIR__ . '/../function.php';
}


$menu = get_menu();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Одежда</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="./assets/css/app.min.css">
    <link rel="stylesheet" href="./assets/css/swiper.css">
    <link rel="stylesheet" href="./assets/css/animation.css">
    <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery.js"></script>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="header__inners">
                <ul class="header__menu menu Header-nav">
                    <li>
                        <a href="/about.php">О нас</a>
                    </li>

                    <li class="dropdown-nav">
                        <a href="/catalog.php">Каталог</a>
                        <ul class="No-list">
                            <?php foreach($menu as $item) : ?>
                                <li>
                                    <a href="/catalog.php?cat=<?= $item['id']; ?>">
                                        <?= $item['name']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li>
                        <a href="/contact.php">Контакты</a>
                    </li>
                </ul>

                <a href="/" class="header__logo logo">
                    <img src="./assets/images/logo.svg" alt="" class="logo-img">
                </a>

                <ul class="header__users">
                    <li>
                        <?= get_wishlist_icon_by_count($_SESSION['user']); ?>
                    </li>
                    <li>
                        <?= get_cart_icon_by_count($_SESSION['user']); ?>
                    </li>
                    <li>
                        <a href="/login.php">
                            <?php

                            $avatar = get_user_avatar($_SESSION['user']);

                            if (!empty($avatar) && $avatar !== null) : ?>
                                <img class="header__users-img" src="<?= $avatar; ?>" alt="">
                            <?php else : ?>
                                <img src="/assets/images/profile.png" alt="">
                            <?php endif; ?>
                        </a>
                    </li>

                </ul>

                <a href="#" class="menuBtn">
                    <span class="lines"></span>
                </a>

                <nav class="mainMenu">
                    <ul>
                        <li>
                            <a href="/about.php">О нас</a>
                        </li>
                        <li class="dropdown-mobile">
                            <a class="dropdown-mobile-arrow" href="/catalog.php">
                                Каталог
                                <div class="dropdown-mobile-arrow__line"></div>
                            </a>
                            <ul class="dropdown-mobile-list">
                                <?php foreach($menu as $item) : ?>
                                    <li>
                                        <a href="/catalog.php?cat=<?= $item['id']; ?>">
                                            <?= $item['name']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="/contact.php">Контакты</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </header>
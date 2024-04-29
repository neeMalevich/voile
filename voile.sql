-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 30 2024 г., 00:13
-- Версия сервера: 10.6.7-MariaDB
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `voile`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Верхняя одежда'),
(2, 'Платья'),
(3, 'Блузки'),
(4, 'Юбки'),
(5, 'Брюки');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `color_id` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`color_id`, `color`, `hex`) VALUES
(1, 'Белый', 'fff'),
(2, 'Серый', '6d7776'),
(3, 'Чёрный', '050700'),
(4, 'Бежевый', 'ddcbad'),
(5, 'Зелёный', '007539'),
(6, 'Конго красный', '5e3938'),
(7, 'Синий', '00496c'),
(8, 'Мятный', '4e9f86'),
(9, 'Светло коричневый', '996942'),
(10, 'Красный', 'f90018'),
(11, 'Розовый', 'd38387'),
(12, 'Фиолетовый', '56327a');

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `favorit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`favorit_id`, `user_id`, `product_id`) VALUES
(397, 24, 11),
(398, 24, 6),
(400, 25, 10),
(402, 25, 11),
(403, 25, 8),
(409, 25, 12),
(410, 25, 5),
(413, 25, 9),
(414, 25, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `image_product`
--

CREATE TABLE `image_product` (
  `image_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image_product`
--

INSERT INTO `image_product` (`image_id`, `image`, `product_id`) VALUES
(1, 'ubo.png', 35),
(2, 'full.png', 35),
(3, 'uno-top.png', 35),
(5, 'kryzivnay.png', 2),
(7, 'oxovorskay-bluzka.png', 5),
(9, 'sarafan-dzinsa.png', 4),
(11, 'herstinay.png', 3),
(12, 'oversizy-kofta.png', 6),
(14, 'platiy-rybazka.png', 12),
(16, 'rubazka-c-printom.png', 8),
(18, 'vecenyy-baika.png', 11),
(20, 'lnay-rybazka.png', 10),
(22, 'ykorochinay-kofta.png', 7),
(24, 'kryzivnay.png', 9),
(26, 'polo-rubazka.png', 36),
(28, 'xalat-cruzevnoi.png', 38),
(29, 'rubazka-co-stoikoi.png', 39),
(30, 'sviter-kruz.png', 42);

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`material_id`, `material`) VALUES
(1, 'Шелк'),
(2, 'Вискоза'),
(3, 'Полиэстер'),
(4, 'Акрил'),
(5, 'Лен'),
(6, 'Жаккард'),
(7, 'Шерсть');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_data`, `order_time`, `order_tel`, `adress`, `comment`) VALUES
(47, 25, '2024-05-08', '06:01', '+375 (29) 929-29-29', NULL, 'ыавыва'),
(48, 25, '2024-05-01', '06:02', '+375 (29) 929-29-29', NULL, 'ававыавы'),
(49, 25, '2024-05-10', '01:13', '+375 (29) 929-29-29', NULL, 'авыаыв'),
(50, 25, '2024-05-09', '01:13', '+375 (29) 929-29-29', NULL, 'выфвфы'),
(51, 25, '2024-05-10', '06:12', '+375 (11) 155-15-55', NULL, 'dadas'),
(52, 25, '2024-05-10', '05:13', '+375 (44) 464-64-46', NULL, 'dsasad'),
(53, 25, '2024-05-10', '05:16', '+375 (29) 929-29-29', NULL, '55555'),
(54, 25, '2024-05-11', '01:23', '+375 (11) 155-15-55', NULL, 'dsdsads'),
(55, 25, '2024-05-11', '01:25', '+375 (11) 155-15-55', NULL, 'dasdasads'),
(56, 25, '2024-05-11', '01:28', '+375 (29) 999-99-99', NULL, 'выфвыфвфы'),
(57, 25, '2024-05-12', '03:09', '+375 (29) 929-29-29', NULL, 'cftvgy'),
(58, 25, '2024-05-11', '08:11', '+375 (99) 999-99-99', NULL, 'dssddsd'),
(59, 25, '2024-05-11', '03:22', '+375 (11) 155-15-55', NULL, '77878877'),
(60, 25, '2024-05-10', '03:25', '+375 (29) 929-29-29', NULL, '3333'),
(61, 25, '2024-05-10', '19:19', '+375 (29) 929-29-29', '', 'weewq'),
(62, 25, '2024-05-09', '02:00', '+375 (11) 155-15-55', 'Minsk Yakuba Kolosa', '7777777');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) UNSIGNED DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`, `size_id`, `color_id`, `material_id`, `image`) VALUES
(2, 'Блуза кружевная', NULL, 75, 3, 2, 1, 2, 24),
(3, 'Шерстяная кофта', NULL, 90, 1, 3, 4, 3, 11),
(4, 'Сарафан джинса', NULL, 115, 2, 4, 7, 4, 9),
(5, 'Оксфордская блуза', NULL, 120, 3, 4, 4, 5, 7),
(6, 'Оверсайз кофта', NULL, 95, 1, 3, 2, 6, 12),
(7, 'Укороченная кофта', NULL, 110, 1, 2, 11, 6, 22),
(8, 'Рубашка с принтом', NULL, 80, 3, 1, 6, 7, 16),
(9, 'Хлопковый топ', NULL, 60, 3, 1, 1, 1, 24),
(10, 'Льняная рубашка', NULL, 135, 3, 2, 9, 2, 20),
(11, 'Весенняя байка', NULL, 80, 1, 3, 7, 3, 18),
(12, 'Платье-рубашка', NULL, 100, 2, 4, 4, 3, 14),
(35, 'Шелковая рубашка “ROMANTIK”', NULL, 80, 3, 3, 11, 1, 1),
(36, 'Поло-рубашка', NULL, 87, 3, 2, 5, 3, 26),
(38, 'Халат кружевной', NULL, 54, 2, 1, 7, 6, 28),
(39, 'Рубашка со стойкой', NULL, 90, 3, 3, 1, 5, 29),
(42, 'Свитер ажурный', NULL, 120, 1, 4, 11, 7, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `count` int(22) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `product_id`, `user_id`, `order_id`, `count`) VALUES
(141, 12, 25, 47, 1),
(142, 11, 25, 49, 1),
(143, 11, 25, 50, 1),
(144, 12, 25, 51, 1),
(145, 11, 25, 52, 1),
(146, 9, 25, 53, 1),
(147, 3, 25, 54, 1),
(148, 3, 25, 55, 1),
(149, 3, 25, 56, 1),
(150, 9, 25, 57, 1),
(151, 11, 25, 58, 1),
(152, 11, 25, 59, 1),
(160, 11, 25, 61, 1),
(161, 4, 25, 62, 1),
(163, 10, 25, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`size_id`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `avatar`, `role`) VALUES
(1, 'test', 'teddddsst@gmail.com', '9de30597e42eadc602d06853c09b8e9d', '/uploads/logo.jpg', NULL),
(2, 'sa7a8ew3238dsds', 'tssochka8323@gmail.com', '333481ab8c2829bfc1d6a09de6f17092', '/uploads/Rectangle.png', NULL),
(24, 'malevichivanlionodovich@gmail.com', 'malevichivanlionodovich@gmail.com', '928e86995412ac112c7a5a95f3a16cc0', NULL, NULL),
(25, 'ddsaddsasd', 'tedddst@gmail.com', '9de30597e42eadc602d06853c09b8e9d', '/uploads/WhatsApp Image 2024-02-07 at 09.38.57.jpeg', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorit_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`image_id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `products_ibfk_3` (`size_id`),
  ADD KEY `image` (`image`),
  ADD KEY `material_id` (`material_id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`user_id`),
  ADD KEY `order_id_2` (`order_id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- AUTO_INCREMENT для таблицы `image_product`
--
ALTER TABLE `image_product`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`image`) REFERENCES `image_product` (`image_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_order_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

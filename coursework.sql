-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2025 г., 15:25
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `coursework`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('user', '4', 1747334915),
('user', '5', 1747378334),
('user', '6', 1747499232),
('user', '7', 1747500444),
('user', '8', 1747937284);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('accessAdminPanel', 2, 'Доступ к админ-панели', NULL, NULL, 1747334104, 1747334104),
('admin', 1, 'Администратор', NULL, NULL, 1747334104, 1747334104),
('user', 1, 'Обычный пользователь', NULL, NULL, 1747334104, 1747334104);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'accessAdminPanel');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(1, 1, 1, 7, '5000.00', '2025-05-12 19:11:40'),
(2, 1, 2, 2, '4500.00', '2025-05-12 19:11:44'),
(3, 1, 3, 2, '4400.00', '2025-05-12 19:11:48'),
(4, 1, 4, 1, '4200.00', '2025-05-12 19:11:53'),
(5, 1, 5, 2, '7000.00', '2025-05-12 19:11:59'),
(6, 1, 6, 3, '14000.00', '2025-05-12 19:12:04'),
(7, 1, 7, 2, '10000.00', '2025-05-12 19:12:09'),
(8, 5, 7, 1, '10000.00', '2025-05-16 06:52:43'),
(9, 7, 1, 1, '5000.00', '2025-05-17 16:48:21');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1747076825),
('m140506_102106_rbac_init', 1747327620),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1747327620),
('m180523_151638_rbac_updates_indexes_without_prefix', 1747327621),
('m200409_110543_rbac_update_mssql_trigger', 1747327621),
('m250416_052253_create_user_table', 1747076827),
('m250416_052817_create_category_table', 1747076827),
('m250416_052938_create_products_table', 1747076827),
('m250425_095112_create_reviews_table', 1747076827),
('m250429_111327_create_cart_items_table', 1747076828),
('m250512_185157_create_order_table', 1747157115);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_address` varchar(255) NOT NULL,
  `delivery_method` varchar(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `delivery_comment` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `material` varchar(100) DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Флаг новинки (0/1)',
  `dimensions` varchar(100) DEFAULT NULL COMMENT 'Габариты (ШxВxГ)',
  `size` enum('small','medium','large') DEFAULT NULL,
  `category` enum('Комоды','Шкафы','Стулья','Столы','Кровати','Трельяж','Диваны','Пуфы') DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `favoritesCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `material`, `is_new`, `dimensions`, `size`, `category`, `category_id`, `favoritesCount`) VALUES
(1, 'Комод', 'Комод - удобная функциональная мебель, состоящая из нескольких ящиков. Подходит для хранения мелочей.\r\n\r\n', '5000.00', 'uploads/products/comod.jpg', '2025-05-12 19:08:58', '2025-05-25 04:06:07', 'wood', 0, NULL, 'small', 'Комоды', NULL, 0),
(2, 'Шкаф', 'Шкаф - это многофункциональная мебель, предназначенная для хранения одежды, обуви и аксессуаров.\r\n\r\n', '4500.00', 'uploads/products/wardrobe.jpg', '2025-05-12 19:09:39', '2025-05-25 04:06:12', 'wood', 0, NULL, 'large', 'Шкафы', NULL, 0),
(3, 'Стул', 'Стул — предмет мебели для сидения одного человека, с опорой для спины (в отличие от табурета) с подлокотниками или без них.\r\n\r\n', '4400.00', 'uploads/products/office_chair.png', '2025-05-12 19:09:59', '2025-05-25 04:06:16', 'metal', 0, NULL, 'small', 'Стулья', NULL, 0),
(4, 'Стол', 'Стол - незаменимый элемент мебели, который используется в различных целях: для работы, приема пищи или отдыха.\r\n\r\n', '4200.00', 'uploads/products/table.jpg', '2025-05-12 19:10:22', '2025-05-25 04:06:21', 'wood', 0, NULL, 'medium', 'Столы', NULL, 0),
(5, 'Кровать', 'Кровать - основная мебель для обеспечения комфортного сна. Она состоит из каркаса и матраса, может иметь изголовье и специальные выдвижные ящики для хранения.\r\n\r\n', '7000.00', 'uploads/products/bed.jpg', '2025-05-12 19:10:47', '2025-05-25 04:06:26', 'fabric', 0, NULL, 'large', 'Кровати', NULL, 0),
(6, 'Трельяж', 'Трельяж - это особый вид мебели, который сочетает в себе зеркало и полочки для хранения косметики и аксессуаров.\r\n\r\n', '14000.00', 'uploads/products/trellis-diamonds.jpg', '2025-05-12 19:11:07', '2025-05-25 04:06:32', 'metal', 0, NULL, 'medium', 'Трельяж', NULL, 0),
(7, 'Диван', 'Диван — жёсткий, полужёсткий, полумягкий или мягкий предмет мебели со спинкой, предназначенный для сидения одного и/или нескольких человек.\r\n\r\n', '10000.00', 'uploads/products/sofa.jpg', '2025-05-12 19:11:30', '2025-05-25 04:06:37', 'fabric', 0, NULL, 'large', 'Диваны', NULL, 0),
(8, 'Пуф', 'Удобный пуф для интерьера. Идеально подходит для использования в гостиной, спальне или прихожей. Может служить как дополнительным сиденьем, так и декоративным элементом.', '4500.00', 'uploads/products/pouf.jpg', '2025-05-28 10:42:17', '2025-05-28 12:02:18', 'fabric', 1, '45x45x40 см', 'medium', 'Пуфы', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','answered','hidden') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `product_id`, `user_id`, `question`, `answer`, `created_at`, `status`) VALUES
(1, 8, 1, 'Какой материал используется в этом пуфе?', 'Пуф сделан из высококачественной экокожи', '2025-05-28 10:51:56', 'answered'),
(2, 8, 5, 'Можно ли использовать пуф как подставку для ног?', 'Да, конечно! Пуф отлично подходит для использования в качестве подставки для ног.', '2025-05-28 10:51:56', 'answered'),
(3, 8, 1, 'Есть ли гарантия на этот товар?', 'Да гарантия действует в течении года', '2025-05-28 10:51:56', 'pending');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `text`, `photo`, `created_at`, `rating`) VALUES
(1, 1, 1, 'Мебель неплохая, но ожидал большего за такую цену. Нужно было больше информации на сайте.\r\n', 'uploads/reviews/avatar-men.png', '2025-05-12 19:08:27', 4),
(2, 1, 1, 'Мебель из этого магазина очень качественная! Я купил стол и стулья для кухни и теперь моя кухня выглядит просто отлично.', 'uploads/reviews/avatar-men.png', '2025-05-15 15:52:28', 5),
(3, 5, 1, 'Норм мебель ', 'uploads/reviews/avatar-men.png', '2025-05-16 06:53:15', 4),
(4, 1, 1, 'Мне очень понравилось мебель', 'uploads/reviews/avatar-men.png', '2025-05-17 06:52:20', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'Artem', 'Артём', 'Воинков', 'artem@mail.ru', '$2y$13$/2VUaK1NUxGap9cFUZddl.d0RbWBQxqtSpuTIxrFL.tP.JNY2Eg5.', '+7.912.522-64-20', '2025-05-12 19:07:39'),
(2, 'Admin', 'Иван', 'Макаров', 'admin@mail.tu', '$2y$13$MPY9qLTNvyD217s7p/QPO.vTUi/rqj5JPRXEE4DEct3K.v9Kf4AUW', '+7.922.560-97-65', '2025-05-14 07:01:42'),
(4, 'test', 'test', 'test', 'test@test.test', '$2y$13$/mOmedo.ziQGMKrd5kDYEe751meB4QCB1fNdeWKhLHO7VcYtlOpS6', '+7.343.433-43-43', '2025-05-15 18:48:35'),
(5, 'Ashaat', 'Асхат', 'Чиняев', '123acxam@gmail.com', '$2y$13$zazJmQY0XQhHGaNa/TdfMuJ/Re478MBJjnS8eN9fwzi37c4xYyNfa', '+7.799.242-89-30', '2025-05-16 06:52:13'),
(6, 'zxc', 'serega', 'pirat', 'seregapirat@gmail.com', '$2y$13$c1/eQxMNDxDE4mk.bt6D7OzkKRc7HnflCnkzskYiUuACmECMRyK0G', '+7.999.999-99-99', '2025-05-17 16:27:12'),
(7, 'Neu3BecTHo', 'Макаров', 'Иван', 'Dogsvk@gmail.com', '$2y$13$DfcYsNIKYbdtIDy3zqKmB.evhg.7Ke61hWfPX6qjH4uMkEmFTrtQq', '+7.879.225-60-97', '2025-05-17 16:47:24'),
(8, 'soniksssser', 'Sofia', 'vinnitskai', 'sonazeltov@gmail.com', '$2y$13$IXl51H6GcUTa5L5D0EL.VedPpXPq0iZQTnWOUnMsoMKzjuVVvMsFK', '+7.951.262-65-05', '2025-05-22 18:08:03');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-cart_items-user_id` (`user_id`),
  ADD KEY `fk-cart_items-product_id` (`product_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favorite` (`user_id`,`product_id`),
  ADD KEY `fk-favorites-product_id` (`product_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-order-user_id` (`user_id`),
  ADD KEY `fk-order-product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-questions-product_id` (`product_id`),
  ADD KEY `fk-questions-user_id` (`user_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-reviews-user_id` (`user_id`),
  ADD KEY `fk-reviews-product_id` (`product_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk-cart_items-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-cart_items-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk-favorites-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-favorites-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk-order-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-order-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk-questions-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-questions-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk-reviews-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-reviews-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

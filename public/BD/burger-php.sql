-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0:3306
-- Время создания: Авг 18 2026 г., 17:45
-- Версия сервера: 8.0.43
-- Версия PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burger-php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chooce`
--

CREATE TABLE `chooce` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'subtitle',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'общий заголовок',
  `suptitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'suptitle',
  `column_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок колонки',
  `column_suptitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'column_suptitle',
  `shadow` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'тень',
  `column_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'column_order',
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'картинка1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='chooce';

--
-- Дамп данных таблицы `chooce`
--

INSERT INTO `chooce` (`id`, `subtitle`, `title`, `suptitle`, `column_title`, `column_suptitle`, `shadow`, `column_order`, `filename`) VALUES
(4, 'pic4.jpg', 'CHOOSE  ENJOY !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.&#38;#38;#34;', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do', 'pic7.png', 'pic5.jpg', 'img_6a6ae6cd601637.17190443.jpg'),
(5, 'pic4.jpg', 'CHOOSE  ENJOY !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.&#38;#38;#34;', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do', 'pic7.png', 'pic5.jpg', 'pic2.png'),
(6, 'pic4.jpg', 'CHOOSE  ENJOY !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.&#38;#38;#34;', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do', 'pic7.png', 'pic5.jpg', 'pic3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `discover`
--

CREATE TABLE `discover` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'subtitle',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'title',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'текст',
  `slide_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'slide_1',
  `slide_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'slide_2',
  `slide_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'slide_3'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='discover';

--
-- Дамп данных таблицы `discover`
--

INSERT INTO `discover` (`id`, `subtitle`, `title`, `text`, `slide_1`, `slide_2`, `slide_3`) VALUES
(1, 'DISCOVER', 'UPCOMING EVENTS', 'Lorem ipsum dolor sit amet, consectetur adipisc-                 ing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-                 pendisse ultrices gravida. Risus commodo viverra maecenas accumsan                 lacus                 vel facilisis.', '6a610089d5d62e8b37f7cb24bf9e0516.jpg', '05.png', '04.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `footer`
--

CREATE TABLE `footer` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `logo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'логотип',
  `textarea` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'текст',
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'copyright',
  `location` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'локация',
  `location_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'локация текст',
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'email',
  `email_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'email-ext',
  `instagram` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'instagram',
  `facebook` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'facebook',
  `twitter` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'twitter',
  `whatsapp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'whatsapp',
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'фон'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='footer';

--
-- Дамп данных таблицы `footer`
--

INSERT INTO `footer` (`id`, `logo`, `textarea`, `copyright`, `location`, `location_text`, `email`, `email_address`, `instagram`, `facebook`, `twitter`, `whatsapp`, `filename`) VALUES
(1, 'logo_6a733de168a226.01230885.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et\r\n                  dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viver ra maecenas accumsan\r\n                  lacus vel facilisis.', '© Company Name 2020.ts reserved.', 'Location.png', 'MAIN rOAD, BUILDING NAME, COUNTRY', 'Email.png', 'INFO@COMPANYNAME.COM', 'Instagram.png', 'Facebook.png', 'Twitter.png', 'whatsapp_6a733853e2bb70.39606431.png', 'footer-fon.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `hamburger`
--

CREATE TABLE `hamburger` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `filename_1` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'burger',
  `filename_2` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'burger',
  `filename_3` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'burger'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='hamburger';

--
-- Дамп данных таблицы `hamburger`
--

INSERT INTO `hamburger` (`id`, `filename_1`, `filename_2`, `filename_3`) VALUES
(1, 'pic2.jpg', 'more.jpg', 'fresh.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `header`
--

CREATE TABLE `header` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `picframe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'картинка левая',
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'subtitle',
  `rectangle` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'рамка',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок',
  `suptitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'подзаголовок',
  `fond` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'картинка бургера',
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'фон'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='header';

--
-- Дамп данных таблицы `header`
--

INSERT INTO `header` (`id`, `picframe`, `subtitle`, `rectangle`, `title`, `suptitle`, `fond`, `filename`) VALUES
(1, 'pic4.jpg', 'It is a good time for the great taste of burgers', 'rectangle.png', 'Burger', 'Week', 'bg.jpg', 'burger.png');

-- --------------------------------------------------------

--
-- Структура таблицы `nav`
--

CREATE TABLE `nav` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `car` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'машинка',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'телефон',
  `num` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'номер телефона',
  `ting` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'текст',
  `page-home` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'страничка home',
  `page-menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'страничка menu',
  `page-story` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'страничка story',
  `page-contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'страничка contact',
  `filename` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'logo',
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок страницы',
  `description` varchar(140) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'описание страницы'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='navigation';

--
-- Дамп данных таблицы `nav`
--

INSERT INTO `nav` (`id`, `car`, `phone`, `num`, `ting`, `page-home`, `page-menu`, `page-story`, `page-contact`, `filename`, `title`, `description`) VALUES
(1, 'phone-img.png', 'Phone.png    11', '+1 234-567-89-10   11', 'Express Delivery 11', 'HOME 11', 'MENU 11', 'OUR STORY 11', 'CONTACT UC  11', 'Logo.png', 'заголовок страницы на 120 символов', 'описание станицы на 140 символов');

-- --------------------------------------------------------

--
-- Структура таблицы `reservation`
--

CREATE TABLE `reservation` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `suptitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'suptitle',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок',
  `burger` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'burger',
  `bottle` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'bottle',
  `snack` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'reservation'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='reservation';

--
-- Дамп данных таблицы `reservation`
--

INSERT INTO `reservation` (`id`, `suptitle`, `title`, `burger`, `bottle`, `snack`) VALUES
(1, 'RESERVATION  !!??!!', 'BOOK YOUR TABLE !!??!!', 'img_6a70600616c840.65728160.jpg', 'bottle.png', 'img_6a70632089e7e7.97313894.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL COMMENT 'идентификатор',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'имя',
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'логин',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'пароль',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'почта'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='user ';

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `login`, `password`, `email`) VALUES
(6, 'kuzma', 'kuzmich', '$2y$10$bknz6J.dcVIZvuS2yKCoruZFmMuHKdSSUzb.U2rf440KGZ.OTzYK2', 'ku@zmich');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chooce`
--
ALTER TABLE `chooce`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `discover`
--
ALTER TABLE `discover`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `footer`
--
ALTER TABLE `footer`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `hamburger`
--
ALTER TABLE `hamburger`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `header`
--
ALTER TABLE `header`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `nav`
--
ALTER TABLE `nav`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chooce`
--
ALTER TABLE `chooce`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `discover`
--
ALTER TABLE `discover`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `hamburger`
--
ALTER TABLE `hamburger`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `header`
--
ALTER TABLE `header`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nav`
--
ALTER TABLE `nav`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

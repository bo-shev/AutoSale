-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 21 2021 г., 17:38
-- Версия сервера: 5.6.47
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `car-shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auction_lot`
--

CREATE TABLE `auction_lot` (
  `id_item` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `time_end` int(11) NOT NULL,
  `current_price` int(11) NOT NULL,
  `minimal_bet` int(11) NOT NULL,
  `start_price` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auction_lot`
--

INSERT INTO `auction_lot` (`id_item`, `winner_id`, `time_end`, `current_price`, `minimal_bet`, `start_price`, `id`) VALUES
(2, 16, 1627638180, 441536, 51, 441414, 4),
(3, NULL, 1642775700, 50, 5, 50, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `price`) VALUES
(2, 'New', 'Car', 400),
(3, 'Заз', 'Таврія ', 400),
(4, 'Ford', 'Fiesta', 7000),
(5, 'Ваз', '2109', 1750),
(6, 'Ваз', 'Нива', 2500);

-- --------------------------------------------------------

--
-- Структура таблицы `car_info`
--

CREATE TABLE `car_info` (
  `id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `horse_power` int(11) NOT NULL,
  `volume` float NOT NULL,
  `fuel_type` varchar(64) NOT NULL,
  `car_mileage` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `car_info`
--

INSERT INTO `car_info` (`id`, `fk_car_id`, `horse_power`, `volume`, `fuel_type`, `car_mileage`, `year`, `description`) VALUES
(13, 2, 156, 1.7, 'electric', 1521555, 2007, 'Тут розповідається про товар'),
(14, 3, 752, 1.3, 'diesel', 10, 1996, 'Тут йдеться про автомобіль'),
(15, 4, 89, 1.2, 'petrol', 56000, 2011, 'Автомобиль с первого дня покупки находится в руках одной семьи . Покупали в авто салоне .\r\nДвигатель 1,2 литра - 4 цилиндра механика .Комплектация: кондиционер , стеклоподъемники , мультируль, бортовой компьютер .'),
(16, 5, 75, 1.5, 'petrol', 125000, 2004, 'Продам авто. Інжекторна! Технічно ідеальний стан. Всі вікна рідні, навіть лобове. Є підкраси. \r\nПотребує косметики.'),
(17, 6, 79, 1.7, 'petrol', 59000, 2006, 'Авто в отличном состоянии , вложений не требует\r\nНа офроуде не была\r\nСиденья с иномаркы\r\nТонирована в круг\r\nКарданы на шрузах\r\nГбо 4\r\nДвигатель КПП раздатка мосты в норме\r\nНовая резина');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `category`) VALUES
(2, 'auctionCar'),
(3, 'auctionCar'),
(4, 'car'),
(5, 'car'),
(6, 'car');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `fk_user_id`, `fk_car_id`) VALUES
(2, 16, 1),
(5, 17, 1),
(8, 17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `fk_goods_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `fk_goods_id`, `name`) VALUES
(21, 2, '6cfe41bf7c11c3e212b0270ad0806f1a.jpg'),
(22, 2, 'f48814e704a2f1fea9b0e4815e25d6ff.jpg'),
(23, 2, 'c85991c13a3f5a219cb64c1163e6ed86.jpg'),
(24, 3, '998821649ecab78a95b75ec991173069.jpg'),
(25, 3, '515150706ebbaa57059db726584a294b.jpg'),
(26, 4, '5f99e93bb440532313757ea4a35d1bd2.jpg'),
(27, 4, '5cec56fcbf486d41790d9c3913262e8e.jpg'),
(28, 4, 'e7822d149abe0b5740269a702cd903b4.jpg'),
(29, 5, '97ac9ca14ac5c1c4cb19acc81418e7ca.jpg'),
(30, 5, '60ce0a8268cd407fcccb9385cfaca44d.jpg'),
(31, 5, '30b454899f79215f95f939ec63d434ef.jpg'),
(32, 6, '8c416452b00ec8af0f0a5cafe9a28f09.jpg'),
(33, 6, '73a84093dac914cac150426afa60e448.jpg'),
(34, 6, 'ae62792adfb3adcb2633bc2714f9c002.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_login` varchar(35) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_hash` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_number` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_mail`, `user_password`, `user_hash`, `user_ip`, `user_number`, `role`) VALUES
(15, 'qwerty', 'bo_d@ukr.net', 'cd7fd1517e323f26c6f1b0b6b96e3b3d', '', '', 505869889, 'user'),
(16, 'admin', 'admin@ukr.net', 'c3284d0f94606de1fd2af172aba15bf3', '4deb75d7a070b3c10d57a0a0f42823c5', '', 505869889, 'admin'),
(17, 'user123', 'moder@ukr.net', 'd9b1d7db4cd6e70935368a1efb10e377', 'a998bd1e8cbdb1e6409a08f5ec23ba8f', '', 505869999, 'moder');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auction_lot`
--
ALTER TABLE `auction_lot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `car_info`
--
ALTER TABLE `car_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_car_id` (`fk_car_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_goods_id` (`fk_goods_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auction_lot`
--
ALTER TABLE `auction_lot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `car_info`
--
ALTER TABLE `car_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auction_lot`
--
ALTER TABLE `auction_lot`
  ADD CONSTRAINT `auction_lot_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`id`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `car_info`
--
ALTER TABLE `car_info`
  ADD CONSTRAINT `car_info_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`id`);

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`fk_goods_id`) REFERENCES `goods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

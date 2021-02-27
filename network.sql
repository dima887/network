-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 27 2021 г., 14:35
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `network`
--

-- --------------------------------------------------------

--
-- Структура таблицы `citys`
--

CREATE TABLE `citys` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `citys`
--

INSERT INTO `citys` (`id`, `city`) VALUES
(1, 'Брестская область'),
(2, 'Витебская область'),
(3, 'Гомельская область'),
(4, 'Гродненская область'),
(5, 'Минская область'),
(6, 'Могилёвская область');

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `mediatype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `media`
--

INSERT INTO `media` (`id`, `mediatype`) VALUES
(1, 'Фото'),
(2, 'Видео'),
(3, 'Пусто');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `storys`
--

CREATE TABLE `storys` (
  `id` int(11) NOT NULL,
  `idstorytype` int(11) NOT NULL,
  `story` varchar(500) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcity` int(11) NOT NULL,
  `idmedia` int(11) NOT NULL,
  `datatime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `storys`
--

INSERT INTO `storys` (`id`, `idstorytype`, `story`, `iduser`, `idcity`, `idmedia`, `datatime`, `path`) VALUES
(1, 1, 'Сегодня ехал в трамвае, меня по плечу похлопала женщина средних лет. Я вытащил наушник и тут она мне говорит: \"видишь у девушки справа татуировку — иероглифы на шее? Так вот, я преподавала китайский 15 лет и не могу понять, зачем она написала у себя на шее ПОВТОРНО НЕ ЗАМОРАЖИВАТЬ\".\r\nОднозначно шокировало...', 34, 1, 3, '2021-02-24 18:43:26', ''),
(2, 1, 'Стояла я как-то на безлюдной остановке в сумерках. Подходит парень, пропускает 3-4 автобуса и ко мне \"Дай телефон\". Моё отупение спасло телефон:\r\n- Не могу, я замужем.\r\nС минуту он молчал, а потом - \"Повезло кому-то\" и на ближайшем транспорте уехал)))\r\nТо, что он трубу хотел, а не номерок, я поняла позже.', 24, 5, 3, '2021-02-24 18:43:24', ''),
(3, 1, 'Вчера в обувном магазине спросили у продавца :\r\n- Это сапоги из замши?\r\nОтвет был великолепен :\r\n- Что вы, замша очень дорогое животное, встречается очень редко. Это натуральный велюр!\r\nПохоже, уже сказываются эксперименты с ЕГЭ..', 23, 5, 3, '2021-02-24 18:43:18', ''),
(151, 1, 'История из Минска!)', 61, 5, 1, '2021-02-27 12:57:13', '../public/images/qp6und-4l4ali.jpeg'),
(152, 1, 'История из Бреста!))))', 61, 1, 3, '2021-02-27 12:57:48', ''),
(153, 1, 'История из Минска)', 35, 5, 3, '2021-02-27 12:58:45', ''),
(154, 1, 'История из Минска!', 35, 5, 3, '2021-02-27 13:01:55', ''),
(155, 1, 'Классная тачка', 35, 5, 2, '2021-02-27 13:22:27', '../public/images/qp6vtf-dmevhs.mp4'),
(156, 1, 'История из Гомеля.', 24, 3, 3, '2021-02-27 13:23:56', ''),
(157, 1, 'Вчера в обувном магазине спросили у продавца : - Это сапоги из замши? Ответ был великолепен : - Что вы, замша очень дорогое животное, встречается очень редко. Это натуральный велюр! Похоже, уже сказываются эксперименты с ЕГЭ..', 24, 3, 3, '2021-02-27 13:24:32', ''),
(158, 1, 'Еще одна история', 24, 3, 3, '2021-02-27 13:24:50', ''),
(159, 1, 'Очередная история', 24, 5, 3, '2021-02-27 13:25:09', ''),
(160, 1, 'Красиво)', 24, 1, 2, '2021-02-27 13:26:07', '../public/images/qp6vzj-h7mlze.mp4'),
(161, 1, 'История из Гомеля', 35, 3, 1, '2021-02-27 13:28:03', '../public/images/qp6w2r-da4aly.jpeg'),
(162, 1, 'В Бресте хорошо.', 35, 1, 1, '2021-02-27 13:28:36', '../public/images/qp6w3o-eqsacu.jpeg'),
(163, 1, 'Еще одна история!', 35, 5, 3, '2021-02-27 13:31:05', ''),
(164, 1, 'Классный звук', 35, 5, 2, '2021-02-27 13:31:33', '../public/images/qp6w8l-woeysh.mp4');

-- --------------------------------------------------------

--
-- Структура таблицы `storytypes`
--

CREATE TABLE `storytypes` (
  `id` int(11) NOT NULL,
  `storytype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `storytypes`
--

INSERT INTO `storytypes` (`id`, `storytype`) VALUES
(1, 'История'),
(2, 'Комментарий');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idrole` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`, `idrole`) VALUES
(23, 'natasha', '$2y$10$Ofafh30qjMXrAAVFLYgwve5ntZe4tCv0IacFXPA.T8i0lK9j3OLJ2', 'Наталья', 'natali@mail.ru', 1),
(24, 'leralike', '$2y$10$HAcNVaOo.0vobb9YGCU6CuPkmNweCM8lUgkoTOFOra8C.t55l5ZSu', 'Лера', 'ler@mail.ru', 1),
(34, 'kesha', '$2y$10$KKMIEk1Y1Ld2kQklV0AVwenUMizgpVtJHx25B26oFI0Efzvwvzl.y', 'Кеша', 'kot@mail.ru', 1),
(35, 'dima29', '$2y$10$39twPITkeEO9DMDVgzpGY.sbsj0EhQxZyyHgiDtmbuDJYV2HAgJSy', 'Дима', 'dima@mail.ru', 1),
(61, 'masha7', '$2y$10$78N0CGmnc27cqKQdqsY95eUWSEPgLxWIXv7hHC7zyYTayw95mtq7C', 'Мария', 'masha@mail.ru', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `storys`
--
ALTER TABLE `storys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_storys_citys_id` (`idcity`),
  ADD KEY `FK_storys_storytypes_id` (`idstorytype`),
  ADD KEY `FK_storys_media_id` (`idmedia`),
  ADD KEY `FK_storys_users_id` (`iduser`);

--
-- Индексы таблицы `storytypes`
--
ALTER TABLE `storytypes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `mail` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `password` (`password`) USING BTREE,
  ADD KEY `FK_users_role_id` (`idrole`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `citys`
--
ALTER TABLE `citys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `storys`
--
ALTER TABLE `storys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `storys`
--
ALTER TABLE `storys`
  ADD CONSTRAINT `FK_storys_citys_id` FOREIGN KEY (`idcity`) REFERENCES `citys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_storys_media_id` FOREIGN KEY (`idmedia`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_storys_storytypes_id` FOREIGN KEY (`idstorytype`) REFERENCES `storytypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_storys_users_id` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_role_id` FOREIGN KEY (`idrole`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

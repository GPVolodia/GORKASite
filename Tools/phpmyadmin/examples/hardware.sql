-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.26-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных hardware
CREATE DATABASE IF NOT EXISTS `hardware` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hardware`;


-- Дамп структуры для таблица hardware.attribute
CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.attribute: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `attribute` DISABLE KEYS */;
INSERT INTO `attribute` (`id`, `name`) VALUES
	(1, 'Производитель'),
	(2, 'Сокет'),
	(3, 'Чипсет'),
	(4, 'Частота ядра'),
	(5, 'Тип памяти'),
	(6, 'Объем памяти');
/*!40000 ALTER TABLE `attribute` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.category: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `description`, `order`) VALUES
	(1, 'cpu', 'Процессоры', 0),
	(2, 'motherboard', 'Материнские платы', 0),
	(3, 'gpu', 'Видеокарты', 0),
	(4, 'ram', 'Оперативная память', 0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.feedback: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` bit(1) DEFAULT b'0',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.product: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `price`, `category_id`, `name`, `image`, `status`, `description`) VALUES
	(1, 115, 2, 'Z97 Extreme 4', 'motherboard/asrock_z97_extreme4_2_preview.jpg', b'0', '(NULL)'),
	(2, 115, 2, 'Z170 PRO GAMING', 'motherboard/asus_z170_progaming_2_preview.jpg', b'0', NULL),
	(3, 115, 2, 'Maximus VII Ranger', 'motherboard/asus_maximus_VII_ranger_2_preview.png', b'0', NULL),
	(4, 115, 1, 'Skylake I7-6700K', 'cpu/intel_skylake_i7_6700k_preview.jpg', b'0', 'Новый процессор <b> Intel Core i7-6700K </b> 6-го поколения, с кодовым названием микроархитектуры <b> Skylake </b>. Предназначен для настольной платформы <b> Intel LGA 1151 </b>. Принадлежит к семейству высокопроизводительных процессоров<b> Core i7 </b> с большим разгонным потенциалом. <br> <br>\r\n<b> Intel Core i7-6700K </b> производится по стандарту 14-нм техпроцесса, имеет 4 ядра, которые работают в 8 потоков со штатной тактовой частотой 4.0 ГГц, 4.2 ГГц в режиме <b> Turbo Boost 2.0. </b> Объем кэш-памяти 3 уровня равен 8 МБ. Имеет 2-х канальный контроллер памяти DDR4 / DDR3L и разблокированный множитель.'),
	(5, 115, 1, 'Haswell I7-4790K', 'cpu/intel_i7_4790K_preview.jpg', b'0', NULL),
	(6, 115, 1, 'FX-8350', 'cpu/amd_fx_8350_preview.jpg', b'0', NULL),
	(7, 150, 3, 'GTX 960', 'gpu/asus_gtx_960_1_preview.png', b'0', NULL),
	(8, 115, 3, 'GTX 980 TI', 'gpu/gigabyte_gtx_980ti_2_preview.png', b'0', NULL),
	(9, 115, 3, 'GTX 970 Gaming 4G', 'gpu/msi_gtx_970_gmaing_4g_2_preview.png', b'0', NULL),
	(10, 115, 4, 'HyperX Savage', 'ram/kingston_hyperx_savage_preview.jpg', b'0', NULL),
	(11, 115, 4, 'Vengeance', 'ram/corsair_vengeance_preview.jpg', b'0', NULL),
	(12, 115, 4, 'Ballistix', 'ram/crucial_ballistix-preview.jpg', b'0', NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.product_attribute
CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`attribute_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.product_attribute: ~36 rows (приблизительно)
/*!40000 ALTER TABLE `product_attribute` DISABLE KEYS */;
INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `value`) VALUES
	(1, 1, 'AsRock'),
	(2, 1, 'Asus'),
	(3, 1, 'Asus'),
	(4, 1, 'Intel'),
	(5, 1, 'Intel'),
	(6, 1, 'AMD'),
	(7, 1, 'Asus'),
	(8, 1, 'Gigabyte'),
	(9, 1, 'MSI'),
	(10, 1, 'Kingston'),
	(11, 1, 'Corsair'),
	(12, 1, 'Crucial'),
	(1, 2, 'LGA 1150'),
	(2, 2, 'LGA 1151'),
	(3, 2, 'LGA 1150'),
	(4, 2, 'LGA 1151'),
	(5, 2, 'LGA 1151'),
	(6, 2, 'AM3'),
	(1, 3, 'Z97'),
	(2, 3, 'Z170'),
	(3, 3, 'Z97'),
	(4, 4, '4 Ггц'),
	(5, 4, '4 Ггц'),
	(6, 4, '4 Ггц'),
	(7, 5, 'DDR5'),
	(8, 5, 'DDR5'),
	(9, 5, 'DDR5'),
	(10, 5, 'DDR3'),
	(11, 5, 'DDR3'),
	(12, 5, 'DDR3'),
	(7, 6, '4 Гб'),
	(8, 6, '6 Гб'),
	(9, 6, '4 Гб'),
	(10, 6, '8 Гб'),
	(11, 6, '8 Гб'),
	(12, 6, '4 Гб');
/*!40000 ALTER TABLE `product_attribute` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.rating
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.rating: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` (`id`, `product_id`, `login`, `rate`) VALUES
	(1, 6, '', 2),
	(2, 6, '', 4),
	(3, 6, '', 5),
	(4, 4, '', 3),
	(5, 4, '', 5),
	(6, 5, '', 4),
	(7, 5, '', 2),
	(8, 5, '', 5),
	(9, 5, '', 2),
	(10, 4, '', 5),
	(11, 4, '', 1),
	(12, 4, '', 4);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.user: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `password`, `email`, `type`) VALUES
	(1, 'denis', '$2y$10$adnPJWma8/mDXHItcbgyu.MP049rhOobxYYnam7jgRxhKf39vfe8m', 'deniskublitskiy@gmail.com', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Дамп структуры для таблица hardware.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hardware.user_type: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

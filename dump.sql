-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: diplom_db
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_to_contacts`
--

DROP TABLE IF EXISTS `access_to_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `access_to_contacts` (
  `access_to_contacts_pk` int NOT NULL AUTO_INCREMENT,
  `from_user` int NOT NULL,
  `for_user` int DEFAULT NULL,
  PRIMARY KEY (`access_to_contacts_pk`),
  KEY `access_to_contacts_user_user_pk_fk` (`from_user`),
  KEY `access_to_contacts_user_user_pk_fk_2` (`for_user`),
  CONSTRAINT `access_to_contacts_user_user_pk_fk` FOREIGN KEY (`from_user`) REFERENCES `user` (`user_pk`),
  CONSTRAINT `access_to_contacts_user_user_pk_fk_2` FOREIGN KEY (`for_user`) REFERENCES `user` (`user_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_to_contacts`
--

LOCK TABLES `access_to_contacts` WRITE;
/*!40000 ALTER TABLE `access_to_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_to_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `city_pk` int NOT NULL AUTO_INCREMENT,
  `city` text NOT NULL,
  PRIMARY KEY (`city_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Другой'),(2,'Барнаул'),(3,'Санкт-Петербург'),(4,'Новосибирск'),(5,'Красноярск'),(6,'Москва'),(7,'Екатеринбург'),(8,'Нижний Новгород'),(9,'Казань'),(10,'Челябинск'),(11,'Омск'),(12,'Самара'),(13,'Ростов-на-Дону'),(14,'Уфа'),(15,'Воронеж'),(16,'Пермь'),(17,'Волгоград'),(18,'Краснодар'),(19,'Саратов'),(20,'Тюмень'),(21,'Тольятти'),(22,'Ижевск'),(23,'Ульяновск'),(24,'Иркутск'),(25,'Кемерово'),(26,'Рязань'),(27,'Томск'),(28,'Астрахань'),(29,'Пенза'),(30,'Липецк'),(31,'Киров'),(32,'Чебоксары'),(33,'Калининград'),(34,'Брянск'),(35,'Магнитогорск'),(36,'Ставрополь'),(37,'Набережные Челны'),(38,'Ярославль'),(39,'Иваново'),(40,'Тула'),(41,'Белгород'),(42,'Курск'),(43,'Нижний Тагил'),(44,'Владивосток'),(45,'Новокузнецк'),(46,'Череповец'),(47,'Калуга'),(48,'Сургут'),(49,'Сочи'),(50,'Орёл'),(51,'Смоленск'),(52,'Владимир'),(53,'Курган'),(54,'Тверь'),(55,'Мурманск'),(56,'Вологда'),(57,'Сыктывкар'),(58,'Грозный'),(59,'Чита'),(60,'Кострома'),(61,'Нижневартовск'),(62,'Великий Новгород'),(63,'Якутск'),(64,'Альметьевск'),(65,'Архангельск'),(66,'Салават'),(67,'Петрозаводск'),(68,'Новороссийск'),(69,'Нефтекамск'),(70,'Норильск'),(71,'Серпухов'),(72,'Энгельс'),(73,'Кызыл'),(74,'Хабаровск'),(75,'Нижнекамск'),(76,'Орск'),(77,'Ангарск'),(78,'Новочеркасск'),(79,'Златоуст'),(80,'Нягань'),(81,'Владикавказ'),(82,'Нижний Новгород'),(83,'Бийск'),(84,'Серпухов'),(85,'Шахты'),(86,'Благовещенск'),(87,'Таганрог'),(88,'Мытищи'),(89,'Димитровград'),(90,'Подольск'),(91,'Электросталь'),(92,'Махачкала'),(93,'Петропавловск-Камчатский'),(94,'Братск'),(95,'Арзамас'),(96,'Калуга'),(97,'Коломна'),(98,'Бердск'),(99,'Люберцы'),(100,'Домодедово'),(101,'Елец'),(102,'Зеленоград'),(103,'Щёлково'),(104,'Рубцовск');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_methods`
--

DROP TABLE IF EXISTS `contact_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_methods` (
  `contact_methods_pk` int NOT NULL AUTO_INCREMENT,
  `contact_method` char(100) NOT NULL,
  PRIMARY KEY (`contact_methods_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_methods`
--

LOCK TABLES `contact_methods` WRITE;
/*!40000 ALTER TABLE `contact_methods` DISABLE KEYS */;
INSERT INTO `contact_methods` VALUES (1,'Email'),(2,'Телефон'),(3,'Telegram'),(4,'WhatsApp'),(5,'Viber'),(6,'Signal'),(7,'Discord'),(8,'Skype'),(9,'Zoom'),(10,'Google Meet'),(11,'Microsoft Teams'),(12,'Slack'),(13,'VK (ВКонтакте)'),(14,'Facebook Messenger'),(15,'Instagram Direct'),(16,'Twitter (X) DM'),(17,'Reddit (личное сообщение)'),(18,'Другой способ');
/*!40000 ALTER TABLE `contact_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_experience`
--

DROP TABLE IF EXISTS `game_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_experience` (
  `game_experience_pk` int NOT NULL AUTO_INCREMENT,
  `game_experience_description` text NOT NULL,
  `numeric_size` int NOT NULL DEFAULT '0' COMMENT 'using for filters',
  PRIMARY KEY (`game_experience_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_experience`
--

LOCK TABLES `game_experience` WRITE;
/*!40000 ALTER TABLE `game_experience` DISABLE KEYS */;
INSERT INTO `game_experience` VALUES (1,'Меньше 6 месяцев',0),(2,'От 6 месяцев до 1 года',1),(3,'Около 1 года',1),(4,'От 1 до 3 лет',1),(5,'Больше 3 лет',3),(6,'Больше 5 лет',5),(7,'Больше 10 лет',10),(8,'Очень большой опыт (больше 15 лет)',15);
/*!40000 ALTER TABLE `game_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_session`
--

DROP TABLE IF EXISTS `game_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_session` (
  `game_session_pk` int NOT NULL AUTO_INCREMENT,
  `player_type_needed` tinyint NOT NULL COMMENT '0 - players. 1 - master',
  `player_count` tinyint DEFAULT '4',
  `game_format` tinyint(1) NOT NULL COMMENT 'online or offline',
  `game_duration` tinyint NOT NULL COMMENT '0 - oneshot, 1 - campaign, 2 any',
  `game_description` longtext,
  `game_place` text COMMENT 'address or online place',
  `game_date` datetime DEFAULT NULL,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `author` int NOT NULL,
  `game_status_pk` tinyint DEFAULT '0' COMMENT '0 - finding. 1 - full room',
  `city_pk` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`game_session_pk`),
  KEY `game_session_city_city_pk_fk` (`city_pk`),
  KEY `game_session_game_status_game_status_pk_fk` (`game_status_pk`),
  KEY `game_session_user_user_pk_fk` (`author`),
  CONSTRAINT `game_session_city_city_pk_fk` FOREIGN KEY (`city_pk`) REFERENCES `city` (`city_pk`),
  CONSTRAINT `game_session_user_user_pk_fk` FOREIGN KEY (`author`) REFERENCES `user` (`user_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_session`
--

LOCK TABLES `game_session` WRITE;
/*!40000 ALTER TABLE `game_session` DISABLE KEYS */;
INSERT INTO `game_session` VALUES (18,0,5,0,0,NULL,NULL,NULL,123445,23,0,3,'2025-05-21 18:34:40','2025-06-04 11:13:36'),(20,1,NULL,1,0,NULL,NULL,NULL,0,23,0,NULL,'2025-05-22 05:28:27','2025-06-04 11:08:29'),(24,0,4,0,1,'Приходите поиграть!','какой-то адрес','2025-05-31 14:12:00',0,29,0,2,'2025-05-27 04:10:24','2025-05-27 04:10:24'),(59,0,5,0,0,NULL,NULL,NULL,0,32,0,2,'2025-06-04 19:33:46','2025-06-04 19:33:46'),(60,1,NULL,1,0,NULL,NULL,NULL,0,32,0,NULL,'2025-06-04 20:05:14','2025-06-04 20:05:14'),(61,1,NULL,1,0,NULL,NULL,NULL,0,23,0,NULL,'2025-06-04 21:20:41','2025-06-05 06:49:12'),(62,0,5,0,0,NULL,NULL,NULL,0,23,0,2,'2025-06-04 21:23:04','2025-06-05 12:41:42'),(63,1,NULL,0,0,NULL,NULL,NULL,0,23,0,2,'2025-06-04 21:38:02','2025-06-04 21:38:02'),(64,1,NULL,0,0,NULL,NULL,NULL,0,23,0,2,'2025-06-04 21:38:04','2025-06-04 21:38:04'),(65,1,NULL,1,0,NULL,NULL,NULL,0,23,0,NULL,'2025-06-05 06:46:32','2025-06-05 06:46:32');
/*!40000 ALTER TABLE `game_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_session_system_list`
--

DROP TABLE IF EXISTS `game_session_system_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_session_system_list` (
  `game_session_system_list_pk` int NOT NULL AUTO_INCREMENT,
  `game_system_pk` int NOT NULL,
  `game_session_pk` int NOT NULL,
  PRIMARY KEY (`game_session_system_list_pk`),
  KEY `game_session_system_list_game_session_game_session_pk_fk` (`game_session_pk`),
  KEY `game_session_system_list_game_system_game_system_pk_fk` (`game_system_pk`),
  CONSTRAINT `game_session_system_list_game_session_game_session_pk_fk` FOREIGN KEY (`game_session_pk`) REFERENCES `game_session` (`game_session_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `game_session_system_list_game_system_game_system_pk_fk` FOREIGN KEY (`game_system_pk`) REFERENCES `game_system` (`game_system_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_session_system_list`
--

LOCK TABLES `game_session_system_list` WRITE;
/*!40000 ALTER TABLE `game_session_system_list` DISABLE KEYS */;
INSERT INTO `game_session_system_list` VALUES (56,6,24),(234,5,18),(235,5,59),(236,5,60),(241,5,63),(242,7,63),(243,5,64),(244,7,64),(245,5,65),(246,7,65),(255,5,61),(256,7,61),(257,6,61),(258,8,61),(259,9,61),(264,5,20),(265,7,20),(266,8,20),(267,9,20),(268,5,62);
/*!40000 ALTER TABLE `game_session_system_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_style_tag`
--

DROP TABLE IF EXISTS `game_style_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_style_tag` (
  `game_style_tag_pk` int NOT NULL AUTO_INCREMENT,
  `game_style_tag` text NOT NULL,
  PRIMARY KEY (`game_style_tag_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_style_tag`
--

LOCK TABLES `game_style_tag` WRITE;
/*!40000 ALTER TABLE `game_style_tag` DISABLE KEYS */;
INSERT INTO `game_style_tag` VALUES (1,'фэнтези'),(2,'научная фантастика'),(3,'ужасы'),(4,'киберпанк'),(5,'постапокалиптика'),(6,'стимпанк'),(7,'городские'),(8,'современные'),(9,'исторические'),(10,'средневековые'),(11,'космическая опера'),(12,'тёмное фэнтези'),(13,'эпическое фэнтези'),(14,'низкое фэнтези'),(15,'сверхъестественное'),(16,'мифическое'),(17,'меч и магия'),(18,'магия'),(19,'политические интриги'),(20,'мистика'),(21,'детектив'),(22,'расследование'),(23,'выживание'),(24,'исследование'),(25,'прохождение подземелий'),(26,'песочница'),(27,'линейное'),(28,'эпизодическое'),(29,'ориентировано на персонажей'),(30,'нарративное'),(31,'боевое'),(32,'ориентировано на роль'),(33,'лёгкие правила'),(34,'сложные правила'),(35,'тактическая боёвка'),(36,'социальное взаимодействие'),(37,'ролевое отыгрывание'),(38,'исследование мира'),(39,'микроменеджмент'),(40,'кооператив'),(41,'конкуренция'),(42,'PvP'),(43,'стратегия'),(44,'экшн'),(45,'хоррор-выживание'),(46,'мифология'),(47,'миротворчество'),(48,'политика и дипломатия'),(49,'прокачка персонажа'),(50,'мифическое повествование'),(51,'игра в группе'),(52,'игра с ведущим'),(53,'игра без ведущего'),(54,'сессии короткой продолжительности'),(55,'сессии длительной продолжительности'),(56,'минимализм в правилах'),(57,'максимализм в правилах'),(58,'импровизация'),(59,'сеттинг-зависимое повествование'),(60,'механики случайностей'),(61,'тяжелая сюжетная линия'),(62,'легкая и веселая игра'),(63,'карточная механика'),(64,'куча кубиков'),(65,'инди'),(66,'одиночная игра'),(67,'командная игра'),(68,'симуляция'),(69,'шпионаж'),(70,'военная'),(71,'вестерн'),(72,'пираты'),(73,'меха'),(74,'космические исследования'),(75,'космические бои'),(76,'инопланетные миры'),(77,'путешествия во времени'),(78,'зомби'),(79,'вампиры'),(80,'оборотни'),(81,'супергерои'),(82,'мутанты'),(83,'магический реализм'),(84,'психологический ужас'),(85,'тёмная комедия'),(86,'романтика'),(87,'бытовое'),(88,'ограбления'),(89,'преступность'),(90,'гангстеры'),(91,'нуар детектив'),(92,'гримдарк'),(93,'эпический сюжет'),(94,'трагический сюжет'),(95,'комедия'),(96,'для всей семьи'),(97,'для детей'),(98,'материалы для взрослых'),(99,'социальная критика'),(100,'панк'),(101,'искусственный интеллект'),(102,'роботы'),(103,'виртуальная реальность'),(104,'альтернативная история'),(105,'фэнтези-вестерн'),(106,'основано на мифах'),(107,'древние цивилизации'),(108,'городское фэнтези'),(109,'психические способности'),(110,'самураи'),(111,'ниндзя'),(112,'феодальная Япония'),(113,'пиратское фэнтези'),(114,'киберфэнтези'),(115,'космический вестерн'),(116,'будущее-нуар');
/*!40000 ALTER TABLE `game_style_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_system`
--

DROP TABLE IF EXISTS `game_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_system` (
  `game_system_pk` int NOT NULL AUTO_INCREMENT,
  `game_system_name` text NOT NULL,
  PRIMARY KEY (`game_system_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_system`
--

LOCK TABLES `game_system` WRITE;
/*!40000 ALTER TABLE `game_system` DISABLE KEYS */;
INSERT INTO `game_system` VALUES (5,'Dungeons & Dragons'),(6,'DnD 5e'),(7,'Pathfinder'),(8,'Pathfinder 2e'),(9,'Call of Cthulhu'),(10,'Delta Green'),(11,'Shadowrun'),(12,'Warhammer Fantasy Roleplay'),(13,'Warhammer 40k: Dark Heresy'),(14,'Cyberpunk 2020'),(15,'Cyberpunk RED'),(16,'GURPS'),(17,'World of Darkness'),(18,'Vampire: The Masquerade'),(19,'Werewolf: The Apocalypse'),(20,'Mage: The Ascension'),(21,'Blades in the Dark'),(22,'FATE Core'),(23,'FATE Accelerated'),(24,'Starfinder'),(25,'Savage Worlds'),(26,'Dungeon World'),(27,'Apocalypse World'),(28,'Monster of the Week'),(29,'Burning Wheel'),(30,'Mouse Guard'),(31,'13th Age'),(32,'Numenera'),(33,'The Strange'),(34,'Cypher System'),(35,'The One Ring'),(36,'TOR 2e'),(37,'The Lord of the Rings Roleplaying'),(38,'Dragon Age RPG'),(39,'Fantasy AGE'),(40,'Modern AGE'),(41,'Blue Rose'),(42,'Chronicles of Darkness'),(43,'Scion'),(44,'Exalted'),(45,'Paranoia'),(46,'Mörk Borg'),(47,'Into the Odd'),(48,'Electric Bastionland'),(49,'Troika!'),(50,'Mothership'),(51,'Alien RPG'),(52,'Vaesen'),(53,'Tales from the Loop'),(54,'Things from the Flood'),(55,'Forbidden Lands'),(56,'Mutant: Year Zero'),(57,'Coriolis'),(58,'Broken Compass'),(59,'Ironsworn'),(60,'Ironsworn: Starforged'),(61,'Stars Without Number'),(62,'Worlds Without Number'),(63,'Lancer'),(64,'Mythras'),(65,'RuneQuest'),(66,'Basic Roleplaying (BRP)'),(67,'Feng Shui'),(68,'Genesys'),(69,'Star Wars: Edge of the Empire'),(70,'Star Wars: Age of Rebellion'),(71,'Star Wars: Force and Destiny'),(72,'Tiny Dungeon'),(73,'Tiny Frontiers'),(74,'Tiny D6'),(75,'Index Card RPG'),(76,'Knave'),(77,'Mazes & Minotaurs'),(78,'Old School Essentials'),(79,'OSRIC'),(80,'Labyrinth Lord'),(81,'Basic Fantasy RPG'),(82,'Swords & Wizardry'),(83,'Shadow of the Demon Lord'),(84,'The Black Hack'),(85,'The White Hack'),(86,'Cthulhu Dark'),(87,'Ten Candles'),(88,'Fiasco'),(89,'Microscope'),(90,'Lasers & Feelings'),(91,'Honey Heist'),(92,'Wanderhome'),(93,'Alice is Missing'),(94,'Thirsty Sword Lesbians'),(95,'Brindlewood Bay'),(96,'Cthulhu Confidential'),(97,'Mutants & Masterminds'),(98,'Heroes Unlimited'),(99,'RIFTS'),(100,'After the Bomb'),(101,'Dark Sun (D&D Setting)'),(102,'Planescape (D&D Setting)');
/*!40000 ALTER TABLE `game_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_system_list`
--

DROP TABLE IF EXISTS `game_system_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_system_list` (
  `game_system_list_pk` int NOT NULL AUTO_INCREMENT,
  `game_system_pk` int NOT NULL,
  `user_pk` int NOT NULL,
  `game_experience_pk` int NOT NULL,
  PRIMARY KEY (`game_system_list_pk`),
  KEY `game_system_list_game_system_game_system_pk_fk` (`game_system_pk`),
  KEY `game_system_list_user_user_pk_fk` (`user_pk`),
  KEY `game_system_list_game_experience_game_experience_pk_fk` (`game_experience_pk`),
  CONSTRAINT `game_system_list_game_experience_game_experience_pk_fk` FOREIGN KEY (`game_experience_pk`) REFERENCES `game_experience` (`game_experience_pk`),
  CONSTRAINT `game_system_list_game_system_game_system_pk_fk` FOREIGN KEY (`game_system_pk`) REFERENCES `game_system` (`game_system_pk`),
  CONSTRAINT `game_system_list_user_user_pk_fk` FOREIGN KEY (`user_pk`) REFERENCES `user` (`user_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_system_list`
--

LOCK TABLES `game_system_list` WRITE;
/*!40000 ALTER TABLE `game_system_list` DISABLE KEYS */;
INSERT INTO `game_system_list` VALUES (226,5,23,1),(227,7,23,6);
/*!40000 ALTER TABLE `game_system_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice_list`
--

DROP TABLE IF EXISTS `notice_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notice_list` (
  `notice_list_pk` int NOT NULL AUTO_INCREMENT,
  `notice_type` tinyint NOT NULL,
  `from_user` int NOT NULL,
  `for_user` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `answer` tinytext,
  `read_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`notice_list_pk`),
  KEY `notice_list_user_user_pk_fk` (`for_user`),
  KEY `notice_list_user_user_pk_fk_2` (`from_user`),
  CONSTRAINT `notice_list_user_user_pk_fk` FOREIGN KEY (`for_user`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notice_list_user_user_pk_fk_2` FOREIGN KEY (`from_user`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice_list`
--

LOCK TABLES `notice_list` WRITE;
/*!40000 ALTER TABLE `notice_list` DISABLE KEYS */;
INSERT INTO `notice_list` VALUES (162,0,29,23,'2025-06-05 18:38:20','2025-06-05 18:38:45','Вы приняли заявку',1),(163,1,23,29,'2025-06-05 18:38:22','2025-06-05 18:41:03','принял вашу заявку',1),(164,0,29,23,'2025-06-05 18:40:39','2025-06-05 18:40:54','Вы приняли заявку',1),(165,1,23,29,'2025-06-05 18:40:54','2025-06-05 18:41:03','принял вашу заявку',1);
/*!40000 ALTER TABLE `notice_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('kajos@yandex.ru','$2y$12$iiJokvbDpLuiN3c9rrmJmucgCv.hYF6If0xPeMxTEoeoIOcEgx9yG','2025-06-04 15:57:08');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_list_of_game_session`
--

DROP TABLE IF EXISTS `player_list_of_game_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player_list_of_game_session` (
  `user_pk` int NOT NULL,
  `game_session_pk` int NOT NULL,
  `notice_for_author` int NOT NULL,
  `invite_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - waiting ,1 - accept, 2 - not accept',
  `player_list_of_game_session_pk` int NOT NULL AUTO_INCREMENT,
  `notice_for_user` int DEFAULT NULL,
  PRIMARY KEY (`player_list_of_game_session_pk`),
  KEY `player_list_of_game_session_game_session_game_session_pk_fk` (`game_session_pk`),
  KEY `player_list_of_game_session_user_user_pk_fk` (`user_pk`),
  KEY `player_list_of_game_session_notice_list_notice_list_pk_fk` (`notice_for_author`),
  KEY `player_list_of_game_session_notice_list_notice_list_pk_fk_2` (`notice_for_user`),
  CONSTRAINT `player_list_of_game_session_game_session_game_session_pk_fk` FOREIGN KEY (`game_session_pk`) REFERENCES `game_session` (`game_session_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `player_list_of_game_session_notice_list_notice_list_pk_fk` FOREIGN KEY (`notice_for_author`) REFERENCES `notice_list` (`notice_list_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `player_list_of_game_session_notice_list_notice_list_pk_fk_2` FOREIGN KEY (`notice_for_user`) REFERENCES `notice_list` (`notice_list_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `player_list_of_game_session_user_user_pk_fk` FOREIGN KEY (`user_pk`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_list_of_game_session`
--

LOCK TABLES `player_list_of_game_session` WRITE;
/*!40000 ALTER TABLE `player_list_of_game_session` DISABLE KEYS */;
INSERT INTO `player_list_of_game_session` VALUES (29,18,162,1,89,163),(29,20,164,1,90,165);
/*!40000 ALTER TABLE `player_list_of_game_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews_list`
--

DROP TABLE IF EXISTS `reviews_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews_list` (
  `reviews_list_pk` int NOT NULL AUTO_INCREMENT,
  `review_rating` tinyint NOT NULL,
  `review_text` longtext NOT NULL,
  `date` datetime DEFAULT NULL,
  `from_user_pk` int NOT NULL,
  `for_user_pk` int NOT NULL,
  PRIMARY KEY (`reviews_list_pk`),
  KEY `reviews_list_user_user_pk_fk` (`from_user_pk`),
  KEY `reviews_list_user_user_pk_fk_2` (`for_user_pk`),
  CONSTRAINT `reviews_list_user_user_pk_fk` FOREIGN KEY (`from_user_pk`) REFERENCES `user` (`user_pk`),
  CONSTRAINT `reviews_list_user_user_pk_fk_2` FOREIGN KEY (`for_user_pk`) REFERENCES `user` (`user_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews_list`
--

LOCK TABLES `reviews_list` WRITE;
/*!40000 ALTER TABLE `reviews_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_contacts_list`
--

DROP TABLE IF EXISTS `session_contacts_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_contacts_list` (
  `session_contacts_list_pk` int NOT NULL AUTO_INCREMENT,
  `contact_methods_pk` int NOT NULL,
  `contact_value` text NOT NULL,
  `game_session_pk` int NOT NULL,
  PRIMARY KEY (`session_contacts_list_pk`),
  KEY `session_contacts_list_contact_methods_contact_methods_pk_fk` (`contact_methods_pk`),
  KEY `session_contacts_list_game_session_game_session_pk_fk` (`game_session_pk`),
  CONSTRAINT `session_contacts_list_contact_methods_contact_methods_pk_fk` FOREIGN KEY (`contact_methods_pk`) REFERENCES `contact_methods` (`contact_methods_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `session_contacts_list_game_session_game_session_pk_fk` FOREIGN KEY (`game_session_pk`) REFERENCES `game_session` (`game_session_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_contacts_list`
--

LOCK TABLES `session_contacts_list` WRITE;
/*!40000 ALTER TABLE `session_contacts_list` DISABLE KEYS */;
INSERT INTO `session_contacts_list` VALUES (33,16,'asdfasdf',18),(34,1,'фывафыва',59),(35,1,'sdfgsdfg',60),(38,1,'sadfsadf',63),(39,1,'sadfsadf',64),(40,1,'sadfsadf',65),(43,1,'sadfsadf',61),(45,15,'asdfasdf',20),(46,2,'ыфафыва',20),(47,1,'sadfsadf',62);
/*!40000 ALTER TABLE `session_contacts_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_tags_list`
--

DROP TABLE IF EXISTS `session_tags_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_tags_list` (
  `session_tags_list_pk` int NOT NULL AUTO_INCREMENT,
  `game_session_pk` int NOT NULL,
  `game_style_tag_pk` int NOT NULL,
  PRIMARY KEY (`session_tags_list_pk`),
  KEY `session_tags_list_game_session_game_session_pk_fk` (`game_session_pk`),
  KEY `session_tags_list_game_style_tag_game_style_tag_pk_fk` (`game_style_tag_pk`),
  CONSTRAINT `session_tags_list_game_session_game_session_pk_fk` FOREIGN KEY (`game_session_pk`) REFERENCES `game_session` (`game_session_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `session_tags_list_game_style_tag_game_style_tag_pk_fk` FOREIGN KEY (`game_style_tag_pk`) REFERENCES `game_style_tag` (`game_style_tag_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_tags_list`
--

LOCK TABLES `session_tags_list` WRITE;
/*!40000 ALTER TABLE `session_tags_list` DISABLE KEYS */;
INSERT INTO `session_tags_list` VALUES (61,24,1),(62,24,12),(63,24,13),(64,24,17),(997,18,12),(998,18,13),(999,18,14),(1000,59,1),(1001,59,2),(1002,59,3),(1003,59,4),(1004,59,5),(1041,63,1),(1042,63,2),(1043,63,9),(1044,63,10),(1045,63,11),(1046,63,17),(1047,63,18),(1048,63,19),(1049,63,20),(1050,63,27),(1051,63,28),(1052,63,29),(1053,63,30),(1054,63,31),(1055,63,32),(1056,63,33),(1057,63,34),(1058,63,35),(1059,64,1),(1060,64,2),(1061,64,9),(1062,64,10),(1063,64,11),(1064,64,17),(1065,64,18),(1066,64,19),(1067,64,20),(1068,64,27),(1069,64,28),(1070,64,29),(1071,64,30),(1072,64,31),(1073,64,32),(1074,64,33),(1075,64,34),(1076,64,35),(1077,65,1),(1078,65,2),(1079,65,9),(1080,65,10),(1081,65,11),(1082,65,17),(1083,65,18),(1084,65,19),(1085,65,20),(1086,65,27),(1087,65,28),(1088,65,29),(1089,65,30),(1090,65,31),(1091,65,32),(1092,65,33),(1093,65,34),(1094,65,35),(1103,61,1),(1104,61,2),(1105,61,9),(1106,61,10),(1107,61,11),(1108,61,17),(1109,61,18),(1110,61,19),(1111,61,20),(1112,61,27),(1113,61,28),(1114,61,29),(1115,61,30),(1116,61,31),(1117,61,32),(1118,61,33),(1119,61,34),(1120,61,35),(1125,20,1),(1126,20,2),(1127,20,3),(1128,20,4),(1129,62,1),(1130,62,2),(1131,62,9),(1132,62,10),(1133,62,11),(1134,62,17),(1135,62,18),(1136,62,19),(1137,62,20),(1138,62,27),(1139,62,28),(1140,62,29),(1141,62,30),(1142,62,31),(1143,62,32),(1144,62,33),(1145,62,34),(1146,62,35);
/*!40000 ALTER TABLE `session_tags_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`),
  CONSTRAINT `sessions_user_user_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('fBH21go2v9Q4yIxOcSHG7SmbPzfTLuGXfUh3ynTW',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidFVCTWFyZzVnbldlQUZMQmJCTmRsT2dOY01VS0lES1p3OHBqVGRiYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1749198409),('lazcNKVwQN2xuv9GD8GJZa0UHKAW3ItSRZzhBXEN',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmpsc1pKamYxeGd3Z0xJdkxNZ01EdFRxMVJzMkNmYTNMRkxrT1d3QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCI7fX0=',1749149779),('LZGpOLBFxC8BWy1xHNZtuDzaL00nnf1HDVKsrtcw',23,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFR4UGFObFJYcDRpTzdPNkJsQmNYclpMTlRzelVzYVhveU5hTDl6eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIzO30=',1749156166);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_news`
--

DROP TABLE IF EXISTS `site_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_news` (
  `site_news_pk` int NOT NULL AUTO_INCREMENT,
  `news_text` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`site_news_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_news`
--

LOCK TABLES `site_news` WRITE;
/*!40000 ALTER TABLE `site_news` DISABLE KEYS */;
INSERT INTO `site_news` VALUES (1,'Открытие сайта','2025-05-13 02:46:14'),(2,'Новость 1','2025-05-13 02:46:27'),(3,'Новость 2','2025-05-13 02:58:28'),(4,'Новость 3','2025-05-13 02:58:41'),(5,'АААААААААААААААААААА ААААААААААААААААААААААААА ААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААА ААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААА АААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААА АААААААААААААААААААААААА АААААААААА','2025-05-15 21:47:56'),(6,'Новость 4','2025-05-15 22:49:58'),(7,'Новость 5','2025-05-15 22:50:05');
/*!40000 ALTER TABLE `site_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_pk` int NOT NULL AUTO_INCREMENT,
  `user_name` char(50) DEFAULT NULL,
  `user_gender` tinyint(1) DEFAULT NULL COMMENT '0 - female, 1 - male',
  `avatar` char(255) DEFAULT 'avatars/default_avatar.png',
  `birthdate` date DEFAULT NULL,
  `show_birthday_others` tinyint(1) DEFAULT '0',
  `show_contacts_others` tinyint(1) DEFAULT '0',
  `rating` float DEFAULT '0',
  `game_role` tinyint NOT NULL DEFAULT '0' COMMENT '0 - player, 1 - master, 2 - any',
  `city_pk` int DEFAULT NULL,
  `user_role_pk` int DEFAULT '1',
  `total_game_experience` int DEFAULT NULL,
  PRIMARY KEY (`user_pk`),
  KEY `user_city_city_pk_fk` (`city_pk`),
  KEY `user_user_role_user_role_pk_fk` (`user_role_pk`),
  KEY `user_game_experience_game_experience_pk_fk` (`total_game_experience`),
  CONSTRAINT `user_city_city_pk_fk` FOREIGN KEY (`city_pk`) REFERENCES `city` (`city_pk`),
  CONSTRAINT `user_game_experience_game_experience_pk_fk` FOREIGN KEY (`total_game_experience`) REFERENCES `game_experience` (`game_experience_pk`),
  CONSTRAINT `user_user_role_user_role_pk_fk` FOREIGN KEY (`user_role_pk`) REFERENCES `user_role` (`user_role_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (23,'Lamedy',1,'avatars/vMnaBaOCLHD4j4GROGcDPOhpbSFGLPkf6UhlaE9w.png','2025-06-17',0,0,4,0,2,NULL,NULL),(29,'Юзер',0,'avatars/default_avatar.png','2002-03-12',0,0,0,0,NULL,1,NULL),(32,'Kajos',1,'avatars/yRkIawjp8IL0RmpDpKZS4DhNBSEC0I2dSwgJyYW6.png',NULL,0,0,0,0,NULL,1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_authorization`
--

DROP TABLE IF EXISTS `user_authorization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_authorization` (
  `user_pk` int NOT NULL,
  `login` char(50) NOT NULL,
  `email` char(255) NOT NULL,
  `password` longtext NOT NULL,
  PRIMARY KEY (`user_pk`),
  KEY `user_authorization_login_index` (`login`),
  CONSTRAINT `user_authorization_user_user_pk_fk` FOREIGN KEY (`user_pk`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_authorization`
--

LOCK TABLES `user_authorization` WRITE;
/*!40000 ALTER TABLE `user_authorization` DISABLE KEYS */;
INSERT INTO `user_authorization` VALUES (23,'testUser','email@mail.ru','$2y$12$AAOfZj/Njf04g2jIQx8ng.6TIjekVaCXWgST81E4/Cm3F6jC/wdiG'),(29,'login','some@mail.ru','$2y$12$DJ0jv7/7cezFrtPK1X3kK.zKuOzkIpAyjlFqBd27/ZupEqsCMgVvy'),(32,'Kajos','kajos@yandex.ru','$2y$12$Hu2qCjklepeopaJpTQrXz.93J05kqJ//mIOPaY6RBKK5CaHRGhGWy');
/*!40000 ALTER TABLE `user_authorization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_contacts_list`
--

DROP TABLE IF EXISTS `user_contacts_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_contacts_list` (
  `user_contacts_list_pk` int NOT NULL AUTO_INCREMENT,
  `user_pk` int NOT NULL,
  `contact_methods_pk` int NOT NULL,
  `contact_value` text NOT NULL,
  PRIMARY KEY (`user_contacts_list_pk`),
  KEY `user_contacts_list_contact_methods_contact_methods_pk_fk` (`contact_methods_pk`),
  KEY `user_contacts_list_user_user_pk_fk` (`user_pk`),
  CONSTRAINT `user_contacts_list_contact_methods_contact_methods_pk_fk` FOREIGN KEY (`contact_methods_pk`) REFERENCES `contact_methods` (`contact_methods_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_contacts_list_user_user_pk_fk` FOREIGN KEY (`user_pk`) REFERENCES `user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_contacts_list`
--

LOCK TABLES `user_contacts_list` WRITE;
/*!40000 ALTER TABLE `user_contacts_list` DISABLE KEYS */;
INSERT INTO `user_contacts_list` VALUES (61,23,1,'sadfsadf');
/*!40000 ALTER TABLE `user_contacts_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role` (
  `user_role_pk` int NOT NULL AUTO_INCREMENT,
  `user_role` char(100) NOT NULL,
  PRIMARY KEY (`user_role_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'Пользователь'),(2,'Администратор');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tag_list`
--

DROP TABLE IF EXISTS `user_tag_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_tag_list` (
  `user_tag_list_pk` int NOT NULL AUTO_INCREMENT,
  `user_pk` int NOT NULL,
  `user_game_style_tag_pk` int NOT NULL,
  PRIMARY KEY (`user_tag_list_pk`),
  KEY `user_tag_list_game_style_tag_game_style_tag_pk_fk` (`user_game_style_tag_pk`),
  KEY `user_tag_list_user_user_pk_fk` (`user_pk`),
  CONSTRAINT `user_tag_list_game_style_tag_game_style_tag_pk_fk` FOREIGN KEY (`user_game_style_tag_pk`) REFERENCES `game_style_tag` (`game_style_tag_pk`),
  CONSTRAINT `user_tag_list_user_user_pk_fk` FOREIGN KEY (`user_pk`) REFERENCES `user` (`user_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=933 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tag_list`
--

LOCK TABLES `user_tag_list` WRITE;
/*!40000 ALTER TABLE `user_tag_list` DISABLE KEYS */;
INSERT INTO `user_tag_list` VALUES (915,23,1),(916,23,2),(917,23,9),(918,23,10),(919,23,11),(920,23,17),(921,23,18),(922,23,19),(923,23,20),(924,23,27),(925,23,28),(926,23,29),(927,23,30),(928,23,31),(929,23,32),(930,23,33),(931,23,34),(932,23,35);
/*!40000 ALTER TABLE `user_tag_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-06  8:42:38

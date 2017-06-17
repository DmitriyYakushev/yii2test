-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: cmo-template
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT '1',
  `category_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_categories`
--

LOCK TABLES `event_categories` WRITE;
/*!40000 ALTER TABLE `event_categories` DISABLE KEYS */;
INSERT INTO `event_categories` VALUES (5,'Digital Advertising','https://s-media-cache-ak0.pinimg.com/564x/18/1d/ee/181deed64b2e6a4bd64dcae8fcab362d.jpg',1,0),(6,'2nd category','https://s-media-cache-ak0.pinimg.com/564x/18/1d/ee/181deed64b2e6a4bd64dcae8fcab362d.jpg',1,0);
/*!40000 ALTER TABLE `event_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_start` int(11) NOT NULL,
  `event_end` int(11) NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `event_country` varchar(2) NOT NULL,
  `event_state` varchar(100) NOT NULL,
  `event_city` varchar(255) NOT NULL,
  `event_zip` varchar(10) NOT NULL,
  `event_place` varchar(255) NOT NULL,
  `event_address` varchar(255) NOT NULL,
  `event_help_link` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_status` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `event_categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'1st event','event description\r\n2\'nd line description',1590197017,1590198017,'https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F16515595%2F109033103239%2F1%2Foriginal.jpg?h=230&w=460&rect=0%2C0%2C2880%2C1440&s=096b002b6fda57445737a0488e8c8724','us','California','Cupertino','95125','super building','123 Stevens Creek Boulevard ','mailto:sd@pinxterapp.com',5,1),(2,'title 2','desc 2',1490203421,1499203421,'https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F16515595%2F109033103239%2F1%2Foriginal.jpg?h=230&w=460&rect=0%2C0%2C2880%2C1440&s=096b002b6fda57445737a0488e8c8724','us','Virginia','Alexandria','22314','Pinxter Office','901 N Pitt St','https://google.com',6,1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1491213160),('m170412_135057_ChatsModule_1_create_chats_table',1492005065),('m170412_135057_ChatsModule_2_create_messages_table',1492005066),('m170412_135057_ChatsModule_3_create_chats_users_info_table',1492005067),('m170412_135057_ChatsModule_4_create_rel_messages_attachments_table',1492005068);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poll_date` int(11) NOT NULL,
  `poll_status` tinyint(4) NOT NULL DEFAULT '1',
  `poll_text` varchar(2048) NOT NULL,
  PRIMARY KEY (`poll_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls`
--

LOCK TABLES `polls` WRITE;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
INSERT INTO `polls` VALUES (1,3,1491223825,1,'test pool2'),(2,3,1491223825,2,'test pool1'),(3,3,1491223825,1,'test poll with 2 ans');
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls_answers`
--

DROP TABLE IF EXISTS `polls_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls_answers` (
  `poll_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `poll_answer` text NOT NULL,
  `poll_answer_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`poll_answer_id`),
  KEY `poll_id` (`poll_id`),
  CONSTRAINT `polls_answers_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls_answers`
--

LOCK TABLES `polls_answers` WRITE;
/*!40000 ALTER TABLE `polls_answers` DISABLE KEYS */;
INSERT INTO `polls_answers` VALUES (1,1,'test ans1 ',4),(4,1,'test ans2',9),(5,1,'test ans 3',2),(6,3,'ans 1',8),(7,3,'ans 2',5);
/*!40000 ALTER TABLE `polls_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls_history`
--

DROP TABLE IF EXISTS `polls_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls_history` (
  `polls_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_answer_id` int(11) NOT NULL,
  PRIMARY KEY (`polls_history_id`),
  UNIQUE KEY `pollvote` (`user_id`,`poll_id`),
  KEY `poll_id` (`poll_id`),
  KEY `poll_answer_id` (`poll_answer_id`),
  CONSTRAINT `polls_history_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`),
  CONSTRAINT `polls_history_ibfk_2` FOREIGN KEY (`poll_answer_id`) REFERENCES `polls_answers` (`poll_answer_id`),
  CONSTRAINT `polls_history_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls_history`
--

LOCK TABLES `polls_history` WRITE;
/*!40000 ALTER TABLE `polls_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `polls_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `setting_name` varchar(50) NOT NULL,
  `setting_value` text NOT NULL,
  UNIQUE KEY `setting_name` (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('default_logo','https://pinxterupload.pinxterapp.com/tiesto/1.png'),('forum_max_count_file','5'),('forum_max_size_bytes_file','5000000'),('gms_places_ios_key','AIzaSyDqpldCydqmvz-oQ_13P7-qZgEM9n3m2xk'),('home_country','US'),('near_me_span','50'),('privacy_policy','https://google.com'),('settings','value'),('terms_of_use','https://google.com'),('thumbnail_size','100');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `storage_item_id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `file_real_name` varchar(100) NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT '2' COMMENT '0 - deleted/unused, 2 - created, 1 - uploaded/ok',
  `time` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `metadata` text,
  PRIMARY KEY (`upload_id`),
  UNIQUE KEY `filename` (`filename`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_login` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_logo` varchar(1024) DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) NOT NULL,
  `user_state` varchar(10) DEFAULT NULL,
  `user_city` varchar(50) DEFAULT NULL,
  `user_company` varchar(100) DEFAULT NULL,
  `user_description` text,
  `user_occupation` varchar(255) DEFAULT NULL,
  `user_industry` varchar(255) DEFAULT NULL,
  `user_lat` double NOT NULL DEFAULT '0',
  `user_long` double NOT NULL DEFAULT '0',
  `user_hide_location` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login` (`user_login`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,2,'dar@test.com','123qwe','Test','Account',NULL,1487804558,1493186635,'CA','San Francisco','Pinxter','Agile projects, especially Scrum ones, use a product backlog, which is a prioritized list of the functionality to be developed in a product or service. Although product backlog items can be whatever the team desires, user stories have emerged as the best and most popular form of product backlog items. While a product backlog can be thought of as a replacement for the requirements document of a traditional project, it is important to remember that the written part of an agile user story (“As a user, I want …”) is incomplete until the discussions about that story occur. It’s often best to think of the written part as a pointer to the real requirement. User stories could point to a diagram depicting a workflow, a spreadsheet showing how to perform a calculation, or any other artifact the product owner or team desires.','Developer','industry',49.839684,24.029716,0),(5,1,'dar2@test.com','darpassword','darivush2','AZAZA',NULL,1487809008,1487809008,'','','','','','',0,0,0),(6,1,'t3m1k','fuckoff','Artyom','Peshkov','https://pinxterupload.pinxterapp.com/tiesto/96/ee/2d/58e50a12dee96.jpeg',1487839351,1491515301,'VA','Alexandria','Pinxter','One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me?\" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.','iOS Developer','Software Development',45.068326859695,39.025078018562,0),(7,1,'dar1111@test.com','darpassword11','fname','lname',NULL,1488417894,1488417894,'','','','','','',0,0,0),(8,1,'test@test.com','123qwe','fname','lname',NULL,1490721431,1490721431,'','','','user desc','occupation','',0,0,0),(9,1,'tessdst@teust.com','123qwe','fname','lname',NULL,1491419981,1491419981,'','','','user desc','occupation','',0,0,0),(11,1,'dsadsasda','dsasdsa','Dsasaddsa','Adssadsad',NULL,1491481380,1491481380,'','','','Dsadas','Adsads','',0,0,0),(12,1,'saddssad','sadsadsad','Saasasa','Asasas',NULL,1491481828,1491481828,'','','Saasasas','Dasasddsadsasad','Asasasas','',0,0,0),(13,1,'rtyui','cxzb','Adsdasasdasdadsasdasda','423324234234234234234234','https://pinxterupload.pinxterapp.com/tiesto/d3/09/96/58e63569609d3.jpeg',1491481948,1491481987,'','','3234fd wfdassa','SaFF add add Fa','Dsad dsadasd asdasd sad','3123123123123',0,0,0),(14,1,'sdadasdsaasd','sadasddsaasdasdasdads','Adsdsasaddas','Assadasdads','https://pinxterupload.pinxterapp.com/tiesto/dc/9b/20/58e656d209bdc.jpeg',1491490493,1491490517,'','','Sdaasdadsadssaddsasad','Sdaasdasdasdasdasd','Asdadsadsads','Asdasdads',0,0,0),(15,1,'test123123@test.com','123qwe','fname','lname',NULL,1491493737,1491493737,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(16,1,'test1231231@test.com','123qwe','fname','lname',NULL,1491494919,1491494919,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(20,1,'qwerty@mail.ru','12345','Mary','Petruk','https://pinxterupload.pinxterapp.com/tiesto/b4/60/1a/58ef5081a60b4.jpeg',1492078705,1493216204,'CA','Los Angeles','','','','',45.067760924314,39.025255215264,0),(21,1,'toyou@mail.ru','qwerty','Tom','Sawyer','https://pinxterupload.pinxterapp.com/tiesto/8f/87/6b/58f49876b878f.jpeg',1492424789,1493215764,NULL,NULL,'Z Games','BLA bla bla fudge j jxdkxhcjj jcfsjkf \nCjuxcjjcn. M k k j kicdiissk h njcsysvxl isis Hanson jksoak klalajallalalalala. Nljdj. D.C. Lon kvkvkbkkllgdshl hjkll hjkkkvbhhhjn','Producer','Games',45.068044529122,39.025399841609,0),(23,1,'jdjdjd@gmail.com','jdjdjd','Jdjdjd','Jdjdj','https://pinxterupload.pinxterapp.com/tiesto/23/27/db/58f65aedb2723.jpeg',1492540132,1495129940,NULL,NULL,'','','','',38.777997856996,-77.253971099925,0),(25,1,'dar@test.ru','password','First Name','Last Name',NULL,1493288225,1493288225,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(26,1,'dar@test.er','password','12','12',NULL,1493288334,1493288334,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(27,1,'dar@test.qq','password','1','1',NULL,1493288694,1493288694,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(28,1,'dar@test.ua','334400ddgg','f n','l n',NULL,1493356442,1493356442,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(29,1,'darq@test.uu','password','tt','iu',NULL,1493709052,1493709052,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(30,1,'dar@test.ruk','password','test','last',NULL,1493717961,1493721752,NULL,NULL,NULL,NULL,NULL,NULL,47.531532,42.24405,0),(31,1,'dar@test.sdf','password','asdf','asdf',NULL,1493913114,1493913114,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0),(32,1,'dar@test.ta','12345','First Name','Last Name',NULL,1494393548,1494393548,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_follow`
--

DROP TABLE IF EXISTS `users_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_follow` (
  `users_follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `follow_status` int(11) NOT NULL DEFAULT '0',
  `follow_note` varchar(4048) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  PRIMARY KEY (`users_follow_id`),
  KEY `user_id` (`user_id`),
  KEY `follow_id` (`follow_id`),
  CONSTRAINT `users_follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_follow_ibfk_2` FOREIGN KEY (`follow_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_follow`
--

LOCK TABLES `users_follow` WRITE;
/*!40000 ALTER TABLE `users_follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_restore_token`
--

DROP TABLE IF EXISTS `users_restore_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_restore_token` (
  `user_id` int(11) NOT NULL,
  `restore_token` varchar(255) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_users_restore_token_users1_idx` (`user_id`),
  CONSTRAINT `fk_users_restore_token_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_restore_token`
--

LOCK TABLES `users_restore_token` WRITE;
/*!40000 ALTER TABLE `users_restore_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_restore_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_tokens`
--

DROP TABLE IF EXISTS `users_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tokens` (
  `users_tokens_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `time` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  PRIMARY KEY (`users_tokens_id`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `user_id` (`user_id`,`device_id`),
  CONSTRAINT `fk_users_tokens_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tokens`
--

LOCK TABLES `users_tokens` WRITE;
/*!40000 ALTER TABLE `users_tokens` DISABLE KEYS */;
INSERT INTO `users_tokens` VALUES (17,3,'c9795269e553602757ceb208c985817f07b9538250a6f5b401862bfe211a6c2ac7ebcb42e91bbb3598be965549a82f3f71c04b72244378f18de244c1787461d9',1490193667,'test-for-login'),(19,3,'eca58dac483d85e8e4b9ed51657ef5526cd752fd94a03a75f8d921e8a20922d91d83201b13b99c4edae520e23fd718c370222fd66948241ad2ced95f94d50ce9',1490890433,'test-device-id'),(24,3,'4ab7f954127831f5ec9158da9e1001fa285ade22af4df1ec7e3fd7fdc795a6642d8c525c57268b6847c654d8d6cdfd3b7a080d5924f0938d8e13f81ea19b0b95',1492785930,'test-device-id-for-login');
/*!40000 ALTER TABLE `users_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-14 17:38:53

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`slug`,`parent_id`,`visible`) values (1,'Ăn vặt','an-vat',NULL,1),(2,'Giải khát','giai-khat',NULL,1);

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `image` */

insert  into `image`(`id`,`name`,`extension`,`size`,`created_at`,`created_by`) values (1,'globe-35584_960_720','png','134788',1502272538,1),(2,'sale-now-on','jpg','28204',1502272655,1),(3,'store-keeper-md','png','43612',1502273209,1),(4,'store-keeper-md','png','43612',1502273251,1),(5,'store-keeper-md','png','43612',1502273281,1),(6,'3d-world-map-png-2','png','124217',1502273413,1),(7,'Desert','jpg','845941',1502703196,1),(8,'Chrysanthemum','jpg','879394',1502703198,1),(9,'Hydrangeas','jpg','595284',1502703200,1),(10,'Jellyfish','jpg','775702',1502703202,1),(11,'Koala','jpg','780831',1502703203,1),(12,'Lighthouse','jpg','561276',1502703204,1),(13,'Penguins','jpg','777835',1502703205,1),(14,'Tulips','jpg','620888',1502703207,1),(15,'360px-Vietnam_map','png','32273',1502703226,1),(16,'3d-world-map-png-2','png','124217',1502703227,1),(17,'13055460_1029079893846288_636276461657517137_n','jpg','48055',1502703228,1),(18,'Map_of_Vietnam','png','9257',1502703228,1),(19,'sale-now-on','jpg','28204',1502703229,1);

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `location` */

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_vietnamese_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1502210008),('m140506_102106_rbac_init',1502210016);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `post` */

insert  into `post`(`id`,`title`,`content`,`category_id`,`image_id`,`status`,`created_by`,`created_at`,`updated_at`) values (1,'Bún đậu mắm tôm','<p>B&uacute;n đậu mắm t&ocirc;m nằm rải r&aacute;c khắp nơi tr&ecirc;n thế giới</p>\r\n',1,NULL,1,1,1502767590,1502767590),(2,'Bún đậu mắm tôm','<p>B&uacute;n đậu mắm t&ocirc;m gần s&acirc;n bay</p>\r\n',1,8,1,1,1502771544,1502771544);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT '0',
  `year_of_birth` int(11) DEFAULT '0',
  `gender` tinyint(2) DEFAULT '0',
  `avatar` int(11) DEFAULT '0',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`phone`,`address`,`year_of_birth`,`gender`,`avatar`,`username`,`password_hash`,`password_reset_token`,`email`,`auth_key`,`status`,`created_at`,`updated_at`,`password`) values (1,'Phạm Ngọc Sơn','098803325','159 Lò Siêu, Quận 11, HCM',1988,0,17,'admin','$2y$13$OF/c1UT.RZjiZHQJJsOi4eaud5UeXKoHeyO1N8GfJV3LveqtbqAZ6','','admin@gmail.com','V_gop7szQaTclrDlTqC7tfLxWrToI9wn',10,1502209348,1502703276,''),(2,'ngoc','0','0',0,0,0,'ngoc','$2y$13$Smbp5kKYCcSuNm4rAvl5i.33ss9Jp9w4UBxkf74dz.CIX8x2hz1eW','','vangoc93@gmail.com','DtJu_Epz4gwbQy8J6Xm8zC7jyrE6qmlL',10,1502212210,1502212210,''),(3,'tuan','0','0',0,0,0,'tuan','$2y$13$U.ygaNTSPjWRCTbIPHo23uP7M5tCjiDfpxHTSoQTrTmUJnXSJlFOK','','tuan@gmail.com','oJGTKfwYSZ1LcFD7uj3YKK9jGy8apPJF',10,1502212276,1502212276,'');

/*Table structure for table `user_auth` */

DROP TABLE IF EXISTS `user_auth`;

CREATE TABLE `user_auth` (
  `user_id` int(11) NOT NULL,
  `client` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `client_user_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_auth` */

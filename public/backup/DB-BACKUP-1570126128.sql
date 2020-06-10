DROP TABLE IF EXISTS agents;

CREATE TABLE `agents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO agents VALUES('1','Bob Dole','bob@dole.com','418-123-1234','','','1565876515face2.jpg','','','','2019-08-15 13:41:55','2019-08-15 13:41:55');
INSERT INTO agents VALUES('2','Frank Summer','frank.summer@gmail.com','418-654-6548','128 road, Montreal, QC','','1566323429face5.jpg','','','','2019-08-20 17:50:29','2019-08-20 17:50:29');



DROP TABLE IF EXISTS benefits;

CREATE TABLE `benefits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO benefits VALUES('1','Parking interieur','2019-08-15 13:42:56','2019-08-15 13:42:56');
INSERT INTO benefits VALUES('2','Piscine','2019-08-20 17:49:21','2019-08-20 17:49:21');
INSERT INTO benefits VALUES('3','Foyer','2019-08-20 17:49:25','2019-08-20 17:49:25');



DROP TABLE IF EXISTS blog_categories;

CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog_categories VALUES('1','test','test','2019-08-19 20:07:37','2019-08-19 20:07:37');



DROP TABLE IF EXISTS blog_posts;

CREATE TABLE `blog_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `cat_id` int(11) NOT NULL,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog_posts VALUES('1','test','test','<p>test</p>','1','post','published','1566323503hero_bg_2.jpg','1','2019-08-19 20:07:47','2019-08-20 17:51:43');



DROP TABLE IF EXISTS faqs;

CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS locations;

CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO locations VALUES('1','Quebec, QC','2019-08-15 13:40:27','2019-08-15 13:40:27');
INSERT INTO locations VALUES('2','Montreal, QC','2019-08-20 17:49:03','2019-08-20 17:49:03');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2018_06_01_080940_create_settings_table','1');
INSERT INTO migrations VALUES('4','2019_05_15_083344_create_benefits_table','1');
INSERT INTO migrations VALUES('5','2019_05_15_083356_create_locations_table','1');
INSERT INTO migrations VALUES('6','2019_05_15_083414_create_property_types_table','1');
INSERT INTO migrations VALUES('7','2019_05_15_090116_create_agents_table','1');
INSERT INTO migrations VALUES('8','2019_05_15_105433_create_blog_categories_table','1');
INSERT INTO migrations VALUES('9','2019_05_15_105518_create_blog_posts_table','1');
INSERT INTO migrations VALUES('10','2019_05_15_110041_create_faqs_table','1');
INSERT INTO migrations VALUES('11','2019_05_16_073231_create_property_table','1');
INSERT INTO migrations VALUES('12','2019_05_16_074136_create_property_gallery_table','1');
INSERT INTO migrations VALUES('13','2019_05_16_074147_create_property_benefits_table','1');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS property;

CREATE TABLE `property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `year_built` year(4) NOT NULL,
  `bed` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bath` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sq_ft` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `price_per_sq_ft` double(10,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `offer_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `property_no` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO property VALUES('1','Grande Maison','1','2018','3','1','2100','120000','150','<p>test</p>','Active','1','1','Sale','Quebec, qc','0','0','1565876645hero_bg_2.jpg','1','2019-08-15 13:44:05','2019-08-15 13:44:05','');
INSERT INTO property VALUES('2','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('3','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('4','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('5','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('6','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('7','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');
INSERT INTO property VALUES('8','petite maison','1','2019','4','2','1200','169000','5','<p>test</p>','Active','1','1','Sale','quebec, qc','0','0','1566234658Screenshot from 2019-08-09 16-52-56.png','1','2019-08-19 17:10:58','2019-08-19 19:56:24','35252452');



DROP TABLE IF EXISTS property_benefits;

CREATE TABLE `property_benefits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `benefit_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO property_benefits VALUES('1','1','1','2019-08-15 13:44:05','2019-08-15 13:44:05');
INSERT INTO property_benefits VALUES('4','2','1','2019-08-19 19:56:24','2019-08-19 19:56:24');



DROP TABLE IF EXISTS property_gallery;

CREATE TABLE `property_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS property_types;

CREATE TABLE `property_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO property_types VALUES('1','Maison','2019-08-15 13:39:01','2019-08-15 13:39:01');
INSERT INTO property_types VALUES('2','Condo','2019-08-15 13:39:08','2019-08-15 13:39:08');



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','Royal Lepage','2019-08-09 15:21:10','2019-08-20 18:23:30');
INSERT INTO settings VALUES('2','site_title','Royal Lepage Excellence','2019-08-09 15:21:10','2019-08-20 18:23:30');
INSERT INTO settings VALUES('3','phone','418-476-1068','2019-08-09 15:21:10','2019-08-09 15:21:10');
INSERT INTO settings VALUES('4','email','info@exio.solutions','2019-08-09 15:21:10','2019-08-09 15:21:10');
INSERT INTO settings VALUES('5','currency_symbol','$','2019-08-09 15:21:10','2019-08-20 18:23:30');
INSERT INTO settings VALUES('6','timezone','America/New_York','2019-08-09 15:21:10','2019-08-20 18:23:30');
INSERT INTO settings VALUES('7','logo','logo.png','2019-08-09 15:24:28','2019-08-09 15:24:28');
INSERT INTO settings VALUES('8','language','fr','2019-08-20 18:03:28','2019-08-20 18:23:30');
INSERT INTO settings VALUES('9','backend_direction','ltr','2019-08-20 18:03:28','2019-08-20 18:23:30');
INSERT INTO settings VALUES('10','google_map_api_key','AIzaSyABHYIw4BojMCuC_YhEeIKE2QQNJAhzrqU ','2019-08-20 18:04:04','2019-08-20 18:23:30');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Maxime Labelle','info@exio.solutions','$2y$10$mR8jeuuTY.QQ0.6Hz2r8r.82TuKYziBd41yFca85JTS5RIPDJHV0a','admin','','1','9JakAydr3xlMGOQLoK4UVHENsaUMdQWl14dfM6lwkgxNCXAOo12tRDogdHjz','2019-08-09 15:20:28','2019-08-09 15:20:28');




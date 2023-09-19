/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - patroli
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `location_floor` varchar(255) NOT NULL DEFAULT '0',
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `location_information` text NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `location` */

insert  into `location`(`location_id`,`location_name`,`location_floor`,`latitude`,`longitude`,`location_information`,`data_state`,`created_at`,`updated_at`) values 
(1,'Mall Century','2','-7.598425650539845','110.81608712697387','Mall Century adalah mall besar',0,'2023-07-06 03:29:46','2023-07-06 03:29:46'),
(2,'Lippo Mall','1','-7.599607547967127','110.81652329659269','Lippo Mall adalah Mall yang berada di Jogja',0,'2023-07-06 03:30:18','2023-07-06 03:30:18'),
(3,'Mall Luwes','1','-7.598576585677164','110.8178318054439','Mall Luwes ada di Palur',0,'2023-07-06 03:30:18','2023-07-06 03:30:54'),
(4,'Parkiran Depan','1','-7.599207873032152','110.818177922743','Depan',0,'2023-07-17 17:52:09','2023-07-17 17:55:51'),
(5,'McD','1','-7.598423569943501','110.81563250668582','Mekdi',0,'2023-07-17 17:54:00','2023-07-17 17:54:00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(27,'2014_10_12_000000_create_users_table',1),
(28,'2014_10_12_100000_create_password_resets_table',1),
(29,'2019_08_19_000000_create_failed_jobs_table',1),
(30,'2019_12_14_000001_create_personal_access_tokens_table',1),
(31,'2023_07_03_073758_create_personil_table',1),
(32,'2023_07_03_075233_create_location_table',1),
(33,'2023_07_03_081627_create_patrol_schedule_table',1),
(34,'2023_07_03_083548_create_patrol_task_table',1),
(35,'2023_07_03_084653_create_personil_scheduling_table',1),
(36,'2023_07_10_145018_add_personil_id_to_system_user',2),
(38,'2023_07_11_113035_create_presensi_table',3),
(39,'2023_07_15_114238_create_patrol_table',4),
(40,'2023_07_15_115229_drop_patrol_schedule_id_from_patrol_task',5),
(41,'2023_07_15_115631_add_patrol_id_to_patrol_task',6),
(42,'2023_07_15_115812_add_patrol_id_to_patrol_schedule',6);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `patrol` */

DROP TABLE IF EXISTS `patrol`;

CREATE TABLE `patrol` (
  `patrol_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patrol_name` varchar(255) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`patrol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patrol` */

insert  into `patrol`(`patrol_id`,`patrol_name`,`data_state`,`created_at`,`updated_at`) values 
(1,'Jadwal Pagi',0,'2023-07-15 13:25:24','2023-07-20 11:13:44'),
(2,'Jadwal Siang',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(3,'Jadwal Malam',0,'2023-07-24 13:53:49','2023-07-24 14:00:36');

/*Table structure for table `patrol_schedule` */

DROP TABLE IF EXISTS `patrol_schedule`;

CREATE TABLE `patrol_schedule` (
  `patrol_schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patrol_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `patrol_start_time` time NOT NULL,
  `patrol_end_time` time NOT NULL,
  `patrol_information` text NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`patrol_schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patrol_schedule` */

insert  into `patrol_schedule`(`patrol_schedule_id`,`patrol_id`,`location_id`,`patrol_start_time`,`patrol_end_time`,`patrol_information`,`data_state`,`created_at`,`updated_at`) values 
(1,1,4,'08:00:00','15:45:00','Membeli',0,'2023-07-15 13:25:24','2023-07-17 18:06:15'),
(2,1,2,'09:00:00','09:30:00','Mengecek',0,'2023-07-15 13:25:24','2023-07-17 14:33:40'),
(3,1,3,'09:30:00','15:00:00','Memberi',0,'2023-07-15 13:25:24','2023-07-17 14:59:16'),
(4,1,3,'10:00:00','16:00:00','Melakukan',0,'2023-07-17 14:56:05','2023-07-17 14:56:05'),
(5,1,4,'11:15:00','16:00:00','Memberikan',0,'2023-07-17 14:56:05','2023-07-17 17:54:45'),
(6,1,1,'11:45:00','17:30:00','Melakukan',0,'2023-07-17 14:59:16','2023-07-17 14:59:30'),
(7,2,5,'13:00:00','14:00:00','Melakukan',0,'2023-07-17 15:04:14','2023-07-17 18:06:29'),
(8,2,2,'14:00:00','15:00:00','Memberi',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(9,2,1,'15:00:00','16:00:00','Menari',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(10,2,2,'16:00:00','17:00:00','Memberi',0,'2023-07-17 15:12:37','2023-07-17 18:06:29'),
(11,1,3,'12:30:00','12:45:00','Memberikan',0,'2023-07-17 15:18:01','2023-07-17 18:06:15'),
(12,3,5,'07:52:00','15:00:00','jaga parkir',0,'2023-07-24 13:53:49','2023-07-24 13:53:49'),
(13,3,2,'13:55:00','01:54:00','jaga lobby',0,'2023-07-24 13:53:49','2023-07-24 13:53:49');

/*Table structure for table `patrol_task` */

DROP TABLE IF EXISTS `patrol_task`;

CREATE TABLE `patrol_task` (
  `patrol_task_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patrol_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`patrol_task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patrol_task` */

insert  into `patrol_task`(`patrol_task_id`,`patrol_id`,`task`,`data_state`,`created_at`,`updated_at`) values 
(1,1,'Memasak',0,'2023-07-15 13:25:24','2023-07-17 14:56:50'),
(2,1,'Cek Hydrant air',0,'2023-07-15 13:25:24','2023-07-15 13:43:39'),
(3,1,'Pantau AC',0,'2023-07-15 13:25:24','2023-07-17 14:59:16'),
(4,1,'Cek shower',0,'2023-07-17 14:56:05','2023-07-17 14:56:05'),
(5,1,'Pantau AC',0,'2023-07-17 14:56:05','2023-07-17 14:59:36'),
(6,1,'Cek Hydrant air',0,'2023-07-17 14:59:16','2023-07-17 14:59:38'),
(7,2,'Cek Hydrant air',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(8,2,'Cek shower',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(9,2,'Garpu',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(10,2,'Cek shower',0,'2023-07-17 15:12:37','2023-07-17 15:12:37'),
(11,3,'jaga parkiran mcd',0,'2023-07-24 13:53:49','2023-07-24 13:53:49'),
(12,3,'restock',0,'2023-07-24 13:53:49','2023-07-24 13:53:49');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `personil` */

DROP TABLE IF EXISTS `personil`;

CREATE TABLE `personil` (
  `personil_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ttl` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL COMMENT '1 = laki-laki 2 = perempuan',
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`personil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personil` */

insert  into `personil`(`personil_id`,`name`,`ttl`,`gender`,`phone_number`,`address`,`data_state`,`created_at`,`updated_at`) values 
(1,'Arya','JEBRES, 08-07-2023',2,'08124344343','JL ANTONIUS NO 159',0,'2023-07-08 04:30:34','2023-07-08 04:30:34'),
(2,'Hengky','GENTAN, 08-07-1998',1,'0812423432','JL SIMAKALA NO 123',0,'2023-07-10 14:43:50','2023-07-10 14:43:50'),
(3,'Memet','SOLO, 10-06-2002',2,'0892123122','JL ANTONIUS NO 1592',0,'2023-07-10 14:44:23','2023-07-10 14:44:23'),
(4,'Shey','SOLO, 06-06-2006',2,'0892123122','JL PERCETAKAN NEGARA BL D/232, DKI JAKARTA',0,'2023-07-10 14:58:07','2023-07-10 14:58:07'),
(5,'Vonny','SURABAYA, 16-10-2001',2,'081243443432','JL PERCETAKAN NEGARA BL D/534, DKI JAKARTA',0,'2023-07-10 15:00:12','2023-07-10 15:00:12'),
(6,'Makjel','MADURA, 05-05-1996',1,'0892123122','KOMPLEK BANDUNG TEKSTIL CENTRE BL D/1, JAWA BARAT',0,'2023-07-10 15:02:02','2023-07-10 15:02:02');

/*Table structure for table `personil_scheduling` */

DROP TABLE IF EXISTS `personil_scheduling`;

CREATE TABLE `personil_scheduling` (
  `personil_scheduling_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_id` int(11) NOT NULL,
  `patrol_id` int(11) NOT NULL,
  `patrol_day` text NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`personil_scheduling_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personil_scheduling` */

insert  into `personil_scheduling`(`personil_scheduling_id`,`personil_id`,`patrol_id`,`patrol_day`,`data_state`,`created_at`,`updated_at`) values 
(1,4,1,'[\"Senin\",\"Selasa\"]',0,'2023-07-08 05:08:46','2023-07-17 16:02:42'),
(2,5,1,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,NULL,'2023-07-17 15:56:04'),
(3,2,1,'[\"Selasa\",\"Jumat\",\"Sabtu\"]',0,NULL,NULL),
(4,1,1,'[\"Senin\",\"Selasa\"]',0,NULL,NULL),
(5,3,2,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,'2023-07-17 15:51:28','2023-07-24 14:45:23'),
(6,3,3,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,'2023-07-24 14:44:45','2023-07-24 14:48:55');

/*Table structure for table `presensi` */

DROP TABLE IF EXISTS `presensi`;

CREATE TABLE `presensi` (
  `presensi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_scheduling_id` int(11) NOT NULL,
  `personil_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `checked` text DEFAULT NULL COMMENT 'patrol_task_id',
  `information` text DEFAULT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`presensi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `presensi` */

insert  into `presensi`(`presensi_id`,`personil_scheduling_id`,`personil_id`,`date_time`,`checked`,`information`,`data_state`,`created_at`,`updated_at`) values 
(1,3,4,'2023-07-11 12:05:46','[\"2\",\"3\",\"8\"]','Aman',0,'2023-07-11 12:05:46','2023-07-11 12:05:46'),
(2,4,5,'2023-07-11 12:11:02','[\"14\"]',NULL,0,'2023-07-11 12:11:02','2023-07-11 12:11:02'),
(3,1,4,'2023-07-17 16:45:05','[\"1\",\"2\",\"3\",\"4\",\"5\"]','Don',0,'2023-07-17 16:45:05','2023-07-17 16:45:05');

/*Table structure for table `system_menu` */

DROP TABLE IF EXISTS `system_menu`;

CREATE TABLE `system_menu` (
  `id_menu` varchar(10) NOT NULL,
  `id` varchar(100) DEFAULT NULL,
  `type` enum('folder','file','function') DEFAULT NULL,
  `indent_level` int(1) DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `system_menu` */

insert  into `system_menu`(`id_menu`,`id`,`type`,`indent_level`,`text`,`image`,`last_update`) values 
('',NULL,NULL,NULL,NULL,NULL,'2023-04-06 15:06:22'),
('0','home','file',1,'Beranda',NULL,'2021-12-18 11:09:42'),
('1','#','folder',1,'System',NULL,'2021-12-18 10:37:18'),
('11','system-user','file',2,'User',NULL,'2022-11-12 10:07:04'),
('12','system-user-group','file',2,'User Group',NULL,'2022-11-12 10:07:08'),
('13','personil','file',2,'Personil',NULL,'2023-07-20 14:16:18'),
('2','#','folder',1,'Konfigurasi',NULL,'2022-11-11 15:48:50'),
('21','location','file',2,'Lokasi Patroli',NULL,'2023-07-20 14:03:56'),
('22','patrol-schedule','file',2,'Jadwal Patroli',NULL,'2023-07-20 14:04:46'),
('23','personil-scheduling','file',2,'Penjadwalan Personil',NULL,'2023-07-20 14:05:06'),
('24','presensi','file',2,'Presensi',NULL,'2023-07-20 14:08:53'),
('25','laporan-presensi','file',2,'Laporan Presensi',NULL,'2023-07-20 14:09:11');

/*Table structure for table `system_menu_mapping` */

DROP TABLE IF EXISTS `system_menu_mapping`;

CREATE TABLE `system_menu_mapping` (
  `menu_mapping_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_group_level` int(3) DEFAULT NULL,
  `id_menu` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`menu_mapping_id`),
  KEY `FK_system_menu_mapping` (`id_menu`) USING BTREE,
  CONSTRAINT `FK_system_menu_mapping_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `system_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `system_menu_mapping` */

insert  into `system_menu_mapping`(`menu_mapping_id`,`user_group_level`,`id_menu`,`created_at`,`updated_at`) values 
(138,3,'0','2022-11-12 02:43:58','2022-11-12 02:43:58'),
(191,4,'0','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(192,4,'0','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(193,4,'2','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(194,4,'21','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(195,4,'22','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(196,4,'23','2023-05-26 16:51:14','2023-05-26 16:51:14'),
(197,4,'24','2023-05-26 16:51:15','2023-05-26 16:51:15'),
(198,4,'25','2023-05-26 16:51:15','2023-05-26 16:51:15'),
(398,1,'0','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(399,1,'1','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(400,1,'11','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(401,1,'12','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(402,1,'13','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(403,1,'2','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(404,1,'21','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(405,1,'22','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(406,1,'23','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(407,1,'24','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(408,1,'25','2023-05-29 11:28:23','2023-05-29 11:28:23'),
(423,2,'0','2023-07-26 16:17:24','2023-07-26 16:17:24'),
(424,2,'2','2023-07-26 16:17:24','2023-07-26 16:17:24'),
(425,2,'23','2023-07-26 16:17:24','2023-07-26 16:17:24'),
(426,2,'24','2023-07-26 16:17:24','2023-07-26 16:17:24');

/*Table structure for table `system_user` */

DROP TABLE IF EXISTS `system_user`;

CREATE TABLE `system_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(3) DEFAULT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `seller_status` int(1) DEFAULT 0 COMMENT '0 = request, 1 = disetujui, 2 = ditolak',
  `user_status` int(1) DEFAULT 0 COMMENT '0 = aktif, 1 = diblokir',
  `full_name` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `phone_number` varchar(255) DEFAULT '',
  `branch_id` int(1) DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `blokir_id` int(10) DEFAULT NULL,
  `blokir_at` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT NULL,
  `data_state` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_system_user_user_group_id` (`user_group_id`),
  CONSTRAINT `fk_system_user_user_group_id` FOREIGN KEY (`user_group_id`) REFERENCES `system_user_group` (`user_group_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `system_user` */

insert  into `system_user`(`user_id`,`user_group_id`,`personil_id`,`seller_status`,`user_status`,`full_name`,`name`,`phone_number`,`branch_id`,`email`,`email_verified_at`,`password`,`remember_token`,`blokir_id`,`blokir_at`,`updated_id`,`data_state`,`created_at`,`updated_at`) values 
(1,1,NULL,0,0,'Admin','Admin','',0,NULL,NULL,'$2y$10$ruBJy5PdpbUYCciYlTRVNeIJZ3QMEFYvLljB9Y.dq6fs6wAZzI8Fe',NULL,NULL,NULL,NULL,0,NULL,'2023-07-04 04:11:15'),
(2,2,1,0,0,'','Arya','08124344343',0,NULL,NULL,'$2y$10$ZTRJ6ebJjPQCPG8JNX4tZOYzoOeVbpL0UvUhkciW1Wpft98WSaguG',NULL,NULL,NULL,NULL,0,'2023-07-08 04:30:34','2023-07-08 04:30:34'),
(3,2,2,0,0,'','Hengky','0812423432',0,NULL,NULL,'$2y$10$aAvDd2r45XF94XltwTUqlekVhGSybz/co3mIiKwQU7cyu/Ukbi062',NULL,NULL,NULL,NULL,0,'2023-07-10 14:43:50','2023-07-10 14:43:50'),
(4,2,3,0,0,'','Memet','0892123122',0,NULL,NULL,'$2y$10$e6aljS/E0O.nSWXBlQmsJ.KOoU8P5O1Hb/bTcDZsLfipzV36aWxli',NULL,NULL,NULL,NULL,0,'2023-07-10 14:44:23','2023-07-10 14:44:23'),
(5,2,4,0,0,'','Shey','0892123122',0,NULL,NULL,'$2y$10$gG7PNJJFQk4e36Vmox3uTuoaomQ2P10aAkCL/yEnzeOFpAZ6mw3rG',NULL,NULL,NULL,NULL,0,'2023-07-10 14:59:37','2023-07-10 14:59:37'),
(6,2,5,0,0,'','Vonny','081243443432',0,NULL,NULL,'$2y$10$/8X.8sJ14wEVfb.p28WSvu5wVOSUik9IgdruALsJb78coVrFJZCmG',NULL,NULL,NULL,NULL,0,'2023-07-10 15:00:12','2023-07-10 15:00:12'),
(7,2,6,0,0,'','Makjel','0892123122',0,NULL,NULL,'$2y$10$j6RvDv5Frh5a8VKTCTkag.6gznUQbRL4COjnLtmgEjNmbCywpsvDa',NULL,NULL,NULL,NULL,0,'2023-07-10 15:02:02','2023-07-10 15:02:02');

/*Table structure for table `system_user_group` */

DROP TABLE IF EXISTS `system_user_group`;

CREATE TABLE `system_user_group` (
  `user_group_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_group_level` int(11) DEFAULT NULL,
  `user_group_name` varchar(50) DEFAULT NULL,
  `user_group_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_group_id`),
  UNIQUE KEY `user_group_level` (`user_group_level`),
  KEY `user_group_token` (`user_group_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `system_user_group` */

insert  into `system_user_group`(`user_group_id`,`user_group_level`,`user_group_name`,`user_group_token`,`data_state`,`created_id`,`created_at`,`updated_id`,`updated_on`,`deleted_id`,`deleted_on`,`updated_at`) values 
(1,1,'Admin','',0,0,NULL,0,NULL,0,NULL,'2023-07-04 11:09:07'),
(2,2,'Petugas','',0,0,'2023-07-04 04:12:36',0,NULL,0,NULL,'2023-07-04 04:12:36');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

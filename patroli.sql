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
/*Table structure for table `berita` */

DROP TABLE IF EXISTS `berita`;

CREATE TABLE `berita` (
  `berita_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `information_berita` text NOT NULL,
  `start_date_show` date NOT NULL,
  `last_date_show` date NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`berita_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `berita` */

insert  into `berita`(`berita_id`,`file`,`information_berita`,`start_date_show`,`last_date_show`,`data_state`,`created_at`,`updated_at`) values 
(1,'adel2.jpg','member jkt48 adel rawr','2023-08-19','2023-09-15',0,'2023-08-19 11:20:56','2023-09-04 13:53:42'),
(2,'adel3.jpeg','tes','2023-08-29','2023-08-31',0,'2023-08-29 13:41:33','2023-08-29 13:41:33');

/*Table structure for table `emergency_message` */

DROP TABLE IF EXISTS `emergency_message`;

CREATE TABLE `emergency_message` (
  `emergency_message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emergency_message_name` varchar(255) NOT NULL,
  `emergency_message_phone_number` varchar(255) NOT NULL,
  `emergency_message_text` varchar(255) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emergency_message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `emergency_message` */

insert  into `emergency_message`(`emergency_message_id`,`emergency_message_name`,`emergency_message_phone_number`,`emergency_message_text`,`data_state`,`created_at`,`updated_at`) values 
(1,'Rumah Sakit','081358989481','kita butuh Ambulance',0,'2023-07-31 14:02:49','2023-08-01 13:39:05'),
(2,'Pemadam Kebakaran','081358989481','Kita butuh Pemadam Kebakaran',0,'2023-08-01 13:36:17','2023-08-01 15:18:27'),
(3,'Polisi','081358989481','Kita butuh Polisi',0,'2023-08-01 15:22:16','2023-08-01 15:22:16');

/*Table structure for table `equipment` */

DROP TABLE IF EXISTS `equipment`;

CREATE TABLE `equipment` (
  `equipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_amount` int(11) NOT NULL,
  `equipment_information` text DEFAULT NULL,
  `last_take_name` varchar(255) DEFAULT NULL,
  `last_take_date` datetime DEFAULT NULL,
  `quality` int(11) NOT NULL COMMENT '1 = Bagus 2 = Sedang 3 = Rusak',
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `equipment` */

insert  into `equipment`(`equipment_id`,`equipment_name`,`equipment_amount`,`equipment_information`,`last_take_name`,`last_take_date`,`quality`,`data_state`,`created_at`,`updated_at`) values 
(1,'HT',7,'barang bagus baru beli','2','2023-08-18 15:22:55',1,0,'2023-08-01 16:43:17','2023-08-18 15:23:13');

/*Table structure for table `equipment_data` */

DROP TABLE IF EXISTS `equipment_data`;

CREATE TABLE `equipment_data` (
  `equipment_data_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `take_equipment_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`equipment_data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `equipment_data` */

insert  into `equipment_data`(`equipment_data_id`,`take_equipment_id`,`equipment_id`,`data_state`,`created_at`,`updated_at`) values 
(1,1,1,0,'2023-08-18 15:23:13','2023-08-18 15:23:13'),
(2,1,1,0,'2023-08-18 15:23:13','2023-08-18 15:23:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(42,'2023_07_15_115812_add_patrol_id_to_patrol_schedule',6),
(43,'2023_07_31_115808_create_emergency_message_table',7),
(44,'2023_08_01_111231_create_equipment_table',8),
(45,'2023_08_02_154212_create_take_equipment_table',9),
(46,'2023_08_04_104453_create_equipment_data_table',10),
(47,'2023_08_05_103808_create_return_equipment_table',11),
(48,'2023_08_10_151033_create_berita_table',12),
(49,'2023_08_25_140659_create_penilaian_kesehatan_category_table',13),
(50,'2023_08_25_141259_create_penilaian_kesehatan_schedule_table',13),
(51,'2023_08_25_141837_create_penilaian_kesehatan_table',13),
(52,'2023_08_25_141259_create_penilaian_kesehatan_schedule1_table',14);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patrol` */

insert  into `patrol`(`patrol_id`,`patrol_name`,`data_state`,`created_at`,`updated_at`) values 
(1,'Jadwal Pagi',0,'2023-07-15 13:25:24','2023-07-31 11:42:14'),
(2,'Jadwal Siang',0,'2023-07-17 15:04:14','2023-07-31 11:38:54'),
(3,'Jadwal Malam',0,'2023-07-24 13:53:49','2023-07-31 11:38:43'),
(4,'Jadwal Lippo',0,'2023-07-31 11:35:01','2023-08-03 11:51:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patrol_schedule` */

insert  into `patrol_schedule`(`patrol_schedule_id`,`patrol_id`,`location_id`,`patrol_start_time`,`patrol_end_time`,`patrol_information`,`data_state`,`created_at`,`updated_at`) values 
(1,1,4,'08:00:00','15:45:00','Membeli',0,'2023-07-15 13:25:24','2023-07-17 18:06:15'),
(2,1,2,'09:00:00','21:30:00','Mengecek',1,'2023-07-15 13:25:24','2023-07-31 11:38:58'),
(3,1,3,'09:30:00','15:00:00','Memberi',0,'2023-07-15 13:25:24','2023-07-17 14:59:16'),
(4,1,3,'10:00:00','16:00:00','Melakukan',0,'2023-07-17 14:56:05','2023-07-17 14:56:05'),
(5,1,4,'11:15:00','16:00:00','Memberikan',0,'2023-07-17 14:56:05','2023-07-17 17:54:45'),
(6,1,1,'10:45:00','17:30:00','Melakukan',0,'2023-07-17 14:59:16','2023-07-31 11:42:14'),
(7,2,5,'13:00:00','14:00:00','Melakukan',0,'2023-07-17 15:04:14','2023-07-17 18:06:29'),
(8,2,2,'09:00:00','15:00:00','Memberi',1,'2023-07-17 15:04:14','2023-07-31 11:38:49'),
(9,2,1,'15:00:00','16:00:00','Menari',0,'2023-07-17 15:04:14','2023-07-17 15:04:14'),
(10,2,2,'09:00:00','17:00:00','Memberi',1,'2023-07-17 15:12:37','2023-07-31 11:38:52'),
(11,1,3,'12:30:00','12:45:00','Memberikan',0,'2023-07-17 15:18:01','2023-07-17 18:06:15'),
(12,3,5,'07:52:00','15:00:00','jaga parkir',0,'2023-07-24 13:53:49','2023-07-24 13:53:49'),
(13,3,2,'09:09:00','15:00:00','jaga lobby',1,'2023-07-24 13:53:49','2023-07-31 11:38:39'),
(14,4,2,'09:00:00','17:00:00','lippo',1,'2023-07-31 11:35:01','2023-08-03 11:10:16'),
(15,4,2,'08:51:00','21:51:00','tes',0,'2023-08-03 11:51:27','2023-08-03 11:51:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12,3,'restock',0,'2023-07-24 13:53:49','2023-07-24 13:53:49'),
(13,4,'jaga lobby',0,'2023-07-31 11:35:01','2023-07-31 11:35:01'),
(14,4,'keliling mall',0,'2023-07-31 11:35:01','2023-07-31 11:35:01');

/*Table structure for table `penilaian_kesehatan` */

DROP TABLE IF EXISTS `penilaian_kesehatan`;

CREATE TABLE `penilaian_kesehatan` (
  `penilaian_kesehatan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_id` int(11) NOT NULL,
  `penilaian_kesehatan_category_id` int(11) NOT NULL,
  `penilaian_kesehatan_schedule_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penilaian_kesehatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penilaian_kesehatan` */

insert  into `penilaian_kesehatan`(`penilaian_kesehatan_id`,`personil_id`,`penilaian_kesehatan_category_id`,`penilaian_kesehatan_schedule_id`,`value`,`data_state`,`created_at`,`updated_at`) values 
(1,2,1,1,'70',0,'2023-08-25 16:33:56','2023-08-26 10:42:55'),
(2,3,1,1,'100',0,'2023-08-29 13:54:59','2023-08-29 13:54:59'),
(3,4,1,2,'40',0,'2023-08-30 11:47:19','2023-08-30 11:47:19'),
(4,5,2,2,'50',0,'2023-08-30 15:09:48','2023-08-30 15:09:48'),
(5,2,1,1,'30',0,'2023-09-02 12:06:49','2023-09-02 12:06:49'),
(6,3,2,1,'50',0,'2023-09-02 12:41:39','2023-09-02 12:41:39');

/*Table structure for table `penilaian_kesehatan_category` */

DROP TABLE IF EXISTS `penilaian_kesehatan_category`;

CREATE TABLE `penilaian_kesehatan_category` (
  `penilaian_kesehatan_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penilaian_kesehatan_category_code` varchar(255) NOT NULL,
  `penilaian_kesehatan_category_name` varchar(255) NOT NULL,
  `penilaian_kesehatan_category_information` text NOT NULL,
  `data_state` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penilaian_kesehatan_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penilaian_kesehatan_category` */

insert  into `penilaian_kesehatan_category`(`penilaian_kesehatan_category_id`,`penilaian_kesehatan_category_code`,`penilaian_kesehatan_category_name`,`penilaian_kesehatan_category_information`,`data_state`,`created_at`,`updated_at`) values 
(1,'Tns','Tensi','cek tensi',0,'2023-08-25 15:06:59','2023-08-25 15:16:14'),
(2,'drh','Darah','Cek Darah',0,'2023-08-30 15:09:27','2023-08-30 15:09:27');

/*Table structure for table `penilaian_kesehatan_schedule` */

DROP TABLE IF EXISTS `penilaian_kesehatan_schedule`;

CREATE TABLE `penilaian_kesehatan_schedule` (
  `penilaian_kesehatan_schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `period_month` varchar(255) NOT NULL,
  `period_year` year(4) NOT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penilaian_kesehatan_schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penilaian_kesehatan_schedule` */

insert  into `penilaian_kesehatan_schedule`(`penilaian_kesehatan_schedule_id`,`period_month`,`period_year`,`data_state`,`created_at`,`updated_at`) values 
(1,'09',2023,0,'2023-08-25 15:43:39','2023-08-25 15:44:00'),
(2,'11',2023,0,'2023-08-29 14:44:10','2023-08-29 14:44:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personil_scheduling` */

insert  into `personil_scheduling`(`personil_scheduling_id`,`personil_id`,`patrol_id`,`patrol_day`,`data_state`,`created_at`,`updated_at`) values 
(1,4,1,'[\"Senin\",\"Selasa\"]',0,'2023-07-08 05:08:46','2023-07-17 16:02:42'),
(2,5,1,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,NULL,'2023-07-17 15:56:04'),
(3,2,1,'[\"Selasa\",\"Jumat\",\"Sabtu\"]',0,NULL,NULL),
(4,1,1,'[\"Senin\",\"Selasa\"]',0,NULL,NULL),
(5,3,2,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,'2023-07-17 15:51:28','2023-07-24 14:45:23'),
(6,3,3,'[\"Senin\",\"Selasa\",\"Rabu\"]',0,'2023-07-24 14:44:45','2023-07-24 14:48:55'),
(7,6,4,'[\"Senin\",\"Selasa\",\"Kamis\",\"Sabtu\"]',0,'2023-07-31 11:36:37','2023-08-05 11:29:14');

/*Table structure for table `presensi` */

DROP TABLE IF EXISTS `presensi`;

CREATE TABLE `presensi` (
  `presensi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_scheduling_id` int(11) NOT NULL,
  `patrol_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `personil_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `checked` text DEFAULT NULL COMMENT 'patrol_task_id',
  `information` text DEFAULT NULL,
  `data_state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`presensi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `presensi` */

insert  into `presensi`(`presensi_id`,`personil_scheduling_id`,`patrol_id`,`location_id`,`personil_id`,`date_time`,`checked`,`information`,`data_state`,`created_at`,`updated_at`) values 
(1,3,1,1,4,'2023-07-11 12:05:46','[\"2\",\"3\",\"8\"]','Aman',0,'2023-07-11 12:05:46','2023-07-11 12:05:46'),
(2,4,2,3,5,'2023-07-11 12:11:02','[\"14\"]',NULL,0,'2023-07-11 12:11:02','2023-07-11 12:11:02'),
(3,1,1,2,4,'2023-07-17 16:45:05','[\"1\",\"2\",\"3\",\"4\",\"5\"]','Don',0,'2023-07-17 16:45:05','2023-07-17 16:45:05'),
(4,1,3,1,4,'2023-07-31 11:18:51','[\"12\"]',NULL,0,'2023-07-31 11:18:51','2023-07-31 11:18:51'),
(5,1,3,2,4,'2023-07-31 11:19:50','[\"11\",\"12\"]',NULL,0,'2023-07-31 11:19:50','2023-07-31 11:19:50'),
(6,1,3,1,4,'2023-07-31 11:42:59','null',NULL,0,'2023-07-31 11:42:59','2023-07-31 11:42:59'),
(7,1,3,2,4,'2023-07-31 11:43:09','[\"11\",\"12\",\"13\"]',NULL,0,'2023-07-31 11:43:09','2023-07-31 11:43:09'),
(8,1,3,2,4,'2023-07-31 11:45:22','null',NULL,0,'2023-07-31 11:45:22','2023-07-31 11:45:22'),
(9,1,3,1,4,'2023-07-31 11:45:41','[\"11\",\"12\",\"13\"]',NULL,0,'2023-07-31 11:45:41','2023-07-31 11:45:41'),
(10,7,4,2,6,'2023-08-01 14:31:59','[\"13\"]',NULL,0,'2023-08-01 14:31:59','2023-08-01 14:31:59'),
(11,7,4,2,6,'2023-08-01 16:11:35','[\"13\"]',NULL,0,'2023-08-01 16:11:35','2023-08-01 16:11:35'),
(12,7,4,2,6,'2023-08-01 16:12:11','[\"13\"]',NULL,0,'2023-08-01 16:12:11','2023-08-01 16:12:11'),
(13,7,4,2,6,'2023-08-01 16:12:56','[\"13\"]',NULL,0,'2023-08-01 16:12:56','2023-08-01 16:12:56'),
(14,7,4,2,6,'2023-08-01 16:14:26','[\"13\"]',NULL,0,'2023-08-01 16:14:26','2023-08-01 16:14:26'),
(15,7,4,2,6,'2023-08-10 15:25:46','null',NULL,0,'2023-08-10 15:25:46','2023-08-10 15:25:46'),
(16,7,4,NULL,6,'2023-08-10 15:25:47','null',NULL,0,'2023-08-10 15:25:47','2023-08-10 15:25:47'),
(17,7,4,2,6,'2023-08-10 15:26:00','null',NULL,0,'2023-08-10 15:26:00','2023-08-10 15:26:00'),
(18,7,4,2,6,'2023-08-10 15:27:13','null',NULL,0,'2023-08-10 15:27:13','2023-08-10 15:27:13'),
(19,7,4,2,6,'2023-08-10 15:29:17','null',NULL,0,'2023-08-10 15:29:17','2023-08-10 15:29:17'),
(20,7,4,2,6,'2023-08-10 16:15:04','null',NULL,0,'2023-08-10 16:15:04','2023-08-10 16:15:04'),
(21,7,4,2,6,'2023-08-10 16:17:04','null',NULL,0,'2023-08-10 16:17:04','2023-08-10 16:17:04');

/*Table structure for table `return_equipment` */

DROP TABLE IF EXISTS `return_equipment`;

CREATE TABLE `return_equipment` (
  `return_equipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_id` int(11) NOT NULL,
  `take_equipment_id` int(11) NOT NULL,
  `return_date` datetime NOT NULL,
  `return_equipment_checklist` text NOT NULL,
  `information_per_item` text NOT NULL,
  `no_return_equipment` varchar(250) DEFAULT '',
  `data_state` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`return_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `return_equipment` */

insert  into `return_equipment`(`return_equipment_id`,`personil_id`,`take_equipment_id`,`return_date`,`return_equipment_checklist`,`information_per_item`,`no_return_equipment`,`data_state`,`created_at`,`updated_at`) values 
(1,2,1,'2023-08-18 15:23:53','[\"1\",\"2\"]','telah dikembalikan dengan sempurna','RE/2023/VIII/00001',0,'2023-08-18 15:23:53','2023-08-18 15:23:53');

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
('25','laporan-presensi','file',2,'Laporan Presensi',NULL,'2023-07-20 14:09:11'),
('26','berita','file',2,'Berita',NULL,'2023-09-04 14:00:44'),
('3','#','folder',1,'Barang',NULL,'2023-09-02 12:59:02'),
('31','equipment','file',2,'List Barang',NULL,'2023-09-02 12:59:52'),
('32','take-equipment','file',2,'Ambil Barang',NULL,'2023-09-04 10:53:01'),
('33','return-equipment','file',2,'Pengembalian Barang',NULL,'2023-09-02 13:01:11'),
('4','#','folder',1,'Penilaian Kesehatan',NULL,'2023-09-04 13:58:03'),
('41','penilaian-kesehatan','file',2,'Penilaian Kesehatan',NULL,'2023-09-04 13:58:21'),
('42','kategori-penilaian-kesehatan','file',2,'Kategori Penilaian Kesehatan',NULL,'2023-09-04 13:58:49'),
('43','jadwal-penilaian-kesehatan','file',2,'Jadwal Penilaian Kesehatan',NULL,'2023-09-04 13:59:15');

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
) ENGINE=InnoDB AUTO_INCREMENT=436 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(426,2,'24','2023-07-26 16:17:24','2023-07-26 16:17:24'),
(427,1,'3','2023-09-04 10:48:34','2023-09-04 10:48:30'),
(428,1,'31','2023-09-04 10:48:50','2023-09-04 10:48:53'),
(429,1,'32','2023-09-04 10:49:04','2023-09-04 10:49:07'),
(430,1,'33','2023-09-04 10:49:14','2023-09-04 10:49:17'),
(431,1,'4',NULL,'2023-09-04 13:59:28'),
(432,1,'41',NULL,'2023-09-04 13:59:36'),
(433,1,'42',NULL,'2023-09-04 13:59:42'),
(434,1,'43',NULL,'2023-09-04 13:59:49'),
(435,1,'26',NULL,'2023-09-04 14:01:04');

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

/*Table structure for table `take_equipment` */

DROP TABLE IF EXISTS `take_equipment`;

CREATE TABLE `take_equipment` (
  `take_equipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personil_id` int(11) NOT NULL,
  `patrol_id` int(11) NOT NULL,
  `date_and_time_pick_up` datetime NOT NULL,
  `no_take_equipment` varchar(250) DEFAULT '',
  `status` int(10) DEFAULT 0,
  `data_state` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`take_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `take_equipment` */

insert  into `take_equipment`(`take_equipment_id`,`personil_id`,`patrol_id`,`date_and_time_pick_up`,`no_take_equipment`,`status`,`data_state`,`created_at`,`updated_at`) values 
(1,2,2,'2023-08-18 15:22:55','TE/2023/VIII/00001',2,0,'2023-08-18 15:23:13','2023-08-18 15:23:53');

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

/* Trigger structure for table `return_equipment` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `nomor_pengembalian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `nomor_pengembalian` BEFORE INSERT ON `return_equipment` FOR EACH ROW BEGIN
	DECLARE year_period 				VARCHAR(20);
	DECLARE month_period 				VARCHAR(20);
	DECLARE PERIOD 					VARCHAR(20);
	DECLARE tPeriod					INT;
	DECLARE nReturnEquipmentNo			VARCHAR(20);
	DECLARE monthPeriod				VARCHAR(20);
	
	SET year_period = (YEAR(new.created_at));
	
	SET month_period = (SELECT RIGHT(CONCAT('0', MONTH(new.created_at)), 2));
	
	IF (month_period) = '01' THEN 
		SET monthPeriod = 'I';
	END IF;
	
	IF (month_period) = '02' THEN 
		SET monthPeriod = 'II';
	END IF;
	
	IF (month_period) = '03' THEN 
		SET monthPeriod = 'III';
	END IF;
	
	IF (month_period) = '04' THEN 
		SET monthPeriod = 'IV';
	END IF;	
	
	IF (month_period) = '05' THEN 
		SET monthPeriod = 'V';
	END IF;
	
	IF (month_period) = '06' THEN 
		SET monthPeriod = 'VI';
	END IF;
	
	IF (month_period) = '07' THEN 
		SET monthPeriod = 'VII';
	END IF;
	
	IF (month_period) = '08' THEN 
		SET monthPeriod = 'VIII';
	END IF;
	
	IF (month_period) = '09' THEN 
		SET monthPeriod = 'IX';
	END IF;
		
	IF (month_period) = '10' THEN 
		SET monthPeriod = 'X';
	END IF;
	
	IF (month_period) = '11' THEN 
		SET monthPeriod = 'XI';
	END IF;
	
	IF (month_period) = '12' THEN 
		SET monthPeriod = 'XII';
	END IF;
	
	SET PERIOD = (SELECT RIGHT(TRIM(no_return_equipment), 5)
			FROM return_equipment
			WHERE SUBSTRING(TRIM(no_return_equipment), 4, 4) = year_period
			ORDER BY return_equipment_id DESC 
			LIMIT 1);
		
	IF (PERIOD IS NULL ) THEN 
		SET PERIOD = "00000";
	END IF;
	
	SET tPeriod = CAST(PERIOD AS DECIMAL(10));
	
	SET tPeriod = tPeriod + 1;
	
	SET PERIOD = RIGHT(CONCAT('00000', TRIM(CAST(tPeriod AS CHAR(5)))), 5);
		
	SET nReturnEquipmentNo = CONCAT('RE/', year_period,'/', monthPeriod, '/' ,PERIOD);
	
	SET new.no_return_equipment = nReturnEquipmentNo;
    END */$$


DELIMITER ;

/* Trigger structure for table `take_equipment` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `nomor_pengambilan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `nomor_pengambilan` BEFORE INSERT ON `take_equipment` FOR EACH ROW BEGIN
	DECLARE year_period 				VARCHAR(20);
	DECLARE month_period 				VARCHAR(20);
	DECLARE PERIOD 					VARCHAR(20);
	DECLARE tPeriod					INT;
	DECLARE nTakeEquipmentNo			VARCHAR(20);
	DECLARE monthPeriod				VARCHAR(20);
	
	SET year_period = (YEAR(new.created_at));
	
	SET month_period = (SELECT RIGHT(CONCAT('0', MONTH(new.created_at)), 2));
	
	IF (month_period) = '01' THEN 
		SET monthPeriod = 'I';
	END IF;
	
	IF (month_period) = '02' THEN 
		SET monthPeriod = 'II';
	END IF;
	
	IF (month_period) = '03' THEN 
		SET monthPeriod = 'III';
	END IF;
	
	IF (month_period) = '04' THEN 
		SET monthPeriod = 'IV';
	END IF;	
	
	IF (month_period) = '05' THEN 
		SET monthPeriod = 'V';
	END IF;
	
	IF (month_period) = '06' THEN 
		SET monthPeriod = 'VI';
	END IF;
	
	IF (month_period) = '07' THEN 
		SET monthPeriod = 'VII';
	END IF;
	
	IF (month_period) = '08' THEN 
		SET monthPeriod = 'VIII';
	END IF;
	
	IF (month_period) = '09' THEN 
		SET monthPeriod = 'IX';
	END IF;
		
	IF (month_period) = '10' THEN 
		SET monthPeriod = 'X';
	END IF;
	
	IF (month_period) = '11' THEN 
		SET monthPeriod = 'XI';
	END IF;
	
	IF (month_period) = '12' THEN 
		SET monthPeriod = 'XII';
	END IF;
	
	SET PERIOD = (SELECT RIGHT(TRIM(no_take_equipment), 5)
			FROM take_equipment
			WHERE SUBSTRING(TRIM(no_take_equipment), 4, 4) = year_period
			ORDER BY take_equipment_id DESC 
			LIMIT 1);
		
	IF (PERIOD IS NULL ) THEN 
		SET PERIOD = "00000";
	END IF;
	
	SET tPeriod = CAST(PERIOD AS DECIMAL(10));
	
	SET tPeriod = tPeriod + 1;
	
	SET PERIOD = RIGHT(CONCAT('00000', TRIM(CAST(tPeriod AS CHAR(5)))), 5);
		
	SET nTakeEquipmentNo = CONCAT('TE/', year_period,'/', monthPeriod, '/' ,PERIOD);
	
	SET new.no_take_equipment = nTakeEquipmentNo;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

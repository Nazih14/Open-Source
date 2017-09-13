-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: db_cms_sekolahku
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `_captcha`
--

DROP TABLE IF EXISTS `_captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_captcha`
--

LOCK TABLES `_captcha` WRITE;
/*!40000 ALTER TABLE `_captcha` DISABLE KEYS */;
/*!40000 ALTER TABLE `_captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_sessions`
--

DROP TABLE IF EXISTS `_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_TIMESTAMP` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_sessions`
--

LOCK TABLES `_sessions` WRITE;
/*!40000 ALTER TABLE `_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `academic_years`
--

DROP TABLE IF EXISTS `academic_years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) NOT NULL COMMENT 'Tahun Akademik',
  `semester` enum('odd','even') NOT NULL DEFAULT 'odd' COMMENT 'odd = Ganjil, even = Genap',
  `is_active` enum('true','false') NOT NULL DEFAULT 'false',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `academic_year` (`academic_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_years`
--

LOCK TABLES `academic_years` WRITE;
/*!40000 ALTER TABLE `academic_years` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_years` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `achievements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `type` bigint(20) NOT NULL DEFAULT '0',
  `level` smallint(6) NOT NULL DEFAULT '0',
  `year` year(4) NOT NULL DEFAULT '0000',
  `organizer` varchar(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_achievements` (`student_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `album_title` varchar(255) NOT NULL,
  `album_description` varchar(255) DEFAULT NULL,
  `album_slug` varchar(255) DEFAULT NULL,
  `album_cover` varchar(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `album_title` (`album_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) DEFAULT '0',
  `answer` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`question_id`,`answer`),
  KEY `index_answers` (`question_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` enum('_blank','_self','_parent','_top') DEFAULT '_blank',
  `image` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'CMS Sekolahku','http://sekolahku.web.id','_blank','1.png','2017-08-13 05:22:00','2017-08-13 05:22:00',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'President University','http://president.ac.id','_blank','2.png','2017-08-13 05:22:00','2017-08-13 05:22:00',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_group_settings`
--

DROP TABLE IF EXISTS `class_group_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_group_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year_id` bigint(20) NOT NULL DEFAULT '0',
  `class_group_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Kelas',
  `student_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`academic_year_id`,`student_id`),
  KEY `index_class_group_settings` (`academic_year_id`,`class_group_id`,`student_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_group_settings`
--

LOCK TABLES `class_group_settings` WRITE;
/*!40000 ALTER TABLE `class_group_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_group_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_groups`
--

DROP TABLE IF EXISTS `class_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(100) DEFAULT NULL,
  `sub_class` varchar(100) DEFAULT NULL,
  `major_id` bigint(20) DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`class`,`sub_class`,`major_id`),
  KEY `index_class_groups` (`major_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_groups`
--

LOCK TABLES `class_groups` WRITE;
/*!40000 ALTER TABLE `class_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_id` bigint(20) NOT NULL DEFAULT '0',
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) DEFAULT NULL,
  `comment_url` varchar(255) DEFAULT NULL,
  `comment_ip` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` enum('approved','unapproved','spam') DEFAULT 'approved',
  `comment_agent` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `comment_type` enum('post','message') DEFAULT 'post',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_comments` (`comment_post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_letter_number` varchar(255) DEFAULT NULL COMMENT 'Nomor Surat Tugas',
  `assignment_letter_date` date DEFAULT NULL COMMENT 'Tanggal Surat Tugas',
  `assignment_start_date` date DEFAULT NULL COMMENT 'TMT Tugas',
  `parent_school_status` enum('true','false') NOT NULL DEFAULT 'true' COMMENT 'Status Sekolah Induk',
  `full_name` varchar(150) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `nik` varchar(50) DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL COMMENT 'Alamat Jalan',
  `rt` varchar(10) DEFAULT NULL COMMENT 'Rukun Tetangga',
  `rw` varchar(10) DEFAULT NULL COMMENT 'Rukun Warga',
  `sub_village` varchar(255) DEFAULT NULL COMMENT 'Nama Dusun',
  `village` varchar(255) DEFAULT NULL COMMENT 'Nama Kelurahan/ Desa',
  `sub_district` varchar(255) DEFAULT NULL COMMENT 'Kecamatan',
  `district` varchar(255) DEFAULT NULL COMMENT 'Kabupaten',
  `postal_code` varchar(20) DEFAULT NULL COMMENT 'Kode POS',
  `religion` bigint(20) NOT NULL DEFAULT '0',
  `marital_status` bigint(20) NOT NULL DEFAULT '0',
  `spouse_name` varchar(255) DEFAULT NULL COMMENT 'Nama Pasangan : Suami / Istri',
  `spouse_employment` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Pekerjaan Pasangan : Suami / Istri',
  `citizenship` enum('WNI','WNA') NOT NULL DEFAULT 'WNI' COMMENT 'Kewarganegaraan',
  `country` varchar(255) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `employment_status` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Status Kepegawaian',
  `nip` varchar(100) DEFAULT NULL,
  `niy` varchar(100) DEFAULT NULL COMMENT 'NIY/NIGK',
  `nuptk` varchar(100) DEFAULT NULL,
  `employment_type` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Jenis Guru dan Tenaga Kependidikan (GTK)',
  `decree_appointment` varchar(255) DEFAULT NULL COMMENT 'SK Pengangkatan',
  `appointment_start_date` date DEFAULT NULL COMMENT 'TMT Pengangkatan',
  `institutions_lifter` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Lembaga Pengangkat',
  `decree_cpns` varchar(100) DEFAULT NULL COMMENT 'SK CPNS',
  `pns_start_date` date DEFAULT NULL COMMENT 'TMT CPNS',
  `rank` bigint(20) DEFAULT '0' COMMENT 'Pangkat / Golongan',
  `salary_source` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Sumber Gaji',
  `headmaster_license` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Punya Lisensi Kepala Sekolah ?',
  `skills_laboratory` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Keahlian Lab oratorium',
  `handle_special_needs` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Mampu Menangani Kebutuhan Khusus',
  `braille_skills` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Keahlian Braile ?',
  `sign_language_skills` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Keahlian Bahasa Isyarat ?',
  `phone` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `npwp` (`npwp`),
  UNIQUE KEY `niy` (`niy`),
  UNIQUE KEY `email` (`email`),
  KEY `index_employees` (`spouse_employment`,`employment_status`,`employment_type`,`institutions_lifter`,`rank`,`salary_source`,`skills_laboratory`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_categories`
--

DROP TABLE IF EXISTS `file_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_categories`
--

LOCK TABLES `file_categories` WRITE;
/*!40000 ALTER TABLE `file_categories` DISABLE KEYS */;
INSERT INTO `file_categories` VALUES (1,'Uncategorized','uncategorized','Uncategorized','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `file_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) DEFAULT NULL,
  `file_description` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_category_id` bigint(20) NOT NULL DEFAULT '0',
  `file_path` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_visibility` enum('public','private') DEFAULT 'public',
  `file_counter` bigint(20) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_files` (`file_category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_sliders`
--

DROP TABLE IF EXISTS `image_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_sliders`
--

LOCK TABLES `image_sliders` WRITE;
/*!40000 ALTER TABLE `image_sliders` DISABLE KEYS */;
INSERT INTO `image_sliders` VALUES (1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua','1.png','2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua','2.png','2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `image_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` enum('_blank','_self','_parent','_top') DEFAULT '_blank',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,'CMS Sekolahku','http://sekolahku.web.id','_blank','2017-08-13 05:22:00','2017-08-13 05:22:00',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `counter` int(11) unsigned NOT NULL DEFAULT '1',
  `datetime` datetime DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `majors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `major` varchar(255) DEFAULT NULL COMMENT 'Program Keahlian / Jurusan',
  `short_name` varchar(255) DEFAULT NULL COMMENT 'Nama Singkat',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `major` (`major`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `majors`
--

LOCK TABLES `majors` WRITE;
/*!40000 ALTER TABLE `majors` DISABLE KEYS */;
/*!40000 ALTER TABLE `majors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(150) NOT NULL,
  `menu_url` varchar(150) NOT NULL,
  `menu_target` enum('_blank','_self','_parent','_top') DEFAULT '_self',
  `menu_type` varchar(100) NOT NULL DEFAULT 'pages',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `position` bigint(20) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Hubungi Kami','hubungi-kami','_self','modules',0,4,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'Gallery Photo','gallery-photo','_self','modules',9,1,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'Gallery Video','gallery-video','_self','modules',9,2,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(4,'Formulir PPDB','formulir-penerimaan-peserta-didik-baru','_self','modules',8,1,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(5,'Hasil Seleksi','hasil-seleksi-penerimaan-peserta-didik-baru','_self','modules',8,2,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(6,'Cetak Formulir','cetak-formulir-penerimaan-peserta-didik-baru','_self','modules',8,3,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(7,'Download Formulir','download-formulir-penerimaan-peserta-didik-baru','_self','modules',8,4,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(8,'PPDB 2017','#','_self','links',0,2,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(9,'Gallery','#','_self','links',0,3,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(10,'Kategori','#','_self','links',0,1,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(11,'Uncategorized','category/uncategorized','_self','post_categories',10,1,'2017-08-13 05:22:02','2017-08-13 05:22:02',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `module_description` varchar(255) DEFAULT NULL,
  `module_url` varchar(255) DEFAULT NULL,
  `is_active` enum('true','false') DEFAULT 'true',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'Pengguna','Pengguna','acl','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'PPDB / PMB','PPDB / PMB','admission','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'Tampilan','Tampilan','appearance','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(4,'Blog','Blog','blog','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(5,'GTK / Staff / Dosen','GTK / Staff / Dosen','employees','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(6,'Media','Media','media','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(7,'Plugins','Plugins','plugins','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(8,'Data Referensi','Data Referensi','reference','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(9,'Pengaturan','Pengaturan','settings','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(10,'Peserta Didik / Mahasiswa','Peserta Didik / Mahasiswa','students','true','2017-08-13 05:21:56','2017-08-13 05:21:56',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(100) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`group`,`option`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'student_status','Aktif','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'student_status','Lulus','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'student_status','Mutasi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(4,'student_status','Dikeluarkan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(5,'student_status','Mengundurkan Diri','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(6,'student_status','Putus Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(7,'student_status','Meninggal','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(8,'student_status','Hilang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(9,'student_status','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(10,'employment','Tidak bekerja','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(11,'employment','Nelayan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(12,'employment','Petani','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(13,'employment','Peternak','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(14,'employment','PNS/TNI/POLRI','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(15,'employment','Karyawan Swasta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(16,'employment','Pedagang Kecil','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(17,'employment','Pedagang Besar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(18,'employment','Wiraswasta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(19,'employment','Wirausaha','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(20,'employment','Buruh','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(21,'employment','Pensiunan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(22,'employment','Lain-lain','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(23,'special_needs','Tidak','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(24,'special_needs','Tuna Netra','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(25,'special_needs','Tuna Rungu','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(26,'special_needs','Tuna Grahita ringan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(27,'special_needs','Tuna Grahita Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(28,'special_needs','Tuna Daksa Ringan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(29,'special_needs','Tuna Daksa Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(30,'special_needs','Tuna Laras','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(31,'special_needs','Tuna Wicara','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(32,'special_needs','Tuna ganda','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(33,'special_needs','Hiper aktif','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(34,'special_needs','Cerdas Istimewa','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(35,'special_needs','Bakat Istimewa','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(36,'special_needs','Kesulitan Belajar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(37,'special_needs','Narkoba','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(38,'special_needs','Indigo','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(39,'special_needs','Down Sindrome','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(40,'special_needs','Autis','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(41,'special_needs','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(42,'education','Tidak sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(43,'education','Putus SD','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(44,'education','SD Sederajat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(45,'education','SMP Sederajat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(46,'education','SMA Sederajat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(47,'education','D1','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(48,'education','D2','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(49,'education','D3','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(50,'education','D4/S1','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(51,'education','S2','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(52,'education','S3','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(53,'scholarship','Anak berprestasi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(54,'scholarship','Anak Miskin','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(55,'scholarship','Pendidikan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(56,'scholarship','Unggulan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(57,'scholarship','Lain-lain','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(58,'achievement_type','Sains','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(59,'achievement_type','Seni','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(60,'achievement_type','Olahraga','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(61,'achievement_type','Lain-lain','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(62,'achievement_level','Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(63,'achievement_level','Kecamatan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(64,'achievement_level','Kabupaten','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(65,'achievement_level','Provinsi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(66,'achievement_level','Nasional','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(67,'achievement_level','Internasional','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(68,'monthly_income','Kurang dari 500,000','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(69,'monthly_income','500.000 - 999.9999','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(70,'monthly_income','1 Juta - 1.999.999','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(71,'monthly_income','2 Juta - 4.999.999','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(72,'monthly_income','5 Juta - 20 Juta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(73,'monthly_income','Lebih dari 20 Juta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(74,'residence','Bersama orang tua','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(75,'residence','Wali','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(76,'residence','Kos','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(77,'residence','Asrama','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(78,'residence','Panti Asuhan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(79,'residence','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(80,'transportation','Jalan kaki','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(81,'transportation','Kendaraan pribadi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(82,'transportation','Kendaraan Umum / angkot / Pete-pete','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(83,'transportation','Jemputan Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(84,'transportation','Kereta Api','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(85,'transportation','Ojek','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(86,'transportation','Andong / Bendi / Sado / Dokar / Delman / Beca','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(87,'transportation','Perahu penyebrangan / Rakit / Getek','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(88,'transportation','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(89,'religion','Islam','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(90,'religion','kristen / protestan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(91,'religion','Katholik','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(92,'religion','Hindu','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(93,'religion','Budha','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(94,'religion','Khong Hu Chu','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(95,'religion','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(96,'school_level','1 - Sekolah Dasar (SD)/ Sederajat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(97,'school_level','2 - Sekolah Menengah Pertama (SMP)/ Sederajat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(98,'school_level','3 - Sekolah Menengah Atas (SMA) / Aliyah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(99,'school_level','4 - Sekolah Menengah Kejuruan (SMK)','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(100,'school_level','5 - Perguruan Tinggi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(101,'marital_status','Kawin','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(102,'marital_status','Belum Kawin','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(103,'marital_status','Berpisah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(104,'institutions_lifter','Pemerintah Pusat','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(105,'institutions_lifter','Pemerintah Provinsi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(106,'institutions_lifter','Pemerintah Kab/Kota','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(107,'institutions_lifter','Ketua yaysan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(108,'institutions_lifter','Kepala Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(109,'institutions_lifter','Komite Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(110,'institutions_lifter','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(111,'employment_status','PNS ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(112,'employment_status','PNS Diperbantukan ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(113,'employment_status','PNS DEPAG ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(114,'employment_status','GTY/PTY ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(115,'employment_status','GTT/PTT Provinsi ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(116,'employment_status','GTT/PTT Kabupaten/Kota','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(117,'employment_status','Guru Bantu Pusat ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(118,'employment_status','Guru Honor Sekolah ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(119,'employment_status','Tenaga Honor Sekolah ','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(120,'employment_status','CPNS','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(121,'employment_status','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(122,'employment_type','Guru Kelas','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(123,'employment_type','Guru Mata Pelajaran','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(124,'employment_type','Guru BK','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(125,'employment_type','Guru Inklusi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(126,'employment_type','Tenaga Administrasi Sekola','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(127,'employment_type','Gurtu Pendamping','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(128,'employment_type','Guru Magang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(129,'employment_type','Guru TIK','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(130,'employment_type','Laboran','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(131,'employment_type','Pustakawan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(132,'employment_type','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(133,'rank','I/A','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(134,'rank','I/B','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(135,'rank','I/C','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(136,'rank','I/D','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(137,'rank','II/A','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(138,'rank','II/B','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(139,'rank','II/C','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(140,'rank','II/D','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(141,'rank','III/A','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(142,'rank','III/B','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(143,'rank','III/C','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(144,'rank','III/D','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(145,'rank','IV/A','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(146,'rank','IV/B','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(147,'rank','IV/C','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(148,'rank','IV/D','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(149,'rank','IV/E','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(150,'salary_source','APBN','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(151,'salary_source','APBD Provinsi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(152,'salary_source','APBD Kab/Kota','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(153,'salary_source','Yaysan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(154,'salary_source','Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(155,'salary_source','Lembaga Donor','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(156,'salary_source','Lainnya','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(157,'skills_laboratory','Lab IPA','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(158,'skills_laboratory','Lab Fisika','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(159,'skills_laboratory','Lab Biologi','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(160,'skills_laboratory','Lab Kimia','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(161,'skills_laboratory','Lab Bahasa','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(162,'skills_laboratory','Lab Komputer','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(163,'skills_laboratory','Teknik Bangunan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(164,'skills_laboratory','Teknik Serveai & Pemetaan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(165,'skills_laboratory','Teknik Ketenagakerjaan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(166,'skills_laboratory','Teknik Pendidnginan & Tata Udara','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(167,'skills_laboratory','Teknik Mesin','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_album_id` bigint(20) NOT NULL DEFAULT '0',
  `photo_name` varchar(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_photos` (`photo_album_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pollings`
--

DROP TABLE IF EXISTS `pollings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pollings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `answer_id` bigint(20) DEFAULT '0',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_pollings` (`answer_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pollings`
--

LOCK TABLES `pollings` WRITE;
/*!40000 ALTER TABLE `pollings` DISABLE KEYS */;
/*!40000 ALTER TABLE `pollings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (1,'Uncategorized','uncategorized','Uncategorized','2017-08-13 05:21:58','2017-08-13 05:21:58',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) DEFAULT NULL,
  `post_content` longtext,
  `post_image` varchar(100) DEFAULT NULL,
  `post_author` bigint(20) DEFAULT '0',
  `post_categories` varchar(255) DEFAULT NULL,
  `post_type` varchar(50) NOT NULL DEFAULT 'post',
  `post_status` enum('publish','draft') DEFAULT 'publish',
  `post_visibility` enum('public','private') DEFAULT 'public',
  `post_comment_status` enum('open','close') DEFAULT 'open',
  `post_slug` varchar(255) DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_counter` bigint(20) DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_posts` (`post_author`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','headmaster_photo.png',0,'','welcome','publish','public','open','','',0,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'Sample Page','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',NULL,1,'1','page','publish','public','open','sample-page','berita, pengumuman, sekilas-info',1,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'Sample Post 1','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','post_image.png',1,'1','post','publish','public','open','sample-post-1','berita, pengumuman, sekilas-info',5,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(4,'Sample Post 2','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','post_image.png',1,'1','post','publish','public','open','sample-post-2','berita, pengumuman, sekilas-info',1,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(5,'Sample Post 3','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','post_image.png',1,'1','post','publish','public','open','sample-post-3','berita, pengumuman, sekilas-info',1,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(6,'Sample Post 4','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','post_image.png',1,'1','post','publish','public','open','sample-post-4','berita, pengumuman, sekilas-info',1,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(7,'Sample Post 5','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','post_image.png',1,'1','post','publish','public','open','sample-post-5','berita, pengumuman, sekilas-info',1,'2017-08-13 05:22:01','2017-08-13 05:22:01',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `is_active` enum('true','false') DEFAULT 'false',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `question` (`question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote` varchar(255) DEFAULT NULL,
  `quote_by` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`quote`,`quote_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_phases`
--

DROP TABLE IF EXISTS `registration_phases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_phases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL DEFAULT '0000' COMMENT 'Tahun PPDB',
  `phase` varchar(255) NOT NULL COMMENT 'Gelombang / Fase Pendaftaran',
  `start_date` date DEFAULT NULL COMMENT 'Tanggal Mulai',
  `end_date` date DEFAULT NULL COMMENT 'Tanggal Selesai',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`year`,`phase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_phases`
--

LOCK TABLES `registration_phases` WRITE;
/*!40000 ALTER TABLE `registration_phases` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_phases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_quotas`
--

DROP TABLE IF EXISTS `registration_quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_quotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL DEFAULT '0000' COMMENT 'Tahun PPDB',
  `major_id` bigint(20) DEFAULT '0' COMMENT 'Program Keahlian',
  `quota` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Kuota yang diterima secara keseluruhan',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`year`,`major_id`,`quota`),
  KEY `index_registration_quotas` (`major_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_quotas`
--

LOCK TABLES `registration_quotas` WRITE;
/*!40000 ALTER TABLE `registration_quotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scholarships`
--

DROP TABLE IF EXISTS `scholarships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scholarships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL DEFAULT '0',
  `type` bigint(20) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `start_year` year(4) NOT NULL DEFAULT '0000',
  `end_year` year(4) NOT NULL DEFAULT '0000',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `index_scholarships` (`student_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scholarships`
--

LOCK TABLES `scholarships` WRITE;
/*!40000 ALTER TABLE `scholarships` DISABLE KEYS */;
/*!40000 ALTER TABLE `scholarships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(100) NOT NULL,
  `variable` varchar(255) DEFAULT NULL,
  `value` text,
  `default` text,
  `group_access` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`group`,`variable`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'general','site_maintenance',NULL,'false','public, student, employee, administrator, super_user','Pemeliharaan situs','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'general','site_maintenance_end_date',NULL,'2017-01-01','public, student, employee, administrator, super_user','Tanggal Berakhir Pemeliharaan Situs','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'general','site_cache',NULL,'false','public, student, employee, administrator, super_user','Cache situs','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(4,'general','site_cache_time',NULL,'10','public, student, employee, administrator, super_user','Lama Cache Situs','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(5,'general','meta_description',NULL,'CMS Sekolahku adalah Content Management System dan PPDB Online gratis untuk SD SMP/Sederajat SMA/Sederajat','public, student, employee, administrator, super_user','Deskripsi Meta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(6,'general','meta_keywords',NULL,'CMS, Website Sekolah Gratis, Cara Membuat Website Sekolah, membuat web sekolah, contoh website sekolah, fitur website sekolah, Sekolah, Website, Internet,Situs, CMS Sekolah, Web Sekolah, Website Sekolah Gratis, Website Sekolah, Aplikasi Sekolah, PPDB Online, PSB Online, PSB Online Gratis, Penerimaan Siswa Baru Online, Raport Online, Kurikulum 2013, SD, SMP, SMA, Aliyah, MTs, SMK','public, student, employee, administrator, super_user','Kata Kunci Meta','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(7,'general','google_map_api_key',NULL,'1234567890','public, student, employee, administrator, super_user','API Key Google Map','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(8,'general','favicon',NULL,'favicon.png','public, student, employee, administrator, super_user','Favicon','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(9,'general','header',NULL,'header.png','public, student, employee, administrator, super_user','Gambar Header','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(10,'media','file_allowed_types',NULL,'jpg, jpeg, png, gif','public, student, employee, administrator, super_user','Tipe file yang diizinkan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(11,'media','upload_max_filesize',NULL,'0','public, student, employee, administrator, super_user','Maksimal Ukuran File yang Diupload','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(12,'media','thumbnail_size_height',NULL,'100','administrator, super_user','Tinggi Gambar Thumbnail','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(13,'media','thumbnail_size_width',NULL,'150','administrator, super_user','Lebar Gambar Thumbnail','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(14,'media','medium_size_height',NULL,'308','administrator, super_user','Tinggi Gambar Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(15,'media','medium_size_width',NULL,'460','administrator, super_user','Lebar Gambar Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(16,'media','large_size_height',NULL,'600','administrator, super_user','Tinggi Gambar Besar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(17,'media','large_size_width',NULL,'800','administrator, super_user','Lebar Gambar Besar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(18,'media','album_cover_height',NULL,'250','administrator, super_user','Tinggi Cover Album Photo','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(19,'media','album_cover_width',NULL,'400','administrator, super_user','Lebar Cover Album Photo','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(20,'media','banner_height',NULL,'81','administrator, super_user','Tinggi Iklan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(21,'media','banner_width',NULL,'245','administrator, super_user','Lebar Iklan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(22,'media','image_slider_height',NULL,'400','administrator, super_user','Tinggi Gambar Slide','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(23,'media','image_slider_width',NULL,'900','administrator, super_user','Lebar Gambar Slide','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(24,'media','student_photo_height',NULL,'170','public, student, employee, administrator, super_user','Tinggi Photo Peserta Didik','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(25,'media','student_photo_width',NULL,'113','public, student, employee, administrator, super_user','Lebar Photo Peserta Didik','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(26,'media','employee_photo_height',NULL,'170','employee, administrator, super_user','Tinggi Photo Guru dan Tenaga Kependidikan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(27,'media','employee_photo_width',NULL,'113','employee, administrator, super_user','Lebar Photo Guru dan Tenaga Kependidikan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(28,'media','headmaster_photo_height',NULL,'170','administrator, super_user','Tinggi Photo Kepala Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(29,'media','headmaster_photo_width',NULL,'113','administrator, super_user','Lebar Photo Kepala Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(30,'media','header_height',NULL,'80','administrator, super_user','Tinggi Gambar Header','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(31,'media','header_width',NULL,'200','administrator, super_user','Lebar Gambar Header','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(32,'media','logo_height',NULL,'120','administrator, super_user','Tinggi Logo Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(33,'media','logo_width',NULL,'120','administrator, super_user','Lebar Logo Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(34,'writing','default_post_category',NULL,'1','administrator, super_user','Default Kategori Tulisan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(35,'writing','default_post_status',NULL,'publish','administrator, super_user','Default Status Tulisan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(36,'writing','default_post_visibility',NULL,'public','administrator, super_user','Default Akses Tulisan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(37,'writing','default_post_discussion',NULL,'open','administrator, super_user','Default Komentar Tulisan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(38,'writing','post_image_thumbnail_height',NULL,'100','administrator, super_user','Tinggi Gambar Kecil','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(39,'writing','post_image_thumbnail_width',NULL,'150','administrator, super_user','Lebar Gambar Kecil','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(40,'writing','post_image_medium_height',NULL,'250','administrator, super_user','Tinggi Gambar Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(41,'writing','post_image_medium_width',NULL,'400','administrator, super_user','Lebar Gambar Sedang','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(42,'writing','post_image_large_height',NULL,'450','administrator, super_user','Tinggi Gambar Besar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(43,'writing','post_image_large_width',NULL,'840','administrator, super_user','Lebar Gambar Besar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(44,'reading','post_per_page',NULL,'10','public, student, employee, administrator, super_user','Tulisan per halaman','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(45,'reading','post_rss_count',NULL,'10','public, student, employee, administrator, super_user','Jumlah RSS','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(46,'reading','post_related_count',NULL,'10','public, student, employee, administrator, super_user','Jumlah Tulisan Terkait','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(47,'reading','comment_per_page',NULL,'10','public, student, employee, administrator, super_user','Komentar per halaman','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(48,'discussion','comment_moderation',NULL,'false','administrator, super_user','Komentar harus disetujui secara manual','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(49,'discussion','comment_registration',NULL,'false','public, student, employee, administrator, super_user','Pengguna harus terdaftar dan login untuk komentar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(50,'discussion','comment_blacklist',NULL,'kampret','public, student, employee, administrator, super_user','Komentar disaring','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(51,'discussion','comment_order',NULL,'asc','public, student, employee, administrator, super_user','Urutan Komentar','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(52,'social_account','facebook',NULL,'https://www.facebook.com/cmssekolahku/','public, student, employee, administrator, super_user','Facebook','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(53,'social_account','twitter',NULL,'https://twitter.com/antonsofyan','public, student, employee, administrator, super_user','Twitter','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(54,'social_account','google_plus',NULL,'google.com/+AntonSofyan','public, student, employee, administrator, super_user','Google Plus','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(55,'social_account','linked_in',NULL,'https://www.linkedin.com/in/anton-sofyan-1428937a/','public, student, employee, administrator, super_user','Linked In','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(56,'social_account','youtube',NULL,'-','public, student, employee, administrator, super_user','Youtube','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(57,'social_account','instagram',NULL,'https://www.instagram.com/anton_sofyan/','public, student, employee, administrator, super_user','Instagram','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(58,'mail_server','mail_server_protocol',NULL,'smpt','administrator, super_user','Mail Server Protocol','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(59,'mail_server','mail_server_hostname',NULL,'ssl://smtp.gmail.com','administrator, super_user','Mail Server Hostname','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(60,'mail_server','mail_server_username',NULL,'admin','administrator, super_user','Mail Server Username','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(61,'mail_server','mail_server_password',NULL,'admin','administrator, super_user','Mail Server Password','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(62,'mail_server','mail_server_port',NULL,'465','administrator, super_user','Mail Server Port','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(63,'school_profile','npsn',NULL,'123','public, student, employee, administrator, super_user','NPSN','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(64,'school_profile','school_name',NULL,'SMA Negeri 9 Kuningan','public, student, employee, administrator, super_user','Nama Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(65,'school_profile','headmaster',NULL,'Anton Sofyan','public, student, employee, administrator, super_user','Kepala Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(66,'school_profile','headmaster_photo',NULL,'headmaster_photo.png','public, student, employee, administrator, super_user','Photo Kepala Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(67,'school_profile','school_level',NULL,'3','public, student, employee, administrator, super_user','Bentuk Pendidikan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(68,'school_profile','school_status',NULL,'1','public, student, employee, administrator, super_user','Status Sekolah','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(69,'school_profile','ownership_status',NULL,'1','administrator, super_user','Status Kepemilikan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(70,'school_profile','decree_operating_permit',NULL,'-','administrator, super_user','SK Izin Operasional','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(71,'school_profile','decree_operating_permit_date',NULL,'2017-08-13','administrator, super_user','Tanggal SK Izin Operasional','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(72,'school_profile','tagline',NULL,'Where Tomorrow\'s Leaders Come Together','public, student, employee, administrator, super_user','Slogan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(73,'school_profile','rt',NULL,'12','public, student, employee, administrator, super_user','RT','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(74,'school_profile','rw',NULL,'06','public, student, employee, administrator, super_user','RW','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(75,'school_profile','sub_village',NULL,'Wage','public, student, employee, administrator, super_user','Dusun','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(76,'school_profile','village',NULL,'Kadugede','public, student, employee, administrator, super_user','Kelurahan / Desa','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(77,'school_profile','sub_district',NULL,'Kadugede','public, student, employee, administrator, super_user','Kecamatan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(78,'school_profile','district',NULL,'Kuningan','public, student, employee, administrator, super_user','Kabupaten','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(79,'school_profile','postal_code',NULL,'45561','public, student, employee, administrator, super_user','Kode Pos','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(80,'school_profile','street_address',NULL,'Jalan Raya Kadugede No. 11','public, student, employee, administrator, super_user','Alamat Jalan','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(81,'school_profile','latitude',NULL,'1234567890','public, student, employee, administrator, super_user','Latitude','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(82,'school_profile','longitude',NULL,'1234567890','public, student, employee, administrator, super_user','Longitude','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(83,'school_profile','phone',NULL,'0232123456','public, student, employee, administrator, super_user','Telepon','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(84,'school_profile','fax',NULL,'0232123456','public, student, employee, administrator, super_user','Fax','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(85,'school_profile','email',NULL,'info@sman9kuningan.sch.id','public, student, employee, administrator, super_user','Email','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(86,'school_profile','website',NULL,'http://www.sman9kuningan.sch.id','public, student, employee, administrator, super_user','Website','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(87,'school_profile','logo',NULL,'logo.png','public, student, employee, administrator, super_user','Logo','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(88,'admission','admission_status',NULL,'open','public, student, employee, administrator, super_user','Status Penerimaan Peserta Didik Baru','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(89,'admission','admission_year',NULL,'2017','public, student, employee, administrator, super_user','Tahun Penerimaan Peserta Didik Baru','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(90,'admission','admission_start_date',NULL,'2017-01-01','public, student, employee, administrator, super_user','Tanggal Mulai PPDB','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(91,'admission','admission_end_date',NULL,'2017-12-31','public, student, employee, administrator, super_user','Tanggal Selesai PPDB','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(92,'admission','announcement_start_date',NULL,'2017-01-01','public, student, employee, administrator, super_user','Tanggal Mulai Pengumuman Hasil Seleksi PPDB','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(93,'admission','announcement_end_date',NULL,'2017-12-31','public, student, employee, administrator, super_user','Tanggal Selesai Pengumuman Hasil Seleksi PPDB','2017-08-13 05:21:57','2017-08-13 05:21:57',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `major_id` bigint(20) DEFAULT NULL COMMENT 'Jurusan / Program Keahlian',
  `first_choice` bigint(20) DEFAULT '0' COMMENT 'Pilihan Pertama PPDB',
  `second_choice` bigint(20) DEFAULT '0' COMMENT 'Pilihan Kedua PPDB',
  `registration_number` varchar(10) DEFAULT NULL COMMENT 'Nomor Pendaftaran',
  `selection_result` varchar(100) DEFAULT NULL COMMENT 'Hasil Seleksi PPDB',
  `admission_phase_id` bigint(20) DEFAULT '0' COMMENT 'Gelombang Pendaftaran',
  `photo` varchar(100) DEFAULT NULL,
  `is_transfer` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Jenis Pendaftaran : Baru / Pindahan ?',
  `is_prospective_student` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Calon Siswa Baru ?',
  `re_registration` enum('true','false') DEFAULT NULL COMMENT 'Konfirmasi Pendaftaran Ulang Calon Siswa Baru',
  `is_alumni` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Alumni ?',
  `is_student` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'Student Aktif ?',
  `start_date` date DEFAULT NULL COMMENT 'Tanggal Masuk Sekolah',
  `nim` varchar(50) DEFAULT NULL COMMENT 'Nomor Induk Mahasiswa',
  `nis` varchar(50) DEFAULT NULL COMMENT 'Nomor Induk Siswa',
  `nisn` varchar(50) DEFAULT NULL COMMENT 'Nomor Induk Siswa Nasional',
  `nik` varchar(50) DEFAULT NULL COMMENT 'Nomor Induk Kependudukan / KTP',
  `prev_exam_number` varchar(50) DEFAULT NULL COMMENT 'Nomor Peserta Ujian Sebelumnya',
  `paud` enum('true','false') DEFAULT NULL COMMENT 'Apakah pernah PAUD',
  `tk` enum('true','false') DEFAULT NULL COMMENT 'Apakah pernah TK',
  `skhun` varchar(50) DEFAULT NULL COMMENT 'No. Seri Surat Keterangan Hasil Ujian Nasional Sebelumnya',
  `diploma_number` varchar(50) DEFAULT NULL COMMENT 'No. Seri Ijazah Sebelumnya',
  `hobby` varchar(255) DEFAULT NULL,
  `ambition` varchar(255) DEFAULT NULL COMMENT 'Cita-cita',
  `full_name` varchar(150) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `religion` bigint(20) DEFAULT NULL,
  `special_needs` bigint(20) DEFAULT NULL COMMENT 'Berkeburuhan Khusus',
  `street_address` varchar(255) DEFAULT NULL COMMENT 'Alamat Jalan',
  `rt` varchar(10) DEFAULT NULL COMMENT 'Alamat Jalan',
  `rw` varchar(10) DEFAULT NULL COMMENT 'Alamat Jalan',
  `sub_village` varchar(255) DEFAULT NULL COMMENT 'Nama Dusun',
  `village` varchar(255) DEFAULT NULL COMMENT 'Nama Kelurahan/ Desa',
  `sub_district` varchar(255) DEFAULT NULL COMMENT 'Kecamatan',
  `district` varchar(255) DEFAULT NULL COMMENT 'Kabupaten',
  `postal_code` varchar(20) DEFAULT NULL COMMENT 'Kode POS',
  `residence` bigint(20) DEFAULT NULL COMMENT 'Tempat Tinggal',
  `transportation` bigint(20) DEFAULT NULL COMMENT 'Moda Transportasi',
  `phone` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `sktm` varchar(100) DEFAULT NULL COMMENT 'Surat Keterangan Tidak Mampu (SKTM)',
  `kks` varchar(100) DEFAULT NULL COMMENT 'Kartu Keluarga Sejahtera (KKS)',
  `kps` varchar(100) DEFAULT NULL COMMENT 'Kartu Pra Sejahtera (KPS)',
  `kip` varchar(100) DEFAULT NULL COMMENT 'Kartu Indonesia Pintar (KIP)',
  `kis` varchar(100) DEFAULT NULL COMMENT 'Kartu Indonesia Sehat (KIS)',
  `citizenship` enum('WNI','WNA') NOT NULL DEFAULT 'WNI' COMMENT 'Kewarganegaraan',
  `country` varchar(255) DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `father_birth_year` year(4) DEFAULT NULL,
  `father_education` bigint(20) DEFAULT '0',
  `father_employment` bigint(20) DEFAULT '0',
  `father_monthly_income` bigint(20) DEFAULT '0',
  `father_special_needs` bigint(20) DEFAULT '0',
  `mother_name` varchar(150) DEFAULT NULL,
  `mother_birth_year` year(4) DEFAULT NULL,
  `mother_education` bigint(20) DEFAULT NULL,
  `mother_employment` bigint(20) DEFAULT NULL,
  `mother_monthly_income` bigint(20) DEFAULT NULL,
  `mother_special_needs` bigint(20) DEFAULT NULL,
  `guardian_name` varchar(150) DEFAULT NULL,
  `guardian_birth_year` year(4) DEFAULT NULL,
  `guardian_education` bigint(20) DEFAULT NULL,
  `guardian_employment` bigint(6) DEFAULT NULL,
  `guardian_monthly_income` bigint(20) DEFAULT NULL,
  `mileage` smallint(6) DEFAULT NULL COMMENT 'Jarak tempat tinggal ke sekolah',
  `traveling_time` smallint(6) DEFAULT NULL COMMENT 'Waktu Tempuh',
  `height` smallint(3) DEFAULT NULL COMMENT 'Tinggi Badan',
  `weight` smallint(3) DEFAULT NULL COMMENT 'Berat Badan',
  `sibling_number` smallint(2) DEFAULT '0' COMMENT 'Jumlah Saudara Kandng',
  `student_status` bigint(20) DEFAULT NULL COMMENT 'Status siswa',
  `end_date` date DEFAULT NULL COMMENT 'Tanggal Keluar',
  `reason` varchar(255) DEFAULT NULL COMMENT 'Diisi jika peserta didik sudah keluar',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`),
  UNIQUE KEY `nisn` (`nisn`),
  UNIQUE KEY `nim` (`nim`),
  UNIQUE KEY `email` (`email`),
  KEY `index_students` (`registration_number`,`full_name`,`first_choice`,`second_choice`,`major_id`,`admission_phase_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `is_active` enum('true','false') DEFAULT 'false',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Berita','berita','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'Pengumuman','pengumuman','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'Sekilas Info','sekilas-info','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL,
  `theme_folder` varchar(255) DEFAULT NULL,
  `theme_author` varchar(255) DEFAULT NULL,
  `is_active` enum('true','false') DEFAULT 'false',
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `theme_name` (`theme_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'Cosmo','cosmo','Anton Sofyan','true','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(2,'Flatly','flatly','Anton Sofyan','false','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false'),(3,'Journal','journal','Anton Sofyan','false','2017-08-13 05:21:59','2017-08-13 05:21:59',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_privileges`
--

DROP TABLE IF EXISTS `user_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_privileges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`user_group_id`,`module_id`),
  KEY `index_user_privileges` (`user_group_id`,`module_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_privileges`
--

LOCK TABLES `user_privileges` WRITE;
/*!40000 ALTER TABLE `user_privileges` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_full_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_url` varchar(100) DEFAULT NULL,
  `biography` text,
  `user_registered` datetime DEFAULT NULL,
  `user_group_id` bigint(20) NOT NULL DEFAULT '0',
  `user_type` enum('super_user','administrator','employee','student') NOT NULL DEFAULT 'administrator',
  `profile_id` bigint(20) unsigned DEFAULT NULL COMMENT 'student_id OR employee_id',
  `forgot_password_key` varchar(100) DEFAULT NULL,
  `forgot_password_request_date` date DEFAULT NULL,
  `is_active` enum('true','false') DEFAULT 'true',
  `is_logged_in` enum('true','false') DEFAULT 'false',
  `last_logged_in` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_url` (`user_url`),
  KEY `index_users` (`user_group_id`,`profile_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','$2y$10$Na/ZLZNkIA4b69veLzJ/8.p4ZoKBkpDfpKVAN4E6GEKpmQYMSIrm2','Administrator','admin@admin.com','sekolahku.web.id',NULL,'2017-08-13 12:21:58',0,'super_user',NULL,'3b7304b4793b402d10bee027229086d1b8029a4b',NULL,'true','false',NULL,NULL,'2017-08-13 05:21:58','2017-08-13 05:21:58',NULL,NULL,NULL,NULL,NULL,NULL,'false');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-13 12:22:06

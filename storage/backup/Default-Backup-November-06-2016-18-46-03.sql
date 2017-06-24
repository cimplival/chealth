-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: chealth
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,' signed into the account.','2016-11-04 04:25:51','2016-11-04 04:25:51'),(2,1,' registered a patient dsafsdf fdsaf fdsaf of Med ID: 1.','2016-11-04 04:29:28','2016-11-04 04:29:28'),(3,1,' created appointment for dsafsdf fdsaf fdsaf of Med ID: 1.','2016-11-04 04:30:05','2016-11-04 04:30:05'),(4,1,' confirmed the Consultation payment for dsafsdf fdsaf fdsaf of Med ID: Med ID: 1.','2016-11-04 04:30:47','2016-11-04 04:30:47'),(5,1,' added vitals for dsafsdf fdsaf fdsaf of Med ID: Med ID: 1. The patient\'s examination record was created, appointment status and triage status was also updated.','2016-11-04 04:31:14','2016-11-04 04:31:14'),(6,1,' signed out from the account.','2016-11-04 04:31:23','2016-11-04 04:31:23'),(7,4,' signed into the account.','2016-11-04 04:31:27','2016-11-04 04:31:27'),(8,4,' consulted dsafsdf fdsaf fdsaf of Med ID: 1. The examination status was also updated.','2016-11-04 04:31:33','2016-11-04 04:31:33'),(9,4,' signed out from the account.','2016-11-04 04:34:38','2016-11-04 04:34:38'),(10,2,' signed into the account.','2016-11-04 04:36:25','2016-11-04 04:36:25'),(11,2,' signed out from the account.','2016-11-04 04:37:37','2016-11-04 04:37:37'),(12,4,' signed into the account.','2016-11-04 04:37:43','2016-11-04 04:37:43'),(13,4,' discharged dsafsdf fdsaf fdsaf of Med ID: 1.','2016-11-04 04:37:54','2016-11-04 04:37:54'),(14,4,' signed out from the account.','2016-11-04 04:37:58','2016-11-04 04:37:58'),(15,0,' failed to sign into the account.','2016-11-04 04:44:33','2016-11-04 04:44:33'),(16,1,' signed into the account.','2016-11-04 04:44:38','2016-11-04 04:44:38'),(17,1,' registered a patient uy tyu tyut of Med ID: 2.','2016-11-04 04:45:18','2016-11-04 04:45:18'),(18,1,' created appointment for uy tyu tyut of Med ID: 2.','2016-11-04 04:45:40','2016-11-04 04:45:40'),(19,1,' confirmed the Consultation payment for uy tyu tyut of Med ID: Med ID: 2.','2016-11-04 04:46:07','2016-11-04 04:46:07'),(20,1,' added vitals for uy tyu tyut of Med ID: Med ID: 2. The patient\'s examination record was created, appointment status and triage status was also updated.','2016-11-04 04:46:47','2016-11-04 04:46:47'),(21,1,' signed out from the account.','2016-11-04 04:46:52','2016-11-04 04:46:52'),(22,4,' signed into the account.','2016-11-04 04:46:59','2016-11-04 04:46:59'),(23,4,' consulted uy tyu tyut of Med ID: 2. The examination status was also updated.','2016-11-04 04:47:41','2016-11-04 04:47:41'),(24,4,' signed out from the account.','2016-11-04 04:48:23','2016-11-04 04:48:23'),(25,4,' signed into the account.','2016-11-04 05:06:00','2016-11-04 05:06:00'),(26,4,' signed out from the account.','2016-11-04 05:10:49','2016-11-04 05:10:49'),(27,1,' signed into the account.','2016-11-04 05:11:59','2016-11-04 05:11:59'),(28,1,' registered a patient dfasd fdslkjs fskdj of Med ID: 3.','2016-11-04 05:13:13','2016-11-04 05:13:13'),(29,1,' created appointment for dfasd fdslkjs fskdj of Med ID: 3.','2016-11-04 05:13:25','2016-11-04 05:13:25'),(30,1,' confirmed the Consultation payment for dfasd fdslkjs fskdj of Med ID: Med ID: 3.','2016-11-04 05:13:48','2016-11-04 05:13:48'),(31,1,' added vitals for dfasd fdslkjs fskdj of Med ID: Med ID: 3. The patient\'s examination record was created, appointment status and triage status was also updated.','2016-11-04 05:14:12','2016-11-04 05:14:12'),(32,1,' signed out from the account.','2016-11-04 05:14:17','2016-11-04 05:14:17'),(33,4,' signed into the account.','2016-11-04 05:14:28','2016-11-04 05:14:28'),(34,4,' consulted dfasd fdslkjs fskdj of Med ID: 3. The examination status was also updated.','2016-11-04 05:14:35','2016-11-04 05:14:35'),(35,4,' signed out from the account.','2016-11-04 05:24:48','2016-11-04 05:24:48'),(36,2,' signed into the account.','2016-11-04 17:22:13','2016-11-04 17:22:13'),(37,2,' signed into the account.','2016-11-04 19:29:20','2016-11-04 19:29:20'),(38,2,' signed out from the account.','2016-11-04 19:29:31','2016-11-04 19:29:31'),(39,2,' signed into the account.','2016-11-04 19:30:18','2016-11-04 19:30:18'),(40,2,' signed out from the account.','2016-11-04 19:55:47','2016-11-04 19:55:47'),(41,2,' signed into the account.','2016-11-04 19:55:53','2016-11-04 19:55:53'),(42,2,' signed out from the account.','2016-11-04 19:58:08','2016-11-04 19:58:08'),(43,2,' signed into the account.','2016-11-04 19:58:15','2016-11-04 19:58:15'),(44,2,' signed into the account.','2016-11-04 20:12:53','2016-11-04 20:12:53'),(45,2,' deleted appointment for dsafsdf fdsaf fdsaf of Med ID: 1.','2016-11-04 20:20:10','2016-11-04 20:20:10'),(46,2,' signed out from the account.','2016-11-04 20:22:03','2016-11-04 20:22:03'),(47,5,' signed into the account.','2016-11-04 20:22:14','2016-11-04 20:22:14'),(48,5,' signed out from the account.','2016-11-04 20:25:51','2016-11-04 20:25:51'),(49,2,' signed into the account.','2016-11-04 20:25:58','2016-11-04 20:25:58'),(50,2,' signed into the account.','2016-11-05 09:34:50','2016-11-05 09:34:50'),(51,2,' signed into the account.','2016-11-05 14:03:20','2016-11-05 14:03:20'),(52,2,' signed out from the account.','2016-11-05 14:19:45','2016-11-05 14:19:45'),(53,5,' signed into the account.','2016-11-05 14:19:51','2016-11-05 14:19:51'),(54,5,' signed out from the account.','2016-11-05 14:20:08','2016-11-05 14:20:08'),(55,2,' signed into the account.','2016-11-05 14:20:15','2016-11-05 14:20:15'),(56,2,' signed out from the account.','2016-11-05 15:13:36','2016-11-05 15:13:36'),(57,5,' signed into the account.','2016-11-05 15:13:59','2016-11-05 15:13:59'),(58,5,' signed out from the account.','2016-11-05 16:45:23','2016-11-05 16:45:23'),(59,0,' failed to sign into the account.','2016-11-05 16:45:31','2016-11-05 16:45:31'),(60,3,' signed into the account.','2016-11-05 16:45:36','2016-11-05 16:45:36'),(61,3,' signed into the account.','2016-11-05 16:46:04','2016-11-05 16:46:04'),(62,3,' signed into the account.','2016-11-05 17:06:49','2016-11-05 17:06:49'),(63,3,' signed out from the account.','2016-11-05 17:08:32','2016-11-05 17:08:32'),(64,4,' signed into the account.','2016-11-05 17:08:39','2016-11-05 17:08:39'),(65,4,' added a diagnosis for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:23:30','2016-11-05 17:23:30'),(66,4,' added an immunization for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:23:58','2016-11-05 17:23:58'),(67,4,' added a therapy for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:25:19','2016-11-05 17:25:19'),(68,4,' added a procedure, surgery, hospitalization etc. for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:28:54','2016-11-05 17:28:54'),(69,4,' added a family or social history for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:29:45','2016-11-05 17:29:45'),(70,4,' added an allergy for the patient uy tyu tyut of Med ID: 2.','2016-11-05 17:30:52','2016-11-05 17:30:52'),(71,4,' signed out from the account.','2016-11-05 18:25:50','2016-11-05 18:25:50'),(72,6,' signed into the account.','2016-11-05 18:25:56','2016-11-05 18:25:56'),(73,6,' signed out from the account.','2016-11-05 19:12:45','2016-11-05 19:12:45'),(74,6,' signed into the account.','2016-11-05 19:18:14','2016-11-05 19:18:14'),(75,6,' signed out from the account.','2016-11-05 19:18:37','2016-11-05 19:18:37'),(76,6,' signed into the account.','2016-11-05 19:20:19','2016-11-05 19:20:19'),(77,6,' added a new drug Panadol of formulation (Tablets) with quantity 500','2016-11-05 19:20:51','2016-11-05 19:20:51'),(78,6,' signed out from the account.','2016-11-05 19:20:55','2016-11-05 19:20:55'),(79,4,' signed into the account.','2016-11-05 19:21:02','2016-11-05 19:21:02'),(80,4,' signed out from the account.','2016-11-05 19:21:39','2016-11-05 19:21:39'),(81,5,' signed into the account.','2016-11-05 19:21:49','2016-11-05 19:21:49'),(82,5,' signed out from the account.','2016-11-05 19:24:06','2016-11-05 19:24:06'),(83,4,' signed into the account.','2016-11-05 19:24:10','2016-11-05 19:24:10'),(84,4,' signed out from the account.','2016-11-05 19:39:44','2016-11-05 19:39:44'),(85,8,' signed into the account.','2016-11-05 19:39:56','2016-11-05 19:39:56'),(86,8,' signed out from the account.','2016-11-05 19:43:33','2016-11-05 19:43:33'),(87,5,' signed into the account.','2016-11-05 19:43:39','2016-11-05 19:43:39'),(88,5,' signed out from the account.','2016-11-05 20:01:52','2016-11-05 20:01:52'),(89,5,' signed into the account.','2016-11-05 20:02:06','2016-11-05 20:02:06'),(90,5,' added service of name Dentist of cost 2000.','2016-11-05 20:02:47','2016-11-05 20:02:47'),(91,5,' added service of name Lab of cost 500.','2016-11-05 20:03:01','2016-11-05 20:03:01'),(92,5,' signed out from the account.','2016-11-05 20:03:10','2016-11-05 20:03:10'),(93,5,' signed into the account.','2016-11-05 20:03:14','2016-11-05 20:03:14'),(94,5,' signed out from the account.','2016-11-05 20:05:39','2016-11-05 20:05:39'),(95,5,' signed into the account.','2016-11-05 20:05:45','2016-11-05 20:05:45'),(96,5,' confirmed the Lab payment for uy tyu tyut of Med ID: Med ID: 2.','2016-11-05 20:05:53','2016-11-05 20:05:53'),(97,5,' signed out from the account.','2016-11-05 20:05:58','2016-11-05 20:05:58'),(98,8,' signed into the account.','2016-11-05 20:06:11','2016-11-05 20:06:11'),(99,8,' updated lab for the patient uy tyu tyut of Med ID: 2.','2016-11-05 20:06:49','2016-11-05 20:06:49'),(100,8,' signed out from the account.','2016-11-05 20:06:58','2016-11-05 20:06:58'),(101,4,' signed into the account.','2016-11-05 20:07:12','2016-11-05 20:07:12'),(102,4,' reviewed lab for the patient uy tyu tyut of Med ID: 2  with Reviewed.','2016-11-05 20:08:55','2016-11-05 20:08:55'),(103,4,' signed out from the account.','2016-11-05 20:12:30','2016-11-05 20:12:30'),(104,1,' signed into the account.','2016-11-05 20:12:41','2016-11-05 20:12:41'),(105,6,' signed into the account.','2016-11-06 14:24:45','2016-11-06 14:24:45'),(106,6,' signed out from the account.','2016-11-06 15:21:29','2016-11-06 15:21:29'),(107,6,' signed into the account.','2016-11-06 15:21:43','2016-11-06 15:21:43'),(108,6,' signed out from the account.','2016-11-06 15:21:51','2016-11-06 15:21:51'),(109,5,' signed into the account.','2016-11-06 15:21:56','2016-11-06 15:21:56'),(110,5,' created an insurance record, a triage record, updated appointment status and changed payment status for uy tyu tyut of Med ID: Med ID: 2.','2016-11-06 15:22:28','2016-11-06 15:22:28'),(111,5,' signed out from the account.','2016-11-06 15:22:36','2016-11-06 15:22:36'),(112,6,' signed into the account.','2016-11-06 15:22:42','2016-11-06 15:22:42'),(113,6,' signed out from the account.','2016-11-06 15:25:30','2016-11-06 15:25:30'),(114,1,' signed into the account.','2016-11-06 15:25:34','2016-11-06 15:25:34');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `allergies`
--

DROP TABLE IF EXISTS `allergies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allergies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `allergy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observation_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `reactions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `allergies_on_patient_foreign` (`on_patient`),
  KEY `allergies_from_user_foreign` (`from_user`),
  CONSTRAINT `allergies_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `allergies_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allergies`
--

LOCK TABLES `allergies` WRITE;
/*!40000 ALTER TABLE `allergies` DISABLE KEYS */;
INSERT INTO `allergies` VALUES (1,2,2,'Fur','Severe','2016-11-05 00:00:00',1,'Animal fur','Need asdfafd',4,'2016-11-05 17:30:52','2016-11-05 17:30:52');
/*!40000 ALTER TABLE `allergies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `on_patient` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_on_patient_foreign` (`on_patient`),
  KEY `appointments_service_id_foreign` (`service_id`),
  KEY `appointments_from_user_foreign` (`from_user`),
  CONSTRAINT `appointments_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `appointments_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`),
  CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (2,2,1,0,2,'2016-11-04 07:45:39',1,'2016-11-04 04:45:39','2016-11-06 15:22:28'),(3,3,1,0,2,'2016-11-04 08:13:25',1,'2016-11-04 05:13:25','2016-11-04 05:13:48');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beds`
--

DROP TABLE IF EXISTS `beds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ward_no` int(10) unsigned NOT NULL,
  `bed_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bed_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `bed_status` int(10) unsigned NOT NULL DEFAULT '0',
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beds_bed_no_unique` (`bed_no`),
  KEY `beds_ward_no_foreign` (`ward_no`),
  KEY `beds_from_user_foreign` (`from_user`),
  CONSTRAINT `beds_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `beds_ward_no_foreign` FOREIGN KEY (`ward_no`) REFERENCES `wards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beds`
--

LOCK TABLES `beds` WRITE;
/*!40000 ALTER TABLE `beds` DISABLE KEYS */;
/*!40000 ALTER TABLE `beds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosis`
--

DROP TABLE IF EXISTS `diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnosis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `on_patient` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `drug_id` int(10) unsigned NOT NULL DEFAULT '0',
  `diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diagnosis_from_user_foreign` (`from_user`),
  CONSTRAINT `diagnosis_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosis`
--

LOCK TABLES `diagnosis` WRITE;
/*!40000 ALTER TABLE `diagnosis` DISABLE KEYS */;
INSERT INTO `diagnosis` VALUES (1,2,2,0,'Cold Flu administered','2010-05-06 00:00:00','2016-11-24 00:00:00','This was a slight cold administered.',4,'2016-11-05 17:23:30','2016-11-05 17:23:30');
/*!40000 ALTER TABLE `diagnosis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispensations`
--

DROP TABLE IF EXISTS `dispensations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispensations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `on_patient` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `quantity_left` int(11) NOT NULL,
  `quantity_consumed` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0',
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dispensations_from_user_foreign` (`from_user`),
  CONSTRAINT `dispensations_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispensations`
--

LOCK TABLES `dispensations` WRITE;
/*!40000 ALTER TABLE `dispensations` DISABLE KEYS */;
INSERT INTO `dispensations` VALUES (1,2,1,2,1,482,18,0,0,4,'2016-11-05 19:24:47','2016-11-05 19:24:47');
/*!40000 ALTER TABLE `dispensations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examinations`
--

DROP TABLE IF EXISTS `examinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examinations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examinations`
--

LOCK TABLES `examinations` WRITE;
/*!40000 ALTER TABLE `examinations` DISABLE KEYS */;
INSERT INTO `examinations` VALUES (1,1,1,1,2,4,'2016-11-04 04:31:14','2016-11-04 04:37:54'),(2,2,2,1,1,4,'2016-11-04 04:46:47','2016-11-04 04:47:41'),(3,3,3,1,1,4,'2016-11-04 05:14:12','2016-11-04 05:14:35');
/*!40000 ALTER TABLE `examinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `history` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `histories_on_patient_foreign` (`on_patient`),
  KEY `histories_from_user_foreign` (`from_user`),
  CONSTRAINT `histories_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `histories_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histories`
--

LOCK TABLES `histories` WRITE;
/*!40000 ALTER TABLE `histories` DISABLE KEYS */;
INSERT INTO `histories` VALUES (1,2,2,'Diabetes','Sister','2016-11-05','2016-11-12','Alive','Sister had diagnosis',4,'2016-11-05 17:29:45','2016-11-05 17:29:45');
/*!40000 ALTER TABLE `histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immunizations`
--

DROP TABLE IF EXISTS `immunizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immunizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `vaccine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_administered` datetime NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `immunizations_on_patient_foreign` (`on_patient`),
  KEY `immunizations_from_user_foreign` (`from_user`),
  CONSTRAINT `immunizations_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `immunizations_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immunizations`
--

LOCK TABLES `immunizations` WRITE;
/*!40000 ALTER TABLE `immunizations` DISABLE KEYS */;
INSERT INTO `immunizations` VALUES (1,2,2,'Hepatitis B','2016-11-05 00:00:00',4,'2016-11-05 17:23:58','2016-11-05 17:23:58');
/*!40000 ALTER TABLE `immunizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurances`
--

DROP TABLE IF EXISTS `insurances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `payment_id` int(10) unsigned NOT NULL,
  `on_patient` int(10) unsigned NOT NULL,
  `insurance_identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `cost` double NOT NULL,
  `insurance_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insurances_on_patient_foreign` (`on_patient`),
  KEY `insurances_service_id_foreign` (`service_id`),
  KEY `insurances_from_user_foreign` (`from_user`),
  CONSTRAINT `insurances_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `insurances_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`),
  CONSTRAINT `insurances_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurances`
--

LOCK TABLES `insurances` WRITE;
/*!40000 ALTER TABLE `insurances` DISABLE KEYS */;
INSERT INTO `insurances` VALUES (1,2,0,2,'sdf',1,500,'adfa',5,'2016-11-06 15:22:28','2016-11-06 15:22:28');
/*!40000 ALTER TABLE `insurances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drug_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drug_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formulation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `per_cost` double DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventories_from_user_foreign` (`from_user`),
  CONSTRAINT `inventories_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (1,'D-1','Panadol','Tablets','Active',482,2,NULL,6,'2016-11-05 19:20:51','2016-11-05 19:24:47');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs`
--

DROP TABLE IF EXISTS `labs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL,
  `lab_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lab_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `lab_review` text COLLATE utf8_unicode_ci,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `lab_document` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `labs_on_patient_foreign` (`on_patient`),
  KEY `labs_from_user_foreign` (`from_user`),
  CONSTRAINT `labs_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `labs_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs`
--

LOCK TABLES `labs` WRITE;
/*!40000 ALTER TABLE `labs` DISABLE KEYS */;
INSERT INTO `labs` VALUES (1,2,2,'Knee Scan','Should be made from below the knee.','Reviewed',2,NULL,4,'2016-11-05 19:34:21','2016-11-05 20:08:54');
/*!40000 ALTER TABLE `labs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medications`
--

DROP TABLE IF EXISTS `medications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `on_patient` int(11) NOT NULL,
  `quantity_consumed` int(11) NOT NULL,
  `times_a_day` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medications_from_user_foreign` (`from_user`),
  CONSTRAINT `medications_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medications`
--

LOCK TABLES `medications` WRITE;
/*!40000 ALTER TABLE `medications` DISABLE KEYS */;
INSERT INTO `medications` VALUES (1,2,1,2,3,3,2,'To be taken after meals.','2016-11-06 00:00:00','2016-11-08 00:00:00',4,'2016-11-05 19:24:46','2016-11-05 19:24:46');
/*!40000 ALTER TABLE `medications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_12_31_192630_create_roles_table',1),('2015_12_31_192639_create_role_user_table',1),('2016_07_05_140723_create_services_table',1),('2016_07_05_180901_create_patients_table',1),('2016_07_06_145951_create_appointments_table',1),('2016_07_09_162112_create_inventories_table',1),('2016_07_10_144146_create_insurance_table',1),('2016_07_11_094224_create_payments_table',1),('2016_07_14_181213_create_vitals_table',1),('2016_07_18_211435_create_medications_table',1),('2016_07_19_190407_create_dispensations_table',1),('2016_07_25_181551_create_refills_table',1),('2016_08_11_220551_create_diagnosis_table',1),('2016_08_12_102051_create_immunizations_table',1),('2016_08_12_123328_create_therapies_table',1),('2016_08_12_141025_create_procedures_table',1),('2016_08_12_161810_create_history_table',1),('2016_08_13_191116_create_allergies_table',1),('2016_08_19_111542_create_labs_table',1),('2016_08_24_083110_create_wards_table',1),('2016_08_24_093240_create_bed_table',1),('2016_09_30_145815_create_triages_table',1),('2016_09_30_215023_create_secondary_vitals_table',1),('2016_10_13_201848_create_activity_log_table',1),('2016_10_21_161410_create_examinations_table',1),('2016_10_28_221850_create_activity_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `med_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `estimated_age` int(11) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residence` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_origin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_med_id_unique` (`med_id`),
  KEY `patients_from_user_foreign` (`from_user`),
  CONSTRAINT `patients_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'Med ID: 1','dsafsdf','fdsaf','fdsaf','2016-11-02',NULL,'Female','454534','343434','Dfsds@esws.com','asdsada','Nairobi County','Kenya',1,'2016-11-04 04:29:27','2016-11-04 04:29:27'),(2,'Med ID: 2','uy','tyu','tyut','2016-11-11',NULL,'Male','6757657','675','jhkjhdasd@yahoo.com','uiytui','Nairobi County','Kenya',1,'2016-11-04 04:45:18','2016-11-04 04:45:18'),(3,'Med ID: 3','dfasd','fdslkjs','fskdj','2016-11-09',NULL,'Male','00076434','54564','67567@fd.vo','Mathare','Nairobi County','Kenya',1,'2016-11-04 05:13:13','2016-11-04 05:13:13');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `drug_id` int(10) unsigned NOT NULL DEFAULT '0',
  `on_patient` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `cost` double NOT NULL,
  `insurance_id` int(10) unsigned NOT NULL DEFAULT '0',
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_from_user_foreign` (`from_user`),
  CONSTRAINT `payments_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,0,1,1,1,500,0,1,'2016-11-04 04:30:05','2016-11-04 04:30:47'),(2,2,0,2,1,1,500,0,1,'2016-11-04 04:45:39','2016-11-04 04:46:07'),(3,3,0,3,1,1,500,0,1,'2016-11-04 05:13:25','2016-11-04 05:13:48'),(4,2,1,2,1,1,500,0,4,'2016-11-05 19:24:47','2016-11-06 15:22:28'),(5,2,0,2,1,5,1200,0,4,'2016-11-05 19:34:21','2016-11-05 20:05:53');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedures`
--

DROP TABLE IF EXISTS `procedures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `procedure_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `procedure_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `procedure_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `procedures_on_patient_foreign` (`on_patient`),
  KEY `procedures_from_user_foreign` (`from_user`),
  CONSTRAINT `procedures_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `procedures_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedures`
--

LOCK TABLES `procedures` WRITE;
/*!40000 ALTER TABLE `procedures` DISABLE KEYS */;
INSERT INTO `procedures` VALUES (1,2,2,'Knee Surgery ','Surgery','Slight dislocation','2016-11-05 00:00:00','2016-11-08 00:00:00',3,4,'2016-11-05 17:28:54','2016-11-05 17:28:54');
/*!40000 ALTER TABLE `procedures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refills`
--

DROP TABLE IF EXISTS `refills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drug_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drug_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formulation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refills_from_user_foreign` (`from_user`),
  CONSTRAINT `refills_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refills`
--

LOCK TABLES `refills` WRITE;
/*!40000 ALTER TABLE `refills` DISABLE KEYS */;
/*!40000 ALTER TABLE `refills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_index` (`user_id`),
  KEY `role_user_role_id_index` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,8,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(2,1,1,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(3,1,2,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(4,1,3,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(5,1,4,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(6,1,5,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(7,1,6,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(8,1,7,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(9,2,1,'2016-11-04 04:25:45','2016-11-04 04:25:45'),(10,3,2,'2016-11-04 04:25:46','2016-11-04 04:25:46'),(11,4,3,'2016-11-04 04:25:46','2016-11-04 04:25:46'),(12,5,4,'2016-11-04 04:25:46','2016-11-04 04:25:46'),(13,6,5,'2016-11-04 04:25:46','2016-11-04 04:25:46'),(14,7,6,'2016-11-04 04:25:47','2016-11-04 04:25:47'),(15,8,7,'2016-11-04 04:25:47','2016-11-04 04:25:47');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'receptionist','2016-11-04 04:25:44','2016-11-04 04:25:44'),(2,'triage','2016-11-04 04:25:44','2016-11-04 04:25:44'),(3,'doctor','2016-11-04 04:25:44','2016-11-04 04:25:44'),(4,'accountant','2016-11-04 04:25:44','2016-11-04 04:25:44'),(5,'pharmacy','2016-11-04 04:25:44','2016-11-04 04:25:44'),(6,'nurse','2016-11-04 04:25:44','2016-11-04 04:25:44'),(7,'laboratorist','2016-11-04 04:25:44','2016-11-04 04:25:44'),(8,'administrator','2016-11-04 04:25:44','2016-11-04 04:25:44');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secondary_vitals`
--

DROP TABLE IF EXISTS `secondary_vitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secondary_vitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(11) NOT NULL,
  `cardiovascular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `respiratory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abdomen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_sugar` int(11) NOT NULL,
  `stool` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hiv_I_II` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `haemoglobin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `conclusion` text COLLATE utf8_unicode_ci NOT NULL,
  `name_designate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `secondary_vitals_from_user_foreign` (`from_user`),
  CONSTRAINT `secondary_vitals_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secondary_vitals`
--

LOCK TABLES `secondary_vitals` WRITE;
/*!40000 ALTER TABLE `secondary_vitals` DISABLE KEYS */;
/*!40000 ALTER TABLE `secondary_vitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_from_user_foreign` (`from_user`),
  CONSTRAINT `services_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Consultation',500,1,1,'2016-11-04 04:25:47','2016-11-04 04:25:47'),(2,'Medical Certificate',1000,1,1,'2016-11-04 04:25:47','2016-11-04 04:25:47'),(3,'X - Ray Scan',1200,1,1,'2016-11-04 04:25:47','2016-11-04 04:25:47'),(4,'Dentist',2000,1,5,'2016-11-05 20:02:47','2016-11-05 20:02:47'),(5,'Lab',500,1,5,'2016-11-05 20:03:01','2016-11-05 20:03:01');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `therapies`
--

DROP TABLE IF EXISTS `therapies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `therapies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `therapy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_administered` datetime NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `therapies_on_patient_foreign` (`on_patient`),
  KEY `therapies_from_user_foreign` (`from_user`),
  CONSTRAINT `therapies_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `therapies_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `therapies`
--

LOCK TABLES `therapies` WRITE;
/*!40000 ALTER TABLE `therapies` DISABLE KEYS */;
INSERT INTO `therapies` VALUES (1,2,2,'Spinal Therapy','2016-11-05 00:00:00',4,'2016-11-05 17:25:19','2016-11-05 17:25:19');
/*!40000 ALTER TABLE `therapies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `triage_vitals`
--

DROP TABLE IF EXISTS `triage_vitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `triage_vitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(10) unsigned NOT NULL DEFAULT '0',
  `service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `triage_vitals_on_patient_foreign` (`on_patient`),
  KEY `triage_vitals_service_id_foreign` (`service_id`),
  KEY `triage_vitals_from_user_foreign` (`from_user`),
  CONSTRAINT `triage_vitals_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `triage_vitals_on_patient_foreign` FOREIGN KEY (`on_patient`) REFERENCES `patients` (`id`),
  CONSTRAINT `triage_vitals_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `triage_vitals`
--

LOCK TABLES `triage_vitals` WRITE;
/*!40000 ALTER TABLE `triage_vitals` DISABLE KEYS */;
INSERT INTO `triage_vitals` VALUES (1,1,1,1,1,1,'2016-11-04 04:30:47','2016-11-04 04:31:14'),(2,2,2,1,1,1,'2016-11-04 04:46:07','2016-11-04 04:46:47'),(3,3,3,1,1,1,'2016-11-04 05:13:48','2016-11-04 05:14:12'),(4,2,2,1,0,5,'2016-11-06 15:22:28','2016-11-06 15:22:28');
/*!40000 ALTER TABLE `triage_vitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_name_unique` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Valentine Mwangi','admin','$2y$10$jb6/t6oyigRP1rpa9gKZM.eb8L4bax.P3Cz4fBZFinJIVszQli8wO','999999','','','Lyq6LXleTFKg1mVLKnMRrA1fEJjBxrdA8q5ehr7tHmnSLjoFvIB31SB3Zw23','2016-11-04 04:25:45','2016-11-04 05:14:17'),(2,'Valentine Mwangi','reception','$2y$10$RV0gbrZW0gjO54ZcwkGzReqPJreMfXIZjUqGUF1bKx0ILLE0wUZ0i','123456','','','ehP3PWio6emhP5VHxMZ8sFBD3AFW7UHEfsHzRQdvtMB1SX4cK4bDjmuKwUOg','2016-11-04 04:25:45','2016-11-05 15:13:36'),(3,'Valentine Mwangi','triage','$2y$10$U4.vBWZqkithjn7S8CKuHOdsJvhoBPdeQ5VI/Dts9tx7hPTx6EM56','123486','','','XITzpW0IhNAk1So5YOKCrVnratdwzCcbBg9c62vrM5fgjBcvPEpbTTfW5YF2','2016-11-04 04:25:45','2016-11-05 17:08:32'),(4,'Valentine Mwangi','doctor','$2y$10$ls6JSAUdsnWq6yR6iNvwtO8PZ4hZTyrl6D2Jz/tjELV8lSb8ckM/W','123422','','','D8F9Q1uwF1uaNj1GU6TenqGDCPnEVrxbJr4LiAxXNZriqgDltI7ynRm7r0uG','2016-11-04 04:25:46','2016-11-05 20:12:30'),(5,'Valentine Mwangi','accounts','$2y$10$yUzK0U6Q0ytLK9wwwZSm7.5O0O/8Jx0zQkwUPYr769zuO9koaXfCS','333456','','','M5yS3fBQg5iioJCAqeIX1p3mlFPmNfQT3Weki3aZ99qxSOLb9KGadf0HHEul','2016-11-04 04:25:46','2016-11-06 15:22:36'),(6,'Valentine Mwangi','pharmacy','$2y$10$XuKtkjGlbMQCM2T4c3yOZOMP86.39pgb.HjKym.ot7Byt03RS/u7u','223456','','','suU40jEWjKwD3mKIbrCyHnrJHumltVpYlbJ0ekGk4Xm3w3Miuy5OAHlQ3sCm','2016-11-04 04:25:46','2016-11-06 15:25:30'),(7,'Valentine Mwangi','nurse','$2y$10$e9.j7a6KpY4rhSj7kFo8TujZycWiJHJ3jY7KoesNg/My76nW668T.','1233456','','',NULL,'2016-11-04 04:25:47','2016-11-04 04:25:47'),(8,'Valentine Mwangi','laboratory','$2y$10$bjjzJ3hFAJJhfQ.ewsG/Sun2/ulv2sxoqb9VgrJ0IfQQ4Y88bH7qO','1234256','','','td5UOdq1Bi83R56XOPONBu9mfFLI6GeSHnuCmJWhlTxkrrgGDcFoB1x9JdgQ','2016-11-04 04:25:47','2016-11-05 20:06:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vitals`
--

DROP TABLE IF EXISTS `vitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `on_patient` int(11) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `bmi` double NOT NULL,
  `blood_pressure` double NOT NULL,
  `pulse` double NOT NULL,
  `temperature` double NOT NULL,
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vitals_from_user_foreign` (`from_user`),
  CONSTRAINT `vitals_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vitals`
--

LOCK TABLES `vitals` WRITE;
/*!40000 ALTER TABLE `vitals` DISABLE KEYS */;
INSERT INTO `vitals` VALUES (1,0,1,32,23,23,32,32,23,1,'2016-11-04 04:31:14','2016-11-04 04:31:14'),(2,0,2,32,32,23,23,32,32,1,'2016-11-04 04:46:47','2016-11-04 04:46:47'),(3,0,3,23,23,23,23,23,32,1,'2016-11-04 05:14:12','2016-11-04 05:14:12');
/*!40000 ALTER TABLE `vitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wards`
--

DROP TABLE IF EXISTS `wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ward_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `ward_capacity` int(11) NOT NULL,
  `ward_occupied` int(10) unsigned NOT NULL DEFAULT '0',
  `ward_status` int(10) unsigned NOT NULL DEFAULT '0',
  `from_user` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wards_ward_name_unique` (`ward_name`),
  KEY `wards_from_user_foreign` (`from_user`),
  CONSTRAINT `wards_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wards`
--

LOCK TABLES `wards` WRITE;
/*!40000 ALTER TABLE `wards` DISABLE KEYS */;
/*!40000 ALTER TABLE `wards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-06 21:46:03

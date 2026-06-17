-- ============================================================
-- BASE DE DATOS: clinicamedica_stm
-- Generado desde archivos individuales del ZIP
-- ============================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = '+00:00';
/*!40101 SET NAMES utf8mb4 */;


-- ============================================================
-- TABLA: migrations
-- ============================================================

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_16_104442_create_permission_tables',1);
UNLOCK TABLES;

-- ============================================================
-- TABLA: cache
-- ============================================================

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: cache_locks
-- ============================================================

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: sessions
-- ============================================================

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: password_reset_tokens
-- ============================================================

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

UNLOCK TABLES;

-- ============================================================
-- TABLA: failed_jobs
-- ============================================================

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: job_batches
-- ============================================================

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: jobs
-- ============================================================

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: roles
-- ============================================================

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` VALUES (1,'admin','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(2,'doctor','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(3,'recepcionista','web','2026-06-16 16:54:55','2026-06-16 16:54:55');
UNLOCK TABLES;

-- ============================================================
-- TABLA: permissions
-- ============================================================

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` VALUES (1,'dashboard.ver','web','2026-06-16 16:54:54','2026-06-16 16:54:54'),(2,'pacientes.ver','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(3,'pacientes.crear','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(4,'pacientes.editar','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(5,'pacientes.eliminar','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(6,'citas.ver','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(7,'citas.crear','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(8,'citas.editar','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(9,'usuarios.ver','web','2026-06-16 16:54:55','2026-06-16 16:54:55'),(10,'usuarios.crear','web','2026-06-16 16:54:55','2026-06-16 16:54:55');
UNLOCK TABLES;

-- ============================================================
-- TABLA: role_has_permissions
-- ============================================================

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(1,2),(2,2),(4,2),(6,2),(1,3),(2,3),(3,3),(6,3),(7,3),(8,3);
UNLOCK TABLES;

-- ============================================================
-- TABLA: users
-- ============================================================

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: usuarios
-- ============================================================

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('Administrador','Secretaria','Médico General','Médico Pediatra') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` VALUES (1,'admin','Admin@2024!','Administrador','2026-06-12 08:00:00','2026-06-12 08:00:00'),(2,'secretaria','Secre@2024!','Secretaria','2026-06-12 08:00:00','2026-06-12 08:00:00'),(3,'medico_general','MedGen@2024!','Médico General','2026-06-12 08:00:00','2026-06-12 08:00:00'),(4,'medico_pediatra','MedPed@2024!','Médico Pediatra','2026-06-12 08:00:00','2026-06-12 08:00:00');
UNLOCK TABLES;

-- ============================================================
-- TABLA: model_has_roles
-- ============================================================

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: model_has_permissions
-- ============================================================

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

UNLOCK TABLES;

-- ============================================================
-- TABLA: medicos
-- ============================================================

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicos` (
  `dui` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dui`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` VALUES ('00112233-4','Juan Carlos','Martínez','Medicina General','7012-3456','2026-06-12 08:00:00','2026-06-12 08:00:00'),('00223344-5','Laura Elena','García','Pediatría','7023-4567','2026-06-12 08:00:00','2026-06-12 08:00:00');
UNLOCK TABLES;

-- ============================================================
-- TABLA: pacientes
-- ============================================================

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes` (
  `dui` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` text,
  `alergias` text,
  `anotaciones` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dui`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` VALUES ('00000001-1','María','González','7222-0001',34,'1990-03-15','Col. Escalón, San Salvador',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('00000002-2','José','Hernández','7222-0002',45,'1979-07-20','Soyapango',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('00000003-3','Ana','Martínez','7222-0003',28,'1996-11-05','Santa Tecla',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('11111111-1','Martha Elena','Sánchez','6987-6543',29,'1995-12-03','Colonia Médica #12',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('12345678-9','Ana María','Rodríguez','6123-4567',34,'1990-05-15','Calle Los Pinos #123, Col. Centro',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('22222222-2','Roberto Carlos','Flores','6700-1122',38,'1986-09-25','Paseo General Escalón #567',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('33333333-3','Laura Patricia','Gómez','6890-1234',31,'1993-07-18','Residencial San Luis #45',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('44444444-4','José Antonio','Ramírez','6567-8901',52,'1972-11-30','Colonia Escalón #321',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('55555555-5','Diego Fernando','López','6345-7890',8,'2016-03-10','Boulevard Los Próceres #789',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00'),('98765432-1','Carlos Eduardo','Méndez','6789-0123',45,'1979-08-22','Avenida Reforma #456',NULL,NULL,'2026-06-12 08:00:00','2026-06-12 08:00:00');
UNLOCK TABLES;

-- ============================================================
-- TABLA: medicamentos
-- ============================================================

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamentos` (
  `id_medicamento` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `presentacion` varchar(100) DEFAULT NULL COMMENT 'Tabletas, Jarabe, Cápsulas, Crema, Inhalador...',
  `concentracion` varchar(100) DEFAULT NULL COMMENT '500mg, 250mg/5ml, 1%...',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

INSERT INTO `medicamentos` VALUES (1,'Ibuprofeno','Tabletas','400mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(2,'Ibuprofeno','Tabletas','600mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(3,'Ibuprofeno','Suspensión','100mg/5ml',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(4,'Paracetamol','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(5,'Paracetamol','Jarabe','120mg/5ml',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(6,'Naproxeno','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(7,'Diclofenaco','Tabletas','50mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(8,'Diclofenaco','Gel','1%',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(9,'Ketorolaco','Tabletas','10mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(10,'Metamizol','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(11,'Amoxicilina','Cápsulas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(12,'Amoxicilina','Suspensión','250mg/5ml',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(13,'Amoxicilina/Clavulanato','Tabletas','875mg/125mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(14,'Azitromicina','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(15,'Ciprofloxacino','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(16,'Claritromicina','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(17,'Cefalexina','Cápsulas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(18,'Metronidazol','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(19,'Trimetoprim/Sulfa','Tabletas','160mg/800mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(20,'Doxiciclina','Cápsulas','100mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(21,'Omeprazol','Cápsulas','20mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(22,'Omeprazol','Cápsulas','40mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(23,'Ranitidina','Tabletas','150mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(24,'Metoclopramida','Tabletas','10mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(25,'Loperamida','Cápsulas','2mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(26,'Sales de Rehidratación','Polvo','27.9g/sobre',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(27,'Losartán','Tabletas','50mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(28,'Losartán','Tabletas','100mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(29,'Enalapril','Tabletas','10mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(30,'Amlodipino','Tabletas','5mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(31,'Atorvastatina','Tabletas','20mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(32,'Atorvastatina','Tabletas','40mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(33,'Metoprolol','Tabletas','50mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(34,'Metformina','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(35,'Metformina','Tabletas','850mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(36,'Glibenclamida','Tabletas','5mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(37,'Salbutamol','Inhalador','100mcg/dosis',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(38,'Cetirizina','Tabletas','10mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(39,'Loratadina','Tabletas','10mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(40,'Dexametasona','Tabletas','4mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(41,'Dexametasona','Ampolleta','4mg/2ml',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(42,'Prednisona','Tabletas','5mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(43,'Vitamina C','Tabletas','500mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(44,'Vitamina D3','Tabletas','1000 UI',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(45,'Sulfato Ferroso','Tabletas','300mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(46,'Ácido Fólico','Tabletas','5mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(47,'Clotrimazol','Crema','1%',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(48,'Fluconazol','Cápsulas','150mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(49,'Alprazolam','Tabletas','0.5mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09'),(50,'Tramadol','Cápsulas','50mg',1,'2026-06-13 22:57:09','2026-06-13 22:57:09');
UNLOCK TABLES;

-- ============================================================
-- TABLA: citas
-- ============================================================

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `dui_paciente` varchar(10) NOT NULL,
  `dui_medico` varchar(10) NOT NULL,
  `tipo_cita` enum('consulta','control','urgencia','pediatria','general') DEFAULT 'consulta',
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` text NOT NULL,
  `estado` enum('programada','confirmada','pendiente','completada','cancelada') DEFAULT 'programada',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cita`),
  KEY `fk_cita_paciente` (`dui_paciente`),
  KEY `fk_cita_medico` (`dui_medico`),
  CONSTRAINT `fk_cita_medico` FOREIGN KEY (`dui_medico`) REFERENCES `medicos` (`dui`) ON DELETE CASCADE,
  CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`dui_paciente`) REFERENCES `pacientes` (`dui`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` VALUES (1,'12345678-9','00112233-4','consulta','2026-06-10','09:00:00','Dolor de cabeza persistente','completada','2026-06-09 08:00:00','2026-06-10 09:45:00'),(2,'98765432-1','00112233-4','control','2026-06-10','10:30:00','Control de diabetes y presión arterial','completada','2026-06-09 08:00:00','2026-06-10 11:15:00'),(3,'55555555-5','00223344-5','pediatria','2026-06-11','11:00:00','Control de crecimiento infantil','completada','2026-06-10 08:00:00','2026-06-11 11:50:00'),(4,'44444444-4','00112233-4','consulta','2026-06-11','14:00:00','Dolor en el pecho','completada','2026-06-11 13:00:00','2026-06-11 15:20:00'),(5,'00000002-2','00112233-4','control','2026-06-12','08:30:00','Revisión post-operatoria de rodilla','completada','2026-06-11 10:00:00','2026-06-12 09:10:00'),(6,'00000003-3','00112233-4','consulta','2026-06-12','10:00:00','Fatiga crónica y mareos frecuentes','completada','2026-06-11 10:00:00','2026-06-12 10:50:00'),(7,'33333333-3','00223344-5','pediatria','2026-06-12','11:30:00','Acompañante de hijo: fiebre recurrente','completada','2026-06-11 12:00:00','2026-06-12 12:15:00'),(8,'11111111-1','00112233-4','consulta','2026-06-09','08:00:00','Revisión general','cancelada','2026-06-08 08:00:00','2026-06-09 07:00:00'),(9,'22222222-2','00112233-4','consulta','2026-06-11','09:00:00','Dolor lumbar intenso','cancelada','2026-06-10 08:00:00','2026-06-11 07:30:00'),(10,'12345678-9','00112233-4','control','2026-06-25','10:00:00','Control post-tratamiento cefalea','programada','2026-06-13 08:00:00','2026-06-13 08:00:00'),(11,'98765432-1','00112233-4','control','2026-06-27','09:00:00','Control mensual de diabetes','completada','2026-06-13 08:00:00','2026-06-16 00:37:26'),(12,'00000001-1','00223344-5','general','2026-06-20','08:00:00','Primera consulta — chequeo general','programada','2026-06-13 08:00:00','2026-06-13 08:00:00');
UNLOCK TABLES;

-- ============================================================
-- TABLA: consultas
-- ============================================================

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `id_consulta` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `dui_paciente` varchar(10) NOT NULL,
  `dui_medico` varchar(10) NOT NULL,
  `diagnostico` text,
  `notas` text,
  `tratamiento` text,
  `fecha_consulta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_consulta`),
  UNIQUE KEY `uq_cita` (`id_cita`),
  KEY `dui_paciente` (`dui_paciente`),
  KEY `dui_medico` (`dui_medico`),
  CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`dui_paciente`) REFERENCES `pacientes` (`dui`),
  CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`dui_medico`) REFERENCES `medicos` (`dui`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` VALUES (1,1,'12345678-9','00112233-4','Cefalea tensional crónica','Paciente refiere dolor de cabeza persistente desde hace 2 semanas. PA: 120/80. Sin fiebre. Tensión en zona cervical.','Ibuprofeno 400mg cada 8h por 5 días. Aplicar calor en zona cervical. Evitar pantallas prolongadas. Control en 2 semanas.','2026-06-10 09:42:00'),(2,2,'98765432-1','00112233-4','Diabetes mellitus tipo 2 con hipertensión arterial controlada','Paciente en control periódico. Glucosa en ayunas: 142 mg/dL. PA: 135/88. Refiere cumplimiento del tratamiento.','Continuar Metformina 850mg cada 12h. Losartán 50mg diario. Dieta baja en carbohidratos y sal. Control en 4 semanas.','2026-06-10 11:08:00'),(3,3,'55555555-5','00223344-5','Desarrollo pondoestatural normal para la edad','Paciente de 8 años en control de rutina. Peso: 26 kg. Talla: 128 cm. Percentil 50. Vacunas al día.','Sin medicación requerida. Dieta balanceada y actividad física regular. Próximo control en 6 meses.','2026-06-11 11:35:00'),(4,4,'44444444-4','00112233-4','Dolor torácico atípico. Se descarta síndrome coronario agudo.','Paciente de 52 años con dolor en pecho de 3h de evolución. ECG normal. Troponinas negativas. PA: 145/92.','Naproxeno 500mg cada 12h por 5 días. Reposo relativo. Se solicita ecocardiograma. Acudir a urgencias si el dolor se repite.','2026-06-11 15:10:00'),(5,5,'00000002-2','00112233-4','Evolución satisfactoria post-operatoria de rodilla derecha','Paciente refiere mejoría progresiva. Leve inflamación residual. Sin signos de infección. Movilidad al 70%.','Diclofenaco 50mg cada 8h por 3 días. Fisioterapia 3 veces por semana. Reposo deportivo por 4 semanas.','2026-06-12 09:05:00'),(6,6,'00000003-3','00112233-4','Síndrome de fatiga crónica. Probable anemia ferropénica.','Paciente refiere cansancio extremo y mareos al levantarse. Hemoglobina: 10.2 g/dL. PA: 100/65. FC: 88 lpm.','Sulfato Ferroso 300mg diario con vitamina C. Dieta rica en hierro. Evitar té y café con las comidas. Control en 3 semanas.','2026-06-12 10:45:00'),(7,7,'33333333-3','00223344-5','Infección respiratoria alta en paciente pediátrico. Faringitis bacteriana.','Niño de 5 años con fiebre de 38.5°C por 3 días, odinofagia y congestión nasal. Garganta eritematosa con exudado.','Amoxicilina 250mg/5ml suspensión: 5ml cada 8h por 7 días. Paracetamol 120mg/5ml si fiebre. Reposo escolar 3 días.','2026-06-12 12:10:00'),(8,11,'98765432-1','00112233-4',NULL,NULL,NULL,'2026-06-15 18:37:26');
UNLOCK TABLES;

-- ============================================================
-- TABLA: emergencias
-- ============================================================

DROP TABLE IF EXISTS `emergencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergencias` (
  `id_emergencia` int unsigned NOT NULL AUTO_INCREMENT,
  `dui_paciente` varchar(10) NOT NULL,
  `dui_medico` varchar(10) NOT NULL,
  `motivo` text NOT NULL,
  `nivel_urgencia` enum('alta','media','baja') NOT NULL DEFAULT 'alta',
  `estado` enum('pendiente','atendida','cancelada') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_emergencia`),
  KEY `fk_emerg_paciente` (`dui_paciente`),
  KEY `fk_emerg_medico` (`dui_medico`),
  CONSTRAINT `fk_emerg_medico` FOREIGN KEY (`dui_medico`) REFERENCES `medicos` (`dui`) ON DELETE CASCADE,
  CONSTRAINT `fk_emerg_paciente` FOREIGN KEY (`dui_paciente`) REFERENCES `pacientes` (`dui`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencias`
--

INSERT INTO `emergencias` VALUES (1,'12345678-9','00112233-4','Dolor de cabeza intenso con náuseas y vómitos','alta','atendida','2026-06-09 07:30:00','2026-06-09 08:15:00'),(2,'44444444-4','00112233-4','Dolor en el pecho y dificultad para respirar','alta','atendida','2026-06-11 13:50:00','2026-06-11 14:20:00'),(3,'55555555-5','00223344-5','Fiebre alta de 39.5°C en paciente pediátrico','media','atendida','2026-06-12 08:00:00','2026-06-12 08:40:00'),(4,'22222222-2','00112233-4','Caída con posible fractura en muñeca izquierda','media','pendiente','2026-06-13 07:15:00','2026-06-13 07:15:00'),(5,'00000001-1','00223344-5','Reacción alérgica con urticaria generalizada','alta','atendida','2026-06-13 07:50:00','2026-06-15 22:11:41');
UNLOCK TABLES;

-- ============================================================
-- TABLA: recetas
-- ============================================================

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recetas` (
  `id_receta` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `id_medicamento` int unsigned NOT NULL,
  `dosis` varchar(100) DEFAULT NULL COMMENT 'Ej: 1 tableta, 5ml',
  `frecuencia` varchar(100) DEFAULT NULL COMMENT 'Ej: cada 8 horas, 2 veces al día',
  `duracion` varchar(100) DEFAULT NULL COMMENT 'Ej: 5 días, 1 mes',
  `instrucciones` text COMMENT 'Notas específicas del medicamento',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_receta`),
  KEY `fk_receta_cita` (`id_cita`),
  KEY `fk_receta_medicamento` (`id_medicamento`),
  CONSTRAINT `fk_receta_cita` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`) ON DELETE CASCADE,
  CONSTRAINT `fk_receta_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id_medicamento`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas`
--

INSERT INTO `recetas` VALUES (1,7,12,'tableta 1','cada 8 horas','4 dias',NULL,'2026-06-15 16:55:39','2026-06-15 16:55:39'),(2,7,13,'tableta 1','cada 8 horas','4 dias',NULL,'2026-06-15 17:17:24','2026-06-15 17:17:24');
UNLOCK TABLES;

-- ============================================================
-- TABLA: facturas
-- ============================================================

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `id_factura` int unsigned NOT NULL AUTO_INCREMENT,
  `dui_paciente` varchar(10) NOT NULL,
  `dui_medico` varchar(10) DEFAULT NULL,
  `ref_id` int DEFAULT NULL COMMENT 'id_cita o id_emergencia',
  `ref_tipo` enum('consulta','emergencia') NOT NULL DEFAULT 'consulta',
  `tipo_atencion` enum('consulta','emergencia') NOT NULL DEFAULT 'consulta',
  `concepto` text NOT NULL,
  `monto_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `forma_pago` enum('efectivo','tarjeta','transferencia') NOT NULL DEFAULT 'efectivo',
  `estado` enum('pagada','pendiente','anulada') NOT NULL DEFAULT 'pagada',
  `observaciones` text,
  `email` varchar(150) DEFAULT NULL,
  `fecha_emision` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_factura`),
  KEY `fk_fac_paciente` (`dui_paciente`),
  KEY `fk_fac_medico` (`dui_medico`),
  CONSTRAINT `fk_fac_medico` FOREIGN KEY (`dui_medico`) REFERENCES `medicos` (`dui`) ON DELETE SET NULL,
  CONSTRAINT `fk_fac_paciente` FOREIGN KEY (`dui_paciente`) REFERENCES `pacientes` (`dui`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` VALUES (1,'12345678-9','00112233-4',1,'consulta','consulta','Consulta médica: Dolor de cabeza persistente',25.00,'efectivo','pagada',NULL,NULL,'2026-06-10 16:00:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(2,'98765432-1','00112233-4',2,'consulta','consulta','Consulta médica: Control de diabetes y presión arterial',30.00,'tarjeta','pagada',NULL,NULL,'2026-06-10 17:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(3,'55555555-5','00223344-5',3,'consulta','consulta','Consulta médica: Control de crecimiento infantil',20.00,'efectivo','pagada','Paciente pediátrico',NULL,'2026-06-11 18:00:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(4,'44444444-4','00112233-4',4,'consulta','consulta','Consulta médica: Dolor en el pecho',35.00,'efectivo','pagada',NULL,NULL,'2026-06-11 21:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(5,'00000002-2','00112233-4',5,'consulta','consulta','Consulta médica: Revisión post-operatoria de rodilla',25.00,'transferencia','pagada',NULL,NULL,'2026-06-12 15:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(6,'00000003-3','00112233-4',6,'consulta','consulta','Consulta médica: Fatiga crónica y mareos frecuentes',25.00,'efectivo','pagada',NULL,NULL,'2026-06-12 17:00:00','2026-06-15 21:21:22','2026-06-16 00:35:56'),(7,'33333333-3','00223344-5',7,'consulta','consulta','Consulta médica: Fiebre recurrente en hijo',20.00,'efectivo','pagada',NULL,NULL,'2026-06-12 18:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(8,'12345678-9','00112233-4',1,'emergencia','emergencia','Atención de emergencia: Dolor de cabeza intenso con náuseas',50.00,'efectivo','pagada',NULL,NULL,'2026-06-09 14:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(9,'44444444-4','00112233-4',2,'emergencia','emergencia','Atención de emergencia: Dolor en el pecho y dificultad para respirar',75.00,'tarjeta','pagada',NULL,NULL,'2026-06-11 20:30:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(10,'55555555-5','00223344-5',3,'emergencia','emergencia','Atención de emergencia: Fiebre alta 39.5°C en paciente pediátrico',40.00,'efectivo','pagada','Paciente pediátrico',NULL,'2026-06-12 14:50:00','2026-06-15 21:21:22','2026-06-15 21:21:22'),(11,'00000001-1','00223344-5',5,'emergencia','emergencia','Atención de emergencia: Reacción alérgica con urticaria generalizada',20.00,'efectivo','pagada',NULL,NULL,'2026-06-15 22:13:00','2026-06-15 22:13:00','2026-06-15 22:13:00'),(12,'98765432-1','00112233-4',11,'consulta','consulta','Consulta médica: Control mensual de diabetes',20.00,'efectivo','pagada',NULL,NULL,'2026-06-16 00:38:10','2026-06-16 00:38:10','2026-06-16 00:38:22');
UNLOCK TABLES;

-- ============================================================
SET FOREIGN_KEY_CHECKS=1;
-- FIN DEL SCRIPT
-- ============================================================

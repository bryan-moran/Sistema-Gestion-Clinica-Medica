-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: clinicamedica_stm
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'12345678-9','00112233-4','consulta','2026-06-10','09:00:00','Dolor de cabeza persistente','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(2,'98765432-1','00112233-4','control','2026-06-10','10:30:00','Control de diabetes y presión arterial','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(3,'55555555-5','00223344-5','pediatria','2026-06-11','11:00:00','Control de crecimiento infantil','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(4,'44444444-4','00112233-4','consulta','2026-06-11','14:00:00','Dolor en el pecho','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(5,'00000002-2','00112233-4','control','2026-06-12','08:30:00','Revisión post-operatoria de rodilla','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(6,'00000003-3','00112233-4','consulta','2026-06-12','10:00:00','Fatiga crónica y mareos frecuentes','completada','2026-06-18 17:28:54','2026-06-18 17:28:54'),(7,'33333333-3','00223344-5','pediatria','2026-06-12','11:30:00','Acompañante de hijo: fiebre recurrente','completada','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_usuario`
--

DROP TABLE IF EXISTS `config_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_usuario` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `tema` enum('claro','oscuro') NOT NULL DEFAULT 'claro',
  `avatar` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_config_usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_usuario`
--

LOCK TABLES `config_usuario` WRITE;
/*!40000 ALTER TABLE `config_usuario` DISABLE KEYS */;
INSERT INTO `config_usuario` VALUES (1,'admin','$2y$12$hsK1zrF9IbyMFeL0QjqDy.TIDgCzjUTggp/aT3t36B2XRr1fJm8ya','Administrador','claro','avatar_03','2026-06-18 17:26:14','2026-06-19 03:28:59'),(2,'secretaria','Secre@2024!','Secretaria','claro','avatar_02','2026-06-18 17:26:14','2026-06-18 17:26:14'),(3,'medico_general','MedGen@2024!','medico_general','claro','avatar_03','2026-06-18 17:26:14','2026-06-18 17:26:14'),(4,'medico_pediatra','MedPed@2024!','medico_pediatra','claro','avatar_04','2026-06-18 17:26:14','2026-06-18 17:26:14');
/*!40000 ALTER TABLE `config_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,1,'12345678-9','00112233-4','Cefalea tensional crónica','PA: 120/80. Tensión cervical.','Ibuprofeno 400mg cada 8h por 5 días.','2026-06-10 09:42:00'),(2,2,'98765432-1','00112233-4','Diabetes mellitus tipo 2 con hipertensión','Glucosa: 142 mg/dL. PA: 135/88.','Metformina 850mg cada 12h. Losartán 50mg diario.','2026-06-10 11:08:00'),(3,3,'55555555-5','00223344-5','Desarrollo normal para la edad','Peso: 26 kg. Talla: 128 cm. Percentil 50.','Sin medicación. Dieta balanceada.','2026-06-11 11:35:00'),(4,4,'44444444-4','00112233-4','Dolor torácico atípico','ECG normal. Troponinas negativas. PA: 145/92.','Naproxeno 500mg cada 12h por 5 días.','2026-06-11 15:10:00'),(5,5,'00000002-2','00112233-4','Evolución post-operatoria de rodilla','Movilidad al 70%. Sin infección.','Diclofenaco 50mg cada 8h por 3 días. Fisioterapia.','2026-06-12 09:05:00'),(6,6,'00000003-3','00112233-4','Síndrome de fatiga crónica. Anemia ferropénica.','Hemoglobina: 10.2 g/dL. PA: 100/65.','Sulfato Ferroso 300mg diario.','2026-06-12 10:45:00'),(7,7,'33333333-3','00223344-5','Faringitis bacteriana','Fiebre 38.5°C. Garganta eritematosa.','Amoxicilina suspensión 5ml cada 8h por 7 días.','2026-06-12 12:10:00');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas_sin_receta`
--

DROP TABLE IF EXISTS `consultas_sin_receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas_sin_receta` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `notas` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_id_cita` (`id_cita`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas_sin_receta`
--

LOCK TABLES `consultas_sin_receta` WRITE;
/*!40000 ALTER TABLE `consultas_sin_receta` DISABLE KEYS */;
INSERT INTO `consultas_sin_receta` VALUES (1,3,'medico_pediatra','Control de crecimiento normal. No requiere medicación.','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `consultas_sin_receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergencias`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencias`
--

LOCK TABLES `emergencias` WRITE;
/*!40000 ALTER TABLE `emergencias` DISABLE KEYS */;
INSERT INTO `emergencias` VALUES (1,'12345678-9','00112233-4','Dolor de cabeza intenso con náuseas','alta','atendida','2026-06-18 17:28:54','2026-06-18 17:28:54'),(2,'44444444-4','00112233-4','Dolor en el pecho y dificultad para respirar','alta','atendida','2026-06-18 17:28:54','2026-06-18 17:28:54'),(3,'55555555-5','00223344-5','Fiebre alta de 39.5°C','media','atendida','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `emergencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `id_factura` int unsigned NOT NULL AUTO_INCREMENT,
  `dui_paciente` varchar(10) NOT NULL,
  `dui_medico` varchar(10) DEFAULT NULL,
  `ref_id` int DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (1,'12345678-9','00112233-4',1,'consulta','consulta','Consulta + receta',35.00,'efectivo','pagada',NULL,'maria.gonzalez@email.com','2026-06-10 09:45:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(2,'98765432-1','00112233-4',2,'consulta','consulta','Control diabetes + 2 recetas',45.00,'tarjeta','pagada',NULL,'carlos.ramirez@email.com','2026-06-10 11:20:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(3,'55555555-5','00223344-5',3,'consulta','consulta','Control pediátrico',30.00,'efectivo','pagada',NULL,'ana.martinez@email.com','2026-06-11 11:40:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(4,'44444444-4','00112233-4',4,'consulta','consulta','Consulta + ECG + receta',55.00,'transferencia','pagada',NULL,'roberto.sanchez@email.com','2026-06-11 15:15:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(5,'00000002-2','00112233-4',5,'consulta','consulta','Control post-operatorio + 2 recetas',40.00,'efectivo','pagada',NULL,'luis.perez@email.com','2026-06-12 09:10:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(6,'00000003-3','00112233-4',6,'consulta','consulta','Consulta + análisis + receta',50.00,'tarjeta','pagada',NULL,'marta.garcia@email.com','2026-06-12 10:50:00','2026-06-18 17:28:54','2026-06-18 17:28:54'),(7,'33333333-3','00223344-5',7,'consulta','consulta','Consulta pediátrica + receta',35.00,'efectivo','pagada',NULL,'diego.flores@email.com','2026-06-12 12:20:00','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamentos` (
  `id_medicamento` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `presentacion` varchar(100) DEFAULT NULL,
  `concentracion` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
INSERT INTO `medicamentos` VALUES (1,'Ibuprofeno','Tabletas','400mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(2,'Ibuprofeno','Tabletas','600mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(3,'Ibuprofeno','Suspensión','100mg/5ml',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(4,'Paracetamol','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(5,'Paracetamol','Jarabe','120mg/5ml',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(6,'Naproxeno','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(7,'Diclofenaco','Tabletas','50mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(8,'Diclofenaco','Gel','1%',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(9,'Ketorolaco','Tabletas','10mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(10,'Metamizol','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(11,'Amoxicilina','Cápsulas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(12,'Amoxicilina','Suspensión','250mg/5ml',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(13,'Amoxicilina/Clavulanato','Tabletas','875mg/125mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(14,'Azitromicina','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(15,'Ciprofloxacino','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(16,'Claritromicina','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(17,'Cefalexina','Cápsulas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(18,'Metronidazol','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(19,'Trimetoprim/Sulfa','Tabletas','160mg/800mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(20,'Doxiciclina','Cápsulas','100mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(21,'Omeprazol','Cápsulas','20mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(22,'Omeprazol','Cápsulas','40mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(23,'Ranitidina','Tabletas','150mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(24,'Metoclopramida','Tabletas','10mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(25,'Loperamida','Cápsulas','2mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(26,'Sales de Rehidratación','Polvo','27.9g/sobre',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(27,'Losartán','Tabletas','50mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(28,'Losartán','Tabletas','100mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(29,'Enalapril','Tabletas','10mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(30,'Amlodipino','Tabletas','5mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(31,'Atorvastatina','Tabletas','20mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(32,'Atorvastatina','Tabletas','40mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(33,'Metoprolol','Tabletas','50mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(34,'Metformina','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(35,'Metformina','Tabletas','850mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(36,'Glibenclamida','Tabletas','5mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(37,'Salbutamol','Inhalador','100mcg/dosis',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(38,'Cetirizina','Tabletas','10mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(39,'Loratadina','Tabletas','10mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(40,'Dexametasona','Tabletas','4mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(41,'Dexametasona','Ampolleta','4mg/2ml',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(42,'Prednisona','Tabletas','5mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(43,'Vitamina C','Tabletas','500mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(44,'Vitamina D3','Tabletas','1000 UI',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(45,'Sulfato Ferroso','Tabletas','300mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(46,'Ácido Fólico','Tabletas','5mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(47,'Clotrimazol','Crema','1%',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(48,'Fluconazol','Cápsulas','150mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(49,'Alprazolam','Tabletas','0.5mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(50,'Tramadol','Cápsulas','50mg',1,'2026-06-18 17:26:14','2026-06-18 17:26:14'),(51,'Otro medicamento','Especificar en instrucciones','',1,'2026-06-18 17:26:14','2026-06-18 17:26:14');
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

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

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES ('00112233-4','Juan Carlos','Martínez','Medicina General','7012-3456','2026-06-18 17:28:54','2026-06-18 17:28:54'),('00223344-5','Laura Elena','García','Pediatría','7023-4567','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

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

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES ('00000002-2','Luis','Pérez','7567-8901',40,'1985-07-30','Avenida Las Flores #890','Ibuprofeno','Post-operatorio rodilla','2026-06-18 17:28:54','2026-06-18 17:28:54'),('00000003-3','Marta','García','7678-9012',29,'1996-12-05','Calle La Paz #234','Ninguna','Fatiga crónica','2026-06-18 17:28:54','2026-06-18 17:28:54'),('12345678-9','María','González','7012-3456',45,'1980-05-15','Calle Los Pinos #123','Penicilina','Migraña','2026-06-18 17:28:54','2026-06-18 17:28:54'),('33333333-3','Diego','Flores','7901-2345',5,'2020-08-12','Pasaje Las Brisas #333','Ninguna','Paciente pediátrico','2026-06-18 17:28:54','2026-06-18 17:28:54'),('44444444-4','Roberto','Sánchez','7345-6789',52,'1973-08-25','Boulevard Los Héroes #321','Mariscos','Hipertensión','2026-06-18 17:28:54','2026-06-18 17:28:54'),('55555555-5','Ana','Martínez','7234-5678',8,'2017-03-10','Pasaje Los Ángeles #789','Ninguna','Control pediátrico','2026-06-18 17:28:54','2026-06-18 17:28:54'),('98765432-1','Carlos','Ramírez','7123-4567',58,'1967-11-20','Avenida Reforma #456','Ninguna','Diabetes tipo 2','2026-06-18 17:28:54','2026-06-18 17:28:54');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas`
--

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recetas` (
  `id_receta` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `id_medicamento` int unsigned NOT NULL,
  `dosis` varchar(100) DEFAULT NULL,
  `frecuencia` varchar(100) DEFAULT NULL,
  `duracion` varchar(100) DEFAULT NULL,
  `instrucciones` text,
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

LOCK TABLES `recetas` WRITE;
/*!40000 ALTER TABLE `recetas` DISABLE KEYS */;
INSERT INTO `recetas` VALUES (1,1,1,'400 mg','Cada 8 horas','5 días','Tomar después de las comidas.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(2,2,35,'850 mg','Cada 12 horas','30 días','Tomar con las comidas.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(3,2,27,'50 mg','Una vez al día','30 días','Tomar en la mañana.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(4,4,6,'500 mg','Cada 12 horas','5 días','Tomar después de las comidas.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(5,5,7,'50 mg','Cada 8 horas','3 días','Tomar con alimentos.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(6,5,8,'Aplicar','3 veces al día','7 días','Masajear suavemente.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(7,6,45,'300 mg','Una vez al día','30 días','Tomar con vitamina C.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(8,7,12,'5 ml','Cada 8 horas','7 días','Agitar antes de usar.','2026-06-18 17:28:54','2026-06-18 17:28:54'),(9,3,49,'tableta 1','cada 8 horas','4 dias',NULL,'2026-06-18 23:41:30','2026-06-18 23:41:30');
/*!40000 ALTER TABLE `recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas_enviadas`
--

DROP TABLE IF EXISTS `recetas_enviadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recetas_enviadas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cita` int NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `estado` varchar(50) DEFAULT 'enviado',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_id_cita` (`id_cita`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas_enviadas`
--

LOCK TABLES `recetas_enviadas` WRITE;
/*!40000 ALTER TABLE `recetas_enviadas` DISABLE KEYS */;
INSERT INTO `recetas_enviadas` VALUES (1,1,'maria.gonzalez@email.com','medico_general','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(2,2,'carlos.ramirez@email.com','medico_general','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(3,4,'roberto.sanchez@email.com','medico_general','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(4,5,'luis.perez@email.com','medico_general','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(5,6,'marta.garcia@email.com','medico_general','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(6,7,'diego.flores@email.com','medico_pediatra','enviado','2026-06-18 17:28:54','2026-06-18 17:28:54'),(7,3,'jorgephernandez36@gmail.com','admin','enviado','2026-06-18 23:43:24','2026-06-18 23:43:24');
/*!40000 ALTER TABLE `recetas_enviadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

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

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','Admin@2024!','Administrador','2026-06-18 17:26:14','2026-06-18 17:26:14'),(2,'secretaria','Secre@2024!','Secretaria','2026-06-18 17:26:14','2026-06-18 17:26:14'),(3,'medico_general','MedGen@2024!','Médico General','2026-06-18 17:26:14','2026-06-18 17:26:14'),(4,'medico_pediatra','MedPed@2024!','Médico Pediatra','2026-06-18 17:26:14','2026-06-18 17:26:14');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-18 15:40:10

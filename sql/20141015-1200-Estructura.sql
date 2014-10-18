/* Script para crear la estructura básica */
/* Se usa la estructura [Año][Mes][Dia]-[Hora][Minuto]-[Estructura/Datos].sql */

CREATE DATABASE  IF NOT EXISTS `bolsadv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bolsadv`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bolsadv
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`CodCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direccion` (
  `CodUsuario` bigint(20) NOT NULL,
  `ID_Provincia` int(11) NOT NULL,
  `ID_Localidad` int(11) NOT NULL,
  `Calle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Numero` smallint(6) DEFAULT NULL,
  `TRIAL_COLUMN_6` double NOT NULL,
  `TRIAL_COLUMN_7` double NOT NULL,
  `TRIAL_COLUMN_8` smallint(6) DEFAULT NULL,
  `TRIAL_COLUMN_9` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadocivil`
--

DROP TABLE IF EXISTS `estadocivil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadocivil` (
  `ID_EstadoCivil` smallint(6) NOT NULL,
  `EstadoCivil` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_EstadoCivil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadocivil`
--

LOCK TABLES `estadocivil` WRITE;
/*!40000 ALTER TABLE `estadocivil` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadocivil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estidioma`
--

DROP TABLE IF EXISTS `estidioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estidioma` (
  `ID_Idioma` smallint(6) NOT NULL DEFAULT '1',
  `CodUsuario` bigint(20) NOT NULL,
  `ID_NivelConocimiento` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_Idioma`,`CodUsuario`,`ID_NivelConocimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estidioma`
--

LOCK TABLES `estidioma` WRITE;
/*!40000 ALTER TABLE `estidioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `estidioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiencialaboral`
--

DROP TABLE IF EXISTS `experiencialaboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiencialaboral` (
  `ID_Experiencia` smallint(6) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  `Puesto` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ID_Seniority` smallint(6) NOT NULL DEFAULT '5',
  `Empresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `TRIAL_COLUMN_6` int(11) NOT NULL,
  `TRIAL_COLUMN_7` date NOT NULL,
  `TRIAL_COLUMN_8` date DEFAULT NULL,
  `TRIAL_COLUMN_9` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `TRIAL_COLUMN_10` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_Experiencia`,`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencialaboral`
--

LOCK TABLES `experiencialaboral` WRITE;
/*!40000 ALTER TABLE `experiencialaboral` DISABLE KEYS */;
/*!40000 ALTER TABLE `experiencialaboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idioma` (
  `ID_Idioma` smallint(6) NOT NULL AUTO_INCREMENT,
  `Idioma` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
/*!40000 ALTER TABLE `idioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidad` (
  `ID_Localidad` int(11) NOT NULL,
  `ID_Provincia` int(11) NOT NULL,
  `Localidad` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Localidad`,`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidad`
--

LOCK TABLES `localidad` WRITE;
/*!40000 ALTER TABLE `localidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `localidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `CodMateria` varchar(4) CHARACTER SET utf8 NOT NULL,
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Materia` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`CodMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `ID_Mensaje` bigint(20) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  `CodUsuario_Emisor` bigint(20) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `TRIAL_COLUMN_6` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_Mensaje`,`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivelestudios`
--

DROP TABLE IF EXISTS `nivelestudios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivelestudios` (
  `ID_NivelEstudio` smallint(6) NOT NULL,
  `NivelEstudio` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_NivelEstudio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelestudios`
--

LOCK TABLES `nivelestudios` WRITE;
/*!40000 ALTER TABLE `nivelestudios` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivelestudios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivelidioma`
--

DROP TABLE IF EXISTS `nivelidioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivelidioma` (
  `ID_NivelConocimiento` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nivel` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_NivelConocimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelidioma`
--

LOCK TABLES `nivelidioma` WRITE;
/*!40000 ALTER TABLE `nivelidioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivelidioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `ID_Pais` int(11) NOT NULL,
  `Pais` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor` (
  `ID_Profesor` int(11) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  PRIMARY KEY (`ID_Profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesormateria`
--

DROP TABLE IF EXISTS `profesormateria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesormateria` (
  `ID_Profesor` int(11) NOT NULL,
  `CodMateria` varchar(4) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Profesor`,`CodMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesormateria`
--

LOCK TABLES `profesormateria` WRITE;
/*!40000 ALTER TABLE `profesormateria` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesormateria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `ID_Provincia` int(11) NOT NULL AUTO_INCREMENT,
  `Provincia` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `CodRol` char(2) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seniority`
--

DROP TABLE IF EXISTS `seniority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seniority` (
  `ID_Seniority` smallint(6) NOT NULL AUTO_INCREMENT,
  `Seniority` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Seniority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seniority`
--

LOCK TABLES `seniority` WRITE;
/*!40000 ALTER TABLE `seniority` DISABLE KEYS */;
/*!40000 ALTER TABLE `seniority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sysdiagrams`
--

DROP TABLE IF EXISTS `sysdiagrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysdiagrams` (
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `principal_id` int(11) NOT NULL,
  `diagram_id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) DEFAULT NULL,
  `definition` longblob,
  PRIMARY KEY (`diagram_id`),
  UNIQUE KEY `UK_principal_name` (`principal_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sysdiagrams`
--

LOCK TABLES `sysdiagrams` WRITE;
/*!40000 ALTER TABLE `sysdiagrams` DISABLE KEYS */;
/*!40000 ALTER TABLE `sysdiagrams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarea`
--

DROP TABLE IF EXISTS `tarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarea` (
  `CodTarea` smallint(6) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`CodTarea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarea`
--

LOCK TABLES `tarea` WRITE;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarearol`
--

DROP TABLE IF EXISTS `tarearol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarearol` (
  `CodTarea` smallint(6) NOT NULL,
  `CodRol` char(2) NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`CodTarea`,`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarearol`
--

LOCK TABLES `tarearol` WRITE;
/*!40000 ALTER TABLE `tarearol` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarearol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarearolauditoria`
--

DROP TABLE IF EXISTS `tarearolauditoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarearolauditoria` (
  `ID_TareaRolAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `FechaAuditoria` datetime NOT NULL,
  `USER` varchar(50) NOT NULL,
  `CodTarea` smallint(6) NOT NULL,
  `CodRol` char(2) NOT NULL,
  `TRIAL_COLUMN_6` bit(1) NOT NULL,
  PRIMARY KEY (`ID_TareaRolAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarearolauditoria`
--

LOCK TABLES `tarearolauditoria` WRITE;
/*!40000 ALTER TABLE `tarearolauditoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarearolauditoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono` (
  `CodUsuario` bigint(20) NOT NULL,
  `ID_TipoTelefono` smallint(6) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  PRIMARY KEY (`CodUsuario`,`ID_TipoTelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodocumento` (
  `ID_TipoDocumento` smallint(6) NOT NULL,
  `Descripcion` varchar(40) NOT NULL,
  `AdmiteLetras` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_TipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipotelefono`
--

DROP TABLE IF EXISTS `tipotelefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipotelefono` (
  `ID_TipoTelefono` smallint(6) NOT NULL,
  `Descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_TipoTelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipotelefono`
--

LOCK TABLES `tipotelefono` WRITE;
/*!40000 ALTER TABLE `tipotelefono` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipotelefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulo`
--

DROP TABLE IF EXISTS `titulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulo` (
  `ID_Titulo` int(11) NOT NULL,
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Titulo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`ID_Titulo`,`CodCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulo`
--

LOCK TABLES `titulo` WRITE;
/*!40000 ALTER TABLE `titulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `titulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `CodUsuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Apellido` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(15) CHARACTER SET utf8 NOT NULL,
  `TRIAL_COLUMN_6` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TRIAL_COLUMN_7` datetime NOT NULL,
  `TRIAL_COLUMN_8` int(11) NOT NULL DEFAULT '1',
  `TRIAL_COLUMN_9` smallint(6) NOT NULL DEFAULT '1',
  `TRIAL_COLUMN_10` char(1) NOT NULL,
  `TRIAL_COLUMN_11` smallint(6) NOT NULL DEFAULT '1',
  `TRIAL_COLUMN_12` bigint(20) NOT NULL,
  `TRIAL_COLUMN_13` smallint(6) NOT NULL,
  `TRIAL_COLUMN_14` char(2) DEFAULT NULL,
  `TRIAL_COLUMN_15` datetime DEFAULT NULL,
  `TRIAL_COLUMN_16` bit(1) NOT NULL DEFAULT b'0',
  `TRIAL_COLUMN_17` datetime DEFAULT NULL,
  `TRIAL_COLUMN_18` longblob,
  PRIMARY KEY (`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bolsadv'
--

--
-- Dumping routines for database 'bolsadv'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-15 22:51:30

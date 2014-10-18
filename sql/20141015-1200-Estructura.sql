/* Script para crear la estructura básica */
/* Se usa la estructura [Año][Mes][Dia]-[Hora][Minuto]-[Estructura/Datos].sql */

CREATE DATABASE  IF NOT EXISTS `bolsadv` ;
USE `bolsadv`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bolsadv
-- ------------------------------------------------------
-- Server version	5.6.20



--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;

CREATE TABLE `carrera` (
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`CodCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE `direccion` (
  `CodUsuario` bigint(20) NOT NULL,
  `ID_Provincia` int(11) NOT NULL,
  `ID_Localidad` int(11) NOT NULL,
  `Calle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Numero` smallint(6) DEFAULT NULL,
  `Coordenada1` double NOT NULL,
  `Coordenada2` double NOT NULL,
  `Piso` smallint(6) DEFAULT NULL,
  `Departamento` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `estadocivil`
--

DROP TABLE IF EXISTS `estadocivil`;
CREATE TABLE `estadocivil` (
  `ID_EstadoCivil` smallint(6) NOT NULL,
  `EstadoCivil` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_EstadoCivil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `estadocivil`
--

LOCK TABLES `estadocivil` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `estidioma`
--

DROP TABLE IF EXISTS `estidioma`;
CREATE TABLE `estidioma` (
  `ID_Idioma` smallint(6) NOT NULL DEFAULT '1',
  `CodUsuario` bigint(20) NOT NULL,
  `ID_NivelConocimiento` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_Idioma`,`CodUsuario`,`ID_NivelConocimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estidioma`
--

LOCK TABLES `estidioma` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `experiencialaboral`
--

DROP TABLE IF EXISTS `experiencialaboral`;
CREATE TABLE `experiencialaboral` (
  `ID_Experiencia` smallint(6) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  `Puesto` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ID_Seniority` smallint(6) NOT NULL DEFAULT '5',
  `Empresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ID_Pais` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `Descripcion` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `PersonasACargo` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_Experiencia`,`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experiencialaboral`
--

LOCK TABLES `experiencialaboral` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
CREATE TABLE `idioma` (
  `ID_Idioma` smallint(6) NOT NULL AUTO_INCREMENT,
  `Idioma` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE `localidad` (
  `ID_Localidad` int(11) NOT NULL,
  `ID_Provincia` int(11) NOT NULL,
  `Localidad` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Localidad`,`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `localidad`
--

LOCK TABLES `localidad` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `CodMateria` varchar(4) CHARACTER SET utf8 NOT NULL,
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Materia` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`CodMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE `mensaje` (
  `ID_Mensaje` bigint(20) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  `CodUsuario_Emisor` bigint(20) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `Visible` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_Mensaje`,`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `nivelestudios`
--

DROP TABLE IF EXISTS `nivelestudios`;
CREATE TABLE `nivelestudios` (
  `ID_NivelEstudio` smallint(6) NOT NULL,
  `NivelEstudio` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_NivelEstudio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nivelestudios`
--

LOCK TABLES `nivelestudios` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `nivelidioma`
--

DROP TABLE IF EXISTS `nivelidioma`;
CREATE TABLE `nivelidioma` (
  `ID_NivelConocimiento` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nivel` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_NivelConocimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nivelidioma`
--

LOCK TABLES `nivelidioma` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `ID_Pais` int(11) NOT NULL,
  `Pais` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE `profesor` (
  `ID_Profesor` int(11) NOT NULL,
  `CodUsuario` bigint(20) NOT NULL,
  PRIMARY KEY (`ID_Profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `profesormateria`
--

DROP TABLE IF EXISTS `profesormateria`;
CREATE TABLE `profesormateria` (
  `ID_Profesor` int(11) NOT NULL,
  `CodMateria` varchar(4) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Profesor`,`CodMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profesormateria`
--

LOCK TABLES `profesormateria` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE `provincia` (
  `ID_Provincia` int(11) NOT NULL AUTO_INCREMENT,
  `Provincia` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `CodRol` char(2) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `seniority`
--

DROP TABLE IF EXISTS `seniority`;
CREATE TABLE `seniority` (
  `ID_Seniority` smallint(6) NOT NULL AUTO_INCREMENT,
  `Seniority` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_Seniority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `seniority`
--

LOCK TABLES `seniority` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `tarea`
--

DROP TABLE IF EXISTS `tarea`;
CREATE TABLE `tarea` (
  `CodTarea` smallint(6) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`CodTarea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarea`
--

LOCK TABLES `tarea` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `tarearol`
--

DROP TABLE IF EXISTS `tarearol`;
CREATE TABLE `tarearol` (
  `CodTarea` smallint(6) NOT NULL,
  `CodRol` char(2) NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`CodTarea`,`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarearol`
--

LOCK TABLES `tarearol` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `tarearolauditoria`
--

DROP TABLE IF EXISTS `tarearolauditoria`;
CREATE TABLE `tarearolauditoria` (
  `ID_TareaRolAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `FechaAuditoria` datetime NOT NULL,
  `USER` varchar(50) NOT NULL,
  `CodTarea` smallint(6) NOT NULL,
  `CodRol` char(2) NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`ID_TareaRolAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarearolauditoria`
--

LOCK TABLES `tarearolauditoria` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
CREATE TABLE `telefono` (
  `CodUsuario` bigint(20) NOT NULL,
  `ID_TipoTelefono` smallint(6) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  PRIMARY KEY (`CodUsuario`,`ID_TipoTelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE `tipodocumento` (
  `ID_TipoDocumento` smallint(6) NOT NULL,
  `Descripcion` varchar(40) NOT NULL,
  `AdmiteLetras` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_TipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `tipotelefono`
--

DROP TABLE IF EXISTS `tipotelefono`;
CREATE TABLE `tipotelefono` (
  `ID_TipoTelefono` smallint(6) NOT NULL,
  `Descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_TipoTelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipotelefono`
--

LOCK TABLES `tipotelefono` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `titulo`
--

DROP TABLE IF EXISTS `titulo`;
CREATE TABLE `titulo` (
  `ID_Titulo` int(11) NOT NULL,
  `CodCarrera` varchar(2) CHARACTER SET utf8 NOT NULL,
  `Titulo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`ID_Titulo`,`CodCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titulo`
--

LOCK TABLES `titulo` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `CodUsuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Apellido` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(15) CHARACTER SET utf8 NOT NULL,
  `FechaIngreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaNacimiento` datetime NOT NULL,
  `ID_Paises` int(11) NOT NULL DEFAULT '1',
  `ID_EstadoCivil` smallint(6) NOT NULL DEFAULT '1',
  `Sexo` char(1) NOT NULL,
  `ID_TipoDocumento` smallint(6) NOT NULL DEFAULT '1',
  `Documento` bigint(20) NOT NULL,
  `ID_NivelEstudios` smallint(6) NOT NULL,
  `CodRol` char(2) DEFAULT NULL,
  `FechaBaja` datetime DEFAULT NULL,
  `Estado` bit(1) NOT NULL DEFAULT b'0',
  `FechaCambioPassword` datetime DEFAULT NULL,
  `Foto` longblob,
  PRIMARY KEY (`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
UNLOCK TABLES;

--
-- Dumping events for database 'bolsadv'
--

-- Dump completed on 2014-10-15 22:51:30

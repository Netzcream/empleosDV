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


---- nsert Carreras:
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('AS' , 'Analista de Sistemas' , 1);
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('CA' , 'Cine de Animación' , 1);
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('DG' , 'Diseño Grafico' , 1);
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('DM' , 'Diseño Multimedial' , 1);
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('DW' , 'Desarrollo Web y Mobile' , 1);
Insert  Into  Carrera(CodCarrera,Descripcion,Activo) Values('VJ' , 'Programación de Video Juegos' , 1);


--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE `direccion` (
  `CodUsuario` bigint(20) NOT NULL,
  `ID_Provincia` int(11) NOT NULL,
  `ID_Localidad` int(11) NOT NULL,
  `Calle` varchar(50) NULL,
  `Numero` smallint(6) DEFAULT NULL,
  `Coordenada1` double NOT NULL,
  `Coordenada2` double NOT NULL,
  `Piso` smallint(6) DEFAULT NULL,
  `Departamento` varchar(1) DEFAULT NULL,
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
  `ID_EstadoCivil` smallint(6) NOT NULL AUTO_INCREMENT,
  `EstadoCivil` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_EstadoCivil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estadocivil`
--

LOCK TABLES `estadocivil` WRITE;
UNLOCK TABLES;

-- Insert EstadoCivil

Insert  Into  EstadoCivil(ID_EstadoCivil,EstadoCivil) Values(1 , 'Soltero/a' );
Insert  Into  EstadoCivil(ID_EstadoCivil,EstadoCivil) Values(2 , 'Casado/a' );
Insert  Into  EstadoCivil(ID_EstadoCivil,EstadoCivil) Values(3 , 'Divorciado/a' );
Insert  Into  EstadoCivil(ID_EstadoCivil,EstadoCivil) Values(4 , 'Viudo/a' );
Insert  Into  EstadoCivil(ID_EstadoCivil,EstadoCivil) Values(5 , 'Concubinato' );

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
  `ID_Experiencia` smallint(6) NOT NULL AUTO_INCREMENT,
  `CodUsuario` bigint(20) NOT NULL,
  `Puesto` varchar(50)  NOT NULL,
  `ID_Seniority` smallint(6) NOT NULL DEFAULT '5',
  `Empresa` varchar(100) NOT NULL,
  `ID_Pais` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `Descripcion` varchar(2000) NOT NULL,
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
  `Idioma` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
UNLOCK TABLES;


-- nsert Idioma

Insert  Into  Idioma(ID_Idioma,Idioma) Values(1 , '-' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(2 , 'Alemán' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(3 , 'Francés' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(4 , 'Inglés' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(5 , 'Italiano' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(6 , 'Japonés' );
Insert  Into  Idioma(ID_Idioma,Idioma) Values(7 , 'Portugués' );


--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE `localidad` (
  `ID_Localidad` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Provincia` int(11) NOT NULL,
  `Localidad` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Localidad`,`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `localidad`
--

LOCK TABLES `localidad` WRITE;
UNLOCK TABLES;


-- nsert Localidad

Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1,1,' 25 de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2,1,' 3 de febrero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(3,1,' A. Alsina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(4,1,' A. Gonzáles Cháves');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(5,1,' Aguas Verdes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(6,1,' Alberti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(7,1,' Arrecifes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(8,1,' Ayacucho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(9,1,' Azul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(10,1,' Bahía Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(11,1,' Balcarce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(12,1,' Baradero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(13,1,' Benito Juárez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(14,1,' Berisso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(15,1,' Bolívar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(16,1,' Bragado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(17,1,' Brandsen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(18,1,' Campana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(19,1,' Cañuelas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(20,1,' Capilla del Señor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(21,1,' Capitán Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(22,1,' Carapachay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(23,1,' Carhue');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(24,1,' Cariló');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(25,1,' Carlos Casares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(26,1,' Carlos Tejedor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(27,1,' Carmen de Areco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(28,1,' Carmen de Patagones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(29,1,' Castelli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(30,1,' Chacabuco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(31,1,' Chascomús');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(32,1,' Chivilcoy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(33,1,' Colón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(34,1,' Coronel Dorrego');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(35,1,' Coronel Pringles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(36,1,' Coronel Rosales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(37,1,' Coronel Suarez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(38,1,' Costa Azul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(39,1,' Costa Chica');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(40,1,' Costa del Este');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(41,1,' Costa Esmeralda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(42,1,' Daireaux');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(43,1,' Darregueira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(44,1,' Del Viso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(45,1,' Dolores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(46,1,' Don Torcuato');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(47,1,' Ensenada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(48,1,' Escobar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(49,1,' Exaltación de la Cruz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(50,1,' Florentino Ameghino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(51,1,' Garín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(52,1,' Gral. Alvarado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(53,1,' Gral. Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(54,1,' Gral. Arenales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(55,1,' Gral. Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(56,1,' Gral. Guido');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(57,1,' Gral. Lamadrid');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(58,1,' Gral. Las Heras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(59,1,' Gral. Lavalle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(60,1,' Gral. Madariaga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(61,1,' Gral. Pacheco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(62,1,' Gral. Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(63,1,' Gral. Pinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(64,1,' Gral. Pueyrredón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(65,1,' Gral. Rodríguez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(66,1,' Gral. Viamonte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(67,1,' Gral. Villegas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(68,1,' Guaminí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(69,1,' Guernica');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(70,1,' Hipólito Yrigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(71,1,' Ing. Maschwitz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(72,1,' Junín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(73,1,' La Plata');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(74,1,' Laprida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(75,1,' Las Flores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(76,1,' Las Toninas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(77,1,' Leandro N. Alem');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(78,1,' Lincoln');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(79,1,' Loberia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(80,1,' Lobos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(81,1,' Los Cardales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(82,1,' Los Toldos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(83,1,' Lucila del Mar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(84,1,' Luján');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(85,1,' Magdalena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(86,1,' Maipú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(87,1,' Mar Chiquita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(88,1,' Mar de Ajó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(89,1,' Mar de las Pampas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(90,1,' Mar del Plata');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(91,1,' Mar del Tuyú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(92,1,' Marcos Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(93,1,' Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(94,1,' Miramar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(95,1,' Monte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(96,1,' Monte Hermoso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(97,1,' Munro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(98,1,' Navarro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(99,1,' Necochea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(100,1,' Olavarría');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(101,1,' Partido de la Costa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(102,1,' Pehuajó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(103,1,' Pellegrini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(104,1,' Pergamino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(105,1,' Pigüé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(106,1,' Pila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(107,1,' Pilar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(108,1,' Pinamar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(109,1,' Pinar del Sol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(110,1,' Polvorines');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(111,1,' Pte. Perón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(112,1,' Puán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(113,1,' Punta Indio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(114,1,' Ramallo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(115,1,' Rauch');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(116,1,' Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(117,1,' Rojas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(118,1,' Roque Pérez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(119,1,' Saavedra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(120,1,' Saladillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(121,1,' Salliqueló');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(122,1,' Salto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(123,1,' San Andrés de Giles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(124,1,' San Antonio de Areco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(125,1,' San Antonio de Padua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(126,1,' San Bernardo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(127,1,' San Cayetano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(128,1,' San Clemente del Tuyú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(129,1,' San Nicolás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(130,1,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(131,1,' San Vicente');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(132,1,' Santa Teresita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(133,1,' Suipacha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(134,1,' Tandil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(135,1,' Tapalqué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(136,1,' Tordillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(137,1,' Tornquist');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(138,1,' Trenque Lauquen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(139,1,' Tres Lomas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(140,1,' Villa Gesell');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(141,1,' Villarino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(142,1,' Zárate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(143,2,' 11 de Septiembre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(144,2,' 20 de Junio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(145,2,' 25 de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(146,2,' Acassuso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(147,2,' Adrogué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(148,2,' Aldo Bonzi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(149,2,' Área Reserva Cinturón Ecológico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(150,2,' Avellaneda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(151,2,' Banfield');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(152,2,' Barrio Parque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(153,2,' Barrio Santa Teresita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(154,2,' Beccar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(155,2,' Bella Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(156,2,' Berazategui');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(157,2,' Bernal Este');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(158,2,' Bernal Oeste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(159,2,' Billinghurst');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(160,2,' Boulogne');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(161,2,' Burzaco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(162,2,' Carapachay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(163,2,' Caseros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(164,2,' Castelar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(165,2,' Churruca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(166,2,' Ciudad Evita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(167,2,' Ciudad Madero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(168,2,' Ciudadela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(169,2,' Claypole');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(170,2,' Crucecita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(171,2,' Dock Sud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(172,2,' Don Bosco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(173,2,' Don Orione');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(174,2,' El Jagüel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(175,2,' El Libertador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(176,2,' El Palomar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(177,2,' El Tala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(178,2,' El Trébol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(179,2,' Ezeiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(180,2,' Ezpeleta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(181,2,' Florencio Varela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(182,2,' Florida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(183,2,' Francisco Álvarez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(184,2,' Gerli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(185,2,' Glew');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(186,2,' González Catán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(187,2,' Gral. Lamadrid');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(188,2,' Grand Bourg');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(189,2,' Gregorio de Laferrere');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(190,2,' Guillermo Enrique Hudson');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(191,2,' Haedo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(192,2,' Hurlingham');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(193,2,' Ing. Sourdeaux');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(194,2,' Isidro Casanova');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(195,2,' Ituzaingó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(196,2,' José C. Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(197,2,' José Ingenieros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(198,2,' José Marmol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(199,2,' La Lucila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(200,2,' La Reja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(201,2,' La Tablada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(202,2,' Lanús');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(203,2,' Llavallol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(204,2,' Loma Hermosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(205,2,' Lomas de Zamora');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(206,2,' Lomas del Millón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(207,2,' Lomas del Mirador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(208,2,' Longchamps');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(209,2,' Los Polvorines');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(210,2,' Luis Guillón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(211,2,' Malvinas Argentinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(212,2,' Martín Coronado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(213,2,' Martínez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(214,2,' Merlo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(215,2,' Ministro Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(216,2,' Monte Chingolo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(217,2,' Monte Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(218,2,' Moreno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(219,2,' Morón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(220,2,' Muñiz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(221,2,' Olivos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(222,2,' Pablo Nogués');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(223,2,' Pablo Podestá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(224,2,' Paso del Rey');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(225,2,' Pereyra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(226,2,' Piñeiro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(227,2,' Plátanos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(228,2,' Pontevedra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(229,2,' Quilmes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(230,2,' Rafael Calzada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(231,2,' Rafael Castillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(232,2,' Ramos Mejía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(233,2,' Ranelagh');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(234,2,' Remedios de Escalada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(235,2,' Sáenz Peña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(236,2,' San Antonio de Padua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(237,2,' San Fernando');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(238,2,' San Francisco Solano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(239,2,' San Isidro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(240,2,' San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(241,2,' San Justo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(242,2,' San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(243,2,' San Miguel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(244,2,' Santos Lugares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(245,2,' Sarandí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(246,2,' Sourigues');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(247,2,' Tapiales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(248,2,' Temperley');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(249,2,' Tigre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(250,2,' Tortuguitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(251,2,' Tristán Suárez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(252,2,' Trujui');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(253,2,' Turdera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(254,2,' Valentín Alsina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(255,2,' Vicente López');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(256,2,' Villa Adelina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(257,2,' Villa Ballester');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(258,2,' Villa Bosch');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(259,2,' Villa Caraza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(260,2,' Villa Celina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(261,2,' Villa Centenario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(262,2,' Villa de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(263,2,' Villa Diamante');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(264,2,' Villa Domínico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(265,2,' Villa España');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(266,2,' Villa Fiorito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(267,2,' Villa Guillermina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(268,2,' Villa Insuperable');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(269,2,' Villa José León Suárez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(270,2,' Villa La Florida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(271,2,' Villa Luzuriaga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(272,2,' Villa Martelli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(273,2,' Villa Obrera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(274,2,' Villa Progreso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(275,2,' Villa Raffo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(276,2,' Villa Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(277,2,' Villa Tesei');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(278,2,' Villa Udaondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(279,2,' Virrey del Pino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(280,2,' Wilde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(281,2,' William Morris');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(282,3,' Agronomía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(283,3,' Almagro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(284,3,' Balvanera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(285,3,' Barracas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(286,3,' Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(287,3,' Boca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(288,3,' Boedo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(289,3,' Caballito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(290,3,' Chacarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(291,3,' Coghlan');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(292,3,' Colegiales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(293,3,' Constitución');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(294,3,' Flores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(295,3,' Floresta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(296,3,' La Paternal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(297,3,' Liniers');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(298,3,' Mataderos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(299,3,' Monserrat');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(300,3,' Monte Castro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(301,3,' Nueva Pompeya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(302,3,' Núñez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(303,3,' Palermo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(304,3,' Parque Avellaneda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(305,3,' Parque Chacabuco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(306,3,' Parque Chas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(307,3,' Parque Patricios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(308,3,' Puerto Madero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(309,3,' Recoleta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(310,3,' Retiro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(311,3,' Saavedra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(312,3,' San Cristóbal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(313,3,' San Nicolás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(314,3,' San Telmo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(315,3,' Vélez Sársfield');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(316,3,' Versalles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(317,3,' Villa Crespo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(318,3,' Villa del Parque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(319,3,' Villa Devoto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(320,3,' Villa Gral. Mitre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(321,3,' Villa Lugano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(322,3,' Villa Luro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(323,3,' Villa Ortúzar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(324,3,' Villa Pueyrredón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(325,3,' Villa Real');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(326,3,' Villa Riachuelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(327,3,' Villa Santa Rita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(328,3,' Villa Soldati');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(329,3,' Villa Urquiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(330,4,' Aconquija');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(331,4,' Ancasti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(332,4,' Andalgalá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(333,4,' Antofagasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(334,4,' Belén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(335,4,' Capayán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(336,4,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(337,4,' 4');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(338,4,' Corral Quemado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(339,4,' El Alto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(340,4,' El Rodeo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(341,4,' F.Mamerto Esquiú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(342,4,' Fiambalá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(343,4,' Hualfín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(344,4,' Huillapima');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(345,4,' Icaño');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(346,4,' La Puerta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(347,4,' Las Juntas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(348,4,' Londres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(349,4,' Los Altos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(350,4,' Los Varela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(351,4,' Mutquín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(352,4,' Paclín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(353,4,' Poman');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(354,4,' Pozo de La Piedra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(355,4,' Puerta de Corral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(356,4,' Puerta San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(357,4,' Recreo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(358,4,' S.F.V de 4');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(359,4,' San Fernando');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(360,4,' San Fernando del Valle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(361,4,' San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(362,4,' Santa María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(363,4,' Santa Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(364,4,' Saujil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(365,4,' Tapso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(366,4,' Tinogasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(367,4,' Valle Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(368,4,' Villa Vil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(369,5,' Aviá Teraí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(370,5,' Barranqueras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(371,5,' Basail');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(372,5,' Campo Largo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(373,5,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(374,5,' Capitán Solari');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(375,5,' Charadai');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(376,5,' Charata');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(377,5,' Chorotis');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(378,5,' Ciervo Petiso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(379,5,' Cnel. Du Graty');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(380,5,' Col. Benítez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(381,5,' Col. Elisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(382,5,' Col. Popular');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(383,5,' Colonias Unidas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(384,5,' Concepción');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(385,5,' Corzuela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(386,5,' Cote Lai');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(387,5,' El Sauzalito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(388,5,' Enrique Urien');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(389,5,' Fontana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(390,5,' Fte. Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(391,5,' Gancedo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(392,5,' Gral. Capdevila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(393,5,' Gral. Pinero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(394,5,' Gral. San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(395,5,' Gral. Vedia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(396,5,' Hermoso Campo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(397,5,' I. del Cerrito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(398,5,' J.J. Castelli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(399,5,' La Clotilde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(400,5,' La Eduvigis');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(401,5,' La Escondida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(402,5,' La Leonesa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(403,5,' La Tigra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(404,5,' La Verde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(405,5,' Laguna Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(406,5,' Laguna Limpia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(407,5,' Lapachito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(408,5,' Las Breñas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(409,5,' Las Garcitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(410,5,' Las Palmas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(411,5,' Los Frentones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(412,5,' Machagai');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(413,5,' Makallé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(414,5,' Margarita Belén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(415,5,' Miraflores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(416,5,' Misión N. Pompeya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(417,5,' Napenay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(418,5,' Pampa Almirón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(419,5,' Pampa del Indio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(420,5,' Pampa del Infierno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(421,5,' Pdcia. de La Plaza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(422,5,' Pdcia. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(423,5,' Pdcia. Roque Sáenz Peña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(424,5,' Pto. Bermejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(425,5,' Pto. Eva Perón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(426,5,' Puero Tirol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(427,5,' Puerto Vilelas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(428,5,' Quitilipi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(429,5,' Resistencia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(430,5,' Sáenz Peña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(431,5,' Samuhú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(432,5,' San Bernardo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(433,5,' Santa Sylvina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(434,5,' Taco Pozo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(435,5,' Tres Isletas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(436,5,' Villa Ángela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(437,5,' Villa Berthet');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(438,5,' Villa R. Bermejito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(439,6,' Aldea Apeleg');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(440,6,' Aldea Beleiro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(441,6,' Aldea Epulef');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(442,6,' Alto Río Sengerr');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(443,6,' Buen Pasto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(444,6,' Camarones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(445,6,' Carrenleufú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(446,6,' Cholila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(447,6,' Co. Centinela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(448,6,' Colan Conhué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(449,6,' Comodoro Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(450,6,' Corcovado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(451,6,' Cushamen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(452,6,' Dique F. Ameghino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(453,6,' Dolavón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(454,6,' Dr. R. Rojas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(455,6,' El Hoyo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(456,6,' El Maitén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(457,6,' Epuyén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(458,6,' Esquel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(459,6,' Facundo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(460,6,' Gaimán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(461,6,' Gan Gan');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(462,6,' Gastre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(463,6,' Gdor. Costa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(464,6,' Gualjaina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(465,6,' J. de San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(466,6,' Lago Blanco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(467,6,' Lago Puelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(468,6,' Lagunita Salada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(469,6,' Las Plumas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(470,6,' Los Altares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(471,6,' Paso de los Indios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(472,6,' Paso del Sapo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(473,6,' Pto. Madryn');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(474,6,' Pto. Pirámides');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(475,6,' Rada Tilly');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(476,6,' Rawson');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(477,6,' Río Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(478,6,' Río Pico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(479,6,' Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(480,6,' Tecka');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(481,6,' Telsen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(482,6,' Trelew');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(483,6,' Trevelin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(484,6,' Veintiocho de Julio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(485,7,' Achiras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(486,7,' Adelia Maria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(487,7,' Agua de Oro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(488,7,' Alcira Gigena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(489,7,' Aldea Santa Maria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(490,7,' Alejandro Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(491,7,' Alejo Ledesma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(492,7,' Alicia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(493,7,' Almafuerte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(494,7,' Alpa Corral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(495,7,' Alta Gracia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(496,7,' Alto Alegre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(497,7,' Alto de Los Quebrachos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(498,7,' Altos de Chipion');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(499,7,' Amboy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(500,7,' Ambul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(501,7,' Ana Zumaran');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(502,7,' Anisacate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(503,7,' Arguello');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(504,7,' Arias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(505,7,' Arroyito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(506,7,' Arroyo Algodon');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(507,7,' Arroyo Cabral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(508,7,' Arroyo Los Patos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(509,7,' Assunta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(510,7,' Atahona');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(511,7,' Ausonia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(512,7,' Avellaneda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(513,7,' Ballesteros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(514,7,' Ballesteros Sud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(515,7,' Balnearia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(516,7,' Bañado de Soto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(517,7,' Bell Ville');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(518,7,' Bengolea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(519,7,' Benjamin Gould');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(520,7,' Berrotaran');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(521,7,' Bialet Masse');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(522,7,' Bouwer');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(523,7,' Brinkmann');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(524,7,' Buchardo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(525,7,' Bulnes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(526,7,' Cabalango');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(527,7,' Calamuchita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(528,7,' Calchin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(529,7,' Calchin Oeste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(530,7,' Calmayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(531,7,' Camilo Aldao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(532,7,' Caminiaga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(533,7,' Cañada de Luque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(534,7,' Cañada de Machado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(535,7,' Cañada de Rio Pinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(536,7,' Cañada del Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(537,7,' Canals');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(538,7,' Candelaria Sud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(539,7,' Capilla de Remedios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(540,7,' Capilla de Siton');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(541,7,' Capilla del Carmen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(542,7,' Capilla del Monte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(543,7,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(544,7,' Capitan Gral B. OÂ´Higgins');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(545,7,' Carnerillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(546,7,' Carrilobo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(547,7,' Casa Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(548,7,' Cavanagh');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(549,7,' Cerro Colorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(550,7,' Chaján');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(551,7,' Chalacea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(552,7,' Chañar Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(553,7,' Chancaní');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(554,7,' Charbonier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(555,7,' Charras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(556,7,' Chazón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(557,7,' Chilibroste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(558,7,' Chucul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(559,7,' Chuña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(560,7,' Chuña Huasi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(561,7,' Churqui Cañada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(562,7,' Cienaga Del Coro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(563,7,' Cintra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(564,7,' Col. Almada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(565,7,' Col. Anita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(566,7,' Col. Barge');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(567,7,' Col. Bismark');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(568,7,' Col. Bremen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(569,7,' Col. Caroya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(570,7,' Col. Italiana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(571,7,' Col. Iturraspe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(572,7,' Col. Las Cuatro Esquinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(573,7,' Col. Las Pichanas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(574,7,' Col. Marina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(575,7,' Col. Prosperidad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(576,7,' Col. San Bartolome');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(577,7,' Col. San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(578,7,' Col. Tirolesa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(579,7,' Col. Vicente Aguero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(580,7,' Col. Videla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(581,7,' Col. Vignaud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(582,7,' Col. Waltelina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(583,7,' Colazo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(584,7,' Comechingones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(585,7,' Conlara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(586,7,' Copacabana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(587,7,' 7');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(588,7,' Coronel Baigorria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(589,7,' Coronel Moldes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(590,7,' Corral de Bustos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(591,7,' Corralito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(592,7,' Cosquín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(593,7,' Costa Sacate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(594,7,' Cruz Alta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(595,7,' Cruz de Caña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(596,7,' Cruz del Eje');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(597,7,' Cuesta Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(598,7,' Dean Funes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(599,7,' Del Campillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(600,7,' Despeñaderos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(601,7,' Devoto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(602,7,' Diego de Rojas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(603,7,' Dique Chico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(604,7,' El Arañado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(605,7,' El Brete');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(606,7,' El Chacho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(607,7,' El Crispín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(608,7,' El Fortín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(609,7,' El Manzano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(610,7,' El Rastreador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(611,7,' El Rodeo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(612,7,' El Tío');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(613,7,' Elena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(614,7,' Embalse');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(615,7,' Esquina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(616,7,' Estación Gral. Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(617,7,' Estación Juárez Celman');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(618,7,' Estancia de Guadalupe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(619,7,' Estancia Vieja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(620,7,' Etruria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(621,7,' Eufrasio Loza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(622,7,' Falda del Carmen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(623,7,' Freyre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(624,7,' Gral. Baldissera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(625,7,' Gral. Cabrera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(626,7,' Gral. Deheza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(627,7,' Gral. Fotheringham');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(628,7,' Gral. Levalle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(629,7,' Gral. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(630,7,' Guanaco Muerto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(631,7,' Guasapampa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(632,7,' Guatimozin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(633,7,' Gutenberg');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(634,7,' Hernando');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(635,7,' Huanchillas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(636,7,' Huerta Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(637,7,' Huinca Renanco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(638,7,' Idiazabal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(639,7,' Impira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(640,7,' Inriville');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(641,7,' Isla Verde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(642,7,' Italó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(643,7,' James Craik');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(644,7,' Jesús María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(645,7,' Jovita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(646,7,' Justiniano Posse');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(647,7,' Km 658');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(648,7,' L. V. Mansilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(649,7,' La Batea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(650,7,' La Calera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(651,7,' La Carlota');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(652,7,' La Carolina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(653,7,' La Cautiva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(654,7,' La Cesira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(655,7,' La Cruz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(656,7,' La Cumbre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(657,7,' La Cumbrecita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(658,7,' La Falda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(659,7,' La Francia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(660,7,' La Granja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(661,7,' La Higuera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(662,7,' La Laguna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(663,7,' La Paisanita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(664,7,' La Palestina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(665,7,' 12');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(666,7,' La Paquita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(667,7,' La Para');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(668,7,' La Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(669,7,' La Playa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(670,7,' La Playosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(671,7,' La Población');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(672,7,' La Posta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(673,7,' La Puerta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(674,7,' La Quinta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(675,7,' La Rancherita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(676,7,' La Rinconada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(677,7,' La Serranita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(678,7,' La Tordilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(679,7,' Laborde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(680,7,' Laboulaye');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(681,7,' Laguna Larga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(682,7,' Las Acequias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(683,7,' Las Albahacas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(684,7,' Las Arrias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(685,7,' Las Bajadas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(686,7,' Las Caleras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(687,7,' Las Calles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(688,7,' Las Cañadas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(689,7,' Las Gramillas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(690,7,' Las Higueras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(691,7,' Las Isletillas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(692,7,' Las Junturas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(693,7,' Las Palmas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(694,7,' Las Peñas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(695,7,' Las Peñas Sud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(696,7,' Las Perdices');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(697,7,' Las Playas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(698,7,' Las Rabonas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(699,7,' Las Saladas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(700,7,' Las Tapias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(701,7,' Las Varas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(702,7,' Las Varillas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(703,7,' Las Vertientes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(704,7,' Leguizamón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(705,7,' Leones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(706,7,' Los Cedros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(707,7,' Los Cerrillos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(708,7,' Los Chañaritos (C.E)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(709,7,' Los Chanaritos (R.S)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(710,7,' Los Cisnes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(711,7,' Los Cocos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(712,7,' Los Cóndores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(713,7,' Los Hornillos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(714,7,' Los Hoyos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(715,7,' Los Mistoles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(716,7,' Los Molinos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(717,7,' Los Pozos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(718,7,' Los Reartes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(719,7,' Los Surgentes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(720,7,' Los Talares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(721,7,' Los Zorros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(722,7,' Lozada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(723,7,' Luca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(724,7,' Luque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(725,7,' Luyaba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(726,7,' Malagueño');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(727,7,' Malena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(728,7,' Malvinas Argentinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(729,7,' Manfredi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(730,7,' Maquinista Gallini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(731,7,' Marcos Juárez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(732,7,' Marull');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(733,7,' Matorrales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(734,7,' Mattaldi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(735,7,' Mayu Sumaj');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(736,7,' Media Naranja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(737,7,' Melo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(738,7,' Mendiolaza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(739,7,' Mi Granja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(740,7,' Mina Clavero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(741,7,' Miramar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(742,7,' Morrison');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(743,7,' Morteros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(744,7,' Mte. Buey');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(745,7,' Mte. Cristo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(746,7,' Mte. De Los Gauchos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(747,7,' Mte. Leña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(748,7,' Mte. Maíz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(749,7,' Mte. Ralo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(750,7,' Nicolás Bruzone');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(751,7,' Noetinger');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(752,7,' Nono');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(753,7,' Nueva 7');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(754,7,' Obispo Trejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(755,7,' Olaeta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(756,7,' Oliva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(757,7,' Olivares San Nicolás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(758,7,' Onagolty');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(759,7,' Oncativo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(760,7,' Ordoñez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(761,7,' Pacheco De Melo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(762,7,' Pampayasta N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(763,7,' Pampayasta S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(764,7,' Panaholma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(765,7,' Pascanas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(766,7,' Pasco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(767,7,' Paso del Durazno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(768,7,' Paso Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(769,7,' Pilar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(770,7,' Pincén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(771,7,' Piquillín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(772,7,' Plaza de Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(773,7,' Plaza Luxardo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(774,7,' Porteña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(775,7,' Potrero de Garay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(776,7,' Pozo del Molle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(777,7,' Pozo Nuevo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(778,7,' Pueblo Italiano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(779,7,' Puesto de Castro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(780,7,' Punta del Agua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(781,7,' Quebracho Herrado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(782,7,' Quilino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(783,7,' Rafael García');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(784,7,' Ranqueles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(785,7,' Rayo Cortado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(786,7,' Reducción');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(787,7,' Rincón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(788,7,' Río Bamba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(789,7,' Río Ceballos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(790,7,' Río Cuarto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(791,7,' Río de Los Sauces');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(792,7,' Río Primero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(793,7,' Río Segundo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(794,7,' Río Tercero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(795,7,' Rosales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(796,7,' Rosario del Saladillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(797,7,' Sacanta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(798,7,' Sagrada Familia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(799,7,' Saira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(800,7,' Saladillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(801,7,' Saldán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(802,7,' Salsacate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(803,7,' Salsipuedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(804,7,' Sampacho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(805,7,' San Agustín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(806,7,' San Antonio de Arredondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(807,7,' San Antonio de Litín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(808,7,' San Basilio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(809,7,' San Carlos Minas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(810,7,' San Clemente');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(811,7,' San Esteban');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(812,7,' San Francisco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(813,7,' San Ignacio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(814,7,' San Javier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(815,7,' San Jerónimo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(816,7,' San Joaquín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(817,7,' San José de La Dormida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(818,7,' San José de Las Salinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(819,7,' San Lorenzo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(820,7,' San Marcos Sierras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(821,7,' San Marcos Sud');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(822,7,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(823,7,' San Pedro N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(824,7,' San Roque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(825,7,' San Vicente');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(826,7,' Santa Catalina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(827,7,' Santa Elena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(828,7,' Santa Eufemia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(829,7,' Santa Maria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(830,7,' Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(831,7,' Saturnino M.Laspiur');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(832,7,' Sauce Arriba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(833,7,' Sebastián Elcano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(834,7,' Seeber');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(835,7,' Segunda Usina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(836,7,' Serrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(837,7,' Serrezuela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(838,7,' Sgo. Temple');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(839,7,' Silvio Pellico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(840,7,' Simbolar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(841,7,' Sinsacate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(842,7,' Sta. Rosa de Calamuchita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(843,7,' Sta. Rosa de Río Primero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(844,7,' Suco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(845,7,' Tala Cañada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(846,7,' Tala Huasi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(847,7,' Talaini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(848,7,' Tancacha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(849,7,' Tanti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(850,7,' Ticino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(851,7,' Tinoco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(852,7,' Tío Pujio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(853,7,' Toledo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(854,7,' Toro Pujio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(855,7,' Tosno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(856,7,' Tosquita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(857,7,' Tránsito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(858,7,' Tuclame');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(859,7,' Tutti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(860,7,' Ucacha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(861,7,' Unquillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(862,7,' Valle de Anisacate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(863,7,' Valle Hermoso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(864,7,' Vélez Sarfield');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(865,7,' Viamonte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(866,7,' Vicuña Mackenna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(867,7,' Villa Allende');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(868,7,' Villa Amancay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(869,7,' Villa Ascasubi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(870,7,' Villa Candelaria N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(871,7,' Villa Carlos Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(872,7,' Villa Cerro Azul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(873,7,' Villa Ciudad de América');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(874,7,' Villa Ciudad Pque Los Reartes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(875,7,' Villa Concepción del Tío');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(876,7,' Villa Cura Brochero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(877,7,' Villa de Las Rosas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(878,7,' Villa de María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(879,7,' Villa de Pocho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(880,7,' Villa de Soto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(881,7,' Villa del Dique');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(882,7,' Villa del Prado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(883,7,' Villa del Rosario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(884,7,' Villa del Totoral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(885,7,' Villa Dolores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(886,7,' Villa El Chancay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(887,7,' Villa Elisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(888,7,' Villa Flor Serrana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(889,7,' Villa Fontana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(890,7,' Villa Giardino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(891,7,' Villa Gral. Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(892,7,' Villa Gutierrez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(893,7,' Villa Huidobro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(894,7,' Villa La Bolsa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(895,7,' Villa Los Aromos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(896,7,' Villa Los Patos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(897,7,' Villa María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(898,7,' Villa Nueva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(899,7,' Villa Pque. Santa Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(900,7,' Villa Pque. Siquiman');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(901,7,' Villa Quillinzo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(902,7,' Villa Rossi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(903,7,' Villa Rumipal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(904,7,' Villa San Esteban');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(905,7,' Villa San Isidro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(906,7,' Villa 21');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(907,7,' Villa Sarmiento (G.R)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(908,7,' Villa Sarmiento (S.A)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(909,7,' Villa Tulumba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(910,7,' Villa Valeria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(911,7,' Villa Yacanto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(912,7,' Washington');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(913,7,' Wenceslao Escalante');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(914,7,' Ycho Cruz Sierras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(915,8,' Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(916,8,' Bella Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(917,8,' Berón de Astrada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(918,8,' Bonpland');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(919,8,' Caá Cati');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(920,8,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(921,8,' Chavarría');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(922,8,' Col. C. Pellegrini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(923,8,' Col. Libertad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(924,8,' Col. Liebig');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(925,8,' Col. Sta Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(926,8,' Concepción');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(927,8,' Cruz de Los Milagros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(928,8,' Curuzú-Cuatiá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(929,8,' Empedrado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(930,8,' Esquina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(931,8,' Estación Torrent');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(932,8,' Felipe Yofré');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(933,8,' Garruchos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(934,8,' Gdor. Agrónomo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(935,8,' Gdor. Martínez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(936,8,' Goya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(937,8,' Guaviravi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(938,8,' Herlitzka');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(939,8,' Ita-Ibate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(940,8,' Itatí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(941,8,' Ituzaingó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(942,8,' José Rafael Gómez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(943,8,' Juan Pujol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(944,8,' La Cruz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(945,8,' Lavalle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(946,8,' Lomas de Vallejos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(947,8,' Loreto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(948,8,' Mariano I. Loza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(949,8,' Mburucuyá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(950,8,' Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(951,8,' Mocoretá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(952,8,' Mte. Caseros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(953,8,' Nueve de Julio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(954,8,' Palmar Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(955,8,' Parada Pucheta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(956,8,' Paso de La Patria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(957,8,' Paso de Los Libres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(958,8,' Pedro R. Fernandez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(959,8,' Perugorría');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(960,8,' Pueblo Libertador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(961,8,' Ramada Paso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(962,8,' Riachuelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(963,8,' Saladas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(964,8,' San Antonio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(965,8,' San Carlos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(966,8,' San Cosme');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(967,8,' San Lorenzo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(968,8,' 20 del Palmar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(969,8,' San Miguel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(970,8,' San Roque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(971,8,' Santa Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(972,8,' Santa Lucía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(973,8,' Santo Tomé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(974,8,' Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(975,8,' Tabay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(976,8,' Tapebicuá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(977,8,' Tatacua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(978,8,' Virasoro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(979,8,' Yapeyú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(980,8,' Yataití Calle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(981,9,' Alarcón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(982,9,' Alcaraz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(983,9,' Alcaraz N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(984,9,' Alcaraz S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(985,9,' Aldea Asunción');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(986,9,' Aldea Brasilera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(987,9,' Aldea Elgenfeld');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(988,9,' Aldea Grapschental');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(989,9,' Aldea Ma. Luisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(990,9,' Aldea Protestante');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(991,9,' Aldea Salto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(992,9,' Aldea San Antonio (G)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(993,9,' Aldea San Antonio (P)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(994,9,' Aldea 19');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(995,9,' Aldea San Miguel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(996,9,' Aldea San Rafael');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(997,9,' Aldea Spatzenkutter');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(998,9,' Aldea Sta. María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(999,9,' Aldea Sta. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1000,9,' Aldea Valle María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1001,9,' Altamirano Sur');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1002,9,' Antelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1003,9,' Antonio Tomás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1004,9,' Aranguren');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1005,9,' Arroyo Barú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1006,9,' Arroyo Burgos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1007,9,' Arroyo Clé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1008,9,' Arroyo Corralito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1009,9,' Arroyo del Medio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1010,9,' Arroyo Maturrango');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1011,9,' Arroyo Palo Seco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1012,9,' Banderas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1013,9,' Basavilbaso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1014,9,' Betbeder');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1015,9,' Bovril');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1016,9,' Caseros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1017,9,' Ceibas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1018,9,' Cerrito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1019,9,' Chajarí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1020,9,' Chilcas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1021,9,' Clodomiro Ledesma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1022,9,' Col. Alemana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1023,9,' Col. Avellaneda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1024,9,' Col. Avigdor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1025,9,' Col. Ayuí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1026,9,' Col. Baylina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1027,9,' Col. Carrasco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1028,9,' Col. Celina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1029,9,' Col. Cerrito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1030,9,' Col. Crespo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1031,9,' Col. Elia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1032,9,' Col. Ensayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1033,9,' Col. Gral. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1034,9,' Col. La Argentina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1035,9,' Col. Merou');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1036,9,' Col. Oficial Nº3');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1037,9,' Col. Oficial Nº13');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1038,9,' Col. Oficial Nº14');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1039,9,' Col. Oficial Nº5');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1040,9,' Col. Reffino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1041,9,' Col. Tunas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1042,9,' Col. Viraró');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1043,9,' Colón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1044,9,' Concepción del Uruguay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1045,9,' Concordia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1046,9,' Conscripto Bernardi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1047,9,' Costa Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1048,9,' Costa San Antonio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1049,9,' Costa Uruguay N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1050,9,' Costa Uruguay S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1051,9,' Crespo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1052,9,' Crucecitas 3º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1053,9,' Crucecitas 7º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1054,9,' Crucecitas 8º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1055,9,' Cuchilla Redonda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1056,9,' Curtiembre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1057,9,' Diamante');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1058,9,' Distrito 6º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1059,9,' Distrito Chañar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1060,9,' Distrito Chiqueros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1061,9,' Distrito Cuarto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1062,9,' Distrito Diego López');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1063,9,' Distrito Pajonal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1064,9,' Distrito Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1065,9,' Distrito Tala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1066,9,' Distrito Talitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1067,9,' Don Cristóbal 1º Sección');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1068,9,' Don Cristóbal 2º Sección');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1069,9,' Durazno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1070,9,' El Cimarrón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1071,9,' El Gramillal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1072,9,' El Palenque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1073,9,' El Pingo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1074,9,' El Quebracho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1075,9,' El Redomón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1076,9,' El Solar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1077,9,' Enrique Carbo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1078,9,' 9');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1079,9,' Espinillo N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1080,9,' Estación Campos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1081,9,' Estación Escriña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1082,9,' Estación Lazo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1083,9,' Estación Raíces');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1084,9,' Estación Yerúa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1085,9,' Estancia Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1086,9,' Estancia Líbaros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1087,9,' Estancia Racedo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1088,9,' Estancia Solá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1089,9,' Estancia Yuquerí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1090,9,' Estaquitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1091,9,' Faustino M. Parera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1092,9,' Febre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1093,9,' Federación');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1094,9,' Federal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1095,9,' Gdor. Echagüe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1096,9,' Gdor. Mansilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1097,9,' Gilbert');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1098,9,' González Calderón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1099,9,' Gral. Almada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1100,9,' Gral. Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1101,9,' Gral. Campos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1102,9,' Gral. Galarza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1103,9,' Gral. Ramírez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1104,9,' Gualeguay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1105,9,' Gualeguaychú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1106,9,' Gualeguaycito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1107,9,' Guardamonte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1108,9,' Hambis');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1109,9,' Hasenkamp');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1110,9,' Hernandarias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1111,9,' Hernández');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1112,9,' Herrera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1113,9,' Hinojal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1114,9,' Hocker');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1115,9,' Ing. Sajaroff');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1116,9,' Irazusta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1117,9,' Isletas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1118,9,' J.J De Urquiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1119,9,' Jubileo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1120,9,' La Clarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1121,9,' La Criolla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1122,9,' La Esmeralda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1123,9,' La Florida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1124,9,' La Fraternidad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1125,9,' La Hierra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1126,9,' La Ollita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1127,9,' La Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1128,9,' La Picada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1129,9,' La Providencia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1130,9,' La Verbena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1131,9,' Laguna Benítez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1132,9,' Larroque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1133,9,' Las Cuevas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1134,9,' Las Garzas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1135,9,' Las Guachas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1136,9,' Las Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1137,9,' Las Moscas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1138,9,' Las Mulitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1139,9,' Las Toscas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1140,9,' Laurencena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1141,9,' Libertador San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1142,9,' Loma Limpia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1143,9,' Los Ceibos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1144,9,' Los Charruas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1145,9,' Los Conquistadores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1146,9,' Lucas González');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1147,9,' Lucas N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1148,9,' Lucas S. 1º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1149,9,' Lucas S. 2º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1150,9,' Maciá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1151,9,' María Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1152,9,' María Grande 2º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1153,9,' Médanos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1154,9,' Mojones N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1155,9,' Mojones S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1156,9,' Molino Doll');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1157,9,' Monte Redondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1158,9,' Montoya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1159,9,' Mulas Grandes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1160,9,' Ñancay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1161,9,' Nogoyá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1162,9,' Nueva Escocia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1163,9,' Nueva Vizcaya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1164,9,' Ombú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1165,9,' Oro Verde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1166,9,' Paraná');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1167,9,' Pasaje Guayaquil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1168,9,' Pasaje Las Tunas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1169,9,' Paso de La Arena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1170,9,' Paso de La Laguna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1171,9,' Paso de Las Piedras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1172,9,' Paso Duarte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1173,9,' Pastor Britos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1174,9,' Pedernal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1175,9,' Perdices');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1176,9,' Picada Berón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1177,9,' Piedras Blancas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1178,9,' Primer Distrito Cuchilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1179,9,' Primero de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1180,9,' Pronunciamiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1181,9,' Pto. Algarrobo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1182,9,' Pto. Ibicuy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1183,9,' Pueblo Brugo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1184,9,' Pueblo Cazes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1185,9,' Pueblo Gral. Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1186,9,' Pueblo Liebig');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1187,9,' Puerto Yeruá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1188,9,' Punta del Monte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1189,9,' Quebracho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1190,9,' Quinto Distrito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1191,9,' Raices Oeste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1192,9,' Rincón de Nogoyá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1193,9,' Rincón del Cinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1194,9,' Rincón del Doll');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1195,9,' Rincón del Gato');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1196,9,' Rocamora');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1197,9,' Rosario del Tala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1198,9,' San Benito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1199,9,' San Cipriano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1200,9,' San Ernesto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1201,9,' San Gustavo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1202,9,' San Jaime');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1203,9,' San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1204,9,' San José de Feliciano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1205,9,' San Justo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1206,9,' San Marcial');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1207,9,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1208,9,' San Ramírez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1209,9,' San Ramón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1210,9,' San Roque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1211,9,' San Salvador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1212,9,' San Víctor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1213,9,' Santa Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1214,9,' Santa Anita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1215,9,' Santa Elena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1216,9,' Santa Lucía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1217,9,' Santa Luisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1218,9,' Sauce de Luna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1219,9,' Sauce Montrull');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1220,9,' Sauce Pinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1221,9,' Sauce Sur');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1222,9,' Seguí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1223,9,' Sir Leonard');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1224,9,' Sosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1225,9,' Tabossi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1226,9,' Tezanos Pinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1227,9,' Ubajay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1228,9,' Urdinarrain');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1229,9,' Veinte de Septiembre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1230,9,' Viale');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1231,9,' Victoria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1232,9,' Villa Clara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1233,9,' Villa del Rosario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1234,9,' Villa Domínguez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1235,9,' Villa Elisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1236,9,' Villa Fontana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1237,9,' Villa Gdor. Etchevehere');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1238,9,' Villa Mantero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1239,9,' Villa Paranacito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1240,9,' Villa Urquiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1241,9,' Villaguay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1242,9,' Walter Moss');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1243,9,' Yacaré');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1244,9,' Yeso Oeste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1245,10,' Buena Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1246,10,' Clorinda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1247,10,' Col. Pastoril');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1248,10,' Cte. Fontana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1249,10,' El Colorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1250,10,' El Espinillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1251,10,' Estanislao Del Campo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1252,10,' 10');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1253,10,' Fortín Lugones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1254,10,' Gral. Lucio V. Mansilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1255,10,' Gral. Manuel Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1256,10,' Gral. Mosconi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1257,10,' Gran Guardia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1258,10,' Herradura');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1259,10,' Ibarreta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1260,10,' Ing. Juárez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1261,10,' Laguna Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1262,10,' Laguna Naick Neck');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1263,10,' Laguna Yema');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1264,10,' Las Lomitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1265,10,' Los Chiriguanos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1266,10,' Mayor V. Villafañe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1267,10,' Misión San Fco.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1268,10,' Palo Santo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1269,10,' Pirané');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1270,10,' Pozo del Maza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1271,10,' Riacho He-He');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1272,10,' San Hilario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1273,10,' San Martín II');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1274,10,' Siete Palmas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1275,10,' Subteniente Perín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1276,10,' Tres Lagunas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1277,10,' Villa Dos Trece');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1278,10,' Villa Escolar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1279,10,' Villa Gral. Güemes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1280,11,' Abdon Castro Tolay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1281,11,' Abra Pampa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1282,11,' Abralaite');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1283,11,' Aguas Calientes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1284,11,' Arrayanal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1285,11,' Barrios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1286,11,' Caimancito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1287,11,' Calilegua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1288,11,' Cangrejillos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1289,11,' Caspala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1290,11,' Catuá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1291,11,' Cieneguillas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1292,11,' Coranzulli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1293,11,' Cusi-Cusi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1294,11,' El Aguilar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1295,11,' El Carmen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1296,11,' El Cóndor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1297,11,' El Fuerte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1298,11,' El Piquete');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1299,11,' El Talar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1300,11,' Fraile Pintado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1301,11,' Hipólito Yrigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1302,11,' Huacalera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1303,11,' Humahuaca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1304,11,' La Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1305,11,' La Mendieta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1306,11,' La Quiaca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1307,11,' Ledesma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1308,11,' Libertador Gral. San Martin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1309,11,' Maimara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1310,11,' Mina Pirquitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1311,11,' Monterrico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1312,11,' Palma Sola');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1313,11,' Palpalá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1314,11,' Pampa Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1315,11,' Pampichuela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1316,11,' Perico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1317,11,' Puesto del Marqués');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1318,11,' Puesto Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1319,11,' Pumahuasi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1320,11,' Purmamarca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1321,11,' Rinconada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1322,11,' Rodeitos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1323,11,' Rosario de Río Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1324,11,' San Antonio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1325,11,' San Francisco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1326,11,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1327,11,' San Rafael');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1328,11,' San Salvador');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1329,11,' Santa Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1330,11,' Santa Catalina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1331,11,' Santa Clara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1332,11,' Susques');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1333,11,' Tilcara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1334,11,' Tres Cruces');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1335,11,' Tumbaya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1336,11,' Valle Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1337,11,' Vinalito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1338,11,' Volcán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1339,11,' Yala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1340,11,' Yaví');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1341,11,' Yuto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1342,12,' Abramo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1343,12,' Adolfo Van Praet');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1344,12,' Agustoni');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1345,12,' Algarrobo del Aguila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1346,12,' Alpachiri');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1347,12,' Alta Italia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1348,12,' Anguil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1349,12,' Arata');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1350,12,' Ataliva Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1351,12,' Bernardo Larroude');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1352,12,' Bernasconi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1353,12,' Caleufú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1354,12,' Carro Quemado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1355,12,' Catriló');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1356,12,' Ceballos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1357,12,' Chacharramendi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1358,12,' Col. Barón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1359,12,' Col. Santa María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1360,12,' Conhelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1361,12,' Coronel Hilario Lagos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1362,12,' Cuchillo-Có');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1363,12,' Doblas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1364,12,' Dorila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1365,12,' Eduardo Castex');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1366,12,' Embajador Martini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1367,12,' Falucho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1368,12,' Gral. Acha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1369,12,' Gral. Manuel Campos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1370,12,' Gral. Pico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1371,12,' Guatraché');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1372,12,' Ing. Luiggi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1373,12,' Intendente Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1374,12,' Jacinto Arauz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1375,12,' La Adela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1376,12,' La Humada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1377,12,' La Maruja');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1378,12,' 12');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1379,12,' La Reforma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1380,12,' Limay Mahuida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1381,12,' Lonquimay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1382,12,' Loventuel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1383,12,' Luan Toro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1384,12,' Macachín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1385,12,' Maisonnave');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1386,12,' Mauricio Mayer');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1387,12,' Metileo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1388,12,' Miguel Cané');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1389,12,' Miguel Riglos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1390,12,' Monte Nievas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1391,12,' Parera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1392,12,' Perú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1393,12,' Pichi-Huinca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1394,12,' Puelches');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1395,12,' Puelén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1396,12,' Quehue');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1397,12,' Quemú Quemú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1398,12,' Quetrequén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1399,12,' Rancul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1400,12,' Realicó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1401,12,' Relmo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1402,12,' Rolón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1403,12,' Rucanelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1404,12,' Sarah');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1405,12,' Speluzzi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1406,12,' Sta. Isabel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1407,12,' Sta. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1408,12,' Sta. Teresa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1409,12,' Telén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1410,12,' Toay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1411,12,' Tomas M. de Anchorena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1412,12,' Trenel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1413,12,' Unanue');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1414,12,' Uriburu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1415,12,' Veinticinco de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1416,12,' Vertiz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1417,12,' Victorica');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1418,12,' Villa Mirasol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1419,12,' Winifreda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1420,13,' Arauco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1421,13,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1422,13,' Castro Barros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1423,13,' Chamical');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1424,13,' Chilecito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1425,13,' Coronel F. Varela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1426,13,' Famatina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1427,13,' Gral. A.V.Peñaloza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1428,13,' Gral. Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1429,13,' Gral. J.F. Quiroga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1430,13,' Gral. Lamadrid');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1431,13,' Gral. Ocampo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1432,13,' Gral. San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1433,13,' Independencia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1434,13,' Rosario Penaloza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1435,13,' San Blas de Los Sauces');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1436,13,' Sanagasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1437,13,' Vinchina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1438,14,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1439,14,' Chacras de Coria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1440,14,' Dorrego');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1441,14,' Gllen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1442,14,' Godoy Cruz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1443,14,' Gral. Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1444,14,' Guaymallén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1445,14,' Junín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1446,14,' La Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1447,14,' Las Heras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1448,14,' Lavalle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1449,14,' Luján');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1450,14,' Luján De Cuyo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1451,14,' Maipú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1452,14,' Malargüe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1453,14,' Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1454,14,' San Carlos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1455,14,' San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1456,14,' San Rafael');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1457,14,' Sta. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1458,14,' Tunuyán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1459,14,' Tupungato');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1460,14,' Villa Nueva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1461,15,' Alba Posse');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1462,15,' Almafuerte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1463,15,' Apóstoles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1464,15,' Aristóbulo Del Valle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1465,15,' Arroyo Del Medio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1466,15,' Azara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1467,15,' Bdo. De Irigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1468,15,' Bonpland');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1469,15,' Caá Yari');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1470,15,' Campo Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1471,15,' Campo Ramón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1472,15,' Campo Viera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1473,15,' Candelaria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1474,15,' Capioví');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1475,15,' Caraguatay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1476,15,' Cdte. Guacurarí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1477,15,' Cerro Azul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1478,15,' Cerro Corá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1479,15,' Col. Alberdi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1480,15,' Col. Aurora');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1481,15,' Col. Delicia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1482,15,' Col. Polana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1483,15,' Col. Victoria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1484,15,' Col. Wanda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1485,15,' Concepción De La Sierra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1486,15,' Corpus');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1487,15,' Dos Arroyos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1488,15,' Dos de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1489,15,' El Alcázar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1490,15,' El Dorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1491,15,' El Soberbio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1492,15,' Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1493,15,' F. Ameghino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1494,15,' Fachinal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1495,15,' Garuhapé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1496,15,' Garupá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1497,15,' Gdor. López');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1498,15,' Gdor. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1499,15,' Gral. Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1500,15,' Gral. Urquiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1501,15,' Guaraní');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1502,15,' H. Yrigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1503,15,' Iguazú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1504,15,' Itacaruaré');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1505,15,' Jardín América');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1506,15,' Leandro N. Alem');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1507,15,' Libertad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1508,15,' Loreto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1509,15,' Los Helechos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1510,15,' Mártires');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1511,15,' 15');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1512,15,' Mojón Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1513,15,' Montecarlo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1514,15,' Nueve de Julio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1515,15,' Oberá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1516,15,' Olegario V. Andrade');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1517,15,' Panambí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1518,15,' Posadas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1519,15,' Profundidad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1520,15,' Pto. Iguazú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1521,15,' Pto. Leoni');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1522,15,' Pto. Piray');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1523,15,' Pto. Rico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1524,15,' Ruiz de Montoya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1525,15,' San Antonio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1526,15,' San Ignacio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1527,15,' San Javier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1528,15,' San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1529,15,' San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1530,15,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1531,15,' San Vicente');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1532,15,' Santiago De Liniers');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1533,15,' Santo Pipo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1534,15,' Sta. Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1535,15,' Sta. María');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1536,15,' Tres Capones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1537,15,' Veinticinco de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1538,15,' Wanda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1539,16,' Aguada San Roque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1540,16,' Aluminé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1541,16,' Andacollo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1542,16,' Añelo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1543,16,' Bajada del Agrio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1544,16,' Barrancas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1545,16,' Buta Ranquil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1546,16,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1547,16,' Caviahué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1548,16,' Centenario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1549,16,' Chorriaca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1550,16,' Chos Malal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1551,16,' Cipolletti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1552,16,' Covunco Abajo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1553,16,' Coyuco Cochico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1554,16,' Cutral Có');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1555,16,' El Cholar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1556,16,' El Huecú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1557,16,' El Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1558,16,' Guañacos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1559,16,' Huinganco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1560,16,' Las Coloradas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1561,16,' Las Lajas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1562,16,' Las Ovejas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1563,16,' Loncopué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1564,16,' Los Catutos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1565,16,' Los Chihuidos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1566,16,' Los Miches');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1567,16,' Manzano Amargo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1568,16,' 16');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1569,16,' Octavio Pico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1570,16,' Paso Aguerre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1571,16,' Picún Leufú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1572,16,' Piedra del Aguila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1573,16,' Pilo Lil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1574,16,' Plaza Huincul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1575,16,' Plottier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1576,16,' Quili Malal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1577,16,' Ramón Castro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1578,16,' Rincón de Los Sauces');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1579,16,' San Martín de Los Andes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1580,16,' San Patricio del Chañar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1581,16,' Santo Tomás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1582,16,' Sauzal Bonito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1583,16,' Senillosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1584,16,' Taquimilán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1585,16,' Tricao Malal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1586,16,' Varvarco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1587,16,' Villa Curí Leuvu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1588,16,' Villa del Nahueve');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1589,16,' Villa del Puente Picún Leuvú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1590,16,' Villa El Chocón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1591,16,' Villa La Angostura');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1592,16,' Villa Pehuenia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1593,16,' Villa Traful');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1594,16,' Vista Alegre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1595,16,' Zapala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1596,17,' Aguada Cecilio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1597,17,' Aguada de Guerra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1598,17,' Allén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1599,17,' Arroyo de La Ventana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1600,17,' Arroyo Los Berros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1601,17,' Bariloche');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1602,17,' Calte. Cordero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1603,17,' Campo Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1604,17,' Catriel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1605,17,' Cerro Policía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1606,17,' Cervantes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1607,17,' Chelforo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1608,17,' Chimpay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1609,17,' Chinchinales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1610,17,' Chipauquil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1611,17,' Choele Choel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1612,17,' Cinco Saltos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1613,17,' Cipolletti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1614,17,' Clemente Onelli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1615,17,' Colán Conhue');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1616,17,' Comallo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1617,17,' Comicó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1618,17,' Cona Niyeu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1619,17,' Coronel Belisle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1620,17,' Cubanea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1621,17,' Darwin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1622,17,' Dina Huapi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1623,17,' El Bolsón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1624,17,' El Caín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1625,17,' El Manso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1626,17,' Gral. Conesa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1627,17,' Gral. Enrique Godoy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1628,17,' Gral. Fernandez Oro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1629,17,' Gral. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1630,17,' Guardia Mitre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1631,17,' Ing. Huergo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1632,17,' Ing. Jacobacci');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1633,17,' Laguna Blanca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1634,17,' Lamarque');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1635,17,' Las Grutas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1636,17,' Los Menucos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1637,17,' Luis Beltrán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1638,17,' Mainqué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1639,17,' Mamuel Choique');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1640,17,' Maquinchao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1641,17,' Mencué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1642,17,' Mtro. Ramos Mexia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1643,17,' Nahuel Niyeu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1644,17,' Naupa Huen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1645,17,' Ñorquinco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1646,17,' Ojos de Agua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1647,17,' Paso de Agua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1648,17,' Paso Flores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1649,17,' Peñas Blancas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1650,17,' Pichi Mahuida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1651,17,' Pilcaniyeu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1652,17,' Pomona');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1653,17,' Prahuaniyeu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1654,17,' Rincón Treneta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1655,17,' Río Chico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1656,17,' Río Colorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1657,17,' Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1658,17,' San Antonio Oeste');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1659,17,' San Javier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1660,17,' Sierra Colorada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1661,17,' Sierra Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1662,17,' Sierra Pailemán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1663,17,' Valcheta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1664,17,' Valle Azul');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1665,17,' Viedma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1666,17,' Villa Llanquín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1667,17,' Villa Mascardi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1668,17,' Villa Regina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1669,17,' Yaminué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1670,18,' A. Saravia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1671,18,' Aguaray');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1672,18,' Angastaco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1673,18,' Animaná');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1674,18,' Cachi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1675,18,' Cafayate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1676,18,' Campo Quijano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1677,18,' Campo Santo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1678,18,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1679,18,' Cerrillos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1680,18,' Chicoana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1681,18,' Col. Sta. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1682,18,' Coronel Moldes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1683,18,' El Bordo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1684,18,' El Carril');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1685,18,' El Galpón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1686,18,' El Jardín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1687,18,' El Potrero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1688,18,' El Quebrachal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1689,18,' El Tala');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1690,18,' Embarcación');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1691,18,' Gral. Ballivian');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1692,18,' Gral. Güemes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1693,18,' Gral. Mosconi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1694,18,' Gral. Pizarro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1695,18,' Guachipas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1696,18,' Hipólito Yrigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1697,18,' Iruyá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1698,18,' Isla De Cañas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1699,18,' J. V. Gonzalez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1700,18,' La Caldera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1701,18,' La Candelaria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1702,18,' La Merced');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1703,18,' La Poma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1704,18,' La Viña');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1705,18,' Las Lajitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1706,18,' Los Toldos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1707,18,' Metán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1708,18,' Molinos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1709,18,' Nazareno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1710,18,' Orán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1711,18,' Payogasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1712,18,' Pichanal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1713,18,' Prof. S. Mazza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1714,18,' Río Piedras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1715,18,' Rivadavia Banda Norte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1716,18,' Rivadavia Banda Sur');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1717,18,' Rosario de La Frontera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1718,18,' Rosario de Lerma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1719,18,' Saclantás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1720,18,' 18');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1721,18,' San Antonio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1722,18,' San Carlos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1723,18,' San José De Metán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1724,18,' San Ramón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1725,18,' Santa Victoria E.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1726,18,' Santa Victoria O.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1727,18,' Tartagal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1728,18,' Tolar Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1729,18,' Urundel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1730,18,' Vaqueros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1731,18,' Villa San Lorenzo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1732,19,' Albardón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1733,19,' Angaco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1734,19,' Calingasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1735,19,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1736,19,' Caucete');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1737,19,' Chimbas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1738,19,' Iglesia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1739,19,' Jachal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1740,19,' Nueve de Julio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1741,19,' Pocito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1742,19,' Rawson');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1743,19,' Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1744,19,' 19');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1745,19,' San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1746,19,' Santa Lucía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1747,19,' Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1748,19,' Ullum');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1749,19,' Valle Fértil');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1750,19,' Veinticinco de Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1751,19,' Zonda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1752,20,' Alto Pelado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1753,20,' Alto Pencoso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1754,20,' Anchorena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1755,20,' Arizona');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1756,20,' Bagual');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1757,20,' Balde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1758,20,' Batavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1759,20,' Beazley');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1760,20,' Buena Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1761,20,' Candelaria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1762,20,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1763,20,' Carolina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1764,20,' Carpintería');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1765,20,' Concarán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1766,20,' Cortaderas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1767,20,' El Morro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1768,20,' El Trapiche');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1769,20,' El Volcán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1770,20,' Fortín El Patria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1771,20,' Fortuna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1772,20,' Fraga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1773,20,' Juan Jorba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1774,20,' Juan Llerena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1775,20,' Juana Koslay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1776,20,' Justo Daract');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1777,20,' La Calera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1778,20,' La Florida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1779,20,' La Punilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1780,20,' La Toma');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1781,20,' Lafinur');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1782,20,' Las Aguadas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1783,20,' Las Chacras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1784,20,' Las Lagunas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1785,20,' Las Vertientes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1786,20,' Lavaisse');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1787,20,' Leandro N. Alem');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1788,20,' Los Molles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1789,20,' Luján');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1790,20,' Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1791,20,' Merlo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1792,20,' Naschel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1793,20,' Navia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1794,20,' Nogolí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1795,20,' Nueva Galia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1796,20,' Papagayos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1797,20,' Paso Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1798,20,' Potrero de Los Funes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1799,20,' Quines');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1800,20,' Renca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1801,20,' Saladillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1802,20,' San Francisco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1803,20,' San Gerónimo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1804,20,' San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1805,20,' San Pablo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1806,20,' Santa Rosa de Conlara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1807,20,' Talita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1808,20,' Tilisarao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1809,20,' Unión');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1810,20,' Villa de La Quebrada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1811,20,' Villa de Praga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1812,20,' Villa del Carmen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1813,20,' Villa Gral. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1814,20,' Villa Larca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1815,20,' Villa Mercedes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1816,20,' Zanjitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1817,21,' Calafate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1818,21,' Caleta Olivia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1819,21,' Cañadón Seco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1820,21,' Comandante Piedrabuena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1821,21,' El Calafate');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1822,21,' El Chaltén');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1823,21,' Gdor. Gregores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1824,21,' Hipólito Yrigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1825,21,' Jaramillo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1826,21,' Koluel Kaike');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1827,21,' Las Heras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1828,21,' Los Antiguos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1829,21,' Perito Moreno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1830,21,' Pico Truncado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1831,21,' Pto. Deseado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1832,21,' Pto. San Julián');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1833,21,' Pto. 21');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1834,21,' Río Cuarto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1835,21,' Río Gallegos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1836,21,' Río Turbio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1837,21,' Tres Lagos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1838,21,' Veintiocho De Noviembre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1839,22,' Aarón Castellanos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1840,22,' Acebal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1841,22,' Aguará Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1842,22,' Albarellos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1843,22,' Alcorta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1844,22,' Aldao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1845,22,' Alejandra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1846,22,' Álvarez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1847,22,' Ambrosetti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1848,22,' Amenábar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1849,22,' Angélica');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1850,22,' Angeloni');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1851,22,' Arequito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1852,22,' Arminda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1853,22,' Armstrong');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1854,22,' Arocena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1855,22,' Arroyo Aguiar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1856,22,' Arroyo Ceibal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1857,22,' Arroyo Leyes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1858,22,' Arroyo Seco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1859,22,' Arrufó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1860,22,' Arteaga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1861,22,' Ataliva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1862,22,' Aurelia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1863,22,' Avellaneda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1864,22,' Barrancas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1865,22,' Bauer Y Sigel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1866,22,' Bella Italia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1867,22,' Berabevú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1868,22,' Berna');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1869,22,' Bernardo de Irigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1870,22,' Bigand');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1871,22,' Bombal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1872,22,' Bouquet');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1873,22,' Bustinza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1874,22,' Cabal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1875,22,' Cacique Ariacaiquin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1876,22,' Cafferata');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1877,22,' Calchaquí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1878,22,' Campo Andino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1879,22,' Campo Piaggio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1880,22,' Cañada de Gómez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1881,22,' Cañada del Ucle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1882,22,' Cañada Rica');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1883,22,' Cañada Rosquín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1884,22,' Candioti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1885,22,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1886,22,' Capitán Bermúdez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1887,22,' Capivara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1888,22,' Carcarañá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1889,22,' Carlos Pellegrini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1890,22,' Carmen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1891,22,' Carmen Del Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1892,22,' Carreras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1893,22,' Carrizales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1894,22,' Casalegno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1895,22,' Casas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1896,22,' Casilda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1897,22,' Castelar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1898,22,' Castellanos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1899,22,' Cayastá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1900,22,' Cayastacito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1901,22,' Centeno');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1902,22,' Cepeda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1903,22,' Ceres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1904,22,' Chabás');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1905,22,' Chañar Ladeado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1906,22,' Chapuy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1907,22,' Chovet');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1908,22,' Christophersen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1909,22,' Classon');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1910,22,' Cnel. Arnold');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1911,22,' Cnel. Bogado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1912,22,' Cnel. Dominguez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1913,22,' Cnel. Fraga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1914,22,' Col. Aldao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1915,22,' Col. Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1916,22,' Col. Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1917,22,' Col. Bicha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1918,22,' Col. Bigand');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1919,22,' Col. Bossi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1920,22,' Col. Cavour');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1921,22,' Col. Cello');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1922,22,' Col. Dolores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1923,22,' Col. Dos Rosas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1924,22,' Col. Durán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1925,22,' Col. Iturraspe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1926,22,' Col. Margarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1927,22,' Col. Mascias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1928,22,' Col. Raquel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1929,22,' Col. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1930,22,' Col. San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1931,22,' Constanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1932,22,' Coronda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1933,22,' Correa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1934,22,' Crispi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1935,22,' Cululú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1936,22,' Curupayti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1937,22,' Desvio Arijón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1938,22,' Diaz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1939,22,' Diego de Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1940,22,' Egusquiza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1941,22,' El Arazá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1942,22,' El Rabón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1943,22,' El Sombrerito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1944,22,' El Trébol');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1945,22,' Elisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1946,22,' Elortondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1947,22,' Emilia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1948,22,' Empalme San Carlos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1949,22,' Empalme Villa Constitucion');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1950,22,' Esmeralda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1951,22,' Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1952,22,' Estación Alvear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1953,22,' Estacion Clucellas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1954,22,' Esteban Rams');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1955,22,' Esther');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1956,22,' Esustolia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1957,22,' Eusebia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1958,22,' Felicia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1959,22,' Fidela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1960,22,' Fighiera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1961,22,' Firmat');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1962,22,' Florencia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1963,22,' Fortín Olmos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1964,22,' Franck');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1965,22,' Fray Luis Beltrán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1966,22,' Frontera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1967,22,' Fuentes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1968,22,' Funes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1969,22,' Gaboto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1970,22,' Galisteo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1971,22,' Gálvez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1972,22,' Garabalto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1973,22,' Garibaldi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1974,22,' Gato Colorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1975,22,' Gdor. Crespo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1976,22,' Gessler');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1977,22,' Godoy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1978,22,' Golondrina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1979,22,' Gral. Gelly');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1980,22,' Gral. Lagos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1981,22,' Granadero Baigorria');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1982,22,' Gregoria Perez De Denis');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1983,22,' Grutly');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1984,22,' Guadalupe N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1985,22,' GÃ¶deken');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1986,22,' Helvecia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1987,22,' Hersilia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1988,22,' Hipatía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1989,22,' Huanqueros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1990,22,' Hugentobler');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1991,22,' Hughes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1992,22,' Humberto 1º');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1993,22,' Humboldt');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1994,22,' Ibarlucea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1995,22,' Ing. Chanourdie');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1996,22,' Intiyaco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1997,22,' Ituzaingó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1998,22,' Jacinto L. Aráuz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(1999,22,' Josefina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2000,22,' Juan B. Molina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2001,22,' Juan de Garay');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2002,22,' Juncal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2003,22,' La Brava');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2004,22,' La Cabral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2005,22,' La Camila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2006,22,' La Chispa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2007,22,' La Clara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2008,22,' La Criolla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2009,22,' La Gallareta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2010,22,' La Lucila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2011,22,' La Pelada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2012,22,' La Penca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2013,22,' La Rubia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2014,22,' La Sarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2015,22,' La Vanguardia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2016,22,' Labordeboy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2017,22,' Laguna Paiva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2018,22,' Landeta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2019,22,' Lanteri');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2020,22,' Larrechea');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2021,22,' Las Avispas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2022,22,' Las Bandurrias');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2023,22,' Las Garzas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2024,22,' Las Palmeras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2025,22,' Las Parejas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2026,22,' Las Petacas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2027,22,' Las Rosas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2028,22,' Las Toscas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2029,22,' Las Tunas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2030,22,' Lazzarino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2031,22,' Lehmann');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2032,22,' Llambi Campbell');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2033,22,' Logroño');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2034,22,' Loma Alta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2035,22,' López');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2036,22,' Los Amores');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2037,22,' Los Cardos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2038,22,' Los Laureles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2039,22,' Los Molinos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2040,22,' Los Quirquinchos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2041,22,' Lucio V. Lopez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2042,22,' Luis Palacios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2043,22,' Ma. Juana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2044,22,' Ma. Luisa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2045,22,' Ma. Susana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2046,22,' Ma. Teresa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2047,22,' Maciel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2048,22,' Maggiolo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2049,22,' Malabrigo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2050,22,' Marcelino Escalada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2051,22,' Margarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2052,22,' Matilde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2053,22,' Mauá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2054,22,' Máximo Paz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2055,22,' Melincué');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2056,22,' Miguel Torres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2057,22,' Moisés Ville');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2058,22,' Monigotes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2059,22,' Monje');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2060,22,' Monte Obscuridad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2061,22,' Monte Vera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2062,22,' Montefiore');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2063,22,' Montes de Oca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2064,22,' Murphy');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2065,22,' Ñanducita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2066,22,' Naré');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2067,22,' Nelson');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2068,22,' Nicanor E. Molinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2069,22,' Nuevo Torino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2070,22,' Oliveros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2071,22,' Palacios');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2072,22,' Pavón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2073,22,' Pavón Arriba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2074,22,' Pedro Gómez Cello');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2075,22,' Pérez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2076,22,' Peyrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2077,22,' Piamonte');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2078,22,' Pilar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2079,22,' Piñero');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2080,22,' Plaza Clucellas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2081,22,' Portugalete');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2082,22,' Pozo Borrado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2083,22,' Progreso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2084,22,' Providencia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2085,22,' Pte. Roca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2086,22,' Pueblo Andino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2087,22,' Pueblo Esther');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2088,22,' Pueblo Gral. San Martín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2089,22,' Pueblo Irigoyen');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2090,22,' Pueblo Marini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2091,22,' Pueblo Muñoz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2092,22,' Pueblo Uranga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2093,22,' Pujato');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2094,22,' Pujato N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2095,22,' Rafaela');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2096,22,' Ramayón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2097,22,' Ramona');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2098,22,' Reconquista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2099,22,' Recreo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2100,22,' Ricardone');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2101,22,' Rivadavia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2102,22,' Roldán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2103,22,' Romang');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2104,22,' Rosario');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2105,22,' Rueda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2106,22,' Rufino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2107,22,' Sa Pereira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2108,22,' Saguier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2109,22,' Saladero M. Cabal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2110,22,' Salto Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2111,22,' San Agustín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2112,22,' San Antonio de Obligado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2113,22,' San Bernardo (N.J.)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2114,22,' San Bernardo (S.J.)');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2115,22,' San Carlos Centro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2116,22,' San Carlos N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2117,22,' San Carlos S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2118,22,' San Cristóbal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2119,22,' San Eduardo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2120,22,' San Eugenio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2121,22,' San Fabián');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2122,22,' San Fco. de Santa Fé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2123,22,' San Genaro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2124,22,' San Genaro N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2125,22,' San Gregorio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2126,22,' San Guillermo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2127,22,' San Javier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2128,22,' San Jerónimo del Sauce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2129,22,' San Jerónimo N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2130,22,' San Jerónimo S.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2131,22,' San Jorge');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2132,22,' San José de La Esquina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2133,22,' San José del Rincón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2134,22,' San Justo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2135,22,' San Lorenzo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2136,22,' San Mariano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2137,22,' San Martín de Las Escobas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2138,22,' San Martín N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2139,22,' San Vicente');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2140,22,' Sancti Spititu');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2141,22,' Sanford');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2142,22,' Santo Domingo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2143,22,' Santo Tomé');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2144,22,' Santurce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2145,22,' Sargento Cabral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2146,22,' Sarmiento');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2147,22,' Sastre');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2148,22,' Sauce Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2149,22,' Serodino');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2150,22,' Silva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2151,22,' Soldini');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2152,22,' Soledad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2153,22,' Soutomayor');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2154,22,' Sta. Clara de Buena Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2155,22,' Sta. Clara de Saguier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2156,22,' Sta. Isabel');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2157,22,' Sta. Margarita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2158,22,' Sta. Maria Centro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2159,22,' Sta. María N.');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2160,22,' Sta. Rosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2161,22,' Sta. Teresa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2162,22,' Suardi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2163,22,' Sunchales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2164,22,' Susana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2165,22,' Tacuarendí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2166,22,' Tacural');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2167,22,' Tartagal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2168,22,' Teodelina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2169,22,' Theobald');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2170,22,' Timbúes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2171,22,' Toba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2172,22,' Tortugas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2173,22,' Tostado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2174,22,' Totoras');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2175,22,' Traill');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2176,22,' Venado Tuerto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2177,22,' Vera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2178,22,' Vera y Pintado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2179,22,' Videla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2180,22,' Vila');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2181,22,' Villa Amelia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2182,22,' Villa Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2183,22,' Villa Cañas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2184,22,' Villa Constitución');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2185,22,' Villa Eloísa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2186,22,' Villa Gdor. Gálvez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2187,22,' Villa Guillermina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2188,22,' Villa Minetti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2189,22,' Villa Mugueta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2190,22,' Villa Ocampo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2191,22,' Villa San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2192,22,' Villa Saralegui');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2193,22,' Villa Trinidad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2194,22,' Villada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2195,22,' Virginia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2196,22,' Wheelwright');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2197,22,' Zavalla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2198,22,' Zenón Pereira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2199,23,' Añatuya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2200,23,' Árraga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2201,23,' Bandera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2202,23,' Bandera Bajada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2203,23,' Beltrán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2204,23,' Brea Pozo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2205,23,' Campo Gallo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2206,23,' Capital');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2207,23,' Chilca Juliana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2208,23,' Choya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2209,23,' Clodomira');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2210,23,' Col. Alpina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2211,23,' Col. Dora');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2212,23,' Col. El Simbolar Robles');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2213,23,' El Bobadal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2214,23,' El Charco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2215,23,' El Mojón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2216,23,' Estación Atamisqui');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2217,23,' Estación Simbolar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2218,23,' Fernández');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2219,23,' Fortín Inca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2220,23,' Frías');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2221,23,' Garza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2222,23,' Gramilla');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2223,23,' Guardia Escolta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2224,23,' Herrera');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2225,23,' Icaño');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2226,23,' Ing. Forres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2227,23,' La Banda');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2228,23,' La Cañada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2229,23,' Laprida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2230,23,' Lavalle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2231,23,' Loreto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2232,23,' Los Juríes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2233,23,' Los Núñez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2234,23,' Los Pirpintos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2235,23,' Los Quiroga');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2236,23,' Los Telares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2237,23,' Lugones');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2238,23,' Malbrán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2239,23,' Matara');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2240,23,' Medellín');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2241,23,' Monte Quemado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2242,23,' Nueva Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2243,23,' Nueva Francia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2244,23,' Palo Negro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2245,23,' Pampa de Los Guanacos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2246,23,' Pinto');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2247,23,' Pozo Hondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2248,23,' Quimilí');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2249,23,' Real Sayana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2250,23,' Sachayoj');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2251,23,' San Pedro de Guasayán');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2252,23,' Selva');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2253,23,' Sol de Julio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2254,23,' Sumampa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2255,23,' Suncho Corral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2256,23,' Taboada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2257,23,' Tapso');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2258,23,' Termas de Rio Hondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2259,23,' Tintina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2260,23,' Tomas Young');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2261,23,' Vilelas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2262,23,' Villa Atamisqui');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2263,23,' Villa La Punta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2264,23,' Villa Ojo de Agua');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2265,23,' Villa Río Hondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2266,23,' Villa Salavina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2267,23,' Villa Unión');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2268,23,' Vilmer');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2269,23,' Weisburd');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2270,24,' Río Grande');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2271,24,' Tolhuin');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2272,24,' Ushuaia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2273,25,' Acheral');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2274,25,' Agua Dulce');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2275,25,' Aguilares');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2276,25,' Alderetes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2277,25,' Alpachiri');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2278,25,' Alto Verde');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2279,25,' Amaicha del Valle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2280,25,' Amberes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2281,25,' Ancajuli');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2282,25,' Arcadia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2283,25,' Atahona');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2284,25,' Banda del Río Sali');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2285,25,' Bella Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2286,25,' Buena Vista');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2287,25,' Burruyacú');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2288,25,' Capitán Cáceres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2289,25,' Cevil Redondo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2290,25,' Choromoro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2291,25,' Ciudacita');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2292,25,' Colalao del Valle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2293,25,' Colombres');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2294,25,' Concepción');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2295,25,' Delfín Gallo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2296,25,' El Bracho');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2297,25,' El Cadillal');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2298,25,' El Cercado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2299,25,' El Chañar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2300,25,' El Manantial');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2301,25,' El Mojón');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2302,25,' El Mollar');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2303,25,' El Naranjito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2304,25,' El Naranjo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2305,25,' El Polear');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2306,25,' El Puestito');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2307,25,' El Sacrificio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2308,25,' El Timbó');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2309,25,' Escaba');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2310,25,' Esquina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2311,25,' Estación Aráoz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2312,25,' Famaillá');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2313,25,' Gastone');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2314,25,' Gdor. Garmendia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2315,25,' Gdor. Piedrabuena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2316,25,' Graneros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2317,25,' Huasa Pampa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2318,25,' J. B. Alberdi');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2319,25,' La Cocha');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2320,25,' La Esperanza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2321,25,' La Florida');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2322,25,' La Ramada');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2323,25,' La Trinidad');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2324,25,' Lamadrid');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2325,25,' Las Cejas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2326,25,' Las Talas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2327,25,' Las Talitas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2328,25,' Los Bulacio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2329,25,' Los Gómez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2330,25,' Los Nogales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2331,25,' Los Pereyra');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2332,25,' Los Pérez');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2333,25,' Los Puestos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2334,25,' Los Ralos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2335,25,' Los Sarmientos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2336,25,' Los Sosa');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2337,25,' Lules');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2338,25,' M. García Fernández');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2339,25,' Manuela Pedraza');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2340,25,' Medinas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2341,25,' Monte Bello');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2342,25,' Monteagudo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2343,25,' Monteros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2344,25,' Padre Monti');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2345,25,' Pampa Mayo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2346,25,' Quilmes');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2347,25,' Raco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2348,25,' Ranchillos');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2349,25,' Río Chico');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2350,25,' Río Colorado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2351,25,' Río Seco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2352,25,' Rumi Punco');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2353,25,' San Andrés');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2354,25,' San Felipe');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2355,25,' San Ignacio');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2356,25,' San Javier');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2357,25,' San José');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2358,25,' San Miguel de 25');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2359,25,' San Pedro');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2360,25,' San Pedro de Colalao');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2361,25,' Santa Rosa de Leales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2362,25,' Sgto. Moya');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2363,25,' Siete de Abril');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2364,25,' Simoca');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2365,25,' Soldado Maldonado');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2366,25,' Sta. Ana');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2367,25,' Sta. Cruz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2368,25,' Sta. Lucía');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2369,25,' Taco Ralo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2370,25,' Tafí del Valle');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2371,25,' Tafí Viejo');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2372,25,' Tapia');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2373,25,' Teniente Berdina');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2374,25,' Trancas');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2375,25,' Villa Belgrano');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2376,25,' Villa Benjamín Araoz');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2377,25,' Villa Chiligasta');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2378,25,' Villa de Leales');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2379,25,' Villa Quinteros');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2380,25,' Yánima');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2381,25,' Yerba Buena');
Insert  Into  Localidad(ID_Localidad, ID_Provincia, Localidad) Values(2382,25,' Yerba Buena (S)');




--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `CodMateria` varchar(4) NOT NULL,
  `CodCarrera` varchar(2) NOT NULL,
  `Materia` varchar(50) NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`CodMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
UNLOCK TABLES;


-- nsert Materia

Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS11','AS',' Organización Empresarial',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS12','AS',' Introducción a la informática',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS13','AS',' Programación I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS14','AS',' Taller de Computación I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS15','AS',' Matemática',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS16','AS',' Inglés Técnico I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS21','AS',' Sistemas Administrativos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS22','AS',' Arquitectura y Sistemas Operativos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS23','AS',' Programación II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS24','AS',' Taller de Computación II ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS25','AS',' Estadística',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS26','AS',' Inglés Técnico II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS31','AS',' Modelos Estratégicos de Negocios',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS32','AS',' Diseño y Administración de Base de Datos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS33','AS',' Programación III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS34','AS',' Taller de Computación III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS35','AS',' Ética',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS41','AS',' Análisis y Metodología de Sistemas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS42','AS',' Redes y Sistemas Operativos Distribuidos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS43','AS',' Seminario de Programación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS44','AS',' Taller de Computación IV',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS45','AS',' Simulación ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS46','AS',' Deontología Profesional ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS51','AS',' Administración de Proyectos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS52','AS',' Diseño de Sistemas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS53','AS',' Calidad de Software',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS54','AS',' Taller de Computación V',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS55','AS',' Informática y Sociedad',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS61','AS',' Seminario de Sistemas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS62','AS',' Seguridad e Integridad de Sistemas ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS63','AS',' Seminario de Tecnología ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS64','AS',' Computación Avanzada',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('AS65','AS',' Taller de Computación VI',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA11','CA',' Ilustración Digital',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA12','CA',' Tratamiento Digital de la Imagen',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA13','CA',' Iluminación y Cámara',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA14','CA',' Guión I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA15','CA',' Teoría de la Comunicación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA16','CA',' Dibujo I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA21','CA',' Producción Audiovisual',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA22','CA',' Sonido',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA23','CA',' Animación Digital 2D',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA24','CA',' Panorama de la Literatura',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA25','CA',' Semiótica del Cine',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA26','CA',' Dibujo II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA31','CA',' Lenguaje Cinematográfico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA32','CA',' Dirección de Actores',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA33','CA',' Animación Digital 3D I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA34','CA',' Guión II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA35','CA',' Historia del Cine I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA36','CA',' Dibujo III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA41','CA',' Cine de Animación I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA42','CA',' Caracterización de Personajes',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA43','CA',' Animación Digital 3D II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA44','CA',' Literatura Argentina y Latinoamericana',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA45','CA',' Historia del Cine II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA46','CA',' Arte y Percepción Visual',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA51','CA',' Cine de Animación II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA52','CA',' Escenografía y Vestuario',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA53','CA',' Animación Digital 3D III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA54','CA',' Estética del Cine',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA55','CA',' Cine Publicitario',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA56','CA',' Ética y Deontología Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA61','CA',' Técnicas Audiovisuales',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA62','CA',' Dirección de Arte',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA63','CA',' Animación Digital 3D IV',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA64','CA',' Producción Ejecutiva y Comercialización',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA65','CA',' Historia del Arte',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('CA66','CA',' Seminario Final',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG11','DG',' Diseño en Comunicación Visual ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG12','DG',' Morfología ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG13','DG',' Psicología General y Evolutiva',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG14','DG',' Introducción a la Historia del Diseño y el Arte',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG15','DG',' 5 Computación Editorial ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG21','DG',' Diseño de Marcas y Envases',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG22','DG',' Formas y Estructuras',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG23','DG',' Tipografía',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG24','DG',' Arte y Diseño del Siglo XIX',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG25','DG',' Computación para Dibujo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG31','DG',' Diseño y Publicidad',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG32','DG',' Recursos Expresivos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG33','DG',' Lenguaje Visual',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG34','DG',' Psicología Social',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG35','DG',' Computación para Texto e Ilustración',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG36','DG',' Vanguardias del Arte y Diseño del Siglo XX',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG41','DG',' Diseño de Producto',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG42','DG',' Medios Audiovisuales',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG43','DG',' Imagen y Creatividad',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG44','DG',' Psicología de la Comunicación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG45','DG',' Arte y Diseño Contemporáneo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG46','DG',' Computación para la Imagen',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG51','DG',' Diseño y Contexto',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG52','DG',' Técnicas de Representación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG53','DG',' Computación para Originales Digitales',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG54','DG',' Estructura del Relato Visual',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG55','DG',' Tecnología del Diseño',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG56','DG',' Ética y Deontología Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG61','DG',' Diseño de la Identidad Corporativa',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG62','DG',' Producción Gráfica',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG63','DG',' Presentación de Proyectos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG64','DG',' Computación para Animación y Web',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DG65','DG',' Diseño en Cine y Video',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM11','DM',' Ilustración Digital',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM12','DM',' Tratamiento de la Imagen Gráfica',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM13','DM',' Metodología de Resolución de Problemas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM14','DM',' Diseño Gráfico Publicitario I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM15','DM',' Representación Gráfica',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM16','DM',' Psicología de la Comunicación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM21','DM',' Producción y Realización de Video',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM22','DM',' Sonido Digital',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM23','DM',' Programación Visual I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM24','DM',' Diseño Gráfico Publicitario II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM25','DM',' Dibujo Técnico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM26','DM',' Semiología de la Imagen',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM31','DM',' Diseño Interactivo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM32','DM',' Tecnología de las Comunicaciones I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM33','DM',' Programación Visual II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM34','DM',' Animación Computada I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM35','DM',' Construcción del Guión',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM36','DM',' Inglés Técnico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM41','DM',' Lenguaje Audiovisual I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM42','DM',' Tecnología de las Comunicaciones II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM43','DM',' Programación Visual III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM44','DM',' Animación Computada II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM45','DM',' Campañas Publicitarias',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM46','DM',' Ética y Deontología Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM51','DM',' Lenguaje Audiovisual II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM52','DM',' Tecnología de las Comunicaciones III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM53','DM',' Historia del Arte',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM54','DM',' Animación Computada III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM55','DM',' Técnicas de Marketing',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM61','DM',' Diseño de las Comunicaciones ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM62','DM',' Plataformas Operativas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM63','DM',' Cultura y Medios de Comunicación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM64','DM',' Arte Contemporáneo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DM65','DM',' Seminario Final',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW11','DW',' Tecnología de las Comunicaciones I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW12','DW',' Diseño de Interfaces',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW13','DW',' Introducción a la Programación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW14','DW',' Construcción del Guión Interactivo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW15','DW',' Diseño Gráfico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW16','DW',' Psicología de la Comunicación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW21','DW',' Tecnología de las Comunicaciones II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW22','DW',' Sistemas Operativos I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW23','DW',' Programación I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW24','DW',' Diseño Interactivo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW25','DW',' Procesos Contables',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW26','DW',' Técnicas de Marketing',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW31','DW',' Tecnología de las Comunicaciones III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW32','DW',' Sistemas Operativos II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW33','DW',' Programación II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW34','DW',' Sistemas de Información y Control',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW35','DW',' Tecnología e Informática',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW36','DW',' Clientes Web',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW41','DW',' Tecnología de las Comunicaciones IV ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW42','DW',' Sistemas Operativos III ',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW43','DW',' Programación III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW44','DW',' Inglés Técnico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW45','DW',' Diseño Visual Compositivo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW46','DW',' Técnicas de Marketing',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW51','DW',' Usabilidad y Funcionalidad en el Diseño',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW52','DW',' Sistemas Operativos III',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW53','DW',' Clientes Web Mobile',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW54','DW',' Planificación de Proyectos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW55','DW',' Procesos Contables y Administrativos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW61','DW',' Identidad Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW62','DW',' Programación con Entornos de Trabajo',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW63','DW',' Diseño y Seguridad Informática',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW64','DW',' Ética y Deontología Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('DW65','DW',' Seminario Final',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ11','VJ',' Lógica de la Programación',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ12','VJ',' Tratamiento de la Imagen',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ13','VJ',' Sonido Digital',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ14','VJ',' Diseño Gráfico I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ15','VJ',' Matemática I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ16','VJ',' Representación Gráfica',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ21','VJ',' Programación I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ22','VJ',' Construcción del Guión',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ23','VJ',' Edición de Video',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ24','VJ',' Diseño Gráfico II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ25','VJ',' Matemática II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ26','VJ',' Dibujo Técnico',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ31','VJ',' Programación II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ32','VJ',' Aplicación de Motores',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ33','VJ',' Diseño Interactivo I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ34','VJ',' Animación Digital 3D I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ35','VJ',' Física y Cinemática',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ36','VJ',' Geometría Espacial',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ41','VJ',' Inteligencia Artificial I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ42','VJ',' Lenguaje Audiovisual',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ43','VJ',' Diseño Interactivo II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ44','VJ',' Animación Digital 3D II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ45','VJ',' Probabilidad y Estadística',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ46','VJ',' Psicología del Entretenimiento',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ51','VJ',' Inteligencia Artificial II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ52','VJ',' Programación de Motores I',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ53','VJ',' Ensambladores',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ54','VJ',' Estructura de Datos',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ55','VJ',' Estrategias y Tácticas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ56','VJ',' Marketing',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ61','VJ',' Desarrollos para Red',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ62','VJ',' Programación de Motores II',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ63','VJ',' Ética y Deontología Profesional',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ64','VJ',' Simulación de Procesos y Partículas',1);
Insert  Into  Materia(CodMateria,CodCarrera,Materia,Activo) Values('VJ65','VJ',' Seminario Final',1);




--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE `mensaje` (
  `ID_Mensaje` bigint(20) NOT NULL AUTO_INCREMENT,
  `CodUsuario` bigint(20) NOT NULL,
  `CodUsuario_Emisor` bigint(20) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(2000) NOT NULL,
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
  `ID_NivelEstudio` smallint(6) NOT NULL AUTO_INCREMENT,
  `NivelEstudio` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_NivelEstudio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nivelestudios`
--

LOCK TABLES `nivelestudios` WRITE;
UNLOCK TABLES;

-- nsert NivelEstudios


Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(1,'Secundario Graduado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(2,'Terciario Abandonado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(3,'Terciario en Curso');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(4,'Terciario Graduado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(5,'Universitario Abandonado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(6,'Universitario en Curso');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(7,'Universitario Graduado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(8,'Posgrado Abandonado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(9,'Posgrado en Curso');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(10,'Posgrado Graduado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(11,'Master Abandonado');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(12,'Master en Curso');
Insert  Into  NivelEstudios(ID_NivelEstudio,NivelEstudio) Values(13,'Master Graduado');



--
-- Table structure for table `nivelidioma`
--

DROP TABLE IF EXISTS `nivelidioma`;
CREATE TABLE `nivelidioma` (
  `ID_NivelConocimiento` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nivel` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_NivelConocimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nivelidioma`
--

LOCK TABLES `nivelidioma` WRITE;
UNLOCK TABLES;

-- nsert NivelIdioma

Insert  Into  NivelIdioma(ID_NivelConocimiento,Nivel) Values(1,'-');
Insert  Into  NivelIdioma(ID_NivelConocimiento,Nivel) Values(2,'Básico');
Insert  Into  NivelIdioma(ID_NivelConocimiento,Nivel) Values(3,'Intermedio');
Insert  Into  NivelIdioma(ID_NivelConocimiento,Nivel) Values(4,'Avanzado');
Insert  Into  NivelIdioma(ID_NivelConocimiento,Nivel) Values(5,'Nativo');



--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `ID_Pais` int(11) NOT NULL AUTO_INCREMENT,
  `Pais` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
UNLOCK TABLES;


-- nsert Paises

Insert  Into  Paises(ID_Pais,Pais) Values(1,'Argentina');
Insert  Into  Paises(ID_Pais,Pais) Values(2,'Australia');
Insert  Into  Paises(ID_Pais,Pais) Values(3,'Austria');
Insert  Into  Paises(ID_Pais,Pais) Values(4,'Bélgica');
Insert  Into  Paises(ID_Pais,Pais) Values(5,'Bolivia');
Insert  Into  Paises(ID_Pais,Pais) Values(6,'Brasil');
Insert  Into  Paises(ID_Pais,Pais) Values(7,'Bulgaria');
Insert  Into  Paises(ID_Pais,Pais) Values(8,'Canadá');
Insert  Into  Paises(ID_Pais,Pais) Values(9,'Chile');
Insert  Into  Paises(ID_Pais,Pais) Values(10,'China');
Insert  Into  Paises(ID_Pais,Pais) Values(11,'Colombia');
Insert  Into  Paises(ID_Pais,Pais) Values(12,'Corea');
Insert  Into  Paises(ID_Pais,Pais) Values(13,'Costa Rica');
Insert  Into  Paises(ID_Pais,Pais) Values(14,'Croacia');
Insert  Into  Paises(ID_Pais,Pais) Values(15,'Cuba');
Insert  Into  Paises(ID_Pais,Pais) Values(16,'Dinamarca');
Insert  Into  Paises(ID_Pais,Pais) Values(17,'Ecuador');
Insert  Into  Paises(ID_Pais,Pais) Values(18,'El Salvador');
Insert  Into  Paises(ID_Pais,Pais) Values(19,'Emiratos Arabes');
Insert  Into  Paises(ID_Pais,Pais) Values(20,'Escocia');
Insert  Into  Paises(ID_Pais,Pais) Values(21,'Eslovaquia');
Insert  Into  Paises(ID_Pais,Pais) Values(22,'Eslovenia');
Insert  Into  Paises(ID_Pais,Pais) Values(23,'España');
Insert  Into  Paises(ID_Pais,Pais) Values(24,'Estados Unidos');
Insert  Into  Paises(ID_Pais,Pais) Values(25,'Estonia');
Insert  Into  Paises(ID_Pais,Pais) Values(26,'Finlandia');
Insert  Into  Paises(ID_Pais,Pais) Values(27,'Francia');
Insert  Into  Paises(ID_Pais,Pais) Values(28,'Grecia');
Insert  Into  Paises(ID_Pais,Pais) Values(29,'Guatemala');
Insert  Into  Paises(ID_Pais,Pais) Values(30,'Holanda');
Insert  Into  Paises(ID_Pais,Pais) Values(31,'Honduras');
Insert  Into  Paises(ID_Pais,Pais) Values(32,'Hungria');
Insert  Into  Paises(ID_Pais,Pais) Values(33,'India');
Insert  Into  Paises(ID_Pais,Pais) Values(34,'Inglaterra');
Insert  Into  Paises(ID_Pais,Pais) Values(35,'Irak');
Insert  Into  Paises(ID_Pais,Pais) Values(36,'Irlanda');
Insert  Into  Paises(ID_Pais,Pais) Values(37,'Israel');
Insert  Into  Paises(ID_Pais,Pais) Values(38,'Italia');
Insert  Into  Paises(ID_Pais,Pais) Values(39,'Japón');
Insert  Into  Paises(ID_Pais,Pais) Values(40,'Letonia');
Insert  Into  Paises(ID_Pais,Pais) Values(41,'Lituania');
Insert  Into  Paises(ID_Pais,Pais) Values(42,'México');
Insert  Into  Paises(ID_Pais,Pais) Values(43,'Nicaragua');
Insert  Into  Paises(ID_Pais,Pais) Values(44,'Noruega');
Insert  Into  Paises(ID_Pais,Pais) Values(45,'Nueva Zelanda');
Insert  Into  Paises(ID_Pais,Pais) Values(46,'Otro');
Insert  Into  Paises(ID_Pais,Pais) Values(47,'Panamá');
Insert  Into  Paises(ID_Pais,Pais) Values(48,'Paraguay');
Insert  Into  Paises(ID_Pais,Pais) Values(49,'Perú');
Insert  Into  Paises(ID_Pais,Pais) Values(50,'Polonia');
Insert  Into  Paises(ID_Pais,Pais) Values(51,'Portugal');
Insert  Into  Paises(ID_Pais,Pais) Values(52,'Puerto Rico');
Insert  Into  Paises(ID_Pais,Pais) Values(53,'República Dominicana');
Insert  Into  Paises(ID_Pais,Pais) Values(54,'Rumania');
Insert  Into  Paises(ID_Pais,Pais) Values(55,'Rusia');
Insert  Into  Paises(ID_Pais,Pais) Values(56,'Singapur');
Insert  Into  Paises(ID_Pais,Pais) Values(57,'Suecia');
Insert  Into  Paises(ID_Pais,Pais) Values(58,'Suiza');
Insert  Into  Paises(ID_Pais,Pais) Values(59,'Uruguay');
Insert  Into  Paises(ID_Pais,Pais) Values(60,'Venezuela');



--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE `profesor` (
  `ID_Profesor` int(11) NOT NULL AUTO_INCREMENT,
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
  `CodMateria` varchar(4) NOT NULL,
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
  `Provincia` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
UNLOCK TABLES;

-- nsert Provincia

Insert  Into  Provincia(ID_Provincia,Provincia) Values(1,'Buenos Aires');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(2,'Buenos Aires-GBA');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(3,'Capital Federal');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(4,'Catamarca');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(5,'Chaco');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(6,'Chubut');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(7,'Córdoba');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(8,'Corrientes');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(9,'Entre Ríos');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(10,'Formosa');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(11,'Jujuy');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(12,'La Pampa');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(13,'La Rioja');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(14,'Mendoza');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(15,'Misiones');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(16,'Neuquén');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(17,'Río Negro');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(18,'Salta');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(19,'San Juan');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(20,'San Luis');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(21,'Santa Cruz');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(22,'Santa Fe');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(23,'Santiago del Estero');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(24,'Tierra del Fuego');
Insert  Into  Provincia(ID_Provincia,Provincia) Values(25,'Tucumán');



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
  `Seniority` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Seniority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `seniority`
--

LOCK TABLES `seniority` WRITE;
UNLOCK TABLES;

-- nsert Seniority

Insert  Into  Seniority(ID_Seniority,Seniority) Values(1,'Training');
Insert  Into  Seniority(ID_Seniority,Seniority) Values(2,'Junior');
Insert  Into  Seniority(ID_Seniority,Seniority) Values(3,'SemiSenior');
Insert  Into  Seniority(ID_Seniority,Seniority) Values(4,'Senior');
Insert  Into  Seniority(ID_Seniority,Seniority) Values(5,'-');


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


-- nsert Tarea

Insert  Into  Tarea(CodTarea,Descripcion) Values(1,'Ingresar al Sitema');
Insert  Into  Tarea(CodTarea,Descripcion) Values(2,'Modificar Datos Personales');
Insert  Into  Tarea(CodTarea,Descripcion) Values(3,'Eliminar Perfil');
Insert  Into  Tarea(CodTarea,Descripcion) Values(4,'Listar Usuarios del Sistema');
Insert  Into  Tarea(CodTarea,Descripcion) Values(5,'Autorizar acceso de AL y PR');
Insert  Into  Tarea(CodTarea,Descripcion) Values(6,'Clasificar Usuario');
Insert  Into  Tarea(CodTarea,Descripcion) Values(7,'ABM Carreras');
Insert  Into  Tarea(CodTarea,Descripcion) Values(8,'ABM Materias');
Insert  Into  Tarea(CodTarea,Descripcion) Values(9,'Listar Carreras');
Insert  Into  Tarea(CodTarea,Descripcion) Values(10,'Listar Materias');
Insert  Into  Tarea(CodTarea,Descripcion) Values(11,'Exportar Curriculum');
Insert  Into  Tarea(CodTarea,Descripcion) Values(12,'Compartir Curriculum');
Insert  Into  Tarea(CodTarea,Descripcion) Values(13,'Geolocalizar');
Insert  Into  Tarea(CodTarea,Descripcion) Values(14,'Recomendar AL');
Insert  Into  Tarea(CodTarea,Descripcion) Values(15,'Solicitar Calificacion a PR');
Insert  Into  Tarea(CodTarea,Descripcion) Values(16,'Listar Alumnos');
Insert  Into  Tarea(CodTarea,Descripcion) Values(17,'Generar Reporte');
Insert  Into  Tarea(CodTarea,Descripcion) Values(18,'Visualizar CV de AL');
Insert  Into  Tarea(CodTarea,Descripcion) Values(19,'Contactar AL');


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
  `Accion` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_TareaRolAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `tarearolauditoria`
--

LOCK TABLES `tarearolauditoria` WRITE;
UNLOCK TABLES;



--
-- Triggers TareaRol
CREATE TRIGGER TG_AuditoriaTareaRol_I
AFTER INSERT 
ON TareaRol 
FOR EACH ROW 
INSERT 
INTO TareaRolAuditoria( FechaAuditoria, User ,CodTarea, CodRol, Activo,Accion)
VALUES (NOW(), CURRENT_USER(),  NEW.CodTarea, NEW.CodRol, NEW.Activo, 'INSERT');

CREATE TRIGGER TG_AuditoriaTareaRol_U
BEFORE UPDATE
ON TareaRol 
FOR EACH ROW 
INSERT INTO TareaRolAuditoria(FechaAuditoria, User, CodTarea, CodRol, Activo,Accion)
 VALUES ( NOW(),CURRENT_USER(), OLD.CodTarea, OLD.CodRol, OLD.Activo,'UPDATE');
 
 
 
CREATE TRIGGER TG_AuditoriaTareaRol_D 
AFTER DELETE 
ON TareaRol 
FOR EACH ROW INSERT 
INTO TareaRolAuditoria(FechaAuditoria, User, CodTarea, CodRol, Activo,Accion)
VALUES (NOW(), CURRENT_USER(), OLD.CodTarea, OLD.CodRol, OLD.Activo, 'DELETE');
--


--
-- Dumping data for table `tarearol`
--

LOCK TABLES `tarearol` WRITE;
UNLOCK TABLES;

-- nsert TareaRol

Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(1,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(1,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(1,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(1,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(2,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(2,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(2,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(2,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(3,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(3,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(3,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(4,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(5,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(6,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(7,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(8,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(9,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(9,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(9,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(9,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(10,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(10,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(10,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(10,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(11,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(11,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(12,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(12,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(14,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(15,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(15,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(16,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(16,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(16,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(17,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(18,'AD',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(18,'AL',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(18,'EM',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(18,'PR',1);
Insert  Into  TareaRol(CodTarea,CodRol,Activo) Values(19,'EM',1);



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
  `ID_TipoDocumento` smallint(6) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(40) NOT NULL,
  `AdmiteLetras` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID_TipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
UNLOCK TABLES;

-- nsert TipoDocumento
Insert  Into  TipoDocumento(ID_TipoDocumento,Descripcion,AdmiteLetras) Values(1,'D.N.I.',0);
Insert  Into  TipoDocumento(ID_TipoDocumento,Descripcion,AdmiteLetras) Values(2,'Cédula de Identidad',0);
Insert  Into  TipoDocumento(ID_TipoDocumento,Descripcion,AdmiteLetras) Values(3,'Libreta Cívica',0);
Insert  Into  TipoDocumento(ID_TipoDocumento,Descripcion,AdmiteLetras) Values(4,'Libreta de Enrolamiento',0);
Insert  Into  TipoDocumento(ID_TipoDocumento,Descripcion,AdmiteLetras) Values(5,'Pasaporte',0);

--
-- Table structure for table `tipotelefono`
--

DROP TABLE IF EXISTS `tipotelefono`;
CREATE TABLE `tipotelefono` (
  `ID_TipoTelefono` smallint(6) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_TipoTelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipotelefono`
--

LOCK TABLES `tipotelefono` WRITE;
UNLOCK TABLES;


-- nsert TipoTelefono

Insert  Into  TipoTelefono(ID_TipoTelefono,Descripcion) Values(1,'Particular');
Insert  Into  TipoTelefono(ID_TipoTelefono,Descripcion) Values(2,'Laboral');
Insert  Into  TipoTelefono(ID_TipoTelefono,Descripcion) Values(3,'Celular');


--
-- Table structure for table `titulo`
--

DROP TABLE IF EXISTS `titulo`;
CREATE TABLE `titulo` (
  `ID_Titulo` int(11) NOT NULL AUTO_INCREMENT,
  `CodCarrera` varchar(2) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Activo` bit(1) NOT NULL,
  PRIMARY KEY (`ID_Titulo`,`CodCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titulo`
--

LOCK TABLES `titulo` WRITE;
UNLOCK TABLES;

-- nsert Titulo

Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(1,'DM','Diseñador Multimedial',1);
Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(2,'DG','Técnico Superior en Diseño Gráfico y Comunicación Visual',1);
Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(3,'VJ','Diseñador y Programador de Simuladores Virtuales',1);
Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(4,'CA','Director de Cine de Animación',1);
Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(5,'DW','Técnico Superior en Diseño y Administración de Sitios Web.',1);
Insert  Into  Titulo(ID_Titulo,CodCarrera,Titulo,Activo) Values(6,'AS','Analista de Sistemas de Computación ',1);


--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `CodUsuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Password` varchar(15) NOT NULL,
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


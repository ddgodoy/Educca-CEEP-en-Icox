SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asunto_mensaje`
-- 

CREATE TABLE `asunto_mensaje` (`id` bigint(10) NOT NULL auto_increment, `descripcion` varchar(100) default NULL, `nombre` varchar(50) default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `asunto_mensaje`
-- 

INSERT INTO `asunto_mensaje` VALUES (1, 'Duda sobre la teoría', 'duda_teoria');
INSERT INTO `asunto_mensaje` VALUES (2, 'Duda sobre un ejercicio', 'duda_ejercicio');
INSERT INTO `asunto_mensaje` VALUES (3, 'Duda sobre la planificación o seguimiento', 'duda_planificacion');
INSERT INTO `asunto_mensaje` VALUES (4, 'Tutoría', 'tutoria');
INSERT INTO `asunto_mensaje` VALUES (5, 'Quejas y/o sugerencias', 'quejas');
INSERT INTO `asunto_mensaje` VALUES (6, 'Otros', 'otros');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `calificaciones`
-- 

CREATE TABLE `calificaciones` (`id_usuario` bigint(10) NOT NULL, `id_curso` bigint(10) NOT NULL, `score` float default NULL, PRIMARY KEY  (`id_usuario`,`id_curso`), KEY `calificaciones_FI_2` (`id_curso`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `calificaciones`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuestion_corta`
-- 

CREATE TABLE `cuestion_corta` ( `id` bigint(10) NOT NULL auto_increment, `id_ejercicio` bigint(10) NOT NULL, `pregunta` text, `puntuacion` float default '0', PRIMARY KEY  (`id`), KEY `cuestion_corta_FI_1` (`id_ejercicio`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cuestion_corta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuestion_practica`
-- 

CREATE TABLE `cuestion_practica` (`id` bigint(10) NOT NULL auto_increment, `id_ejercicio` bigint(10) NOT NULL, `contenido_latex` text, `puntuacion` float default NULL, PRIMARY KEY  (`id`), KEY `cuestion_practica_FI_1` (`id_ejercicio`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cuestion_practica`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuestion_test`
-- 

CREATE TABLE `cuestion_test` (`id` bigint(10) NOT NULL auto_increment, `id_ejercicio` bigint(10) NOT NULL, `pregunta` text, `numero_respuestas_correctas` int(11) default '0',  `numero_respuestas_incorrectas` int(11) default '0', PRIMARY KEY  (`id`), KEY `cuestion_test_FI_1` (`id_ejercicio`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cuestion_test`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `curso`
-- 

CREATE TABLE `curso` (`id` bigint(10) NOT NULL auto_increment, `nombre` varchar(100) default NULL, `informacion_extendida` text, `fecha_inicio` datetime default NULL, `fecha_fin` datetime default NULL, `scan` int(1) default NULL, `duracion` bigint(10) default NULL, `precio` float default NULL, `materia_id` bigint(10) default NULL, `menu_info` int(1) default '1', `menu_biblio` int(1) default '1', `menu_temario` int(1) default '1', `menu_seguimiento` int(1) default '1', `menu_eventos` int(1) default '1', `menu_chat` int(1) default '1', `menu_foro` int(1) default '1', `menu_ejercicios` int(1) default '1', `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `curso_FI_1` (`materia_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `curso`
-- 

INSERT INTO `curso` VALUES (1, 'vacio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, '2008-09-11 10:29:15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ejercicio`
-- 

CREATE TABLE `ejercicio` (`id` bigint(10) NOT NULL auto_increment, `id_autor` bigint(10) default NULL, `id_materia` bigint(10) default NULL, `tipo` varchar(20) default NULL, `titulo` varchar(40) default NULL, `test_multiple` tinyint(1) default '0', `test_resta` tinyint(1) default '0', `numero_respuestas` int(11) default NULL, `publicado` tinyint(1) default '0',  `solucion` tinyint(1) default '0', `expresiones_matematicas` tinyint(1) default '0', `numero_hojas` int(11) default NULL, PRIMARY KEY  (`id`), KEY `ejercicio_FI_1` (`id_autor`), KEY `ejercicio_FI_2` (`id_materia`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ejercicio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ejercicio_resuelto`
-- 

CREATE TABLE `ejercicio_resuelto` (`id` bigint(10) NOT NULL auto_increment, `id_autor` bigint(10) NOT NULL, `id_ejercicio` bigint(10) NOT NULL, `id_corrector` bigint(10) default NULL, `fecha_correccion` datetime default NULL, `score` float default '0', `aciertos` int(11) default '0', `fallos` int(11) default '0', `blancos` int(11) default '0', `tiempo` int(11) default '0', `repositorio` tinyint(1) default '0', PRIMARY KEY  (`id`), KEY `ejercicio_resuelto_FI_1` (`id_autor`), KEY `ejercicio_resuelto_FI_2` (`id_ejercicio`), KEY `ejercicio_resuelto_FI_3` (`id_corrector`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ejercicio_resuelto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `evaluacion_paquete`
-- 

CREATE TABLE `evaluacion_paquete` (`id_paquete` bigint(10) NOT NULL, `id_tarea` bigint(10) NOT NULL, `peso` float default NULL, PRIMARY KEY  (`id_paquete`,`id_tarea`), KEY `evaluacion_paquete_FI_2` (`id_tarea`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `evaluacion_paquete`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `evento`
-- 

CREATE TABLE `evento` (`id` bigint(10) NOT NULL auto_increment, `id_curso` bigint(10) default NULL, `privado` tinyint(2) default '0', `fecha_inicio` datetime default NULL, `fecha_fin` datetime default NULL, `id_tipo_evento` bigint(10) default NULL, `id_tipo_cita` bigint(10) default NULL, `recurrente` bigint(7) default NULL, `titulo` varchar(150) default NULL,  `descripcion` text, `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `evento_FI_1` (`id_curso`), KEY `evento_FI_2` (`id_tipo_evento`), KEY `evento_FI_3` (`id_tipo_cita`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `evento`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `libro`
-- 

CREATE TABLE `libro` (`id` bigint(10) NOT NULL auto_increment, `nombre` varchar(100) default NULL, `autor` varchar(100) default NULL, `editorial` varchar(100) default NULL,  `anio_publicacion` varchar(4) default NULL, `isbn` varchar(17) default NULL, `id_materia` bigint(10) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `libro_FI_1` (`id_materia`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Volcar la base de datos para la tabla `libro`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `materia`
-- 

CREATE TABLE `materia` (`id` bigint(10) NOT NULL auto_increment, `nombre` varchar(100) default NULL, `informacion` text, `normativa` text, `temas_totales` bigint(5) default NULL, `height` bigint(5) default NULL, `width` bigint(5) default NULL, `tipo` varchar(20) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Volcar la base de datos para la tabla `materia`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `mensaje`
-- 

CREATE TABLE `mensaje` (`id` bigint(10) NOT NULL auto_increment, `id_propietario` bigint(10) NOT NULL, `id_emisor` bigint(10) NOT NULL, `id_destinatario` bigint(10) default NULL, `id_curso` bigint(10) NOT NULL, `lista_destinatarios` text, `id_asunto` bigint(10) NOT NULL, `contenido` text, `created_at` datetime default NULL, `leido` tinyint(1) default '0', `borrado` tinyint(1) default '0', `supervisor` tinyint(1) default '0', `adjuntos` tinyint(2) default '0', PRIMARY KEY  (`id`), KEY `mensaje_FI_1` (`id_propietario`), KEY `mensaje_FI_2` (`id_emisor`), KEY `mensaje_FI_3` (`id_destinatario`), KEY `mensaje_FI_4` (`id_curso`), KEY `mensaje_FI_5` (`id_asunto`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `mensaje`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `mensaje_chat`
-- 

CREATE TABLE `mensaje_chat` (`id` bigint(10) NOT NULL auto_increment,`id_usuario` bigint(10) NOT NULL, `id_curso` bigint(10) NOT NULL, `msg` text, `time` int(11) default NULL, PRIMARY KEY  (`id`,`id_usuario`,`id_curso`), KEY `mensaje_chat_FI_1` (`id_usuario`), KEY `mensaje_chat_FI_2` (`id_curso`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `mensaje_chat`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `notificacion`
-- 

CREATE TABLE `notificacion` ( `id` bigint(10) NOT NULL auto_increment, `id_usuario` bigint(10) NOT NULL, `id_curso` bigint(10) default NULL, `id_tema` bigint(10) default NULL, `tipo` varchar(100) default NULL, `titulo` varchar(100) default NULL, `contenido` text, `fecha` datetime default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `notificacion_FI_1` (`id_usuario`), KEY `notificacion_FI_2` (`id_curso`), KEY `notificacion_FI_3` (`id_tema`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `notificacion`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pais`
-- 

CREATE TABLE `pais` (`id` bigint(10) NOT NULL auto_increment, `isonum` smallint(6) default NULL, `iso2` varchar(2) default NULL, `iso3` varchar(3) default NULL, `nombre` varchar(80) default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `pais`
-- 

INSERT INTO `pais` (`id`, `isonum`, `iso2`, `iso3`, `nombre`) VALUES (1, 4, 'AF', 'AFG', 'Afganistán'), (2, 248, 'AX', 'ALA', 'Islas Gland'),(3, 8, 'AL', 'ALB', 'Albania'),(4, 276, 'DE', 'DEU', 'Alemania'),(5, 20, 'AD', 'AND', 'Andorra'),(6, 24, 'AO', 'AGO', 'Angola'),(7, 660, 'AI', 'AIA', 'Anguilla'),(8, 10, 'AQ', 'ATA', 'Antártida'),(9, 28, 'AG', 'ATG', 'Antigua y Barbuda'),(10, 530, 'AN', 'ANT', 'Antillas Holandesas'),(11, 682, 'SA', 'SAU', 'Arabia Saudí'),(12, 12, 'DZ', 'DZA', 'Argelia'),(13, 32, 'AR', 'ARG', 'Argentina'),(14, 51, 'AM', 'ARM', 'Armenia'),(15, 533, 'AW', 'ABW', 'Aruba'),(16, 36, 'AU', 'AUS', 'Australia'),(17, 40, 'AT', 'AUT', 'Austria'),(18, 31, 'AZ', 'AZE', 'Azerbaiyán'),(19, 44, 'BS', 'BHS', 'Bahamas'),(20, 48, 'BH', 'BHR', 'Bahréin'),(21, 50, 'BD', 'BGD', 'Bangladesh'),(22, 52, 'BB', 'BRB', 'Barbados'),(23, 112, 'BY', 'BLR', 'Bielorrusia'),(24, 56, 'BE', 'BEL', 'Bélgica'),(25, 84, 'BZ', 'BLZ', 'Belice'),(26, 204, 'BJ', 'BEN', 'Benin'),(27, 60, 'BM', 'BMU', 'Bermudas'),(28, 64, 'BT', 'BTN', 'Bhután'),(29, 68, 'BO', 'BOL', 'Bolivia'),(30, 70, 'BA', 'BIH', 'Bosnia y Herzegovina'),(31, 72, 'BW', 'BWA', 'Botsuana'),(32, 74, 'BV', 'BVT', 'Isla Bouvet'),(33, 76, 'BR', 'BRA', 'Brasil'),(34, 96, 'BN', 'BRN', 'Brunéi'),(35, 100, 'BG', 'BGR', 'Bulgaria'),(36, 854, 'BF', 'BFA', 'Burkina Faso'),(37, 108, 'BI', 'BDI', 'Burundi'),(38, 132, 'CV', 'CPV', 'Cabo Verde'),(39, 136, 'KY', 'CYM', 'Islas Caimán'),(40, 116, 'KH', 'KHM', 'Camboya'),(41, 120, 'CM', 'CMR', 'Camerún'),(42, 124, 'CA', 'CAN', 'Canadá'),(43, 140, 'CF', 'CAF', 'República Centroafricana'),(44, 148, 'TD', 'TCD', 'Chad'),(45, 203, 'CZ', 'CZE', 'República Checa'),(46, 152, 'CL', 'CHL', 'Chile'),(47, 156, 'CN', 'CHN', 'China'),(48, 196, 'CY', 'CYP', 'Chipre'),(49, 162, 'CX', 'CXR', 'Isla de Navidad'),(50, 336, 'VA', 'VAT', 'Ciudad del Vaticano'),(51, 166, 'CC', 'CCK', 'Islas Cocos'),(52, 170, 'CO', 'COL', 'Colombia'),(53, 174, 'KM', 'COM', 'Comoras'),(54, 180, 'CD', 'COD', 'República Democrática del Congo'),(55, 178, 'CG', 'COG', 'Congo'),(56, 184, 'CK', 'COK', 'Islas Cook'),(57, 408, 'KP', 'PRK', 'Corea del Norte'),(58, 410, 'KR', 'KOR', 'Corea del Sur'),(59, 384, 'CI', 'CIV', 'Costa de Marfil'),(60, 188, 'CR', 'CRI', 'Costa Rica'),(61, 191, 'HR', 'HRV', 'Croacia'),(62, 192, 'CU', 'CUB', 'Cuba'),(63, 208, 'DK', 'DNK', 'Dinamarca'),(64, 212, 'DM', 'DMA', 'Dominica'),(65, 214, 'DO', 'DOM', 'República Dominicana'),(66, 218, 'EC', 'ECU', 'Ecuador'),(67, 818, 'EG', 'EGY', 'Egipto'),(68, 222, 'SV', 'SLV', 'El Salvador'),(69, 784, 'AE', 'ARE', 'Emiratos Árabes Unidos'),(70, 232, 'ER', 'ERI', 'Eritrea'),(71, 703, 'SK', 'SVK', 'Eslovaquia'),(72, 705, 'SI', 'SVN', 'Eslovenia'),(73, 724, 'ES', 'ESP', 'España'),(74, 581, 'UM', 'UMI', 'Islas ultramarinas de Estados Unidos'),(75, 840, 'US', 'USA', 'Estados Unidos'),(76, 233, 'EE', 'EST', 'Estonia'),(77, 231, 'ET', 'ETH', 'Etiopía'),(78, 234, 'FO', 'FRO', 'Islas Feroe'),(79, 608, 'PH', 'PHL', 'Filipinas'),(80, 246, 'FI', 'FIN', 'Finlandia'),(81, 242, 'FJ', 'FJI', 'Fiyi'),(82, 250, 'FR', 'FRA', 'Francia'),(83, 266, 'GA', 'GAB', 'Gabón'),(84, 270, 'GM', 'GMB', 'Gambia'),(85, 268, 'GE', 'GEO', 'Georgia'),(86, 239, 'GS', 'SGS', 'Islas Georgias del Sur y Sandwich del Sur'),(87, 288, 'GH', 'GHA', 'Ghana'),(88, 292, 'GI', 'GIB', 'Gibraltar'),(89, 308, 'GD', 'GRD', 'Granada'),(90, 300, 'GR', 'GRC', 'Grecia'),(91, 304, 'GL', 'GRL', 'Groenlandia'),(92, 312, 'GP', 'GLP', 'Guadalupe'),(93, 316, 'GU', 'GUM', 'Guam'),(94, 320, 'GT', 'GTM', 'Guatemala'),(95, 254, 'GF', 'GUF', 'Guayana Francesa'),(96, 324, 'GN', 'GIN', 'Guinea'),(97, 226, 'GQ', 'GNQ', 'Guinea Ecuatorial'),(98, 624, 'GW', 'GNB', 'Guinea-Bissau'),(99, 328, 'GY', 'GUY', 'Guyana'),(100, 332, 'HT', 'HTI', 'Haití'),(101, 334, 'HM', 'HMD', 'Islas Heard y McDonald'),(102, 340, 'HN', 'HND', 'Honduras'),(103, 344, 'HK', 'HKG', 'Hong Kong'),(104, 348, 'HU', 'HUN', 'Hungría'),(105, 356, 'IN', 'IND', 'India'),(106, 360, 'ID', 'IDN', 'Indonesia'),(107, 364, 'IR', 'IRN', 'Irán'),(108, 368, 'IQ', 'IRQ', 'Iraq'),(109, 372, 'IE', 'IRL', 'Irlanda'),(110, 352, 'IS', 'ISL', 'Islandia'),(111, 376, 'IL', 'ISR', 'Israel'),(112, 380, 'IT', 'ITA', 'Italia'),(113, 388, 'JM', 'JAM', 'Jamaica'),(114, 392, 'JP', 'JPN', 'Japón'),(115, 400, 'JO', 'JOR', 'Jordania'),(116, 398, 'KZ', 'KAZ', 'Kazajstán'),(117, 404, 'KE','KEN', 'Kenia'),(118, 417, 'KG', 'KGZ', 'Kirguistán'),(119, 296, 'KI', 'KIR', 'Kiribati'),(120, 414, 'KW', 'KWT', 'Kuwait'),(121, 418, 'LA', 'LAO', 'Laos'),(122, 426, 'LS', 'LSO', 'Lesotho'),(123, 428, 'LV', 'LVA', 'Letonia'),(124, 422, 'LB', 'LBN', 'Líbano'),(125, 430, 'LR', 'LBR', 'Liberia'),(126, 434, 'LY', 'LBY', 'Libia'),(127, 438, 'LI', 'LIE', 'Liechtenstein'),(128, 440, 'LT', 'LTU', 'Lituania'),(129, 442, 'LU', 'LUX', 'Luxemburgo'),(130, 446, 'MO', 'MAC', 'Macao'),(131, 807, 'MK', 'MKD', 'ARY Macedonia'),(132, 450, 'MG', 'MDG', 'Madagascar'),(133, 458, 'MY', 'MYS', 'Malasia'),(134, 454, 'MW', 'MWI', 'Malawi'),(135, 462, 'MV', 'MDV', 'Maldivas'),(136, 466, 'ML', 'MLI', 'Malí'),(137, 470, 'MT', 'MLT', 'Malta'),(138, 238, 'FK', 'FLK', 'Islas Malvinas'),(139, 580, 'MP', 'MNP', 'Islas Marianas del Norte'),(140, 504, 'MA', 'MAR', 'Marruecos'),(141, 584, 'MH', 'MHL', 'Islas Marshall'),(142, 474, 'MQ', 'MTQ', 'Martinica'),(143, 480, 'MU', 'MUS', 'Mauricio'),(144, 478, 'MR', 'MRT', 'Mauritania'),(145, 175, 'YT', 'MYT', 'Mayotte'),(146, 484, 'MX', 'MEX', 'México'),(147, 583, 'FM', 'FSM', 'Micronesia'),(148, 498, 'MD', 'MDA', 'Moldavia'),(149, 492, 'MC', 'MCO', 'Mónaco'),(150, 496, 'MN', 'MNG', 'Mongolia'),(151, 500, 'MS', 'MSR', 'Montserrat'),(152, 508, 'MZ', 'MOZ', 'Mozambique'),(153, 104, 'MM', 'MMR', 'Myanmar'),(154, 516, 'NA', 'NAM', 'Namibia'),(155, 520, 'NR', 'NRU', 'Nauru'),(156, 524, 'NP', 'NPL', 'Nepal'),(157, 558, 'NI', 'NIC', 'Nicaragua'),(158, 562, 'NE', 'NER', 'Níger'),(159, 566, 'NG', 'NGA', 'Nigeria'),(160, 570, 'NU', 'NIU', 'Niue'),(161, 574, 'NF', 'NFK', 'Isla Norfolk'),(162, 578, 'NO', 'NOR', 'Noruega'),(163, 540, 'NC', 'NCL', 'Nueva Caledonia'),(164, 554, 'NZ', 'NZL', 'Nueva Zelanda'),(165, 512, 'OM', 'OMN', 'Omán'),(166, 528, 'NL', 'NLD', 'Países Bajos'),(167, 586, 'PK', 'PAK', 'Pakistán'),(168, 585, 'PW','PLW', 'Palau'),(169, 275, 'PS', 'PSE', 'Palestina'),(170, 591, 'PA', 'PAN', 'Panamá'),(171, 598, 'PG', 'PNG', 'Papúa Nueva Guinea'),(172, 600, 'PY', 'PRY', 'Paraguay'),(173, 604, 'PE', 'PER', 'Perú'),(174, 612, 'PN', 'PCN', 'Islas Pitcairn'),(175, 258, 'PF', 'PYF', 'Polinesia Francesa'),(176, 616, 'PL', 'POL', 'Polonia'),(177, 620, 'PT', 'PRT', 'Portugal'),(178, 630, 'PR','PRI', 'Puerto Rico'),(179, 634, 'QA', 'QAT', 'Qatar'),(180, 826, 'GB', 'GBR', 'Reino Unido'),(181, 638, 'RE', 'REU', 'Reunión'),(182, 646, 'RW', 'RWA', 'Ruanda'),(183, 642, 'RO', 'ROU', 'Rumania'),(184, 643, 'RU', 'RUS', 'Rusia'),(185, 732, 'EH', 'ESH', 'Sahara Occidental'),(186, 90, 'SB', 'SLB', 'Islas Salomón'),(187, 882, 'WS', 'WSM', 'Samoa'),(188, 16, 'AS', 'ASM', 'Samoa Americana'),(189, 659, 'KN', 'KNA', 'San Cristóbal y Nevis'),(190, 674, 'SM', 'SMR', 'San Marino'),(191, 666, 'PM', 'SPM', 'San Pedro y Miquelón'),(192, 670, 'VC', 'VCT', 'San Vicente y las Granadinas'),(193, 654, 'SH', 'SHN', 'Santa Helena'),(194, 662, 'LC', 'LCA', 'Santa Lucía'),(195, 678, 'ST', 'STP', 'Santo Tomé y Príncipe'),(196, 686, 'SN', 'SEN', 'Senegal'),(197, 891, 'CS', 'SCG', 'Serbia y Montenegro'),(198, 690, 'SC', 'SYC', 'Seychelles'),(199, 694, 'SL', 'SLE', 'Sierra Leona'),(200, 702, 'SG', 'SGP', 'Singapur'),(201, 760, 'SY', 'SYR', 'Siria'),(202, 706, 'SO', 'SOM', 'Somalia'),(203, 144, 'LK', 'LKA', 'Sri Lanka'),(204, 748, 'SZ', 'SWZ', 'Suazilandia'),(205, 710, 'ZA', 'ZAF', 'Sudáfrica'),(206, 736, 'SD', 'SDN', 'Sudán'),(207, 752, 'SE', 'SWE', 'Suecia'),(208, 756, 'CH', 'CHE', 'Suiza'),(209, 740, 'SR', 'SUR', 'Surinam'),(210, 744, 'SJ', 'SJM', 'Svalbard y Jan Mayen'),(211, 764, 'TH', 'THA', 'Tailandia'),(212, 158, 'TW', 'TWN', 'Taiwán'),(213, 834, 'TZ', 'TZA', 'Tanzania'),(214, 762, 'TJ', 'TJK', 'Tayikistán'),(215, 86, 'IO', 'IOT', 'Territorio Británico del Océano Índico'),(216, 260, 'TF', 'ATF', 'Territorios Australes Franceses'),(217, 626, 'TL', 'TLS', 'Timor Oriental'),(218, 768, 'TG', 'TGO', 'Togo'),(219, 772, 'TK', 'TKL', 'Tokelau'),(220, 776, 'TO', 'TON', 'Tonga'),(221, 780, 'TT', 'TTO', 'Trinidad y Tobago'),(222, 788, 'TN', 'TUN', 'Túnez'),(223, 796, 'TC', 'TCA', 'Islas Turcas y Caicos'),(224, 795, 'TM', 'TKM', 'Turkmenistán'),(225, 792, 'TR', 'TUR', 'Turquía'),(226, 798, 'TV', 'TUV', 'Tuvalu'),(227, 804, 'UA', 'UKR', 'Ucrania'),(228, 800, 'UG', 'UGA', 'Uganda'),(229, 858, 'UY', 'URY', 'Uruguay'),(230, 860, 'UZ', 'UZB', 'Uzbekistán'),(231, 548, 'VU', 'VUT', 'Vanuatu'),(232, 862, 'VE', 'VEN', 'Venezuela'),(233, 704, 'VN', 'VNM', 'Vietnam'),(234, 92, 'VG', 'VGB', 'Islas Vírgenes Británicas'),(235, 850, 'VI', 'VIR', 'Islas Vírgenes de los Estados Unidos'),(236, 876, 'WF', 'WLF', 'Wallis y Futuna'),(237, 887, 'YE', 'YEM', 'Yemen'),(238, 262, 'DJ', 'DJI', 'Yibuti'),(239, 894, 'ZM', 'ZMB', 'Zambia'),(240, 716, 'ZW', 'ZWE', 'Zimbabue');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `paquete`
-- 

CREATE TABLE `paquete` ( `id` bigint(10) NOT NULL auto_increment, `nombre` varchar(100) default NULL, `fecha_inicio` datetime default NULL, `fecha_fin` datetime default NULL, `webcam` int(1) default NULL, `scan` int(1) default NULL, `duracion` bigint(10) default NULL, `precio` float default NULL, `descripcion` text, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `paquete`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `preferencia_usuario`
-- 

CREATE TABLE `preferencia_usuario` ( `usuario_id` bigint(10) NOT NULL, `cal_dias_antes` bigint(10) default NULL, `cal_dias_despues` bigint(10) default NULL, PRIMARY KEY  (`usuario_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `preferencia_usuario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_conectado_chat`
-- 

CREATE TABLE `rel_conectado_chat` ( `id_usuario` bigint(10) NOT NULL, `id_curso` bigint(10) NOT NULL, `id_rol` bigint(10) NOT NULL, `tiempo` bigint(20) default NULL, PRIMARY KEY  (`id_usuario`,`id_curso`), KEY `rel_conectado_chat_FI_2` (`id_curso`), KEY `rel_conectado_chat_FI_3` (`id_rol`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_conectado_chat`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_curso_tema`
-- 

CREATE TABLE `rel_curso_tema` ( `id_curso` bigint(10) NOT NULL, `id_tema` bigint(10) NOT NULL, `fecha_completado` datetime default NULL, PRIMARY KEY  (`id_curso`,`id_tema`), KEY `rel_curso_tema_FI_2` (`id_tema`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_curso_tema`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_interaccion_sco12_objetivo`
-- 

CREATE TABLE `rel_interaccion_sco12_objetivo` ( `id` bigint(10) NOT NULL auto_increment, `index` bigint(10) default NULL, `index_interaccion` bigint(10) default NULL, `id_sco12` bigint(10) default NULL, `id_usuario` bigint(10) default NULL, `ref_objetivo` varchar(255) default NULL, PRIMARY KEY  (`id`), KEY `rel_interaccion_sco12_objetivo_FI_1` (`id_sco12`), KEY `rel_interaccion_sco12_objetivo_FI_2` (`id_usuario`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `rel_interaccion_sco12_objetivo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_interaccion_sco12_respuesta`
-- 

CREATE TABLE `rel_interaccion_sco12_respuesta` ( `id` bigint(10) NOT NULL auto_increment, `index` bigint(10) default NULL, `index_interaccion` bigint(10) default NULL, `id_sco12` bigint(10) default NULL, `id_usuario` bigint(10) default NULL, `pattern` varchar(255) default NULL, PRIMARY KEY  (`id`), KEY `rel_interaccion_sco12_respuesta_FI_1` (`id_sco12`), KEY `rel_interaccion_sco12_respuesta_FI_2` (`id_usuario`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `rel_interaccion_sco12_respuesta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_paquete_curso`
-- 

CREATE TABLE `rel_paquete_curso` ( `id_paquete` bigint(10) NOT NULL, `id_curso` bigint(10) NOT NULL, PRIMARY KEY  (`id_paquete`,`id_curso`), KEY `rel_paquete_curso_FI_2` (`id_curso`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_paquete_curso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_evento`
-- 

CREATE TABLE `rel_usuario_evento` ( `id_usuario` bigint(10) NOT NULL, `id_evento` bigint(10) NOT NULL, PRIMARY KEY  (`id_usuario`,`id_evento`), KEY `rel_usuario_evento_FI_2` (`id_evento`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_evento`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_interaccion_sco12`
-- 

CREATE TABLE `rel_usuario_interaccion_sco12` ( `id` bigint(10) NOT NULL auto_increment, `ref_interaccion` varchar(255) default NULL, `index` bigint(10) default NULL, `id_sco12` bigint(10) default NULL, `id_usuario` bigint(10) default NULL, `time` varchar(20) default NULL, `type` varchar(20) default NULL, `weighting` float default NULL, `student_response` float default NULL,  `result` varchar(20) default NULL, `latency` varchar(20) default NULL, PRIMARY KEY  (`id`), KEY `rel_usuario_interaccion_sco12_FI_1` (`id_sco12`), KEY `rel_usuario_interaccion_sco12_FI_2` (`id_usuario`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_interaccion_sco12`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_objetivo_sco12`
-- 

CREATE TABLE `rel_usuario_objetivo_sco12` ( `id` bigint(10) NOT NULL auto_increment, `ref_objetivo` varchar(255) default NULL, `index` bigint(10) default NULL, `id_sco12` bigint(10) default NULL, `id_usuario` bigint(10) default NULL, `score_raw` float default NULL, `score_max` float default NULL, `score_min` float default NULL, `status` varchar(20) default NULL, PRIMARY KEY  (`id`), KEY `rel_usuario_objetivo_sco12_FI_1` (`id_sco12`), KEY `rel_usuario_objetivo_sco12_FI_2` (`id_usuario`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_objetivo_sco12`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_paquete`
-- 

CREATE TABLE `rel_usuario_paquete` ( `id_usuario` bigint(10) NOT NULL, `id_paquete` bigint(10) NOT NULL, `created_at` datetime default NULL, `score` float default NULL, `presencial` tinyint(1) default '0', PRIMARY KEY  (`id_usuario`,`id_paquete`), KEY `rel_usuario_paquete_FI_2` (`id_paquete`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_paquete`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_rol_curso`
-- 

CREATE TABLE `rel_usuario_rol_curso` ( `id_usuario` bigint(10) NOT NULL, `id_rol` bigint(10) default NULL, `id_curso` bigint(10) NOT NULL, `cal_dias_antes` bigint(10) default NULL,  `cal_dias_despues` bigint(10) default NULL, `created_at` datetime default NULL, `presencial` tinyint(1) default '0', PRIMARY KEY  (`id_usuario`,`id_curso`), KEY `rel_usuario_rol_curso_FI_2` (`id_rol`),  KEY `rel_usuario_rol_curso_FI_3` (`id_curso`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_rol_curso`
-- 

INSERT INTO `rel_usuario_rol_curso` VALUES (1, 4, 1, NULL, NULL, '2008-09-11 10:29:15', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_sco12`
-- 

CREATE TABLE `rel_usuario_sco12` ( `id` bigint(10) NOT NULL auto_increment, `id_sco12` bigint(10) default NULL, `id_usuario` bigint(10) default NULL, `lesson_location` varchar(255) default NULL, `credit` varchar(255) default NULL, `lesson_status` varchar(255) default NULL, `entry` varchar(20) default NULL, `score_raw` float default NULL, `score_max` float default NULL, `score_min` float default NULL, `total_time` varchar(20) default NULL, `lesson_mode` varchar(20) default NULL, `exitvalue` varchar(20) default NULL, `session_time` varchar(20) default NULL,  `suspend_data` text, `comments` text, `comments_from_lms` text, `preference_audio` int(11) default NULL, `preference_language` varchar(255) default NULL, `preference_speed` int(11) default NULL, `preference_text` int(11) default NULL, PRIMARY KEY  (`id`), KEY `rel_usuario_sco12_FI_1` (`id_sco12`), KEY `rel_usuario_sco12_FI_2` (`id_usuario`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_sco12`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_tarea`
-- 

CREATE TABLE `rel_usuario_tarea` ( `id_usuario` bigint(10) NOT NULL, `id_tarea` bigint(10) NOT NULL, `id_ejercicio_resuelto` bigint(10) default NULL, `entregada` tinyint(1) default '0', `corregida` tinyint(1) default '0', `fecha_entrega` datetime default NULL, `tiempo_restante` int(11) default '0', PRIMARY KEY  (`id_usuario`,`id_tarea`), KEY `rel_usuario_tarea_FI_2` (`id_tarea`), KEY `rel_usuario_tarea_FI_3` (`id_ejercicio_resuelto`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_tarea`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_usuario_tema`
-- 

CREATE TABLE `rel_usuario_tema` ( `id_usuario` bigint(10) NOT NULL, `id_tema` bigint(10) NOT NULL, `tiempo` bigint(10) default NULL, `estado` tinyint(3) default NULL, `fecha_inicio` datetime default NULL, `fecha_completado` datetime default NULL, PRIMARY KEY  (`id_usuario`,`id_tema`), KEY `rel_usuario_tema_FI_2` (`id_tema`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `rel_usuario_tema`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `respuesta_cuestion_corta`
-- 

CREATE TABLE `respuesta_cuestion_corta` ( `id` bigint(10) NOT NULL auto_increment, `id_ejercicio_resuelto` bigint(10) NOT NULL, `id_cuestion_corta` bigint(10) NOT NULL, `respuesta` text, `comentario` text, `puntuacion` float default NULL, PRIMARY KEY  (`id`), KEY `respuesta_cuestion_corta_FI_1` (`id_ejercicio_resuelto`), KEY `respuesta_cuestion_corta_FI_2` (`id_cuestion_corta`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `respuesta_cuestion_corta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `respuesta_cuestion_practica`
-- 

CREATE TABLE `respuesta_cuestion_practica` ( `id` bigint(10) NOT NULL auto_increment, `id_ejercicio_resuelto` bigint(10) NOT NULL, `id_cuestion_practica` bigint(10) NOT NULL, `puntuacion` float default NULL, PRIMARY KEY  (`id`), KEY `respuesta_cuestion_practica_FI_1` (`id_ejercicio_resuelto`), KEY `respuesta_cuestion_practica_FI_2` (`id_cuestion_practica`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `respuesta_cuestion_practica`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `respuesta_cuestion_test`
-- 

CREATE TABLE `respuesta_cuestion_test` ( `id` bigint(10) NOT NULL auto_increment, `id_cuestion_test` bigint(10) NOT NULL, `respuesta` text, `correcta` tinyint(1) default '0', PRIMARY KEY  (`id`), KEY `respuesta_cuestion_test_FI_1` (`id_cuestion_test`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `respuesta_cuestion_test`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rol`
-- 

CREATE TABLE `rol` ( `id` bigint(10) NOT NULL auto_increment, `nombre` varchar(30) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `rol`
-- 

INSERT INTO `rol` VALUES (1, 'alumno', '2008-09-11 10:29:15');
INSERT INTO `rol` VALUES (2, 'profesor', '2008-09-11 10:29:15');
INSERT INTO `rol` VALUES (3, 'supervisor', '2008-09-11 10:29:15');
INSERT INTO `rol` VALUES (4, 'administrador', '2008-09-11 10:29:15');
INSERT INTO `rol` VALUES (5, 'moroso', '2008-09-11 10:29:15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sco12`
-- 

CREATE TABLE `sco12` ( `id` bigint(10) NOT NULL auto_increment, `ref_sco12` varchar(255) default NULL, `id_materia` bigint(10) default NULL, `title` text, `file` text, `credit` varchar(255) default NULL, `launch_data` text, `mastery_score` float default NULL, `max_time_allowed` varchar(20) default NULL, `time_limit_action` text, PRIMARY KEY  (`id`), KEY `sco12_FI_1` (`id_materia`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sco12`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `seguimiento_mensaje`
-- 

CREATE TABLE `seguimiento_mensaje` ( `id_profesor` bigint(10) NOT NULL, `id_pregunta` bigint(10) NOT NULL, `fecha_respuesta` datetime default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id_pregunta`), KEY `seguimiento_mensaje_FI_1` (`id_profesor`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `seguimiento_mensaje`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `seleccion_cuestion_test`
-- 

CREATE TABLE `seleccion_cuestion_test` ( `id` bigint(10) NOT NULL auto_increment, `id_respuesta_cuestion_test` bigint(10) NOT NULL, `id_ejercicio_resuelto` bigint(10) NOT NULL, PRIMARY KEY  (`id`), KEY `seleccion_cuestion_test_FI_1` (`id_respuesta_cuestion_test`), KEY `seleccion_cuestion_test_FI_2` (`id_ejercicio_resuelto`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `seleccion_cuestion_test`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sf_simple_forum_category`
-- 

CREATE TABLE `sf_simple_forum_category` ( `id` int(11) NOT NULL auto_increment, `name` varchar(255) default NULL, `stripped_name` varchar(255) default NULL, `description` text, `rank` int(11) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sf_simple_forum_category`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sf_simple_forum_forum`
-- 

CREATE TABLE `sf_simple_forum_forum` ( `id` int(11) NOT NULL auto_increment, `name` varchar(255) default NULL, `stripped_name` varchar(255) default NULL, `description` text, `rank` int(11) default NULL, `category_id` int(11) default NULL, `curso_id` bigint(20) default NULL, `created_at` datetime default NULL, `nb_posts` bigint(20) default NULL, `nb_threads` bigint(20) default NULL, `latest_reply_author_name` varchar(255) default NULL, `latest_replied_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `sf_simple_forum_forum_FI_1` (`category_id`), KEY `sf_simple_forum_forum_FI_2` (`curso_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sf_simple_forum_forum`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sf_simple_forum_post`
-- 

CREATE TABLE `sf_simple_forum_post` ( `id` int(11) NOT NULL auto_increment, `title` varchar(255) default NULL, `content` text, `is_sticked` int(11) default '0', `user_id` bigint(20) default NULL, `forum_id` int(11) default NULL, `parent_id` int(11) default NULL, `created_at` datetime default NULL, `stripped_title` varchar(255) default NULL, `author_name` varchar(255) default NULL, `nb_replies` bigint(20) default NULL, `nb_views` bigint(20) default NULL, `latest_reply_author_name` varchar(255) default NULL, `latest_replied_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `sf_simple_forum_post_FI_1` (`user_id`), KEY `sf_simple_forum_post_FI_2` (`forum_id`), KEY `sf_simple_forum_post_FI_3` (`parent_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sf_simple_forum_post`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tarea`
-- 

CREATE TABLE `tarea` ( `id` bigint(10) NOT NULL auto_increment, `id_curso` bigint(10) NOT NULL, `id_ejercicio` bigint(10) NOT NULL, `id_autor` bigint(10) NOT NULL, `id_evento` bigint(10) NOT NULL, `tiempo_disponible` int(11) default '0', PRIMARY KEY  (`id`), KEY `tarea_FI_1` (`id_curso`), KEY `tarea_FI_2` (`id_ejercicio`), KEY `tarea_FI_3` (`id_autor`), KEY `tarea_FI_4` (`id_evento`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `tarea`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tema`
-- 

CREATE TABLE `tema` (`id` bigint(10) NOT NULL auto_increment, `nombre` varchar(90) default NULL, `fichero` varchar(100) default NULL, `numero_tema` int(11) default NULL, `id_materia` bigint(10) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `tema_FI_1` (`id_materia`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `tema`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipo_cita`
-- 

CREATE TABLE `tipo_cita` ( `id` bigint(10) NOT NULL auto_increment, `descripcion` varchar(20) default NULL, `clase` varchar(20) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `tipo_cita`
-- 

INSERT INTO `tipo_cita` VALUES (1, 'Cumplea&ntilde;os', 'cumpleanos', '2008-09-11 10:29:15');
INSERT INTO `tipo_cita` VALUES (2, 'Reunion', 'reunion', '2008-09-11 10:29:15');
INSERT INTO `tipo_cita` VALUES (3, 'Cita', 'cita', '2008-09-11 10:29:15');
INSERT INTO `tipo_cita` VALUES (4, 'Aniversario', 'aniversario', '2008-09-11 10:29:15');
INSERT INTO `tipo_cita` VALUES (5, 'Recordatorio', 'recordatorio', '2008-09-11 10:29:15');
INSERT INTO `tipo_cita` VALUES (6, 'Otros', 'otros', '2008-09-11 10:29:15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipo_evento`
-- 

CREATE TABLE `tipo_evento` ( `id` bigint(10) NOT NULL auto_increment, `descripcion` varchar(30) default NULL, `clase` varchar(30) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `tipo_evento`
-- 

INSERT INTO `tipo_evento` VALUES (1, 'Examen', 'examen', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (2, 'Examen sorpresa', 'examensorpresa', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (3, 'Tarea', 'ejopcional', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (4, 'Tutor&iacute;a', 'tutoria', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (5, 'Comienzo clases', 'comienzoclases', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (6, 'Fin clases', 'finclases', '2008-09-11 10:29:15');
INSERT INTO `tipo_evento` VALUES (7, 'Aviso', 'aviso', '2008-09-11 10:29:15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` ( `id` bigint(10) NOT NULL auto_increment, `confirmado` tinyint(1) default '0', `borrado` tinyint(1) default '0', `nombreusuario` varchar(100) default NULL, `sha1_password` varchar(40) default NULL, `salt` varchar(32) default NULL, `dni` varchar(10) default NULL, `nombre` varchar(100) default NULL, `apellidos` varchar(100) default NULL, `email` varchar(100) default NULL, `emailstop` tinyint(1) default '0', `telefono1` varchar(20) default NULL, `telefono2` varchar(20) default NULL, `institucion` varchar(40) default NULL, `departamento` varchar(30) default NULL, `direccion` varchar(70) default NULL, `cp` varchar(5) default NULL, `ciudad` varchar(20) default NULL, `pais_id` bigint(10) default NULL, `ultimoacceso` datetime default NULL, `ultimaip` varchar(15) default NULL, `secreto` varchar(15) default NULL, `conectado` int(1) default NULL, `foto` tinyint(1) default '0', `moroso` tinyint(1) default '0', `numconexion` bigint(10) default NULL, `mat_online` tinyint(1) default NULL, `mat_ip` varchar(15) default NULL, `presencial` tinyint(1) default NULL, `created_at` datetime default NULL, PRIMARY KEY  (`id`), KEY `usuario_FI_1` (`pais_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` VALUES (1, 1, 0, 'admin', '2b1095e53b0730da45bed7da99b7bc6448f0f6c9', '562f9d268537b7cd656f501e86515c98', NULL, 'Administrador', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2008-09-11 10:29:15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios_online`
-- 

CREATE TABLE `usuarios_online` ( `id_usuario` bigint(10) NOT NULL, `id_curso` bigint(10) NOT NULL, `id_rol` bigint(10) NOT NULL, `tiempo` bigint(20) default NULL, PRIMARY KEY  (`id_usuario`,`id_curso`), KEY `usuarios_online_FI_2` (`id_curso`), KEY `usuarios_online_FI_3` (`id_rol`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuarios_online`
-- 


-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `calificaciones`
-- 
ALTER TABLE `calificaciones` ADD CONSTRAINT `calificaciones_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `calificaciones_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `cuestion_corta`
-- 
ALTER TABLE `cuestion_corta` ADD CONSTRAINT `cuestion_corta_FK_1` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `cuestion_practica`
-- 
ALTER TABLE `cuestion_practica` ADD CONSTRAINT `cuestion_practica_FK_1` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `cuestion_test`
-- 
ALTER TABLE `cuestion_test` ADD CONSTRAINT `cuestion_test_FK_1` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `curso`
-- 
ALTER TABLE `curso` ADD CONSTRAINT `curso_FK_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `ejercicio`
-- 
ALTER TABLE `ejercicio` ADD CONSTRAINT `ejercicio_FK_1` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id`) ON DELETE SET NULL, ADD CONSTRAINT `ejercicio_FK_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `ejercicio_resuelto`
-- 
ALTER TABLE `ejercicio_resuelto` ADD CONSTRAINT `ejercicio_resuelto_FK_1` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `ejercicio_resuelto_FK_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `ejercicio_resuelto_FK_3` FOREIGN KEY (`id_corrector`) REFERENCES `usuario` (`id`) ON DELETE SET NULL;

-- 
-- Filtros para la tabla `evaluacion_paquete`
-- 
ALTER TABLE `evaluacion_paquete` ADD CONSTRAINT `evaluacion_paquete_FK_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `evaluacion_paquete_FK_2` FOREIGN KEY (`id_tarea`) REFERENCES `tarea` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `evento`
-- 
ALTER TABLE `evento` ADD CONSTRAINT `evento_FK_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `evento_FK_2` FOREIGN KEY (`id_tipo_evento`) REFERENCES `tipo_evento` (`id`), ADD CONSTRAINT `evento_FK_3` FOREIGN KEY (`id_tipo_cita`) REFERENCES `tipo_cita` (`id`);

-- 
-- Filtros para la tabla `libro`
-- 
ALTER TABLE `libro` ADD CONSTRAINT `libro_FK_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `mensaje`
-- 
ALTER TABLE `mensaje` ADD CONSTRAINT `mensaje_FK_1` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `mensaje_FK_2` FOREIGN KEY (`id_emisor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `mensaje_FK_3` FOREIGN KEY (`id_destinatario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `mensaje_FK_4` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `mensaje_FK_5` FOREIGN KEY (`id_asunto`) REFERENCES `asunto_mensaje` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `mensaje_chat`
-- 
ALTER TABLE `mensaje_chat` ADD CONSTRAINT `mensaje_chat_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `mensaje_chat_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `notificacion`
-- 
ALTER TABLE `notificacion` ADD CONSTRAINT `notificacion_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `notificacion_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `notificacion_FK_3` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `preferencia_usuario`
-- 
ALTER TABLE `preferencia_usuario` ADD CONSTRAINT `preferencia_usuario_FK_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_conectado_chat`
-- 
ALTER TABLE `rel_conectado_chat` ADD CONSTRAINT `rel_conectado_chat_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_conectado_chat_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_conectado_chat_FK_3` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

-- 
-- Filtros para la tabla `rel_curso_tema`
-- 
ALTER TABLE `rel_curso_tema` ADD CONSTRAINT `rel_curso_tema_FK_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_curso_tema_FK_2` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_interaccion_sco12_objetivo`
-- 
ALTER TABLE `rel_interaccion_sco12_objetivo` ADD CONSTRAINT `rel_interaccion_sco12_objetivo_FK_1` FOREIGN KEY (`id_sco12`) REFERENCES `sco12` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_interaccion_sco12_objetivo_FK_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_interaccion_sco12_respuesta`
-- 
ALTER TABLE `rel_interaccion_sco12_respuesta` ADD CONSTRAINT `rel_interaccion_sco12_respuesta_FK_1` FOREIGN KEY (`id_sco12`) REFERENCES `sco12` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_interaccion_sco12_respuesta_FK_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_paquete_curso`
-- 
ALTER TABLE `rel_paquete_curso` ADD CONSTRAINT `rel_paquete_curso_FK_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_paquete_curso_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_evento`
-- 
ALTER TABLE `rel_usuario_evento` ADD CONSTRAINT `rel_usuario_evento_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_evento_FK_2` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_interaccion_sco12`
-- 
ALTER TABLE `rel_usuario_interaccion_sco12` ADD CONSTRAINT `rel_usuario_interaccion_sco12_FK_1` FOREIGN KEY (`id_sco12`) REFERENCES `sco12` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_interaccion_sco12_FK_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_objetivo_sco12`
-- 
ALTER TABLE `rel_usuario_objetivo_sco12` ADD CONSTRAINT `rel_usuario_objetivo_sco12_FK_1` FOREIGN KEY (`id_sco12`) REFERENCES `sco12` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_objetivo_sco12_FK_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_paquete`
-- 
ALTER TABLE `rel_usuario_paquete` ADD CONSTRAINT `rel_usuario_paquete_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_paquete_FK_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_rol_curso`
-- 
ALTER TABLE `rel_usuario_rol_curso` ADD CONSTRAINT `rel_usuario_rol_curso_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_rol_curso_FK_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`), ADD CONSTRAINT `rel_usuario_rol_curso_FK_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_sco12`
-- 
ALTER TABLE `rel_usuario_sco12` ADD CONSTRAINT `rel_usuario_sco12_FK_1` FOREIGN KEY (`id_sco12`) REFERENCES `sco12` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_sco12_FK_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `rel_usuario_tarea`
-- 
ALTER TABLE `rel_usuario_tarea` ADD CONSTRAINT `rel_usuario_tarea_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_tarea_FK_2` FOREIGN KEY (`id_tarea`) REFERENCES `tarea` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_tarea_FK_3` FOREIGN KEY (`id_ejercicio_resuelto`) REFERENCES `ejercicio_resuelto` (`id`) ON DELETE SET NULL;

-- 
-- Filtros para la tabla `rel_usuario_tema`
-- 
ALTER TABLE `rel_usuario_tema` ADD CONSTRAINT `rel_usuario_tema_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `rel_usuario_tema_FK_2` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `respuesta_cuestion_corta`
-- 
ALTER TABLE `respuesta_cuestion_corta` ADD CONSTRAINT `respuesta_cuestion_corta_FK_1` FOREIGN KEY (`id_ejercicio_resuelto`) REFERENCES `ejercicio_resuelto` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `respuesta_cuestion_corta_FK_2` FOREIGN KEY (`id_cuestion_corta`) REFERENCES `cuestion_corta` (`id`);

-- 
-- Filtros para la tabla `respuesta_cuestion_practica`
-- 
ALTER TABLE `respuesta_cuestion_practica` ADD CONSTRAINT `respuesta_cuestion_practica_FK_1` FOREIGN KEY (`id_ejercicio_resuelto`) REFERENCES `ejercicio_resuelto` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `respuesta_cuestion_practica_FK_2` FOREIGN KEY (`id_cuestion_practica`) REFERENCES `cuestion_practica` (`id`);

-- 
-- Filtros para la tabla `respuesta_cuestion_test`
-- 
ALTER TABLE `respuesta_cuestion_test` ADD CONSTRAINT `respuesta_cuestion_test_FK_1` FOREIGN KEY (`id_cuestion_test`) REFERENCES `cuestion_test` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `sco12`
-- 
ALTER TABLE `sco12` ADD CONSTRAINT `sco12_FK_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `seguimiento_mensaje`
-- 
ALTER TABLE `seguimiento_mensaje` ADD CONSTRAINT `seguimiento_mensaje_FK_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `seleccion_cuestion_test`
-- 
ALTER TABLE `seleccion_cuestion_test` ADD CONSTRAINT `seleccion_cuestion_test_FK_1` FOREIGN KEY (`id_respuesta_cuestion_test`) REFERENCES `respuesta_cuestion_test` (`id`), ADD CONSTRAINT `seleccion_cuestion_test_FK_2` FOREIGN KEY (`id_ejercicio_resuelto`) REFERENCES `ejercicio_resuelto` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `sf_simple_forum_forum`
-- 
ALTER TABLE `sf_simple_forum_forum` ADD CONSTRAINT `sf_simple_forum_forum_FK_1` FOREIGN KEY (`category_id`) REFERENCES `sf_simple_forum_category` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `sf_simple_forum_forum_FK_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `sf_simple_forum_post`
-- 
ALTER TABLE `sf_simple_forum_post` ADD CONSTRAINT `sf_simple_forum_post_FK_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `sf_simple_forum_post_FK_2` FOREIGN KEY (`forum_id`) REFERENCES `sf_simple_forum_forum` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `sf_simple_forum_post_FK_3` FOREIGN KEY (`parent_id`) REFERENCES `sf_simple_forum_post` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `tarea`
-- 
ALTER TABLE `tarea` ADD CONSTRAINT `tarea_FK_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `tarea_FK_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`), ADD CONSTRAINT `tarea_FK_3` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `tarea_FK_4` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `tema`
-- 
ALTER TABLE `tema` ADD CONSTRAINT `tema_FK_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE;

-- 
-- Filtros para la tabla `usuario`
-- 
ALTER TABLE `usuario` ADD CONSTRAINT `usuario_FK_1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

-- 
-- Filtros para la tabla `usuarios_online`
-- 
ALTER TABLE `usuarios_online` ADD CONSTRAINT `usuarios_online_FK_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `usuarios_online_FK_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `usuarios_online_FK_3` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

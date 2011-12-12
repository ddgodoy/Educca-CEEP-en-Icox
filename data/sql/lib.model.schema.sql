
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- usuario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;


CREATE TABLE `usuario`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`confirmado` TINYINT(1) default 0,
	`borrado` TINYINT(1) default 0,
	`nombreusuario` VARCHAR(100),
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`dni` VARCHAR(10),
	`nombre` VARCHAR(100),
	`apellidos` VARCHAR(100),
	`email` VARCHAR(100),
	`emailstop` TINYINT(1) default 0,
	`telefono1` VARCHAR(20),
	`telefono2` VARCHAR(20),
	`institucion` VARCHAR(40),
	`departamento` VARCHAR(30),
	`direccion` VARCHAR(70),
	`cp` VARCHAR(5),
	`ciudad` VARCHAR(20),
	`pais_id` BIGINT(10),
	`ultimoacceso` DATETIME,
	`ultimaip` VARCHAR(15),
	`secreto` VARCHAR(15),
	`conectado` INTEGER(1),
	`foto` TINYINT(1) default 0,
	`moroso` TINYINT(1) default 0,
	`numconexion` BIGINT(10),
	`mat_online` TINYINT(1),
	`mat_ip` VARCHAR(15),
	`presencial` TINYINT(1),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `usuario_FI_1` (`pais_id`),
	CONSTRAINT `usuario_FK_1`
		FOREIGN KEY (`pais_id`)
		REFERENCES `pais` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- pais
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pais`;


CREATE TABLE `pais`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`isonum` SMALLINT(6),
	`iso2` VARCHAR(2),
	`iso3` VARCHAR(3),
	`nombre` VARCHAR(80),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- paquete
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `paquete`;


CREATE TABLE `paquete`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100),
	`fecha_inicio` DATETIME,
	`fecha_fin` DATETIME,
	`webcam` INTEGER(1),
	`scan` INTEGER(1),
	`duracion` BIGINT(10),
	`precio` FLOAT(7),
	`mensual` INTEGER(1) default 0,
	`descripcion` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- preferencia_usuario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `preferencia_usuario`;


CREATE TABLE `preferencia_usuario`
(
	`usuario_id` BIGINT(10)  NOT NULL,
	`cal_dias_antes` BIGINT(10),
	`cal_dias_despues` BIGINT(10),
	PRIMARY KEY (`usuario_id`),
	CONSTRAINT `preferencia_usuario_FK_1`
		FOREIGN KEY (`usuario_id`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_paquete_curso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_paquete_curso`;


CREATE TABLE `rel_paquete_curso`
(
	`id_paquete` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10)  NOT NULL,
	PRIMARY KEY (`id_paquete`,`id_curso`),
	CONSTRAINT `rel_paquete_curso_FK_1`
		FOREIGN KEY (`id_paquete`)
		REFERENCES `paquete` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_paquete_curso_FI_2` (`id_curso`),
	CONSTRAINT `rel_paquete_curso_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- curso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `curso`;


CREATE TABLE `curso`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100),
	`informacion_extendida` TEXT,
	`fecha_inicio` DATETIME,
	`fecha_fin` DATETIME,
	`scan` INTEGER(1),
	`duracion` BIGINT(10),
	`precio` FLOAT(7),
	`mensual` INTEGER(1) default 0,
	`materia_id` BIGINT(10),
	`menu_info` INTEGER(1) default 1,
	`menu_biblio` INTEGER(1) default 1,
	`menu_temario` INTEGER(1) default 1,
	`menu_seguimiento` INTEGER(1) default 1,
	`menu_eventos` INTEGER(1) default 1,
	`menu_chat` INTEGER(1) default 1,
	`menu_foro` INTEGER(1) default 1,
	`menu_ejercicios` INTEGER(1) default 1,
	`menu_planificacion_alumnos` INTEGER(1) default 1,
	`menu_biblioteca_archivos` INTEGER(1) default 1,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `curso_FI_1` (`materia_id`),
	CONSTRAINT `curso_FK_1`
		FOREIGN KEY (`materia_id`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- materia
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `materia`;


CREATE TABLE `materia`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100),
	`informacion` TEXT,
	`normativa` TEXT,
	`temas_totales` BIGINT(5),
	`height` BIGINT(5),
	`width` BIGINT(5),
	`tipo` VARCHAR(20),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- libro
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `libro`;


CREATE TABLE `libro`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100),
	`autor` VARCHAR(100),
	`editorial` VARCHAR(100),
	`anio_publicacion` VARCHAR(4),
	`isbn` VARCHAR(17),
	`id_materia` BIGINT(10),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `libro_FI_1` (`id_materia`),
	CONSTRAINT `libro_FK_1`
		FOREIGN KEY (`id_materia`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rol
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rol`;


CREATE TABLE `rol`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(30),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_rol_curso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_rol_curso`;


CREATE TABLE `rel_usuario_rol_curso`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_rol` BIGINT(10),
	`id_curso` BIGINT(10)  NOT NULL,
	`cal_dias_antes` BIGINT(10),
	`cal_dias_despues` BIGINT(10),
	`created_at` DATETIME,
	`presencial` TINYINT(1) default 0,
	PRIMARY KEY (`id_usuario`,`id_curso`),
	CONSTRAINT `rel_usuario_rol_curso_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_rol_curso_FI_2` (`id_rol`),
	CONSTRAINT `rel_usuario_rol_curso_FK_2`
		FOREIGN KEY (`id_rol`)
		REFERENCES `rol` (`id`),
	INDEX `rel_usuario_rol_curso_FI_3` (`id_curso`),
	CONSTRAINT `rel_usuario_rol_curso_FK_3`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_paquete
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_paquete`;


CREATE TABLE `rel_usuario_paquete`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_paquete` BIGINT(10)  NOT NULL,
	`created_at` DATETIME,
	`score` FLOAT,
	`presencial` TINYINT(1) default 0,
	PRIMARY KEY (`id_usuario`,`id_paquete`),
	CONSTRAINT `rel_usuario_paquete_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_paquete_FI_2` (`id_paquete`),
	CONSTRAINT `rel_usuario_paquete_FK_2`
		FOREIGN KEY (`id_paquete`)
		REFERENCES `paquete` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tema
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tema`;


CREATE TABLE `tema`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(90),
	`fichero` VARCHAR(100),
	`numero_tema` INTEGER,
	`id_materia` BIGINT(10),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `tema_FI_1` (`id_materia`),
	CONSTRAINT `tema_FK_1`
		FOREIGN KEY (`id_materia`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_curso_tema
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_curso_tema`;


CREATE TABLE `rel_curso_tema`
(
	`id_curso` BIGINT(10)  NOT NULL,
	`id_tema` BIGINT(10)  NOT NULL,
	`fecha_completado` DATETIME,
	PRIMARY KEY (`id_curso`,`id_tema`),
	CONSTRAINT `rel_curso_tema_FK_1`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_curso_tema_FI_2` (`id_tema`),
	CONSTRAINT `rel_curso_tema_FK_2`
		FOREIGN KEY (`id_tema`)
		REFERENCES `tema` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_tema
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_tema`;


CREATE TABLE `rel_usuario_tema`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_tema` BIGINT(10)  NOT NULL,
	`tiempo` BIGINT(10),
	`estado` TINYINT(3),
	`fecha_inicio` DATETIME,
	`fecha_completado` DATETIME,
	PRIMARY KEY (`id_usuario`,`id_tema`),
	CONSTRAINT `rel_usuario_tema_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_tema_FI_2` (`id_tema`),
	CONSTRAINT `rel_usuario_tema_FK_2`
		FOREIGN KEY (`id_tema`)
		REFERENCES `tema` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- mensaje
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mensaje`;


CREATE TABLE `mensaje`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_propietario` BIGINT(10)  NOT NULL,
	`id_emisor` BIGINT(10)  NOT NULL,
	`id_destinatario` BIGINT(10),
	`id_curso` BIGINT(10)  NOT NULL,
	`lista_destinatarios` TEXT,
	`id_asunto` BIGINT(10)  NOT NULL,
	`contenido` TEXT,
	`created_at` DATETIME,
	`leido` TINYINT(1) default 0,
	`borrado` TINYINT(1) default 0,
	`supervisor` TINYINT(1) default 0,
	`adjuntos` TINYINT(2) default 0,
	PRIMARY KEY (`id`),
	INDEX `mensaje_FI_1` (`id_propietario`),
	CONSTRAINT `mensaje_FK_1`
		FOREIGN KEY (`id_propietario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `mensaje_FI_2` (`id_emisor`),
	CONSTRAINT `mensaje_FK_2`
		FOREIGN KEY (`id_emisor`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `mensaje_FI_3` (`id_destinatario`),
	CONSTRAINT `mensaje_FK_3`
		FOREIGN KEY (`id_destinatario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `mensaje_FI_4` (`id_curso`),
	CONSTRAINT `mensaje_FK_4`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `mensaje_FI_5` (`id_asunto`),
	CONSTRAINT `mensaje_FK_5`
		FOREIGN KEY (`id_asunto`)
		REFERENCES `asunto_mensaje` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- asunto_mensaje
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `asunto_mensaje`;


CREATE TABLE `asunto_mensaje`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(100),
	`nombre` VARCHAR(50),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- seguimiento_mensaje
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `seguimiento_mensaje`;


CREATE TABLE `seguimiento_mensaje`
(
	`id_profesor` BIGINT(10)  NOT NULL,
	`id_pregunta` BIGINT(10)  NOT NULL,
	`fecha_respuesta` DATETIME,
	`created_at` DATETIME,
	PRIMARY KEY (`id_pregunta`),
	INDEX `seguimiento_mensaje_FI_1` (`id_profesor`),
	CONSTRAINT `seguimiento_mensaje_FK_1`
		FOREIGN KEY (`id_profesor`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- notificacion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notificacion`;


CREATE TABLE `notificacion`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10),
	`id_tema` BIGINT(10),
	`tipo` VARCHAR(100),
	`titulo` VARCHAR(100),
	`contenido` TEXT,
	`fecha` DATETIME,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `notificacion_FI_1` (`id_usuario`),
	CONSTRAINT `notificacion_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `notificacion_FI_2` (`id_curso`),
	CONSTRAINT `notificacion_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `notificacion_FI_3` (`id_tema`),
	CONSTRAINT `notificacion_FK_3`
		FOREIGN KEY (`id_tema`)
		REFERENCES `tema` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- mensaje_chat
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mensaje_chat`;


CREATE TABLE `mensaje_chat`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10)  NOT NULL,
	`msg` TEXT,
	`time` INTEGER,
	PRIMARY KEY (`id`,`id_usuario`,`id_curso`),
	INDEX `mensaje_chat_FI_1` (`id_usuario`),
	CONSTRAINT `mensaje_chat_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `mensaje_chat_FI_2` (`id_curso`),
	CONSTRAINT `mensaje_chat_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_conectado_chat
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_conectado_chat`;


CREATE TABLE `rel_conectado_chat`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10)  NOT NULL,
	`id_rol` BIGINT(10)  NOT NULL,
	`tiempo` BIGINT(20),
	PRIMARY KEY (`id_usuario`,`id_curso`),
	CONSTRAINT `rel_conectado_chat_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_conectado_chat_FI_2` (`id_curso`),
	CONSTRAINT `rel_conectado_chat_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_conectado_chat_FI_3` (`id_rol`),
	CONSTRAINT `rel_conectado_chat_FK_3`
		FOREIGN KEY (`id_rol`)
		REFERENCES `rol` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tipo_evento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_evento`;


CREATE TABLE `tipo_evento`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(30),
	`clase` VARCHAR(30),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tipo_cita
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_cita`;


CREATE TABLE `tipo_cita`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(20),
	`clase` VARCHAR(20),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- evento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `evento`;


CREATE TABLE `evento`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_curso` BIGINT(10),
	`privado` TINYINT(2) default 0,
	`fecha_inicio` DATETIME,
	`fecha_fin` DATETIME,
	`id_tipo_evento` BIGINT(10),
	`id_tipo_cita` BIGINT(10),
	`recurrente` BIGINT(7),
	`titulo` VARCHAR(150),
	`descripcion` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `evento_FI_1` (`id_curso`),
	CONSTRAINT `evento_FK_1`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `evento_FI_2` (`id_tipo_evento`),
	CONSTRAINT `evento_FK_2`
		FOREIGN KEY (`id_tipo_evento`)
		REFERENCES `tipo_evento` (`id`),
	INDEX `evento_FI_3` (`id_tipo_cita`),
	CONSTRAINT `evento_FK_3`
		FOREIGN KEY (`id_tipo_cita`)
		REFERENCES `tipo_cita` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_evento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_evento`;


CREATE TABLE `rel_usuario_evento`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_evento` BIGINT(10)  NOT NULL,
	PRIMARY KEY (`id_usuario`,`id_evento`),
	CONSTRAINT `rel_usuario_evento_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_evento_FI_2` (`id_evento`),
	CONSTRAINT `rel_usuario_evento_FK_2`
		FOREIGN KEY (`id_evento`)
		REFERENCES `evento` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ejercicio
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ejercicio`;


CREATE TABLE `ejercicio`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_autor` BIGINT(10),
	`id_materia` BIGINT(10),
	`nombre_autor` VARCHAR(100),
	`tipo` VARCHAR(20),
	`titulo` VARCHAR(40),
	`test_multiple` TINYINT(1) default 0,
	`test_resta` TINYINT(1) default 0,
	`numero_respuestas` INTEGER,
	`publicado` TINYINT(1) default 0,
	`solucion` TINYINT(1) default 0,
	`expresiones_matematicas` TINYINT(1) default 0,
	`numero_hojas` INTEGER,
	`id_solucion` BIGINT(10),
	PRIMARY KEY (`id`),
	INDEX `ejercicio_FI_1` (`id_autor`),
	CONSTRAINT `ejercicio_FK_1`
		FOREIGN KEY (`id_autor`)
		REFERENCES `usuario` (`id`)
		ON DELETE SET NULL,
	INDEX `ejercicio_FI_2` (`id_materia`),
	CONSTRAINT `ejercicio_FK_2`
		FOREIGN KEY (`id_materia`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE,
	INDEX `ejercicio_FI_3` (`id_solucion`),
	CONSTRAINT `ejercicio_FK_3`
		FOREIGN KEY (`id_solucion`)
		REFERENCES `ejercicio_resuelto` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- publicado_ejercicio_curso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `publicado_ejercicio_curso`;


CREATE TABLE `publicado_ejercicio_curso`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio` BIGINT(10),
	`id_curso` BIGINT(10),
	`solucion` TINYINT(1) default 0,
	PRIMARY KEY (`id`),
	INDEX `publicado_ejercicio_curso_FI_1` (`id_ejercicio`),
	CONSTRAINT `publicado_ejercicio_curso_FK_1`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE,
	INDEX `publicado_ejercicio_curso_FI_2` (`id_curso`),
	CONSTRAINT `publicado_ejercicio_curso_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cuestion_corta
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cuestion_corta`;


CREATE TABLE `cuestion_corta`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio` BIGINT(10)  NOT NULL,
	`pregunta` TEXT,
	`puntuacion` FLOAT default 0,
	PRIMARY KEY (`id`),
	INDEX `cuestion_corta_FI_1` (`id_ejercicio`),
	CONSTRAINT `cuestion_corta_FK_1`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cuestion_test
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cuestion_test`;


CREATE TABLE `cuestion_test`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio` BIGINT(10)  NOT NULL,
	`pregunta` TEXT,
	`numero_respuestas_correctas` INTEGER default 0,
	`numero_respuestas_incorrectas` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `cuestion_test_FI_1` (`id_ejercicio`),
	CONSTRAINT `cuestion_test_FK_1`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cuestion_practica
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cuestion_practica`;


CREATE TABLE `cuestion_practica`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio` BIGINT(10)  NOT NULL,
	`contenido_latex` TEXT,
	`puntuacion` FLOAT,
	PRIMARY KEY (`id`),
	INDEX `cuestion_practica_FI_1` (`id_ejercicio`),
	CONSTRAINT `cuestion_practica_FK_1`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ejercicio_resuelto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ejercicio_resuelto`;


CREATE TABLE `ejercicio_resuelto`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_autor` BIGINT(10)  NOT NULL,
	`id_ejercicio` BIGINT(10)  NOT NULL,
	`id_corrector` BIGINT(10),
	`fecha_correccion` DATETIME,
	`score` FLOAT default 0,
	`aciertos` INTEGER default 0,
	`fallos` INTEGER default 0,
	`blancos` INTEGER default 0,
	`tiempo` INTEGER default 0,
	`repositorio` TINYINT(1) default 0,
	`id_curso` BIGINT(10),
	PRIMARY KEY (`id`),
	INDEX `ejercicio_resuelto_FI_1` (`id_autor`),
	CONSTRAINT `ejercicio_resuelto_FK_1`
		FOREIGN KEY (`id_autor`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `ejercicio_resuelto_FI_2` (`id_ejercicio`),
	CONSTRAINT `ejercicio_resuelto_FK_2`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE,
	INDEX `ejercicio_resuelto_FI_3` (`id_corrector`),
	CONSTRAINT `ejercicio_resuelto_FK_3`
		FOREIGN KEY (`id_corrector`)
		REFERENCES `usuario` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- respuesta_cuestion_corta
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `respuesta_cuestion_corta`;


CREATE TABLE `respuesta_cuestion_corta`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio_resuelto` BIGINT(10)  NOT NULL,
	`id_cuestion_corta` BIGINT(10)  NOT NULL,
	`respuesta` TEXT,
	`comentario` TEXT,
	`puntuacion` FLOAT,
	PRIMARY KEY (`id`),
	INDEX `respuesta_cuestion_corta_FI_1` (`id_ejercicio_resuelto`),
	CONSTRAINT `respuesta_cuestion_corta_FK_1`
		FOREIGN KEY (`id_ejercicio_resuelto`)
		REFERENCES `ejercicio_resuelto` (`id`)
		ON DELETE CASCADE,
	INDEX `respuesta_cuestion_corta_FI_2` (`id_cuestion_corta`),
	CONSTRAINT `respuesta_cuestion_corta_FK_2`
		FOREIGN KEY (`id_cuestion_corta`)
		REFERENCES `cuestion_corta` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- respuesta_cuestion_test
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `respuesta_cuestion_test`;


CREATE TABLE `respuesta_cuestion_test`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_cuestion_test` BIGINT(10)  NOT NULL,
	`respuesta` TEXT,
	`correcta` TINYINT(1) default 0,
	PRIMARY KEY (`id`),
	INDEX `respuesta_cuestion_test_FI_1` (`id_cuestion_test`),
	CONSTRAINT `respuesta_cuestion_test_FK_1`
		FOREIGN KEY (`id_cuestion_test`)
		REFERENCES `cuestion_test` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- respuesta_cuestion_practica
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `respuesta_cuestion_practica`;


CREATE TABLE `respuesta_cuestion_practica`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_ejercicio_resuelto` BIGINT(10)  NOT NULL,
	`id_cuestion_practica` BIGINT(10)  NOT NULL,
	`puntuacion` FLOAT,
	PRIMARY KEY (`id`),
	INDEX `respuesta_cuestion_practica_FI_1` (`id_ejercicio_resuelto`),
	CONSTRAINT `respuesta_cuestion_practica_FK_1`
		FOREIGN KEY (`id_ejercicio_resuelto`)
		REFERENCES `ejercicio_resuelto` (`id`)
		ON DELETE CASCADE,
	INDEX `respuesta_cuestion_practica_FI_2` (`id_cuestion_practica`),
	CONSTRAINT `respuesta_cuestion_practica_FK_2`
		FOREIGN KEY (`id_cuestion_practica`)
		REFERENCES `cuestion_practica` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- seleccion_cuestion_test
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `seleccion_cuestion_test`;


CREATE TABLE `seleccion_cuestion_test`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_respuesta_cuestion_test` BIGINT(10)  NOT NULL,
	`id_ejercicio_resuelto` BIGINT(10)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `seleccion_cuestion_test_FI_1` (`id_respuesta_cuestion_test`),
	CONSTRAINT `seleccion_cuestion_test_FK_1`
		FOREIGN KEY (`id_respuesta_cuestion_test`)
		REFERENCES `respuesta_cuestion_test` (`id`)
		ON DELETE CASCADE,
	INDEX `seleccion_cuestion_test_FI_2` (`id_ejercicio_resuelto`),
	CONSTRAINT `seleccion_cuestion_test_FK_2`
		FOREIGN KEY (`id_ejercicio_resuelto`)
		REFERENCES `ejercicio_resuelto` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tarea
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tarea`;


CREATE TABLE `tarea`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_curso` BIGINT(10)  NOT NULL,
	`id_ejercicio` BIGINT(10)  NOT NULL,
	`id_autor` BIGINT(10)  NOT NULL,
	`id_evento` BIGINT(10)  NOT NULL,
	`tiempo_disponible` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `tarea_FI_1` (`id_curso`),
	CONSTRAINT `tarea_FK_1`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `tarea_FI_2` (`id_ejercicio`),
	CONSTRAINT `tarea_FK_2`
		FOREIGN KEY (`id_ejercicio`)
		REFERENCES `ejercicio` (`id`)
		ON DELETE CASCADE,
	INDEX `tarea_FI_3` (`id_autor`),
	CONSTRAINT `tarea_FK_3`
		FOREIGN KEY (`id_autor`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `tarea_FI_4` (`id_evento`),
	CONSTRAINT `tarea_FK_4`
		FOREIGN KEY (`id_evento`)
		REFERENCES `evento` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_tarea
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_tarea`;


CREATE TABLE `rel_usuario_tarea`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_tarea` BIGINT(10)  NOT NULL,
	`id_ejercicio_resuelto` BIGINT(10),
	`entregada` TINYINT(1) default 0,
	`corregida` TINYINT(1) default 0,
	`fecha_entrega` DATETIME,
	`tiempo_restante` INTEGER default 0,
	PRIMARY KEY (`id_usuario`,`id_tarea`),
	CONSTRAINT `rel_usuario_tarea_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_tarea_FI_2` (`id_tarea`),
	CONSTRAINT `rel_usuario_tarea_FK_2`
		FOREIGN KEY (`id_tarea`)
		REFERENCES `tarea` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_tarea_FI_3` (`id_ejercicio_resuelto`),
	CONSTRAINT `rel_usuario_tarea_FK_3`
		FOREIGN KEY (`id_ejercicio_resuelto`)
		REFERENCES `ejercicio_resuelto` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- calificaciones
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `calificaciones`;


CREATE TABLE `calificaciones`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10)  NOT NULL,
	`score` FLOAT,
	PRIMARY KEY (`id_usuario`,`id_curso`),
	CONSTRAINT `calificaciones_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `calificaciones_FI_2` (`id_curso`),
	CONSTRAINT `calificaciones_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- evaluacion_paquete
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `evaluacion_paquete`;


CREATE TABLE `evaluacion_paquete`
(
	`id_paquete` BIGINT(10)  NOT NULL,
	`id_tarea` BIGINT(10)  NOT NULL,
	`peso` FLOAT,
	PRIMARY KEY (`id_paquete`,`id_tarea`),
	CONSTRAINT `evaluacion_paquete_FK_1`
		FOREIGN KEY (`id_paquete`)
		REFERENCES `paquete` (`id`)
		ON DELETE CASCADE,
	INDEX `evaluacion_paquete_FI_2` (`id_tarea`),
	CONSTRAINT `evaluacion_paquete_FK_2`
		FOREIGN KEY (`id_tarea`)
		REFERENCES `tarea` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- usuarios_online
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios_online`;


CREATE TABLE `usuarios_online`
(
	`id_usuario` BIGINT(10)  NOT NULL,
	`id_curso` BIGINT(10)  NOT NULL,
	`id_rol` BIGINT(10)  NOT NULL,
	`tiempo` BIGINT(20),
	PRIMARY KEY (`id_usuario`,`id_curso`),
	CONSTRAINT `usuarios_online_FK_1`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `usuarios_online_FI_2` (`id_curso`),
	CONSTRAINT `usuarios_online_FK_2`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE,
	INDEX `usuarios_online_FI_3` (`id_rol`),
	CONSTRAINT `usuarios_online_FK_3`
		FOREIGN KEY (`id_rol`)
		REFERENCES `rol` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sco2004
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sco2004`;


CREATE TABLE `sco2004`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`ref_sco2004` VARCHAR(255),
	`id_materia` BIGINT(10),
	`title` TEXT,
	`file` TEXT,
	`completion_treshold` FLOAT,
	`credit` VARCHAR(10),
	`launch_data` TEXT,
	`max_time_allowed` INTEGER,
	`mode` VARCHAR(10),
	`time_limit_action` VARCHAR(10),
	`scaled_passing_score` FLOAT,
	PRIMARY KEY (`id`),
	INDEX `sco2004_FI_1` (`id_materia`),
	CONSTRAINT `sco2004_FK_1`
		FOREIGN KEY (`id_materia`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004`;


CREATE TABLE `rel_usuario_sco2004`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`completion_status` VARCHAR(20),
	`entry` VARCHAR(10),
	`exit` VARCHAR(10),
	`audio_level` FLOAT,
	`language` VARCHAR(250),
	`delivery_speed` FLOAT,
	`audio_captioning` VARCHAR(10),
	`location` TEXT,
	`mode` VARCHAR(10),
	`progress_measure` FLOAT,
	`score_scaled` FLOAT,
	`score_raw` FLOAT,
	`score_min` FLOAT,
	`score_max` FLOAT,
	`session_time` BIGINT,
	`success_status` VARCHAR(10),
	`suspend_data` TEXT,
	`total_time` BIGINT,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_learnerc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_learnerc`;


CREATE TABLE `rel_usuario_sco2004_learnerc`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`comment_index` INTEGER,
	`comment` TEXT,
	`location` TEXT,
	`tstamp` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_learnerc_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_learnerc_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_learnerc_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_learnerc_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_lmsc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_lmsc`;


CREATE TABLE `rel_usuario_sco2004_lmsc`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`comment_index` INTEGER,
	`comment` TEXT,
	`location` TEXT,
	`tstamp` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_lmsc_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_lmsc_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_lmsc_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_lmsc_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_interaction
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_interaction`;


CREATE TABLE `rel_usuario_sco2004_interaction`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`interaction_index` INTEGER,
	`interaction_id` TEXT,
	`type` VARCHAR(18),
	`tstamp` DATETIME,
	`weighting` FLOAT,
	`learner_response` TEXT,
	`result` VARCHAR(18),
	`latency` FLOAT,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_interaction_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_interaction_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_interaction_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_interaction_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_iobjective
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_iobjective`;


CREATE TABLE `rel_usuario_sco2004_iobjective`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`interaction_index` INTEGER,
	`objective_index` INTEGER,
	`objective_id` TEXT,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_iobjective_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_iobjective_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_iobjective_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_iobjective_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_iresponse
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_iresponse`;


CREATE TABLE `rel_usuario_sco2004_iresponse`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`interaction_index` INTEGER,
	`response_index` INTEGER,
	`pattern` TEXT,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_iresponse_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_iresponse_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_iresponse_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_iresponse_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco2004_objective
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco2004_objective`;


CREATE TABLE `rel_usuario_sco2004_objective`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco2004` BIGINT(10),
	`id_usuario` BIGINT(10),
	`objective_index` INTEGER,
	`objective_id` TEXT,
	`score_scaled` FLOAT,
	`score_raw` FLOAT,
	`score_min` FLOAT,
	`score_max` FLOAT,
	`success_status` VARCHAR(10),
	`completion_status` VARCHAR(20),
	`progress_measure` FLOAT,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco2004_objective_FI_1` (`id_sco2004`),
	CONSTRAINT `rel_usuario_sco2004_objective_FK_1`
		FOREIGN KEY (`id_sco2004`)
		REFERENCES `sco2004` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco2004_objective_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco2004_objective_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sco12
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sco12`;


CREATE TABLE `sco12`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`ref_sco12` VARCHAR(255),
	`id_materia` BIGINT(10),
	`title` TEXT,
	`file` TEXT,
	`credit` VARCHAR(255),
	`launch_data` TEXT,
	`mastery_score` FLOAT,
	`max_time_allowed` VARCHAR(20),
	`time_limit_action` TEXT,
	PRIMARY KEY (`id`),
	INDEX `sco12_FI_1` (`id_materia`),
	CONSTRAINT `sco12_FK_1`
		FOREIGN KEY (`id_materia`)
		REFERENCES `materia` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_sco12
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_sco12`;


CREATE TABLE `rel_usuario_sco12`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`id_sco12` BIGINT(10),
	`id_usuario` BIGINT(10),
	`lesson_location` VARCHAR(255),
	`credit` VARCHAR(255),
	`lesson_status` VARCHAR(255),
	`entry` VARCHAR(20),
	`score_raw` FLOAT,
	`score_max` FLOAT,
	`score_min` FLOAT,
	`total_time` VARCHAR(20),
	`lesson_mode` VARCHAR(20),
	`exitvalue` VARCHAR(20),
	`session_time` VARCHAR(20),
	`suspend_data` TEXT,
	`comments` TEXT,
	`comments_from_lms` TEXT,
	`preference_audio` INTEGER,
	`preference_language` VARCHAR(255),
	`preference_speed` INTEGER,
	`preference_text` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_sco12_FI_1` (`id_sco12`),
	CONSTRAINT `rel_usuario_sco12_FK_1`
		FOREIGN KEY (`id_sco12`)
		REFERENCES `sco12` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_sco12_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_sco12_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_objetivo_sco12
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_objetivo_sco12`;


CREATE TABLE `rel_usuario_objetivo_sco12`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`ref_objetivo` VARCHAR(255),
	`index_objetivo` BIGINT(10),
	`id_sco12` BIGINT(10),
	`id_usuario` BIGINT(10),
	`score_raw` FLOAT,
	`score_max` FLOAT,
	`score_min` FLOAT,
	`status` VARCHAR(20),
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_objetivo_sco12_FI_1` (`id_sco12`),
	CONSTRAINT `rel_usuario_objetivo_sco12_FK_1`
		FOREIGN KEY (`id_sco12`)
		REFERENCES `sco12` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_objetivo_sco12_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_objetivo_sco12_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_usuario_interaccion_sco12
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_usuario_interaccion_sco12`;


CREATE TABLE `rel_usuario_interaccion_sco12`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`ref_interaccion` VARCHAR(255),
	`index_interaccion` BIGINT(10),
	`id_sco12` BIGINT(10),
	`id_usuario` BIGINT(10),
	`time` VARCHAR(20),
	`type` VARCHAR(20),
	`weighting` FLOAT,
	`student_response` VARCHAR(20),
	`result` VARCHAR(20),
	`latency` VARCHAR(20),
	PRIMARY KEY (`id`),
	INDEX `rel_usuario_interaccion_sco12_FI_1` (`id_sco12`),
	CONSTRAINT `rel_usuario_interaccion_sco12_FK_1`
		FOREIGN KEY (`id_sco12`)
		REFERENCES `sco12` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_usuario_interaccion_sco12_FI_2` (`id_usuario`),
	CONSTRAINT `rel_usuario_interaccion_sco12_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_interaccion_sco12_objetivo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_interaccion_sco12_objetivo`;


CREATE TABLE `rel_interaccion_sco12_objetivo`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`index_objetivo` BIGINT(10),
	`index_interaccion` BIGINT(10),
	`id_sco12` BIGINT(10),
	`id_usuario` BIGINT(10),
	`ref_objetivo` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rel_interaccion_sco12_objetivo_FI_1` (`id_sco12`),
	CONSTRAINT `rel_interaccion_sco12_objetivo_FK_1`
		FOREIGN KEY (`id_sco12`)
		REFERENCES `sco12` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_interaccion_sco12_objetivo_FI_2` (`id_usuario`),
	CONSTRAINT `rel_interaccion_sco12_objetivo_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rel_interaccion_sco12_respuesta
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_interaccion_sco12_respuesta`;


CREATE TABLE `rel_interaccion_sco12_respuesta`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`index_respuesta` BIGINT(10),
	`index_interaccion` BIGINT(10),
	`id_sco12` BIGINT(10),
	`id_usuario` BIGINT(10),
	`pattern` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rel_interaccion_sco12_respuesta_FI_1` (`id_sco12`),
	CONSTRAINT `rel_interaccion_sco12_respuesta_FK_1`
		FOREIGN KEY (`id_sco12`)
		REFERENCES `sco12` (`id`)
		ON DELETE CASCADE,
	INDEX `rel_interaccion_sco12_respuesta_FI_2` (`id_usuario`),
	CONSTRAINT `rel_interaccion_sco12_respuesta_FK_2`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- biblioteca_archivos
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `biblioteca_archivos`;


CREATE TABLE `biblioteca_archivos`
(
	`id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100),
	`descripcion` TEXT,
	`id_curso` BIGINT(10)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `biblioteca_archivos_FI_1` (`id_curso`),
	CONSTRAINT `biblioteca_archivos_FK_1`
		FOREIGN KEY (`id_curso`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

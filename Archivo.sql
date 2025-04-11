create database desafio_dss2;

use desafio_dss2;

CREATE TABLE `escuelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `escuelas` VALUES (1,'Facultad de Ingeniería'),(2,'Facultad de Ciencias'),(3,'Facultad de Humanidades'),(4,'Facultad de Medicina'),(5,'Facultad de Derecho'),(6,'Facultad de Arquitectura'),(7,'Facultad de Economía'),(8,'Facultad de Artes'),(9,'Facultad de Educación'),(10,'Facultad de Psicología');


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(45) NOT NULL DEFAULT 'estudiante',
  `id_escuela` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_escuela` (`id_escuela`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_escuela`) REFERENCES `escuelas` (`id`) ON DELETE SET NULL
);

INSERT INTO `users` VALUES (8,'admin','admin@demo.com','$2y$10$yJVlteFbepryhrKrWXalf.Tp/HwOvtIxrzUyIe5LcNicaJh3PjXmG','decano',NULL);

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text,
  `id_user_owner` int(11) NOT NULL,
  `etapa` varchar(45) DEFAULT 'Propuesta de tema',
  PRIMARY KEY (`id`),
  KEY `FK_USERSOWNERPROJECT` (`id_user_owner`),
  CONSTRAINT `FK_USERSOWNERPROJECT` FOREIGN KEY (`id_user_owner`) REFERENCES `users` (`id`)
);



CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(255) NOT NULL,
  `id_project` int(11) NOT NULL,
  `tipo_archivo` varchar(50) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_FILEPROJECT` (`id_project`),
  CONSTRAINT `FK_FILEPROJECT` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`)
);


CREATE TABLE `project_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_project` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERPROJECT` (`id_user`),
  KEY `FK_PROJECTUSER` (`id_project`),
  CONSTRAINT `FK_PROJECTUSER` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`),
  CONSTRAINT `FK_USERPROJECT` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
);



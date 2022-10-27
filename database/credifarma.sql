/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - credifarma
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`credifarma` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `credifarma`;

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id_company` int(11) NOT NULL AUTO_INCREMENT,
  `ruc_company` varchar(250) DEFAULT NULL,
  `name_company` varchar(250) DEFAULT NULL,
  `address_company` varchar(250) DEFAULT NULL,
  `city_company` varchar(250) DEFAULT NULL,
  `phone_company` varchar(250) DEFAULT NULL,
  `date_created_company` date DEFAULT NULL,
  `date_updated_company` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `companies` */

insert  into `companies`(`id_company`,`ruc_company`,`name_company`,`address_company`,`city_company`,`phone_company`,`date_created_company`,`date_updated_company`) values (1,'10472810371','JOEL VLADIMIR MEDRANO GUERE','GREGORIO SISA 133','CARABAYLLO','982009013','2022-10-26','2022-10-26 22:11:19'),(2,'10743183440','CARLOS ENRIQUE MEDRANO GUERE','AV. HUANDOY 7509','LOS OLIVOS','983263762','2022-10-26','2022-10-26 22:11:27'),(3,'10474909102','TIFFANY THALIA CUNZA CASRILLO','MERURIO ALTO','LOS OLIVOS',NULL,'2022-10-26','2022-10-26 22:11:02');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `rol_user` varchar(20) DEFAULT NULL,
  `picture_user` varchar(250) DEFAULT NULL,
  `displayname_user` varchar(250) DEFAULT NULL,
  `username_user` varchar(250) DEFAULT NULL,
  `password_user` varchar(250) DEFAULT NULL,
  `email_user` varchar(250) DEFAULT NULL,
  `phone_user` varchar(250) DEFAULT NULL,
  `address_user` varchar(250) DEFAULT NULL,
  `country_user` varchar(250) DEFAULT NULL,
  `city_user` varchar(250) DEFAULT NULL,
  `state_user` int(11) DEFAULT 1,
  `id_company_user` int(11) DEFAULT NULL,
  `last_login_user` datetime DEFAULT NULL,
  `pcreg_user` varchar(250) DEFAULT NULL,
  `usreg_user` varchar(250) DEFAULT NULL,
  `pcmod_user` varchar(250) DEFAULT NULL,
  `usmod_user` varchar(250) DEFAULT NULL,
  `token_user` text DEFAULT NULL,
  `token_exp_user` text DEFAULT NULL,
  `verification_user` int(11) NOT NULL DEFAULT 0,
  `date_created_user` date DEFAULT NULL,
  `date_updated_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id_user`,`rol_user`,`picture_user`,`displayname_user`,`username_user`,`password_user`,`email_user`,`phone_user`,`address_user`,`country_user`,`city_user`,`state_user`,`id_company_user`,`last_login_user`,`pcreg_user`,`usreg_user`,`pcmod_user`,`usmod_user`,`token_user`,`token_exp_user`,`verification_user`,`date_created_user`,`date_updated_user`) values (1,'admin','joel.jpg','Joel Medrano','jmedrano','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','jvmedranog@gmail.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjY4NDUwODIsImV4cCI6MTY2NjkzMTQ4MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6Imp2bWVkcmFub2dAZ21haWwuY29tIn19.qTvA1etWpRPNaGWkJrPEhYYM-p4LneCQEmFKUvDaARQ','1666931482',0,'2022-10-25','2022-10-26 23:31:22'),(2,'admin',NULL,'Tiffany Cunza','tcunza','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','cunza.dg@gmail.com',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjY3NDk0MzcsImV4cCI6MTY2NjgzNTgzNywiZGF0YSI6eyJpZCI6IjMxIiwiZW1haWwiOiJjdW56YS5kZ0BnbWFpbC5jb20ifX0.SuXAap6ZT-FlZFUMSI9YeOjrScual8MLS8IGprJzspM','1666835837',0,'2022-10-25','2022-10-26 23:31:10'),(3,'seller',NULL,'Juan Carlos Arcila Díaz',NULL,'','jdelaarcila@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-10-24','2022-10-26 20:41:20'),(4,'seller',NULL,'Jorge García',NULL,'','jgarcia@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-10-24','2022-10-26 20:41:21'),(5,'seller',NULL,'Javier Arturo Vázquez Olivares',NULL,'','jdelavazquez@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-10-24','2022-10-26 20:41:22'),(6,'seller',NULL,'Rodrigo Martinez Blanco',NULL,'','rblanco@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-10-24','2022-10-26 20:41:22'),(7,'seller',NULL,'Ángel Arias',NULL,'','aarias@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-09-26','2022-10-26 20:41:30'),(8,'seller',NULL,'Aldo Olivares',NULL,'','aolivares@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-09-26','2022-10-26 20:41:30'),(9,'seller',NULL,'Redait Media',NULL,'','rmedia@correo.com',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'','',0,'2022-09-26','2022-10-26 20:41:31'),(67,'admin','67.png','Carlos Medrano Guere','cmedrano','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','cmedrano@gmail.com',NULL,NULL,NULL,NULL,1,2,NULL,'Joel-PC','jmedrano',NULL,NULL,NULL,NULL,0,'2022-10-27','2022-10-27 00:27:04'),(68,'seller','68.png','Carla Guerrero','cguerrero','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','cguerrero@gmail.com',NULL,NULL,NULL,NULL,1,1,NULL,'Joel-PC','jmedrano',NULL,NULL,NULL,NULL,0,'2022-10-27','2022-10-27 00:29:19');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

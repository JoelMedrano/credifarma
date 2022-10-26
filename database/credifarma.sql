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
  `last_login_user` datetime DEFAULT NULL,
  `token_user` text DEFAULT NULL,
  `token_exp_user` text DEFAULT NULL,
  `verification_user` int(11) NOT NULL DEFAULT 0,
  `date_created_user` date DEFAULT NULL,
  `date_updated_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id_user`,`rol_user`,`picture_user`,`displayname_user`,`username_user`,`password_user`,`email_user`,`phone_user`,`address_user`,`country_user`,`city_user`,`state_user`,`last_login_user`,`token_user`,`token_exp_user`,`verification_user`,`date_created_user`,`date_updated_user`) values (1,'admin','joel.jpg','Joel Medrano',NULL,'$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','jvmedranog@gmail.com',NULL,NULL,NULL,NULL,1,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjY3NTUzNzAsImV4cCI6MTY2Njg0MTc3MCwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6Imp2bWVkcmFub2dAZ21haWwuY29tIn19.R5_kkRLS_ro-bW4XxDb6HvVPXcj4kJb8cICk6JhsNDk','1666841770',0,'2022-10-25','2022-10-25 22:56:06'),(2,'admin',NULL,'Tiffany Cunza',NULL,'$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq','cunza.dg@gmail.com',NULL,NULL,NULL,NULL,0,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjY3NDk0MzcsImV4cCI6MTY2NjgzNTgzNywiZGF0YSI6eyJpZCI6IjMxIiwiZW1haWwiOiJjdW56YS5kZ0BnbWFpbC5jb20ifX0.SuXAap6ZT-FlZFUMSI9YeOjrScual8MLS8IGprJzspM','1666835837',0,'2022-10-25','2022-10-25 22:57:49'),(3,'seller',NULL,'Juan Carlos Arcila Díaz',NULL,'','jdelaarcila@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:47'),(4,'seller',NULL,'Jorge García',NULL,'','jgarcia@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:49'),(5,'seller',NULL,'Javier Arturo Vázquez Olivares',NULL,'','jdelavazquez@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:49'),(6,'seller',NULL,'Rodrigo Martinez Blanco',NULL,'','rblanco@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:49'),(7,'seller',NULL,'Ángel Arias',NULL,'','aarias@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:50'),(8,'seller',NULL,'Aldo Olivares',NULL,'','aolivares@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:50'),(9,'seller',NULL,'Redait Media',NULL,'','rmedia@correo.com',NULL,NULL,NULL,NULL,1,NULL,'','',0,'2021-10-19','2022-10-25 23:50:51');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

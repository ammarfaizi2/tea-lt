-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `tea_lt`;

DROP TABLE IF EXISTS `login_history`;
CREATE TABLE `login_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip_address` (`ip_address`),
  KEY `created_at` (`created_at`),
  FULLTEXT KEY `user_agent` (`user_agent`),
  CONSTRAINT `login_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_520_ci,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `phone` (`phone`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  FULLTEXT KEY `address` (`address`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `piutang`;
CREATE TABLE `piutang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `total` double unsigned NOT NULL,
  `issued_at` datetime DEFAULT NULL,
  `status` enum('Lunas','Belum Lunas') CHARACTER SET latin1 NOT NULL DEFAULT 'Belum Lunas',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `issued_at` (`issued_at`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `total` (`total`),
  KEY `status` (`status`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `transaksi_piutang`;
CREATE TABLE `transaksi_piutang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_utang` bigint(20) unsigned NOT NULL,
  `amount` double unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utang` (`id_utang`),
  KEY `amount` (`amount`),
  KEY `paid_at` (`paid_at`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  FULLTEXT KEY `description` (`description`),
  CONSTRAINT `transaksi_piutang_ibfk_2` FOREIGN KEY (`id_utang`) REFERENCES `piutang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` text CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


-- 2019-03-12 10:45:42

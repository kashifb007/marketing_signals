﻿--
-- Script was generated by Devart dbForge Studio 2020 for MySQL, Version 9.0.391.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 06/11/2020 22:07:36
-- Server version: 5.7.29
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE marketing_signals;

--
-- Drop table `failed_jobs`
--
DROP TABLE IF EXISTS failed_jobs;

--
-- Drop table `migrations`
--
DROP TABLE IF EXISTS migrations;

--
-- Drop table `password_resets`
--
DROP TABLE IF EXISTS password_resets;

--
-- Drop table `users`
--
DROP TABLE IF EXISTS users;

--
-- Drop table `sites`
--
DROP TABLE IF EXISTS sites;

--
-- Drop table `sessions`
--
DROP TABLE IF EXISTS sessions;

--
-- Set default database
--
USE marketing_signals;

--
-- Create table `sessions`
--
CREATE TABLE sessions (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Create table `sites`
--
CREATE TABLE sites (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  uri VARCHAR(1000) NOT NULL,
  title VARCHAR(1000) DEFAULT NULL,
  source_code VARCHAR(255) DEFAULT NULL,
  description VARCHAR(3000) DEFAULT NULL,
  logo VARCHAR(500) DEFAULT NULL,
  notes VARCHAR(1000) DEFAULT NULL,
  decision ENUM('Yes','No','Not Sure') NOT NULL DEFAULT 'Yes',
  status_code SMALLINT(5) UNSIGNED NOT NULL DEFAULT 200,
  session_id BIGINT(20) UNSIGNED NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 4,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Create foreign key
--
ALTER TABLE sites 
  ADD CONSTRAINT sites_session_id_foreign FOREIGN KEY (session_id)
    REFERENCES sessions(id) ON DELETE CASCADE;

--
-- Create table `users`
--
CREATE TABLE users (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Create index `users_email_unique` on table `users`
--
ALTER TABLE users 
  ADD UNIQUE INDEX users_email_unique(email);

--
-- Create table `password_resets`
--
CREATE TABLE password_resets (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Create index `password_resets_email_index` on table `password_resets`
--
ALTER TABLE password_resets 
  ADD INDEX password_resets_email_index(email);

--
-- Create table `migrations`
--
CREATE TABLE migrations (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(255) NOT NULL,
  batch INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 18,
AVG_ROW_LENGTH = 2048,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Create table `failed_jobs`
--
CREATE TABLE failed_jobs (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` TEXT NOT NULL,
  queue TEXT NOT NULL,
  payload LONGTEXT NOT NULL,
  exception LONGTEXT NOT NULL,
  failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

-- 
-- Dumping data for table sessions
--
INSERT INTO sessions VALUES
(1, '2020-11-06 20:29:45', '2020-11-06 20:29:45'),
(2, '2020-11-06 20:47:38', '2020-11-06 20:47:38');

-- 
-- Dumping data for table users
--
-- Table marketing_signals.users does not contain any data (it is empty)

-- 
-- Dumping data for table sites
--
INSERT INTO sites VALUES
(1, 'https://www.bbc.co.uk', NULL, NULL, NULL, NULL, 'test', 'Yes', 200, 1, '2020-11-06 20:29:47', '2020-11-06 20:47:09'),
(2, 'https://www.skysports.com', NULL, NULL, NULL, NULL, 'asdadada', 'Yes', 200, 1, '2020-11-06 20:29:47', '2020-11-06 20:47:26'),
(3, 'https://sadsad', NULL, NULL, NULL, NULL, 'adasd', 'No', 200, 2, '2020-11-06 20:47:38', '2020-11-06 20:50:49');

-- 
-- Dumping data for table password_resets
--
-- Table marketing_signals.password_resets does not contain any data (it is empty)

-- 
-- Dumping data for table migrations
--
INSERT INTO migrations VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2020_11_06_160755_create_sessions_table', 1),
(13, '2020_11_06_160823_create_sites_table', 1),
(14, '2020_11_06_160832_create_session_results_table', 1),
(16, '2020_11_06_200755_create_sessions_table', 2),
(17, '2020_11_06_200823_create_sites_table', 2);

-- 
-- Dumping data for table failed_jobs
--
-- Table marketing_signals.failed_jobs does not contain any data (it is empty)

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
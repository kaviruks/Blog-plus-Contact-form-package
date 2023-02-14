# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.31)
# Database: codegen_cms
# Generation Time: 2023-02-06 06:27:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blog_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_cms_categories_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;

INSERT INTO `blog_categories` (`id`, `parent_id`, `title`, `meta_title`, `slug`, `content`, `created_at`, `updated_at`)
VALUES
        (1,0,'Category 1','Category 1','category-1','Category 1',NULL,NULL),
        (3,1,'Category 2','Category2','Category-2','Category2',NULL,NULL);

/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_post_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_post_categories`;

CREATE TABLE `blog_post_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_blog_categories_post_id_index` (`post_id`),
  KEY `membership_blog_categories_category_id_index` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `blog_post_categories` WRITE;
/*!40000 ALTER TABLE `blog_post_categories` DISABLE KEYS */;

INSERT INTO `blog_post_categories` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`)
VALUES
        (1,1,1,'2022-03-03 18:38:52','2022-03-03 18:38:52');

/*!40000 ALTER TABLE `blog_post_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_post_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_post_comments`;

CREATE TABLE `blog_post_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_blog_comments_post_id_index` (`post_id`),
  KEY `membership_blog_comments_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table blog_post_metas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_post_metas`;

CREATE TABLE `blog_post_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_blog_post_metas_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table blog_post_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_post_tags`;

CREATE TABLE `blog_post_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_blog_tags_post_id_index` (`post_id`),
  KEY `membership_blog_tags_tag_id_index` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `blog_post_tags` WRITE;
/*!40000 ALTER TABLE `blog_post_tags` DISABLE KEYS */;

INSERT INTO `blog_post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`)
VALUES
        (1,1,1,'2022-03-03 18:38:52','2022-03-03 18:38:52'),
        (2,1,3,'2022-03-03 18:38:52','2022-03-03 18:38:52');

/*!40000 ALTER TABLE `blog_post_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_posts`;

CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `published` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_cms_posts_author_id_index` (`author_id`),
  KEY `membership_cms_posts_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;

INSERT INTO `blog_posts` (`id`, `author_id`, `parent_id`, `title`, `meta_title`, `slug`, `summary`, `published`, `content`, `published_at`, `created_at`, `updated_at`)
VALUES
        (1,25,0,'Vehicle Rental Service For House Movers in Colombo','Vehicle Rental Service For House Movers in Colombo','Vehicle-Rental-Service-For-House-Movers-in-Colombo','Vehicle Rental Service For House Movers in Colombo',NULL,'Vehicle Rental Service For House Movers in Colombo','2022-03-04 00:08:52','2022-03-03 18:38:52','2022-03-03 18:38:52');

/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_tags`;

CREATE TABLE `blog_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;

INSERT INTO `blog_tags` (`id`, `title`, `meta_title`, `slug`, `content`, `created_at`, `updated_at`)
VALUES
        (1,'Tag 1','Tag 1','Tag-1','Tag 1',NULL,'2022-03-03 06:14:47'),
        (3,'Tag 2','Tag 2','Tag-2','chchvhvh',NULL,NULL);

/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2024 at 06:58 PM
-- Server version: 5.7.31
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`title`, `content`, `created_at`, `user_id`) VALUES
('Exploring PHP Basics', 'A comprehensive guide to PHP fundamentals.', '2024-11-02 08:00:00', 1),
('Mastering JWT Authentication', 'An in-depth look at using JWTs in API security.', '2024-11-02 09:00:00', 1),
('Top 5 PHP Security Practices', 'Tips for securing PHP applications.', '2024-11-02 10:00:00', 1),
('Building RESTful APIs', 'A tutorial on structuring a RESTful API with PHP.', '2024-11-02 11:00:00', 1),
('Error Handling in PHP', 'Best practices for managing errors in PHP.', '2024-11-02 12:00:00', 1),
('Integrating MySQL with PHP', 'How to work with MySQL databases in PHP.', '2024-11-02 13:00:00', 1),
('PHP and AJAX', 'Using AJAX for asynchronous PHP applications.', '2024-11-02 14:00:00', 1),
('Understanding MVC in PHP', 'A guide to the MVC pattern for PHP developers.', '2024-11-02 15:00:00', 1),
('Working with PDO in PHP', 'An overview of using PDO for database access in PHP.', '2024-11-02 16:00:00', 1),
('Deploying PHP Applications', 'Steps for deploying PHP applications to a web server.', '2024-11-02 17:00:00', 1),

('Introduction to Web Development', 'A beginner-friendly introduction to web development.', '2024-11-02 08:00:00', 2),
('Getting Started with JavaScript', 'Basics of JavaScript programming.', '2024-11-02 09:00:00', 2),
('HTML and CSS Essentials', 'Foundational concepts in HTML and CSS.', '2024-11-02 10:00:00', 2),
('Responsive Web Design', 'Techniques for making websites responsive.', '2024-11-02 11:00:00', 2),
('JavaScript ES6 Features', 'A look at the new features introduced in ES6.', '2024-11-02 12:00:00', 2),
('JavaScript Promises', 'Understanding promises for asynchronous operations.', '2024-11-02 13:00:00', 2),
('CSS Grid Layout', 'How to use CSS Grid for advanced layouts.', '2024-11-02 14:00:00', 2),
('CSS Flexbox Basics', 'Flexbox essentials for modern layouts.', '2024-11-02 15:00:00', 2),
('Advanced JavaScript', 'Topics in advanced JavaScript.', '2024-11-02 16:00:00', 2),
('Web APIs and AJAX', 'Using AJAX to communicate with Web APIs.', '2024-11-02 17:00:00', 2),

('Database Design 101', 'Principles of designing relational databases.', '2024-11-02 08:00:00', 3),
('Introduction to SQL', 'A guide for beginners to learn SQL.', '2024-11-02 09:00:00', 3),
('Advanced SQL Queries', 'Mastering complex SQL queries.', '2024-11-02 10:00:00', 3),
('Database Indexing', 'Improving database performance with indexing.', '2024-11-02 11:00:00', 3),
('Normalization in Databases', 'Understanding the normalization process.', '2024-11-02 12:00:00', 3),
('SQL Joins Explained', 'A guide to SQL joins for data retrieval.', '2024-11-02 13:00:00', 3),
('Optimizing SQL Performance', 'Tips for optimizing SQL performance.', '2024-11-02 14:00:00', 3),
('Stored Procedures in SQL', 'Creating and using stored procedures.', '2024-11-02 15:00:00', 3),
('Managing Database Transactions', 'Ensuring data integrity with transactions.', '2024-11-02 16:00:00', 3),
('Database Backup and Recovery', 'Best practices for database backups.', '2024-11-02 17:00:00', 3),

('Python for Beginners', 'A guide for those starting with Python programming.', '2024-11-02 08:00:00', 4),
('Python and Data Science', 'Using Python for data science applications.', '2024-11-02 09:00:00', 4),
('Web Development with Flask', 'Building web applications with Flask.', '2024-11-02 10:00:00', 4),
('Django for Web Development', 'An introduction to Django for web developers.', '2024-11-02 11:00:00', 4),
('Data Analysis with Pandas', 'Using Pandas for data analysis.', '2024-11-02 12:00:00', 4),
('Machine Learning Basics', 'Getting started with machine learning.', '2024-11-02 13:00:00', 4),
('Data Visualization with Python', 'Creating visualizations with Matplotlib and Seaborn.', '2024-11-02 14:00:00', 4),
('Python and APIs', 'Interacting with APIs in Python.', '2024-11-02 15:00:00', 4),
('Web Scraping with BeautifulSoup', 'Extracting data from websites.', '2024-11-02 16:00:00', 4),
('Advanced Python Techniques', 'Exploring advanced features of Python.', '2024-11-02 17:00:00', 4),

('Understanding Cybersecurity', 'An introduction to cybersecurity.', '2024-11-02 08:00:00', 5),
('Network Security Basics', 'Foundations of network security.', '2024-11-02 09:00:00', 5),
('Cyber Threats and Mitigations', 'Overview of cyber threats and countermeasures.', '2024-11-02 10:00:00', 5),
('Securing Web Applications', 'Best practices for web application security.', '2024-11-02 11:00:00', 5),
('Cryptography Essentials', 'A look at basic cryptography concepts.', '2024-11-02 12:00:00', 5),
('Incident Response Basics', 'How to handle security incidents.', '2024-11-02 13:00:00', 5),
('Introduction to Penetration Testing', 'Basics of penetration testing.', '2024-11-02 14:00:00', 5),
('Using Firewalls Effectively', 'Implementing firewalls for security.', '2024-11-02 15:00:00', 5),
('Data Encryption Techniques', 'Methods for data encryption.', '2024-11-02 16:00:00', 5),
('Security in Cloud Computing', 'Securing data in cloud environments.', '2024-11-02 17:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('john_doe', 'password123'),
('jane_smith', 'securepass'),
('alex_jones', 'mypassword'),
('emily_clark', 'anotherpass'),
('michael_brown', 'strongpass');

COMMIT;

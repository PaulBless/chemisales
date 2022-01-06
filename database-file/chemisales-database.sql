-- AUTHOR DETAILS
-- Name: Paul Eshun
-- Role:  Software Developer
-- Email: eshunbless1@gmail.com
-- Linkedin Profile: https://linkedin.com/in/paul-eshun


-- Description: Database Script for Chemical Shop Sales Management System

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Script Date-Time: Apr 16, 2021 at 02:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `chemisales_db`
-- --------------------------------------------

-- Create Database
CREATE DATABASE IF NOT EXISTS `chemisales_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Select Database 
USE `chemisales_db`;

-- --------------------------------------------------------


-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `tbl_users`(
  `uid` INT(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(10) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_mobileno` varchar(10) NOT NULL,
  `user_loginid` varchar(50) NOT NULL,
  `user_passcode` varchar(255) NOT NULL,
  `user_type` INT(11) NOT NULL,
  `user_status` INT(11) NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  
-- Dump Data Into Table `tbl_users`
INSERT INTO `tbl_users` (`uid`, `user_code`, `user_firstname`, `user_lastname`, `user_mobileno`, `user_loginid`, `user_passcode`, `user_type`, `user_status`, `user_date_created`) VALUES
(NULL, '7895', 'System', 'Admin', '0555428455', 'admin', '$2y$10$sVZcRzUxLaEOXTgGzJ.75uoIdWcJPKGk1jah1x9i1zV9fW977mViu', 1, 2, '2021-10-21 02:22:13');
-- ---------------------------------------------------------


-- Table structure for table `tbl_account`
CREATE TABLE IF NOT EXISTS `tbl_account_status`(
  `asid` INT(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`asid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dump Data in Account_Status table
INSERT INTO `tbl_account_status` 
  (`status_name`, `status_date`) VALUES
  ('Locked', CURRENT_TIMESTAMP),
  ('Active', CURRENT_TIMESTAMP);
-- ------------------------------------------------


-- Table structure for table `tbl_roles`
CREATE TABLE IF NOT EXISTS `tbl_roles`(
  `rid` INT(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `role_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dump Data in Roles table
INSERT INTO `tbl_roles` 
(`role_name`, `role_date`) VALUES
  ('Admin', CURRENT_TIMESTAMP),
  ('Manager', CURRENT_TIMESTAMP),
  ('Attendant', CURRENT_TIMESTAMP);
-- --------------------------------------------


-- Table structure for table `expenses`
CREATE TABLE IF NOT EXISTS `tbl_expenses`(
  `eid` INT(11) NOT NULL AUTO_INCREMENT,
  `expense_id` varchar(10) NOT NULL,
  `expense_details` varchar(2500) NOT NULL,
  `expense_amount` double(10,2) NOT NULL,
  `expense_creator` INT(11) NOT NULL,
  `expense_date` date NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- Table structure for table `purchases`
CREATE TABLE IF NOT EXISTS `tbl_purchases`(
  `pid` INT(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(10) NOT NULL,
  `purchase_details` varchar(2500) NOT NULL,
  `purchase_amount` double(10,2) NOT NULL,
  `purchase_created_by` INT(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- Table structure for table `tbl_generic_names`
CREATE TABLE IF NOT EXISTS `tbl_generic_names`(
  `genericid` INT(11) NOT NULL AUTO_INCREMENT,
  `generic_name` varchar(255) NOT NULL,
  `generic_description` varchar(1000) NOT NULL,
  `generic_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`genericid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table `tbl_generic_names`
INSERT INTO `tbl_generic_names` (`genericid`, `generic_name`, `generic_description`, `generic_date_created`) VALUES
(NULL, 'Blood Tonic', 'Medicines for effective blood circulation', CURRENT_TIMESTAMP),
(NULL, 'Pain Relief', 'Drugs good for all types of body pains', CURRENT_TIMESTAMP),
(NULL, 'Antibiotics', 'Generic name for all antibiotic drugs', CURRENT_TIMESTAMP),
(NULL, 'Immune Booster', 'Recommended medicines for boosting the immune system', CURRENT_TIMESTAMP),
(NULL, 'Anti-malaria', 'Drugs and medicines for malaria treatment', CURRENT_TIMESTAMP);

-- -----------------------------------------------------------------


-- Table structure for table `tbl_medicine_categoriess`
CREATE TABLE IF NOT EXISTS `tbl_medicine_categories`(
  `mcid` INT(11) NOT NULL AUTO_INCREMENT,
  `med_cat_name` varchar(50) NOT NULL,
  `med_cat_comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`mcid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table `tbl_medicine_categories`
INSERT INTO `tbl_medicine_categories` (`mcid`, `med_cat_name`, `med_cat_comment`) VALUES
(NULL, 'Capsules', 'All pills &amp; tablet drugs belongs to this category'),
(NULL, 'Syrup', 'All liquid medicines belongs here'),
(NULL, 'Suppository', 'Medicines that are inserted into the anus'),
(NULL, 'Mixture', 'All types of herbal mixture');

-- -----------------------------------------------------


-- Table structure for table `tbl_medicines`
CREATE TABLE IF NOT EXISTS `tbl_medicines` (
  `mid` INT(11) NOT NULL AUTO_INCREMENT,
  `medicine_code` varchar(20) NOT NULL, -- unique medicineID
  `medicine_name` varchar(500) NOT NULL,
  `medicine_description` varchar(1500) NOT NULL,
  `brand_name` varchar(255) NULL,
  `dosage` varchar(255) NULL,
  `package_size` varchar(255) NULL,
  `cost_price` double(10,2) NOT NULL,
  `selling_price` double(10,2) NOT NULL,
  `medicine_expiry_date` varchar(50) NOT NULL,
  `category_id` INT(11) NOT NULL, -- tbl_medicine_categories id foreign_key
  `generic_id` INT(11) NOT NULL, -- tbl_generic_names id foreign_key
  `manufacture_date` date NULL DEFAULT '2021-10-01', -- medicine manufactured date
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `batch_no` varchar(20) NOT NULL,
  `is_disposed` INT(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------


-- Table structure for table `tbl_stock`
CREATE TABLE IF NOT EXISTS `tbl_stocks`(
  `sid` INT(11) NOT NULL AUTO_INCREMENT,
  `stock_unique_id` varchar(20) NOT NULL,
  `stock_supplier_id` INT(11) NOT NULL,
  `stock_medicine_id` INT(11) NOT NULL,
  `item_quantity` INT(11) NOT NULL,
  `item_total_amount` double(10,2) NOT NULL,
  `stock_total_amount` double(10,2) NOT NULL,
  `stock_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stocked_by` INT(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------


-- Table structure for table `temporary_stock`
CREATE TABLE IF NOT EXISTS `tbl_temporary_stocks`(
  `tsid` INT(11) NOT NULL AUTO_INCREMENT,
  `medicine_id` INT(30) NOT NULL, -- foreign key
  `stock_level` INT(30) NOT NULL,
  PRIMARY KEY (`tsid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------------------------------------


-- Table structure for table `tbl_each_sales`
CREATE TABLE IF NOT EXISTS `tbl_each_sales` (
  `each_sales_id` INT(11) NOT NULL,
  `sales_id_number` varchar(20) NOT NULL,
  `tax_rate` INT(11) NOT NULL,
  `tax_amount` double(10,2) NOT NULL,
  `discount_rate` INT(11) NOT NULL,
  `discount_amount` double(10,2) NOT NULL,
  `sales_subtotal` double(10,2) NOT NULL,
  `sales_total` double(10,2) NOT NULL,
  `sales_seller` INT(11) NOT NULL,
  `amount_paid` double(10,2) NOT NULL,
  `sales_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`each_sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ------------------------------------------------------------


-- Table structure for table `tbl_sales_table`
CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `sales_id` INT(11) NOT NULL AUTO_INCREMENT,
  `sales_id_number` varchar(10) NOT NULL,
  `medicineId` INT(11) NOT NULL,
  `medicineQty` INT(11) NOT NULL,
  `medicinePrice` double(10,2) NOT NULL,
  `medicineTotal` double(10,2) NOT NULL,
  `quantity_type` INT(11) NOT NULL,
  `profit` INT(11) NOT NULL,
    PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- Table structure for table `special_sales`
CREATE TABLE IF NOT EXISTS `tbl_special_sales`(
  `ssid` INT(11) NOT NULL AUTO_INCREMENT,
  `sales_number` varchar(10) NOT NULL,
  `sales_subtotal` double(10,2) NOT NULL,
  `sales_total` double(10,2) NOT NULL,
  `amount_paid` double(10,2) NOT NULL,
  `sales_seller_id` INT(11) NOT NULL,
  `tax_amount` double(10,2) NOT NULL,
  `sales_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sales_id` INT NOT NULL,
  PRIMARY KEY (`ssid`),
  CONSTRAINT fk_sales
  FOREIGN KEY (sales_id) REFERENCES tbl_sales (sales_id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- ---------------------------------------------------


-- Table structure for table `tbl_invoice`
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `invoice_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` INT(11) NOT NULL DEFAULT 0,
  `invoice_number` INT(11) NOT NULL DEFAULT 0,
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` mediumtext DEFAULT NULL,
  `product_quantity` INT(11) DEFAULT 0,
  `product_price` varchar(20) DEFAULT NULL,
  `product_total` varchar(20) DEFAULT NULL,
  `product_subtotal` varchar(20) DEFAULT NULL,
  `product_taxRates` varchar(20) DEFAULT NULL,
  `product_taxAmount` varchar(20) DEFAULT NULL,
  `product_TotalAfterTax` varchar(20) DEFAULT NULL,
  `product_paid` varchar(20) DEFAULT NULL,
  `product_amount_due` varchar(20) DEFAULT NULL,
  `due_date` varchar(50) DEFAULT NULL,
  `quantity_type` varchar(50) NOT NULL,
    PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------------------------------------


-- Table structure for table `tbl_each_invoice`
CREATE TABLE IF NOT EXISTS `tbl_each_invoice` (
  `each_invoice_id` INT(11) NOT NULL AUTO_INCREMENT,
  `related_invoice_id` INT(11) DEFAULT 0,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` mediumtext DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `expiry_date` varchar(60) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tax_rate` INT(11) NOT NULL DEFAULT 0,
  `tax_amount` varchar(50) DEFAULT NULL,
  `discount_rate` INT(11) NOT NULL DEFAULT 0,
  `discount_amount` varchar(50) DEFAULT NULL,
  `sub_total` varchar(50) DEFAULT NULL,
  `invoice_timestamp` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`each_invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------------------------------------------


-- Table structure for table `settings`
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `settings_id` INT(11) NOT NULL AUTO_INCREMENT,
  `settings_option` mediumtext DEFAULT NULL,
  `settings_ans` mediumtext DEFAULT NULL,
    PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `tbl_settings` (`settings_id`, `settings_option`, `settings_ans`) VALUES
(1, 'system_name', 'Jecmas Chemicals'),
(2, 'system_title', 'Chemical Shop Management System'),
(3, 'address', 'Ghana'),
(4, 'contact', '0555428455'),
(5, 'email', 'jecmasghana@gmail.com'),
(6, 'min_quantity_alert', '15'),
(7, 'currency', '$'),
(8, 'expire_alert_limit', '1'),
(9, 'invoice_due', '14'),
(10, 'profile_pic', 'pharmsolv-logo-sm-light.png'),
(11, 'pos_printer', '0'),
(12, 'barcode_scanner', '0');
-- ----------------------------------------------------------------


-- Table structure for `suppliers`
CREATE TABLE `tbl_suppliers` (
  `supplier_id` INT(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_phone` varchar(10) NOT NULL,
  `supplier_email` varchar(155) NOT NULL,
  `supplier_address` mediumtext NOT NULL,
  `supplier_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- -----------------------------------------------------


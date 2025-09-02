-- MySQL Workbench Synchronization
-- Generated: 2025-09-02 01:15
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Sandeep Kumar

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `id` INT(11) NOT NULL,
  `f_name` VARCHAR(45) NULL DEFAULT NULL,
  `l_name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `role_id` INT(11) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_role` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shipper` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `company_name` VARCHAR(45) NULL DEFAULT NULL,
  `representative_address_id` INT(11) NULL DEFAULT NULL,
  `company_address_id` INT(11) NULL DEFAULT NULL,
  `is_verified` TINYINT(4) NULL DEFAULT NULL,
  `is_suspended` TINYINT(4) NULL DEFAULT NULL,
  `program_id` VARCHAR(45) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_dispatch` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `is_active` TINYINT(4) NULL DEFAULT NULL,
  `is_suspended` TINYINT(4) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shipment` (
  `id` INT(11) NOT NULL,
  `shipper_id` INT(11) NULL DEFAULT NULL,
  `orgnode_id` INT(11) NULL DEFAULT NULL,
  `dispatcher_id` INT(11) NULL DEFAULT NULL,
  `title` LONGTEXT NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `from_address_id` INT(11) NULL DEFAULT NULL,
  `to_address_id` INT(11) NULL DEFAULT NULL,
  `calculated_distance` FLOAT(11) NULL DEFAULT NULL,
  `estimated_amount` FLOAT(11) NULL DEFAULT NULL,
  `final_amount` FLOAT(11) NULL DEFAULT NULL,
  `bid_start_date` DATETIME NULL DEFAULT NULL,
  `bid_end_date` DATETIME NULL DEFAULT NULL,
  `status` ENUM("create", "active-bidding", "awarded", "in-transit", "delivered", "invoice-paid", "completed") NULL DEFAULT NULL,
  `load_type` ENUM('FTL', 'LTL') NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_cargo` (
  `id` INT(11) NOT NULL,
  `shipper_id` INT(11) NULL DEFAULT NULL,
  `shipment_id` INT(11) NULL DEFAULT NULL,
  `weight` INT(11) NULL DEFAULT NULL,
  `length` INT(11) NULL DEFAULT NULL,
  `width` INT(11) NULL DEFAULT NULL,
  `height` INT(11) NULL DEFAULT NULL,
  `is_fragile` INT(11) NULL DEFAULT NULL,
  `contents` LONGTEXT NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  `status` ENUM("created", "labels-generated", "pickup-done", "post-pickup-transit", "before-customs", "in-customs", "customs-cleared", "post-custom-transit", "arrived-destination", "awaiting-confirmation", "delivered") NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `pars_code` VARCHAR(45) NULL DEFAULT NULL,
  `ccd_code` VARCHAR(45) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_country` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `iso3_code` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_province` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `iso3_code` CHAR(3) NULL DEFAULT NULL,
  `country_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_carrier` (
  `id` INT(11) NOT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `company_address_id` INT(11) NULL DEFAULT NULL,
  `representative_address_id` INT(11) NULL DEFAULT NULL,
  `is_active` TINYINT(4) NULL DEFAULT NULL,
  `logo_asset_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_carrier_dispatch` (
  `id` INT(11) NOT NULL,
  `carrier_id` VARCHAR(45) NULL DEFAULT NULL,
  `dispatch_id` VARCHAR(45) NULL DEFAULT NULL,
  `is_suspended` TINYINT(4) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shipment_bid` (
  `id` INT(11) NOT NULL,
  `shipment_id` INT(11) NULL DEFAULT NULL,
  `shipper_id` INT(11) NULL DEFAULT NULL,
  `carrier_id` INT(11) NULL DEFAULT NULL,
  `dispatch_id` INT(11) NULL DEFAULT NULL,
  `proposal_text` LONGTEXT NULL DEFAULT NULL,
  `bid_amount` FLOAT(11) NULL DEFAULT NULL,
  `sla_hours` FLOAT(11) NULL DEFAULT NULL,
  `state` ENUM('active', 'retracted', 'expired', 'awarded') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_driver` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `dl_number` VARCHAR(45) NULL DEFAULT NULL,
  `dl_expiry_date` DATETIME NULL DEFAULT NULL,
  `is_canada_pr` TINYINT(4) NULL DEFAULT NULL,
  `is_us_pr` TINYINT(4) NULL DEFAULT NULL,
  `passport_number` VARCHAR(45) NULL DEFAULT NULL,
  `passport_expiry_date` DATETIME NULL DEFAULT NULL,
  `status` ENUM('inactive', 'active', 'suspended') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_document` (
  `id` INT(11) NOT NULL,
  `code` VARCHAR(45) NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_document` (
  `id` INT(11) NOT NULL,
  `filename` VARCHAR(255) NULL DEFAULT NULL,
  `encrypted_filename` VARCHAR(255) NULL DEFAULT NULL,
  `type` ENUM('entity', 'entity_transition') NULL DEFAULT NULL,
  `type_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_entity` (
  `id` INT(11) NOT NULL,
  `code` VARCHAR(255) NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `table` VARCHAR(255) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_metadata` (
  `id` INT(11) NOT NULL,
  `code` VARCHAR(255) NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `mst_entity_id` INT(11) NULL DEFAULT NULL,
  `extranal_id` VARCHAR(45) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`def_entity_transition` (
  `id` INT(11) NOT NULL,
  `entity_id` INT(11) NULL DEFAULT NULL,
  `code` VARCHAR(50) NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `sort_order` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_orgnode` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `_lft` INT(11) NULL DEFAULT NULL,
  `_rgt` INT(11) NULL DEFAULT NULL,
  `depth` INT(11) NULL DEFAULT 0,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`def_entity_role` (
  `id` INT(11) NOT NULL,
  `entity_id` INT(11) NULL DEFAULT NULL,
  `role_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_entity_transition` (
  `id` INT(11) NOT NULL,
  `def_entity_transition_id` INT(11) NULL DEFAULT NULL,
  `entity_id` INT(11) NULL DEFAULT NULL,
  `start_by` INT(11) NULL DEFAULT NULL,
  `start_at` DATETIME NULL DEFAULT NULL,
  `end_by` INT(11) NULL DEFAULT NULL,
  `end_at` DATETIME NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`def_entity_transition_role` (
  `id` INT(11) NOT NULL,
  `def_entity_transition_id` INT(11) NULL DEFAULT NULL,
  `role_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_line_item` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `_lft` INT(11) NULL DEFAULT NULL,
  `_rgt` INT(11) NULL DEFAULT NULL,
  `depth` INT(11) NULL DEFAULT 0,
  `price` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_expense` (
  `id` INT(11) NOT NULL,
  `shipment_id` INT(11) NULL DEFAULT NULL,
  `driver_id` INT(11) NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `subtotal` FLOAT(11) NULL DEFAULT NULL,
  `total` FLOAT(11) NULL DEFAULT NULL,
  `status` ENUM('pending', 'approved', 'refused') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_trip` (
  `id` INT(11) NOT NULL,
  `driver_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_trip_pickup_drop` (
  `id` INT(11) NOT NULL,
  `trip_id` INT(11) NULL DEFAULT NULL,
  `type` ENUM('pickup', 'drop') NULL DEFAULT NULL,
  `cargo_id` INT(11) NULL DEFAULT NULL,
  `ship_address_id` INT(11) NULL DEFAULT NULL,
  `representative_address_id` INT(11) NULL DEFAULT NULL,
  `status` ENUM('pending', 'completed') NULL DEFAULT NULL,
  `sort_order` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_trip_logbook` (
  `id` INT(11) NOT NULL,
  `trip_id` INT(11) NULL DEFAULT NULL,
  `driver_id` INT(11) NULL DEFAULT NULL,
  `start_at` DATETIME NULL DEFAULT NULL,
  `end_at` DATETIME NULL DEFAULT NULL,
  `reason_stop` ENUM('break', 'fuel', 'delivered') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_payroll_item` (
  `id` INT(11) NOT NULL,
  `payroll_id` INT(11) NULL DEFAULT NULL,
  `driver_id` INT(11) NULL DEFAULT NULL,
  `type` ENUM('shipment', 'expense', 'damage') NULL DEFAULT NULL,
  `type_id` INT(11) NULL DEFAULT NULL,
  `amount` FLOAT(11) NULL DEFAULT NULL,
  `processed_on` DATETIME NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_payroll` (
  `id` INT(11) NOT NULL,
  `driver_id` VARCHAR(45) NULL DEFAULT NULL,
  `start_at` DATETIME NULL DEFAULT NULL,
  `end_at` DATETIME NULL DEFAULT NULL,
  `status` ENUM('pending', 'approved', 'cancelled') NULL DEFAULT NULL,
  `subtotal` FLOAT(11) NULL DEFAULT NULL,
  `total` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_trip_damage` (
  `id` INT(11) NOT NULL,
  `trip_id` INT(11) NULL DEFAULT NULL,
  `driver_id` INT(11) NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `status` ENUM('pending', 'accepted', 'penalty') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shop` (
  `id` INT(11) NOT NULL,
  `shop_name` VARCHAR(45) NULL DEFAULT NULL,
  `shop_address_id` INT(11) NULL DEFAULT NULL,
  `representative_address_id` INT(11) NULL DEFAULT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `_lft` INT(11) NULL DEFAULT NULL,
  `_rgt` INT(11) NULL DEFAULT NULL,
  `depth` INT(11) NULL DEFAULT 0,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shop_job` (
  `id` INT(11) NOT NULL,
  `truck_id` INT(11) NULL DEFAULT NULL,
  `type` ENUM('servicing', 'damage') NULL DEFAULT NULL,
  `subtotal` FLOAT(11) NULL DEFAULT NULL,
  `total` FLOAT(11) NULL DEFAULT NULL,
  `start_at` DATETIME NULL DEFAULT NULL,
  `start_by` INT(11) NULL DEFAULT NULL,
  `return_at` DATETIME NULL DEFAULT NULL,
  `return_by` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shop_job_item` (
  `id` INT(11) NOT NULL,
  `shop_job_id` INT(11) NULL DEFAULT NULL,
  `mst_line_item_id` INT(11) NULL DEFAULT NULL,
  `amount` FLOAT(11) NULL DEFAULT NULL,
  `qty` INT(11) NULL DEFAULT NULL,
  `start_at` DATETIME NULL DEFAULT NULL,
  `start_by` INT(11) NULL DEFAULT NULL,
  `end_at` DATETIME NULL DEFAULT NULL,
  `end_by` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_shop_job_inspection` (
  `id` INT(11) NOT NULL,
  `shop_job_id` INT(11) NULL DEFAULT NULL,
  `inspected_at` DATETIME NULL DEFAULT NULL,
  `inspection_by` INT(11) NULL DEFAULT NULL,
  `result` ENUM('ok', 'not ok') NULL DEFAULT NULL,
  `status` ENUM('pending', 'completed', 'cancelled') NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_messaging` (
  `id` INT(11) NOT NULL,
  `from_role` INT(11) NULL DEFAULT NULL,
  `from_role_id` INT(11) NULL DEFAULT NULL,
  `to_role` INT(11) NULL DEFAULT NULL,
  `to_role_id` INT(11) NULL DEFAULT NULL,
  `sent_at` DATETIME NULL DEFAULT NULL,
  `read_by` INT(11) NULL DEFAULT NULL,
  `read_at` DATETIME NULL DEFAULT NULL,
  `message` LONGTEXT NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_truck` (
  `id` INT(11) NOT NULL,
  `carrier_id` INT(11) NULL DEFAULT NULL,
  `vin` VARCHAR(45) NULL DEFAULT NULL,
  `number_plate` VARCHAR(45) NULL DEFAULT NULL,
  `registered_at` DATETIME NULL DEFAULT NULL,
  `total_km` FLOAT(11) NULL DEFAULT NULL,
  `status` ENUM('pending-registration', 'in-service', 'in-shop', 'retured', 'suspended') NULL DEFAULT NULL,
  `towing_capacity_kg` FLOAT(11) NULL DEFAULT NULL,
  `length` FLOAT(11) NULL DEFAULT NULL,
  `width` FLOAT(11) NULL DEFAULT NULL,
  `height` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_truck_maintenence` (
  `id` INT(11) NOT NULL,
  `mst_line_item` INT(11) NULL DEFAULT NULL,
  `schedule_days` INT(11) NULL DEFAULT NULL,
  `schedule_km` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_truck_maintenence` (
  `id` INT(11) NOT NULL,
  `mst_truck_maintenance_id` INT(11) NULL DEFAULT NULL,
  `truck_id` INT(11) NULL DEFAULT NULL,
  `shop_id` INT(11) NULL DEFAULT NULL,
  `subtotal` FLOAT(11) NULL DEFAULT NULL,
  `total` FLOAT(11) NULL DEFAULT NULL,
  `status` ENUM('pending', 'in-progress', 'inspection', 'completed', 'cancelled') NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_mechanic` (
  `id` INT(11) NOT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `shop_id` INT(11) NULL DEFAULT NULL,
  `status` ENUM('pending', 'active', 'retured', 'suspended') NULL DEFAULT NULL,
  `start_date` DATETIME NULL DEFAULT NULL,
  `last_date` DATETIME NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_event` (
  `id` INT(11) NOT NULL,
  `event_name` VARCHAR(45) NULL DEFAULT NULL,
  `event_code` VARCHAR(45) NULL DEFAULT NULL,
  `roles` VARCHAR(45) NULL DEFAULT NULL,
  `email_template_id` INT(11) NULL DEFAULT NULL,
  `sms_template_id` INT(11) NULL DEFAULT NULL,
  `send_email` TINYINT(4) NULL DEFAULT NULL,
  `send_sms` TINYINT(4) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_email_template` (
  `id` INT(11) NOT NULL,
  `subject_line` LONGTEXT NULL DEFAULT NULL,
  `subject_params` LONGTEXT NULL DEFAULT NULL,
  `body_text` LONGTEXT NULL DEFAULT NULL,
  `body_params` LONGTEXT NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_sms_template` (
  `id` INT(11) NOT NULL,
  `sms_body_text` LONGTEXT NULL DEFAULT NULL,
  `sms_body_params` LONGTEXT NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_email` (
  `id` INT(11) NOT NULL,
  `email_template_id` INT(11) NULL DEFAULT NULL,
  `subject` LONGTEXT NULL DEFAULT NULL,
  `body` LONGTEXT NULL DEFAULT NULL,
  `attachments` LONGTEXT NULL DEFAULT NULL,
  `status` ENUM('pending', 'sent', 'failed') NULL DEFAULT NULL,
  `try_counter` INT(11) NULL DEFAULT NULL,
  `context` LONGTEXT NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_sms` (
  `id` INT(11) NOT NULL,
  `sms_template_id` INT(11) NULL DEFAULT NULL,
  `sms_body` LONGTEXT NULL DEFAULT NULL,
  `context` LONGTEXT NULL DEFAULT NULL,
  `status` ENUM('pending', 'sent', 'failed') NULL DEFAULT NULL,
  `try_counter` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_order` (
  `id` INT(11) NOT NULL,
  `type` ENUM('shipment', 'expense', 'shop') NULL DEFAULT NULL,
  `from_id` INT(11) NULL DEFAULT NULL,
  `to_id` INT(11) NULL DEFAULT NULL,
  `trans_id` INT(11) NULL DEFAULT NULL,
  `subtotal` FLOAT(11) NULL DEFAULT NULL,
  `total` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_trans` (
  `id` INT(11) NOT NULL,
  `order_id` INT(11) NULL DEFAULT NULL,
  `amount` FLOAT(11) NULL DEFAULT NULL,
  `uniqie_id` VARCHAR(45) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_expense_item` (
  `id` INT(11) NOT NULL,
  `expense_id` INT(11) NULL DEFAULT NULL,
  `mst_line_item_id` INT(11) NULL DEFAULT NULL,
  `price` FLOAT(11) NULL DEFAULT NULL,
  `qty` INT(11) NULL DEFAULT NULL,
  `composite_price` FLOAT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_order_item` (
  `id` INT(11) NOT NULL,
  `order_id` INT(11) NULL DEFAULT NULL,
  `entity_id` INT(11) NULL DEFAULT NULL,
  `price` FLOAT(11) NULL DEFAULT NULL,
  `qty` INT(11) NULL DEFAULT NULL,
  `composite_price` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`mst_program` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `code` VARCHAR(45) NULL DEFAULT NULL,
  `company_address_id` INT(11) NULL DEFAULT NULL,
  `representative_address_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_address` (
  `id` INT(11) NOT NULL,
  `f_name` VARCHAR(45) NULL DEFAULT NULL,
  `l_name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `alt_email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `alt_phone` VARCHAR(45) NULL DEFAULT NULL,
  `addr1` VARCHAR(45) NULL DEFAULT NULL,
  `addr2` VARCHAR(45) NULL DEFAULT NULL,
  `postal_zip` VARCHAR(45) NULL DEFAULT NULL,
  `province_state_id` INT(11) NULL DEFAULT NULL,
  `country_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_metadata` (
  `id` INT(11) NOT NULL,
  `metadata_id` INT(11) NULL DEFAULT NULL,
  `entity_id` INT(11) NULL DEFAULT NULL,
  `value` VARCHAR(255) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_truck_maintenance_item` (
  `id` INT(11) NOT NULL,
  `truck_maintenance_id` INT(11) NULL DEFAULT NULL,
  `mst_line_item_id` INT(11) NULL DEFAULT NULL,
  `price` FLOAT(11) NULL DEFAULT NULL,
  `qty` FLOAT(11) NULL DEFAULT NULL,
  `composite_price` FLOAT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_asset` (
  `id` INT(11) NOT NULL,
  `content_type` VARCHAR(45) NULL DEFAULT NULL,
  `filename` VARCHAR(255) NULL DEFAULT NULL,
  `encrypted_filename` VARCHAR(255) NULL DEFAULT NULL,
  `is_sensitive` TINYINT(4) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_ship_address` (
  `id` INT(11) NOT NULL,
  `f_name` VARCHAR(45) NULL DEFAULT NULL,
  `l_name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `alt_email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `alt_phone` VARCHAR(45) NULL DEFAULT NULL,
  `addr1` VARCHAR(45) NULL DEFAULT NULL,
  `addr2` VARCHAR(45) NULL DEFAULT NULL,
  `postal_zip` VARCHAR(45) NULL DEFAULT NULL,
  `province_state_id` INT(11) NULL DEFAULT NULL,
  `country_id` INT(11) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `notes` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_truck_tracking` (
  `id` INT(11) NOT NULL,
  `truck_id` INT(11) NULL DEFAULT NULL,
  `lat` VARCHAR(45) NULL DEFAULT NULL,
  `lng` VARCHAR(45) NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

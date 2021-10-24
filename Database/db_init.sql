/*
-- Database initilization

-- Host: 127.0.0.1 [localhost]
-- Database: pmsdb
-- User: PMS
-- Password: pmspwd

-- Create Database: `pmsdb`
CREATE DATABASE pmsdb;

----------------------------------------------------------
-- Create user and grant all permissions
CREATE USER 'PMS'@'localhost' IDENTIFIED BY 'pmspwd';
GRANT ALL PRIVILEGES ON * . * TO 'PMS'@'localhost';

----------------------------------------------------------
-- For running DB_INIT, use below command
mysql -h localhost -u PMS -p pmsdb < db_init.sql

*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*-- Create required tables in the database*/

CREATE TABLE `staffMembers` (
  `StaffId`       int(10)       NOT NULL  AUTO_INCREMENT  UNIQUE,
  `Name`          varchar(120)  NOT NULL,
  `UserName`      varchar(50)   NOT NULL  UNIQUE,
  `MobileNumber`  bigint(10)    NOT NULL,
  `Gender`        varchar(120)  NOT NULL,
  `Email`         varchar(120)  NOT NULL  UNIQUE,
  `Password`      varchar(120)  NOT NULL,
  `DOB`           date          NOT NULL,
  `RegDate`       date,
  `IsAdmin`       boolean       NOT NULL  DEFAULT FALSE,
  PRIMARY KEY (`StaffId`)
)ENGINE=InnoDB;

CREATE TABLE `ticket` (
  `TicketId`        int(10)       NOT NULL      AUTO_INCREMENT  UNIQUE,
  `Name`            varchar(120)  NOT NULL,
  `MobileNumber`    bigint(10)    NOT NULL,
  `Email`           varchar(120)  NOT NULL,
  `NoOfAdult`       int(10)       DEFAULT NULL,
  `NoOfChildren`    int(10)       DEFAULT NULL,
  `IsCamera`        boolean       NOT NULL      DEFAULT FALSE,
  `Date`            date,
  `AdultTicketRate` int(50),
  `ChildTicketRate` int(50),
  `CameraCarryRate` int(50),
  `AmountPayable`   int(50),
  `StaffId`         int(10)       NOT NULL,
  PRIMARY KEY (`TicketId`)
)ENGINE=InnoDB;

CREATE TABLE `bestEmployee` (
  `StaffId`         int(10)       NOT NULL,
  `DateOfAddition`  date,
  PRIMARY KEY (`StaffId`)
)ENGINE=InnoDB;

CREATE TABLE `staffPerformance` (
  `StaffId`         int(10)       NOT NULL,
  `NoOfTicket`      int(10)       DEFAULT 0,
  `Rating`          int(10)       DEFAULT 0,
  PRIMARY KEY (`StaffId`)
)ENGINE=InnoDB;

CREATE TABLE `feePerUnit` (
  `AdultTicketRate` int(50),
  `ChildTicketRate` int(50),
  `CameraCarryRate` int(50)   DEFAULT '50'
)ENGINE=InnoDB;

/*-- Add essential data to tables*/

INSERT INTO `staffMembers` 
  (`StaffId`, `Name`, `UserName`, `MobileNumber`, `Email`, `Gender`, `Password`, `DOB`, `RegDate`, `IsAdmin`) VALUES
  (1, 'Admin', 'admin', 8989898989, 'admin@gmail.com', 'male', 'admin', '1990-12-30','2019-12-30', TRUE);

INSERT INTO `staffPerformance` 
  (`StaffId`, `NoOfTicket`, `Rating`) VALUES
  (1, 0, 0);

INSERT INTO `feePerUnit` 
  (`AdultTicketRate`, `ChildTicketRate`, `CameraCarryRate`) VALUES
  (50, 20, 50);

COMMIT;
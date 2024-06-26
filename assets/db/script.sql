﻿

-- Create tables section -------------------------------------------------

-- Table Student

CREATE TABLE `Student`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `first_name` Char(25) NOT NULL,
  `last_name` Char(25) NOT NULL,
  `year` Int(1) NOT NULL,
  `section` Char(1) NOT NULL,
  `roll_number` Char(30) NOT NULL,
  `password` Char(100) NOT NULL,
  `password_key` Char(100) NOT NULL,
  `mobile_number` Char(15) NOT NULL,
  `semester` Int(2) NOT NULL,
  `department` Char(30) NOT NULL,
  `profile_picture` Blob,
  `course_code` Int NOT NULL,
  `group_code` Int NOT NULL,
  PRIMARY KEY (`code`)
)
;

-- Table course

CREATE TABLE `course`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `name` Char(20) NOT NULL,
  PRIMARY KEY (`code`)
)
;

-- Table student_group

CREATE TABLE `student_group`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `email_id` Char(50) NOT NULL,
  `number_of_student` Int(1) NOT NULL,
  `faculty_code` Int NOT NULL,
  PRIMARY KEY (`code`)
)
;

-- Table student_group_verification

CREATE TABLE `student_group_verification`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `status` Char(1) NOT NULL,
  `group_code` Int NOT NULL,
  PRIMARY KEY (`code`)
)
;

-- Table student_file

CREATE TABLE `student_file`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `file` Text NOT NULL,
  `comment` Varchar(400),
  `title` Char(20) NOT NULL,
  `date_of_creation` Date NOT NULL,
  `time_of_creation` Time NOT NULL,
  `group_code` Int NOT NULL,
  PRIMARY KEY (`code`)
)
;

-- Table faculty

CREATE TABLE `faculty`
(
  `code` Int NOT NULL AUTO_INCREMENT,
  `first_name` Char(25) NOT NULL,
  `last_name` Char(25) NOT NULL,
  `email_id` Char(30) NOT NULL,
  `password` Char(100) NOT NULL,
  `password_key` Char(100) NOT NULL,
  `image` Blob,
  `group_code` Int,
  PRIMARY KEY (`code`)
)
;

-- Table faculty_approval

CREATE TABLE `faculty_approval`
(
  `code` Int NOT NULL,
  `is_approved` Char(1) NOT NULL,
  `comment` Varchar(300) NOT NULL,
  `date_of_creation` Date NOT NULL,
  `time_of_creation` Time NOT NULL,
  `faculty_code` Int NOT NULL,
  `student_group_code` Int NOT NULL
)
;

ALTER TABLE `faculty_approval` ADD PRIMARY KEY (`code`)
;

-- Create foreign keys (relationships) section ------------------------------------------------- 


ALTER TABLE `Student` ADD CONSTRAINT `course_relationship` FOREIGN KEY (`course_code`) REFERENCES `course` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `Student` ADD CONSTRAINT `group_relationship` FOREIGN KEY (`group_code`) REFERENCES `student_group` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `student_file` ADD CONSTRAINT `student_file_relationship` FOREIGN KEY (`group_code`) REFERENCES `student_group` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `faculty` ADD CONSTRAINT `faculty_student_group_relationship` FOREIGN KEY (`group_code`) REFERENCES `student_group` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `faculty_approval` ADD CONSTRAINT `faculty_approval_relationship` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `faculty_approval` ADD CONSTRAINT `faculty_approval_relationship2` FOREIGN KEY (`student_group_code`) REFERENCES `student_group` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `student_group` ADD CONSTRAINT `group_relationship2` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


ALTER TABLE `student_group_verification` ADD CONSTRAINT `group_verification_relationship` FOREIGN KEY (`group_code`) REFERENCES `student_group` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT
;



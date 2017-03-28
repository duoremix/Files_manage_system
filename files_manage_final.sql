/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : files_manage

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-03-25 10:42:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fm_account_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_account_info`;
CREATE TABLE `fm_account_info` (
  `id` int(11) NOT NULL DEFAULT '0',
  `account_name` varchar(50) DEFAULT NULL,
  `use_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_account_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_account_project`
-- ----------------------------
DROP TABLE IF EXISTS `fm_account_project`;
CREATE TABLE `fm_account_project` (
  `id` int(11) NOT NULL DEFAULT '0',
  `account_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_unit` varchar(10) DEFAULT NULL,
  `project_type` varchar(10) DEFAULT NULL,
  `project_money` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_account_project
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_attendence_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_attendence_info`;
CREATE TABLE `fm_attendence_info` (
  `id` int(10) NOT NULL,
  `fm_num` varchar(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `employee` varchar(50) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `attendence_status` varchar(10) NOT NULL,
  `attendence_reason` varchar(50) NOT NULL,
  `attendence_start_date` varchar(20) NOT NULL,
  `attendence_end_date` varchar(20) NOT NULL,
  `manage_person` varchar(50) NOT NULL,
  `manage_date` varchar(20) NOT NULL,
  `attendence_content` longtext NOT NULL,
  `check_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_attendence_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_attendence_type`
-- ----------------------------
DROP TABLE IF EXISTS `fm_attendence_type`;
CREATE TABLE `fm_attendence_type` (
  `id` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_attendence_type
-- ----------------------------
INSERT INTO `fm_attendence_type` VALUES ('1', '迟到');
INSERT INTO `fm_attendence_type` VALUES ('2', '缺勤');
INSERT INTO `fm_attendence_type` VALUES ('3', '请假');

-- ----------------------------
-- Table structure for `fm_date_record`
-- ----------------------------
DROP TABLE IF EXISTS `fm_date_record`;
CREATE TABLE `fm_date_record` (
  `id` int(10) NOT NULL DEFAULT '0',
  `date` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_date_record
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_department`
-- ----------------------------
DROP TABLE IF EXISTS `fm_department`;
CREATE TABLE `fm_department` (
  `id` int(10) NOT NULL,
  `department` varchar(50) NOT NULL DEFAULT '',
  `superior_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_department
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_duty_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_duty_info`;
CREATE TABLE `fm_duty_info` (
  `id` int(10) NOT NULL,
  `fm_num` varchar(20) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_department` varchar(50) NOT NULL,
  `emp_job` varchar(50) NOT NULL,
  `emp_entry_date` varchar(20) NOT NULL,
  `emp_use_form` varchar(10) NOT NULL,
  `emp_exit_date` varchar(20) NOT NULL,
  `emp_exit_reason` varchar(20) NOT NULL,
  `emp_cont_start` varchar(20) NOT NULL,
  `emp_cont_end` varchar(20) NOT NULL,
  `emp_full_date` varchar(20) NOT NULL,
  `emp_full_age` varchar(20) NOT NULL,
  `emp_bank_name` varchar(50) NOT NULL,
  `emp_sociaty_insu` varchar(50) NOT NULL,
  `emp_lostjob_insu` varchar(50) NOT NULL,
  `emp_old_insu` varchar(50) NOT NULL,
  `emp_bank_num` varchar(50) NOT NULL,
  `emp_medical_insu` varchar(50) NOT NULL,
  `emp_hurt_insu` varchar(50) NOT NULL,
  `emp_resevered_fund` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_duty_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_folk_type`
-- ----------------------------
DROP TABLE IF EXISTS `fm_folk_type`;
CREATE TABLE `fm_folk_type` (
  `id` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_folk_type
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_native_type`
-- ----------------------------
DROP TABLE IF EXISTS `fm_native_type`;
CREATE TABLE `fm_native_type` (
  `id` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_native_type
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_personal_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_personal_info`;
CREATE TABLE `fm_personal_info` (
  `id` int(10) NOT NULL,
  `fm_num` varchar(20) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_sex` varchar(10) NOT NULL,
  `emp_borndate` varchar(20) NOT NULL,
  `emp_folk` varchar(30) NOT NULL,
  `emp_native` varchar(30) NOT NULL,
  `emp_idnum` varchar(50) NOT NULL,
  `emp_edu` varchar(10) NOT NULL,
  `emp_gra_school` varchar(50) NOT NULL,
  `emp_gra_date` varchar(20) NOT NULL,
  `emp_politics` varchar(10) NOT NULL,
  `emp_marriage` varchar(10) NOT NULL,
  `emp_postcode` varchar(10) NOT NULL,
  `emp_phone` varchar(30) NOT NULL,
  `emp_qq` varchar(20) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_addr` varchar(255) NOT NULL,
  `have_photo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_personal_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_project_person`
-- ----------------------------
DROP TABLE IF EXISTS `fm_project_person`;
CREATE TABLE `fm_project_person` (
  `id` int(10) NOT NULL,
  `account_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `count` int(10) NOT NULL,
  `update_time` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_project_person
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_rnp_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_rnp_info`;
CREATE TABLE `fm_rnp_info` (
  `id` int(10) NOT NULL DEFAULT '0',
  `fm_num` varchar(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `employee` varchar(50) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `rnp_status` varchar(10) NOT NULL,
  `rnp_reason` varchar(50) NOT NULL,
  `rnp_type` varchar(10) DEFAULT NULL,
  `rnp_money` float(10,2) NOT NULL,
  `rnp_date` varchar(20) NOT NULL,
  `manage_person` varchar(50) NOT NULL,
  `manage_date` varchar(20) NOT NULL,
  `rnp_content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_rnp_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_salary`
-- ----------------------------
DROP TABLE IF EXISTS `fm_salary`;
CREATE TABLE `fm_salary` (
  `id` int(10) NOT NULL DEFAULT '0',
  `salary` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_salary
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_train_info`
-- ----------------------------
DROP TABLE IF EXISTS `fm_train_info`;
CREATE TABLE `fm_train_info` (
  `id` int(10) NOT NULL,
  `fm_num` varchar(20) NOT NULL,
  `train_name` varchar(30) NOT NULL,
  `train_content` varchar(255) NOT NULL,
  `train_employee` varchar(255) NOT NULL,
  `train_start_date` varchar(20) NOT NULL,
  `train_end_date` varchar(20) NOT NULL,
  `train_unit` varchar(20) DEFAULT NULL,
  `train_lecture` varchar(50) NOT NULL,
  `train_place` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_train_info
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_train_person`
-- ----------------------------
DROP TABLE IF EXISTS `fm_train_person`;
CREATE TABLE `fm_train_person` (
  `id` int(10) NOT NULL,
  `train_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_train_person
-- ----------------------------

-- ----------------------------
-- Table structure for `fm_user`
-- ----------------------------
DROP TABLE IF EXISTS `fm_user`;
CREATE TABLE `fm_user` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_user
-- ----------------------------
INSERT INTO `fm_user` VALUES ('1', 'duo', 'e10adc3949ba59abbe56e057f20f883e', '超级管理员');
INSERT INTO `fm_user` VALUES ('2', 'duo1', 'e10adc3949ba59abbe56e057f20f883e', '普通用户');
INSERT INTO `fm_user` VALUES ('3', 'duo2', 'caf1a3dfb505ffed0d024130f58c5cfa', '超级管理员');
INSERT INTO `fm_user` VALUES ('4', '张三-1', '202cb962ac59075b964b07152d234b70', '普通用户');
INSERT INTO `fm_user` VALUES ('5', '王大锤-2', '202cb962ac59075b964b07152d234b70', '普通用户');
INSERT INTO `fm_user` VALUES ('6', '李四-4', 'e10adc3949ba59abbe56e057f20f883e', '普通用户');
INSERT INTO `fm_user` VALUES ('7', '让-7', 'e10adc3949ba59abbe56e057f20f883e', '普通用户');
INSERT INTO `fm_user` VALUES ('8', '王五-8', 'e10adc3949ba59abbe56e057f20f883e', '普通用户');

-- ----------------------------
-- Table structure for `fm_use_form`
-- ----------------------------
DROP TABLE IF EXISTS `fm_use_form`;
CREATE TABLE `fm_use_form` (
  `id` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_use_form
-- ----------------------------
INSERT INTO `fm_use_form` VALUES ('1', '全职');
INSERT INTO `fm_use_form` VALUES ('2', '兼职');
INSERT INTO `fm_use_form` VALUES ('3', '临时工');
INSERT INTO `fm_use_form` VALUES ('4', '实习');

/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.37-MariaDB : Database - optic_v2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`optic_v2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `optic_v2`;

/*Table structure for table `ambiance` */

DROP TABLE IF EXISTS `ambiance`;

CREATE TABLE `ambiance` (
  `ambiance_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ambiance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `antecedent_disease` */

DROP TABLE IF EXISTS `antecedent_disease`;

CREATE TABLE `antecedent_disease` (
  `antecedent_disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_id` int(11) NOT NULL,
  `visual_antecedent_id` int(11) NOT NULL,
  PRIMARY KEY (`antecedent_disease_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `consulation_fs` */

DROP TABLE IF EXISTS `consulation_fs`;

CREATE TABLE `consulation_fs` (
  `consulation_fs_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_consultation_id` int(11) NOT NULL,
  `function_sign_id` int(11) NOT NULL,
  PRIMARY KEY (`consulation_fs_id`),
  KEY `reason_consultation_id` (`reason_consultation_id`,`function_sign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `consultation_vp` */

DROP TABLE IF EXISTS `consultation_vp`;

CREATE TABLE `consultation_vp` (
  `consultation_vp_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_consultation_id` int(11) DEFAULT NULL,
  `visual_problem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`consultation_vp_id`),
  KEY `reason_consultation_id` (`reason_consultation_id`,`visual_problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `control` */

DROP TABLE IF EXISTS `control`;

CREATE TABLE `control` (
  `control_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`control_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `disease` */

DROP TABLE IF EXISTS `disease`;

CREATE TABLE `disease` (
  `disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`disease_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `functional_sign` */

DROP TABLE IF EXISTS `functional_sign`;

CREATE TABLE `functional_sign` (
  `functional_sign_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`functional_sign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `patient_info` */

DROP TABLE IF EXISTS `patient_info`;

CREATE TABLE `patient_info` (
  `patient_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `genderId` int(11) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `referred` varchar(255) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patient_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `reason_consultation` */

DROP TABLE IF EXISTS `reason_consultation`;

CREATE TABLE `reason_consultation` (
  `reason_consultation_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) DEFAULT NULL,
  `date_appearance` date DEFAULT NULL,
  `characterstics_appearance` text,
  `time_appearance` varchar(255) DEFAULT NULL,
  `frequency_troubles` varchar(255) DEFAULT NULL,
  `activity_context` varchar(255) DEFAULT NULL,
  `associated_symptoms` varchar(255) DEFAULT NULL,
  `chronicity` varchar(255) DEFAULT NULL,
  `evolution` varchar(255) DEFAULT NULL,
  `factors_relief` varchar(255) DEFAULT NULL,
  `compensation_worm_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reason_consultation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ref_contact` */

DROP TABLE IF EXISTS `ref_contact`;

CREATE TABLE `ref_contact` (
  `ref_eyeglasses_id` int(11) NOT NULL AUTO_INCREMENT,
  `refraction_history_id` int(11) DEFAULT NULL,
  `sphere_od` varchar(15) DEFAULT NULL,
  `sphere_os` varchar(15) DEFAULT NULL,
  `cylinder_od` varchar(15) DEFAULT NULL,
  `cylinder_os` varchar(15) DEFAULT NULL,
  `axis_od` varchar(15) DEFAULT NULL,
  `axis_os` varchar(15) DEFAULT NULL,
  `wear_type_id` int(11) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `dk` varchar(255) DEFAULT NULL,
  `solution` varchar(255) DEFAULT NULL,
  `reason_is_preferred` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ref_eyeglasses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ref_eyeglasses` */

DROP TABLE IF EXISTS `ref_eyeglasses`;

CREATE TABLE `ref_eyeglasses` (
  `ref_eyeglasses_id` int(11) NOT NULL AUTO_INCREMENT,
  `refraction_history_id` int(11) DEFAULT NULL,
  `sphere_od` varchar(15) DEFAULT NULL,
  `sphere_os` varchar(15) DEFAULT NULL,
  `cylinder_od` varchar(15) DEFAULT NULL,
  `cylinder_os` varchar(15) DEFAULT NULL,
  `axis_od` varchar(15) DEFAULT NULL,
  `axis_os` varchar(15) DEFAULT NULL,
  `addition` varchar(20) DEFAULT NULL,
  `pd_od` varchar(15) DEFAULT NULL,
  `pd_os` varchar(15) DEFAULT NULL,
  `prism_od` varchar(15) DEFAULT NULL,
  `prism_os` varchar(15) DEFAULT NULL,
  `base_od` varchar(15) DEFAULT NULL,
  `base_os` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ref_eyeglasses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `refraction_history` */

DROP TABLE IF EXISTS `refraction_history`;

CREATE TABLE `refraction_history` (
  `refraction_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `date_last_exam` date DEFAULT NULL,
  `correction_type_id` int(11) DEFAULT NULL,
  `satisfaction` float DEFAULT NULL,
  `wearing_frequency` varchar(255) DEFAULT NULL,
  `reason_correction` varchar(255) DEFAULT NULL,
  `exam_details` text,
  PRIMARY KEY (`refraction_history_id`),
  KEY `visit_id` (`visit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `type_correction` */

DROP TABLE IF EXISTS `type_correction`;

CREATE TABLE `type_correction` (
  `type_correction_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_correction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `visual_antecedent` */

DROP TABLE IF EXISTS `visual_antecedent`;

CREATE TABLE `visual_antecedent` (
  `visual_antecedent_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `ocular_pathologies` varchar(255) DEFAULT NULL,
  `ocular_surgeries` varchar(255) DEFAULT NULL,
  `traumatism` varchar(255) DEFAULT NULL,
  `orthoptic_treatments` varchar(255) DEFAULT NULL,
  `mediciation_intake_id` int(11) DEFAULT NULL,
  `medication_intake_other` varchar(255) DEFAULT NULL,
  `familial_refractive` varchar(255) DEFAULT NULL,
  `herecity_diseases` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`visual_antecedent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `visual_need` */

DROP TABLE IF EXISTS `visual_need`;

CREATE TABLE `visual_need` (
  `visual_need_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) DEFAULT NULL,
  `is_far` int(1) DEFAULT NULL,
  `is_near` int(1) DEFAULT NULL,
  `is_partially` int(1) DEFAULT NULL,
  `is_fully` int(1) DEFAULT NULL,
  `task_duration` varchar(255) DEFAULT NULL,
  `work_distance` varchar(255) DEFAULT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `lighting` varchar(255) DEFAULT NULL,
  `is_need_color` int(1) DEFAULT NULL,
  `ambiance_id` int(11) DEFAULT NULL,
  `ambiance_other` varchar(255) DEFAULT NULL,
  `is_trauma_risk` int(11) DEFAULT NULL,
  `description` text,
  `extra_proffession_activity` text,
  PRIMARY KEY (`visual_need_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `visual_problem` */

DROP TABLE IF EXISTS `visual_problem`;

CREATE TABLE `visual_problem` (
  `visual_problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`visual_problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wear_type` */

DROP TABLE IF EXISTS `wear_type`;

CREATE TABLE `wear_type` (
  `wear_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wear_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `work_station` */

DROP TABLE IF EXISTS `work_station`;

CREATE TABLE `work_station` (
  `work_station_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`work_station_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

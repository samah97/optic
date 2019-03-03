-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2019 at 10:20 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optic_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambiance`
--

CREATE TABLE `ambiance` (
  `ambiance_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `antecedent_disease`
--

CREATE TABLE `antecedent_disease` (
  `antecedent_disease_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `visual_antecedent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consulation_fs`
--

CREATE TABLE `consulation_fs` (
  `consulation_fs_id` int(11) NOT NULL,
  `reason_consultation_id` int(11) NOT NULL,
  `function_sign_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consultation_vp`
--

CREATE TABLE `consultation_vp` (
  `consultation_vp_id` int(11) NOT NULL,
  `reason_consultation_id` int(11) DEFAULT NULL,
  `visual_problem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE `control` (
  `control_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`control_id`, `title`) VALUES
(1, 'Controlling a previous prescription'),
(2, 'Seeking other alternatives'),
(3, 'First checkup');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `disease_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`disease_id`, `title`) VALUES
(1, 'Diabetes'),
(2, 'Pregnancy'),
(3, 'Endocrinal problems'),
(4, 'Allergy'),
(5, 'Arterial hypertension'),
(6, 'Cholesterol'),
(7, 'Cardiac problems'),
(8, 'Triglycerides');

-- --------------------------------------------------------

--
-- Table structure for table `functional_sign`
--

CREATE TABLE `functional_sign` (
  `functional_sign_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `functional_sign`
--

INSERT INTO `functional_sign` (`functional_sign_id`, `title`) VALUES
(1, 'Eyelids squinting'),
(2, 'Vertigo / Dizziness'),
(3, 'Ocular pain'),
(4, 'Eyelids blinking'),
(5, 'Blepharospasm'),
(6, 'Halos and lights'),
(7, 'Dazzling, Photophobia'),
(8, 'Vitreous floaters'),
(9, 'Loss of the visual field'),
(10, 'Sleepiness while reading'),
(11, 'Phosphenes'),
(12, 'Fixation problems'),
(13, 'Tearing'),
(14, 'Veil sensation'),
(15, 'Ocular redness'),
(16, 'Conjunctival or palpebral irritations'),
(17, 'Metamorphopsia'),
(18, 'Micropsia'),
(19, 'Headaches');

-- --------------------------------------------------------

--
-- Table structure for table `medication_intake`
--

CREATE TABLE `medication_intake` (
  `medication_intake_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medication_intake`
--

INSERT INTO `medication_intake` (`medication_intake_id`, `title`) VALUES
(1, 'Corticoids'),
(2, 'Quinine'),
(3, 'Contraception');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `patient_info_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `genderId` int(11) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `referred` varchar(255) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reason_consultation`
--

CREATE TABLE `reason_consultation` (
  `reason_consultation_id` int(11) NOT NULL,
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
  `compensation_worm_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `refraction_history`
--

CREATE TABLE `refraction_history` (
  `refraction_history_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `date_last_exam` date DEFAULT NULL,
  `correction_type_id` int(11) DEFAULT NULL,
  `satisfaction` float DEFAULT NULL,
  `wearing_frequency` varchar(255) DEFAULT NULL,
  `reason_correction` varchar(255) DEFAULT NULL,
  `exam_details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_contact`
--

CREATE TABLE `ref_contact` (
  `ref_eyeglasses_id` int(11) NOT NULL,
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
  `reason_is_preferred` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_eyeglasses`
--

CREATE TABLE `ref_eyeglasses` (
  `ref_eyeglasses_id` int(11) NOT NULL,
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
  `base_os` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type_correction`
--

CREATE TABLE `type_correction` (
  `type_correction_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_correction`
--

INSERT INTO `type_correction` (`type_correction_id`, `title`) VALUES
(1, 'Eyeglasses'),
(2, 'Contact lenses');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `userName` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `session` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstname`, `lastname`, `userName`, `password`, `session`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', '202cb962ac59075b964b07152d234b70', '8pcvhoqe2h8d919mj8p8qrt9pb');

-- --------------------------------------------------------

--
-- Table structure for table `visual_antecedent`
--

CREATE TABLE `visual_antecedent` (
  `visual_antecedent_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `ocular_pathologies` varchar(255) DEFAULT NULL,
  `ocular_surgeries` varchar(255) DEFAULT NULL,
  `traumatism` varchar(255) DEFAULT NULL,
  `orthoptic_treatments` varchar(255) DEFAULT NULL,
  `mediciation_intake_id` int(11) DEFAULT NULL,
  `medication_intake_other` varchar(255) DEFAULT NULL,
  `familial_refractive` varchar(255) DEFAULT NULL,
  `herecity_diseases` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visual_need`
--

CREATE TABLE `visual_need` (
  `visual_need_id` int(11) NOT NULL,
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
  `extra_proffession_activity` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visual_problem`
--

CREATE TABLE `visual_problem` (
  `visual_problem_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visual_problem`
--

INSERT INTO `visual_problem` (`visual_problem_id`, `title`) VALUES
(1, 'Blurred vision'),
(2, 'Far'),
(3, 'Near'),
(4, 'Monocular'),
(5, 'Binocular'),
(6, 'Double vision'),
(7, 'With fixation problems'),
(8, 'Problems of fixation and problems'),
(9, 'Visual field problems'),
(10, 'Acquired color vision problems'),
(11, 'Phoria and tropia problems');

-- --------------------------------------------------------

--
-- Table structure for table `wear_type`
--

CREATE TABLE `wear_type` (
  `wear_type_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wear_type`
--

INSERT INTO `wear_type` (`wear_type_id`, `title`) VALUES
(1, 'Daily'),
(2, 'Monthly Wear'),
(3, 'Extended Wear');

-- --------------------------------------------------------

--
-- Table structure for table `work_station`
--

CREATE TABLE `work_station` (
  `work_station_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_station`
--

INSERT INTO `work_station` (`work_station_id`, `title`) VALUES
(1, 'Seated'),
(2, 'Standing'),
(3, 'PC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambiance`
--
ALTER TABLE `ambiance`
  ADD PRIMARY KEY (`ambiance_id`);

--
-- Indexes for table `antecedent_disease`
--
ALTER TABLE `antecedent_disease`
  ADD PRIMARY KEY (`antecedent_disease_id`);

--
-- Indexes for table `consulation_fs`
--
ALTER TABLE `consulation_fs`
  ADD PRIMARY KEY (`consulation_fs_id`),
  ADD KEY `reason_consultation_id` (`reason_consultation_id`,`function_sign_id`);

--
-- Indexes for table `consultation_vp`
--
ALTER TABLE `consultation_vp`
  ADD PRIMARY KEY (`consultation_vp_id`),
  ADD KEY `reason_consultation_id` (`reason_consultation_id`,`visual_problem_id`);

--
-- Indexes for table `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`control_id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `functional_sign`
--
ALTER TABLE `functional_sign`
  ADD PRIMARY KEY (`functional_sign_id`);

--
-- Indexes for table `medication_intake`
--
ALTER TABLE `medication_intake`
  ADD PRIMARY KEY (`medication_intake_id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`patient_info_id`);

--
-- Indexes for table `reason_consultation`
--
ALTER TABLE `reason_consultation`
  ADD PRIMARY KEY (`reason_consultation_id`);

--
-- Indexes for table `refraction_history`
--
ALTER TABLE `refraction_history`
  ADD PRIMARY KEY (`refraction_history_id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `ref_contact`
--
ALTER TABLE `ref_contact`
  ADD PRIMARY KEY (`ref_eyeglasses_id`);

--
-- Indexes for table `ref_eyeglasses`
--
ALTER TABLE `ref_eyeglasses`
  ADD PRIMARY KEY (`ref_eyeglasses_id`);

--
-- Indexes for table `type_correction`
--
ALTER TABLE `type_correction`
  ADD PRIMARY KEY (`type_correction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `visual_antecedent`
--
ALTER TABLE `visual_antecedent`
  ADD PRIMARY KEY (`visual_antecedent_id`);

--
-- Indexes for table `visual_need`
--
ALTER TABLE `visual_need`
  ADD PRIMARY KEY (`visual_need_id`);

--
-- Indexes for table `visual_problem`
--
ALTER TABLE `visual_problem`
  ADD PRIMARY KEY (`visual_problem_id`);

--
-- Indexes for table `wear_type`
--
ALTER TABLE `wear_type`
  ADD PRIMARY KEY (`wear_type_id`);

--
-- Indexes for table `work_station`
--
ALTER TABLE `work_station`
  ADD PRIMARY KEY (`work_station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambiance`
--
ALTER TABLE `ambiance`
  MODIFY `ambiance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `antecedent_disease`
--
ALTER TABLE `antecedent_disease`
  MODIFY `antecedent_disease_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consulation_fs`
--
ALTER TABLE `consulation_fs`
  MODIFY `consulation_fs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultation_vp`
--
ALTER TABLE `consultation_vp`
  MODIFY `consultation_vp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `control`
--
ALTER TABLE `control`
  MODIFY `control_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `functional_sign`
--
ALTER TABLE `functional_sign`
  MODIFY `functional_sign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `medication_intake`
--
ALTER TABLE `medication_intake`
  MODIFY `medication_intake_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `patient_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reason_consultation`
--
ALTER TABLE `reason_consultation`
  MODIFY `reason_consultation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refraction_history`
--
ALTER TABLE `refraction_history`
  MODIFY `refraction_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_contact`
--
ALTER TABLE `ref_contact`
  MODIFY `ref_eyeglasses_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_eyeglasses`
--
ALTER TABLE `ref_eyeglasses`
  MODIFY `ref_eyeglasses_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_correction`
--
ALTER TABLE `type_correction`
  MODIFY `type_correction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visual_antecedent`
--
ALTER TABLE `visual_antecedent`
  MODIFY `visual_antecedent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_need`
--
ALTER TABLE `visual_need`
  MODIFY `visual_need_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_problem`
--
ALTER TABLE `visual_problem`
  MODIFY `visual_problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wear_type`
--
ALTER TABLE `wear_type`
  MODIFY `wear_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_station`
--
ALTER TABLE `work_station`
  MODIFY `work_station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

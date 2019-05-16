-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 07:27 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `result`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classes` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(32) DEFAULT NULL,
  `course_name` varchar(80) DEFAULT NULL,
  `credit_unit` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `credit_unit`) VALUES
(2, 'COM211', 'COMPUTER PROGRAMMING USING OOVB', '4'),
(3, 'COM212', 'INTRODUCTION TO SYSTEM PROGRAMMI', '4'),
(4, 'COM213', 'COMMERCIAL PROGRAMMING LANGUAGE ', '4'),
(5, 'COM214', 'FILE ORGANIZATION AND MANAGEMENT', '3'),
(6, 'COM215', 'COMPUTER PACKAGES II', '4'),
(7, 'COM216', 'COMPUTER SYSTEM TROUBLESHOOTING ', '4'),
(8, 'GNS201', 'USE OF ENGLISH II', '2'),
(9, 'GNS218', 'RESEARCH METHODOLOGY', '2'),
(10, 'GNS216', 'ENTREPRENEURSHIP DEVELOPMENT', '3'),
(11, 'COM217', 'SIWES', '4'),
(12, 'COM218', 'OFFICE ICT MANAGEMENT', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cummulative`
--

CREATE TABLE IF NOT EXISTS `cummulative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(32) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `course` varchar(60) DEFAULT NULL,
  `total_gps` double(11,0) DEFAULT NULL,
  `total_cus` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cummulative`
--

INSERT INTO `cummulative` (`id`, `reg_no`, `code`, `course`, `total_gps`, `total_cus`) VALUES
(1, '2013/ND/CPS/001', 'COM213', 'COMMERCIAL PROGRAMMING LANGUAGE ', 10, 4),
(2, '2013/ND/CPS/001', 'GNS201', 'USE OF ENGLISH II', 8, 2),
(3, '2013/ND/CPS/010', 'COM211', 'COMPUTER PROGRAMMING USING OOVB', 10, 4),
(4, '2013/ND/CPS/010', 'COM215', 'COMPUTER PACKAGES II', 14, 4),
(5, '2013/ND/CPS/003', 'COM213', 'COMMERCIAL PROGRAMMING LANGUAGE ', 12, 4),
(6, '2013/ND/CPS/003', 'COM217', 'SIWES', 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cummulative2`
--

CREATE TABLE IF NOT EXISTS `cummulative2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `total_gps` double(11,0) DEFAULT NULL,
  `total_cus` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `first_semester`
--

CREATE TABLE IF NOT EXISTS `first_semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(32) DEFAULT NULL,
  `semester` varchar(32) DEFAULT NULL,
  `session` varchar(32) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `course` varchar(60) DEFAULT NULL,
  `cu` int(11) DEFAULT NULL,
  `gp` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `first_semester`
--

INSERT INTO `first_semester` (`id`, `reg_no`, `semester`, `session`, `code`, `course`, `cu`, `gp`) VALUES
(1, '2013/ND/CPS/001', '1ST SEMESTER', '2013/2014', 'COM213', 'COMMERCIAL PROGRAMMING LANGUAGE ', 4, 10),
(2, '2013/ND/CPS/001', '1ST SEMESTER', '2013/2014', 'GNS201', 'USE OF ENGLISH II', 2, 8),
(3, '2013/ND/CPS/010', '1ST SEMESTER', '2013/2014', 'COM211', 'COMPUTER PROGRAMMING USING OOVB', 4, 10),
(4, '2013/ND/CPS/010', '1ST SEMESTER', '2013/2014', 'COM215', 'COMPUTER PACKAGES II', 4, 14),
(5, '2013/ND/CPS/003', '1ST SEMESTER', '2013/2014', 'COM213', 'COMMERCIAL PROGRAMMING LANGUAGE ', 4, 12),
(6, '2013/ND/CPS/003', '1ST SEMESTER', '2013/2014', 'COM217', 'SIWES', 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE IF NOT EXISTS `grading` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gfrom` varchar(11) DEFAULT NULL,
  `gto` varchar(11) DEFAULT NULL,
  `grade` varchar(11) DEFAULT NULL,
  `grade_value` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `grading`
--

INSERT INTO `grading` (`id`, `gfrom`, `gto`, `grade`, `grade_value`) VALUES
(12, '0', '9', 'F', '0.0'),
(13, '10', '19', 'F', '0.5'),
(14, '20', '29', 'F', '1.0'),
(15, '30', '39', 'F', '1.5'),
(16, '40', '49', 'P', '2.0'),
(17, '50', '59', 'C', '2.5'),
(18, '60', '69', 'C', '3.0'),
(19, '70', '79', 'B', '3.5'),
(20, '80', '100', 'A', '4.0');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lecturer` varchar(60) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `lecturer`, `username`, `password`) VALUES
(1, 'OWONUBI JOB SUNDAY', 'JOBIC10', 'JOBIC10'),
(2, 'HASHEER MOHAMMED JAMIU', 'HASHJAY', 'HASHJAY'),
(3, 'ABDULLAHI MUTALIB OZOVEHE', 'MUTALIB', 'MUTALIB');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(35) DEFAULT NULL,
  `semester` varchar(35) DEFAULT NULL,
  `session` varchar(35) DEFAULT NULL,
  `course_code` varchar(30) DEFAULT NULL,
  `cu` int(11) DEFAULT NULL,
  `course_name` varchar(35) DEFAULT NULL,
  `scores` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `reg_no`, `semester`, `session`, `course_code`, `cu`, `course_name`, `scores`) VALUES
(1, '2013/ND/CPS/001', '1ST SEMESTER', '2013/2014', 'COM213', 4, 'COMMERCIAL PROGRAMMING LANGUAGE ', 50),
(2, '2013/ND/CPS/001', '1ST SEMESTER', '2013/2014', 'GNS201', 2, 'USE OF ENGLISH II', 80),
(3, '2013/ND/CPS/010', '1ST SEMESTER', '2013/2014', 'COM211', 4, 'COMPUTER PROGRAMMING USING OOVB', 55),
(4, '2013/ND/CPS/010', '1ST SEMESTER', '2013/2014', 'COM215', 4, 'COMPUTER PACKAGES II', 77),
(5, '2013/ND/CPS/003', '1ST SEMESTER', '2013/2014', 'COM213', 4, 'COMMERCIAL PROGRAMMING LANGUAGE ', 66),
(6, '2013/ND/CPS/003', '1ST SEMESTER', '2013/2014', 'COM217', 4, 'SIWES', 79);

--
-- Triggers `scores`
--
DROP TRIGGER IF EXISTS `create_result`;
DELIMITER //
CREATE TRIGGER `create_result` AFTER INSERT ON `scores`
 FOR EACH ROW BEGIN

DECLARE which_semester VARCHAR(32);
DECLARE which_session VARCHAR(32);
DECLARE course_cod VARCHAR(32);
DECLARE courses VARCHAR(60);
DECLARE cus DOUBLE;
DECLARE course_scores DOUBLE;
DECLARE graded_value DOUBLE;
DECLARE grade_point DOUBLE;
DECLARE course_flag INT;
DECLARE cumm_gp DOUBLE;
DECLARE cumm_cu DOUBLE;
DECLARE updated_gp DOUBLE;
DECLARE updated_cus DOUBLE;
DECLARE regno VARCHAR(32);

SET regno = NEW.reg_no;
SET which_semester = NEW.semester;
SET which_session = NEW.session;
SET course_cod = NEW.course_code;
SET courses= NEW.course_name;
SET cus =NEW.cu;
SET course_scores =NEW.scores;
SET graded_value =0;
SET grade_point =0;
SET cumm_gp=0;
SET updated_cus=0;

IF which_semester='4TH SEMESTER' THEN

      SET graded_value=(SELECT grade_value FROM grading WHERE gfrom<=course_scores AND gto>=course_scores);
             IF graded_value>0 THEN
                SET  grade_point=graded_value*cus;
                    INSERT INTO fourth_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             ELSE
                SET  grade_point=0*cus;
                    INSERT INTO fourth_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             END IF;

     SET course_flag=(SELECT COUNT(code)  FROM cummulative2 WHERE code = course_cod AND reg_no=regno);
           IF course_flag>0 THEN
              SET cumm_gp=(SELECT total_gps FROM cummulative2 WHERE code = course_cod  AND reg_no=regno);
              SET cumm_cu=(SELECT total_cus FROM cummulative2 WHERE code = course_cod  AND reg_no=regno);
              SET updated_gp= cumm_gp+grade_point;
              SET updated_cus= cumm_cu+cus;
              UPDATE cummulative2 SET total_gps= updated_gp,total_cus=updated_cus WHERE code= course_cod  AND reg_no=regno;
          ELSE
              INSERT INTO cummulative2 (reg_no,code,course,total_gps,total_cus) VALUES(regno,course_cod,courses,grade_point,cus);
          END IF; 

ELSEIF which_semester='3RD SEMESTER' THEN

      SET graded_value=(SELECT grade_value FROM grading WHERE gfrom<=course_scores AND gto>=course_scores);
             IF graded_value>0 THEN
                SET  grade_point=graded_value*cus;
                    INSERT INTO third_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             ELSE
                SET  grade_point=0*cus;
                    INSERT INTO third_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             END IF;

     SET course_flag=(SELECT COUNT(code)  FROM cummulative2 WHERE code = course_cod AND reg_no=regno);
           IF course_flag>0 THEN
              SET cumm_gp=(SELECT total_gps FROM cummulative2 WHERE code = course_cod  AND reg_no=regno);
              SET cumm_cu=(SELECT total_cus FROM cummulative2 WHERE code = course_cod  AND reg_no=regno);
              SET updated_gp= cumm_gp+grade_point;
              SET updated_cus= cumm_cu+cus;
              UPDATE cummulative2 SET total_gps= updated_gp,total_cus=updated_cus WHERE code= course_cod  AND reg_no=regno;
          ELSE
              INSERT INTO cummulative2 (reg_no,code,course,total_gps,total_cus) VALUES(regno,course_cod,courses,grade_point,cus);
          END IF; 

ELSEIF which_semester='1ST SEMESTER' THEN

      SET graded_value=(SELECT grade_value FROM grading WHERE gfrom<=course_scores AND gto>=course_scores);
             IF graded_value>0 THEN
                SET  grade_point=graded_value*cus;
                    INSERT INTO first_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             ELSE
                SET  grade_point=0*cus;
                    INSERT INTO first_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             END IF;

     SET course_flag=(SELECT COUNT(code)  FROM cummulative WHERE code = course_cod AND reg_no=regno);
           IF course_flag>0 THEN
              SET cumm_gp=(SELECT total_gps FROM cummulative WHERE code = course_cod  AND reg_no=regno);
              SET cumm_cu=(SELECT total_cus FROM cummulative WHERE code = course_cod  AND reg_no=regno);
              SET updated_gp= cumm_gp+grade_point;
              SET updated_cus= cumm_cu+cus;
              UPDATE cummulative SET total_gps= updated_gp,total_cus=updated_cus WHERE code= course_cod  AND reg_no=regno;
          ELSE
              INSERT INTO cummulative (reg_no,code,course,total_gps,total_cus) VALUES(regno,course_cod,courses,grade_point,cus);
          END IF; 

ELSEIF which_semester='2ND SEMESTER' THEN

      SET graded_value=(SELECT grade_value FROM grading WHERE gfrom<=course_scores AND gto>=course_scores);
             IF graded_value>0 THEN
                SET  grade_point=graded_value*cus;
                    INSERT INTO second_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             ELSE
                SET  grade_point=0*cus;
                    INSERT INTO second_semester (reg_no,semester,session,code,course,cu,gp) VALUES(regno,which_semester,which_session,course_cod,courses,cus,grade_point);
             END IF;

     SET course_flag=(SELECT COUNT(code)  FROM cummulative WHERE code = course_cod  AND reg_no=regno);
           IF course_flag>0 THEN
              SET cumm_gp=(SELECT total_gps FROM cummulative WHERE code = course_cod  AND reg_no=regno);
              SET cumm_cu=(SELECT total_cus FROM cummulative WHERE code = course_cod  AND reg_no=regno);
              SET updated_gp= cumm_gp+grade_point;
              SET updated_cus= cumm_cu+cus;
              UPDATE cummulative SET total_gps= updated_gp,total_cus=updated_cus WHERE code= course_cod  AND reg_no=regno;
          ELSE
              INSERT INTO cummulative (reg_no,code,course,total_gps,total_cus) VALUES(regno,course_cod,courses,grade_point,cus);
          END IF; 
       
END IF;






END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `second_semester`
--

CREATE TABLE IF NOT EXISTS `second_semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(32) DEFAULT NULL,
  `semester` varchar(32) DEFAULT NULL,
  `session` varchar(32) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `course` varchar(60) DEFAULT NULL,
  `cu` int(11) DEFAULT NULL,
  `gp` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`) VALUES
(1, '2013/2014'),
(2, '2014/2015'),
(3, '2015/2016');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(32) DEFAULT NULL,
  `reg_no` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `reg_no`) VALUES
(1, 'OWONUBI JOB SUNDAY', '2013/ND/CPS/001'),
(3, 'YAKUBU HALIMAT OHARACHI', '2013/ND/CPS/002'),
(4, 'SULAIMAN BUKOLA LAMI', '2013/ND/CPS/003'),
(5, 'OHIEKU IPEMIDA MICHAEL', '2013/ND/CPS/004'),
(6, 'OKWOLI SOLOMON', '2013/ND/CPS/005'),
(7, 'AJASEGUN BOLUWATIFE', '2013/ND/CPS/006'),
(8, 'ALEMIDE MARY SIMISOLA', '2013/ND/CPS/007'),
(9, 'USMAN YAHAYA', '2013/ND/CPS/008'),
(10, 'DAUDA RUKAYAT', '2013/ND/CPS/009'),
(11, 'INEMO GRACE NDIDI', '2013/ND/CPS/010'),
(12, 'EBIRTANMI H. TAIWO', '2013/ND/CPS/011'),
(13, 'UNDEFINED UNDEFINED', '2013/ND/CPS/012'),
(14, 'ADELEYE JOHN ODUNAYO', '2013/ND/CPS/013'),
(15, 'YUSUF SARAH ', '2013/ND/CPS/014'),
(16, 'SADIQ ABDULRAHAMAN', '2013/ND/CPS/015'),
(17, 'SULEIMAN ABDULLATEEF', '2013/ND/CPS/016'),
(18, 'ABDULAZEEZ UMULQULSUM', '2013/ND/CPS/017'),
(19, 'FASIKU FOLASHADE JULIET', '2013/ND/CPS/018'),
(20, 'UNDEFINED UNDEFINED', '2013/ND/CPS/019'),
(21, 'AUDU OZIOHU IMUHERI', '2013/ND/CPS/020'),
(22, 'OLORUNTOBA KENNETH', '2013/ND/CPS/021'),
(23, 'ATIBAKA AUGUSTINE', '2013/ND/CPS/022'),
(24, 'OMEIZA MUHAMMED AWWAL', '2013/ND/CPS/023'),
(25, 'SAMUEL STELLA OZOZOMA', '2013/ND/CPS/024'),
(26, 'JOSEPH OSIBINAFOREBA', '2013/ND/CPS/025'),
(27, 'ABUBAKAR BAZMA', '2013/ND/CPS/026'),
(28, 'ONOJA JOSEPH ELEOJO FRIDAY', '2013/ND/CPS/027'),
(29, 'UNDEFINED UNDEFINED', '2013/ND/CPS/028'),
(30, 'UNDEFINED UNDEFINED', '2013/ND/CPS/029'),
(31, 'ABDULLAHI HAWAKULU', '2013/ND/CPS/030'),
(32, 'ODAWN BLESSING', '2013/ND/CPS/031'),
(33, 'AHMED OREVA FAITH', '2013/ND/CPS/032'),
(34, 'MUHAMMED HASIYAT', '2013/ND/CPS/033'),
(35, 'JATTO NAFISAT ANAMOH', '2013/ND/CPS/034'),
(36, 'ABDULRAHAMAN NAFISAT', '2013/ND/CPS/035'),
(37, 'OLUSEGUN MOBAYODE FELIX', '2013/ND/CPS/036'),
(38, 'ABDULRAHMAN KABIRU', '2013/ND/CPS/037'),
(39, 'OLAREWAJU SUNDAY OPEYEMI', '2013/ND/CPS/038'),
(40, 'JERRY JOHN ARIYO', '2013/ND/CPS/039'),
(41, 'ABUBAKAR SADIYA', '2013/ND/CPS/040'),
(42, 'EMMANUEL BUKOLA SHADE', '2013/ND/CPS/041'),
(43, 'UNDEFINED UNDEFINED', '2013/ND/CPS/042'),
(44, 'BABA AROME', '2013/ND/CPS/043'),
(45, 'ABDULAZEEZ SAFIYAH', '2013/ND/CPS/044'),
(46, 'AHIABA UFEDO', '2013/ND/CPS/045'),
(47, 'OGALA RAYMOND', '2013/ND/CPS/046'),
(48, 'OTOKITI MARIAM OYIZA', '2013/ND/CPS/047'),
(49, 'FALILAT OYIZA', '2013/ND/CPS/048'),
(50, 'ISMAILA ABDULMUMINI OZOVEHE', '2013/ND/CPS/049'),
(51, 'UNDEFINED UNDEFINED', '2013/ND/CPS/050'),
(52, 'OSASONA TUNBOSUN', '2013/ND/CPS/051'),
(53, 'AKUMA UKAMAKA', '2013/ND/CPS/052'),
(54, 'ISIAKA AHMED FATIMA', '2013/ND/CPS/053'),
(55, 'ISMAILA AHMED TIJANI', '2013/ND/CPS/054'),
(56, 'AKURE SINMISAYO', '2013/ND/CPS/056'),
(57, 'AWULU DEBORAH', '2013/ND/CPS/057'),
(58, 'AMEH JOSEPH DOMINIC', '2013/ND/CPS/058'),
(59, 'ABU ALICE AINO', '2013/ND/CPS/059'),
(60, 'BELLO BLESSING', '2013/ND/CPS/060'),
(61, 'TAJUDEEN SAHEED ADEKUNLE', '2013/ND/CPS/061'),
(62, 'EMMANUEL YOMI DAVID', '2013/ND/CPS/062'),
(63, 'SALIFU ACHENYO', '2013/ND/CPS/063'),
(64, 'AKINDE OLUWASEUN PETER', '2013/ND/CPS/065'),
(65, 'MOHAMMED DANLADI', '2013/ND/CPS/066'),
(66, 'HASHEER MOHAMMED JAMIU', '2013/ND/CPS/068'),
(67, 'EHINMORO VINCENT OLUWATOSIN', '2013/ND/CPS/069'),
(68, 'OLORUNNADO OLUFUNKE E.', '2013/ND/CPS/070'),
(69, 'AYORINDE AYOKUNLE JOHN', '2013/ND/CPS/071'),
(70, 'ISHAQ HABIBAT OYAMINE', '2013/ND/CPS/072'),
(71, 'AMINU GRACE', '2013/ND/CPS/073'),
(72, 'SADIQ HALIMA OYIZA', '2013/ND/CPS/074'),
(73, 'USMAN ABDULFATAH', '2013/ND/CPS/075'),
(74, 'IBRAHIM BONGI UMAR', '2013/ND/CPS/076'),
(75, 'BELLO OLUWASEGUN HASSAN', '2013/ND/CPS/077'),
(76, 'ZUBAIR NAFISAT OHUNENE', '2013/ND/CPS/078'),
(77, 'MUHAMMED KABIRU OKINO', '2013/ND/CPS/079'),
(78, 'ALFA SAIDU', '2013/ND/CPS/080'),
(79, 'IBRAHIM SADIYA', '2013/ND/CPS/081'),
(80, 'YAHAYA TIJANI', '2013/ND/CPS/082'),
(81, 'ADESOJI KEHINDE ADEYINKA', '2013/ND/CPS/083'),
(82, 'IBRAHIM OKATAHI NASIRU', '2013/ND/CPS/085'),
(83, 'BELLO RACHAEL OMETERE', '2013/ND/CPS/086'),
(84, 'LARIETU YUSUF IKO-OJO', '2013/ND/CPS/088'),
(85, 'SULEIMAN MUHAMMED JAMIU', '2013/ND/CPS/089'),
(86, 'OMODAMORI RODAH', '2013/ND/CPS/091'),
(87, 'AKIBU KAUSARA', '2013/ND/CPS/092'),
(88, 'ABDULKAREEM AMINAT.O', '2013/ND/CPS/093'),
(89, 'MUSA BALIKISU', '2013/ND/CPS/095'),
(91, 'AGBO ABDULMUMIN', '2013/ND/CPS/096'),
(92, 'AMUDA GIDEON PRAISE', '2013/ND/CPS/097'),
(93, 'SOLOMON BOSEDE HANNAH', '2013/ND/CPS/098'),
(96, 'MEJIDA GRACE', '2013/ND/CPS/099'),
(97, 'DASUMA FRIDAY WISDOM', '2013/ND/CPS/100'),
(98, 'ABUBAKAR OJODALE BILYAMIN', '2013/ND/CPS/101'),
(99, 'SULEIMAN YUSUF.T.', '2013/ND/CPS/102'),
(100, 'OCHIJENU ODOMA STEPHEN', '2013/ND/CPS/103'),
(101, 'EMMANUEL LUCKY', '2013/ND/CPS/104'),
(102, 'GBAIYEGUN SUNDAY', '2013/ND/CPS/105'),
(103, 'ZAKARI ZAINAB', '2013/ND/CPS/106'),
(104, 'EGBUNU ENEMALI JOSEPH', '2013/ND/CPS/108'),
(105, 'ISMAILA ONOROYIZA ABDULHSKIM', '2013/ND/CPS/109'),
(106, 'MAMMAN TAKADA ABUBAKAR', '2013/ND/CPS/110'),
(107, 'ADEBUKOLA BABATUNDE', '2013/ND/CPS/111'),
(108, 'LAMIDI ABDULAZEEZ ISAAC', '2013/ND/CPS/114'),
(109, 'ISMAILA ABDULLAHI', '2013/ND/CPS/116'),
(110, 'SAEED ABUBAKAR OZOVEHE', '2013/ND/CPS/117'),
(111, 'SUNDAY UFAYO DANIEL', '2013/ND/CPS/118'),
(112, 'MAHMOUD QUEEN AMINA', '2013/ND/CPS/119'),
(113, 'ADEMU MUHAMMED', '2013/ND/CPS/120'),
(114, 'TIJANI AMINA SADIQ', '2013/ND/CPS/122'),
(115, 'USMAN LUKMAN', '2013/ND/CPS/123'),
(116, 'ABDULSALAMI KHADIJAT OCHUR', '2013/ND/CPS/124'),
(117, 'ARO ABIODUN', '2013/ND/CPS/125'),
(118, 'MUHAMMED RASHIDAT TAIWO', '2013/ND/CPS/126'),
(119, 'YUSUF MARIAM', '2013/ND/CPS/127'),
(120, 'EGENE WISDOM OJONE', '2013/ND/CPS/128'),
(121, 'ABDULLAHI AMINAT', '2013/ND/CPS/129'),
(122, 'MOMOH AMOTO PAUL', '2013/ND/CPS/130'),
(123, 'ISMAILA.O.MUHAMMED', '2013/ND/CPS/131'),
(124, 'USMAN MARIAM PATRICIA', '2013/ND/CPS/132'),
(125, 'ABDULLAHI KEHINDE', '2013/ND/CPS/133'),
(126, 'HARUNA HABEEB ISELEWA', '2013/ND/CPS/134'),
(127, 'ISMAILA NASIRU OMUYA', '2013/ND/CPS/135'),
(128, 'DUROTOLA OLORUNFEMI JOSHUA', '2013/ND/CPS/137'),
(129, 'ABDULLAHI TAIWO', '2013/ND/CPS/138'),
(130, 'UNYA PRECIOUS OLUCHI', '2013/ND/CPS/140'),
(131, 'AJAKAIYE TANIMOLA THEOPHILUS', '2013/ND/CPS/141'),
(132, 'IBRAHIM ZAINAB.B', '2013/ND/CPS/143'),
(133, 'ABUBAKAR SEFIYA PRECIOUS', '2013/ND/CPS/144'),
(134, 'IBRAHIM SALAMATU', '2013/ND/CPS/147'),
(135, 'ZUBAIR NURUDEEN OMEIZA', '2013/ND/CPS/150'),
(136, 'HARUNA HAMID AMOTO', '2013/ND/CPS/151'),
(137, 'OMAH CHIWEIKE JUDE', '2013/ND/CPS/152'),
(138, 'MUHAMMED ABDULRAHMAN', '2013/ND/CPS/153'),
(139, 'LAMIDI OGIRIMA SAMUEL', '2013/ND/CPS/154'),
(140, 'AHMED HUSSAINI', '2013/ND/CPS/155'),
(141, 'IJAGBEMI VICTOR BUSUYI', '2013/ND/CPS/158'),
(142, 'OYELADE STEPHEN SEYI', '2013/ND/CPS/159'),
(143, 'REUBEN OJONEKECHE L', '2013/ND/CPS/160'),
(144, 'MUAHMMED YUSUF DELLE', '2013/ND/CPS/161'),
(145, 'MUHAMMED ABDULMOJEED TEMITOPE', '2013/ND/CPS/162'),
(146, 'UGBEDE ATTAI', '2013/ND/CPS/164'),
(147, 'YAKUBU MUNIRAT', '2013/ND/CPS/166'),
(148, 'YUSUF AMODU GANIU', '2013/ND/CPS/167'),
(149, 'IBITOMI DANIEL OLUWATOPE', '2013/ND/CPS/169'),
(150, 'ALABI SAMUEL ADAVA', '2013/ND/CPS/171'),
(151, 'OLUWOLE KINGSLEY ADETUNJI', '2013/ND/CPS/172'),
(152, 'DAUDA ABDULQUDUS', '2013/ND/CPS/173'),
(153, 'APASI FAROUK ONORUOIZA', '2013/ND/CPS/174'),
(154, 'YUSUF ADBULLATEEF', '2013/ND/CPS/175'),
(155, 'ACHOBA UGBEDA', '2013/ND/CPS/176'),
(156, 'ABRAHAM OJOCHIDE', '2013/ND/CPS/177'),
(157, 'IYEH JENET', '2013/ND/CPS/178'),
(158, 'ADAMA A. MERCY', '2013/ND/CPS/179'),
(159, 'AGUNBIADE OLUWATOSIN', '2013/ND/CPS/180'),
(160, 'ALONGE BANKE DORCAS', '2013/ND/CPS/181'),
(161, 'OWOBO GBENGA DANIEL', '2013/ND/CPS/182'),
(162, 'MUHAMMED ESTHER OYAMINE', '2013/ND/CPS/183'),
(163, 'TAIWO ADESHINA .S', '2013/ND/CPS/185'),
(164, 'NOAH RACHEAL ALIKEJU', '2013/ND/CPS/188'),
(165, 'ARAGA ZULEIHAT OZOZOMA', '2013/ND/CPS/191'),
(166, 'OLUKOTUN ZAINAB', '2013/ND/CPS/192'),
(167, 'PETER .O SUNDAY', '2013/ND/CPS/193'),
(168, 'MUHAMMED .A DAUDA', '2013/ND/CPS/195'),
(169, 'OBANDE PHILEMON', '2013/ND/CPS/196'),
(170, 'ZAKARIYA RUKAYAT', '2013/ND/CPS/197'),
(171, 'LAWAL A. SADIYAT', '2013/ND/CPS/198'),
(172, 'ABDULRAHAMAN BARIKISU', '2013/ND/CPS/199'),
(173, 'SALIHU OGIRIMA ISMAILA', '2013/ND/CPS/200'),
(174, 'OLOGE GRACE OLUWATOSIN', '2013/ND/CPS/201'),
(175, 'SULEIMAN OYIZA FALIDAT', '2013/ND/CPS/204'),
(176, 'ASEMA ABUBAKAR OBOJO', '2013/ND/CPS/205'),
(177, 'ILECHUKWU CHRISTIANA', '2013/ND/CPS/206'),
(178, 'OSALAYE JESUKEMI LOVETH', '2013/ND/CPS/207'),
(179, 'MUSA MUHAMMED', '2013/ND/CPS/208'),
(180, 'RAPHEAL EMMANUEL OLORUNJUWON', '2013/ND/CPS/209'),
(181, 'SALIHU VICTOR OJO', '2013/ND/CPS/210'),
(182, 'AKANDE TEMITOPE ADEDEJI', '2013/ND/CPS/212'),
(183, 'ABDULLAHI MUTALIB OZOVEHE', '2013/ND/CPS/213'),
(184, 'DAUDA MUHAMMED BASHIR', '2013/ND/CPS/214'),
(185, 'ISMAIL HAJARAT', '2013/ND/CPS/215'),
(186, 'MUSA MARIAM', '2013/ND/CPS/216'),
(187, 'MUSA BARIKISU', '2013/ND/CPS/217'),
(188, 'MOMOH SUNDAY ALEX', '2013/ND/CPS/218'),
(189, 'AINA OLUMIDE JOEL', '2013/ND/CPS/219'),
(190, 'AUDU SENUSI TIJANI', '2013/ND/CPS/220'),
(191, 'ABDULAZEEZ RUKAYAT', '2013/ND/CPS/221'),
(192, 'OLADIPUPO EMMANUEL OLUSHOLA', '2013/ND/CPS/222'),
(193, 'ABDULLAHI YUNUSA', '2013/ND/CPS/223'),
(194, 'OGBONNINI PELUMI TANIMOLA', '2013/ND/CPS/224'),
(195, 'SULEIMAN JUMAI IZE', '2013/ND/CPS/225'),
(196, 'USMAN TIJANI', '2013/ND/CPS/226'),
(197, 'SHAIBU ABDULMUMUNIN', '2013/ND/CPS/227'),
(198, 'AJAYI ENEJI GODSPOWER', '2013/ND/CPS/228'),
(199, 'ABDULJALIL YUSUF', '2013/ND/CPS/229'),
(200, 'MOHAMMED SANI', '2013/ND/CPS/231'),
(201, 'BABALOLA ANITA BIDEMI', '2013/ND/CPS/232'),
(202, 'SIAKA AYUBA', '2013/ND/CPS/234'),
(203, 'APEH FAITH', '2013/ND/CPS/235'),
(204, 'JATTO AINO RACHAEL', '2013/ND/CPS/236'),
(206, 'OBEKPA BLESSING ENEH', '2013/ND/CPS/239'),
(207, 'ABUH FELIX', '2013/ND/CPS/240'),
(208, 'ABDULLAHI MUSA', '2013/ND/CPS/241'),
(209, 'OLORUNTOBA JOSEPH IYANU', '2013/ND/CPS/242'),
(210, 'SALIHU PATIENCE', '2013/ND/CPS/243'),
(211, 'YAHAYA MUSTAPHA', '2013/ND/CPS/244'),
(212, 'ENYINWA MATTHEW', '2013/ND/CPS/247'),
(213, 'DAVID TOLANI MOTUNRAYO', '2013/ND/CPS/248'),
(214, 'BABANIYI TITILAYO', '2013/ND/CPS/249'),
(215, 'AYESA ESTHER O', '2013/ND/CPS/251'),
(216, 'SALAU COMFORT', '2013/ND/CPS/252'),
(217, 'ADENIYI ADENIKE PRAISE', '2013/ND/CPS/253'),
(218, 'JIMOH ENEYAMIRE MUSILI', '2013/ND/CPS/254'),
(219, 'MUSA THANKGOD', '2013/ND/CPS/255'),
(220, 'AMINU ISMAILA', '2013/ND/CPS/256'),
(221, 'ADEMOYE OPEYEMI MEMUNAT', '2013/ND/CPS/259'),
(222, 'OTACHE CHARITY ADMAS', '2013/ND/CPS/260'),
(223, 'TOWOENI KINGSLEY JAMES', '2013/ND/CPS/261'),
(224, 'OKWOLI JOEL BENJAMIN', '2013/ND/CPS/262'),
(225, 'ADEJOH DESTINY', '2013/ND/CPS/263'),
(226, 'SHAIBU BUHARI', '2013/ND/CPS/265'),
(227, 'MUSA BARIKISU', '2013/ND/CPS/267'),
(228, 'MUHAMMED FATIMA', '2013/ND/CPS/268'),
(229, 'MUHAMMED ABDULKARIM', '2013/ND/CPS/269'),
(230, 'OKOYE IKECHUKWU', '2013/ND/CPS/270'),
(231, 'IBITOYE OPEYEMI OLAWALE', '2013/ND/CPS/271'),
(232, 'ABDULLAHI MUHAMMED', '2013/ND/CPS/272'),
(233, 'MATHEW KAYODE', '2013/ND/CPS/275'),
(234, 'EMMANUEL HENRY', '2013/ND/CPS/276'),
(235, 'SALIHU ABDULRAHMAN KUDIRAT', '2013/ND/CPS/279'),
(236, 'ZUBAIR OJAPA DADA', '2013/ND/CPS/282'),
(237, 'IBITOGBE VICTORIA TOYIN', '2013/ND/CPS/283'),
(238, 'HASSAN OYIZA HAKIMAT', '2013/ND/CPS/285'),
(239, 'ABDULLAHI ABDULRAHIM', '2013/ND/CPS/291'),
(240, 'SALAU RAHEEM', '2013/ND/CPS/292'),
(241, 'YAKUBU ADISETU', '2013/ND/CPS/293'),
(242, 'YAKUBU ABDULAZEEZ', '2013/ND/CPS/294'),
(243, 'IBRAHIM RASHEEDAT', '2013/ND/CPS/295'),
(244, 'PAUL ENEOJO SUNDAY', '2013/ND/CPS/296'),
(245, 'BRUNO BLESSING UMORU', '2013/ND/CPS/297'),
(246, 'OSSAI MARY SOPHIA', '2013/ND/CPS/298'),
(247, 'BELLO OHIANI ABDULRASHID', '2013/ND/CPS/301'),
(248, 'YUSUF ISAH YAKUB', '2013/ND/CPS/302'),
(249, 'AKABUEZE VICTOR UCHECHUKWU', '2013/ND/CPS/304'),
(250, 'AMEH ACHENEJE SAMSON', '2013/ND/CPS/305'),
(251, 'ALAO HALIMAT', '2013/ND/CPS/310'),
(252, 'STEPHEN MAGRET JATO', '2013/ND/CPS/311'),
(253, 'YUSUF DAVID', '2013/ND/CPS/312'),
(254, 'ORUMA PETER', '2013/ND/CPS/314'),
(255, 'ALONG YETUNDE GLORIA', '2013/ND/CPS/315'),
(256, 'ICHATTA AYISHAT I', '2013/ND/CPS/321'),
(257, 'UMAR RASHIDAT', '2013/ND/CPS/323'),
(258, 'ALIU TOYIB OMEIZA', '2013/ND/CPS/325'),
(259, 'OKPALA SUNDAY', '2013/ND/CPS/326'),
(260, 'JIBRIN MARY S', '2013/ND/CPS/327');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

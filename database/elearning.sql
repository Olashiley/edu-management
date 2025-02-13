-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(30) NOT NULL,
  `sy` varchar(150) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `sy`, `status`) VALUES
(2, '2028-2025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `level` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `department_id`, `course_id`, `level`, `section`) VALUES
(3, 5, 2, '1', 'A'),
(4, 3, 3, '2', 'B'),
(5, 5, 2, '3', 'A'),
(6, 2, 3, '1', 'A'),
(7, 2, 3, '2', 'A'),
(8, 2, 3, '3', 'A'),
(9, 5, 2, '2', 'A'),
(10, 3, 3, '1', 'B'),
(11, 3, 3, '3', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `academic_year_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`academic_year_id`, `class_id`, `subject_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 2, 1),
(1, 2, 2),
(2, 3, 3),
(2, 3, 4),
(2, 6, 3),
(2, 6, 4),
(2, 6, 5),
(2, 7, 3),
(2, 7, 4),
(2, 7, 5),
(2, 7, 6),
(2, 8, 3),
(2, 8, 4),
(2, 8, 5),
(2, 8, 7),
(2, 9, 3),
(2, 9, 4),
(2, 9, 6),
(2, 9, 9),
(2, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects_faculty`
--

CREATE TABLE `class_subjects_faculty` (
  `academic_year_id` int(30) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `class_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects_faculty`
--

INSERT INTO `class_subjects_faculty` (`academic_year_id`, `faculty_id`, `class_id`, `subject_id`) VALUES
(1, '12345', 1, 1),
(1, '12345', 2, 1),
(2, '54321', 6, 3),
(2, '54321', 6, 4),
(2, '54321', 6, 5),
(2, '11111', 3, 3),
(2, '11111', 3, 4),
(2, '888888', 7, 3),
(2, '888888', 7, 4),
(2, '888888', 7, 5),
(2, '888888', 7, 6),
(2, '901234', 8, 3),
(2, '901234', 8, 4),
(2, '901234', 8, 5),
(2, '901234', 8, 7),
(2, '12345', 9, 3),
(2, '12345', 9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(30) NOT NULL,
  `course` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course`, `description`) VALUES
(2, 'JSS', 'Junior Secondary School'),
(3, 'SS', 'Senior Secondary School');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(30) NOT NULL,
  `department` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `description`) VALUES
(2, 'Science', 'Science Class'),
(3, 'Commercial', 'Commerce'),
(4, 'Art', 'Art Class'),
(5, 'General', 'All subjects');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(30) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `department_id` int(30) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `middlename` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `dob` int(11) NOT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_id`, `department_id`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `gender`, `address`, `password`, `dob`, `avatar`) VALUES
(2, '54321', 2, 'Ben', '', 'Carson', 'ben@gmail.com', '0909515578', 'Male', '3, Gold Avenue', '01cfcd4f6b8770febfb40cb906715822', 1998, 'uploads/Favatar_2.png'),
(3, '11111', 2, 'Darwin', '', 'Chalse', 'darwin@g.com', '08023886102', 'Male', '2, Broadway', 'b0baee9d279d34fa1dfd71aadb908c3f', 1975, 'uploads/Favatar_3.png'),
(4, '888888', 4, 'Gerald', '', 'Ben', 'gerald@gmail.com', '08023886102', 'Male', '45, Hollywood Ave', '8ddcff3a80f4189ca1c9d4d902c3c909', 1990, 'uploads/Favatar_4.png'),
(5, '901234', 2, 'Adebisi', '', 'Konga', 'konga@gmail.com', '0802455123', 'Female', '45, Bankole', 'e37e4db5bbb12b8f3e85cee6ed374bd1', 1980, 'uploads/Favatar_5.png'),
(6, '12345', 5, 'Naomi', '', 'Osaka', 'osaka@gmail.com', '08032887205', 'Female', '4, Adeniji Adele close', 'cfa7edb967e5e99a734606a7ddf7c6e4', 2025, 'uploads/1739091060_jones.png');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(30) NOT NULL,
  `academic_year_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ppt_path` text DEFAULT NULL,
  `hDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `academic_year_id`, `subject_id`, `faculty_id`, `title`, `question`, `answer`, `description`, `ppt_path`, `hDate`) VALUES
(1, 2, 6, '88888888', 'Introduction to Ecconomics', '<p>What is Economics?</p><p>What is the law of Diminishing Returns</p>', '', '&lt;p&gt;Intro into Economics&lt;/p&gt;', '../uploads/doc/assignment_0/FAITH.docx', '2025-02-04 14:46:26'),
(2, 2, 3, '11111', 'Fraction', '<p>1,  What is <sup>1</sup>/<sub>2</sub> of 50 = ?</p><p>2,  What is <sup>2</sup>/<sub>4 </sub> + <sup>1</sup>/<sub>2</sub> =<span style=\"font-size: 10.5px;\"> ?</span></p>', '<p>1,&nbsp; What is&nbsp;<sup style=\"font-size: 10.5px;\">1</sup>/<sub style=\"font-size: 10.5px;\">2</sub>&nbsp;of 50 = 25</p><p>2,&nbsp; What is&nbsp;<sup style=\"font-size: 10.5px;\">2</sup>/<sub style=\"font-size: 10.5px;\">4&nbsp;</sub>&nbsp;+&nbsp;<sup sty', '&lt;p&gt;Base on the class last lesson&lt;/p&gt;', '../uploads/doc/assignment_2/NAME_OF_DEPARTMENTS.docx', '2025-02-08 15:19:35'),
(3, 2, 5, '11111', 'Evolution', '<p>What is evolution?</p>', '', '&lt;p&gt;Assignment on evolution&lt;/p&gt;', '../uploads/doc/assignment_3/Evolution_Practice_Quiz.docx', '2025-02-08 15:22:01'),
(4, 2, 6, '12345', 'Quotation', '<p>Design a template of a business quotation</p>', '<p class=\"MsoNormal\"><b>The Mr Chairman,<o:p></o:p></b></p><p class=\"MsoNormal\"><b>Oshodi _isolo. <o:p></o:p></b></p><p class=\"MsoNormal\"><b>Local government\ncouncil. <o:p></o:p></b></p><p class=\"MsoNormal\"><b>Lagos state,<o:p></o:p></b></p><p class=\"Mso', 'Homework to be submitted next class', NULL, '2025-02-09 09:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `home_class`
--

CREATE TABLE `home_class` (
  `home_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_class`
--

INSERT INTO `home_class` (`home_id`, `class_id`) VALUES
(1, 7),
(2, 3),
(3, 3),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(30) NOT NULL,
  `academic_year_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `ppt_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `academic_year_id`, `subject_id`, `faculty_id`, `title`, `description`, `ppt_path`) VALUES
(1, 1, 2, '12345', 'Lesson 101 Test', '&lt;h2 style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial,=&quot;&quot; sans-serif;&quot;=&quot;&quot;&gt;&lt;b&gt;Sample Heading 1&lt;/b&gt;&lt;/h2&gt;&lt;h2 style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial,=&quot;&quot; sans-serif;&quot;=&quot;&quot;&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; font-size: 14px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed enim ipsum, rutrum eu erat sed, lacinia hendrerit sapien. Ut viverra dapibus velit nec pellentesque. Morbi ac gravida tortor. Curabitur scelerisque nisl metus. Fusce diam dui, feugiat vel congue a, convallis pulvinar dui. Donec ut felis vel dolor vehicula tincidunt vitae id nibh. Mauris mollis leo pulvinar vehicula sagittis. Sed bibendum arcu at eros imperdiet pellentesque non non orci. Etiam accumsan pulvinar egestas. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec odio nec quam ultrices facilisis. Nam tempor a neque dapibus lacinia. Etiam porttitor at urna sed pellentesque. Phasellus rhoncus mi at lobortis semper. Vivamus tempus urna nec sagittis vehicula. Nam sagittis velit nec quam molestie volutpat quis et ex.&lt;/p&gt;&lt;/h2&gt;&lt;h2&gt;&lt;b&gt;Sample Heading 2&lt;/b&gt;&lt;/h2&gt;&lt;h2&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; font-size: 14px;&quot;&gt;Sed in imperdiet nisi, non ultrices lectus. Donec auctor, ante sed vestibulum cursus, ex neque scelerisque augue, a faucibus libero lectus eu mauris. Morbi ac quam non felis malesuada lacinia vel laoreet tortor. Proin euismod risus sit amet scelerisque imperdiet. Phasellus ut neque mollis, porttitor velit a, congue libero. Ut cursus accumsan lectus, vitae congue mi pellentesque vitae. Integer pulvinar accumsan dignissim. Proin bibendum dapibus risus at accumsan. Donec a sapien sed arcu malesuada maximus. Integer eu feugiat eros.&lt;/p&gt;&lt;/h2&gt;', 'uploads/slides/lesson_1'),
(2, 1, 1, '12345', 'Sample 101', '&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;Aliquam dictum ante at dapibus luctus. Maecenas semper pulvinar congue. Pellentesque semper, velit eget auctor euismod, ante sem vulputate augue, ut volutpat felis lorem nec ex. Praesent non porttitor nunc, non ullamcorper est. Donec eu arcu viverra augue tristique fermentum. Duis scelerisque bibendum augue, id laoreet massa tempor eu. Vivamus nec ante est. Fusce eu lacus sapien. Sed viverra lorem nec ante consequat tempor. Quisque ligula dolor, feugiat nec ligula porttitor, fermentum lacinia augue. Morbi fringilla vitae massa vitae tempus. Etiam ut vehicula lectus. Fusce cursus dolor vel dignissim volutpat. Etiam iaculis, justo vel fermentum varius, sem turpis hendrerit nulla, eget dapibus neque urna vitae arcu.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;Ut euismod tempor turpis, quis fringilla enim varius eget. Duis id neque blandit, vehicula purus eu, molestie dolor. Aliquam erat volutpat. Pellentesque quis dapibus elit. Curabitur ac lectus tortor. Phasellus et nibh nisl. Phasellus eu imperdiet nisi, tempor semper purus&lt;/p&gt;', 'uploads/slides/lesson_2'),
(3, 2, 5, '54321', 'Osmosis', '&lt;p&gt;Osmosis and Diffusion&lt;/p&gt;', 'uploads/slides/lesson_3'),
(5, 2, 3, '11111', 'Fraction', '&lt;p&gt;&lt;sup&gt;2&lt;/sup&gt;/&lt;sub&gt;4&amp;nbsp;&lt;/sub&gt;&amp;nbsp;of 10 = 2.5&lt;/p&gt;', '../uploads/lessons/lesson_5/Business_Proposal.docx'),
(6, 2, 6, '888888', 'Introduction to Ecconomics', '&lt;p&gt;What is Economics&lt;/p&gt;', '../uploads/lessons/lesson_6/footage_samp.mp4'),
(7, 2, 5, '11111', 'Evolution', '&lt;p&gt;Evolution is the study of the growth transition of mammals fro the ancestory link.&lt;/p&gt;', '../uploads/lessons/lesson_7/What_is_evolution_.pdf'),
(8, 2, 6, '12345', 'Business Quotation', 'Business Quotation is the act of itemising the needed resources with the financial implication of execution of a project.', '../uploads/lessons/lesson_8/quotation.docx');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_class`
--

CREATE TABLE `lesson_class` (
  `lesson_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_class`
--

INSERT INTO `lesson_class` (`lesson_id`, `class_id`) VALUES
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 6),
(4, 6),
(6, 7),
(5, 3),
(7, 3),
(8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `middlename` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `dob` int(11) NOT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `gender`, `address`, `password`, `dob`, `avatar`) VALUES
(5, '11122233', 'Harley', '', 'Quin', 'harley@g.com', '0909515578', 'Female', '3, Broadway', '00b7691d86d96aebd21dd9e138f90840', 2025, 'uploads/uvatar_5.png'),
(6, '22156780', 'Dieko', '', 'Ini', 'diekoini@gmail.com', '07066383876', 'Female', '37, Adeshile Street', '470a67168218082eb00ec043a31ea26c', 2025, 'uploads/Favatar_6.png'),
(8, '87654321', 'Biodun', '', 'Stephens', 'bio@gmail.com', '09023567812', 'Female', '3 Oakville street', '5e8667a439c68f5145dd2fcbecf02209', 2016, 'uploads/Favatar_8.png'),
(9, '33456100', 'Dieko', '', 'Adeboye', 'dieko@gmail.com', '09023567812', 'Female', '3 Oakville street', '9b399a0a6a945e0ac34d73e75568f34b', 2025, 'uploads/Favatar_9.png'),
(10, '45678032', 'Eric ', '', 'Bennet', 'eric@gmail.com', '09056838247', 'Male', '23, Kass Street', '4131f403beab0f4fa9e654b2ffa4f769', 2020, 'uploads/Favatar_10.png');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `id` int(30) NOT NULL,
  `academic_year_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`id`, `academic_year_id`, `student_id`, `class_id`) VALUES
(1, 1, 6231415, 6),
(2, 2, 87654321, 6),
(3, 2, 111222, 3),
(4, 2, 22156780, 7),
(5, 2, 334561, 8),
(6, 2, 33456100, 8),
(7, 2, 11122233, 3),
(8, 2, 45678032, 9);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(30) NOT NULL,
  `subject_code` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `description`) VALUES
(3, 'm101', 'Mathematics'),
(4, 'eng102', 'English'),
(5, 'bio103', 'Biology'),
(6, 'eco104', 'Economics'),
(7, 'chem105', 'Chemistry'),
(8, 'phy106', 'Physics'),
(9, 'gov107', 'Government'),
(10, 'ck108', 'CRK');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Edutech e-learn'),
(2, 'address', 'Philippines'),
(3, 'contact', '+1234567890'),
(4, 'email', 'info@sample.com'),
(6, 'short_name', 'EDL'),
(9, 'logo', 'uploads/1737241080_apple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `date_added`, `date_updated`) VALUES
(1, '', 'John', 'Smith', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1619140500_avatar.png', NULL, '2021-01-20 14:02:37', '2021-04-23 15:14:05'),
(15, '112233', 'Daniel', 'Adeboye', 'dan', '0f281d173f0fdfdccccd7e5b8edc21f1', 'uploads/Favatar_15.png', NULL, '2025-02-08 09:44:20', '2025-02-08 22:51:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_class`
--
ALTER TABLE `home_class`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

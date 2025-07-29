-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 07:58 PM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'Admin', '$2y$10$cVV2uXGuWiT2e.Xkaq5zlen03Oja40ULyGn8d67P1zT8kwbBuy8gG', 'Admin', 'Admin', '596cd1f73fdc4783b29baf28e1ff3235.png', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `candidateapplication`
--

CREATE TABLE `candidateapplication` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `platform` text NOT NULL,
  `average` float DEFAULT NULL,
  `year` text NOT NULL,
  `contest_history` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `photo`, `platform`) VALUES
(12, 24, 'Thabo', 'Molefe', 'images (9).jpeg', 'EFFSC - I aim to foster a vibrant campus culture by organizing events that cater to diverse interests, ensuring every student feels included and represented.'),
(13, 24, 'Naledi', 'Khumalo', '', 'SASCO - My focus is on improving student welfare. I will advocate for better mental health support and more affordable on-campus living solutions.'),
(14, 25, 'Zola', 'Ndlovu', '4c91a39cf8b6bdc8096b7348e8d066b8.jpg', 'I will work to increase student engagement through interactive workshops, sports events, and cultural festivals to bring our community closer.'),
(15, 25, 'Sipho', 'Dlamini', 'b878aa49d58c48a07f1da42a3776b919.jpg', 'Independent - Transparency and accountability will be my priorities. I will make sure students\' voices are heard in decision-making processes affecting our campus life.'),
(16, 26, 'Lerato', 'Mokoena', '695d5686682550dae0ca8152aa86924e.jpg', 'Independent - I am committed to promoting sustainability by launching recycling programs and advocating for more eco-friendly practices on campus.'),
(17, 26, 'Kopano', 'Maseko', '', 'I will advocate for an increase in student bursaries and more academic resources, ensuring that financial difficulties don’t hinder students\' education.'),
(18, 27, 'Buhle', 'Rhadebe', '596cd1f73fdc4783b29baf28e1ff3235.png', 'My goal is to establish a mentorship program that pairs new students with senior mentors, helping them transition smoothly into university life.'),
(19, 27, 'Tebogo', 'Nkosi', '', 'I plan to create a platform where students can easily access all campus resources, including clubs, academic support, and student services.'),
(20, 28, 'Ayanda', 'Mdletshe', 'image.jpg', 'I will push for more recreational spaces on campus, where students can relax, unwind, and engage in extracurricular activities.'),
(21, 28, 'Sibongile', 'Zulu', '', 'My focus will be on advocating for students’ safety by increasing campus security measures and providing more resources for reporting incidents.'),
(22, 29, 'Jabulani', 'Mthembu', '_V2A0659_highres.jpg', 'I will promote arts and culture by organizing student showcases for music, dance, and visual arts, allowing talent to shine.'),
(23, 29, 'Kagiso', 'Ramathibela', '', 'I aim to ensure that our campus Wi-Fi is reliable and accessible in all areas to support students\' academic needs.'),
(24, 30, 'Mpho', 'Sekhukhune', '', 'I will champion the cause for better food options on campus, with healthier choices and more affordable prices'),
(25, 30, 'Nandi', 'Phiri', 'b0fd63e8ae0801994d47c6109d062f06.jpg', 'I will work to make every student\'s voice heard by establishing a feedback system where students can submit suggestions and concerns.'),
(26, 31, 'Thando', 'Gama', '', 'My main goal is to enhance career services, with more workshops, job fairs, and internship opportunities for students.'),
(27, 31, 'Bongani', 'Sibanda', '596cd1f73fdc4783b29baf28e1ff3235.png', 'I aim to reduce student stress by advocating for more flexible academic deadlines and improving access to counseling services.'),
(28, 32, 'Khanyile', 'Masondo', '', 'I will ensure that facilities such as libraries and study rooms are accessible during extended hours to accommodate all students.'),
(29, 32, 'Mandisa', 'Xaba', 'Mr Morale....jpg', 'I am committed to improving disability services on campus by advocating for accessible infrastructure and support programs'),
(30, 33, 'Vusi', 'Ntuli', '', 'I will initiate student-led workshops on entrepreneurship, financial literacy, and life skills to prepare us for life beyond university.'),
(31, 33, 'Zinhle', 'Tshabalala', 'FLoxnjCaIAAtds4.jpg', 'I will establish an annual campus sports tournament to encourage participation in different sports and promote a healthy lifestyle.'),
(32, 34, 'Siphelele', 'Khumalo', '', 'I will strive to improve transportation services for off-campus students by negotiating better routes and schedules.'),
(33, 34, 'Lebohang', 'Hlatshwayo', '', 'My focus will be on bridging the digital divide by ensuring access to computer labs and necessary software for all students.'),
(34, 35, 'Lwandle', 'Mbatha', '596cd1f73fdc4783b29baf28e1ff3235.png', 'I plan to promote inclusivity by organizing events celebrating various cultures and backgrounds represented on campus.'),
(35, 35, 'Tshepo', ' Baloyi', '', 'I will advocate for a more diverse curriculum that includes more African perspectives and courses relevant to the local context'),
(36, 36, 'Palisa', 'Moeketsi', 'unnamed.jpg', 'I am dedicated to supporting student clubs and societies with better funding and resources to thrive and expand their reach.'),
(37, 36, 'Gugu', 'Molewa', '596cd1f73fdc4783b29baf28e1ff3235.png', 'I aim to ensure that all students have access to career guidance and development programs that prepare them for the job market.'),
(38, 24, 'Thato', 'Kutumela', '695d5686682550dae0ca8152aa86924e.jpg', 'I will help unfunded students by having a card scheme and helping pay their fees. They will be catered for on and off camous and this will be done with the help of huge retailers. Vote for me!'),
(43, 26, 'Bianca ', 'Ndgeshane', 'college-student-glasses-backpack.jpg', 'Write their manifesto');

-- --------------------------------------------------------

--
-- Table structure for table `hc_application`
--

CREATE TABLE `hc_application` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `position_id` int(11) NOT NULL,
  `platform` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `average` decimal(5,2) NOT NULL CHECK (`average` >= 64),
  `contest_history` enum('1','2','3','4+') NOT NULL,
  `training_attendance` text DEFAULT NULL,
  `application_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(24, 'SRC President', 1, 1),
(25, 'SRC Deputy President', 1, 2),
(26, 'SRC Scretary-General', 1, 3),
(27, 'Deputy Secretary-General', 1, 4),
(28, 'Treasurer', 1, 5),
(29, 'Media & Projects Officer', 1, 6),
(30, 'Residence Officer', 1, 7),
(31, 'Academic Affairs Officer', 1, 8),
(32, 'Community Outreach Officer', 1, 9),
(34, 'Clubs, Societies and Organisation Officer', 1, 10),
(35, 'Sport Officer', 1, 11),
(36, 'Commuter Student Officer', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `voters_id` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `voters_id`, `password`, `firstname`, `lastname`, `photo`, `email`) VALUES
(92, 'DbzjXc4wyNe2Ktx', '$2y$10$nFalnQhvqEy7IOfxQeiRreasgUMTX8EEdx/tv0DYLDpClwuXb1BI6', 'Andy', 'Mshengu', '', '202215470@spu.ac.za'),
(95, 'czYH37K9SsGgJXV', '$2y$10$pJxCxUcyY.gwQtu817W5RenbtlDKr.zACQ.q697pvNPap.4Px9pEm', 'Samkelo', 'Nzuza', '', '202203299@spu.ac.za'),
(96, 'YG6JeSAl7OiTxCK', '$2y$10$VFZ1K8BVTe2m4KTyFiAfHun1yYEAqdHNADq7JDA93gdzS7l4n7/TO', 'Fika', 'Fayini', '', '202207134@spu.ac.za');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`) VALUES
(162, 83, 37, 36),
(163, 84, 12, 24),
(164, 84, 14, 25),
(165, 84, 17, 26),
(166, 84, 18, 27),
(167, 84, 20, 28),
(168, 84, 22, 29),
(169, 84, 24, 30),
(170, 84, 26, 31),
(171, 84, 28, 32),
(172, 84, 31, 33),
(173, 84, 33, 34),
(174, 84, 35, 35),
(175, 84, 37, 36),
(176, 85, 37, 36),
(177, 86, 37, 36),
(178, 86, 37, 36),
(179, 87, 13, 36),
(180, 88, 15, 36),
(181, 88, 15, 36),
(182, 91, 35, 36),
(183, 91, 35, 36),
(184, 91, 35, 36),
(185, 91, 35, 36),
(186, 91, 35, 36),
(187, 91, 35, 36),
(188, 92, 19, 36),
(189, 92, 19, 36),
(190, 92, 19, 36),
(191, 92, 19, 36),
(192, 93, 15, 36),
(193, 94, 15, 36),
(194, 95, 37, 36),
(195, 95, 37, 36),
(196, 95, 37, 36),
(197, 95, 37, 36),
(198, 95, 37, 36),
(199, 95, 37, 36),
(200, 95, 37, 36),
(201, 95, 37, 36),
(202, 95, 37, 36),
(203, 95, 37, 36),
(204, 95, 37, 36),
(205, 95, 37, 36);

-- --------------------------------------------------------

--
-- Table structure for table `voting_deadlines`
--

CREATE TABLE `voting_deadlines` (
  `id` int(11) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_deadlines`
--

INSERT INTO `voting_deadlines` (`id`, `deadline`) VALUES
(1, '2024-10-26 10:10:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidateapplication`
--
ALTER TABLE `candidateapplication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hc_application`
--
ALTER TABLE `hc_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_deadlines`
--
ALTER TABLE `voting_deadlines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidateapplication`
--
ALTER TABLE `candidateapplication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hc_application`
--
ALTER TABLE `hc_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `voting_deadlines`
--
ALTER TABLE `voting_deadlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hc_application`
--
ALTER TABLE `hc_application`
  ADD CONSTRAINT `hc_application_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

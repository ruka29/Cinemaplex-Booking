-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 01:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemaplex_booking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `username`, `email`, `password`) VALUES
(2, 'Nadun', 'Warshan', 'admin', 'nadunwarshan@gmail.com', '$2y$10$u2U4UOOavr5CJ/GoGG3V/e0GNHC30uOZ.Lc8PWJKWvD7ZPb5dDfue');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL,
  `showtimes_id` int(11) NOT NULL,
  `no_seats` int(11) NOT NULL,
  `seat_numbers` varchar(255) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `movie_id`, `date`, `showtimes_id`, `no_seats`, `seat_numbers`, `total`) VALUES
(94, 2, 1, '2023-10-26', 1, 2, 'B4,B5', 2000),
(95, 2, 4, '2023-10-29', 4, 2, 'E4,E5', 1600),
(96, 2, 5, '2023-10-25', 5, 1, 'C7', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE `cast` (
  `actor_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `actor_name` varchar(100) NOT NULL,
  `character_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`actor_id`, `movie_id`, `actor_name`, `character_name`) VALUES
(1, 1, 'Cillian Murphy', 'J. Robert Oppenheimer'),
(2, 1, 'Matt Damon', 'Leslie Groves'),
(3, 1, 'Emily Blunt', 'Kitty Oppenheimer'),
(4, 2, 'Tom Cruise', 'Ethan Hunt'),
(5, 2, 'Rebecca Ferguson', 'Ilsa Faust'),
(6, 2, 'Hayley Atwell', 'Grace'),
(7, 3, 'Archie Madekwe', 'Jann Mardenborou'),
(8, 3, 'Orlando Bloom', 'Danny Moore'),
(9, 3, 'David Harbour', 'Jack Salter'),
(10, 4, 'Kenneth Branagh', 'Hercule Poirot'),
(11, 4, 'Kelly Reilly', 'Rowena Drake'),
(12, 4, 'Michelle Yeoh', 'Mrs Reynolds'),
(13, 5, 'Xolo Maridueña', 'Blue Beetle'),
(14, 5, 'Bruna Marquezine', 'Jenny Kord'),
(15, 5, 'Becky G', 'Khaji-Da'),
(16, 6, 'Denzel Washington', 'Robert McCall'),
(17, 6, 'Dakota Fanning', 'Acteur'),
(18, 6, 'Sonia Ammar', 'Chiara'),
(19, 7, 'Taissa Farmiga', 'Sister Irene'),
(20, 7, 'Anna Popplewell', 'Kate'),
(21, 7, 'Bonnie Aarons', 'Demon Nun'),
(22, 8, 'Sylvester Stallone', 'Barney Ross'),
(23, 8, 'Jason Statham', 'Lee Christmas'),
(24, 8, 'Dolph Lundgren', 'Gunner Jensen');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `trailer_link` varchar(255) NOT NULL,
  `poster_path` varchar(255) NOT NULL,
  `landscape_path` varchar(255) NOT NULL,
  `showtimes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `ticket_price`, `trailer_link`, `poster_path`, `landscape_path`, `showtimes_id`) VALUES
(1, 'Oppenheimer', 1000, 'https://youtu.be/uYPbbksJxIg?si=bjjKfQgUsoVfzUYj', 'upload_images/oppenheimer-poster.jpg', 'upload_images/oppenheimer.jpg', 1),
(2, 'Mission Impossible ', 1200, 'https://youtu.be/avz06PDqDbM?si=S6OuEyI1S4PuSk2u', 'upload_images/mission-impossible-poster.jpg', 'upload_images/mission-impossible.jpg', 2),
(3, 'Gran Turismo', 1100, 'https://youtu.be/GVPzGBvPrzw?si=4wkRIt2gj2sB-nzW', 'upload_images/gran-turismo-poster.jpg', 'upload_images/gran-turismo.jpg', 3),
(4, 'A Hunting In Venice', 800, 'https://youtu.be/yEddsSwweyE?si=zY2DvpJXRXZ5dk8Y', 'upload_images/hunting-in-venice-poster.jpg', 'upload_images/haunting-in-venice.jpg', 4),
(5, 'Blue Beetle', 1500, 'https://youtu.be/vS3_72Gb-bI?si=LBXdcMTRfJ-IjerE', 'upload_images/blue-beetle-poster.jpg', 'upload_images/blue-beetle.jpg', 5),
(6, 'The Equalizer 3', 1000, 'https://youtu.be/19ikl8vy4zs?si=sZSDBzFmE5iTCw10', 'upload_images/the-equalizer-3-poster.jpg', 'upload_images/the-equalizer-3.jpg', 6),
(7, 'The Nun 2', 1200, 'https://youtu.be/QF-oyCwaArU?si=MZi-eTWVAzVw9VXF', 'upload_images/the-nun-2-poster.jpg', 'upload_images/the-nun-2.jpg', 7),
(8, 'The Expendables 4', 950, 'https://youtu.be/DhlaBO-SwVE?si=7O8VnsY48OUHHkle', 'upload_images/expend4bles-poster.jpg', 'upload_images/expendables-4.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `movie_details`
--

CREATE TABLE `movie_details` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `genres` varchar(255) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `writer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_details`
--

INSERT INTO `movie_details` (`id`, `movie_id`, `genres`, `duration`, `director`, `producer`, `writer`) VALUES
(1, 1, 'Biography, Drama, History', '3h', 'Christopher Nolan', 'Thomas Hayslip', 'Christopher Nolan'),
(2, 2, 'Action, Thriller', '2h 43min', 'Christopher McQuarrie', 'Tom Cruise', 'Erik Jendresen'),
(3, 3, 'Action, Adventure, Drama', '2h 15min', 'Neill Blomkamp', 'Doug Belgrad , Jason Hall', 'Jason Hall , Zach Baylin'),
(4, 4, 'Crime, Drama, Horror', '1h 47min', 'Kenneth Branagh', 'Mark Gordon', 'Michael Green , Agatha Christie'),
(5, 5, 'Action, Adventure', '2h 7min', 'Ángel Manuel Soto', 'John Rickard, Zev Foreman', 'Gareth Dunnet-Alcocer'),
(6, 6, 'Action, Vigilante', '1h 49min', 'Antoine Fuqua', 'Denzel Washington', 'Richard Wenk'),
(7, 7, 'Horror, Mystery', '1h 50min', 'Michael Chaves', 'Richard Brener', 'Ian Goldberg , Richard Naing'),
(8, 8, 'Action, Adventure', '1h 43min', 'Scott Waugh', 'Kevin King-Templeton', 'Kurt Wimmer');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtimes_id` int(11) NOT NULL,
  `time` varchar(15) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtimes_id`, `time`, `location`) VALUES
(1, '10.30 AM', 'Hall A'),
(2, '1.30 PM', 'Hall A'),
(3, '4.30 PM', 'Hall A'),
(4, '10.30 AM', 'Hall B'),
(5, '1.30 PM', 'Hall B'),
(6, '4.30 PM', 'Hall B'),
(7, '10.30 AM', 'Hall C'),
(8, '1.30 PM', 'Hall C'),
(9, '4.30 PM', 'Hall C');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`) VALUES
(2, 'Rukshan', 'Kumara', 'ruka29', 'rukshantechnologies@gmail.com', '$2y$10$E90rG4CElYaWnNTuEG1mwuWk5mTlAodVRVxGf6It8vV3ue6QJlu0y'),
(3, 'Hiruni', 'Maleesha', 'hiruni225', 'hiruni@gmail.com', '$2y$10$W7w6ZSCQJONlIccyw4utW.JGPu3al11sS2bBOc9e5S1oP1CtIfxRi'),
(4, 'John', 'Smith', 'john', 'johnsmith@gamil.com', '$2y$10$N54i7XZJ1TOCvWa4Xuu79eWslEQDGGZMM.xDjFKmiNX5W5Tg/89vC'),
(5, 'Nadun', 'Warshan', 'admin', 'nadunwarshan@gmail.com', '$2y$10$n4MuXIaC8HpwDfCaPu1JN.HhLv1mjqMys2T3tp7d7oWUwizMwJ3ya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `showtimes_id` (`showtimes_id`);

--
-- Indexes for table `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`actor_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movie_details`
--
ALTER TABLE `movie_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtimes_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `cast`
--
ALTER TABLE `cast`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movie_details`
--
ALTER TABLE `movie_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `showtimes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`showtimes_id`) REFERENCES `showtimes` (`showtimes_id`);

--
-- Constraints for table `cast`
--
ALTER TABLE `cast`
  ADD CONSTRAINT `cast_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `movie_details`
--
ALTER TABLE `movie_details`
  ADD CONSTRAINT `movie_details_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# vacation-portal

This is a vacation management portal for employees and managers.
Manager dashboard:
![Στιγμιότυπο οθόνης 2024-10-29 182458](https://github.com/user-attachments/assets/c261affe-9a0d-4f1c-86cd-6327c9b130b5)

Vacation requests:
![Στιγμιότυπο οθόνης 2024-10-29 182612](https://github.com/user-attachments/assets/ae7c603b-69a9-45da-bf6a-df58889d94df)

Employee dashboard:
![Στιγμιότυπο οθόνης 2024-10-29 182723](https://github.com/user-attachments/assets/64e57cf3-b462-4e43-ac80-583eef245f81)

## Setting Up the Database

To set up the database for the Vacation Portal application, you can use these steps:
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_code` varchar(7) NOT NULL,
  `role` enum('employee','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `employee_code`, `role`) VALUES
(1, 'iggy', 'iggy@gmail.com', '$2y$10$8lcDpOpJnyfda.W7vaXS..lINs/1JgL00Ye0.mS3H2nfDjnTYHc0C', '1234567', 'manager'),
(5, 'vicky', 'vicky@gmail.com', '$2y$10$G15t7jc4U5tUVH/T.M0lb.J.Y4IOvyjlOW7trvLOqUvSa7st6tHa2', '1234568', 'employee'),
(9, 'pavlos', 'pavlos@gmail.com', '$2y$10$mzJEqkEmmliSjCaiZvLrhOnL.THvqjXEtq1K1MGLiffWLZJs5shOW', '1234510', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `vacation_requests`
--

CREATE TABLE `vacation_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacation_requests`
--

INSERT INTO `vacation_requests` (`id`, `user_id`, `start_date`, `end_date`, `reason`, `status`) VALUES
(4, 5, '2024-10-29', '2024-10-31', 'vacations!!', 'approved'),
(5, 5, '2024-11-21', '2024-11-26', 'no reason', 'pending');


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the database
CREATE DATABASE IF NOT EXISTS `sams_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sams_db`;

-- Table: users
CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_key` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL,
  `status` enum('active','pending','archived') NOT NULL DEFAULT 'pending',
  `gender` varchar(50) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` VARCHAR(255) NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_user_key` (`user_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: rooms
CREATE TABLE `rooms` (
  `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  PRIMARY KEY (`room_id`),
  UNIQUE KEY `room_name` (`room_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: subject
CREATE TABLE `subject` (
  `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `credits` tinyint(3) UNSIGNED NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: enrollment_term
CREATE TABLE `enrollment_term` (
  `enrollment_term_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) NOT NULL,
  `semester` enum('1st','2nd','summer') NOT NULL,
  `sem_start` date NOT NULL,
  `sem_end` date NOT NULL,
  `term_start` date NOT NULL,
  `term_end` date NOT NULL,
  PRIMARY KEY (`enrollment_term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Triggers for enrollment_term
DELIMITER $$
CREATE TRIGGER `before_insert_enrollment_term` BEFORE INSERT ON `enrollment_term` FOR EACH ROW
BEGIN
    IF NEW.sem_start > NEW.sem_end THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Semester start date must be before semester end date';
    END IF;
    IF NEW.term_start > NEW.term_end THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Term start date must be before term end date';
    END IF;
END$$
CREATE TRIGGER `before_update_enrollment_term` BEFORE UPDATE ON `enrollment_term` FOR EACH ROW
BEGIN
    IF NEW.sem_start > NEW.sem_end THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Semester start date must be before semester end date';
    END IF;
    IF NEW.term_start > NEW.term_end THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Term start date must be before term end date';
    END IF;
END$$
DELIMITER ;

-- Table: class
CREATE TABLE `class` (
  `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `section` varchar(10) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `idx_class_teacher` (`teacher_id`),
  CONSTRAINT `class_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: class_room_time_slots
CREATE TABLE `class_room_time_slots` (
  `rts_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` int(10) UNSIGNED NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `week_day` enum('mon','tue','wed','thu','fri','sat') NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','pending','archived') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`rts_id`),
  KEY `class_id` (`class_id`),
  KEY `idx_room_time` (`room_id`,`week_day`,`time_start`,`time_end`),
  CONSTRAINT `class_room_time_slots_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  CONSTRAINT `class_room_time_slots_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: class_sessions
CREATE TABLE `class_sessions` (
  `class_session_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_id` int(10) UNSIGNED NOT NULL,
  `open_datetime` datetime NOT NULL,
  `close_datetime` datetime NOT NULL,
  PRIMARY KEY (`class_session_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `class_sessions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: attendance
CREATE TABLE `attendance` (
  `attendance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `class_session_id` int(10) UNSIGNED NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `idx_attendance_user` (`user_id`),
  KEY `idx_attendance_session` (`class_session_id`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`class_session_id`) REFERENCES `class_sessions` (`class_session_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: attendance_leave
CREATE TABLE `attendance_leave` (
  `attendance_leave_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `letter` text NOT NULL,
  `datetimestamp_created` datetime NOT NULL DEFAULT current_timestamp(),
  `datetimestamp_reviewed` datetime DEFAULT NULL,
  `datetimestamp_resolved` datetime DEFAULT NULL,
  PRIMARY KEY (`attendance_leave_id`),
  KEY `idx_leave_user` (`user_id`),
  KEY `idx_leave_status` (`status`),
  CONSTRAINT `attendance_leave_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: notifications
CREATE TABLE `notifications` (
  `notif_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`notif_id`),
  KEY `idx_notif_user` (`user_id`),
  KEY `idx_notif_status` (`status`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: student_assignment
CREATE TABLE `student_assignment` (
  `enrollment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `enrollment_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `enrollment_term_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `idx_enrollment_user` (`student_id`),
  KEY `idx_enrollment_class` (`class_id`),
  KEY `enrollment_term_id` (`enrollment_term_id`),
  CONSTRAINT `student_assignment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `student_assignment_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  CONSTRAINT `student_assignment_ibfk_3` FOREIGN KEY (`enrollment_term_id`) REFERENCES `enrollment_term` (`enrollment_term_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: teacher_assignment
CREATE TABLE `teacher_assignment` (
  `assignment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `assigned_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `enrollment_term_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`assignment_id`),
  KEY `idx_teacher_class` (`teacher_id`,`class_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `teacher_assignment_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `teacher_assignment_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_teacher_assignment_term` FOREIGN KEY (`enrollment_term_id`) REFERENCES `enrollment_term` (`enrollment_term_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
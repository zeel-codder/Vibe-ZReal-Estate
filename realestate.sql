SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

SET NAMES utf8mb4;

-- Create agent table
CREATE TABLE IF NOT EXISTS `agent` (
  `agent_id` int(10) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(150) NOT NULL,
  `agent_address` varchar(250) NOT NULL,
  `agent_contact` varchar(20) NOT NULL,
  `agent_email` varchar(25) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert sample agent data
INSERT INTO `agent` (`agent_id`, `agent_name`, `agent_address`, `agent_contact`, `agent_email`) VALUES
(1, 'Samuel A Waldey', '95, Henry Street, Indented Head, Victoria', '03 5321 1053', 'samuel@gmail.com'),
(2, 'Mrs Eden Battarbee', '25 Main Streat, Beaumonts', '08 8762 5308', 'eden@gmail.com'),
(3, 'Tyson A Salvado', '15 Ghost Hill Road, ST Marys South', '02 4728 5284', 'tyson@gmail.com');

-- Create properties table
CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` int(10) NOT NULL AUTO_INCREMENT,
  `property_title` varchar(150) DEFAULT NULL,
  `property_details` text,
  `delivery_type` varchar(20) DEFAULT NULL,
  `availablility` int(5) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `property_address` varchar(200) DEFAULT NULL,
  `property_img` varchar(200) DEFAULT NULL,
  `bed_room` int(5) DEFAULT NULL,
  `liv_room` int(5) DEFAULT NULL,
  `parking` int(5) DEFAULT NULL,
  `kitchen` int(5) DEFAULT NULL,
  `utility` varchar(100) DEFAULT NULL,
  `property_type` varchar(20) DEFAULT NULL,
  `floor_space` varchar(20) DEFAULT NULL,
  `agent_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Initialize properties auto increment
ALTER TABLE `properties` AUTO_INCREMENT = 1;

-- Insert sample property data
INSERT INTO `properties` (`property_title`, `property_details`, `delivery_type`, `availablility`, `price`, `property_address`, `property_img`, `bed_room`, `liv_room`, `parking`, `kitchen`, `utility`, `property_type`, `floor_space`, `agent_id`) VALUES
('Luxury Apartment in Mumbai', 'Modern 3BHK apartment with premium amenities', 'Sale', 0, 15000000, 'Bandra West, Mumbai', 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267', 3, 2, 2, 1, 'Electricity, Gas, Water, Internet, Gym', 'Apartment', '2000 X 1800', 1),
('Premium Office Space', 'Prime location office space with modern facilities', 'Rent', 0, 75000, 'Connaught Place, New Delhi', 'https://images.unsplash.com/photo-1497366216548-37526070297c', 0, 1, 1, 1, 'Electricity, Water, Internet, AC', 'Office-Space', '1500 X 1200', 2),
('Luxury Villa', 'Spacious villa with private garden', 'Sale', 0, 25000000, 'Whitefield, Bangalore', 'https://images.unsplash.com/photo-1613977257363-707ba9348227', 4, 3, 2, 2, 'Electricity, Gas, Water, Internet, Garden', 'Building', '3000 X 2500', 3),
('Modern Studio Apartment', 'Compact and stylish studio apartment', 'Rent', 0, 25000, 'Koramangala, Bangalore', 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688', 1, 1, 1, 1, 'Electricity, Water, Internet', 'Apartment', '800 X 600', 1),
('Premium Retail Space', 'Prime location retail space', 'Sale', 0, 12000000, 'South Extension, New Delhi', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab', 0, 1, 1, 1, 'Electricity, Water, Internet, AC', 'Office-Space', '1200 X 1000', 2),
('Family Apartment', 'Spacious family apartment with modern amenities', 'Rent', 0, 45000, 'Andheri East, Mumbai', 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750', 3, 2, 1, 1, 'Electricity, Gas, Water, Internet', 'Apartment', '1800 X 1600', 3),
('Luxury Penthouse', 'Exclusive penthouse with city views', 'Sale', 0, 35000000, 'Tardeo, Mumbai', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c', 4, 3, 2, 2, 'Electricity, Gas, Water, Internet, Gym, Pool', 'Building', '2500 X 2200', 1),
('Seaside Villa', 'Beautiful villa with ocean views', 'Sale', 0, 45000000, 'Juhu, Mumbai', 'https://images.unsplash.com/photo-1613490493576-7fde63acd811', 5, 3, 3, 2, 'Electricity, Gas, Water, Internet, Pool, Garden, Security', 'Building', '4000 X 3500', 2),
('Smart Office Complex', 'Modern office space with smart amenities', 'Rent', 0, 150000, 'Cyber City, Gurugram', 'https://images.unsplash.com/photo-1497366858526-0766cadbe8fa', 0, 4, 10, 1, 'Electricity, Water, Internet, AC, Conference Rooms, Cafeteria', 'Office-Space', '5000 X 4000', 3),
('Eco-Friendly Apartment', 'Sustainable living space with solar power', 'Sale', 0, 18000000, 'Electronic City, Bangalore', 'https://images.unsplash.com/photo-1567496898669-ee935f5f647a', 3, 2, 2, 1, 'Solar Power, Water Recycling, Internet, Garden', 'Apartment', '2200 X 1900', 1);

-- Create property image table
CREATE TABLE IF NOT EXISTS `property_image` (
  `property_images` varchar(200) DEFAULT NULL,
  `property_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert sample property image data
INSERT INTO `property_image` (`property_images`, `property_id`) VALUES
('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267', 1),
('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688', 1),
('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2', 1),
('https://images.unsplash.com/photo-1560449017-7d276594da7e', 1),
('https://images.unsplash.com/photo-1560448204-603b3fc33ddc', 1),
('https://images.unsplash.com/photo-1497366216548-37526070297c', 2),
('https://images.unsplash.com/photo-1497366754035-f200968a6e72', 2),
('https://images.unsplash.com/photo-1497366811353-6870744d04b2', 2),
('https://images.unsplash.com/photo-1613977257363-707ba9348227', 3),
('https://images.unsplash.com/photo-1613977257592-4871e5fcd7c4', 3),
('https://images.unsplash.com/photo-1613977257363-707ba9348227', 3),
('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688', 4),
('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688', 4),
('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab', 5),
('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab', 5),
('https://images.unsplash.com/photo-1512917774080-9991f1c4c750', 6),
('https://images.unsplash.com/photo-1512917774080-9991f1c4c750', 6),
('https://images.unsplash.com/photo-1600585154340-be6161a56a0c', 7),
('https://images.unsplash.com/photo-1600585154340-be6161a56a0c', 7),
('https://images.unsplash.com/photo-1613490493576-7fde63acd811', 8),
('https://images.unsplash.com/photo-1613490493576-7fde63acd811', 8),
('https://images.unsplash.com/photo-1613490493576-7fde63acd812', 8),
('https://images.unsplash.com/photo-1497366858526-0766cadbe8fa', 9),
('https://images.unsplash.com/photo-1497366858526-0766cadbe8fb', 9),
('https://images.unsplash.com/photo-1497366858526-0766cadbe8fc', 9),
('https://images.unsplash.com/photo-1567496898669-ee935f5f647a', 10),
('https://images.unsplash.com/photo-1567496898669-ee935f5f647b', 10),
('https://images.unsplash.com/photo-1567496898669-ee935f5f647c', 10);

-- Create users table with all needed columns
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `agent_id` int(10) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Make sure users table has all required columns
-- Add email column if it doesn't exist
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `email` varchar(100) NOT NULL UNIQUE AFTER `username`;

-- Add created_at column if it doesn't exist
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER `agent_id`;

-- Make agent_id nullable in case users sign up without being agents
ALTER TABLE `users` MODIFY COLUMN `agent_id` int(10) NULL;

-- Update auto increment values for tables
ALTER TABLE `agent`
  MODIFY `agent_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `properties`
  MODIFY `property_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    is_read TINYINT(1) DEFAULT 0
);
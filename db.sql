CREATE DATABASE IF NOT EXISTS car_rental;

USE car_rental;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('customer', 'agency') NOT NULL
);

CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agency_id INT NOT NULL,
    vehicle_model VARCHAR(255) NOT NULL,
    vehicle_number VARCHAR(20) NOT NULL,
    seating_capacity INT NOT NULL,
    rent_per_day DECIMAL(10,2) NOT NULL,
    rented TINYINT(1) DEFAULT 0,
    FOREIGN KEY (agency_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    car_id INT,
    start_date DATE,
    number_of_days INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
);

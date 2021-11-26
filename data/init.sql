-- CREATE DATABASE SRMS; 

-- use SRMS; 


-- CREATE TABLE student ( 
--     student_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
--     student_name VARCHAR(60) NOT NULL, 
--     email_address VARCHAR(50) NOT NULL, 
--     contact_number VARCHAR(11) NOT NULL,
--     gender VARCHAR NOT NULL,
--     address VARCHAR(50) NOT NULL, 
--     date TIMESTAMP 
-- );
CREATE DATABASE SRMS; 

use SRMS; 


CREATE TABLE student ( 
    student_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    student_name VARCHAR(60) NOT NULL, 
    email_address VARCHAR(50) NOT NULL, 
    contact_number VARCHAR(11) NOT NULL,
    gender VARCHAR(6) NOT NULL, 
    address VARCHAR(50), 
    date TIMESTAMP 

);

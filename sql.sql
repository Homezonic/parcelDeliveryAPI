CREATE TABLE parcels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_name VARCHAR(255) NOT NULL,
    recipient_address VARCHAR(255) NOT NULL,
    sender_name VARCHAR(255) NOT NULL,
    sender_address VARCHAR(255) NOT NULL,
    weight DECIMAL(5, 2) NOT NULL,
    status VARCHAR(20) NOT NULL
);
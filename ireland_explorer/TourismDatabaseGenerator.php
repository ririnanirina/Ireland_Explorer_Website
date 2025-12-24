<?php
require 'db_connect.php';

$sql = "
CREATE TABLE IF NOT EXISTS attractions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    county VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    short_description VARCHAR(500),
    full_description TEXT,
    image VARCHAR(255),
    price_range VARCHAR(50),
    category VARCHAR(100),
    website VARCHAR(255),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8)
);
";

if ($conn->query($sql) === TRUE) {
    echo "Attractions table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

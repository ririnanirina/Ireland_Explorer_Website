-- ---------------------------------------------------------
-- Ireland Explorer – Full Database Setup
-- Creates database, table, and sample data
-- ---------------------------------------------------------

-- 1. Create the database
CREATE DATABASE IF NOT EXISTS ireland_explorer
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE ireland_explorer;

-- 2. Create the attractions table
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

-- 3. Insert sample attractions
INSERT INTO attractions
(name, county, region, short_description, full_description, image, price_range, category, website, latitude, longitude)
VALUES
('Cliffs of Moher', 'Clare', 'Wild Atlantic Way',
 'Iconic sea cliffs with dramatic Atlantic views.',
 'The Cliffs of Moher are one of Ireland''s most visited natural attractions, offering towering cliffs, stunning sea views, and a visitor centre with exhibitions on the local geology, wildlife, and history.',
 'cliffs-of-moher.jpg', '€€', 'Nature',
 'https://www.cliffsofmoher.ie', 52.9730, -9.4309),

('Galway City', 'Galway', 'Wild Atlantic Way',
 'Colourful streets, live music, and harbour views.',
 'Galway City is known for its vibrant arts scene, traditional music, medieval streets, and as a gateway to Connemara and the Aran Islands.',
 'galway-city.jpg', '€–€€€', 'City',
 'https://www.galwaytourism.ie', 53.2707, -9.0568),

('Dublin Castle', 'Dublin', 'Ireland''s Ancient East',
 'Historic castle complex in the heart of Dublin.',
 'Dublin Castle has played a central role in Irish history for centuries. Visitors can explore the State Apartments, medieval undercroft, and beautifully maintained grounds.',
 'dublin-castle.jpg', '€€', 'History',
 'https://www.dublincastle.ie', 53.3429, -6.2675);

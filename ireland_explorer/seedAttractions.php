<?php
require 'db_connect.php';

$sql = "
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
 'https://www.dublincastle.ie', 53.3429, -6.2675)
";

if ($conn->query($sql) === TRUE) {
    echo "Sample attractions inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();

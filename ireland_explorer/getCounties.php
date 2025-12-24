<?php
$counties = [
    ['name' => 'Dublin', 'region' => "Ireland's Ancient East"],
    ['name' => 'Galway', 'region' => 'Wild Atlantic Way'],
    ['name' => 'Clare', 'region' => 'Wild Atlantic Way'],
    ['name' => 'Cork', 'region' => 'Wild Atlantic Way'],
    ['name' => 'Kerry', 'region' => 'Wild Atlantic Way'],
    ['name' => 'Mayo', 'region' => 'Wild Atlantic Way'],
    ['name' => 'Kilkenny', 'region' => "Ireland's Ancient East"],
    ['name' => 'Wexford', 'region' => "Ireland's Ancient East"],
    // add more if needed
];

header('Content-Type: application/json');
echo json_encode($counties);

<?php
require 'db_connect.php';

$q = isset($_REQUEST['q']) ? trim($_REQUEST['q']) : '';

if ($q !== "") {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare("SELECT name FROM attractions WHERE name LIKE ? LIMIT 10");
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $hints = [];
    while ($row = $result->fetch_assoc()) {
        $hints[] = $row['name'];
    }

    echo empty($hints) ? "no suggestions" : implode(", ", $hints);

    $stmt->close();
}

$conn->close();

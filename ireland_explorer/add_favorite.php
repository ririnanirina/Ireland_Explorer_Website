<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$attraction_id = (int) $_GET["id"];

$stmt = $conn->prepare("INSERT IGNORE INTO favorites (user_id, attraction_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $attraction_id);
$stmt->execute();

header("Location: attraction.php?id=" . $attraction_id);
exit;

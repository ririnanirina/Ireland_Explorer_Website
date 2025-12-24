<?php
session_start();

// Example merchandise items (you can expand this later)
$products = [
    1 => ["name" => "Ireland Explorer T‑Shirt", "price" => 19.99],
    2 => ["name" => "Ireland Explorer Mug", "price" => 9.99],
    3 => ["name" => "Ireland Explorer Hoodie", "price" => 39.99]
];

$id = (int)$_GET["id"];

if (!isset($products[$id])) {
    die("Invalid product.");
}

// Initialize cart
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Add or increase quantity
if (isset($_SESSION["cart"][$id])) {
    $_SESSION["cart"][$id]["quantity"]++;
} else {
    $_SESSION["cart"][$id] = [
        "name" => $products[$id]["name"],
        "price" => $products[$id]["price"],
        "quantity" => 1
    ];
}

header("Location: cart.php");
exit;

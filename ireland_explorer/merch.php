<?php
session_start();

$products = [
    1 => ["name" => "Ireland Explorer T‑Shirt", "price" => 19.99],
    2 => ["name" => "Ireland Explorer Mug", "price" => 9.99],
    3 => ["name" => "Ireland Explorer Hoodie", "price" => 39.99]
];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Merch – Ireland Explorer</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="index.php" class="back-link">← Back</a>

        <?php include 'header_buttons.php'; ?>

        <h1>Ireland Explorer Merchandise</h1>
    </div>
</header>

<main class="container">
    <div class="attractions-grid">
        <?php foreach ($products as $id => $p): ?>
            <article class="attraction-card">
                <h3><?php echo htmlspecialchars($p["name"]); ?></h3>
                <p>€<?php echo number_format($p["price"], 2); ?></p>
                <a class="button" href="add_to_cart.php?id=<?php echo $id; ?>">Add to Cart</a>
            </article>
        <?php endforeach; ?>
    </div>
</main>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($_SESSION["cart"] as $item) {
    $total += $item["price"] * $item["quantity"];
}

$success = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $success = true;
    $_SESSION["cart"] = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Checkout – Ireland Explorer</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="cart.php" class="back-link">← Back</a>

        <?php include 'header_buttons.php'; ?>

        <h1>Checkout</h1>
    </div>
</header>

<main class="container">

<?php if ($success): ?>

    <h2>Thank you for your purchase!</h2>
    <p>Your order has been placed successfully.</p>
    <a class="button" href="index.php">Return to Home</a>

<?php else: ?>

    <h2>Order Summary</h2>
    <p>Total: <strong>€<?php echo number_format($total, 2); ?></strong></p>

    <h2>Your Details</h2>
    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Address</label>
        <input type="text" name="address" required>

        <label>City</label>
        <input type="text" name="city" required>

        <label>Country</label>
        <input type="text" name="country" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit" class="button">Place Order</button>
    </form>

<?php endif; ?>

</main>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (isset($_GET["remove"])) {
    $id = (int)$_GET["remove"];
    unset($_SESSION["cart"][$id]);
    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($_SESSION["cart"] as $item) {
    $total += $item["price"] * $item["quantity"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Cart – Ireland Explorer</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="index.php" class="back-link">← Back</a>

        <?php include 'header_buttons.php'; ?>

        <h1>Your Cart</h1>
    </div>
</header>

<main class="container">
    <?php if (empty($_SESSION["cart"])): ?>
        <p>Your cart is empty.</p>
        <a class="button" href="merch.php">Browse Merch</a>
    <?php else: ?>

        <table class="cart-table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th></th>
            </tr>

            <?php foreach ($_SESSION["cart"] as $id => $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item["name"]); ?></td>
                    <td>€<?php echo number_format($item["price"], 2); ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>€<?php echo number_format($item["price"] * $item["quantity"], 2); ?></td>
                    <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Total: €<?php echo number_format($total, 2); ?></h2>

        <a class="button" href="checkout.php">Proceed to Checkout</a>

    <?php endif; ?>
</main>

</body>
</html>

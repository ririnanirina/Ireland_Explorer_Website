<div style="margin-bottom: 10px;">
    <?php if (isset($_SESSION["username"])): ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
        <a href="favorites.php" class="button">My Favorites</a>
        <a href="logout.php" class="button">Log Out</a>
    <?php else: ?>
        <a href="login.php" class="button">Log In</a>
        <a href="register.php" class="button">Register</a>
    <?php endif; ?>

    <a href="merch.php" class="button">Merch</a>
    <a href="cart.php" class="button">🛒 Cart</a>
</div>

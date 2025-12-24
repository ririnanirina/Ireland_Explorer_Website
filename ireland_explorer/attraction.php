<?php
session_start();
require 'db_connect.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$sql = "SELECT * FROM attractions WHERE id = $id";
$result = $conn->query($sql);
$attraction = $result ? $result->fetch_assoc() : null;

// Check if favorite
$is_favorite = false;
if (isset($_SESSION["user_id"]) && $attraction) {
    $check = $conn->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND attraction_id = ?");
    $check->bind_param("ii", $_SESSION["user_id"], $attraction['id']);
    $check->execute();
    $check->store_result();
    $is_favorite = $check->num_rows > 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $attraction ? htmlspecialchars($attraction['name']) : "Not Found"; ?></title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="index.php" class="back-link">← Back</a>

        <?php include 'header_buttons.php'; ?>
    </div>
</header>

<main class="container attraction-page">
    <?php if (!$attraction): ?>
        <h1>Attraction not found</h1>
    <?php else: ?>

        <h1><?php echo htmlspecialchars($attraction['name']); ?></h1>

        <p class="meta">
            <?php echo htmlspecialchars($attraction['county']); ?> ·
            <?php echo htmlspecialchars($attraction['region']); ?> ·
            <?php echo htmlspecialchars($attraction['category']); ?>
        </p>

        <!-- FAVORITE BUTTON -->
        <?php if (isset($_SESSION["user_id"])): ?>
            <?php if ($is_favorite): ?>
                <a class="button" href="remove_favorite.php?id=<?php echo $attraction['id']; ?>">★ Remove from Favorites</a>
            <?php else: ?>
                <a class="button" href="add_favorite.php?id=<?php echo $attraction['id']; ?>">☆ Save to Favorites</a>
            <?php endif; ?>
        <?php else: ?>
            <p><a href="login.php">Log in</a> to save this attraction.</p>
        <?php endif; ?>

        <?php if (!empty($attraction['image'])): ?>
            <img class="hero" src="images/<?php echo htmlspecialchars($attraction['image']); ?>">
        <?php endif; ?>

        <section class="description">
            <p><?php echo nl2br(htmlspecialchars($attraction['full_description'])); ?></p>
        </section>

    <?php endif; ?>
</main>

</body>
</html>
<?php $conn->close(); ?>

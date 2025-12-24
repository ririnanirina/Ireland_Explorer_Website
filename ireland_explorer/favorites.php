<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$sql = "
SELECT attractions.*
FROM favorites
JOIN attractions ON favorites.attraction_id = attractions.id
WHERE favorites.user_id = ?
ORDER BY favorites.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Favorites – Ireland Explorer</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="index.php" class="back-link">← Back</a>

        <?php include 'header_buttons.php'; ?>

        <h1>Your Saved Attractions</h1>
    </div>
</header>

<main class="container">
    <?php if ($result->num_rows === 0): ?>
        <p>You haven't saved any attractions yet.</p>
    <?php else: ?>
        <div class="attractions-grid">
            <?php while($row = $result->fetch_assoc()): ?>
                <article class="attraction-card">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="meta"><?php echo htmlspecialchars($row['county']); ?> · <?php echo htmlspecialchars($row['region']); ?></p>
                    <p><?php echo htmlspecialchars($row['short_description']); ?></p>
                    <a class="button" href="attraction.php?id=<?php echo $row['id']; ?>">View details</a>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>

</body>
</html>

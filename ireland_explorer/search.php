<?php
session_start();
require 'db_connect.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$stmt = $conn->prepare("
    SELECT id, name, county, region, short_description, image
    FROM attractions
    WHERE name LIKE ? OR county LIKE ? OR region LIKE ? OR category LIKE ?
    ORDER BY name
");
$like = '%' . $q . '%';
$stmt->bind_param('ssss', $like, $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search “<?php echo htmlspecialchars($q); ?>” – Ireland Explorer</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header small">
    <div class="container">
        <a href="index.php" class="back-link">← Ireland Explorer</a>

        <?php include 'header_buttons.php'; ?>

        <h1>Search results for “<?php echo htmlspecialchars($q); ?>”</h1>
    </div>
</header>

<main class="container">
    <?php if ($result->num_rows === 0): ?>
        <p>No places found. Try a county, city, or attraction name.</p>
    <?php else: ?>
        <div class="attractions-grid">
            <?php while($row = $result->fetch_assoc()): ?>
                <article class="attraction-card">
                    <?php if (!empty($row['image'])): ?>
                        <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <?php endif; ?>

                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="meta">
                        <?php echo htmlspecialchars($row['county']); ?> ·
                        <?php echo htmlspecialchars($row['region']); ?>
                    </p>
                    <p><?php echo htmlspecialchars($row['short_description']); ?></p>

                    <a class="button" href="attraction.php?id=<?php echo $row['id']; ?>">View details</a>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
<?php
$stmt->close();
$conn->close();
?>

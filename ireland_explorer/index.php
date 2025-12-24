<?php
session_start();
require 'db_connect.php';

$sql = "SELECT id, name, county, region, short_description, image FROM attractions ORDER BY county, name";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ireland Explorer – Discover Ireland</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="site-header">
    <div class="container">
        <h1>Ireland Explorer</h1>

        <?php include 'header_buttons.php'; ?>

        <form method="get" action="search.php" class="search-form">
            <input type="text" name="q" id="search" placeholder="Search places, counties, or regions..." autocomplete="off">
            <button type="submit">Search</button>
        </form>

        <p id="suggestions" class="suggestions"></p>
    </div>
</header>

<main class="container">
    <h2>Top attractions across Ireland</h2>

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
</main>

<script>
const searchInput = document.getElementById('search');
const suggestions = document.getElementById('suggestions');

searchInput.addEventListener('keyup', function() {
    const str = this.value;
    if (str.length === 0) {
        suggestions.textContent = "";
        return;
    }
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            suggestions.textContent = this.responseText;
        }
    };
    xhr.open("GET", "gethint.php?q=" + encodeURIComponent(str), true);
    xhr.send();
});
</script>

</body>
</html>
<?php $conn->close(); ?>

<?php
// universities.php - List all universities dynamically
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch universities from DB
$sql = "SELECT * FROM universities";
$result = $conn->query($sql);
?>
<section class="container">
    <h1>Universities in Sri Lanka</h1>
    <input type="text" id="searchInput" placeholder="Search universities..." style="margin-bottom:1rem; padding:0.5rem; width:100%; max-width:400px;">
    <div class="cards">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <p><?php echo htmlspecialchars($row['location']); ?></p>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php if (!empty($row['image'])): ?>
                        <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="max-width:100%;height:auto;">
                    <?php endif; ?>
                    <a href="university.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No universities found.</p>
        <?php endif; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
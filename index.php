<?php
// index.php - Homepage
include 'includes/header.php';
require_once 'includes/db.php';
?>
<section class="container">
    <h1>Welcome to the University Degree Management System</h1>
    <p>Find university degree programs in Sri Lanka based on your Z-score and stream.</p>
    <div class="cards">
        <div class="card">
            <h2>Universities</h2>
            <p>Browse all universities and their degree programs.</p>
            <a href="universities.php" class="btn">View Universities</a>
        </div>
        <div class="card">
            <h2>Z-Score Finder</h2>
            <p>Find degrees you qualify for based on your Z-score.</p>
            <a href="finder.php" class="btn">Try Finder</a>
        </div>
        <div class="card">
            <h2>Gallery</h2>
            <p>See photos of university life and campuses.</p>
            <a href="gallery.php" class="btn">View Gallery</a>
        </div>
        <div class="card">
            <h2>About</h2>
            <p>Learn more about this project.</p>
            <a href="about.php" class="btn">About Us</a>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
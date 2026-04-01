<?php
// finder.php - Z-score finder page
include 'includes/header.php';
require_once 'includes/db.php';

$degrees = [];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $zscore = isset($_POST['zscore']) ? floatval($_POST['zscore']) : 0;
    $stream = isset($_POST['stream']) ? $_POST['stream'] : '';
    if ($zscore > 0 && in_array($stream, ['Maths','Bio','Commerce','Arts'])) {
        // SQL JOIN to find matching degrees
        $stmt = $conn->prepare("SELECT d.name AS degree_name, u.name AS university_name, z.cutoff, d.duration, d.medium, d.description FROM degrees d JOIN departments dep ON d.department_id = dep.id JOIN faculties f ON dep.faculty_id = f.id JOIN universities u ON f.university_id = u.id JOIN zscore_cutoffs z ON d.id = z.degree_id WHERE z.stream = ? AND z.cutoff <= ? ORDER BY z.cutoff DESC");
        $stmt->bind_param('sd', $stream, $zscore);
        $stmt->execute();
        $degrees = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = 'Please enter a valid Z-score and select a stream.';
    }
}
?>
<section class="container">
    <h1>Z-Score Degree Finder</h1>
    <form method="POST" action="finder.php" onsubmit="return validateFinderForm();" style="margin-bottom:2rem;">
        <label for="zscore">Your Z-score:</label>
        <input type="number" step="0.001" min="0" max="4" name="zscore" id="zscore" required>
        <label for="stream">Stream:</label>
        <select name="stream" id="stream" required>
            <option value="">Select Stream</option>
            <option value="Maths">Maths</option>
            <option value="Bio">Bio</option>
            <option value="Commerce">Commerce</option>
            <option value="Arts">Arts</option>
        </select>
        <button type="submit" class="btn">Find Degrees</button>
    </form>
    <script>
    function validateFinderForm() {
        var z = document.getElementById('zscore').value;
        var s = document.getElementById('stream').value;
        if (z === '' || isNaN(z) || s === '') {
            alert('Please enter a valid Z-score and select a stream.');
            return false;
        }
        return true;
    }
    </script>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Matching Degrees</h2>
        <?php if (count($degrees) > 0): ?>
            <div class="cards">
                <?php foreach ($degrees as $deg): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($deg['degree_name']); ?></h3>
                        <p><strong>University:</strong> <?php echo htmlspecialchars($deg['university_name']); ?></p>
                        <p><strong>Cutoff:</strong> <?php echo htmlspecialchars($deg['cutoff']); ?></p>
                        <p><strong>Duration:</strong> <?php echo htmlspecialchars($deg['duration']); ?></p>
                        <p><strong>Medium:</strong> <?php echo htmlspecialchars($deg['medium']); ?></p>
                        <p><?php echo htmlspecialchars($deg['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No matching degrees found for your Z-score and stream.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php include 'includes/footer.php'; ?>
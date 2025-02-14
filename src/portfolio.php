<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("<p>User not logged in. Please log in to view your portfolio.</p>");
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$userQuery = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
if ($userQuery) {
    $userQuery->bind_param("i", $user_id);
    $userQuery->execute();
    $user = $userQuery->get_result()->fetch_assoc();
} else {
    die("Error fetching user data: " . $conn->error);
}

// Fetch data functions
function fetchData($conn, $query, $user_id) {
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    } else {
        die("Error fetching data: " . $conn->error);
    }
}

$experiences = fetchData($conn, "SELECT * FROM experience WHERE user_id = ? ORDER BY start_date DESC", $user_id);
$skills = fetchData($conn, "SELECT * FROM skills WHERE user_id = ?", $user_id);
$education = fetchData($conn, "SELECT * FROM education WHERE user_id = ? ORDER BY grad_year DESC", $user_id);
$projects = fetchData($conn, "SELECT * FROM projects WHERE user_id = ?", $user_id);
$references = fetchData($conn, "SELECT * FROM user_references WHERE user_id = ?", $user_id);

// Get template ID from the URL
$template_id = isset($_GET['template_id']) ? intval($_GET['template_id']) : 0;
$templateCSS = "css/default.css"; // Default template

if ($template_id) {
    $templateQuery = $conn->prepare("SELECT file_path FROM master_templates WHERE template_id = ?");
    if ($templateQuery) {
        $templateQuery->bind_param("i", $template_id);
        $templateQuery->execute();
        $templateResult = $templateQuery->get_result()->fetch_assoc();
        if ($templateResult) {
            $templateCSS = $templateResult['file_path'];
        }
    }
}

$pageTitle = "Portfolio";
$metaDescription = "View and manage your portfolio. Showcase your best work in a professional layout.";
$headerTitle = "Portfolio";
$headerSubtitle = "";
//var_dump($templateCSS);
//$extraCSS = '<link rel="stylesheet" href="' . htmlspecialchars($templateCSS) . '">';
//$extraCSS = '<link rel="stylesheet" href="css/template5.css">';
$extraCSS = '<link rel="stylesheet" href="' . $templateCSS . '">';
include 'header.php';
?>

<div class="container mt-4">
    <header class="text-center">
        <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?> | <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><?php echo htmlspecialchars($user['city'] . ', ' . $user['country']); ?></p>
    </header>

    <section>
        <h4 class="section-title">Experience</h4>
        <?php while ($row = $experiences->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['job_title']); ?></strong> at <?php echo htmlspecialchars($row['employer']); ?> (<?php echo htmlspecialchars($row['start_date']); ?> - <?php echo htmlspecialchars($row['end_date'] ?: 'Present'); ?>)</p>
            <p><?php echo htmlspecialchars($row['job_description']); ?></p>
        <?php endwhile; ?>
    </section>

    <section>
        <h4 class="section-title">Skills</h4>
        <ul>
            <?php while ($row = $skills->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($row['skill_name'] . ' (' . $row['skill_level'] . ')'); ?></li>
            <?php endwhile; ?>
        </ul>
    </section>

    <section>
        <h4 class="section-title">Education</h4>
        <?php while ($row = $education->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['qualification']); ?></strong> in <?php echo htmlspecialchars($row['field_of_study']); ?> from <?php echo htmlspecialchars($row['institution']); ?> (<?php echo htmlspecialchars($row['grad_year']); ?>)</p>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
        <?php endwhile; ?>
    </section>

    <section>
        <h4 class="section-title">Projects</h4>
        <?php while ($row = $projects->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['project_name']); ?></strong></p>
            <p><?php echo htmlspecialchars($row['project_description']); ?></p>
            <?php if (!empty($row['project_link'])): ?>
                <p><a href="<?php echo htmlspecialchars($row['project_link']); ?>" target="_blank">View Project</a></p>
            <?php endif; ?>
        <?php endwhile; ?>
    </section>

    <section>
        <h4 class="section-title">References</h4>
        <?php while ($row = $references->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['reference_name']); ?></strong> - <?php echo htmlspecialchars($row['designation']); ?></p>
            <p><?php echo htmlspecialchars($row['reference_email']); ?> | <?php echo htmlspecialchars($row['reference_contact']); ?></p>
        <?php endwhile; ?>
    </section>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

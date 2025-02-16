<?php
require 'init.php';
//include 'db.php';

// Page metadata
$pageTitle = "Editor";
$metaDescription = "Customize your portfolio with an easy-to-use editor. Modify text, images, and layout.";
$headerTitle = "Portfolio Editor";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/editor.css">';
include 'header.php';
?>

<main class="editor-container">
    <h2>Edit Your Portfolio</h2>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs navbar-light bg-light" id="editorTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" style="color: #2B7A78; border: 1px solid #2B7A78;" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Information</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" style="color: #2B7A78; border: 1px solid #2B7A78;" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab">Experience</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" style="color: #2B7A78; border: 1px solid #2B7A78;" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab">Skills</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" style="color: #2B7A78; border: 1px solid #2B7A78;" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab">Education</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" style="color: #2B7A78; border: 1px solid #2B7A78;" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab">Projects</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" style="color: #2B7A78; border: 1px solid #2B7A78;" id="references-tab" data-bs-toggle="tab" data-bs-target="#references" type="button" role="tab">References</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="editorTabsContent">
        <div class="tab-pane fade show active" id="personal" role="tabpanel">
            <?php include 'personal_info.php'; ?>
        </div>
        <div class="tab-pane fade" id="experience" role="tabpanel">
            <?php include 'experience.php'; ?>
        </div>
        <div class="tab-pane fade" id="skills" role="tabpanel">
            <?php include 'skills.php'; ?>
        </div>
        <div class="tab-pane fade" id="education" role="tabpanel">
            <?php include 'education.php'; ?>
        </div>
        <div class="tab-pane fade" id="projects" role="tabpanel">
            <?php include 'projects.php'; ?>
        </div>
        <div class="tab-pane fade" id="references" role="tabpanel">
            <?php include 'references.php'; ?>
        </div>
    </div>
</main>


<!-- Bootstrap & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include footer.php -->
<?php include 'footer.php'; ?>
</body>
</html>

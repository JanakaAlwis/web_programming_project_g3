<?php
require 'init.php';
//session_start();

// Page metadata
$pageTitle = "Templates";
$metaDescription = "Choose from a variety of professional templates to create your perfect portfolio.";
$headerTitle = "Templates";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/templates.css">';
include 'header.php';
include 'db.php';

// Fetch templates from the database
$templateQuery = $conn->query("SELECT * FROM master_templates");
$templates = $templateQuery->fetch_all(MYSQLI_ASSOC);
?>

<!-- Main Content Section -->
<main class="container mt-4">
    <h2>Choose a Template</h2>
    <p>Select from a range of professional templates designed to highlight your skills and achievements. Whether you're a student, professional, or freelancer, we have something for everyone.</p>

    <!-- Template Cards -->
    <div class="row">
        <?php foreach ($templates as $template): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="<?php echo $template['preview_image_path']; ?>" class="card-img-top" alt="<?php echo $template['template_name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $template['template_name']; ?></h5>
                        <p class="card-text"><?php echo $template['description']; ?></p>
                        <!-- Button to select the template and pass the template_id via URL -->
                        <a href="portfolio.php?template_id=<?php echo $template['template_id']; ?>" class="btn btn-primary">Select Template</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Carousel for Featured Templates -->
    <h3 class="mt-5">Featured Templates</h3>
    <div id="carouselTemplates" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            // Display featured templates as a carousel
            $first = true;
            foreach ($templates as $template):
                $activeClass = $first ? 'active' : '';
                $first = false;
            ?>
                <div class="carousel-item <?php echo $activeClass; ?>">
                    <img src="<?php echo $template['preview_image_path']; ?>" class="d-block w-100" alt="Featured <?php echo $template['template_name']; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $template['template_name']; ?></h5>
                        <p><?php echo $template['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselTemplates" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselTemplates" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</main>

<!-- Include footer.php -->
<?php include 'footer.php'; ?>

<!-- Include Bootstrap and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

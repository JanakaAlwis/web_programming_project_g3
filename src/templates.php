<?php
$pageTitle = "Templates";
$metaDescription = "Choose from a variety of professional templates to create your perfect portfolio.";
$headerTitle = "Templates";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/templates.css">';
include 'header.php';
?>
    <!-- Main Content Section -->
    <main class="container mt-4">
        <h2>Choose a Template</h2>
        <p>Select from a range of professional templates designed to highlight your skills and achievements. Whether you're a student, professional, or freelancer, we have something for everyone.</p>

        <!-- Template Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/template1.jpg" class="card-img-top" alt="Template 1">
                    <div class="card-body">
                        <h5 class="card-title">Modern Design</h5>
                        <p class="card-text">A sleek, modern template with clean lines and professional aesthetics. Ideal for tech-savvy individuals.</p>
                        <a href="#" class="btn btn-primary">Preview</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/template2.jpg" class="card-img-top" alt="Template 2">
                    <div class="card-body">
                        <h5 class="card-title">Creative Layout</h5>
                        <p class="card-text">A vibrant, creative design perfect for artists, designers, and anyone looking to showcase creativity.</p>
                        <a href="#" class="btn btn-primary">Preview</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/template3.jpg" class="card-img-top" alt="Template 3">
                    <div class="card-body">
                        <h5 class="card-title">Minimalist Style</h5>
                        <p class="card-text">A minimalist template focused on simplicity and functionality. Great for professionals and academics.</p>
                        <a href="#" class="btn btn-primary">Preview</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel for Featured Templates -->
        <h3 class="mt-5">Featured Templates</h3>
            <div id="carouselTemplates" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/template1.jpg" class="d-block w-100" alt="Featured Template 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Modern Design</h5>
                            <p>Highlight your skills with this modern and professional template.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/template2.jpg" class="d-block w-100" alt="Featured Template 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Creative Layout</h5>
                            <p>Perfect for artists and creative professionals.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/template3.jpg" class="d-block w-100" alt="Featured Template 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Minimalist Style</h5>
                            <p>Simplicity at its best.</p>
                        </div>
                    </div>
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

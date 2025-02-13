<?php
require 'db.php';

// Page metadata
$pageTitle = "Home";
$metaDescription = "Student Portfolio Builder - Create and customize your portfolio to showcase achievements.";
$headerTitle = "Student Portfolio Builder";
$headerSubtitle = "Create, customize, and showcase your achievements with ease!";
include 'header.php';
?>
    <!-- Main Content Section -->
    <main class="container mt-4">
        <!-- Welcome Section -->
        <section class="text-center">
            <h2>Welcome to Portfolio Builder</h2>
            <h5 style="font-weight: normal;">Transform your academic and professional achievements into a stunning digital portfolio. Start your journey today!</h5>
            <a href="templates.php" class="btn btn-primary">Get Started</a>
        </section>

        <!-- Features Section -->
        <section class="mt-5">
            <h3 class="text-center mb-4">Why Choose Us?</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <img src="images/easy.png" alt="Easy to Use" class="mb-3" style="width: 80px;">
                            <h5 class="card-title">Easy to Use</h5>
                            <p class="card-text">Our intuitive interface makes it simple for anyone to build a portfolio in minutes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <img src="images/custom.png" alt="Customizable" class="mb-3" style="width: 80px;">
                            <h5 class="card-title">Customizable</h5>
                            <p class="card-text">Choose from a variety of templates and personalize your portfolio to suit your style.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <img src="images/share.png" alt="Shareable" class="mb-3" style="width: 80px;">
                            <h5 class="card-title">Shareable</h5>
                            <p class="card-text">Easily share your portfolio with recruiters, peers, and professors through a unique link.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features List Section -->
        <section class="mt-5">
            <h3>Features</h3>
            <ul class="list-group">
                <li class="list-group-item">Responsive and mobile-friendly designs</li>
                <li class="list-group-item">Drag-and-drop functionality for adding content</li>
                <li class="list-group-item">Secure and private data storage</li>
                <li class="list-group-item">Integrated analytics to track portfolio views</li>
            </ul>
        </section>
    </main>

    <!-- Include footer.php -->
    <?php include 'footer.php'; ?>

    <!-- Include Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

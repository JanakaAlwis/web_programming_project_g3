<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    // Sanitize inputs
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name  = $conn->real_escape_string($_POST['last_name']);
    $email      = $conn->real_escape_string($_POST['email']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (first_name, last_name, email, password_hash, template_id) 
            VALUES ('$first_name', '$last_name', '$email', '$password', 1)";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?registered=1");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}

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

    <!-- Modal for Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Login Form -->
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal for Sign Up -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <!-- Sign Up Form -->
                <form method="POST" action="index.php">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter your last name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Create a password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">I agree to the <a href="#">Terms & Conditions</a></label>
                    </div>
                    <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Include Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

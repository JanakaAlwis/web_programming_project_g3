<?php
ob_start();
require 'init.php';
//session_start();
//require 'db.php';

// Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email    = strtolower($conn->real_escape_string($_POST['email']));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE LOWER(email)='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Invalid credentials. Please try again.");
            exit();
        }
    } else {
        header("Location: index.php?error=User not found. Please check your email.");
        exit();
    }
}

// sign up
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

ob_end_flush();

// Page metadata
$pageTitle = "Index";
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
            
            <div class="d-flex justify-content-center gap-2 mt-4">
                <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
                <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
            </div>
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

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Log In</button>
                    </form>
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
                        <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Error to Jravich</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="errorMessage"></p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Welcome to Jravich</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Your registration was successful! You can now log in.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto Trigger Modals -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get("error");
            const registered = urlParams.get("registered");

            if (error) {
                document.getElementById("errorMessage").innerText = error;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            }

            if (registered) {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            }
        });
    </script>

    <!-- Include Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
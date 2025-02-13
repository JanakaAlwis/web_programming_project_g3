<?php
$pageTitle = "Portfolio";
$metaDescription = "View and manage your portfolio. Showcase your best work in a professional layout.";
$headerTitle = "Portfolio";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/portfolio.css">';
include 'header.php';
?>
    <main class="container mt-4">

        <!-- Personal Information Section -->
        <section id="personal-info" class="section-content mb-4">
            <h3>Personal Information</h3>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Bio:</strong> A passionate software developer with a focus on building scalable and efficient web applications. I enjoy working with the latest technologies and am always looking to improve my skills.</p>
            <p><strong>Email:</strong> john.doe@email.com</p>
            <p><strong>Location:</strong> New York, USA</p>
        </section>

        <!-- My Projects Section -->
        <h3>My Projects</h3>
        <p>Below is a showcase of my recent projects, each highlighting different skills and technologies I've used.</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/project1.jpg" class="card-img-top" alt="Project 1">
                    <div class="card-body">
                        <h5 class="card-title">Personal Portfolio Website</h5>
                        <p class="card-text">A responsive portfolio website showcasing my work and achievements.</p>
                        <ul>
                            <li>Technologies: HTML, CSS, JavaScript</li>
                            <li>Features: Mobile-friendly design, smooth scrolling</li>
                        </ul>
                        <a href="#" class="btn btn-primary">View Project</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/project2.jpg" class="card-img-top" alt="Project 2">
                    <div class="card-body">
                        <h5 class="card-title">E-commerce Store</h5>
                        <p class="card-text">An online shopping platform with user authentication and a payment gateway.</p>
                        <ul>
                            <li>Technologies: React, Node.js, MongoDB</li>
                            <li>Features: Dynamic product catalog, cart functionality</li>
                        </ul>
                        <a href="#" class="btn btn-primary">View Project</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="images/project3.jpg" class="card-img-top" alt="Project 3">
                    <div class="card-body">
                        <h5 class="card-title">Data Visualization Dashboard</h5>
                        <p class="card-text">A dashboard to analyze sales data with interactive charts and graphs.</p>
                        <ul>
                            <li>Technologies: Python, Power BI</li>
                            <li>Features: Real-time data updates, user filters</li>
                        </ul>
                        <a href="#" class="btn btn-primary">View Project</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills Section -->
        <h3 class="mt-5">Skills</h3>
        <p>Here's a summary of my technical skills:</p>
        <ul>
            <li>Programming Languages: Python, JavaScript, SQL</li>
            <li>Frameworks: React, Bootstrap, Node.js</li>
            <li>Tools: Power BI, IBM Cognos, Git</li>
        </ul>

        <!-- Education Section -->
        <section id="education" class="section-content mt-5">
            <h3>Education</h3>
            <p><strong>Degree:</strong> Bachelor of Science in Computer Science</p>
            <p><strong>University:</strong> ABC University</p>
            <p><strong>Graduation Year:</strong> 2024</p>
            <p><strong>Relevant Courses:</strong> Web Development, Data Structures and Algorithms, Machine Learning</p>
        </section>

    </main>
    
    <!-- Include footer.php -->
    <?php include 'footer.php'; ?>

    <!-- Include Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

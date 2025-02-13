<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Portfolio Builder'; ?></title>
    <meta name="description" content="<?php echo $metaDescription ?? 'Build your professional student portfolio with ease. Create, edit, and showcase your work effortlessly.'; ?>">
    
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <?php if (isset($extraCSS)) echo $extraCSS; ?>
</head>
<body>

<!-- Header Section -->
<header class="bg-dark text-white py-3">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <?php if ($pageTitle == "Home") : ?>
            <img src="images/jravich.png" alt="PortfolioBuilder" width="150" height="80" class="mb-3 mb-md-0 me-3"> 
        <?php endif; ?>

        <div class="text-center flex-grow-1">
            <h1 class="mb-0"><?php echo $headerTitle ?? 'Student Portfolio Builder'; ?></h1>
            <p class="lead mb-0"><?php echo $headerSubtitle ?? 'Create, customize, and showcase your achievements with ease!'; ?></p>
        </div>

        <?php if ($pageTitle == "Home") : ?>
            <div class="d-flex">
                <a href="#" class="text-white text-decoration-none ms-3 mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#loginModal">LOG OUT</a>
            </div>
        <?php endif; ?>
    </div>
</header>

<?php if ($pageTitle !== "Index") : ?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?php echo ($pageTitle == 'Home') ? 'active' : ''; ?>" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link <?php echo ($pageTitle == 'Portfolio') ? 'active' : ''; ?>" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link <?php echo ($pageTitle == 'Templates') ? 'active' : ''; ?>" href="templates.php">Templates</a></li>
                <li class="nav-item"><a class="nav-link <?php echo ($pageTitle == 'Editor') ? 'active' : ''; ?>" href="editor.php">Editor</a></li>
                <li class="nav-item"><a class="nav-link <?php echo ($pageTitle == 'Contact') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
<?php
require 'init.php';
//session_start();
//include 'db.php';

$popupMessage = ""; // Initialize message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // Set session variable for popup
        $_SESSION['popup_message'] = "Message successfully sent!";
        header("Location: contact.php"); // Redirect to avoid resubmission
        exit();
    }
}

// Page metadata
$pageTitle = "Contact";
$metaDescription = "Get in touch with JRAVICH for support and inquiries about the Portfolio Builder platform.";
$headerTitle = "Contact";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/contact.css">';

include 'header.php';
?>

<main class="container mt-4">
    <h2>Get in Touch</h2>

    <form method="POST" action="contact.php" id="contactForm">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</main>

<!-- Bootstrap Modal for Popup -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Get In Touch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Message successfully sent!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if (!empty($_SESSION['popup_message'])): ?>
        let successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        document.getElementById("contactForm").reset(); // Clear form after popup
        <?php unset($_SESSION['popup_message']); ?> // Clear message after showing
    <?php endif; ?>
});
</script>

<!-- Bootstrap & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

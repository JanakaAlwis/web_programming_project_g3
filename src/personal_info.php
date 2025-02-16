<?php
require 'init.php';
//session_start();
//include 'db.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// Fetch user data
$sql = "SELECT first_name, last_name, email, city, country, zip_code, phone, profile_image, linkedin_url 
        FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $first_name  = $conn->real_escape_string($_POST['first_name']);
    $last_name   = $conn->real_escape_string($_POST['last_name']);
    $city        = $conn->real_escape_string($_POST['city']);
    $country     = $conn->real_escape_string($_POST['country']);
    $zip_code    = $conn->real_escape_string($_POST['zip_code']);
    $phone       = $conn->real_escape_string($_POST['phone']);
    $linkedin_url = $conn->real_escape_string($_POST['linkedin_url']);

// Check if an image is uploaded
$profile_image = null;
if (!empty($_FILES['profile_image']['tmp_name'])) {
    $imageData = file_get_contents($_FILES['profile_image']['tmp_name']); // Read binary data
    $profile_image = $imageData; // Store binary content
}

    // Update query
    $sql = "UPDATE users SET 
                first_name = ?, 
                last_name = ?, 
                city = ?, 
                country = ?, 
                zip_code = ?, 
                phone = ?, 
                linkedin_url = ?";

    if ($profile_image) {
        $sql .= ", profile_image = ?";
    }

    $sql .= " WHERE user_id = ?";

    $stmt = $conn->prepare($sql);

    if ($profile_image) {
        $stmt->bind_param("ssssssssi", $first_name, $last_name, $city, $country, $zip_code, $phone, $linkedin_url, $profile_image, $user_id);
    } else {
        $stmt->bind_param("sssssssi", $first_name, $last_name, $city, $country, $zip_code, $phone, $linkedin_url, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Save Changes Successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating profile.']);
    }
    exit(); // Ensure script execution stops here after response
}
?>

<!-- Personal Information Form -->
<div class="editor-section">
    <h3>Personal Information</h3>
    <div id="success-message" style="display: none; color: green; margin-bottom: 10px;"></div>
    <form id="updateProfileForm" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="<?= htmlspecialchars($userData['first_name']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="<?= htmlspecialchars($userData['last_name']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($userData['city']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?= htmlspecialchars($userData['country']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipCode" name="zip_code" value="<?= htmlspecialchars($userData['zip_code']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($userData['phone']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="profileImage" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profileImage" name="profile_image">
                
                <!-- Show the profile image -->
                <img src="display_image.php?user_id=<?= $_SESSION['user_id'] ?>" 
                    alt="Profile Image" 
                    class="mt-2" 
                    width="100">
            </div>
            <div class="col-md-6 mb-3">
                <label for="linkedin" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin" name="linkedin_url" value="<?= htmlspecialchars($userData['linkedin_url']) ?>">
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit" id="saveChangesButton">Save Changes</button>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#updateProfileForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Get form data
            $.ajax({
                url: '', // Submit to the same page
                type: 'POST',
                data: formData,
                contentType: false, // Allow file uploads
                processData: false, // Don't process data as query string
                success: function(response) {
                    var data = JSON.parse(response); // Parse JSON response
                    if (data.success) {
                        // Show success message
                        $('#success-message').text(data.message).show();
                        // Hide message after 5 seconds
                        setTimeout(function() {
                            $('#success-message').fadeOut();
                        }, 5000);
                    } else {
                        alert(data.message); // Show error message if any
                    }
                },
                error: function() {
                    alert('There was an error updating your profile.');
                }
            });
        });
    });
</script>
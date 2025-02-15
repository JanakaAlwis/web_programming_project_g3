<?php
include 'db.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $sql = "SELECT profile_image FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($profile_image);
    $stmt->fetch();

    if ($profile_image) {
        header("Content-Type: image/jpeg"); // Adjust if using png/gif
        echo $profile_image;
    } else {
        // Return default image if no profile picture is set
        header("Content-Type: image/png");
        readfile("default-profile.png");
    }
}
?>

<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy my session
header("Location: index.php"); // Redirect to my page back to index.php (it is the base page)
exit(); // To ensure no further code is executed
?>
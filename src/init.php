<?php
// init.php
ob_start();
// Start session on every page
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once 'db.php';

// Optionally, you can include other common configuration settings here.


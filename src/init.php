<?php
ob_start();
// Start session on every page, check whether session is started.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once 'db.php';



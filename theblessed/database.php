<?php
// Database configuration
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (empty)
$dbname = "blessed_choir_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to track visitors
function trackVisitor($conn, $page) {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    // Sanitize inputs
    $ip_address = $conn->real_escape_string($ip_address);
    $user_agent = $conn->real_escape_string($user_agent);
    $page = $conn->real_escape_string($page);
    
    $sql = "INSERT INTO visitors (ip_address, user_agent, visit_date, page_visited) 
            VALUES ('$ip_address', '$user_agent', NOW(), '$page')";
    
    if (!$conn->query($sql)) {
        // Log error but don't show to user
        error_log("Error tracking visitor: " . $conn->error);
    }
}

// Call this function on each page
trackVisitor($conn, basename($_SERVER['PHP_SELF']));
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quotes_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['name'] ?? '';
$email     = $_POST['email'] ?? '';
$subject   = $_POST['subject'] ?? '';
$message   = $_POST['message'] ?? '';

// Store in DB
$sql = "INSERT INTO contact_submissions (full_name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $full_name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "<h2>✅ Thank you, $full_name! Your message has been sent and saved.</h2>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

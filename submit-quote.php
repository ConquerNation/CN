<?php
// Turn on error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quotes_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get POST data
$company_name     = $_POST['company_name'];
$contact_person   = $_POST['contact_person'];
$email            = $_POST['email'];
$phone            = $_POST['phone'];
$service_type     = $_POST['service_type'];
$start_date       = $_POST['start_date'];
$inquiry_details  = $_POST['inquiry_details'];

// Prepare and bind
$sql = "INSERT INTO inquiry_requests (
    company_name, contact_person, email, phone, service_type, start_date, inquiry_details
) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $company_name, $contact_person, $email, $phone, $service_type, $start_date, $inquiry_details);

// Execute
if ($stmt->execute()) {
    echo "<h2>✅ Thank you! Your inquiry has been submitted.</h2>";
} else {
    echo "❌ Error: " . $stmt->error;
}

// Close
$stmt->close();
$conn->close();
?>


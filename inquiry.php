<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = ""; // Default for XAMPP
$dbname = "quotes_db"; // Use your active DB

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$company_name     = $_POST['company_name'];
$contact_person   = $_POST['contact_person'];
$email            = $_POST['email'];
$phone            = $_POST['phone'];
$service_type     = $_POST['service_type'];
$start_date       = $_POST['start_date'];
$inquiry_details  = $_POST['inquiry_details'];

$sql = "INSERT INTO inquiry_requests (
    company_name, contact_person, email, phone, service_type, start_date, inquiry_details
) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $company_name, $contact_person, $email, $phone, $service_type, $start_date, $inquiry_details);

if ($stmt->execute()) {
    echo "<h2>✅ Inquiry submitted successfully. We'll follow up shortly!</h2>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

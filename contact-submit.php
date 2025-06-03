<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quotes_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture POST data
$full_name = $_POST['full_name'] ?? '';
$email     = $_POST['email'] ?? '';
$phone     = $_POST['phone'] ?? '';
$message   = $_POST['message'] ?? '';

// Insert into database
$sql = "INSERT INTO contact_submissions (full_name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $full_name, $email, $phone, $message);

if ($stmt->execute()) {
    echo "<h2>✅ Thank you for contacting us! Your message has been saved.</h2>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>


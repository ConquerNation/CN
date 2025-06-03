<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quotes_db"; // make sure this matches your database

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get form data
$email            = $_POST['email'] ?? '';
$first_name       = $_POST['first_name'] ?? '';
$last_name        = $_POST['last_name'] ?? '';
$phone            = $_POST['phone'] ?? '';
$commodity        = $_POST['commodity'] ?? '';
$shipping_from    = $_POST['from'] ?? '';
$shipping_to      = $_POST['to'] ?? '';
$additional_info  = $_POST['additional_info'] ?? '';
$services         = isset($_POST['services']) ? implode(", ", $_POST['services']) : '';

// Insert into DB
$sql = "INSERT INTO quote_requests (
    email, first_name, last_name, phone, commodity,
    shipping_from, shipping_to, services, additional_info
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss",
    $email, $first_name, $last_name, $phone, $commodity,
    $shipping_from, $shipping_to, $services, $additional_info
);

if ($stmt->execute()) {
    echo "<h2>✅ Quote request submitted successfully.</h2>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>


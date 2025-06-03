<?php

$servername = "localhost";
$username = "root";    
$password = "";     
$dbname = "quotes_db"; 


$conn = new mysqli("localhost", "root", "", "quotes_db");




if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$service_location = $_POST['service_location'];
$service_date = $_POST['service_date'];
$commodity = $_POST['commodity'];
if (isset($_POST['services'])) {
    $services_input = $_POST['services'];
    if (is_array($services_input)) {
        $services = implode(", ", $services_input);
    } else {
        $services = $services_input; // already a single string
    }
} else {
    $services = '';
}

$freight_env = $_POST['freight_env'];
$temperature_range = $_POST['temperature_range'];
if (isset($_POST['certifications'])) {
    $certifications_input = $_POST['certifications'];
    if (is_array($certifications_input)) {
        $certifications = implode(", ", $certifications_input);
    } else {
        $certifications = $certifications_input;
    }
} else {
    $certifications = '';
}

$hazmat_classes = $_POST['hazmat_classes'];
$unit_type = $_POST['unit_type'];
$num_units = $_POST['num_units'];
$space_needed = $_POST['space_needed'];
$load_number = $_POST['load_number'];
$company = $_POST['company'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$ext = $_POST['ext'];
$team_members = $_POST['team_members'];
$notes = $_POST['notes'];
$rate = $_POST['rate'];

$sql = "INSERT INTO quote_requests (
    service_location, service_date, commodity, services, freight_env,
    temperature_range, certifications, hazmat_classes, unit_type, num_units,
    space_needed, load_number, company, first_name, last_name,
    email, phone, ext, team_members, notes, rate
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssss",
    $service_location, $service_date, $commodity, $services, $freight_env,
    $temperature_range, $certifications, $hazmat_classes, $unit_type, $num_units,
    $space_needed, $load_number, $company, $first_name, $last_name,
    $email, $phone, $ext, $team_members, $notes, $rate
);

if ($stmt->execute()) {
    echo "<h2>Thank you! Your request has been submitted successfully.</h2>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

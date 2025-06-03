<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = htmlspecialchars($_POST["company"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $commodity = htmlspecialchars($_POST["commodity"]);
    $message = htmlspecialchars($_POST["message"]);

    echo "<h2>Thank you for your request!</h2>";
    echo "<p><strong>Company:</strong> $company</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Commodity:</strong> $commodity</p>";
    echo "<p><strong>Details:</strong><br>" . nl2br($message) . "</p>";
} else {
    echo "Form not submitted correctly.";
}
?>

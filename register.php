<?php
// Enable error reporting for troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration
include 'config.php';  // Connect to the database using config.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Assuming you have installed PHPMailer via Composer

// Handling the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Corrected table name to "members"
    $sql = "INSERT INTO members (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Send Confirmation Email
        sendConfirmationEmail($name, $email);
        echo "Registration successful! Check your email for confirmation.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Function to send a confirmation email
function sendConfirmationEmail($name, $email) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set mailer to use SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'MLSATUChapter@gmail.com';  // Replace with your email
        $mail->Password   = 'elgk mzjn vlij kgta';         // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('MLSATUChapter@gmail.com', 'MLSA Registration');
        $mail->addAddress($email); // Add the recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Registration Confirmation';
        $mail->Body    = "<h1>Welcome, $name!</h1><p>Thank you for registering for MLSA Updates. We will keep you posted on the latest news.</p>";
        $mail->AltBody = "Welcome, $name! Thank you for registering for MLSA Updates. We will keep you posted on the latest news.";

        $mail->send();
        echo 'Confirmation email has been sent!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

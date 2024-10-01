<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database configuration
$host = 'localhost';
$db   = 'php_task';
$user = 'root';
$pass = '';

// reCAPTCHA Secret Key
$secretKey = '6LdTqVQqAAAAAAbiQ9UP5E9ne9x5zpghGJAk0nJp';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $notes = $_POST['notes'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify Google reCAPTCHA
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptchaResponse;
    $verifyResponse = file_get_contents($verifyUrl);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, notes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $notes);

        if ($stmt->execute()) {
            if (sendEmail($name, $email, $phone, $notes)) {
                echo 'Success';
            } else {
                echo "Error sending email.";
            }
        } else {
            echo 'Error: ' . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo 'Captcha verification failed. Please try again.';
    }
}

function sendEmail($name, $email, $phone, $notes)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abhi225409@gmail.com';
        $mail->Password = 'fnleukxwnxgjwrcn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('abhi225409@gmail.com', 'Abhishek');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Thank You for Contacting Us!';
        $mail->Body = "<h1>Thank You, $name</h1><p>We have received your message.</p>
                        <p><strong>Phone:</strong> $phone</p>
                        <p><strong>Notes:</strong> $notes</p>";
        $mail->AltBody = "Thank you, $name. We have received your message. Phone: $phone. Notes: $notes.";

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail error: " . $mail->ErrorInfo);
        return false;
    }
}

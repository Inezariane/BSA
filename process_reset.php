<?php
// Include database connection
require 'db_connect.php';

// Include PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate reset token and expiry
            $resetToken = bin2hex(random_bytes(16));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Update user with reset token and expiry
            $updateStmt = $pdo->prepare("UPDATE users SET reset_token = :token, token_expiry = :expiry WHERE email = :email");
            $updateStmt->execute(['token' => $resetToken, 'expiry' => $expiry, 'email' => $email]);

            // Prepare email
            $mail = new PHPMailer(true);

            try {
                // SMTP Configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host (smtp.gmail.com is for Gmail)
                $mail->SMTPAuth = true;
                $mail->Username = 'sender0@gmail.com'; // Replace with your sender email
                $mail->Password = 'password'; // Replace with your sender email password 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // (Recommended for Gmail, Outlook, etc.)
                $mail->Port = 587;

                // Email Settings
                $mail->setFrom('sender@gmail.com', 'Site_name'); // Replace with your sender email and name
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Click the link below to reset your password:<br><br>
                               <a href='http://localhost:8080/reset_form.php?token=$resetToken'>Reset Password</a><br><br>
                               This link will expire in 1 hour.";

                // Send email
                $mail->send();
                echo "A password reset link has been sent to your email.";
            } catch (Exception $e) {
                echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Email address not found.";
        }
    } else {
        echo "Invalid email address.";
    }
}
?>

<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'] ?? 'No name provided';
    $email = $_POST['email'] ?? 'No email provided';
    $phone = $_POST['phone'] ?? 'No phone provided';
    $subject = $_POST['subject'] ?? 'New Contact Form Submission';
    $message = $_POST['message'] ?? 'No message provided';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'spedibra@gmail.com';
        $mail->Password   = 'dlet ahtj dezj rpba';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('spedibra@gmail.com', 'Contact Form');
        $mail->addAddress('spedibra@gmail.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form: $subject";

        // Email content
        $email_content = "
        <html>
        <head>
            <title>New Contact Form Submission</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                h2 { color: #3b82f6; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; }
                .message { background-color: #f9f9f9; padding: 15px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>New Contact Form Submission</h2>
                <div class='field'>
                    <span class='label'>Name:</span> $name
                </div>
                <div class='field'>
                    <span class='label'>Email:</span> $email
                </div>
                <div class='field'>
                    <span class='label'>Phone:</span> $phone
                </div>
                <div class='field'>
                    <span class='label'>Subject:</span> $subject
                </div>
                <div class='field'>
                    <span class='label'>Message:</span>
                    <div class='message'>$message</div>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->Body = $email_content;

        $mail->send();
        header("Location: /contact?success=1");
    } catch (Exception $e) {
        // Log the error for debugging
        file_put_contents('mail_error.log', date('Y-m-d H:i:s') . ': ' . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
        header("Location: /contact?error=1&msg=" . urlencode($mail->ErrorInfo));
    }

    exit;
}
?>

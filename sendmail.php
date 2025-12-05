<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP setup
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'querysolver3@gmail.com'; // 🔹 yahan apna Gmail likho
        $mail->Password   = 'nans fojs kmyd uksc';   // 🔹 Gmail ka App Password likho
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Receiver
        $mail->setFrom($email, $name);
        $mail->addAddress('querysolver3@gmail.com', 'CityCare Admin'); // 🔹 yahan bhi apna Gmail likho

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message - CityCare Hospital";
        $mail->Body    = "
        <h3>New Message Received</h3>
        <p><b>Name:</b> {$name}</p>
        <p><b>Email:</b> {$email}</p>
        <p><b>Phone:</b> {$phone}</p>
        <p><b>Message:</b><br>{$message}</p>
        ";

        if ($mail->send()) {
            echo "<script>alert('✅ Message sent successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('❌ Failed to send message. Try again later.');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('❌ Mail Error: {$mail->ErrorInfo}');</script>";
    }
}
?>
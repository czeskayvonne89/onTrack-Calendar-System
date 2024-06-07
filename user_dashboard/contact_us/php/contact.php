<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $improvements = htmlspecialchars($_POST['improvements']);

    // Email details
    $to = "your-email@example.com"; // Replace with your email
    $subject = "New Contact Us Message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email content
    $email_content = "<h2>New Contact Us Message</h2>";
    $email_content .= "<p><strong>Name:</strong> $name</p>";
    $email_content .= "<p><strong>Email:</strong> $email</p>";
    $email_content .= "<p><strong>Message:</strong></p>";
    $email_content .= "<p>$message</p>";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry! Something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>

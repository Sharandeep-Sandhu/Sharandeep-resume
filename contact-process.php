<?php

// Set email configuration
$emailTo = 'sharandeep.sandhu29@gmail.com'; // Change with your Email address

// Get form data (make sure to sanitize and validate user inputs)
$contactName = isset($_POST["contactName"]) ? $_POST["contactName"] : "";
$contactEmail = isset($_POST["contactEmail"]) ? $_POST["contactEmail"] : "";
$contactSubject = isset($_POST["contactSubject"]) ? $_POST["contactSubject"] : "";
$contactMessage = isset($_POST["contactMessage"]) ? $_POST["contactMessage"] : "";

// Validate email
if (empty($contactSubject) || !filter_var($contactSubject, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address.');
}

// If no validation errors, proceed to send the email
try {
    // Set email subject
    $subject = 'TrainoMart - Contact form';

    // Set email body (HTML content)
    $body = "Name: $contactName<br>Phone: $contactEmail<br>Email: $contactSubject<br>Message: $contactMessage";

    // Additional headers
    $headers = "From: $emailTo\r\n";
    $headers .= "Reply-To: $contactSubject\r\n";
    $headers .= "Content-Type: text/html\r\n";

    // Send the email using Amazon SES SMTP credentials
    $result = mail($emailTo, $subject, $body, $headers);

    // Check if the email was sent successfully
    if ($result) {
        // Display an alert using JavaScript
        echo '<script>';
        echo 'alert("Email has been sent successfully");';
        echo 'window.location.href = "index.html";';  // Redirect to index.html
        echo '</script>';
    } else {
        // Display an alert if there was an issue sending the email
        echo '<script>alert("Unable to send mail.");</script>';
    }
} catch (Exception $e) {
    // Handle the exception and display an error message
    echo '<script>alert("Unable to send mail. Error: ' . $e->getMessage() . '");</script>';
}
?>

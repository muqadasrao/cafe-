<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the email address from the form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Validate the email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Define the file to store email addresses
        $file = 'subscribers.txt';
        
        // Check if file exists and is writable
        if (is_writable($file) || !file_exists($file)) {
            // Save the email address to the file
            file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);
            
            // Optionally send a confirmation email (uncomment if needed)
            // $to = $email;
            // $subject = "Newsletter Subscription Confirmation";
            // $message = "Thank you for subscribing to our newsletter!";
            // $headers = "From: no-reply@yourdomain.com";
            // mail($to, $subject, $message, $headers);

            // Output success message
            echo "Your subscription request has been sent. Thank you!";
        } else {
            // Output error if the file is not writable
            echo "Unable to save your email address. Please try again later.";
        }
    } else {
        // Output error if the email is invalid
        echo "Invalid email address.";
    }
} else {
    // Redirect to the homepage if accessed directly
    header("Location: ../index.php");
    exit();
}
?>

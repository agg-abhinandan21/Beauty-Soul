<?php
$to = "agglucky779@gmail.com";
$subject = "New Contact Form Message";

$message = "Name: " . $_POST['name'] . "\n" .
           "Email: " . $_POST['email'] . "\n" .
           "Phone: " . $_POST['phone'] . "\n" .
           "Message: " . $_POST['message'];

$headers = "From: agglucky779@gmail.com";

mail($to, $subject, $message, $headers);

echo "Message Sent Successfully!";
?>

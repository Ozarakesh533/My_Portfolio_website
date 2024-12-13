<?php

// Replace with your actual email address
$receiving_email_address = 'ozarakesh7821@gmail.com';

// Check if the PHP Email Form library exists
if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  include( $php_email_form );
} else {
  die( 'Unable to load the "PHP Email Form" Library!' );
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Form data handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to avoid injection or malicious data
    $contact->to = filter_var($receiving_email_address, FILTER_SANITIZE_EMAIL);
    $contact->from_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);

    // Add messages from form inputs
    $contact->add_message($contact->from_name, 'From');
    $contact->add_message($contact->from_email, 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    // Sending the email
    echo $contact->send();
} else {
    echo "Invalid request method.";
}
?>

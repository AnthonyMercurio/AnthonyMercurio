<?php

$receiving_email_address = 'tonymatmerc@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Basic input validation
if (empty($contact->from_name) || empty($contact->from_email) || empty($contact->subject) || empty($_POST['message'])) {
    die('Please fill in all required fields.');
}
d
// Validate email format
if (!filter_var($contact->from_email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email format.');
}

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send email and handle errors
if (!$contact->send()) {
    die('Unable to send email. Please try again later.');
} else {
    echo 'Your message has been sent. Thank you!';
}

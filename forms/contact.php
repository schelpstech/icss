<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'elearning@icssnigeria.org';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $contact->smtp = [
    'host' => 'mail.icssnigeria.org',
    'username' => 'sender@icssnigeria.org',
    'password' => '',
    'port' => '465'
  ];


  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();


  
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace contact@example.com with your real receiving email address
    $receiving_email_address = 'elearning@icssnigeria.org';

    // Create an instance of PHP_Email_Form
    $contact = new PHP_Email_Form;

    // Set properties from POST data
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Add message content
    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);
// Attempt to send the email
$sendResult = $contact->send();

// Create a response array
$response = array(
    'success' => $sendResult, // Boolean indicating success or failure
    'message' => $sendResult ? 'Email sent successfully!' : 'Error sending email. Please try again later.'
);

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
} else {
// If the request method is not POST, return an error
echo 'Invalid request method.';
}
?>

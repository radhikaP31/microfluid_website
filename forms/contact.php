<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace form@example.com with your real receiving email address
  $receiving_email_address = 'sales@microfluidprocess.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $form = new PHP_Email_Form;
  $form->ajax = true;

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $form->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  if($_POST['form_name'] == 'product_inquiry'){

    $form->to = $receiving_email_address;
    $form->from_name = $_POST['name'];
    $form->company = $_POST['company'];
    $form->area = $_POST['area'];
    $form->country = $_POST['country'];
    $form->phone = $_POST['phone'];
    $form->email = $_POST['email'];
    $form->message = $_POST['message'];
    $form->product_id = $_POST['product_id'];
    
    echo $form->addInquiryDetails();

  }else if($_POST['form_name'] == 'contact_form'){
    $form->to = $receiving_email_address;
    $form->from_name = $_POST['name'];
    $form->from_email = $_POST['email'];
    $form->subject = $_POST['subject'];

    echo $form->send();
  }
  
  
?>

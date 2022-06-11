<?php
  /**
  * Requires the "PHP Email Form" library
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
    $form->smtp = array(
      'host' => 'sg3plcpnl0193.prod.sin3.secureserver.net',
      'username' => 'sales@microfluidprocess.com',
      'password' => 'password',
      'port' => '465'
    );

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
    
    $form->sendInquiryEmail(); //it gives error of can't connect to server
    $form->addInquiryDetails($_POST);
    echo json_encode("Request E-Mail Sent. Thank you " . $form->from_name  . ", we will contact you shortly.");

  }else if($_POST['form_name'] == 'contact_form'){
    $form->to = $receiving_email_address;
    $form->from_name = $_POST['name'];
    $form->from_email = $_POST['email'];
    $form->subject = $_POST['subject'];

    echo $form->send();
  }
  
  
?>

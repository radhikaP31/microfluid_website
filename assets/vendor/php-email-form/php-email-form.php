<?php 
class PHP_Email_Form{

    function __construct(){
        //Add database class for connection and create mysql object
        include $_SERVER['DOCUMENT_ROOT'].'/microfluid_website/database.php';
        include $_SERVER['DOCUMENT_ROOT'].'/microfluid_website/Common_query.php';
        $this->db = Database::getConnection();
        $this->constant = Common_query::constantVariables();

        //run constant function
    }

    public function addInquiryDetails()
    {
        //From single product page Quote form and Inquiry Form
        
        
        $company = $_POST['company'];
        $area = $_POST['area'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $from_mail = $_POST['email'];
        $message = $_POST['message'];
        $product_id = $_POST['product_id'];

        $to = 'sales@microfluidprocess.com'; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $name = $_POST['name'];
        $subject = "Inquiry Form submission";
        $subject2 = "Copy of your form submission";
        $message = $name . " wrote the following:" . "\n\n" . $_POST['message'];
        $message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['message'];

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

        echo json_encode("Mail Sent. Thank you " . $first_name . ", we will contact you shortly.");
    }

    public function addContactUsDetails()
    {
        //From contact us page form
        /*$to = "email@example.com"; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = "Form submission";
        $subject2 = "Copy of your form submission";
        $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
        $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";*/
        echo json_encode("Mail Sent. Thank you , we will contact you shortly.");
    }
    
}
?>
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

    public function sendInquiryEmail()
    {
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 1);

        //From single product page Quote form and Inquiry Form
        
        $name = $_POST['name'];
        $from_mail = $_POST['email'];
        $message = $_POST['message'];

        require_once($_SERVER['DOCUMENT_ROOT'].'/microfluid_website/phpmailer/class.phpmailer.php');

        $mail = new PHPMailer(); // defaults to using php "mail()"

        /*$mail->IsSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false; 
        $mail->Port = 465; */

        $mail->IsSMTP();
        $mail->Host       = "sg3plcpnl0193.prod.sin3.secureserver.net"; // SMTP server
        $mail->SMTPSecure = "ssl";
        $mail->SMTPDebug  = 2;                      // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
        $mail->SMTPAuth   = true;                   // enable SMTP authentication
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server // 587 for TLS // 465 for SSL
        $mail->Username   = "sales@microfluidprocess.com";  // SMTP account username
        $mail->Password   = "password";               // SMTP account password

        /*$mail->Host       = "ssl://smtp.gmail.com";       // SMTP server
        $mail->Host       = "smtp.gmail.com";       // SMTP server

        // Change $mail->Host if you are using gmail account
        $mail->Username   = "microfluidprocessequipment@gmail.com";  // SMTP account username
        $mail->Password   = "password";               // SMTP account password
       
        $mail->SetFrom('microfluidprocessequipment@gmail.com', 'Microfluid Process Equipment');
        $mail->addAddress('sales@microfluidprocess.com');*/

        $mail->Subject = $_POST['message'];

        $mail->MsgHTML($_POST['message']);

        if(!$mail->Send()) {
            return 'false';
        } else {
            return 'true';
        }

    }

    public function addInquiryDetails(){

        return $this->db->query('INSERT INTO `web_product_inquiry`(`product_id`, `name`, `company`, `area`, `country`, `phone`, `email`, `message`) VALUES ('.$_POST["product_id"].',"'.$_POST["name"].'","'.$_POST["company"].'","'.$_POST["area"].'","'.$_POST["country"].'","'.$_POST["phone"].'","'.$_POST["email"].'","'.$_POST["message"].'")');
    }
}
?>
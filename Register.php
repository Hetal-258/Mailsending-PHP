<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=email], input[type=tel] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=email]:focus ,input[type=tel]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
.signupbtn {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.signupbtn:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 10%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>
<?php //include_once 'process.php' ?>

<form  method="POST" name="register" style="border:1px solid #ccc" action="">
  <div class="container">
    <h1>Sign Up</h1>
    <hr>
    <label for="email"><b>First Name</b></label>
    <input type="text" placeholder="Enter firstname" name="fname" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Phone Number</b></label>
    <input type="tel" name="phone" placeholder="(814)-0876-676" required>

    <label for="psw-repeat"><b>Message</b></label>
    <input type="text" placeholder="Message" name="message" required>
    
       
      <div class="clearfix">

     <input type="submit" name="save" value="submit" class="signupbtn">
    </div>
  </div>
</form>

</body>
</html>
<?php 
$servername='localhost';
$username='root';
$password='M$p@1234';
$dbname = "maildemo";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
   die('Could not Connect My Sql:' .mysqli_error());
}

if(isset($_POST['save'])){

  $fname= $_POST['fname'];
  $email= $_POST['email'];
  $phone= $_POST['phone'];
  $msg = $_POST['message'];

  $query="INSERT INTO `register`(`name`, `email`, `phone`, `message`) VALUES ('$fname','$email','$phone','$msg')";

    if (mysqli_query($conn, $query)) {

      $to = 'hetal.r@msp-group.co.uk';
        $subject = 'Demo';           
         $message = '<HTML>
        <body>
        <div style="font-size:15px">
          <div bgcolor="#e5e5e1" style="margin:0;padding:0">
          <p>Dear Administator,</p>
          <table style="border-collapse: separate; border-spacing: 0; color: #4a4a4d; width: 100%; max-width: 600px; font: 14px/1.4 , Helvetica, Arial, sans-serif;border-collapse: separate; border-spacing: 0; color: #4a4a4d; width: 100%; max-width: 600px; font-size: 14px/1.4 , Helvetica, Arial, sans-serif; border: 1px solid #3669a0;">
          <tbody>
          <tr>
              <td colspan="3" style="text-align:center;border-bottom:1px solid #3669a0;background: #3669a0; color: #fff;font-weight:bold;font-size:20px;">Contact Details</td>
          </tr>
          <tr>
          <th style="padding: 10px 15px; vertical-align: middle; font-weight: bold; border-bottom: 1px solid #3669a0; border-right: 1px solid #3669a0; text-align: left;" colspan="2" scope="col">Name</th>
          <td style="padding: 10px 15px; vertical-align: middle; border-bottom: 1px solid #3669a0;" scope="col">'. $fname.'</td>
          </tr>
          <tr>
          <th style="padding: 10px 15px; vertical-align: middle; font-weight: bold; border-bottom: 1px solid #3669a0; border-right: 1px solid #3669a0; text-align: left;" colspan="2" scope="col">Email</th>
          <td style="padding: 10px 15px; vertical-align: middle; border-bottom: 1px solid #3669a0;" scope="col">'. $email.'</td>
          </tr>         
          <tr>
          <th style="padding: 10px 15px; vertical-align: middle; font-weight: bold; border-bottom: 1px solid #3669a0; border-right: 1px solid #3669a0; text-align: left;" colspan="2" scope="col">Password</th>
          <td style="padding: 10px 15px; vertical-align: middle; border-bottom: 1px solid #3669a0;" scope="col">'.$phone.'</td>
          </tr>
          <tr>
         
          <th style="padding: 10px 15px; vertical-align: middle; font-weight: bold; border-bottom: 1px solid #3669a0; border-right: 1px solid #3669a0; text-align: left;" colspan="2" scope="col">Message</th>
          <td style="padding: 10px 15px; vertical-align: middle; border-bottom: 1px solid #3669a0;" scope="col">'.$msg.'</td>
          </tr>
          </tbody>
          </table>
          <p>Thank you</p>
          </div>
        </div>
        </body>
        </html>';

                email("Test",$to,$message,$subject,"",$mail_cc,"");
         }
    }
?>

<?php 
function email($name,$to,$message,$subject,$customer='',$mail_cc='',$attachment='')
{
    //echo "SDfsdf";
//     echo getcwd();
// exit;

// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
    // include 'PHPMailer/vendor/autoload.php';
  require(getcwd()."/PHPMailer/src/PHPMailer.php");
  require(getcwd()."/PHPMailer/src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    //$mail = new PHPMailer(true);
  // exit;

    try {
        if(!empty($mail_cc)){
            $ccs = explode(',',$mail_cc);
        }
        else{
            $ccs = '';
        }
        
        $from_name  = 'Test';
        $from       = 'jitendra.p@msp-group.co.uk';
       // $from = 'info@nainayoga.in';
        $to_name = $name;
        
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.ionos.co.uk';                    // Set the SMTP server to send through
        $mail->SMTPDebug  = 0;              // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jitendra.p@msp-group.co.uk';                     // SMTP username
        $mail->Password   = 'M$p@2022';                               // SMTP password
        $mail->SMTPSecure = "tls";
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;    

                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($from, $from_name);
        $mail->addAddress($to, $to_name);     // Add a recipient
      
        if(isset($ccs) && $ccs!='')
        {
            foreach($ccs as $cc)
            {
               $mail->AddCC($cc, $to_name);
            }
        }
        if(!empty($attachment)){
            //$filePath = dirname(__FILE__);
            $attachments = explode(',',$attachment);
            foreach($attachments as $attachment){
                $mail->AddAttachment($attachment);
            }
        }

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
       return 1;
    } catch (PHPMailer\PHPMailer\Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return 0;
    }
}
